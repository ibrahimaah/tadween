///////////////Display Posts at home page//////////////////////
var page = 1; // Initial page
var loading = false; // To prevent multiple requests
var hasMorePosts = true; // التأكد من وجود صفحات إضافية
const userName = window.location.pathname.split('/').pop();
var pagePath = '';
// Function to load posts
function loadPosts() {
    // منع الطلب عند التحميل أو إذا انتهت الردود
    if (loading || !hasMorePosts) return;
    loading = true;
    // Show loading spinner
    $('#posts_loading_indicator').removeClass('d-none').addClass('d-flex');

    $.ajax({
        url: pagePath,
        method: 'GET',
        data: { page: page },
        success: function(data) {
            if (data.success === false) {
                $('#display-posts-container').append(data.message);
            }
            else if (data.success && data.posts.length > 0) {
                var deleteText = $('html').attr('lang') === 'ar' ? 'حذف المنشور' : 'Delete post';
                var dropMenuClass = $('html').attr('lang') === 'ar' ? 'text-end' : 'text-start';

                // Loop through posts and append to the container
                data.posts.forEach(function(post) {
                    var username = $('html').attr('lang') === 'ar' ? post.user.username+'@' : '@'+post.user.username;
                    
                    // alert(is_private);
                    // console.log(post.user)
                    //Load Posts At Home AND Profile Page
                    var user_image = post.user.cover_image != null ? post.user.cover_image : 'img/user.jpg';
                    var is_private = post.user.is_private;
                    // تحويل السلسلة النصية إلى مصفوفة
                    var post_image = '';
                    if (post.image) {
                        post.image.forEach(function(image) {
                            post_image += `
                            <div class="col">
                                <img src="${image}" class="img-fluid h-100" alt="post Image">
                            </div>`;
                        });
                    }

                    var profileLink = `/${post.user.username}`;
                    
                    
                    var deleteButton = '';
                    if (post.is_owner) {
                        deleteButton = `<div class="dropstart">
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical text-orange-color"></i>
                            </button>

                            <ul class="dropdown-menu ${dropMenuClass}">
                                <li>
                                    <!-- Delete Post Link -->
                                    <button class="dropdown-item delete-post-btn" id="${post.slug_id}" data-bs-toggle="modal" data-bs-target="#deletePostModal">
                                        <i class="fa-regular fa-trash-can text-orange-color"></i><span class="mx-1">${deleteText}</span>
                                    </button>
                                </li>
                            </ul>
                        </div>`;
                    }

                    var post_type = '';
                    if (post.post_type === 'poll') {
                        var poll_options = ''

                        let totalVotes = post.poll.options.reduce((sum, option) => sum + option.votes, 0);

                        post.poll.options.forEach((poll) => {
                            if (poll.option_text != null) {
                                let percentage = totalVotes === 0 ? 0 : (poll.votes / totalVotes) * 100;
                                var vote = $('html').attr('lang') === 'ar' ? 'صوت' : 'vote';
                                
                                poll_options += `
                                <div class="mb-3">
                                    <button class="btn btn-outline-danger w-100 vote-btn" data-option="${poll.option_text}" data-post="${post.slug_id}">${poll.option_text}</button>
                                    <div class="progress mt-2">
                                        <div id="progress${poll.option_text}" class="progress-bar bg-danger" role="progressbar" style="width: ${percentage}%;">${Math.round(percentage)}%</div>
                                    </div>
                                    <span class="vote-count" id="vote-count-${poll.option_text}">
                                        ${poll.votes} ${vote}
                                    </span>
                                </div>`;
                            }
                        });
                        var allVotes = $('html').attr('lang') === 'ar' ? 'إجمالي التصويتات:' : 'Total votes:';
                        var finishVotes = $('html').attr('lang') === 'ar' ? 'ينتهي التصويت في :' : 'Voting ends at:';
                        let totalVotesHtml = `<p class="mt-3 text-muted">📊 ${allVotes} <strong>${totalVotes}</strong></p>`;

                        post_type =`
                        <div class="text-dark">
                            <h4 class="mb-4">${post.text}</h4>
                            <div class="mb-3">${poll_options}</div>
                            ${totalVotesHtml}
                            <p class="mt-4 text-muted">⏳ ${finishVotes} ${post.poll.expires_at}</p>
                        </div>`;
                    } else {
                        post_type =`
                        <div class="text-dark">
                            <p class="post-text mb-3">${post.text ?? ''}</p>
                            <div class="row">${post_image}</div>
                        </div>`;
                    }
                    
                    var postHtml = `
                        <div class="bg-white rounded-4 p-3 mb-2" id="post${post.slug_id}">
                            
                            <div class="d-flex justify-content-between">
                                <a href="${profileLink}" class="d-flex text-decoration-none text-dark">
                                    <img src="${user_image}" class="rounded-circle logo-main" alt="User Image">
                                    <div class="px-1">
                                        <p class="mx-1 mb-0">
                                            ${post.user.name}
                                             ${is_private ? '<i class="fa-solid fa-lock text-orange-color me-1"></i>' : ''} 
                                        </p>
                                        <p class="mx-1 mt-0 text-grey">
                                            ${username}
                                            (${post.created_at})
                                        </p>
                                    </div> 
                                </a>
                                ${deleteButton}
                            </div>



                            ${post_type}

                            <div class="row text-center mt-3">
                                <div class="col">
                                    <a href="posts/${post.slug_id}" class="text-decoration-none text-dark link_hover">
                                        ${post.comments_count ?? 0}
                                        <i class="fa-regular fa-message"></i>
                                    </a>
                                </div>
                                <div class="col">${post.reposts_count ?? 0} <i class="fa-solid fa-rotate"></i></div>

                                <div class="col" id="post-like-section" post-slug-data="${post.slug_id}">
                                    <span class="link_hover">
                                        <span id="post-like-count">${post.post_likes_count ?? 0}</span>
                                        <i class="fa-regular fa-thumbs-up ${post.is_post_liked?'text-orange-color':''}" id="post-like-btn"></i>
                                    </span>
                                </div>
                                
                                <div class="col"><i class="fa-regular fa-share-from-square"></i></div>
                            </div>

                        </div>`;
                    $('#display-posts-container').append(postHtml);
                });

                // تحديث الصفحة التالية
                if (data.next_page) {
                    // تحديث الصفحة إذا كان هناك المزيد
                    page = data.next_page;
                } else {
                    // لا مزيد من الصفحات
                    hasMorePosts = false;
                    // Hide loading spinner
                    $('#posts_loading_indicator').removeClass('d-flex').addClass('d-none');
                }
            }
            else {
                // إذا كانت الصفحة الأولى فارغة
                $('.empty_posts').removeClass('d-none').addClass('d-block');
                hasMorePosts = false;
            }
            
            loading = false; // Reset loading flag
        },
        console:function(data){
            console.log(data.error)
        }
        ,
        complete: function() {
            // إخفاء مؤشر التحميل دائمًا بعد الطلب
            $('#posts_loading_indicator').removeClass('d-flex').addClass('d-none');
            loading = false;
        }
    });
}


