<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('img/logo.png')}}">
    <title>@yield('pageTitle')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    @if(app()->getLocale() == 'ar')
        <!-- Bootstrap RTL CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
        <!-- Your custom RTL overrides -->
        {{-- <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}"> --}}
    @else
        <!-- Default Bootstrap LTR CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Your custom LTR styles -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endif

    <link rel="manifest" href="{{ asset('manifest.json') }}">

    {{-- <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js')
                .then(() => console.log("Service Worker Registered"))
                .catch((error) => console.log("Service Worker Registration Failed:", error));
        }
    </script> --}}

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="text-decoration-none" href="{{ route('home') }}">{{ __('auth.website_name') }}</a>
            <div class="d-flex {{ app()->getLocale() == 'ar' ? 'me-auto' : 'ms-auto' }}">
                <a class="d-inline-flex text-decoration-none px-2" href="{{ route('lang.switch', 'en') }}">English</a>
                |
                <a class="d-inline-flex text-decoration-none px-2" href="{{ route('lang.switch', 'ar') }}">العربية</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
