@extends('layouts.main_app')

@section('pageTitle')
{{ __('settings.settings') }}
@endsection

@section('content')
<div class="settings">
    
    <x-page-header title="settings.settings" route="home" />


    <!-- Personal Information -->
    <h3 class="my-3 text-muted h5">{{ __('settings.settings_title') }}</h3>
    <form class="bg-white p-3" id="personalInformationForm" action="{{ route("settings.update.personal.information") }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('settings.name') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-regular fa-user"></i>
                </span>
                <input type="text" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="name" id="name" value="{{$userData['name']}}">
            </div>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">{{ __('settings.username') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-regular fa-user"></i>
                </span>
                <input type="text" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="username" id="username" value="{{$userData['username']}}">
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('settings.email') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-regular fa-envelope"></i>
                </span>
                <input type="email" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="email" id="email" value="{{$userData['email']}}">
            </div>
        </div>

        <div class="mb-3">
            <label for="password_old" class="form-label">{{ __('settings.password_old') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-solid fa-key"></i>
                </span>
                <input type="password" autocomplete="off" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="password_old" id="password_old" value="">
            </div>
        </div>

        <div class="mb-3">
            <label for="password_new" class="form-label">{{ __('settings.password_new') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-solid fa-key"></i>
                </span>
                <input type="password" autocomplete="off" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="password_new" id="password_new" value="">
            </div>
        </div>

        <div class="mb-3">
            <label for="account_privacy" class="form-label">{{ __('settings.account_privacy') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-solid fa-shield"></i>
                </span>
                <select class="form-select text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" id="account_privacy" name="account_privacy">
                    <option value=""></option>
                    <option value="public" {{$userData['account_privacy']=='public' ? 'selected' : ''}}>{{ __('settings.account_privacy_public') }}</option>
                    <option value="private" {{$userData['account_privacy']=='private' ? 'selected' : ''}}>{{ __('settings.account_privacy_private') }}</option>
                </select>
            </div>
        </div>
        
        <button id="submitBtnPersonal" class="btn btn-orange text-light">{{ __('settings.save_changes') }}</button>
        <!-- إشارة التحميل باستخدام Bootstrap (تكون مخفية افتراضيًا) -->
        <div id="loadingIndicatorPersonal">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">loading ...</span>
            </div>
        </div>
    </form>

    <!-- Profile Information -->
    <h3 class="my-3 text-muted h5">{{ __('settings.settings_profile_title') }}</h3>
    <form class="bg-white p-3" id="profileInformationForm" action="{{ route("settings.update.profile.information") }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="date_of_birth" class="form-label">{{ __('settings.date_of_birth') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                </span>
                <input type="date" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="date_of_birth" id="date_of_birth" value="{{$userData['date_of_birth']}}">
            </div>
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">{{ __('settings.cover_image') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-regular fa-image"></i>
                </span>
                <input type="file" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="cover_image" id="cover_image">
            </div>
        </div>
        
        <div class="mb-3">
            <label for="background_image" class="form-label">{{ __('settings.background_image') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-regular fa-image"></i>
                </span>
                <input type="file" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="background_image" id="background_image">
            </div>
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">{{ __('settings.bio') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-solid fa-text-width"></i>
                </span>
                <textarea rows="5" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="bio" id="bio" >{{$userData['bio']}}</textarea>
            </div>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">{{ __('settings.gender') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-solid fa-user-tie"></i>
                </span>
                <select class="form-select text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" id="gender" name="gender">
                    <option value=""></option>
                    <option value="male" {{$userData['gender']=='male' ? 'selected' : ''}}>{{ __('settings.gender_male') }}</option>
                    <option value="female" {{$userData['gender']=='female' ? 'selected' : ''}}>{{ __('settings.gender_female') }}</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">{{ __('settings.country') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-regular fa-flag"></i>
                </span>
                <input type="text" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="country" id="country" value="{{$userData['country']}}">
            </div>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">{{ __('settings.city') }}</label>
            <div class="input-group">
                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                    <i class="fa-solid fa-city"></i>
                </span>
                <input type="text" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="city" id="city" value="{{$userData['city']}}">
            </div>
        </div>

        <button id="submitBtnProfile" class="btn btn-orange text-light">{{ __('settings.save_changes') }}</button>
        <!-- إشارة التحميل باستخدام Bootstrap (تكون مخفية افتراضيًا) -->
        <div id="loadingIndicatorProfile">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">loading ...</span>
            </div>
        </div>
    </form>

    <!-- account verification Settings -->
    {{-- <h3 class="my-3 text-muted h5">{{ __('settings.account_verification') }}</h3>
    <div class="bg-white p-3">
        <a href="settings/verfication" class="row text-decoration-none text-dark">
            <div class="col">
                <i class="fa-regular fa-circle-check position"></i>
                <span class="mx-2 h6">{{ __('settings.account_verification') }}</span>
                <p class="mx-4 mt-1 text-grey">{{ __('settings.account_verification_desc') }}</p>
            </div>
            <div class="col-2 text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <i class="fa-solid fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} mt-3 text-orange-color"></i>
            </div>
        </a>
    </div> --}}
    <h3 class="my-3 text-muted h5">{{ __('settings.blocked_users') }}</h3>
    <div class="bg-white p-3">
        <a href="{{ route('settings.blocked_users') }}" class="row text-decoration-none text-dark">
            <div class="col">
                <i class="fas fa-ban position"></i>
                <span class="mx-2 h6">{{ __('settings.blocked_users') }}</span>
                <p class="mx-4 mt-1 text-grey mb-1">{{ __('settings.manage_blocked_users') }}</p>
            </div>
            <div class="col-2 text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <i class="fa-solid fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} mt-3 text-orange-color"></i>
            </div>
        </a>
    </div>

    <!-- delete account Settings -->
    <h3 class="my-3 text-muted h5">{{ __('settings.delete_account') }}</h3>
    <div class="bg-white p-3">
        <a href="" data-bs-toggle="modal" data-bs-target="#deleteAccountByUserModal" class="row text-decoration-none text-dark">
            <div class="col">
                <i class="fa-solid fa-trash-can position"></i>
                <span class="mx-2 h6">{{__('settings.delete_account')}}</span>
                <p class="mx-4 mt-1 text-grey">{{ __('settings.account_delete_desc') }}</p>
            </div>
            <div class="col-2 text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <i class="fa-solid fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} mt-3 text-orange-color"></i>
            </div>
        </a>
    </div>
    
    <!-- Bootstrap Delete Confirmation User Account Modal -->
    <div class="modal fade" id="deleteAccountByUserModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('settings.confirm_delete')}}</h5>
                </div>
                <div class="modal-body">
                    <p class="text-danger my-4">{{__('settings.user_confirm_message_delete')}}
                    </p>
                    <form id="deleteAccountByUser" method="POST" action="{{ route('settings.account.delete') }}">
                        @csrf
                        @method('DELETE')
                    
                        <div class="mb-3">
                            <label for="account_password" class="form-label">{{ __('settings.password_now') }}</label>
                            <div class="input-group">
                                <span class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                                <input type="password" autocomplete="off" class="form-control text-grey {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" name="account_password" id="account_password" value="">
                            </div>
                        </div>

                        <div id="deleteMessage"></div>
            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('home.cancel')}}</button>
                            
                            <button type="submit" id="submitBtnDeleteAccount" class="btn btn-danger">{{ __('settings.delete_account') }}</button>
                        </div>
                        <!-- إشارة التحميل باستخدام Bootstrap (تكون مخفية افتراضيًا) -->
                        <div id="loadingIndicatorDeleteAccount">
                            <div class="spinner-border text-danger" role="status">
                                <span class="visually-hidden">loading ...</span>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

</div>



@endsection

@section('java_scripts')
    @auth
    <script src="{{asset('js/users/update_user_data.js?version=1.0')}}"></script>
    @endauth
@endsection

