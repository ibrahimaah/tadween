@extends('layouts.main_app')

@section('pageTitle')
{{$data['name']}}
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<style>
    .dots-btn {
        background: none;
        border: none;
        font-size: 24px;
        padding: 5px;
        cursor: pointer;
        transition: opacity 0.2s ease-in-out;
    }
    .dots-btn:hover,
    .dots-btn:focus {
        opacity: 0.7;
    }
    .last-selected {
        border-color: #ff6600 !important;  /* or any distinct color */
        box-shadow: 10px 10px 15px #ff6600;       /* optional glow */
    }
</style>




<div class="profile">

    <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
        <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
    </div>

    <x-page-header title="{{$data['name']}}" route="home" />


   <div class="container bg-white">
    <div class="row">

        
        <div class="col-12">
           <div style="height: 200px !important">
                @if($data['background_image'])
                <img class="object-fit-cover profile_background_image" 
                     src="{{ $data['background_image'] }}"
                     alt="Cover Image"
                >
                @else  
                <img class="object-fit-contain profile_background_image w-100" 
                     src="{{ asset('img/logo.png') }}"
                     alt="Tadween logo..."
                >
                @endif
           </div>
        </div>
       

        <div class="row">
            <div class="col-12">
                @if (!$data['is_owner'])
                    @if(!$data['is_been_blocked'])
                        <div id="follow{{$data['username']}}" class="text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                            
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="dropdown">
                                    <button class="dots-btn text-orange-color" 
                                            type="button" 
                                            id="dropdownMenuButton" 
                                            data-bs-toggle="dropdown">
                                        &#x22EF; <!-- Horizontal Ellipsis -->
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end text-{{ app()->getLocale() == 'ar' ? 'end' : 'start' }}">
                                        
                                        
                                        @if($data['is_blocked'])
                                        <li>
                                            <form action="{{ route('users.unblock') }}" method="POST" class="unblock-user-form">
                                                @csrf
                                                <input type="hidden" name="username" value="{{ $data['username'] }}" required>
                                                <button type="button" class="dropdown-item unblock-button" data-bs-toggle="modal" data-bs-target="#confirmUnblockModal">
                                                    <i class="fas fa-ban text-orange-color"></i> {{ __('profile.unblock_this_user') }}
                                                </button>
                                            </form>
                                        </li>
                                        @else
                                        @if(!$data['can_not_see_followings'])
                                        <li>
                                            <a href="{{ route('followings.index', $data['username']) }}" class="dropdown-item">
                                                <i class="fa fa-users text-orange-color"></i>
                                                {{ __('profile.view_following') }}
                                            </a>
                                        </li>
                                        @endif
                                        @if(!$data['can_not_see_followers'])
                                        <li>
                                            <a href="{{ route('followers.index', $data['username']) }}" class="dropdown-item">
                                                <i class="fa fa-users text-orange-color"></i>
                                                {{ __('profile.view_followers') }}
                                            </a>
                                        </li>
                                        @endif
                                        
                                        <li id="copy-link" class="{{ !$data['can_not_see_followers'] ? 'border border-start-0 border-end-0' : '' }}" style="cursor: pointer">
                                            <p class="dropdown-item mb-1">
                                                <i class="fa fa-copy text-orange-color"></i>
                                                <span>{{ __('messages.copy_link') }}</span>
                                            </p>
                                        </li>
                                        <li>
                                            <form action="{{ route('users.block') }}" method="POST" class="block-user-form">
                                                @csrf
                                                <input type="hidden" name="username" value="{{ $data['username'] }}" required>
                                                <button type="button" class="dropdown-item block-button" data-bs-toggle="modal" data-bs-target="#confirmBlockModal">
                                                    <i class="fas fa-ban text-orange-color"></i> {{ __('profile.block_this_user') }}
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                            
                                        
                                        
                                    </ul>
                                    
                                </div>
                             
                                @if($data['is_blocked'])
                                    <form action="{{ route('users.unblock') }}" method="POST" class="unblock-user-form">
                                        @csrf
                                        <input type="hidden" name="username" value="{{ $data['username'] }}" required>
                                        <button type="button" class="btn btn-orange text-white unblock-button" data-bs-toggle="modal" data-bs-target="#confirmUnblockModal">
                                            <i class="fas fa-ban text-orange-color"></i> {{ __('profile.unblock_this_user') }}
                                        </button>
                                    </form>
                                @else 

                                    <span class="text-orange-color d-block px-2" style="cursor:pointer !important" data-bs-toggle="modal" data-bs-target="#giftModal"> 
                                        <i class="fa fa-gift"></i>
                                    </span>

                                    <a href="{{ route('messages.chat', ['username' => $data['username']]) }}" class="btn text-light">
                                        <i class="fa-regular fa-comments text-orange-color"></i>
                                    </a>

                                    <button type="button" class="btn btn-orange text-light" onclick="followUser('{{$data['username']}}')">
                                        <span class="follow_text_btn">
                                            {{ $data['follow_btn_status_text'] }}
                                        </span>
                                    </button>
                                @endif 
                            </div>
                           

                           

                        </div>
                    @endif 
                @endif
            </div>
        </div>
    </div>
   </div>




    <div class="container bg-white pb-2">
        <div class="row gap-2">
        
            <div class="col-12">
                <img class="cover_image border border-4 border-white rounded-circle mx-3 mb-1"
                     src="{{ asset($data['cover_image']) }}"
                     alt="Tadween logo..." 
                     width="100">
    
                <h3 class="h5">
                    {{$data['name']}} 
                    {!! $data['is_private'] ? '<i class="fa-solid fa-lock text-orange-color"></i>' : '' !!}
                </h3>
                
                <span class="text-muted" id="getUserName" data-get-username="{{ $data['username'] }}">
                    {{ app()->getLocale() == 'ar' ? $data['username'].'@' : '@'.$data['username'] }}
                </span>
            </div>
    
            <div class="col-12 align-items-center">
                <div class="d-flex gap-3">

                    @if(!$data['can_not_see_followings'])
                    <a href="{{ $data['can_not_see_followings'] ? '#' : route('followings.index', $data['username']) }}" class="text-decoration-none">
                        <p class="text-orange-color mb-0">
                            {{ $data['following_count'] }}
                            <span class="text-grey fw-bold">{{ __('profile.profile_following') }}</span>
                        </p>
                    </a>
                    @else    
                        <p class="text-orange-color">
                            {{ $data['following_count'] }}
                            <span class="text-grey fw-bold">{{ __('profile.profile_following') }}</span>
                        </p>
                    @endif
                
                    @if(!$data['can_not_see_followers'])
                    <a href="{{ route('followers.index', $data['username']) }}" class="text-decoration-none">
                        <p class="text-orange-color mb-0">
                            <span class="follower_count">{{ $data['follower_count'] }}</span>
                            <span class="text-grey fw-bold">{{ __('profile.profile_followers') }}</span>
                        </p>
                    </a>
                    @else    
                    <p class="text-orange-color">
                        <span class="follower_count">{{ $data['follower_count'] }}</span>
                        <span class="text-grey fw-bold">{{ __('profile.profile_followers') }}</span>
                    </p>
                    @endif
                    

                    @if(!$data['can_not_see_gifts'])
                    <a href="{{ route('profile.gifts.index', $data['username']) }}" class="text-decoration-none">
                        <p class="text-orange-color mb-0">
                            {{ $data['received_gifts'] }}
                            <span class="text-grey fw-bold">{{ __('gifts.title') }}</span>
                        </p>
                    </a>
                    @else    
                        <p class="text-orange-color">
                            <span class="gifts_count">{{ $data['received_gifts'] }}</span>
                            <span class="text-grey fw-bold">{{ __('gifts.title') }}</span>
                        </p>
                    @endif
                </div>
            </div>
    
            @if($data['bio'])
            <div class="col-12">
                <h3 class="text-grey lh-base">{{$data['bio']}}</h3>
            </div>
            @endif
    
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <i class="fa-solid fa-earth-americas text-grey"></i>
                        <span class="text-muted">{{$data['country']}} / {{$data['city']}}</span>
                    </div>
                    <div class="col-md-6">
                        <i class="fa-solid fa-calendar-days text-grey"></i>
                        <span class="text-muted">{{$data['registered_since']}}</span>
                    </div>
                </div>
            </div>
    
        </div>
    </div>

    @if(!$data['is_profile_locked'] && !$data['is_blocked'] && !$data['is_been_blocked'])
        <div class="container bg-white py-2">
            <div class="row text-center">
            
                <ul class="nav nav-pills nav-fill row">
                    <li class="nav-item col-6 col-sm-3">
                        <button class="nav-link tab-link active" data-tab="userPosts">{{ __('profile.profile_blogs') }}</button>
                    </li>
                    <li class="nav-item col-6 col-sm-3">
                        <button class="nav-link tab-link" data-tab="userPostsReplies">{{ __('profile.profile_replies') }}</button>
                    </li>
                    <li class="nav-item col-6 col-sm-3">
                        <button class="nav-link tab-link" data-tab="userPostsMedia">{{ __('profile.profile_media') }}</button>
                    </li>
                    <li class="nav-item col-6 col-sm-3">
                        <button class="nav-link tab-link" data-tab="userPostsLikes">{{ __('profile.profile_likes') }}</button>
                    </li>
                </ul>
            </div>
        </div>
    @endif


     
    

    @if(!$data['is_profile_locked'] && !$data['is_blocked'] && !$data['is_been_blocked'])
        <!-- HTML to display posts -->
        <p class="text-center text-muted empty_posts d-none my-5 p-3">{{__('home.posts_empty')}}</p>

        <div class="post-container mt-3" id="display-posts-container"></div>
        <!-- Loading Spinner -->
        <div class="d-none justify-content-center my-3" id="posts_loading_indicator">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>


        <!-- Bootstrap Delete Confirmation Post Modal -->
        {{-- @include('posts.delete_post_modal',['slugId' => $data['slug_id']])  --}}
        @include('posts.delete_post_modal') 

       
    @endif

    @if($data['is_profile_locked'] && !$data['is_blocked'] && !$data['is_been_blocked'])
        <div class="text-center">
            <div class="card p-4">
                <h3 class="text-center"><i class="fas fa-lock text-orange-color"></i></h3>
                <h4 class="text-orange-color">{{ __('profile.protected_posts') }}</h4>
                <p class="mt-3">
                    {{ __('profile.only_followers_can_access', ['username' => $data['username']]) }}
                </p>
            </div>
        </div>
    @endif 



    @if($data['is_blocked'])
        <div class="text-center">
            <div class="card p-4">
                <h3 class="text-center"><i class="fas fa-ban text-orange-color"></i></h3>
                <h4 class="text-orange-color">{{ __('profile.user_blocked') }}</h4>
                <p class="mt-3">
                    {{ __('profile.blocked_user_message') }}
                </p>
            </div>
        </div>
    @endif

    @if($data['is_been_blocked'])
        <div class="text-center">
            <div class="card p-4">
                <h3 class="text-center"><i class="fas fa-ban text-orange-color"></i></h3>
                <h4 class="text-orange-color">{{ __('profile.blocked_title') }}</h4>
                <p class="mt-3">
                    {{ __('profile.blocked_message') }}
                </p>
            </div>
        </div>
    @endif

 
    <x-modal 
        id="confirmBlockModal" 
        title="{{ __('profile.are_you_sure_block') }}" 
        message="{{ __('profile.block_confirmation_message') }}" 
        confirmButtonId="confirmBlockButton" 
    />

    <x-modal 
        id="confirmUnblockModal" 
        title="{{ __('profile.are_you_sure_unblock') }}" 
        message="{{ __('profile.unblock_confirmation_message') }}" 
        confirmButtonId="confirmUnblockButton" 
    />


