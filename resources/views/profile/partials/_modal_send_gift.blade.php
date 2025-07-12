<div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="giftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div id="modalPreloader" class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75 d-none" style="z-index: 1051;">
                <div class="spinner-border text-orange" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title" id="giftModalLabel">{{ __('gifts.select_gift') }}</h5>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="receiver_id" name="receiver_id" value="{{ $data['user_id'] }}" />
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
            <div class="container my-3">

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
                            {{-- <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                            --}}
                            <textarea class="form-control" id="textAreaGiftMsg" rows="2"
                                placeholder="{{ __('gifts.enter_msg') }}"></textarea>
                        </div>
                    </div>
                </div>


            </div>
            <div class="container mb-3">
                <div class="row justify-content-between align-items-end">

                    <div class="col-md-6">
                        <div class="container mt-4">
                            <div class="row flex-reverse">
                                <div class="col-12 d-flex flex-column justify-content-between">
                                    <span>🎁 {{ __('gifts.gift_price') }}: 
                                        <span id="gift_price_note" class="small form-text text-muted">{{ __('gifts.select_gift_to_get_price') }}</span>
                                        <strong>
                                            <span id="gift_price" class="text-success"></span>
                                        </strong>
                                        <div class="spinner-border text-orange" id="gift_price_spinner" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </span>
                                    <span>💰 {{ __('gifts.your_wallet_balance') }}: 
                                        <strong id="userBalance" class="d-none text-success"></strong>
                                        <div class="spinner-border text-orange" id="userBalance_spinner" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="modal-actions mt-auto text-start">
                            <button id="confirmGiftBtn" class="btn btn-orange" disabled>{{ __('gifts.confirm') }}</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('wallet.cancel') }}
                            </button>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>