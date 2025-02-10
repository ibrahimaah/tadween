///////////////Display Messages at home page//////////////////////
var page = 1; // Initial page
var loading = false; // To prevent multiple requests
var hasMoreMessages = true; // التأكد من وجود صفحات إضافية

const url = window.location.pathname;  // Get the full path of the current URL
const pathSegments = url.split('/');   // Split the URL into segments by '/'
const userName = pathSegments[1];   // Extract the username (the first segment after the domain)

// Function to load Messages
function loadMessages() {
    var pagePath = `/messages/load-messages`;

    // منع الطلب عند التحميل أو إذا انتهت الردود
    if (loading || !hasMoreMessages) return;
    loading = true;
    // Show loading spinner
    $('#messages_loading_indicator').removeClass('d-none').addClass('d-flex');

    $.ajax({
        url: pagePath,
        method: 'GET',
        data: { page: page},
        success: function(data) {

            if (data.success === false) {
                var messageDiv = `<div class="py-3 my-5 text-center">${data.message}</div>`;
                $('#display-messages-container').append(messageDiv);
            }
            else if (data.success && data.messages.length > 0) {

                // Loop through messages and append to the container
                data.messages.forEach(function(message) {
                    var username = $('html').attr('lang') === 'ar' ? message.username+'@' : '@'+message.username;
                    
                    var user_image = message.cover_image != null ? '../' + message.cover_image : '../img/logo.webp';
                    var messageLink = `messages/${message.username}/chat`;
                    
                    var messageHtml = `
                        <div class="border-bottom p-3 mb-2" id="message${message.username}">
                            
                            <div class="d-flex justify-content-between">
                                <a href="${messageLink}" class="d-flex text-decoration-none text-dark">
                                    <img src="${user_image}" class="rounded-circle logo-main" alt="User Image">
                                    <div class="px-1">
                                        <p class="mx-1 mb-0">${message.name}</p>
                                        <p class="mx-1 my-0 text-grey">${username}</p>
                                    </div>
                                </a>

                                <div class="text-grey">${ message.last_message }</div>
                            </div>
                        </div>`;
                    $('#display-messages-container').append(messageHtml);
                });

                // تحديث الصفحة التالية
                if (data.next_page) {
                    // تحديث الصفحة إذا كان هناك المزيد
                    page = data.next_page;
                } else {
                    // لا مزيد من الصفحات
                    hasMoreMessages = false;
                    // Hide loading spinner
                    $('#messages_loading_indicator').removeClass('d-flex').addClass('d-none');
                }
            }
            else {
                // إذا كانت الصفحة الأولى فارغة
                $('.empty_messages').removeClass('d-none').addClass('d-block');
                hasMoreMessages = false;
            }
            
            loading = false; // Reset loading flag
        },
        complete: function() {
            // إخفاء مؤشر التحميل دائمًا بعد الطلب
            $('#messages_loading_indicator').removeClass('d-flex').addClass('d-none');
            loading = false;
        }
    });
}

// تفعيل جلب المنشورات عند تحميل الصفحة وعند التمرير
$(document).ready(function() {
    loadMessages();
    $(window).on('scroll', function() {
        var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
        if (scrollBottom <= 100) {
            loadMessages();
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
        refreshMessages();
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
        refreshMessages();
    }
});

// Function to refresh posts
function refreshMessages() {
    if (isRefreshing) return;
    isRefreshing = true;

    // Reset page and fetch posts from the start
    page = 1;
    hasMoreMessages = true;
    $('#display-messages-container').empty(); // تفريغ المنشورات الحالية
    $('#pullToRefreshIndicator').removeClass('d-flex').addClass('d-none');

    loadMessages(); // جلب المنشورات مرة أخرى
    isRefreshing = false;
}