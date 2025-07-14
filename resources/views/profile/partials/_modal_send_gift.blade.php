<div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="giftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div id="modalPreloader"
                class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75 d-none"
                style="z-index: 1051;">
                <div class="spinner-border text-orange-color" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title text-orange-color" id="giftModalLabel">{{ __('gifts.select_gift') }}</h5>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" id="receiver_id" name="receiver_id" value="{{ $data['user_id'] }}" />
                <div class="d-flex justify-content-center" id="gifts_preloader">
                    <div class="spinner-border text-orange-color" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div class="modal-body-container d-none">
                    <div class="row" id="giftsContainer">
                        <!-- Icons will be loaded here -->
                    </div>
                </div>
            </div>

            <div class="container mb-1 p-2">

                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-flex flex-column">

                            <div>
                                <input class="form-check-input" type="radio" name="userGiftVisibility"
                                    id="flexRadioDefault1" value="{{ App\Constants\UserGiftVisibility::PUBLIC }}"
                                    checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{ __('gifts.public_gift_label') }}
                                </label>
                            </div>

                            <div>
                                <input class="form-check-input" type="radio" name="userGiftVisibility"
                                    value="{{ App\Constants\UserGiftVisibility::PRIVATE }}" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    {{ __('gifts.private_gift_label') }} </label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="userGiftVisibility"
                                    id="flexRadioDefault3" value="{{ App\Constants\UserGiftVisibility::ANONYMOUS }}">
                                <label class="form-check-label" for="flexRadioDefault3">
                                    {{ __('gifts.anonymous_gift_label') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mt-3 mb-1">
                            <textarea class="form-control" id="textAreaGiftMsg" rows="2"
                                placeholder="{{ __('gifts.enter_msg') }}" maxlength="25"></textarea>
                                <label for="textAreaGiftMsg" class="form-label text-muted d-block mt-1" id="giftMsgLabel">
                                    0/25
                                </label>
                        </div>
                    </div>
                </div>

                <div class="row align-items-end">

                    <div class="col-md-8">

                        <span class="d-block">🎁 {{ __('gifts.selected_gift_price') }}:
                            <span id="gift_price_note" class="small form-text text-muted">{{
                                __('gifts.select_gift_to_get_price') }}</span>
                            <strong>
                                <span id="gift_price" class="text-success"></span>
                            </strong> 
                        </span>



                        <span class="d-block">💵 {{ __('gifts.total_price') }}:
                            <strong>
                                <span id="total_price" class="text-success">0$</span>
                            </strong> 
                        </span>



                        <span class="d-block">💰 {{ __('gifts.your_wallet_balance') }}:
                            <strong id="userBalance" class="d-none text-success"></strong>
                            <div class="spinner-border text-orange-color" id="userBalance_spinner" role="status"
                                style="visibility: hidden;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </span>
                    </div>

                    <div class="col-md-4">
                        <div class="modal-actions text-start">
                            <button id="confirmGiftBtn" class="btn btn-orange" disabled>{{ __('gifts.confirm')
                                }}</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{
                                __('wallet.cancel')
                                }}</button>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
</div>
 

@push('js')
<script>
$(document).ready(function () {
    const userId = @json(auth()->id());
    const $giftsPreloader = $('#gifts_preloader');
    const $modalContainer = $('.modal-body-container');
    let selectedGiftId = null;
    let selectedGiftPrice = 0;
    let giftCount = 1;

    // Character counter for message textarea
    const maxLength = 25;
    $('#textAreaGiftMsg').on('input', function () {
        const currentLength = $(this).val().length;
        $('#giftMsgLabel').text(`${currentLength}/${maxLength}`);
    });

    const resetSendGiftModal = () => {
        // Reset selected gift
        $('.gift-icon').removeClass('selected-gift');
        selectedGiftId = null;
        selectedGiftPrice = 0;
        giftCount = 1;
        
        // Reset UI elements
        $('#gift_price_note').text("{{ __('gifts.select_gift_to_get_price') }}");
        $('#gift_price').text('');
        $('#total_price').text('0$');
        $('#confirmGiftBtn').prop('disabled', true);
    };

    const refreshUserWalletBalance = () => {
        $.ajax({
            url: `get-user-balance/${userId}`,
            method: 'GET',
            beforeSend: () => {
                $('#userBalance').addClass('d-none');
                $('#userBalance_spinner').css('visibility', 'visible');
            },
            success: (response) => {
                if (response.success) {
                    $('#userBalance').html(response.data + '$');
                } else {
                    toastr.error(response.message);
                }
            },
            error: (xhr) => {
                toastr.error('Something went wrong while refreshing the balance.');
                if (xhr.responseJSON?.message) {
                    toastr.error(xhr.responseJSON.message);
                }
            },
            complete: () => {
                $('#userBalance_spinner').css('visibility', 'hidden');
                $('#userBalance').removeClass('d-none');
            }
        });
    };

    // Update total price display
    const updateTotalPrice = () => {
        const totalPrice = selectedGiftPrice * giftCount;
        $('#total_price').text(totalPrice + '$');
    };

    const renderGifts = () => {
        $.ajax({
            url: "{{ route('gifts.index') }}",
            type: 'GET',
            dataType: 'json',
            beforeSend: () => {
                $giftsPreloader.removeClass('d-none');
                $modalContainer.addClass('d-none');
            },
            success: function (response) {
                if (response.success) {
                    const $container = $('#giftsContainer');
                    $container.empty();

                    response.data.forEach(gift => {
                        $container.append(`
                            <div class="col-3 mb-1 px-1">
                                <img src="${gift.icon_url}" 
                                     data-gift-id="${gift.id}" 
                                     data-gift-price="${gift.price}"
                                     class="img-fluid d-block m-0 p-0 gift-icon" 
                                     style="cursor: pointer;">
                            </div>
                        `);
                    });
                } else {
                    toastr.error(response.message);
                }
            },
            error: (xhr, status, error) => {
                console.error('AJAX error:', error);
            },
            complete: () => {
                $giftsPreloader.addClass('d-none');
                $modalContainer.removeClass('d-none');
            }
        });
    }
    // On modal open
    $('#giftModal').on('show.bs.modal', function () {
        resetSendGiftModal();
        refreshUserWalletBalance();
        renderGifts();
    });

    // On modal close
    $('#giftModal').on('hidden.bs.modal', function () {
        resetSendGiftModal();
    });

    // Gift icon click handler
    $(document).on('click', '.gift-icon', function () {
        const $icon = $(this);
        
        // Remove selected class from all gifts
        $('.gift-icon').removeClass('selected-gift');
        
        // Add selected class to clicked gift
        $icon.addClass('selected-gift');
        
        // Update selected gift info
        selectedGiftId = $icon.data('gift-id');
        selectedGiftPrice = parseFloat($icon.data('gift-price'));
        
        // Update UI
        $('#gift_price_note').text('');
        $('#gift_price').text(selectedGiftPrice + '$');
        updateTotalPrice();
        
        // Enable confirm button
        $('#confirmGiftBtn').prop('disabled', false);
    });

    // Add some CSS for the selected gift
    const style = document.createElement('style');
    style.innerHTML = `
        .selected-gift {
            border: 3px solid #ff6b00 !important;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 107, 0, 0.5);
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush