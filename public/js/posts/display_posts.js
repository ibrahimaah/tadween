let page = 1;
let loading = false;
let hasMorePosts = true;
let pagePath = '';
const userName = window.location.pathname.split('/').pop();
const lang = $('html').attr('lang');
const isArabic = lang === 'ar';

// Language text helper
const getText = key => {
    const translations = {
        delete: isArabic ? 'حذف المنشور' : 'Delete post',
        totalVotes: isArabic ? 'إجمالي التصويتات:' : 'Total votes:',
        voteEnds: isArabic ? 'ينتهي التصويت في :' : 'Voting ends at:',
        vote: isArabic ? 'صوت' : 'vote'
    };
    return translations[key];
};

function toggleLoader(show) {
    $('#posts_loading_indicator').toggleClass('d-none', !show).toggleClass('d-flex', show);
}

function renderPollOptionsHtml(options, postId) {
    const totalVotes = options.reduce((sum, o) => sum + o.votes, 0);
    return options.map(opt => {
        if (!opt.option_text) return '';
        const percent = totalVotes === 0 ? 0 : (opt.votes / totalVotes) * 100;
        return `
            <div class="mb-3">
                <button class="btn btn-outline-danger w-100 vote-btn" data-option="${opt.option_text}" data-post="${postId}">
                    ${opt.option_text}
                </button>
                <div class="progress mt-2">
                    <div class="progress-bar bg-danger" style="width: ${percent}%;">
                        ${Math.round(percent)}%
                    </div>
                </div>
                <span class="vote-count">${opt.votes} ${getText('vote')}</span>
            </div>`;
    }).join('');
}

function renderPostBody(post,hasReplies) 
{
    return post.post_type === 'poll' ? renderPollPostHtml(post,hasReplies) : renderRegularPostHtml(post,hasReplies);
}

function renderPollPostHtml(post,hasReplies) 
{
    const pollHtml = renderPollOptionsHtml(post.poll.options, post.slug_id);
    const totalVotes = post.poll.options.reduce((sum, o) => sum + o.votes, 0);
    const verticalLineHTML = hasReplies ? renderVerticalLine() : '';
    return `
        <div class="text-dark row">
            <div class="col-1 d-flex justify-content-center">
            ${verticalLineHTML}
            </div>
            <div class="col-11">
                <h4 class="mb-4">${post.text}</h4>
                <div class="mb-3">${pollHtml}</div>
                <p class="mt-3 text-muted">📊 ${getText('totalVotes')} <strong>${totalVotes}</strong></p>
                <p class="mt-4 text-muted">⏳ ${getText('voteEnds')} ${post.poll.expires_at}</p>
            </div>
        </div>
    `;
}

function renderRegularPostHtml(post,hasReplies) 
{
    const verticalLineHTML = hasReplies ? renderVerticalLine() : '';

    const images = post.image?.map(img => `
        <div class="col-11"><img src="${img}" class="img-fluid" alt="post Image"></div>
    `).join('') ?? '';

    return `
        <div class="text-dark row">
            <div class="col-1 d-flex justify-content-center">
            ${verticalLineHTML}
            </div>
            <div class="col-11">
                <p class="post-text mb-3">${post.text ?? ''}</p>
                <div class="row">
                    ${images}
                </div>
            </div>
        </div>
    `;
}

function renderDeleteButton(post) {
    if (!post.is_owner) return '';
    const dropMenuClass = isArabic ? 'text-end' : 'text-start';
    return `
        <div class="dropstart">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical text-orange-color"></i>
            </button>
            <ul class="dropdown-menu ${dropMenuClass}">
                <li>
                    <button class="dropdown-item delete-post-btn" id="${post.slug_id}" data-bs-toggle="modal" data-bs-target="#deletePostModal">
                        <i class="fa-regular fa-trash-can text-orange-color"></i><span class="mx-1">${getText('delete')}</span>
                    </button>
                </li>
            </ul>
        </div>`;
}

function renderPostHeader(post)
{
    const user = post.user;
    const username = isArabic ? `${user.username}@` : `@${user.username}`;
    const userImage = user.cover_image ?? 'img/user.jpg';
    const profileLink = `/${user.username}`;
    const isPrivateIcon = user.is_private ? '<i class="fa-solid fa-lock text-orange-color me-1"></i>' : '';

    return `<div class="d-flex justify-content-between">
                <a href="${profileLink}" class="d-flex text-decoration-none text-dark">
                    <img src="${userImage}" class="rounded-circle logo-main" alt="User Image">
                    <div class="px-1">
                        <p class="mx-1 mb-0">${user.name} ${isPrivateIcon}</p>
                        <p class="mx-1 mt-0 text-grey">${username} (${post.created_at})</p>
                    </div>
                </a>
                ${renderDeleteButton(post)}
            </div>`;
}

