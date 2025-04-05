<div class="bg-white rounded-4 p-3 my-2">
    <div class="d-flex justify-content-between">
        <a href="{{ route('profile', $blockedUser->username) }}" class="d-flex text-decoration-none text-dark">
            <img src="{{ $blockedUser->profile->cover_image_or_logo }}" class="rounded-circle logo-main" alt="User Image">
            <div class="px-1">
                <p class="mx-1 mb-0">
                    {{ $blockedUser->name }}
                    <i class="fa-solid fa-lock text-orange-color me-1"></i>
                </p>
                <p class="mx-1 my-0 text-grey">
                    <span>@</span>{{ $blockedUser->username }}
                </p>
            </div>
        </a>

        <div>
            <form action="{{ route('users.unblock') }}" method="POST" class="unblock-user-form-{{ $blockedUser->id }}">
                @csrf
                <input type="hidden" name="username" value="{{ $blockedUser->username }}" required>
                <button type="button" 
                        class="btn btn-sm btn-orange text-white unblock-button" 
                        data-bs-toggle="modal" 
                        data-bs-target="#confirmUnblockModal_{{ $blockedUser->id }}">
                    <i class="fas fa-ban text-white"></i> {{ __('profile.unblock_this_user') }}
                </button>
            </form>
        </div>

    </div>
</div>

<x-modal 
    id="confirmUnblockModal_{{ $blockedUser->id }}" 
    title="{{ __('profile.are_you_sure_unblock') }}" 
    message="{{ __('profile.unblock_confirmation_message') }}" 
    confirmButtonId="confirmUnblockButton{{ $blockedUser->id }}" 
/>


@push('js')
    <script>
        $(document).ready(function () {
            // Handle unblock confirmation
            $('[id^="confirmUnblockButton"]').on('click', function () {
                let buttonId = $(this).attr('id'); // e.g., confirmUnblockButton23
                let userId = buttonId.replace('confirmUnblockButton', ''); // e.g., 23
                $('.unblock-user-form-' + userId).submit();
            });
        });
    </script>
@endpush

