<!-- Modal -->
<div class="modal fade" id="createPostModal" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body post-container">
                @auth
                <h4 class="text-muted border-bottom h5 pb-3">{{__('home.new_post')}}</h4>
                <div id="errorsContainer" class="mb-3"></div>

                <form id="postForm" action="{{ route("posts.store") }}" method="post">
                    @csrf
                    <div class="mb-3 d-flex">
                        <img class="logo-main rounded-circle border mx-2" src="{{asset('img/logo.png')}}" alt="Tadween logo...">
                        @php
                            $fullName = Auth::user()->name; // اسم المستخدم
                            $nameParts = explode(' ', trim($fullName)); // تقسيم الاسم إلى أجزاء بناءً على المسافة
                            $firstName = $nameParts[0]; // الاسم الأول
                            $lastName = end($nameParts); // الاسم الأخير
                        @endphp
                        <textarea id="postText" name="postText" class="form-control" rows="4" placeholder="{{$firstName . ' ' . $lastName .' , '. __('home.post_placeholder')}}"></textarea>
                        <textarea id="pollQuestion" name="pollQuestion" class="d-none form-control" rows="4" placeholder="{{__('home.poll_placeholder')}}"></textarea>
                    </div>
                    
                    <!-- رفع الصور -->
                    <div class="mb-3">
                        <div class="image-preview mt-2" id="imagePreview"></div>
                        <input type="file" id="imageInput" name="images[]" accept="image/*" multiple style="display: none;">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="d-flex">
                                <button type="button" class="btn text-orange-color" id="uploadImageButton">
                                    <i class="fas fa-image"></i>
                                </button>
                                <button type="button" class="btn text-orange-color" id="pollButton">
                                    <i class="fas fa-poll"></i>
                                </button>
                                <button type="button" class="btn text-orange-color" id="emojiButton">
                                    <i class="fas fa-smile"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }} text-muted">
                            <small><span id="maxCount">400</span> / <span id="countPost"> 0 </span></small>
                        </div>
                    </div>
                    
                    <div class="d-none" id="poll_section">
                        <!-- إضافة استبيان -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('home.create_poll') }}</label>
                            <div id="pollOptions">
                                <div class="input-group mb-2">
                                    <input type="text" name="poll_option1" id="poll_option1" class="form-control {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}" placeholder="{{ __('home.poll_option') }} 1">
                                    <small class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}">25 / <span id="optionCount1"> 0 </span></small>
                                </div>
                                <div class="input-group mb-2">
                                    <input type="text" name="poll_option2" id="poll_option2" class="form-control {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}" placeholder="{{ __('home.poll_option') }} 2">
                                    <small class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}">25 / <span id="optionCount2"> 0 </span></small>
                                </div>
                                <div class="input-group mb-2">
                                    <input type="text" name="poll_option3" id="poll_option3" class="form-control {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}" placeholder="{{ __('home.poll_option') }} 3">
                                    <small class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}">25 / <span id="optionCount3"> 0 </span></small>
                                </div>
                                <div class="input-group mb-2">
                                    <input type="text" name="poll_option4" id="poll_option4" class="form-control {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}" placeholder="{{ __('home.poll_option') }} 4">
                                    <small class="input-group-text {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}">25 / <span id="optionCount4"> 0 </span></small>
                                </div>
                            </div>
                        </div>

                        <!-- مدة انتهاء التصويت -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('home.poll_duration') }}</label>
                            <select name="poll_duration" class="form-control">
                                <option value="1">{{__('home.poll_duration_one')}}</option>
                                <option value="6">{{__('home.poll_duration_six')}}</option>
                                <option value="12">{{__('home.poll_duration_twelve')}}</option>
                                <option value="24" selected>{{__('home.poll_duration_twenty_four')}}</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="emoji-picker" id="emojiPicker" style="display: none;">
                        <span>😀</span><span>😁</span><span>😂</span><span>🤣</span><span>😊</span><span>😍</span>
                        <span>😎</span><span>😢</span><span>😡</span><span>👍</span><span>🙏</span><span>❤️</span>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <i class="fa-solid fa-earth-americas"></i>
                            <span class="mx-1">{{__('home.post_general')}}</span>
                        </div>
                        <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                            <!-- زر النشر -->
                            <button class="btn btn-orange" id="submitBtn">{{__('home.post_published')}}</button>
                            
                            <!-- إشارة التحميل باستخدام Bootstrap (تكون مخفية افتراضيًا) -->
                            <div id="loadingIndicator">
                                <div class="spinner-border text-danger" role="status">
                                    <span class="visually-hidden">loading ...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                @endauth
            </div>
        </div>
    </div>
</div>