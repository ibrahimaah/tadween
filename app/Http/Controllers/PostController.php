<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\TextHelper;
use App\Models\AccountPrivacy;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\Poll;
use App\Models\PollVote;
use App\Models\User;
use App\Services\PostService;
use App\Traits\CacheClearable;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use CacheClearable;
    
    public function __construct(private PostService $postService){}

    public function index()
    {  
        return view('posts.home');
    }

    //Add new Post
    public function store(Request $request)
    {
        // التحقق من تسجيل الدخول
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }

        try {
            
            // التحقق من البيانات
            $request->validate([
                'postText' => 'nullable|string|max:400',
                'images.*' => 'nullable|image|mimes:jpeg,png,gif,webp,jpg|max:1024',
                'pollQuestion' => 'nullable|string|max:200',
                'poll_option1' => 'nullable|string|max:25',
                'poll_option2' => 'nullable|string|max:25',
                'poll_option3' => 'nullable|string|max:25',
                'poll_option4' => 'nullable|string|max:25',
                'poll_duration' => 'nullable|in:1,6,12,24',
            ], __('validation')); // This loads messages from the correct language file
            

            // التحقق إذا كان المنشور فارغاً (لا يوجد نص ولا صور ولا استبيان)
            $postTextExists = !empty($request->postText);
            $imagesExist = $request->hasFile('images');
            $validPoll = isset($request->poll_option1) && isset($request->poll_option2) && !empty($request->poll_option1) && !empty($request->poll_option2);

            if (!$postTextExists && !$imagesExist && !$validPoll) {
                return response()->json([
                    'success' => false,
                    'message' => __('home.post_empty_error'),
                ], 200);
            }

            $imagePaths = [];
            // تخزين الصورة إذا تم رفعها
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    // تحديد اسم فريد لكل صورة لتجنب تكرار الأسماء
                    $imageName = time() . '_' . uniqid('post_', true) . '.' . $image->getClientOriginalExtension();

                    // نقل الصورة إلى مجلد public/posts_images
                    $image->move(public_path('posts_images'), $imageName);

                    // إضافة المسار إلى المصفوفة
                    $imagePaths[] = 'posts_images/' . $imageName;
                }
            }
            
            // إنشاء المنشور
            $post = Post::create([
                'user_id' => Auth::id(),
                'text' => $validPoll ? strip_tags($request->pollQuestion) : strip_tags($request->postText),
                'image' => json_encode($imagePaths),
                'slug_id' => Str::uuid(),
                'post_type' => $validPoll ? 'poll' : 'normal',
            ]);

            //Create Poll Is Found
            if ($validPoll) {
                // حساب تاريخ انتهاء الاستبيان بناءً على المدة المحددة (ساعات)
                $duration = (int)$request->poll_duration;
                $expiresAt = now()->addHours($duration);

                // إنشاء سجل الاستبيان مع 4 خيارات (الخيارين الأول والثاني مطلوبين)
                $post->poll()->create([
                    'expires_at'      => $expiresAt,
                    'option1_text'    => strip_tags($request->poll_option1),
                    'option2_text'    => strip_tags($request->poll_option2),
                    'option3_text'    => $request->filled('poll_option4') ? strip_tags($request->poll_option3) : null,
                    'option4_text'    => $request->filled('poll_option4') ? strip_tags($request->poll_option4) : null,
                ]);
            }

            // **استخراج أسماء المستخدمين المشار إليهم (@username)**
            preg_match_all('/@(\w+)/', $post->text, $matches);
            $mentionedUsernames = array_unique($matches[1]);

            // **الحصول على المستخدمين المشار إليهم**
            $mentionedUsers = User::whereIn('username', $mentionedUsernames)->get();

            // **إرسال الإشعارات للمستخدمين المشار إليهم**
            foreach ($mentionedUsers as $user) {
                Notification::create([
                    'user_id' => $user->id, // الشخص الذي سيتلقى الإشعار
                    'notifier_id' => Auth::id(), // الشخص الذي قام بالإشارة
                    'notifiable_type' => Post::class,
                    'notifiable_id' => $post->id,
                    'type' => 'mention',
                ]);
            }

            if ($post) 
            {
                Cache::forget('posts_page_' . request('page', 1));
                // تحميل بيانات المستخدم المرتبطة بالمنشور
                $post->load(['user', 'poll']);

                // استخراج نص المنشور
                $post_text = $post->text ? htmlspecialchars($post->text, ENT_QUOTES, 'UTF-8') : null;
                if ($post_text) {
                    $post_text = TextHelper::processMentions($post_text);
                }
                $post_image = $post->image ?json_decode( $post->image) : null;
                $user_name = $post->user->name ? htmlspecialchars($post->user->name, ENT_QUOTES, 'UTF-8') : null;
                $user_username = $post->user->username ? htmlspecialchars($post->user->username, ENT_QUOTES, 'UTF-8') : null;
               
                $user_cover_image = $post->user->profile?->cover_image 
                                    ? htmlspecialchars($post->user->profile->cover_image, ENT_QUOTES, 'UTF-8') 
                                    : null;

                // dd(2);
                $pollData = null;
                if ($post->poll) {
                    $pollData = [
                        'expires_at' => $post->poll->expires_at->format('Y-m-d H:i:s'),
                        'options' => [
                            [
                                'option_text' => $post->poll->option1_text,
                                'votes'       => $post->poll->option1_votes,
                            ],
                            [
                                'option_text' => $post->poll->option2_text,
                                'votes'       => $post->poll->option2_votes,
                            ],
                            [
                                'option_text' => $post->poll->option3_text,
                                'votes'       => $post->poll->option3_votes,
                            ],
                            [
                                'option_text' => $post->poll->option4_text,
                                'votes'       => $post->poll->option4_votes,
                            ],
                        ],
                    ];
                }
                // إرجاع استجابة ناجحة مع بيانات المنشور
                return response()->json([
                    'success' => true,
                    'message' => __('home.post_success'),
                    'post' => [
                        'is_owner' => Auth::id() === $post->user_id,
                        'text' => $post_text,
                        'post_type' => $post->post_type,
                        'image' => $post_image,
                        'slug_id' => $post->slug_id,
                        'created_at' => Carbon::parse($post->created_at)->diffForHumans(),
                        'user' => [
                            'name' => $user_name,
                            'username' => $user_username,
                            'cover_image' => $user_cover_image,
                        ],
                        'poll' => $pollData,
                    ],
                ], 200);
                return response()->json(['success' => true, 'message' => __('home.post_success')]);
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // إرجاع الأخطاء إذا فشل التحقق
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 200);
        } catch (\Exception $e) {
            // معالجة أي استثناء غير متوقع
            return response()->json([
                'success' => false,
                'message' => __('home.unexpected_error').$e,
            ], 200);
        }
    }
   
     
    //Display All Posts For Users
    public function loadPosts()
    {
        $maxLength = 200; // الحد الأقصى لطول النص الذي سيتم عرضه

        
        $res_get_home_page_posts = $this->postService->get_posts();

        if ($res_get_home_page_posts['code'] !== 1) {
            return response()->json([
                'success' => false,
                'message' => $res_get_home_page_posts['msg'], 
            ]);
        }

         
        $posts = $res_get_home_page_posts['data'];

        // تعديل البيانات التي سيتم إرجاعها
        $postsData = $posts->map(function ($post) use ($maxLength) {
            $post_text = $post->text ? htmlspecialchars($post->text, ENT_QUOTES, 'UTF-8') : null;

            // معالجة أسماء المستخدمين المشار إليهم باستخدام الدالة
            if ($post_text) {
                $post_text = TextHelper::processMentions($post_text);
            }
            
            $post_image = $post->image ?json_decode( $post->image) : null;
            $user_name = $post->user->name ? htmlspecialchars($post->user->name, ENT_QUOTES, 'UTF-8') : null;
            $user_username = $post->user->username ? htmlspecialchars($post->user->username, ENT_QUOTES, 'UTF-8') : null;
            $user_cover_image = $post->user->profile->cover_image ? htmlspecialchars($post->user->profile->cover_image, ENT_QUOTES, 'UTF-8') : null;
           

            $pollData = $post->poll ? [
                'expires_at' => $post->poll->expires_at->format('Y-m-d H:i:s'),
                'options' => array_filter([
                    $post->poll->option1_text ? ['option_text' => $post->poll->option1_text, 'votes' => $post->poll->option1_votes] : null,
                    $post->poll->option2_text ? ['option_text' => $post->poll->option2_text, 'votes' => $post->poll->option2_votes] : null,
                    $post->poll->option3_text ? ['option_text' => $post->poll->option3_text, 'votes' => $post->poll->option3_votes] : null,
                    $post->poll->option4_text ? ['option_text' => $post->poll->option4_text, 'votes' => $post->poll->option4_votes] : null,
                ]),
            ] : null;
            
            return [
                'is_owner' => Auth::id() === $post->user_id,
                'slug_id' => $post->slug_id,

                'user' => [
                    'name' => $user_name,
                    'username' => $user_username,
                    'cover_image' => $user_cover_image,
                    'is_private' => $post->user->account_privacy == AccountPrivacy::PRIVATE ? true : false
                ],
                'poll' => $pollData,
                'text' => mb_strlen(strip_tags($post_text)) > $maxLength
                    ? mb_substr(strip_tags($post_text), 0, $maxLength) . '...'
                    : $post_text,
                'post_type' => $post->post_type,
                'image' => $post_image,
                'created_at' => Carbon::parse($post->created_at)->diffForHumans(),

                'comments_count' => $post->replies_count ?? 0,
                'reposts_count' => $post->reposts_count ?? 0,
                'post_likes_count' => $post->post_likes_count ?? 0,
                'is_post_liked' => $post->userPostLike !== null,
                'likedByPhrase' => $post->likedByPhrase
            ];
        });

        // إرجاع النتيجة كـ JSON
        return response()->json([
            'success' => true,
            'posts' => $postsData,
            'next_page' => $posts->hasMorePages() ? $posts->currentPage() + 1 : null,
        ]);
    }




    // Display Post Details For User
    public function detailsPost(String $slug_id)
    {
        $res_getPostBySlug = $this->postService->getPostBySlug($slug_id);
        
        if ($res_getPostBySlug['code'] == 0) 
        {
            // return redirect()->back()->with('error', __('home.post_not_found'));
            return redirect()->back()->with('error', $res_getPostBySlug['msg']);
        }
        
        return view('posts.post_details', ['post' => $res_getPostBySlug['data']]);
    }



    //Delete Post With Replies
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug_id' => 'required|string|exists:posts,slug_id',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'success' => false,
                'message' => __('home.validation_error'),
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }

        $res_deleteBySlugId = $this->postService->deleteBySlugId($request->slug_id);
        if($res_deleteBySlugId['code'] == 0)
        {
               return response()->json([
                'success' => false,
                'message' => __('home.unexpected_error'),
                'errors' => $res_deleteBySlugId['msg']
            ], 200);
        }
        // إرجاع استجابة ناجحة
        return response()->json([
            'success' => true,
            'slug_id' =>  $request->slug_id,
            'message' => __('home.post_deleted_successfully'),
        ], 200);
    }

    //Vote On Poll
    public function storeVote(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => __('home.unauthenticated')], 200);
        }
    
        $request->validate([
            'slug_id' => 'required|exists:posts,slug_id',
            'option_id' => 'required|string',
        ]);
    
        $post = Post::where('slug_id', $request->slug_id)->first();
        $poll = Poll::where('post_id', $post->id)->first();
    
        if (!$poll) {
            return response()->json(['success' => false, 'message' => __('home.poll_not_found')], 200);
        }
    
        // التحقق مما إذا كان المستخدم قد صوّت مسبقًا
        $existingVote = PollVote::where('user_id', Auth::id())->where('poll_id', $poll->id)->first();
    
        if ($existingVote) {
            return response()->json(['success' => false, 'message' => __('home.poll_vote_already')], 200);
        }

        if ($poll->expires_at && now()->greaterThan($poll->expires_at)) {
            return response()->json(['success' => false, 'message' => __('home.poll_duration_ended')], 200);
        }
        
    
        // تخزين التصويت الجديد
        PollVote::create([
            'user_id' => Auth::id(),
            'poll_id' => $poll->id,
            'option_selected' => $request->option_id,
        ]);
    
        // تحديث عدد الأصوات لكل خيار في جدول `polls`
        $optionColumn = "option" . $request->option_id . "_votes";
        $poll->increment($optionColumn);
    
        // تجهيز بيانات الاستبيان لإعادتها بنفس التنسيق المطلوب
        $pollData = [
            'expires_at' => $poll->expires_at->format('Y-m-d H:i:s'),
            'options' => [
                [
                    'id' => 1,
                    'option_text' => $poll->option1_text,
                    'votes'       => $poll->option1_votes,
                ],
                [
                    'id' => 2,
                    'option_text' => $poll->option2_text,
                    'votes'       => $poll->option2_votes,
                ],
                [
                    'id' => 3,
                    'option_text' => $poll->option3_text,
                    'votes'       => $poll->option3_votes,
                ],
                [
                    'id' => 4,
                    'option_text' => $poll->option4_text,
                    'votes'       => $poll->option4_votes,
                ],
            ],
        ];

        return response()->json([
            'success' => true,
            'message' => __('home.poll_vote_success') ,
            'poll' => $pollData,
        ], 200);
    }
    
}
