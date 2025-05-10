$(document).on('click', '.confirm-delete-btn', function () {
    var slug_id = $(this).attr('id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const currentPath = window.location.pathname;
    const isPostDetailsPage = currentPath.includes('/posts/');

    $.ajax({
        url: `/posts/${slug_id}`,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        data: {
            _method: 'DELETE',
            slug_id: slug_id, // ⬅️ Important for validation in your controller
        },
        success: function (response) {
            if (response.success) {
                $('#deleteMessage').html(`<p class="alert alert-success">${response.message}</p>`);
                $(`#post${response.slug_id}`).remove();

                setTimeout(function () {
                    $('#deletePostModal').modal('hide');
                    $('#deleteMessage').html('');
                    if (isPostDetailsPage) {
                        window.location.href = '/';
                    }
                }, 1000);
            } else {
                $('#deleteMessage').html(`<p class="alert alert-danger">${response.message}</p>`);
            }
        },
        error: function (xhr) {
            let response = xhr.responseJSON;
            if (xhr.status === 422 && response.errors) {
                let errorsHtml = '<ul>';
                $.each(response.errors, function (key, value) {
                    errorsHtml += `<li>${value}</li>`;
                });
                errorsHtml += '</ul>';
                $('#deleteMessage').html(`<div class="alert alert-danger">${errorsHtml}</div>`);
            } else {
                $('#deleteMessage').html(`<div class="alert alert-danger">${response?.message || 'Unexpected error occurred.'}</div>`);
            }
        }
    });
});
