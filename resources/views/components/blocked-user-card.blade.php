<div class="bg-white rounded-4 p-3 my-2">
    <div class="d-flex justify-content-between">
        <a href="{{ route('profile', $blockedUsername) }}" class="d-flex text-decoration-none text-dark" target="_blank">
            <img src="{{ $blockedUser->profile->cover_image_or_logo }}" class="rounded-circle logo-main" alt="User Image">
            <div class="px-1">
                <p class="mx-1 mb-0">
                    {{ $blockedUser->name }}
                    <i class="fa-solid fa-lock text-orange-color me-1"></i>
                </p>
                <p class="mx-1 my-0 text-grey">
                    <span>@</span>{{ $blockedUsername }}
                </p>
            </div>
        </a>
        <div>
            <form action="{{ route('users.unblock') }}" method="POST" class="unblock-user-form">
                @csrf
                <input type="hidden" name="username" value="{{ $blockedUsername }}" required>
                <button type="submit" class="btn btn-sm btn-orange text-white unblock-button">
                    <i class="fas fa-ban text-white"></i> {{ __('profile.unblock_this_user') }}
                </button>
            </form>
        </div>
    </div>
</div>
