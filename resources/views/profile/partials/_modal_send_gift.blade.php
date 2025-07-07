<div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="giftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title" id="giftModalLabel">{{ __('gifts.select_gift') }}</h5>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="d-flex justify-content-center" id="gifts_preloader">
                    <div class="spinner-border text-orange" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div class="modal-body-container d-none">
                    <div class="row" id="giftsContainer">
                        <!-- Icons will be loaded here -->
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">

                <div class="d-flex flex-column">
                    
                    <div>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            {{ __('gifts.public_gift_label') }}
                        </label>
                    </div>
                    
                    <div>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            {{ __('gifts.private_gift_label') }}                        </label>
                    </div>
                    <div>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            {{ __('gifts.anonymous_gift_label') }}
                        </label>
                    </div>
                </div>

                <div class="modal-actions">
                    <button id="confirmGiftBtn" class="btn btn-orange" disabled>{{ __('gifts.confirm') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('wallet.cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>