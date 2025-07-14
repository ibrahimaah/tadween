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

                <div class="row">
                    <div id="lastGiftInputs" class="mt-3 d-none"></div>
                </div>

                <div class="row align-items-end">

                    <div class="col-md-8">

                        <span class="d-block">🎁 {{ __('gifts.selected_gift_price') }}:
                            <span id="gift_price_note" class="small form-text text-muted">{{
                                __('gifts.select_gift_to_get_price') }}</span>
                            <strong>
                                <span id="gift_price" class="text-success"></span>
                            </strong>
                            <div class="spinner-border text-orange-color" id="gift_price_spinner" role="status"
                                style="visibility: hidden;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </span>



                        <span class="d-block">💵 {{ __('gifts.total_price') }}:
                            <strong>
                                <span id="total_price" class="text-success">0$</span>
                            </strong>
                            <div class="spinner-border text-orange-color" id="total_price_spinner" role="status"
                                style="visibility: hidden;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
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
    const maxLength = 25;

    $('#textAreaGiftMsg').on('input', function () {
        const currentLength = $(this).val().length;
        $('#giftMsgLabel').text(`${currentLength}/${maxLength}`);
    });
});

</script>
@endpush