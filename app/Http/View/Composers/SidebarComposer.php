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

        // Share the pending request count with the view
        $view->with('pendingRequestsCount', $pendingRequestsCount);
    }
}
