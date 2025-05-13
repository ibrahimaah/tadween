//Create new post by users

// عناصر DOM
const imageInputReply = $('#imageInputReply');
const imagePreviewReply = $('#imagePreviewReply');
const uploadImageButtonReply = $('#uploadImageButtonReply');
const emojiButtonReply = $('#emojiButtonReply');
const emojiPickerReply = $('#emojiPickerReply');
const reply_text = $('#reply_text');


// حدث رفع الصور
uploadImageButtonReply.on('click', function () {
    imageInputReply.click();
});

imageInputReply.on('change', function () {
    const files = this.files;
    imagePreviewReply.empty(); // تفريغ المعاينة

    $.each(files, function (i, file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = $('<img>').attr('src', e.target.result);
            imagePreviewReply.append(img);
        };
        reader.readAsDataURL(file);
    });
});

// عرض الإيموجي
emojiButtonReply.on('click', function () {
    emojiPickerReply.css('display', emojiPickerReply.css('display') === 'none' ? 'flex' : 'none');
});

// إضافة الإيموجي إلى النص
emojiPickerReply.on('click', 'span', function () {
    reply_text.val(reply_text.val() + $(this).text());
});

$(document).ready(function () {
    const replyText = $('#reply_text');
    const countReply = $('#countReply');
    const submitBtn = $('#submitBtnReply');
    const loadingIndicator = $('#loadingIndicatorReply');
    const imageInput = $('#imageInputReply');
    const imagePreview = $('#imagePreviewReply');
    const replyForm = $('#replyForm');

    const maxLength = 400;

    loadingIndicator.hide();

    // Character count and limit
    replyText.on('input', function () {
        let text = $(this).val();
        let length = text.length;

        if (length > maxLength) {
            text = text.substring(0, maxLength);
            $(this).val(text);
            length = maxLength;
        }

        countReply.text(length);
    });

    // Submit reply form
    replyForm.on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const csrfToken = $('input[name="_token"]').val();

        if (imageInput[0].files.length > 0) {
            formData.append('reply_image', imageInput[0].files[0]);
        }

        submitBtn.hide();
        loadingIndicator.show();

        $.ajax({
            url: replyForm.attr('action'),
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                loadingIndicator.hide();
                submitBtn.show();

                if (data.success) {
                    $('.comments_count').text(data.reply.comments_count);
                    toastr.success(data.message);

                    replyForm[0].reset();
                    imagePreview.empty();
                    addReplyPostToPage(data.reply);
                    $('.empty_replies').removeClass('d-block').addClass('d-none');
                } else {
                    handleErrors(data.message);
                }
            },
            error: function(xhr) 
            { 
                const errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred.';
                toastr.error(errorMsg);  
            }
        });
    });

    function handleErrors(errorData) {
        if (typeof errorData === 'object') {
            $.each(errorData, function (field, messages) {
                messages.forEach(msg => toastr.error(msg));
            });
        } else {
            toastr.error(errorData);
        }
    }
});



//show new reply on post after added
function addReplyPostToPage(reply) {
    const userImage = reply.user.cover_image ? `../${reply.user.cover_image}` : '../img/logo.png';
    const replyImage = reply.reply_image ? `<img src="../${reply.reply_image}" class="img-fluid reply-image" alt="Reply Image" data-bs-toggle="modal" data-bs-target="#replyImageModal" data-image="../${reply.reply_image}">` : '';

    const deleteText = document.documentElement.lang === 'ar' ? 'حذف الرد' : 'Delete Reply';
    const dropMenuClass = document.documentElement.lang === 'ar' ? 'text-end' : 'text-start';
    const userName = document.documentElement.lang === 'ar' ? `${reply.user.username}@` : `@${reply.user.username}`;

    let deleteButton = '';
    if (reply.is_owner) {
        deleteButton = `
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
            </div>`;
    }

    const postHtml = `
        <div class="bg-white rounded-top p-3 mb-2" id="reply${reply.slug_id}">
            <div class="d-flex justify-content-between">
                <a href="/${reply.user.username}" class="d-flex text-decoration-none text-dark">
                    <img src="${userImage}" class="rounded-circle logo-main" alt="User Image">
                    <div class="px-1">
                        <p class="mx-1 mb-0">${reply.user.name}</p>
                        <p class="mx-1 mt-0 text-grey">${userName} (${reply.created_at})</p>
                    </div>
                </a>
                ${deleteButton}
            </div>
            <p class="post-text mb-3">${reply.reply_text ?? ''}</p>
            <p class="w-25">${replyImage}</p>
        </div>`;

    // Add the new comment at the top of the list
    document.querySelector('#display-replies-container').insertAdjacentHTML('afterbegin', postHtml);
}