// تفعيل جلب المنشورات عند تحميل الصفحة وعند التمرير
$(document).ready(function() {

    if (userName === '') {
        //if page is home
        pagePath = '/load-posts';
    } else {
        //if page is profile
        pagePath = `/${userName}/posts`;
    }
    loadPosts();
    $(window).on('scroll', function() {
        var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
        if (scrollBottom <= 100) {
            loadPosts();
        }
    });
});

//////////////////////////////////////////////
$(document).on('click', '.tab-link', function(e) {
    e.preventDefault();
    // Remove the 'active' class from all tabs
    $('.tab-link').removeClass('active');

    // Add the 'active' class to the clicked tab
    $(this).addClass('active');

    var selectedTab = $(this).data('tab');
    page = 1;
    hasMorePosts = true;
    $('.empty_posts').addClass('d-none').removeClass('d-block');
    $('#display-posts-container').empty();

    if (selectedTab === 'userPosts') {
        pagePath = `/${userName}/posts`;
        loadPosts();
    } else if (selectedTab === 'userPostsReplies') {
        pagePath = `/${userName}/posts/replies`;
        loadPosts();
    } else if (selectedTab === 'userPostsMedia') {
        pagePath = `/${userName}/posts/media`;
        loadPosts();
    } else {
        pagePath = `/${userName}/posts/likes`;
        loadPosts();
    }
});

////////////////////////////////////////////

///////////////////////////////////////////////////
var isRefreshing = false; // لتجنب التحديث أثناء عملية التحديث
var refreshThreshold = 50; // الحد الأدنى للسحب لبدء التحديث
var startY = 0; // موقع السحب الأولي
var isPulling = false; // التحقق من حالة السحب

// Event listeners for touch events (الهاتف)
$(document).on('touchstart', function (e) {
    if ($(window).scrollTop() === 0) {
        startY = e.touches[0].clientY;
        isPulling = true;
    }
});

$(document).on('touchmove', function (e) {
    if (!isPulling) return;

    var currentY = e.touches[0].clientY;
    if (currentY - startY > refreshThreshold) {
        $('#pullToRefreshIndicator').removeClass('d-none').addClass('d-flex');
    }
});

$(document).on('touchend', function () {
    if (!isPulling) return;
    isPulling = false;

    if ($('#pullToRefreshIndicator').hasClass('d-flex')) {
        refreshPosts();
    }
});

// Event listeners for mouse events (الحاسوب)
$(document).on('mousedown', function (e) {
    if ($(window).scrollTop() === 0) {
        startY = e.clientY; // تسجيل النقطة الأولية عند النقر
        isPulling = true;
    }
});

$(document).on('mousemove', function (e) {
    if (!isPulling) return;

    var currentY = e.clientY; // موقع المؤشر الحالي
    if (currentY - startY > refreshThreshold) {
        $('#pullToRefreshIndicator').removeClass('d-none').addClass('d-flex');
    }
});

$(document).on('mouseup', function () {
    if (!isPulling) return;
    isPulling = false;
    if ($('#pullToRefreshIndicator').hasClass('d-flex')) {
        refreshPosts();
    }
});

// Function to refresh posts
function refreshPosts() {
    if (isRefreshing) return;
    isRefreshing = true;

    // Reset page and fetch posts from the start
    page = 1;
    hasMorePosts = true;
    $('#display-posts-container').empty(); // تفريغ المنشورات الحالية
    $('#pullToRefreshIndicator').removeClass('d-flex').addClass('d-none');

    loadPosts(); // جلب المنشورات مرة أخرى
    isRefreshing = false;
}
