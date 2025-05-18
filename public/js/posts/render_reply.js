function renderReplyHeader(reply) 
{ 
    if (!reply.user) 
    {
        toastr.error('Missing user in reply:', reply);
        return ''; // or return a fallback header
    }
    const userImage = reply.user.cover_image;
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

function renderReplyBody(reply) 
{
    const replyImage = reply.reply_image ? `
        <img src="../${reply.reply_image}" class="img-fluid reply-image" alt="Reply Image"
             data-bs-toggle="modal" data-bs-target="#replyImageModal" data-image="../${reply.reply_image}">` : '';

    return `
        <p class="post-text mb-3">${reply.reply_text ?? ''}</p>
        <p class="w-25">${replyImage}</p>
        `;
}

function renderReplyFooter(reply)
{
    const replyShowRoute = reply.reply_show_route || '#';
    return `<div class="row text-center mt-3">
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