</div>


@include('profile.partials._modal_send_gift')

@endsection

@section('java_scripts')
    @if(!$data['is_profile_locked'])
            <script src="{{asset('js/posts/display_posts.js?version=1.0')}}"></script>
            <script src="{{asset('js/posts/post_like.js?version=1.0')}}"></script>
            @auth
                <script src="{{asset('js/posts/delete_post.js?version=1.0')}}"></script>
                {{-- <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script> --}}
            @endauth
    @endif

    
    
    @push('js')
    <script src="{{asset('js/users/follow_user.js?version=1.0')}}"></script>
    <script>
        // Toastr global options
        toastr.options = {
            positionClass: "toast-top-center",
            closeButton: true,
            progressBar: true
        };
    </script>
    <script>
                
    $(document).ready(function() {
        // Handle block confirmation
        $('#confirmBlockButton').on('click', function() 
        {
            $('.block-user-form').submit();
        });

        // Handle unblock confirmation
        $('#confirmUnblockButton').on('click', function() {
            $('.unblock-user-form').submit();
        });

        $('#copy-link').on('click', function () {
            const profileLink = "{{ route('profile', $data['username']) }}"; // or however you get the profile link
            

            navigator.clipboard.writeText(profileLink).then(() => {
                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-bottom-left",  // Position the toast bottom-left
                                    "preventDuplicates": true,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };
                toastr.success("{{ __('messages.link_copied') }}");
            });
        });
    });

     
                        
    </script>


