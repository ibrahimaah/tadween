let page = 1;
let loading = false;
let hasMoreReplies = true;
const slugId = window.location.pathname.split('/').pop();

function loadReplies() 
{
    if (loading || !hasMoreReplies) return;
    loading = true;

    $('#replies_loading_indicator').removeClass('d-none').addClass('d-flex');

    $.ajax({
        url: '/load-replies',
        method: 'GET',
        data: { slug_id: slugId,page },
        success: function(response) {
            if (response.success) 
            {
                if(response.replies.length)
                { 
                    response.replies.forEach(reply => {
                        const replyHtml = `
                            <div class="bg-white rounded-4 p-3 mb-2" id="reply${reply.slug_id}">
                                ${renderReplyHeader(reply)}
                                ${renderReplyBody(reply)}
                                ${renderReplyFooter(reply)}
                            </div>`;
                        $('#display-replies-container').append(replyHtml);
                    });
        
                    if (response.next_page) {
                        page = response.next_page;
                    } else {
                        hasMoreReplies = false;
                    }
                }
                else 
                {
                    $('.empty_replies').removeClass('d-none').addClass('d-block');
                    hasMoreReplies = false;
                }
            }
            else 
            {
                toastr.error(response.msg)
                toastr.error(response.errors)
            } 
        },
        error: function(xhr) 
        { 
            const errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred.';
            toastr.error(errorMsg); // or show it in a div
            hasMoreReplies = false;
        },
        complete: function() {
            $('#replies_loading_indicator').removeClass('d-flex').addClass('d-none');
            loading = false;
        }
    });
    
}

// Handle reply image modal
$(document).on('click', '.reply-image', function() {
    $('#modalImage').attr('src', $(this).data('image'));
    $('#replyImageModal').modal('show');
});

// Initial load and infinite scroll
$(document).ready(function() {
    loadReplies();
    $(window).on('scroll', function() {
        if ($(document).height() - $(window).height() - $(window).scrollTop() <= 100) {
            loadReplies();
        }
    });
});

// Set ID for delete confirmation
$(document).on('click', '.delete-reply-btn', function(e) {
    e.preventDefault();
    $('.confirm-delete-btn-reply').attr('id', $(this).attr('id'));
});

// Confirm delete
$(document).on('click', '.confirm-delete-btn-reply', function() {
    const id = $(this).attr('id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: `/replies/${id}`,
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        data: { _method: 'DELETE' },
        success: function(response) {
            if (response.success) {
                $('.comments_count').text(response.comments_count);
                $('#deleteMessageReply').html(`<p class="alert alert-success">${response.message}</p>`);
                $(`#reply${response.slug_id}`).remove();

                setTimeout(() => {
                    $('#deleteReplyModal').modal('hide');
                    $('#deleteMessageReply').html('');
                }, 1000);
            } else {
                $('#deleteMessageReply').html(`<p class="alert alert-danger">${response.message}</p>`);
            }
        }
    });
});

// Pull to refresh
let isRefreshing = false;
let refreshThreshold = 50;
let startY = 0;
let isPulling = false;

$(document).on('touchstart mousedown', function(e) {
    if ($(window).scrollTop() === 0) {
        startY = e.touches ? e.touches[0].clientY : e.clientY;
        isPulling = true;
    }
});

$(document).on('touchmove mousemove', function(e) {
    if (!isPulling) return;
    const currentY = e.touches ? e.touches[0].clientY : e.clientY;
    if (currentY - startY > refreshThreshold) {
        $('#pullToRefreshIndicator').removeClass('d-none').addClass('d-flex');
    }
});

$(document).on('touchend mouseup', function() {
    if (!isPulling) return;
    isPulling = false;

    if ($('#pullToRefreshIndicator').hasClass('d-flex')) {
        refreshReplies();
    }
});

function refreshReplies() {
    if (isRefreshing) return;
    isRefreshing = true;

    page = 1;
    hasMoreReplies = true;
    $('#display-replies-container').empty();

    loadReplies();
    isRefreshing = false;
    $('#pullToRefreshIndicator').removeClass('d-flex').addClass('d-none');
}
