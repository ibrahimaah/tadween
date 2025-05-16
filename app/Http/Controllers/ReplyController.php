<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoadRepliesRequest;
use App\Http\Requests\ReplyRequest;
use App\Models\Post;
use App\Models\Reply;
use App\Services\ImgService;
use App\Services\PostService;
use App\Services\ReplyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;

class ReplyController extends Controller
{
    public function __construct(
        private PostService $postService,
        private ImgService $imgService,
        private ReplyService $replyService) {}


    //Add new reply on post
    public function store(ReplyRequest $request)
    { 
        try 
        {
            $reply_data = $request->validated();

            $res_getPostBySlug = $this->postService->getPostBySlug($reply_data['slug_id']);

            if ($res_getPostBySlug['code'] == 0) 
            {
                throw new Exception($res_getPostBySlug['msg']);
            }

            $post = $res_getPostBySlug['data'];

            $imagePath = null;
            if($request->hasFile('reply_image'))
            {
                $res_storeImage = $this->imgService->storeImage($request->file('reply_image'), 'replies_images');

                if($res_storeImage['code'] == 0)
                {
                    throw new Exception($res_storeImage['msg']);  
                }
                
                $imagePath = $res_storeImage['data'];
            }
            
            $reply_data = [
                'user_id' => Auth::id(),
                'post_id' => $post->id,
                'reply_text' => strip_tags($request->reply_text),
                'reply_image' => $imagePath,
                'slug_id' => Str::uuid()
            ];
        
            $res_store = $this->replyService->store($reply_data);
            if($res_store['code'] == 0)
            {
                $this->imgService->deleteImage($imagePath);
                throw new Exception($res_store['msg']);
            }

            $reply = $res_store['data'];


            if ($reply) 
            {
                // $comments_count = Reply::where('post_id', $post->id)->count();
                $replyData = replyJsonResponse($reply);
                return response()->json([
                    'success' => true,
                    'reply' => $replyData, 
                    'message' => __('reply.reply_success')
                ]);
                

            }
        }
        catch(Exception $ex)
        {
            generateErrorResponse($ex->getMessage());
        }
    }


    //Display All Replies On Post For Users
    public function loadReplies(LoadRepliesRequest $request)
    {
        try 
        {
            $validated = $request->validated();
        
            $post_id = Post::select('id')->where('slug_id',$validated['slug_id'])->value('id');

            if (!$post_id) {
                throw new Exception("No post found with the provided slug ID: {$validated['slug_id']}");
            }
            

            $res_getRepliesByPostId = $this->replyService->getRepliesByPostId($post_id);

            if($res_getRepliesByPostId['code'] == 0)
            {
                throw new Exception($res_getRepliesByPostId['msg']);
            }

            $replies = $res_getRepliesByPostId['data'];
            
            $repliesData = $replies->map(function ($reply) 
            {
                return replyJsonResponse($reply);
            }); 
            return response()->json([
                'success' => true,
                'replies' => $repliesData,
                'next_page' => $replies->hasMorePages() ? $replies->currentPage() + 1 : null,
            ]);
        }
        catch(Exception $ex)
        {
            generateErrorResponse($ex->getMessage());
        }
    }

    //Delete Reply From Post
    public function destroy(Request $request)
    {
        try {

            // التحقق من تسجيل الدخول
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => __('home.unauthenticated'),
                ], 200); // استجابة غير مصرح بها
            }

            // البحث عن الرد باستخدام slug_id
            $reply = Reply::where('slug_id', $request->slug_id)->first();

            // التحقق من وجود الرد
            if (!$reply) {
                return response()->json([
                    'success' => false,
                    'message' => __('home.post_replies_not_found'),
                ], 200);
            }

            // التحقق من أن المستخدم الحالي هو صاحب الرد
            if ($reply->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => __('home.not_authorized_to_delete_reply'),
                ], 200); // استجابة غير مصرح بها
            }

            // حذف الصورة المرتبطة بالرد إذا كانت موجودة
            if ($reply->reply_image) {
                $imagePath = public_path($reply->reply_image); // تحديد المسار الكامل للصورة

                if (file_exists($imagePath)) {
                    unlink($imagePath); // حذف الصورة من المجلد مباشرة
                }
            }

            $post_id = $reply->post_id;

            $reply->delete();
            // حساب عدد التعليقات الحالية للمنشور
            $comments_count = Reply::where('post_id', $post_id)->count();

            // إرجاع استجابة ناجحة مع عدد التعليقات
            return response()->json([
                'success' => true,
                'slug_id' =>  $request->slug_id,
                'comments_count' => $comments_count,
                'message' => __('home.post_reply_deleted_successfully'),
            ], 200);
        } catch (\Exception $e) {
            // معالجة أي استثناء غير متوقع
            return response()->json([
                'success' => false,
                'message' => __('home.unexpected_error'),
            ], 200);
        }
    }

    public function show($slug_id)
    {
        $reply = Reply::with(['children', 'children.allChildren', 'parent', 'parent.allParents'])
                        ->where('slug_id', $slug_id)
                        ->firstOrFail();

                    // All nested children (flat)
                    $allChildren = $reply->allChildrenFlat();

                    // All parent chain (flat)
                    // $allParents = $reply->allParentsFlat();

        
        return view('replies.index', ['reply' => $reply,'reply_children' => $allChildren]);
    }
}
