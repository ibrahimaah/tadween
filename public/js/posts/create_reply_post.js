//Create new post by users

// عناصر DOM
const imageInputReply = document.getElementById('imageInputReply');
const imagePreviewReply = document.getElementById('imagePreviewReply');
const uploadImageButtonReply = document.getElementById('uploadImageButtonReply');
const emojiButtonReply = document.getElementById('emojiButtonReply');
const emojiPickerReply = document.getElementById('emojiPickerReply');
const reply_text = document.getElementById('reply_text');

// حدث رفع الصور
uploadImageButtonReply.addEventListener('click', () => {
    imageInputReply.click();
});

imageInputReply.addEventListener('change', () => {
    const files = imageInputReply.files;
    imagePreviewReply.innerHTML = ''; // تفريغ المعاينة

    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
        const img = document.createElement('img');
        img.src = e.target.result;
        imagePreviewReply.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});

// عرض الإيموجي
emojiButtonReply.addEventListener('click', () => {
    emojiPickerReply.style.display = emojiPickerReply.style.display === 'none' ? 'flex' : 'none';
});

// إضافة الإيموجي إلى النص
emojiPickerReply.addEventListener('click', (e) => {
    if (e.target.tagName === 'SPAN') {
        reply_text.value += e.target.textContent;
    }
});

$(document).ready(function() {
    $('#loadingIndicatorReply').hide();
    $('#reply_text').on('input', function() {
        var maxLength = 400;
        var currentLength = $(this).val().length;

        // تحديث العداد
        $('#countReply').text(currentLength);
        
        // التحقق من الوصول إلى الحد الأقصى
        if (currentLength >= maxLength) {
            // منع الكتابة بعد الحد الأقصى
            $(this).val($(this).val().substring(0, maxLength));
            
            // تحديث العداد ليظهر 2000 عند الوصول للحد الأقصى
            $('#countReply').text(maxLength);
        }
    });
    

    $('#replyForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var imageInputReply = $('#imageInputReply')[0];
        var errorsContainer = $('#errorsContainerReply');
        var csrfToken = $('input[name="_token"]').val();

        // إضافة الصورة فقط إذا تم اختيارها
        if (imageInputReply.files.length > 0) {
            formData.append('reply_image', imageInputReply.files[0]);
        }

        errorsContainer.empty(); // إعادة تعيين الأخطاء السابقة
        
        // إخفاء زر النشر وعرض إشارة التحميل
        $('#submitBtnReply').hide();
        $('#loadingIndicatorReply').show();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                // إخفاء إشارة التحميل وعرض زر النشر
                $('#loadingIndicatorReply').hide();
                $('#submitBtnReply').show();
                
                if (data.success) {
                    $('.comments_count').text(data.reply.comments_count);

                    var successMessage = `<p class="text-success">${data.message}</p>`;
                    errorsContainer.append(successMessage);
                    $('#replyForm')[0].reset();
                    $('#imagePreviewReply').empty();
                    // عرض المنشور الجديد في الصفحة
                    addReplyPostToPage(data.reply);
                    $('.empty_replies').removeClass('d-block').addClass('d-none');
                    
                } else {
                    var errorData = data.message;
                    if (typeof errorData === 'object' && !Array.isArray(errorData)) {
                        // إذا كانت الرسالة كائن يحتوي على مصفوفات أخطاء
                        for (var field in errorData) {
                            errorData[field].forEach(function(error) {
                                errorsContainer.append(`<p class="text-danger">${error}</p>`);
                            });
                        }
                    } else {
                        // في حالة وجود رسالة خطأ مباشرة
                        errorsContainer.append(`<p class="text-danger">${errorData}</p>`);
                    }
                }
            },
            
        });

        // إخفاء الرسائل بعد 5 ثوانٍ
        setTimeout(function() {
            errorsContainer.empty();
        }, 5000);
    });
});


//show new reply on post after added
function addReplyPostToPage(reply) {
    var user_image = reply.user.cover_image != null ? '../' + reply.user.cover_image : '../img/logo.webp';
    var reply_image = reply.reply_image != null ? `<img src="../${reply.reply_image}" class="img-fluid reply-image" alt="Reply Image" data-bs-toggle="modal" data-bs-target="#replyImageModal" data-image="../${reply.reply_image}">` : '';

    var deleteText = $('html').attr('lang') === 'ar' ? 'حذف الرد' : 'Delete Reply';
    var dropMenuClass = $('html').attr('lang') === 'ar' ? 'text-end' : 'text-start';
    var userName = $('html').attr('lang') === 'ar' ? reply.user.username+'@' : '@'+reply.user.username;

    var deleteButton = '';
    if (reply.is_owner) {
        deleteButton = `<div class="dropstart">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical text-orange-color"></i>
            </button>

            <ul class="dropdown-menu ${dropMenuClass}">
                <li>
                    <!-- Delete Reply Link -->
                    <button class="dropdown-item delete-reply-btn" id="${reply.slug_id}" data-bs-toggle="modal" data-bs-target="#deleteReplyModal">
                        <i class="fa-regular fa-trash-can text-orange-color"></i><span class="mx-1">${deleteText}</span>
                    </button>
                </li>
            </ul>
        </div>`;
    }
    
    var postHtml = `
        <div class="bg-white rounded-4 p-3 mb-2" id="reply${reply.slug_id}">
            
            <div class="d-flex justify-content-between">
                <a href="/${reply.user.username}" class="d-flex text-decoration-none text-dark">
                    <img src="${user_image}" class="rounded-circle logo-main" alt="User Image">
                    <div class="px-1">
                        <p class="mx-1 mb-0">${reply.user.name}</p>
                        <p class="mx-1 mt-0 text-grey">${userName} (${reply.created_at})</p>
                    </div>
                </a>
                
                ${deleteButton}
                    
            </div>

            <p class="post-text mb-3">${reply.reply_text ?? ''}</p>
            <p class="w-25">${reply_image}</p>

        </div>`;

    // إضافة التعليق الجديد في أعلى القائمة
    $('#display-replies-container').prepend(postHtml);
}
