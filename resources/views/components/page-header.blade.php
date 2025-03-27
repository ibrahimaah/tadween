<div class="bg-white rounded-top-4 p-3">
    <div class="row align-items-center">
        <div class="col">
            <a href="{{ route($route) }}" class="text-decoration-none text-orange-color">
                <i class="fa-solid fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}"></i>
            </a>
        </div>

        <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
            <h3 class="h5">{{ __($title) }}</h3>
        </div>
    </div>
</div>
