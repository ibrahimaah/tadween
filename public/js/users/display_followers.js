///////////////Display Followers at home page//////////////////////
var page = 1; // Initial page
var loading = false; // To prevent multiple requests
var hasMoreFollowers = true; // التأكد من وجود صفحات إضافية

const url = window.location.pathname;  // Get the full path of the current URL
const pathSegments = url.split('/');   // Split the URL into segments by '/'
const userName = pathSegments[1];   // Extract the username (the first segment after the domain)

// Function to load Followers
function loadFollows() {
    var pagePath = `/${userName}/${pathSegments[2]}/load-${pathSegments[2]}`;

    // منع الطلب عند التحميل أو إذا انتهت الردود
    if (loading || !hasMoreFollowers) return;
    loading = true;
    // Show loading spinner
    $('#follows_loading_indicator').removeClass('d-none').addClass('d-flex');

    $.ajax({
        url: pagePath,
        method: 'GET',
        data: { page: page},
        success: function(data) {

            if (data.success === false) {
                var messageDiv = `<div class="py-3 my-5 text-center">${data.message}</div>`;
                $('#display-follows-container').append(messageDiv);
            }
            else if (data.success && data.follows.length > 0) {

                // Loop through follows and append to the container
                data.follows.forEach(function(follow) {
                    var username = $('html').attr('lang') === 'ar' ? follow.username+'@' : '@'+follow.username;
                    var bioTextMargin = $('html').attr('lang') === 'ar' ? 'me-5' : 'ms-5';
                    var bioTextMargin = $('html').attr('lang') === 'ar' ? 'me-5' : 'ms-5';
                    var is_private = follow.is_private;
                    var is_blocked_by_current_user = follow.is_blocked_by_current_user;
                    var blocked_btn_txt = follow.blocked_btn_txt;
                    if (userName === '') {
                        //Load Posts At Home Page
                        var user_image = follow.cover_image != null ? '../' + follow.cover_image : '../img/logo.png';
                        var followLink = `profile/${follow.username}`;
                        
                    } else {
                        //Load Posts At Profile Page
                        var user_image = follow.cover_image != null ? '../' + follow.cover_image : '../img/logo.png';
                        var followLink = `/${follow.username}`;
                    }
                    
                    var btn = `<button type="button" class="btn btn-sm btn-orange text-light" onclick="followUser('${follow.username}')">
                                    <span class="follow_text_btn">
                                        ${ follow.follower_btn_text }
                                    </span>
                                </button>`;
                    
                    if(is_blocked_by_current_user)
                    {
                        btn = `<button type="button" class="btn btn-sm btn-outline-danger disabled">
                                    <span class="follow_text_btn">
                                        ${blocked_btn_txt}
                                    </span>
                                </button>`;
                    }
                    var followHtml = `
                        <div class="bg-white rounded-4 p-3 mb-2" id="follow${follow.username}">
                            
                            <div class="d-flex justify-content-between">
                                <a href="${followLink}" class="d-flex text-decoration-none text-dark">
                                    <img src="${user_image}" class="rounded-circle logo-main" alt="User Image">
                                    <div class="px-1">
                                         <p class="mx-1 mb-0">
                                            ${follow.name}
                                             ${is_private ? '<i class="fa-solid fa-lock text-orange-color me-1"></i>' : ''} 
                                        </p>
                                        <p class="mx-1 my-0 text-grey">${username}</p>
                                    </div>
                                </a>

                                <div>
                                    ${btn}
                                </div>
                            </div>
                            <div class=" bio mt-1 ${bioTextMargin}">${ follow.user_bio ?? '' }</div>

                        </div>`;
                    $('#display-follows-container').append(followHtml);
                });

                // تحديث الصفحة التالية
                if (data.next_page) {
                    // تحديث الصفحة إذا كان هناك المزيد
                    page = data.next_page;
                } else {
                    // لا مزيد من الصفحات
                    hasMoreFollowers = false;
                    // Hide loading spinner
                    $('#follows_loading_indicator').removeClass('d-flex').addClass('d-none');
                }
            }
            else {
                // إذا كانت الصفحة الأولى فارغة
                $('.empty_follows').removeClass('d-none').addClass('d-block');
                hasMoreFollowers = false;
            }
            
            loading = false; // Reset loading flag
        },
        console:function(data){
            console.log(data.error)
        }
        ,
        complete: function() {
            // إخفاء مؤشر التحميل دائمًا بعد الطلب
            $('#follows_loading_indicator').removeClass('d-flex').addClass('d-none');
            loading = false;
        }
    });
}

// تفعيل جلب المنشورات عند تحميل الصفحة وعند التمرير
$(document).ready(function() {
    loadFollows();
    $(window).on('scroll', function() {
        var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
        if (scrollBottom <= 100) {
            loadFollows();
        }
    });
});


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
        refreshFollows();
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
        refreshFollows();
    }
});

// Function to refresh posts
function refreshFollows() {
    if (isRefreshing) return;
    isRefreshing = true;

    // Reset page and fetch posts from the start
    page = 1;
    hasMoreFollowers = true;
    $('#display-follows-container').empty(); // تفريغ المنشورات الحالية
    $('#pullToRefreshIndicator').removeClass('d-flex').addClass('d-none');

    loadFollows(); // جلب المنشورات مرة أخرى
    isRefreshing = false;
}