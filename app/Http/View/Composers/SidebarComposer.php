<?php 
namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class SidebarComposer
{
    public function compose(View $view)
    {
        // Get the authenticated user
        $user = Auth::user();

        // If user is authenticated, get the number of pending requests
        if ($user) {
            $pendingRequestsCount = Follow::where('following_id', $user->id)
                                           ->where('is_pending', true)
                                           ->count(); 
        } else {
            $pendingRequestsCount = 0; // No pending requests for guest users
        }

        // Format the count
        $formattedCount = $this->formatCount($pendingRequestsCount);

        // Share the formatted count with the view
        $view->with('pendingRequestsCount', $formattedCount);
    }

    private function formatCount($count)
    {
        if ($count >= 1000000) {
            return '+' . floor($count / 1000000) . 'M'; // 1M, 2M, etc.
        } elseif ($count >= 100000) {
            return '+' . floor($count / 100000) . '00k'; // 100k, 200k, etc.
        } elseif ($count >= 10000) {
            return '+' . floor($count / 10000) . '0k'; // 10k, 20k, etc.
        } elseif ($count >= 1000) {
            return '+' . floor($count / 1000) . 'k'; // 1k, 2k, etc.
        } elseif ($count >= 100) {
            return '+100'; // 100+
        }
        return (string) $count; // Return as a string to ensure it's always valid for display
    }
}

