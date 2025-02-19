<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('img/logo.png')}}">
    <title>@yield('pageTitle')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    {{-- <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js')
                .then(() => console.log("Service Worker Registered"))
                .catch((error) => console.log("Service Worker Registration Failed:", error));
        }
    </script> --}}

</head>

<body class="bg-secondary bg-opacity-10">
    <main>
        <div class="container-fluid py-3">
            <div class="row justify-content-center">
        
                <!-- Sidebar In Small Screen -->
                <nav class="navbar bg-body-tertiary fixed-bottom d-md-none">
                    <div class="container-fluid">
                        <div class="container d-flex justify-content-between">
                            <a href="{{route('home')}}" class="fs-3 {{ request()->routeIs('home') ? 'text-orange-color' : 'text-dark' }}">
                                <i class="fa-solid fa-house"></i>
                            </a>

                            <a href="" class="fs-3">
                                <i class="fas fa-search"></i>
                            </a>

                            <a href="{{route('notifications.index')}}" class="fs-3 {{ request()->routeIs('notifications.index') ? 'text-orange-color' : 'text-dark' }}">
                                <i class="fa-regular fa-bell"></i>
                            </a>

                            <a href="{{route('messages.index')}}" class="fs-3 {{ request()->routeIs('messages.index') ? 'text-orange-color' : 'text-dark' }}">
                                <i class="fa-regular fa-comments"></i>
                            </a>
    
                            <a href="#" class="text-dark fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                                <i class="fas fa-bars"></i>
                            </a>
                        </div>
                        
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                            <div class="offcanvas-header justify-content-between">
                                
                                <h5 class="offcanvas-title">TADWEEN</h5>
                                <button type="button" class="btn-close m-0" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                @include('layouts.sidebar')
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Sidebar In Middle And Large Screen -->
                <div class="d-none d-md-block col-md-3">
                    @include('layouts.sidebar')
                </div>

                <!-- Content -->
                <div class="col-md-9">
                    @include('posts.create_post')
                    @include('layouts.toast')
                    @yield('content')
                </div>
                <!--
                <div class="d-none d-md-block col-md-3">
                    <div class="bg-white rounded-top-4 p-3">right</div>
                </div>
                -->
        
            </div>
        </div>
        
    </main>
    
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script>
    @yield('java_scripts')
    <script src="{{asset('js/home.js?version=1.0')}}"></script>

</body>
</html>