<script>
    $(document).ready(function () {
        let selectedIcon = null;
        const gifts_preloader = $('#gifts_preloader');
        const modal_container= $('.modal-body-container');
        const userId = @json(auth()->id());

        const resetSendGiftModal = () => {
            // $('#gift_price_spinner').hide();
            $('#gift_price_spinner').css('visibility', 'hidden');
            $('#textAreaGiftMsg').val('');
            $('#gift_price_note').show();
            $('#gift_price').html('');
            $('#confirmGiftBtn').prop('disabled', true);
        }

        const refreshUserWalletBalance = () => {
            
            $.ajax({
                url:`get-user-balance/${userId}`,
                method:'GET',
                beforeSend:function(){
                    $('#userBalance').addClass('d-none');
                    // $('#userBalance_spinner').show();
                    $('#userBalance_spinner').css('visibility', 'visible');
                },
                success:function(response){
                    if(response.success)
                    {
                        $('#userBalance').html(response.data + '$');
                    }
                    else 
                    {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                        console.error('Error fetching user balance:', error);
                        
                        // Show a generic error message
                        toastr.error('Something went wrong while refreshing the balance.');

                        // Optionally, show detailed error if available (e.g., from your Laravel API)
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message);
                        }
                    },
                complete:function(){
                    // $('#userBalance_spinner').hide();
                    $('#userBalance_spinner').css('visibility', 'hidden');
                    $('#userBalance').removeClass('d-none');
                }
            });
        }

        // Open modal & load icons
        $('#giftModal').on('show.bs.modal', function () 
        { 
            resetSendGiftModal();
            refreshUserWalletBalance();
            $.ajax({
                url: "{{ route('gifts.index') }}",  // Or just '/gifts' if in JS file
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                    if(gifts_preloader.hasClass('d-none'))
                    {
                        gifts_preloader.removeClass('d-none');
                    }
                    if(!modal_container.hasClass('d-none'))
                    {
                        modal_container.addClass('d-none');
                    }
                    
                },
                success: function(response) {
                    if(response.success) {
                        const $container = $('#giftsContainer');
                        $container.empty();

                        response.data.forEach(function(gift) {
                            const iconHtml = `
                                <div class="col-3 mb-3">
                                    <img src="${gift.icon_url}" 
                                        data-gift-id="${gift.id}" 
                                        class="img-fluid gift-icon" 
                                        style="cursor: pointer;">
                                </div>
                            `;
                            $container.append(iconHtml);
                        });

                        // gifts_preloader.addClass('d-none');
                        // modal_container.removeClass('d-none');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                },
                complete:function(){
                    if(!gifts_preloader.hasClass('d-none'))
                    {
                        gifts_preloader.addClass('d-none');
                    }
                    if(modal_container.hasClass('d-none'))
                    {
                        modal_container.removeClass('d-none');
                    }
                }
            });

            
        });
    

        let selectedGiftIconIds = [];
        let selectedGiftDetails = {}; // { giftId: { msg: '', visibility: 'PUBLIC' } }
        let lastSelectedGiftId = null;
        let totalPrice = 0;

        function renderLastSelectedGiftInput() {
            const container = $('#lastGiftInputs');
            container.empty();

            if (!lastSelectedGiftId || !selectedGiftDetails[lastSelectedGiftId]) {
                container.addClass('d-none');
                return;
            }

            const details = selectedGiftDetails[lastSelectedGiftId];
            const giftInputHtml = `
                <div class="mb-3 p-3 border rounded" data-gift-input-id="${lastSelectedGiftId}">
                    <h6>{{ __('gifts.customize_gift') }} #${lastSelectedGiftId}</h6>

                    
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            
                            <div class="form-check-input mt-2">
                                <input class="form-check-input gift-visibility" type="radio" 
                                    name="visibility_${lastSelectedGiftId}" value="{{ App\Constants\UserGiftVisibility::PUBLIC }}" ${details.visibility === '{{ App\Constants\UserGiftVisibility::PUBLIC }}' ? 'checked' : ''}>
                                <label class="form-check-label" style="font-size:14px !important">{{ __('gifts.public_gift_label') }}</label>
                            </div>
                            <div class="form-check-input">
                                <input class="form-check-input gift-visibility" type="radio" 
                                    name="visibility_${lastSelectedGiftId}" value="{{ App\Constants\UserGiftVisibility::PRIVATE }}" ${details.visibility === '{{ App\Constants\UserGiftVisibility::PRIVATE }}' ? 'checked' : ''}>
                                <label class="form-check-label" style="font-size:14px !important">{{ __('gifts.private_gift_label') }}</label>
                            </div>
                            <div class="form-check-input">
                                <input class="form-check-input gift-visibility" type="radio" 
                                    name="visibility_${lastSelectedGiftId}" value="{{ App\Constants\UserGiftVisibility::ANONYMOUS }}" ${details.visibility === '{{ App\Constants\UserGiftVisibility::ANONYMOUS }}' ? 'checked' : ''}>
                                <label class="form-check-label" style="font-size:14px !important">{{ __('gifts.anonymous_gift_label') }}</label>
                            </div>    
                        </div>
                        <div class="col-md-4">
                            <textarea class="form-control gift-msg" 
                                data-gift-id="${lastSelectedGiftId}" 
                                rows="2" maxlength="25" 
                                placeholder="{{ __('gifts.enter_msg') }}">${details.msg ?? ''}</textarea>
                        </div>
                      
                    </div>
                </div>
            `;

            container.removeClass('d-none').append(giftInputHtml);
        }




        $(document).on('click', '.gift-icon', function () {
            const giftId = $(this).data('gift-id');
            const isSelected = selectedGiftIconIds.includes(giftId);

            if (isSelected) {
                selectedGiftIconIds = selectedGiftIconIds.filter(id => id !== giftId);
                $(this).removeClass('border border-orange border-3 last-selected');
                lastSelectedGiftId = selectedGiftIconIds[selectedGiftIconIds.length - 1] || null;
            } else {
                selectedGiftIconIds.push(giftId);
                if (!selectedGiftDetails[giftId]) {
                    selectedGiftDetails[giftId] = { msg: '', visibility: '{{ App\Constants\UserGiftVisibility::PUBLIC }}' };
                }
                $(this).addClass('border border-orange border-3');
                lastSelectedGiftId = giftId;
            }

            $('.gift-icon.border-orange.last-selected').removeClass('last-selected');
            if (lastSelectedGiftId) {
                $(`.gift-icon[data-gift-id="${lastSelectedGiftId}"]`).addClass('last-selected');
            }

            if (selectedGiftIconIds.length === 0) {
                $('#gift_price_note').show();
                $('#gift_price').html('');
                $('#confirmGiftBtn').prop('disabled', true);
                $('#lastGiftInputs').addClass('d-none').empty();
                return;
            } else {
                $('#gift_price_note').hide();
                $('#confirmGiftBtn').prop('disabled', false);
            }

            renderLastSelectedGiftInput();

            $('#gift_price_spinner').css('visibility', 'visible');
            $('#gift_price').html('');
            totalPrice = 0;
            let requestsCompleted = 0;

            selectedGiftIconIds.forEach(giftId => {
                $.ajax({
                    url: `/gifts/${giftId}/price`,
                    method: 'GET',
                    success: function (response) {
                        if (response.success) {
                            totalPrice += parseFloat(response.data.price);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    complete: function () {
                        requestsCompleted++;
                        if (requestsCompleted === selectedGiftIconIds.length) {
                            $('#gift_price_spinner').css('visibility', 'hidden');
                            $('#gift_price').html(`${totalPrice}$`);
                        }
                    }
                });
            });
        });


    
         // Update values on input
         $(document).on('input', '.gift-msg', function () {
            const giftId = $(this).data('gift-id');
            if (selectedGiftDetails[giftId]) {
                selectedGiftDetails[giftId].msg = $(this).val();
            }
        });

        $(document).on('change', '.gift-visibility', function () {
            const giftId = $('#lastGiftInputs [data-gift-input-id]').data('gift-input-id');
            if (selectedGiftDetails[giftId]) {
                selectedGiftDetails[giftId].visibility = $(this).val();
            }
        });

        $('#confirmGiftBtn').click(function () {
        const receiver_id = $('#receiver_id').val();

        if (selectedGiftIconIds.length === 0) {
            toastr.error(@json(__('gifts.please_select_at_least_one_gift')));
            return;
        }

        const giftsToSend = selectedGiftIconIds.map(giftId => ({
            gift_id: giftId,
            msg: selectedGiftDetails[giftId]?.msg || '',
            visibility: selectedGiftDetails[giftId]?.visibility || '{{ App\Constants\UserGiftVisibility::PUBLIC }}'
        }));

        $.ajax({
            url: "{{ route('gifts.send') }}",
            method: "POST",
            data: {
                gifts: giftsToSend,
                receiver_id: receiver_id,
                totalPrice: totalPrice,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                if (response.success) {
                    toastr.success("{{ __('gifts.send_success') }}");
                    $('#giftModal').modal('hide');
                    selectedGiftIconIds = [];
                    selectedGiftDetails = {};
                    lastSelectedGiftId = null;
                } else {
                    toastr.error(response.message);
                }
            },
            error: function () {
                toastr.error("{{ __('gifts.something_went_wrong') }}");
            }
        });
    });

    });
</script>
    
    @endpush
   
    

@endsection