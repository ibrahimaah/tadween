@extends('layouts.main_app')

@section('pageTitle')
    {{ __('gifts.title') }}
@endsection


@push('styles')
    <style>
        /* .hidden-gift::after {
            content: "{{ __('gifts.hidden') }}";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold; 
        } */
    </style>
    <link rel="stylesheet" href="{{ asset('css/gifts/gifts_styles.css') }}">  
@endpush

@section('content')


<div class="user_gifts">

    <x-page-header title="gifts.title" />

    <div class="bg-white mt-2 rounded-top-4">

        <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
            <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
        </div>

        <div class="row p-3 g-4 mt-2 mb-4" id="giftsContainer"></div>
        
        <p class="text-center text-muted empty_gifts d-none my-5 p-3">{{__('gifts.no_gifts')}}</p>

    </div>

    <x-modal 
        id="confirmModal" 
        title="{{ __('gifts.ensure_msg') }}" 
        message="" 
        confirmButtonId="confirmBtn" 
    />


</div>
@endsection

@section('java_scripts') 
<script>
    $(document).ready(function () {
        const giftsContainer = $('#giftsContainer');
        const emptyMessage = $('.empty_gifts');
        const loadingIndicator = $('#pullToRefreshIndicator');
        const currentAuthId = "{{ auth()->id() }}";
        // alert( window.location.href)
        function loadGifts() {
            loadingIndicator.removeClass('d-none');
            
            $.ajax({
                url: window.location.href,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    loadingIndicator.addClass('d-none');

                    if (response.success && response.data.length > 0) {
                        emptyMessage.addClass('d-none');
                        renderGifts(response.data);
                    } else {
                        giftsContainer.empty();
                        emptyMessage.removeClass('d-none');
                        toastr.error(response.message)
                    }
                },
                error: function (xhr, status, error) {
                    loadingIndicator.addClass('d-none');
                    emptyMessage.removeClass('d-none').text("{{ __('general.something_went_wrong') }}");
                    console.error('AJAX Error:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        errorThrown: error,
                        fullXhr: xhr
                    });
                    toastr.error(`Error ${xhr.status}: ${xhr.statusText}`);
                }
            });
        }

        function renderGifts(giftsData) {
            giftsContainer.empty();
            
            giftsData.forEach(userGift => {
                // Skip hidden gifts if current user is not the receiver
                if (userGift.is_hidden == true && currentAuthId != userGift.receiverId) {
                    return;
                }

                let senderDisplay = '';
                const isReceiver = currentAuthId == userGift.receiverId;
                const isHidden = userGift.is_hidden == true;
                // const isHidden = true;

                if (userGift.visibility === 'anonymous') {
                    senderDisplay = `<h6 class='text-center'><span class="text-muted">{{ __('gifts.anonymous') }}</span></h6>`;
                } 
                else if(userGift.visibility === 'public' || (userGift.visibility == 'private' && isReceiver)) {
                    senderDisplay = `<h6 class='text-center'><span><a class='text-decoration-none text-orange-color' 
                                          href='/${userGift.senderUserName}'>${userGift.senderName}
                                        </a>
                                </span></h6>`;
                }
                else {
                    senderDisplay = `<h6 class='text-center'><span class="text-muted">{{ __('gifts.anonymous') }}</span></h6>`;
                }

                const hiddenClass = isHidden ? 'hidden-gift' : '';
                const hiddenStyle = isHidden ? 'style="opacity:0.6;"' : '';

                // Action buttons - only show if current user is the receiver
                let actionButtons = '';
                if (isReceiver) {
                 
                    const showAction = isHidden 
                        ? `<li><span class="dropdown-item show-gift" style="cursor:pointer" data-user-gift-id="${userGift.userGiftId}">
                            <i class="fas fa-eye me-2 text-secondary"></i> {{ __('gifts.show') }}
                           </span></li>`
                        : `<li><span class="dropdown-item hide-gift" style="cursor:pointer" data-user-gift-id="${userGift.userGiftId}">
                            <i class="fas fa-eye-slash me-2 text-secondary"></i> {{ __('gifts.hide') }}
                           </span></li>`;

                    actionButtons = `
                        <div class="gift-actions">
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    ${showAction}
                                    <li><span class="dropdown-item delete-gift" style="cursor:pointer" data-user-gift-id="${userGift.userGiftId}">
                                        <i class="fas fa-trash me-2 text-danger"></i> {{ __('gifts.delete') }}
                                    </span></li>
                                </ul>
                            </div>
                        </div>`;
                }

                const giftHtml = `
                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm ${hiddenClass}" ${hiddenStyle}>
                            ${actionButtons}
                            <img src="${userGift['giftIcon']}" class="card-img-top gift-img" alt="Gift">
                            <div class="card-body">
                                ${senderDisplay} 
                                <p class="card-text text-center">${userGift['msg']}</p>
                            </div>
                            <div class="card-footer bg-white text-center">
                                <small class="text-muted">${userGift['receive_date']}</small>
                            </div>
                        </div>
                    </div>`;

                giftsContainer.append(giftHtml);
            });

            // Add event handlers for the actions
            $('.hide-gift').click(function(e) {
                const userGiftId = $(this).data('user-gift-id'); 
                handleGiftAction('hide', userGiftId);
            });

            $('.show-gift').click(function(e) {
                const userGiftId = $(this).data('user-gift-id');
                handleGiftAction('show', userGiftId);
            });

            $('.delete-gift').click(function(e) {
                const userGiftId = $(this).data('user-gift-id');
                handleGiftAction('delete', userGiftId);
            });
        }

        function handleGiftAction(action, userGiftId) 
        {
            
            // Confirm before proceeding (except for show action)
            const messages = {
                show: "{{ __('gifts.are_you_sure_show') }}",
                hide: "{{ __('gifts.are_you_sure_hide') }}",
                delete: "{{ __('gifts.are_you_sure_delete') }}"
            }; 

            if (messages[action]) {
                
                $('#modal_msg').text(messages[action]);
                $('#user_gift_id').val(userGiftId);
                $('#gift_action').val(action);
                $('#confirmModal').modal('show');
            }

        }

        loadGifts();


        $(document).on('click','.confirm_btn',function()
        {
            let modal = $('#confirmModal'); // Replace with actual modal ID (e.g. #show_modal)
            let userGiftId = modal.find('#user_gift_id').val();
            let giftAction = modal.find('#gift_action').val();

            $.ajax({
                url: `/gifts/${userGiftId}/${giftAction}`,
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: 'POST'
                },
                beforeSend:function(){
                    giftsContainer.empty();
                    $('#modal_spinner').removeClass('d-none');
                    $('#modal_msg').addClass('d-none');
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        loadGifts(); // Refresh the list
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error("{{ __('general.something_went_wrong') }}");
                    console.error(xhr.responseText);
                },
                complete:function(){
                    $('#modal_spinner').addClass('d-none');
                    $('#modal_msg').removeClass('d-none');
                    modal.modal('hide');
                }
            });
        })

        
    });
</script>
@endsection