$(document).ready(function () {
    const commentsContainer = $('#comments-container');
    const newCommentContent = $('#new-comment-content');
    const submitCommentBtn = $('#submit-comment');

    const API_URL = '/api/comments';
    let commentsDB = {
        // nextId: 0,
        comments: []
    };

    async function fetchCommentsData() {
        const response = await $.get(API_URL);
        console.log(response);  // Add this to inspect the response
        // commentsDB.nextId = response.nextId;
        commentsDB.comments = Array.isArray(response) ? response : [];
        return commentsDB.comments;
    }
    

    async function getComments(parentId = null) {
        return commentsDB.comments.filter(comment => comment.parent_id === parentId);
    }

    async function addComment({ parentId, content, author }) {
        const response = await $.ajax({
            url: API_URL,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: JSON.stringify({
                parent_id: parentId || null,
                content,
                author: author || 'Anonymous'
            })
        });
        commentsDB.comments.push(response);
        return response;
    }

    async function renderComment(comment, container) {
        const commentElement = $(`
            <div class="comment" data-comment-id="${comment.id}">
                <div class="comment-header">
                    <span class="comment-author">${comment.author}</span>
                    <span class="comment-date">${formatDate(comment.created_at)}</span>
                </div>
                <div class="comment-content">${comment.content}</div>
                <button class="reply-btn">Reply</button>
                <div class="reply-form" style="display: none;">
                    <textarea rows="2" placeholder="Write your reply..."></textarea>
                    <button class="submit-reply">Post Reply</button>
                </div>
                <div class="replies"></div>
            </div>
        `);

        container.append(commentElement);

        const replyBtn = commentElement.find('.reply-btn');
        const replyForm = commentElement.find('.reply-form');
        const replyTextarea = replyForm.find('textarea');
        const submitReplyBtn = replyForm.find('.submit-reply');
        const repliesContainer = commentElement.find('.replies');

        replyBtn.on('click', function () {
            replyForm.toggle();
        });

        submitReplyBtn.on('click', async function () {
            const replyContent = replyTextarea.val().trim();
            if (replyContent) {
                const newReply = await addComment({
                    parentId: comment.id,
                    content: replyContent,
                    author: 'Current User'
                });
                await renderComment(newReply, repliesContainer);
                replyTextarea.val('');
                replyForm.hide();
            }
        });

        const replies = await getComments(comment.id);
        for (const reply of replies) 
        {
            await renderComment(reply, repliesContainer);
        }
    }

    async function renderAllComments() {
        const topComments = await getComments(null);
        commentsContainer.empty();
        for (const comment of topComments) {
            await renderComment(comment, commentsContainer);
        }
    }

    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleString();
    }

    submitCommentBtn.on('click', async function () {
        const content = newCommentContent.val().trim();
        if (content) {
            const newComment = await addComment({
                content,
                author: 'Current User'
            });
            await renderComment(newComment, commentsContainer);
            newCommentContent.val('');
        }
    });

    fetchCommentsData().then(renderAllComments);
});
