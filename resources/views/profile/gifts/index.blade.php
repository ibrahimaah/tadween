@extends('layouts.main_app')

@section('pageTitle')
    {{ __('gifts.title') }}
@endsection

@section('content')
<style>
    .gift-card {
        transition: transform 0.3s;
        margin-bottom: 20px;
    }
    .gift-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .gift-img {
        height: 200px;
        object-fit: cover;
        border-radius: 5px 5px 0 0;
    }
    .no-message {
        color: #6c757d;
        font-style: italic;
    }
</style>

<div class="user_gifts">

 

    <div class="bg-white rounded-top-4 p-3">
        <div class="row mb-2">
            <div class="col">
                <a href="{{ url()->previous() }}" class="text-decoration-none text-orange-color">
                    <i class="fa-solid fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}" id="backPrev"></i>
                </a>
            </div>

            <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <h3 class="h5">{{ __('gifts.title') }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white mt-2 rounded-top-4">
        <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
            <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
        </div>
        <!-- HTML to display gifts -->
        <div class="row p-3 g-4 mt-2" id="giftsContainer">
        </div>
        
        <p class="text-center text-muted empty_gifts d-none my-5 p-3">{{__('gifts.no_gifts')}}</p>

         
    </div>

</div>
@endsection



@section('java_scripts') 
<script>
    $(document).ready(function () {
        const giftsContainer = $('#giftsContainer');
        const emptyMessage = $('.empty_gifts');
        const loadingIndicator = $('#pullToRefreshIndicator');
        
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

                    // Log the full error details in the console
                    console.error('AJAX Error:', {
                        status: xhr.status,               // HTTP status code (e.g., 404, 500)
                        statusText: xhr.statusText,       // Status text (e.g., "Not Found")
                        responseText: xhr.responseText,   // Response body from the server
                        errorThrown: error,               // Text portion of the error
                        fullXhr: xhr                      // Full xhr object for debugging
                    });

                    // Optional: show more user-friendly message
                    toastr.error(`Error ${xhr.status}: ${xhr.statusText}`);
                }
            });
        }

        function renderGifts(giftsData) {

            giftsContainer.empty();
            var currentAuthId = "{{ auth()->id() }}";
            giftsData.forEach(gift => {

                let senderDisplay = '';

                if (gift.visibility === 'anonymous') 
                {
                    senderDisplay = `<h6 class='text-center'><span class="text-muted">{{ __('gifts.anonymous') }}
                                    </span></h6>`;
                } 
                else if(gift.visibility === 'public' || (gift.visibility == 'private' && currentAuthId == gift['receiverId']))
                {
                    senderDisplay = `<h6 class='text-center'><span><a class='text-decoration-none text-orange-color' 
                                              href='/${gift.senderUserName}'>${gift.senderName}
                                            </a>
                                    </span></h6>`;
                }
                else 
                {
                    // senderDisplay = "{{ __('gifts.unknown') }}";
                    senderDisplay = `<h6 class='text-center'><span class="text-muted">{{ __('gifts.anonymous') }}
                                    </span></h6>`;
                }
                const giftHtml = `
                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm">
                            <img src="${gift['giftIcon']}" class="card-img-top" alt="Gift 1">
                            <div class="card-body">
                                ${senderDisplay} 
                                <p class="card-text text-center">${gift['msg']}</p>
                            </div>
                            <div class="card-footer bg-white text-center">
                                <small class="text-muted">${gift['receive_date']}</small>
                            </div>
                        </div>
                    </div>`;

                giftsContainer.append(giftHtml);
            });
        }

        loadGifts();
    });
</script>
@endsection
