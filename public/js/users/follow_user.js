//User Follow
function followUser(userName){
    const csrfToken = $('meta[name="csrf-token"]').attr('content'); // احصل على CSRF Token
    $.ajax({
        url: '/follows',
        type: 'POST',
        data: {
            userName: userName,
            _token: csrfToken
        },
        success: function (response) {
            // تغيير النص والأيقونة بناءً على حالة المتابعة
            if (response.is_user_follow) {
                // إذا كان المستخدم قد تابع
                $(`#follow${userName} .follow_text_btn`).text(response.follow_text_btn); // التحديث بالنص الجديد
            } else {
                // إذا كان المستخدم قد ألغى المتابعة
                $(`#follow${userName} .follow_text_btn`).text(response.follow_text_btn); // التحديث بالنص الجديد
            }
            $('.follower_count').text(response.followers_count);
            $('.following_count').text(response.following_count);
            // تحديث رسالة التوست
            $('.toast .toast-body').text(response.message);

            // تفعيل التوست
            var toast = new bootstrap.Toast($('.toast'));
            toast.show();
            
        }
    });
}