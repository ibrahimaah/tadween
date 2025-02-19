///////////////Display Replies On Post at home page//////////////////////
var page = 1; // Initial page
var loading = false; // To prevent multiple requests
var hasMoreReplies = true; // التأكد من وجود صفحات إضافية
// استخراج slug_id من رابط الصفحة
const slugId = window.location.pathname.split('/').pop();

// Function to load replies on posts
function loadReplies() {
    // منع الطلب عند التحميل أو إذا انتهت الردود
    if (loading || !hasMoreReplies) return;
    loading = true;

    // Show loading spinner
    $('#replies_loading_indicator').removeClass('d-none').addClass('d-flex');

    $.ajax({
        url: '/load-replies', // Route to load replies
        method: 'GET',
        data: { slug_id: slugId, page: page }, // Pass current page
        success: function(data) {
            if (data.success && data.replies.length > 0) {
                var deleteText = $('html').attr('lang') === 'ar' ? 'حذف الرد' : 'Delete Reply';
                var dropMenuClass = $('html').attr('lang') === 'ar' ? 'text-end' : 'text-start';
                // Loop through replies and append to the container
                data.replies.forEach(function(reply) {
                    var user_image = reply.user.cover_image != null ? '../' + reply.user.cover_image : '../img/logo.png';
                    var reply_image = reply.reply_image != null ? `<img src="../${reply.reply_image}" class="img-fluid reply-image" alt="Reply Image" data-bs-toggle="modal" data-bs-target="#replyImageModal" data-image="../${reply.reply_image}">` : '';
                    var userName = $('html').attr('lang') === 'ar' ? reply.user.username+'@' : '@'+reply.user.username;

                    var deleteButton = '';
                    if (reply.is_owner) {
                        deleteButton = `<div class="dropstart">
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical text-orange-color"></i>
                            </button>

                            <ul class="dropdown-menu ${dropMenuClass}">
                                <li>
                                    <!-- Delete Reply Link -->
                                    <button class="dropdown-item delete-reply-btn" id="${reply.slug_id}" data-bs-toggle="modal" data-bs-target="#deleteReplyModal">
                                        <i class="fa-regular fa-trash-can text-orange-color"></i><span class="mx-1">${deleteText}</span>
                                    </button>
                                </li>
                            </ul>
                        </div>`;
                    }

                    var postHtml = `
                        <div class="bg-white rounded-4 p-3 mb-2" id="reply${reply.slug_id}">
                            
                            <div class="d-flex justify-content-between">
                                <a href="/${reply.user.username}" class="d-flex text-decoration-none text-dark">
                                    <img src="${user_image}" class="rounded-circle logo-main" alt="User Image">
                                    <div class="px-1">
                                        <p class="mx-1 mb-0">${reply.user.name}</p>
                                        <p class="mx-1 mt-0 text-grey">${userName} (${reply.created_at})</p>
                                    </div>
                                </a>

                                ${deleteButton}

                            </div>

                            <p class="post-text mb-3">${reply.reply_text ?? ''}</p>
                            <p class="w-25" >${reply_image}</p>

                        </div>`;
                    $('#display-replies-container').append(postHtml);
                });

                // تحديث الصفحة التالية
                if (data.next_page) {
                    // تحديث الصفحة إذا كان هناك المزيد
                    page = data.next_page;
                } else {
                    // لا مزيد من الصفحات
                    hasMoreReplies = false;
                    // Hide loading spinner
                    $('#replies_loading_indicator').removeClass('d-flex').addClass('d-none');
                }
            }
            else {
                // إذا كانت الصفحة الأولى فارغة
                $('.empty_replies').removeClass('d-none').addClass('d-block');
                hasMoreReplies = false; // لا مزيد من الردود
            }

            loading = false; // Reset loading flag
        },
        
        complete: function() {
            // إخفاء مؤشر التحميل دائمًا بعد الطلب
            $('#replies_loading_indicator').removeClass('d-flex').addClass('d-none');
            loading = false;
        }
    });
}

// Event listener for reply images
$(document).on('click', '.reply-image', function() {
    var imageUrl = $(this).data('image');
    $('#modalImage').attr('src', imageUrl);
    $('#replyImageModal').modal('show');
});

// تفعيل جلب الردود عند تحميل الصفحة وعند التمرير
$(document).ready(function() {
    loadReplies();
    $(window).on('scroll', function() {
        
        var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
        if (scrollBottom <= 100) {
            loadReplies();
        }
    });
});


//Delete Reply From Post
$(document).on('click', '.delete-reply-btn', function (e) {
    e.preventDefault();
    var slug_id = $(this).attr('id');
    $('.confirm-delete-btn-reply').attr('id', slug_id);
});

// معالجة زر الحذف داخل المودل
$(document).on('click', '.confirm-delete-btn-reply', function () {
    var slug_id = $(this).attr('id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content'); // احصل على CSRF Token

    $.ajax({
        url: `/replies/${slug_id}`,
        method: 'POST',  // ⬅️ استخدم `POST` بدلاً من `DELETE`
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        data: {
            _method: 'DELETE' // ⬅️ Laravel سيتعامل معه كـ `DELETE`
        },
        success: function (response) {
            if (response.success) {
                // تحديث عدد التعليقات في الواجهة
                document.querySelector('.comments_count').textContent = response.comments_count;

                $('#deleteMessageReply').html(`<p class="alert alert-success">${response.message}</p>`);

                $(`#reply${response.slug_id}`).remove();

                setTimeout(function () {
                    $(`#deleteReplyModal`).modal('hide');
                    $('#deleteMessageReply').html('');
                }, 1000);
            } else {
                $('#deleteMessageReply').html(`<p class="alert alert-danger">${response.message}</p>`);
            }
        }
    });
    
});


///////////////////////////////////////////////////
var isRefreshing = false; // لتجنب التحديث أثناء عملية التحديث
var refreshThreshold = 50; // الحد الأدنى للسحب لبدء التحديث
var startY = 0; // موقع السحب الأولي
var isPulling = false; // التحقق من حالة السحب

// Event listeners for touch events (الحاسوب)
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
        refreshReplies();
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
        refreshReplies();
    }
});

// Function to refresh replies
function refreshReplies() {
    if (isRefreshing) return;
    isRefreshing = true;

    // Reset page and fetch replies from the start
    page = 1;
    hasMoreReplies = true;
    $('#display-replies-container').empty(); // تفريغ المنشورات الحالية

    loadReplies(); // جلب المنشورات مرة أخرى
    isRefreshing = false;
    $('#pullToRefreshIndicator').removeClass('d-flex').addClass('d-none');

}

