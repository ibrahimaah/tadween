//Post Like
$(document).on('click', '#post-like-section', function () {
    const csrfToken = $('meta[name="csrf-token"]').attr('content'); // احصل على CSRF Token
    var slug_id = $(this).attr('post-slug-data');

    const currentPath = window.location.pathname; // المسار الحالي
    const isProfilePage = currentPath.includes('/profile/'); // التحقق إذا كان الرابط يحتوي على "profile"

    $.ajax({
        url: '/post-like',
        type: 'POST',
        data: {
            slug_id: slug_id,
            _token: csrfToken
        },
        success: function (response) {
            if (response.success) {
                // تحديث عدد الإعجابات
                $(`#post${slug_id} #post-like-count`).text(response.post_like_count);
                if (response.is_post_like) {
                    $(`#post${slug_id} #post-like-btn`).addClass('text-orange-color');
                } else {
                    // إذا كانت الصفحة هي صفحة البروفايل، قم بحذف المنشور عند إزالة الإعجاب
                    if (isProfilePage) {
                        $(`#post${slug_id}`).remove();
                    }
                    $(`#post${slug_id} #post-like-btn`).removeClass('text-orange-color');
                }
            }

            // تحديث رسالة التوست
            $('.toast .toast-body').text(response.message);

            // تفعيل التوست
            var toast = new bootstrap.Toast($('.toast'));
            toast.show();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});
