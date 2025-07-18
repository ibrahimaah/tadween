<div class="bg-white rounded-top-4 p-3">
    <div class="row align-items-center justify-content-between">
        <div class="col">
            @if($route)
            <a href="{{ route($route) }}" class="text-decoration-none text-orange-color">
                <i class="fa-solid fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
            </a>
            @else 
            <a href="{{ url()->previous() }}" class="text-decoration-none text-orange-color">
                <i class="fa-solid fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
            </a>
            @endif
        </div>
        <div class="col text-center">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid" style="width:50px" alt="logo">
        </div>
        <div class="col text-start text-orange-color">
            <h3 class="h5">{{ __($title) }}</h3>
        </div>
    </div>
</div>