function renderReplyHeader(reply)
{
    const user = reply.user;
    const username = isArabic ? `${user.username}@` : `@${user.username}`;
    const userImage = user.cover_image ?? 'img/user.jpg';
    const profileLink = `/${user.username}`; 
    const created_at = reply.created_at;

    return ` 
        <div class="d-flex justify-content-between">
            <a href="${profileLink}" class="d-flex text-decoration-none text-dark">
                <img src="${userImage}" class="rounded-circle logo-main" alt="User Image">
                <div class="px-1"> 
                    <p class="mx-1 mb-0">${user.name}</p>
                    <p class="mx-1 mt-0 text-grey">${username} (${created_at})</p>
                </div>
            </a>  
    </div>`;
}

function renderVerticalLine()
{
    return `<div class="bg-secondary h-100 border" style="width:2px"></div>`;
}

function renderPostActions(post,hasReplies)
{
    const verticalLineHTML = hasReplies ? renderVerticalLine() : '';
    return `
        <div class="row text-center">
            <div class="col-1 d-flex justify-content-center">
                ${verticalLineHTML}
            </div>
            <div class="col-11 mt-3">
                <div class="row">
                    <div class="col"><a href="posts/${post.slug_id}" class="text-decoration-none text-dark link_hover">${post.comments_count ?? 0} <i class="fa-regular fa-message"></i></a></div>
                    <div class="col">${post.reposts_count ?? 0} <i class="fa-solid fa-rotate"></i></div>
                    <div class="col" id="post-like-section" post-slug-data="${post.slug_id}">
                        <span class="link_hover">
                            <span id="post-like-count">${post.post_likes_count ?? 0}</span>
                            <i class="fa-regular fa-thumbs-up ${post.is_post_liked ? 'text-orange-color' : ''}" id="post-like-btn"></i>
                        </span>
                    </div>
                    <div class="col"><i class="fa-regular fa-share-from-square"></i></div>
                </div>
            </div>
        </div>
    `;
}

function renderPosts(post,hasReplies) 
{
    let postHtml = renderPost(post,hasReplies);

    if(hasReplies)
    { 

        const postAndRepliesHtml = post.replies.map(reply => `

            ${postHtml}
             
            <div class="bg-white rounded-bottom rounded-right rounded-left p-3 mb-2">
                ${renderReplyHeader(reply)}
                <div class="row">
                    <div class="col-1 d-flex justify-content-center"> 
                    </div>
                    <div class="col-11">
                        <p class="post-text mb-3">${reply.text}</p>
                    </div>
                </div>
            </div>     
        `).join('');

        return postAndRepliesHtml;
    }
    else 
    {
        return postHtml;
    }
     
    
    
}

function renderPost(post,hasReplies)
{
    return `
        <div class="bg-white rounded-top rounded-right rounded-left p-3" id="post${post.slug_id}">
            ${renderPostHeader(post)}
            ${renderPostBody(post,hasReplies)}
            ${renderPostActions(post,hasReplies)}
        </div>
        `;
}
function loadPosts() {
    if (loading || !hasMorePosts) return;
    loading = true;
    toggleLoader(true);

    $.ajax({
        url: pagePath,
        method: 'GET',
        data: { page },
        success: function (data) {
            if (!data.success) {
                $('#display-posts-container').append(data.message);
                return;
            }

            if (data.posts.length > 0) 
            {
                
                data.posts.forEach(post => {
                    let hasReplies = true;
                    if (!post.replies || post.replies.length === 0)
                    {
                        hasReplies = false;
                    }
                    $('#display-posts-container').append(renderPosts(post,hasReplies))
                });
                page = data.next_page ?? page;
                hasMorePosts = !!data.next_page;
            } else {
                $('.empty_posts').removeClass('d-none').addClass('d-block');
                hasMorePosts = false;
            }
        },
        error: xhr => console.error(xhr.responseJSON?.error || 'Error loading posts.'),
        complete: () => {
            toggleLoader(false);
            loading = false;
        }
    });
}

// Init
$(document).ready(function () {
    pagePath = userName ? `/${userName}/posts` : '/load-posts';
    loadPosts();

    $(window).on('scroll', () => {
        const scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
        if (scrollBottom <= 100) loadPosts();
    });
});

// Tabs
$(document).on('click', '.tab-link', function (e) {
    e.preventDefault();
    $('.tab-link').removeClass('active');
    $(this).addClass('active');

    const selectedTab = $(this).data('tab');
    page = 1;
    hasMorePosts = true;
    $('.empty_posts').addClass('d-none').removeClass('d-block');
    $('#display-posts-container').empty();

    switch (selectedTab) {
        case 'userPosts': pagePath = `/${userName}/posts`; break;
        case 'userPostsReplies': pagePath = `/${userName}/posts/replies`; break;
        case 'userPostsMedia': pagePath = `/${userName}/posts/media`; break;
        default: pagePath = `/${userName}/posts/likes`; break;
    }

    loadPosts();
});
