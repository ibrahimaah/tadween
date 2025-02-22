<div id="rightPageHome" class="bg-white rounded-4 p-2">
    <div class="d-flex flex-column align-items-start">

        <!-- Profile Section -->
        <div class="mb-2">
            <img src="{{asset('img/logo.png')}}" alt="" class="img-fluid" style="max-width: 50px; height: auto;">
        </div>

        <!-- User Info -->
        @auth
        <div class="d-flex align-items-baseline">
            {{-- <i class="fa-solid fa-lock text-orange-color"></i> --}}
            <span class="mx-2 h6">{{Auth::user()->name}}</span>
        </div>
        <div class="flex-column mb-3">
            <div class="mb-2 mx-3">
                <span class="text-muted">
                    {{ app()->getLocale() == 'ar' ? Auth::user()->username.'@' : '@'. Auth::user()->username }}
                </span>
            </div>
            
            <!-- Following/Followers -->
            <div class="mx-3">
                <!-- الأشخاص الذين يتابعهم المستخدم -->
                <a href="{{ route('followings.index', Auth::user()->username) }}"
                    class="text-decoration-none {{ request()->is('followings/*') ? 'text-orange-color' : 'text-muted' }}">
                    <span>{{ __('home.following') }}</span>
                    <span class="following_count">{{ Auth::user()->following()->count() }}</span>
                </a>
                <a href="{{ route('followers.index', Auth::user()->username) }}"
                    class="text-decoration-none {{ request()->is('followers/*') ? 'text-orange-color' : 'text-muted' }}">
                    <span>{{ __('home.followers') }}</span>
                    <span>{{ Auth::user()->followers()->count() }}</span>
                </a>
            </div>
            
        </div>
        @endauth
    </div>

    <!-- Main Page Link -->
    <div class="d-flex align-items-center mb-3">
        <i class="fa-solid fa-house text-orange-color"></i>
        <a href="{{route('home')}}" class="mx-3 text-decoration-none {{ request()->routeIs('home') ? 'text-orange-color' : 'text-dark' }}">{{__('home.home')}}</a>
    </div>

    @if (Auth::user()->role == 'admin')
    <!-- dashboard Page Link -->
    <div class="mb-3">
        <i class="fa-solid fa-gauge-high text-orange-color"></i>
        <a class="mx-3 text-decoration-none text-dark" href="" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        
            {{__('dashboard.dashboard')}}
        </a>
        <div class="collapse show my-2" id="collapseExample">
            <div class="card card-body p-0 border-0">
                <ul class="list-group {{ app()->getLocale() == 'en' ? 'ps-0' : 'pe-0' }}" >
                    <li class="list-group-item border-0">
                        <i class="fas fa-chart-bar text-orange-color"></i>
                        <a href="{{route('admin.dashboard')}}" class="mx-3 text-decoration-none {{ request()->routeIs('admin.dashboard') ? 'text-orange-color' : 'text-dark' }}">{{__('dashboard.statistics')}}</a>
                    </li>
                    <li class="list-group-item border-0">
                        <i class="fa-regular fa-user text-orange-color"></i>
                        <a href="{{route('admin.users')}}" class="mx-3 text-decoration-none {{ request()->routeIs('admin.users') ? 'text-orange-color' : 'text-dark' }}">{{__('dashboard.users')}}</a>
                    </li>
                    <li class="list-group-item border-0">
                        <i class="fa-solid fa-file-lines text-orange-color"></i>
                        <a href="{{route('admin.posts')}}" class="mx-3 text-decoration-none {{ request()->routeIs('admin.posts') ? 'text-orange-color' : 'text-dark' }}">{{__('dashboard.posts')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    @auth
    <!-- Personal Note -->
    <div class="d-flex align-items-center mb-3">
        <i class="fa-regular fa-user text-orange-color"></i>
        <a href="{{route('profile', ['username' => Auth::user()->username ?? 'default-username'])}}" class="mx-3 text-decoration-none {{ request()->is('profile/*') ? 'text-orange-color' : 'text-dark' }}">{{__('home.profile')}}</a>
    </div>

    <!-- Search Link -->
    <div class="d-none align-items-center mb-3">
        <i class="fa-regular fa-compass text-orange-color"></i>
        <a href="" class="mx-3 text-decoration-none {{ request()->is('search') ? 'text-orange-color' : 'text-dark' }}">{{__('home.search')}}</a>
    </div>

    <!-- Notification Link -->
    <div class="d-flex align-items-center mb-3">
        <i class="fa-regular fa-bell text-orange-color"></i>
        <a href="{{route('notifications.index')}}" class="mx-3 text-decoration-none {{ request()->is('home/notification') ? 'text-orange-color' : 'text-dark' }}">{{__('home.notifications')}}</a>
    </div>

    <!-- Messages Link -->
    <div class="d-flex align-items-center mb-3">
        <i class="fa-regular fa-comments text-orange-color"></i>
        <a href="{{route('messages.index')}}" class="mx-3 text-decoration-none {{ request()->is('messages') ? 'text-orange-color' : 'text-dark' }}">{{__('home.messages')}}</a>
    </div>


        {{-- Follow-Up Requests --}}
        @if(auth()->user()->is_private())
        <div class="d-flex align-items-center mb-3">
            <i class="fa-solid fa-user-plus text-orange-color position-relative">
                <!-- Smaller badge showing number of requests -->
                @if((int)$pendingRequestsCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success p-1" style="font-size: 0.7rem;">
                    {{ $pendingRequestsCount }}<!-- Replace with your dynamic request count -->
                    <span class="visually-hidden">requests</span>
                </span>
                @endif
                

            </i>
            <a href="{{ route('follow_up_requests') }}" class="mx-3 text-decoration-none {{ request()->is('follow-up-requests') ? 'text-orange-color' : 'text-dark' }}">
                {{ __('home.follow_up_requests') }}
            </a>
        </div>
        @endif
    
    
    
    <!-- Settings Link -->
    <div class="d-flex align-items-center mb-3">
        <i class="fa-solid fa-gear text-orange-color"></i>
        <a href="{{ route('settings') }}" class="mx-3 text-decoration-none {{ request()->routeIs('settings') ? 'text-orange-color' : 'text-dark' }}">{{__('settings.settings')}}</a>
    </div>
    @endauth

    <!-- Languages Link -->
    <div class="d-flex align-items-center mb-3">
        <i class="fa-solid fa-globe text-orange-color {{ app()->getLocale() == 'en' ? 'pe-3' : 'ps-3' }}"></i>
        <a href="{{ route('lang.switch', 'en') }}" class="d-inline-flex text-decoration-none {{ app()->getLocale() == 'en' ? 'text-orange-color' : 'text-dark' }}">English</a>
        |
        <a href="{{ route('lang.switch', 'ar') }}" class="d-inline-flex text-decoration-none {{ app()->getLocale() == 'ar' ? 'text-orange-color' : 'text-dark' }}">العربية</a>
    </div>

    <!-- Auth Link -->
    <div class="d-flex align-items-center mb-3">
        @auth
        <!-- إذا كان المستخدم مسجل دخول -->
        <i class="fa-solid fa-right-from-bracket text-orange-color"></i>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link text-dark text-decoration-none">
                {{ __('home.logout') }}
            </button>
        </form>
        
        @else
        <!-- إذا كان المستخدم غير مسجل دخول -->
        <i class="fa-solid fa-right-to-bracket text-orange-color"></i>
        <a class="d-inline-flex text-decoration-none px-3 text-dark" href="{{ route('login') }}">{{ __('auth.login_field') }}</a>
        @endauth
    </div>

    @auth
    <div class="d-flex align-items-center mb-3">
        <!-- Create Post modal -->
        <button type="button" class="btn btn-orange text-light" data-bs-toggle="modal" data-bs-target="#createPostModal">
            <i class="fa-solid fa-plus"></i>
            {{__('home.new_post')}}
        </button>
    </div>
    @endauth
    
</div>