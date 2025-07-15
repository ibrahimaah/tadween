@php
    use App\Constants\UserGiftVisibility;
@endphp
<style>
    .selected-gift {
        border: 2px solid #0d6efd !important; /* Blue for selected */
        border-radius: 8px;
    }
    
    .last-selected-gift {
        border: 3px solid #ff6b00 !important; /* Orange for last selected/active */
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(255, 107, 0, 0.5);
    }
    
    .gift-item {
        position: relative;
    }

    /* Style for the remove button */
    .remove-gift-btn {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        padding: 0;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ddd;
    }
</style>

<div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="giftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content">

            {{-- Preloader remains the same --}}
            <div id="modalPreloader"
                 class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75 d-none"
                 style="z-index: 1051;">
                <div class="spinner-border text-orange-color" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            {{-- Modal Header remains the same --}}
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title text-orange-color" id="giftModalLabel">{{ __('gifts.select_gift') }}</h5>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Modal Body remains the same --}}
            <div class="modal-body">
                <input type="hidden" id="receiver_id" name="receiver_id" value="{{ $data['user_id'] }}" />
                <div class="d-flex justify-content-center" id="gifts_preloader">
                    <div class="spinner-border text-orange-color" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="modal-body-container d-none">
                    <div class="row" id="giftsContainer">
                        </div>
                </div>
            </div>

            {{-- Modal Footer Area (Updated) --}}
            <div class="container mb-1 p-2">
                <div class="row align-items-center">
                    {{-- Visibility and Message Controls --}}
                    <div class="col-md-7">
                        <div class="d-flex flex-column">
                            <div>
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="userGiftVisibility" 
                                       id="visibilityPublic"
                                       value="{{ UserGiftVisibility::PUBLIC }}"
                                       checked>
                                <label class="form-check-label" for="visibilityPublic">
                                    {{ __('gifts.public_gift_label') }}
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="userGiftVisibility" 
                                       id="visibilityPrivate"
                                       value="{{ UserGiftVisibility::PRIVATE }}">
                                <label class="form-check-label" for="visibilityPrivate">
                                    {{ __('gifts.private_gift_label') }} 
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input"
                                       type="radio" 
                                       name="userGiftVisibility"
                                       id="visibilityAnonymous"
                                       value="{{ UserGiftVisibility::ANONYMOUS }}">
                                <label class="form-check-label" for="visibilityAnonymous">
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
                                      placeholder="{{ __('gifts.enter_msg_for_active_gift') }}" {{-- Updated Placeholder --}}
                                      maxlength="25"
                                      disabled {{-- Disabled by default --}}
                                      ></textarea>
                            <label for="msg" class="form-label text-muted d-block mt-1" id="giftMsgLabel">
                                0/25
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row align-items-end">
                    {{-- Price and Balance Details --}}
                    <div class="col-md-8">
                        {{-- NEW: A list to show icons of all selected gifts --}}
                        <div id="selectedGiftsPreview" class="d-flex align-items-center flex-wrap mb-2" style="gap: 5px;">
                            </div>

                        <span class="d-block">🎁 {{ __('gifts.active_gift_price') }}:
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

                        {{-- Wallet balance display remains the same --}}
                        <span class="d-block">💰 {{ __('gifts.your_wallet_balance') }}:
                            <strong id="userBalance" class="d-none text-success"></strong>
                            <div class="spinner-border text-orange-color" id="userBalance_spinner" role="status"
                                 style="visibility: hidden;width:15px;height:15px">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </span>
                    </div>

                    {{-- Action Buttons --}}
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
    const $msgTextarea = $('#msg');
    const $giftMsgLabel = $('#giftMsgLabel');
    const $visibilityRadios = $('input[name="userGiftVisibility"]');
    const maxLength = 25;

    // --- Data Store ---
    let selectedGifts = []; // Array to store selected gift objects {id, price, name, icon_url, message, visibility}
    let activeGiftId = null; // The ID of the gift currently being edited

    // --- Core Functions ---

    const resetSendGiftModal = () => {
        selectedGifts = [];
        activeGiftId = null;
        
        // Reset UI
        $('#giftsContainer').empty();
        $('#selectedGiftsPreview').empty();
        updateTotalPrice();
        updateActiveGiftPrice();
        
        $msgTextarea.val('').prop('disabled', true);
        $giftMsgLabel.text(`0/${maxLength}`);
        $visibilityRadios.filter('[value="{{ UserGiftVisibility::PUBLIC }}"]').prop('checked', true); // Reset to public
        $('#confirmGiftBtn').prop('disabled', true);
    };

    const refreshUserWalletBalance = () => {
        // This function remains the same as your original
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

    const renderGifts = () => {
        // This function is slightly modified to include the remove button
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
                                    <button class="btn-close remove-gift-btn d-none" data-gift-id="${gift.id}"></button>
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
    };

    // --- UI Update Functions ---
    const updateTotalPrice = () => {
        const totalPrice = selectedGifts.reduce((sum, gift) => sum + gift.price, 0);
        $('#total_price').text(totalPrice + '$');
        $('#confirmGiftBtn').prop('disabled', selectedGifts.length === 0);
    };

    const updateActiveGiftPrice = () => {
        if (activeGiftId) {
            const activeGift = selectedGifts.find(g => g.id === activeGiftId);
            if (activeGift) {
                $('#gift_price_note').text('');
                $('#gift_price').text(activeGift.price + '$');
                return;
            }
        }
        $('#gift_price_note').text("{{ __('gifts.select_gift_to_get_price') }}");
        $('#gift_price').text('');
    };

    const updateGiftSelectionUI = () => {
        // Update selection state on the main grid
        $('.gift-icon').removeClass('selected-gift last-selected-gift');
        $('.remove-gift-btn').addClass('d-none');

        const $selectedGiftsPreview = $('#selectedGiftsPreview').empty();

        selectedGifts.forEach(gift => {
            const $giftElement = $(`.gift-icon[data-gift-id="${gift.id}"]`);
            $giftElement.addClass('selected-gift');
            $giftElement.siblings('.remove-gift-btn').removeClass('d-none');

            if (gift.id === activeGiftId) {
                $giftElement.addClass('last-selected-gift');
            }

            // NEW: Populate the preview area at the bottom
            $selectedGiftsPreview.append(
                `<img src="${gift.icon_url}" class="img-thumbnail" style="width: 40px; height: 40px;" title="${gift.name}">`
            );
        });
    };

    // --- New Function to populate controls for the active gift ---
    const populateControlsForActiveGift = () => {
        const activeGift = selectedGifts.find(g => g.id === activeGiftId);
        if (activeGift) {
            $msgTextarea.prop('disabled', false).val(activeGift.message);
            $giftMsgLabel.text(`${activeGift.message.length}/${maxLength}`);
            $visibilityRadios.filter(`[value="${activeGift.visibility}"]`).prop('checked', true);
        } else {
            $msgTextarea.prop('disabled', true).val('');
            $giftMsgLabel.text(`0/${maxLength}`);
        }
    };

    // --- Event Handlers ---

    // On modal open
    $('#giftModal').on('show.bs.modal', function () {
        resetSendGiftModal();
        refreshUserWalletBalance();
        renderGifts();
    });

    // Main gift icon click handler
    $(document).on('click', '.gift-icon', function () {
        const $icon = $(this);
        const giftId = $icon.data('gift-id');
        const existingGift = selectedGifts.find(g => g.id === giftId);

        if (!existingGift) {
            // Add new gift to selection
            selectedGifts.push({
                id: giftId,
                price: parseFloat($icon.data('gift-price')),
                name: $icon.data('gift-name'),
                icon_url: $icon.attr('src'),
                message: '', // Default message
                visibility: '{{ UserGiftVisibility::PUBLIC }}' // Default visibility
            });
        }

        // Set the clicked gift as the active one
        activeGiftId = giftId;
        
        updateUI();
    });
    
    // Deselect gift using the 'x' button
    $(document).on('click', '.remove-gift-btn', function (e) {
        e.stopPropagation(); // Prevent the parent .gift-item click from firing
        const giftIdToRemove = $(this).data('gift-id');

        // Remove from array
        selectedGifts = selectedGifts.filter(g => g.id !== giftIdToRemove);
        
        // If the removed gift was the active one, clear the active gift
        if (activeGiftId === giftIdToRemove) {
            activeGiftId = selectedGifts.length > 0 ? selectedGifts[selectedGifts.length - 1].id : null;
        }

        updateUI();
    });

    // Update message in the data store as user types
    $msgTextarea.on('input', function () {
        const currentLength = $(this).val().length;
        $giftMsgLabel.text(`${currentLength}/${maxLength}`);

        if (activeGiftId) {
            const gift = selectedGifts.find(g => g.id === activeGiftId);
            if (gift) {
                gift.message = $(this).val();
            }
        }
    });

    // Update visibility in the data store on change
    $visibilityRadios.on('change', function() {
        if (activeGiftId) {
            const gift = selectedGifts.find(g => g.id === activeGiftId);
            if (gift) {
                gift.visibility = $(this).val();
            }
        }
    });

    // Central function to update all relevant UI parts
    function updateUI() {
        updateGiftSelectionUI();
        updateTotalPrice();
        updateActiveGiftPrice();
        populateControlsForActiveGift();
    }
    
      // Click handler for the confirm button
      $('#confirmGiftBtn').on('click', function() {
        const $thisButton = $(this);
        const receiverId = $('#receiver_id').val();
        console.log(selectedGifts);
        // 1. Show a preloader and disable the button to prevent multiple clicks
        $thisButton.prop('disabled', true);
        $('#modalPreloader').removeClass('d-none');
        
        // 2. Send the AJAX request
        $.ajax({
            url: "{{ route('gifts.send') }}",
            method: 'POST',
            // We stringify the data and set the contentType to application/json
            data: JSON.stringify({
                receiver_id: receiverId,
                gifts: selectedGifts // The array containing {id, message, visibility} for each gift
            }),
            contentType: 'application/json',
            dataType: 'json',
            success: function(response) {
                // 3a. Handle success from the server
                if (response.success) {
                    toastr.success(response.message || 'Gifts sent successfully!');
                    $('#giftModal').modal('hide'); // Close the modal on success

                    // Optional: You might want to refresh a part of your page here
                } else {
                    // Handle controlled errors from the server (e.g., insufficient balance)
                    toastr.error(response.message || 'Could not send gifts.');
                    $thisButton.prop('disabled', false); // Re-enable button on failure
                }
            },
            error: function(xhr) {
                // 3b. Handle unexpected server errors (e.g., 500, 404)
                const errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred.';
                toastr.error(errorMsg);
                $thisButton.prop('disabled', false); // Re-enable button on failure
                console.error(xhr);
            },
            complete: function() {
                // 4. This runs after success or error. Hide the preloader.
                $('#modalPreloader').addClass('d-none');
            }
        });
    });
});
</script>
@endpush