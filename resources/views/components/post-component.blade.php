
<div class="bg-white rounded-top p-3 mt-2" id="post{{ $post->slug_id }}">

    <!-- Begin Post Header -->
     @include('partials.post._post-header',['post'=>$post])
     <!-- End Post Header -->
 
     <!-- Begin Post Body -->
     @if($post->post_type == 'normal')
         @include('partials.post._normal-post-body',['post'=>$post])
     @else    
        @include('partials.post._poll-post-body',['post'=>$post])
     @endif
     <!-- End Post Body -->
 
     <!-- Begin Post Footer -->
     @include('partials.post._post-footer',['post'=>$post])
     <!-- End Post Footer -->
 
 </div>
 
 
 
 
 
 
 @push('js')
     <script src="{{asset('js/posts/post_like.js')}}"></script>
 @endpush
 
 @if($post->is_owner())
     <!-- Bootstrap Delete Confirmation Post Modal -->
     @include('posts.delete_post_modal', ['slugId' => $post->slug_id])
 
     @push('js')
         <script src="{{asset('js/posts/delete_post.js')}}"></script>
     @endpush
 @endif