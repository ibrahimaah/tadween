let page = 1;
let loading = false;
let hasMoreReplies = true;
const slugId = window.location.pathname.split('/').pop();

function renderReplyHeader(reply) {
    const userImage = reply.user.cover_image ? `../${reply.user.cover_image}` : '../img/logo.png';
    const isPrivate = reply.user.is_private ? '<i class="fa-solid fa-lock text-orange-color me-1"></i>' : '';
    const userName = document.documentElement.lang === 'ar' ? `${reply.user.username}@` : `@${reply.user.username}`;
    const deleteText = document.documentElement.lang === 'ar' ? 'حذف الرد' : 'Delete Reply';
    const dropMenuClass = document.documentElement.lang === 'ar' ? 'text-end' : 'text-start';

    const deleteButton = reply.is_owner ? `
        <div class="dropstart">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical text-orange-color"></i>
            </button>
            <ul class="dropdown-menu ${dropMenuClass}">
                <li>
                    <button class="dropdown-item delete-reply-btn" id="${reply.slug_id}" data-bs-toggle="modal" data-bs-target="#deleteReplyModal">
                        <i class="fa-regular fa-trash-can text-orange-color"></i><span class="mx-1">${deleteText}</span>
                    </button>
                </li>
            </ul>
        </div>` : '';

    return `
        <div class="d-flex justify-content-between">
            <a href="/${reply.user.username}" class="d-flex text-decoration-none text-dark">
                <img src="${userImage}" class="rounded-circle logo-main" alt="User Image">
                <div class="px-1">
                    <p class="mx-1 mb-0">${reply.user.name} ${isPrivate}</p>
                    <p class="mx-1 mt-0 text-grey">${userName} (${reply.created_at})</p>
                </div>
            </a>
            ${deleteButton}
        </div>`;
}

function renderReplyBody(reply) {
    const replyImage = reply.reply_image ? `
        <img src="../${reply.reply_image}" class="img-fluid reply-image" alt="Reply Image"
             data-bs-toggle="modal" data-bs-target="#replyImageModal" data-image="../${reply.reply_image}">` : '';

    const replyShowRoute = reply.reply_show_route || '#';

    return `
        <p class="post-text mb-3">${reply.reply_text ?? ''}</p>
        <p class="w-25">${replyImage}</p>
        <div class="row text-center mt-3">
            <div class="col">
                <a href="${replyShowRoute}" class="text-decoration-none text-dark link_hover">
                    <span class="comments_count">0</span> <i class="fa-regular fa-message"></i>
                </a>
            </div>
            <div class="col">0 <i class="fa-solid fa-rotate"></i></div>
            <div class="col" id="post-like-section" post-slug-data="a">
                <span class="link_hover">
                    <span id="post-like-count">0</span>
                    <i class="fa-regular fa-thumbs-up" id="post-like-btn"></i>
                </span>
            </div>
            <div class="col"><i class="fa-regular fa-share-from-square"></i></div>
        </div>`;
}

function loadReplies() {
    if (loading || !hasMoreReplies) return;
    loading = true;

    $('#replies_loading_indicator').removeClass('d-none').addClass('d-flex');

    $.ajax({
        url: '/load-replies',
        method: 'GET',
        data: { slug_id: slugId, page },
        success: function(response) {
            if (response.success && response.replies.length) {
                response.replies.forEach(reply => {
                    const replyHtml = `
                        <div class="bg-white rounded-4 p-3 mb-2" id="reply${reply.slug_id}">
                            ${renderReplyHeader(reply)}
                            ${renderReplyBody(reply)}
                        </div>`;
                    $('#display-replies-container').append(replyHtml);
                });

                if (response.next_page) {
                    page = response.next_page;
                } else {
                    hasMoreReplies = false;
                }
            } else {
                $('.empty_replies').removeClass('d-none').addClass('d-block');
                hasMoreReplies = false;
            }
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
