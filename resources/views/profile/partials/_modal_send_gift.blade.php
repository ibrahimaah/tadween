@php
    use App\Constants\UserGiftVisibility;
@endphp
<style>
    .selected-gift {
        border: 2px solid #ccc !important;
        border-radius: 8px;
    }
    
    .last-selected-gift {
        border: 3px solid #ff6b00 !important;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(255, 107, 0, 0.5);
    }
    
    .gift-item {
        position: relative;
    }
</style>
<div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="giftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
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
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="userGiftVisibility" 
                                       value="{{ UserGiftVisibility::PUBLIC }}"
                                       checked>
                                <label class="form-check-label">
                                    {{ __('gifts.public_gift_label') }}
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="userGiftVisibility"
                                       value="{{ UserGiftVisibility::PRIVATE }}">
                                <label class="form-check-label">
                                    {{ __('gifts.private_gift_label') }} 
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input"
                                       type="radio" 
                                       name="userGiftVisibility"
                                       value="{{ UserGiftVisibility::ANONYMOUS }}">
                                <label class="form-check-label">
                                    {{ __('gifts.anonymous_gift_label') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="mt-3 mb-1">
                            <textarea class="form-control" 
                                      name="msg" 
                                      id="msg" 
                                      rows="2"
                                      placeholder="{{ __('gifts.enter_msg') }}" 
                                      maxlength="25"></textarea>
                            <label for="msg" class="form-label text-muted d-block mt-1" id="giftMsgLabel">
                                0/25
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-md-8">
                        <div id="selectedGiftsList" class="mb-2">
                            <!-- Selected gifts will be listed here -->
                        </div>

                        <span class="d-block">🎁 {{ __('gifts.last_selected_gift') }}:
                            <span id="gift_price_note" class="small form-text text-muted">
                                {{ __('gifts.select_gift_to_get_price') }}
                            </span>
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
                                style="visibility: hidden;width:15px;height:15px">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </span>
                    </div>

                    <div class="col-md-4">
                        <div class="modal-actions text-start">
                            <button id="confirmGiftBtn" class="btn btn-orange" disabled>{{ __('gifts.confirm') }}</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('wallet.cancel') }}</button>
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
    let selectedGifts = []; // Array to store selected gifts
    let lastSelectedGiftId = null;

    // Character counter for message textarea
    const maxLength = 25;
    $('#msg').on('input', function () {
        const currentLength = $(this).val().length;
        $('#giftMsgLabel').text(`${currentLength}/${maxLength}`);
    });

    const resetSendGiftModal = () => {
        // Reset selected gifts
        $('.gift-icon').removeClass('selected-gift last-selected-gift');
        selectedGifts = [];
        lastSelectedGiftId = null;
        
        // Reset UI elements
        $('#selectedGiftsList').empty();
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
        const totalPrice = selectedGifts.reduce((sum, gift) => sum + gift.price, 0);
        $('#total_price').text(totalPrice + '$');
        $('#confirmGiftBtn').prop('disabled', selectedGifts.length === 0);
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
                            <div class="col-3 mb-3 px-1">
                                <div class="gift-item">
                                    <img src="${gift.icon_url}" 
                                         data-gift-id="${gift.id}" 
                                         data-gift-price="${gift.price}"
                                         data-gift-name="${gift.name}"
                                         class="img-fluid d-block m-0 p-1 gift-icon" 
                                         style="cursor: pointer;">
                                </div>
                            </div>
                        `);
                    });
                } else {
                    toastr.error(response.message);
                }
            },
            error: (xhr, status, error) => {
                console.error('AJAX error:', error);
                toastr.error('Failed to load gifts');
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

    // Gift icon click handler - toggles selection
    $(document).on('click', '.gift-icon', function () {
        const $icon = $(this);
        const giftId = $icon.data('gift-id');
        const giftPrice = parseFloat($icon.data('gift-price'));
        const giftName = $icon.data('gift-name');
        
        // Check if gift is already selected
        const existingGiftIndex = selectedGifts.findIndex(g => g.id === giftId);
        
        if (existingGiftIndex >= 0) {
            // Gift already selected - remove it
            selectedGifts.splice(existingGiftIndex, 1);
            
            // Update last selected gift if we removed it
            if (lastSelectedGiftId === giftId) {
                lastSelectedGiftId = selectedGifts.length > 0 ? selectedGifts[selectedGifts.length - 1].id : null;
            }
        } else {
            // Add new gift to selection
            selectedGifts.push({
                id: giftId,
                price: giftPrice,
                name: giftName,
                icon_url: $icon.attr('src')
            });
            
            // Update last selected gift
            lastSelectedGiftId = giftId;
        }
        
        // Update UI
        updateGiftSelectionUI(); 
        updateTotalPrice();
        updateLastSelectedGiftPrice();
    });
    
     
    
    // Update the last selected gift price display
    const updateLastSelectedGiftPrice = () => {
        if (lastSelectedGiftId) {
            const lastGift = selectedGifts.find(g => g.id === lastSelectedGiftId);
            if (lastGift) {
                $('#gift_price_note').text('');
                $('#gift_price').text(lastGift.price + '$');
                return;
            }
        }
        $('#gift_price_note').text("{{ __('gifts.select_gift_to_get_price') }}");
        $('#gift_price').text('');
    };
    
    // Update the visual selection state of gifts
    const updateGiftSelectionUI = () => {
        // Remove all selection classes first
        $('.gift-icon').removeClass('selected-gift last-selected-gift');
        
        // Add appropriate classes
        selectedGifts.forEach(gift => {
            const $giftElement = $(`.gift-icon[data-gift-id="${gift.id}"]`);
            $giftElement.addClass('selected-gift');
            
            // Highlight last selected gift
            if (gift.id === lastSelectedGiftId) {
                $giftElement.addClass('last-selected-gift');
            }
        });
    };
});
</script>
@endpush