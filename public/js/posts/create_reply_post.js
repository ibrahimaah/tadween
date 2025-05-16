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
            success: function (response) 
            {
                console.log(response)
                loadingIndicator.hide();
                submitBtn.show();

                if (response.success) 
                {
                    $('.comments_count').text(response.reply.comments_count);
                    toastr.success(response.message);

                    replyForm[0].reset();
                    imagePreview.empty();
                    addReplyPostToPage(response.reply);
                    $('.empty_replies').removeClass('d-block').addClass('d-none');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) 
            { 
                const errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred.';
                toastr.error(errorMsg);  
            }
        });
    });

   
});



//show new reply on post after added
function addReplyPostToPage(reply) 
{ 
    const replyHtml = `
    <div class="bg-white rounded-4 p-3 mb-2" id="reply${reply.slug_id}">
        ${renderReplyHeader(reply)}
        ${renderReplyBody(reply)}
        ${renderReplyFooter(reply)}
    </div>`;
    document.querySelector('#display-replies-container').insertAdjacentHTML('afterbegin',replyHtml);
}

