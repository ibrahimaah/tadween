//Delete Post
$(document).on('click', '.delete-post-btn', function (e) {
    e.preventDefault();
    var slug_id = $(this).attr('id');
    $('.confirm-delete-btn').attr('id', slug_id);
});

// معالجة زر الحذف داخل المودل
$(document).on('click', '.confirm-delete-btn', function () {
    var slug_id = $(this).attr('id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content'); // احصل على CSRF Token
    const currentPath = window.location.pathname; // المسار الحالي
    const isPostDetailsPage = currentPath.includes('/posts/'); // التحقق إذا كان الرابط يحتوي على "profile"

    $.ajax({
        url: `/posts/${slug_id}`,
		method: 'POST',  // ⬅️ استخدم `POST` بدلاً من `DELETE`
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        data: {
            _method: 'DELETE' // ⬅️ Laravel سيتعامل معه كـ `DELETE`
        },
        success: function (response) {
            if (response.success) {
                $('#deleteMessage').html(`<p class="alert alert-success">${response.message}</p>`);

                $(`#post${response.slug_id}`).remove();

                setTimeout(function () {
                    $(`#deletePostModal`).modal('hide');
                    $('#deleteMessage').html('');
                    if (isPostDetailsPage) {
                        window.location.href='/';
                    }
                }, 1000);
            } else {
                $('#deleteMessage').html(`<p class="alert alert-danger">${response.message}</p>`);
            }
        }
    });
    
});