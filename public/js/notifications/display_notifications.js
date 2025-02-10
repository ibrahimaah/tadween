///////////////Display Notifications at Notifications page//////////////////////
var page = 1; // Initial page
var loading = false; // To prevent multiple requests
var hasMoreNotifications = true; // التأكد من وجود صفحات إضافية
var pagePath = '/load-notifications';

// Function to load notifications
function loadNotifications() {
    // منع الطلب عند التحميل أو إذا انتهت الردود
    if (loading || !hasMoreNotifications) return;
    loading = true;
    // Show loading spinner
    $('#notifications_loading_indicator').removeClass('d-none').addClass('d-flex');

    $.ajax({
        url: pagePath,
        method: 'GET',
        data: { page: page },
        success: function(data) {
            if (data.success === false) {
                $('#display-notifications-container').append(data.message);
            }
            else if (data.success && data.notificationsData.length > 0) {
                var lang = $('html').attr('lang');
                var lang = lang === 'ar' ? 'حذف المنشور' : 'Delete post';

                // Loop through notifications and append to the container
                data.notificationsData.forEach(function(notification) {
                    var readLink = '';
                    
                    if(notification['type'] == 'mention'){
                        readLink = `
                            <a href="notifications/${notification['id'] }" class="text-decoration-none text-dark">
                            ${notification.message}
                            </a>`;
                    } else if(notification['type'] == 'new_like'){
                        readLink = `
                            <a href="notifications/${notification['id'] }" class="text-decoration-none text-dark">
                            ${notification.message}
                            </a>`;
                    } else if(notification['type'] == 'new_reply'){
                        readLink = `
                            <a href="notifications/${notification['id'] }" class="text-decoration-none text-dark">
                            ${notification.message}
                            </a>`;
                    } else {
                        readLink = `
                        <a href="notifications/${notification['id'] }" class="text-decoration-none text-dark">
                        ${notification.message}
                        </a>`;
                    }

                    var notificationHtml = `
                        <div class="p-3">
                            <div class="${notification.is_read?'bg-white':'bg-success'} bg-opacity-10 rounded border p-3 mb-2" id="notification${notification.id}">

                                <div class="text-decoration-none text-dark">
                                    ${readLink}
                                    <span class="text-muted">${ notification['created_at'] }</span>
                                </div>
                            </div>
                        </div>`;
                    $('#display-notifications-container').append(notificationHtml);
                });

                // تحديث الصفحة التالية
                if (data.next_page) {
                    // تحديث الصفحة إذا كان هناك المزيد
                    page = data.next_page;
                } else {
                    // لا مزيد من الصفحات
                    hasMoreNotifications = false;
                    // Hide loading spinner
                    $('#notifications_loading_indicator').removeClass('d-flex').addClass('d-none');
                }
            }
            else {
                // إذا كانت الصفحة الأولى فارغة
                $('.empty_notifications').removeClass('d-none').addClass('d-block');
                hasMoreNotifications = false;
            }
            
            loading = false; // Reset loading flag
        },
        console:function(data){
            console.log(data.error)
        }
        ,
        complete: function() {
            // إخفاء مؤشر التحميل دائمًا بعد الطلب
            $('#notifications_loading_indicator').removeClass('d-flex').addClass('d-none');
            loading = false;
        }
    });
}

// تفعيل جلب الاشعارات عند تحميل الصفحة وعند التمرير
$(document).ready(function() {
    loadNotifications();
    $(window).on('scroll', function() {
        var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
        if (scrollBottom <= 100) {
            loadNotifications();
        }
    });
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
        refreshNotifications();
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
        refreshNotifications();
    }
});

// Function to refresh notifications
function refreshNotifications() {
    if (isRefreshing) return;
    isRefreshing = true;

    // Reset page and fetch notifications from the start
    page = 1;
    hasMoreNotifications = true;
    $('#display-notifications-container').empty(); // تفريغ الاشعارات الحالية
    $('#pullToRefreshIndicator').removeClass('d-flex').addClass('d-none');

    loadNotifications(); // جلب الاشعارات مرة أخرى
    isRefreshing = false;
}
