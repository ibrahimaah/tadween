@extends('layouts.main_app')

@section('pageTitle')
{{ __('home.home') }}
@endsection

@section('content')

<div class="post-container">
    <!-- Bootstrap Delete Confirmation Post Modal -->
    @include('posts.delete_post_modal')
    
    <!-- Bootstrap Delete Confirmation Modal -->
    <div class="modal fade" id="deleteReplyModal" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('home.confirm_delete')}}</h5>
                </div>
                <div class="modal-body">
                <p>{{__('home.reply_confirm_message_delete')}}
                </p>
                <div id="deleteMessageReply"></div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('home.cancel')}}</button>
                    <button type="button" class="btn btn-danger confirm-delete-btn-reply" id="">{{__('home.delete')}}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Show Reply Image Modal -->
    <div class="modal fade" id="replyImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Preview Image">
                </div>
            </div>
        </div>
    </div>
    

    <div class="bg-white rounded-4 p-3">
        <div class="row">
            <div class="col">
                <a href="{{route('home')}}" class="text-decoration-none text-orange-color">
                    <i class="fa-solid fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}" id="backPrev"></i>
                </a>
            </div>
            <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <img class="logo-main" src="{{asset('img/logo.webp')}}" alt="Tadween logo...">
            </div>
        </div>
    </div>

    <div class="mt-2" id="display-posts-container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (!empty($post))
        <div class="bg-white rounded-4 p-3 mb-2" id="post{{$post['slug_id']}}">
            
            <div class="d-flex justify-content-between">
                <a href="../{{$post['user']['username']}}" class="d-flex text-decoration-none text-dark">

                    @if ($post['user']['cover_image'] != null)
                        <img src="{{ asset($post['user']['cover_image']) }}" class="img-fluid logo-main rounded-circle" alt="User Image">
                    @else
                    <img src="{{ asset('img/logo.webp') }}" class="img-fluid logo-main rounded-circle" alt="User Image">
                    @endif

                    <div class="px-1">
                        <p class="mx-1 mb-0">{{$post['user']['name']}}</p>
                        <p class="mx-1 mt-0 text-grey">
                            {{ app()->getLocale() == 'ar' ? $post['user']['username'].'@' : '@'. $post['user']['username'] }}
                            ({{$post['created_at']}})
                        </p>
                    </div>
                </a>
                @if ($post['is_owner'])
                <div class="dropstart">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical text-orange-color"></i>
                    </button>
                
                    <ul class="dropdown-menu text-{{ app()->getLocale() == 'ar' ? 'end' : 'start' }}">
                        <li>
                            <button class="dropdown-item delete-post-btn" id="{{ $post['slug_id'] }}" data-bs-toggle="modal" data-bs-target="#deletePostModal">
                                <i class="fa-regular fa-trash-can text-orange-color"></i><span class="mx-1">{{__('home.post_delete')}}</span>
                            </button>
                        </li>
                    </ul>
                </div>
                @endif
                    
            </div>
            <!--////////////////////////////////////////////////////////-->
            @if ($post['post_type'] === 'poll')
                @php
                    $poll_options = '';
                    $totalVotes = array_sum(array_column($post['poll']['options'], 'votes'));

                    foreach ($post['poll']['options'] as $key => $poll) {
                        if ($poll['option_text'] != null) {
                            $percentage = $totalVotes === 0 ? 0 : ($poll['votes'] / $totalVotes) * 100;
                            $vote = app()->getLocale() === 'ar' ? 'صوت' : 'vote';

                            $poll_options .= '
                            <div class="mb-3">
                                <button class="btn btn-outline-danger w-100 vote-btn" data-option="' . ($key+1) . '" data-post="' . $post['slug_id'] . '">' . $poll['option_text'] . '</button>
                                <div class="progress mt-2">
                                    <div id="progress' . ($key+1) . '" class="progress-bar bg-danger" role="progressbar" style="width: ' . round($percentage) . '%;">' . round($percentage) . '%</div>
                                </div>
                                <span class="vote-count" id="vote-count-' . ($key+1) . '">
                                    ' . $poll['votes'] . ' ' . $vote . '
                                </span>
                            </div>';
                        }
                    }

                    $allVotes = app()->getLocale() === 'ar' ? 'إجمالي التصويتات:' : 'Total votes:';
                    $finishVotes = app()->getLocale() === 'ar' ? 'ينتهي التصويت في :' : 'Voting ends at:';
                @endphp

                <div class="text-dark">
                    <h4 class="mb-4">{{ $post['text'] }}</h4>
                    <div class="mb-3">{!! $poll_options !!}</div>
                    <p class="mt-3 text-muted">📊 {{ $allVotes }} <strong>{{ $totalVotes }}</strong></p>
                    <p class="mt-4 text-muted">⏳ {{ $finishVotes }} {{ $post['poll']['expires_at'] }}</p>
                </div>
            @else
                <div class="text-dark">
                    <p class="post-text mb-3">{!! $post['text'] ?? '' !!}</p>
                    <div class="row">
                        @if (!empty($post['image']))
                            @foreach ($post['image'] as $key => $image)
                                <div class="col">
                                    <img src="{{ asset($image) }}" class="img-fluid h-100" alt="Post Image" data-bs-toggle="modal" data-bs-target="#postImageModal{{$key}}">
                                </div>
                                <!-- Bootstrap Show Post Image Modal -->
                                <div class="modal fade" id="postImageModal{{$key}}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset($image) }}" class="img-fluid" alt="Preview Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif
            <!--////////////////////////////////////////////////////////-->

            <div class="row text-center mt-3">
                <div class="col"><span class="comments_count">{{$post['comments_count'] ?? 0}}</span> <i class="fa-regular fa-message"></i></div>
                <div class="col">{{$post['reposts_count'] ?? 0}} <i class="fa-solid fa-rotate"></i></div>
                <div class="col" id="post-like-section" post-slug-data="{{$post['slug_id']}}">
                    <span class="link_hover">
                        <span id="post-like-count">{{$post['post_likes_count'] ?? 0}}</span>
                        <i class="fa-regular fa-thumbs-up {{$post['is_post_liked']?'text-orange-color':''}}" id="post-like-btn"></i>
                    </span>
                </div>
                <div class="col"><i class="fa-regular fa-share-from-square"></i></div>
            </div>

        </div>
        @else
            <p>🙏</p>
        @endif
    </div>

    <!-- Create Reply On Posts -->
    @auth
    <div id="errorsContainerReply" class="mb-3"></div>
    
    <form id="replyForm" action="{{ route("posts.reply.store") }}" method="post" class="bg-white rounded-4 p-3 mb-5">
        @csrf
        <div class="mb-3 d-flex">
            <input type="hidden" name="slug_id" id="slug_id" value="{{$post['slug_id']}}">
            <textarea id="reply_text" name="reply_text" class="form-control border-0" placeholder="{{__('home.post_reply_placeholder') .' , '. $post['user']['username'] }}"></textarea>
        </div>

        <div class="mb-3">
            <div class="image-preview mt-2" id="imagePreviewReply"></div>
        </div>

        <div class="row">
            <div class="col">
                <div class="d-flex">
                    <button type="button" class="btn text-orange-color" id="uploadImageButtonReply">
                        <i class="fas fa-image"></i>
                    </button>
                    <button type="button" class="btn text-orange-color" id="emojiButtonReply">
                        <i class="fas fa-smile"></i>
                    </button>
                </div>
            </div>
            <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }} text-muted">
                <small>400 / <span id="countReply"> 0 </span></small>
            </div>
        </div>
        
        <input type="file" id="imageInputReply" accept="image/*" multiple style="display: none;">
        
        <div class="emoji-picker" id="emojiPickerReply" style="display: none;">
            <span>😀</span><span>😁</span><span>😂</span><span>🤣</span><span>😊</span><span>😍</span>
            <span>😎</span><span>😢</span><span>😡</span><span>👍</span><span>🙏</span><span>❤️</span>
        </div>

        <div class="row mt-2">
            <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <!-- زر النشر -->
                <button class="btn btn-orange" id="submitBtnReply">{{__('home.post_reply_published')}}</button>
                
                <!-- إشارة التحميل باستخدام Bootstrap (تكون مخفية افتراضيًا) -->
                <div id="loadingIndicatorReply">
                    <div class="spinner-border text-danger" role="status">
                        <span class="visually-hidden">loading ...</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endauth

    <!-- HTML to display Replies On Post -->
    <p class="text-center text-muted empty_replies d-none">{{__('home.post_replies_empty')}}</p>
    <!-- HTML to display post -->
    <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
        <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
    </div>
    <div class="mt-2" id="display-replies-container"></div>
    
    <!-- Loading Spinner -->
    <div class="d-none justify-content-center my-3" id="replies_loading_indicator">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>

@endsection

@section('java_scripts')
    <script src="{{asset('js/posts/display_replies_post.js?version=1.0')}}"></script>
    <script src="{{asset('js/posts/post_like.js?version=1.0')}}"></script>
    @auth
        <script src="{{asset('js/posts/delete_post.js?version=1.0')}}"></script>
        <script src="{{asset('js/posts/create_reply_post.js?version=1.0')}}"></script>
        <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script>
        <script src="{{asset('js/posts/create_vote_poll.js?version=1.0')}}"></script>
    @endauth
@endsection