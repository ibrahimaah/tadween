// عناصر DOM
const $imageInput = $('#imageInput');
const $imagePreview = $('#imagePreview');
const $uploadImageButton = $('#uploadImageButton');
const $emojiButton = $('#emojiButton');
const $emojiPicker = $('#emojiPicker');
const $postText = $('#postText');
const $pollButton = $('#pollButton');
const $pollOptions = $('#pollOptions');

//ًWhen Press On Poll Button
$pollButton.on('click', () => {
    if ($('#maxCount').text() == '200') {
        $('#maxCount').text('400');
    } else {
        $('#maxCount').text('200');
    }
    $('#pollQuestion, #postText').val('');
    $('#countPost').text('0');
    $imagePreview.empty();
    $pollOptions.find('input').val('');
    $('#poll_section, #uploadImageButton, #postText, #pollQuestion').toggleClass('d-none');
});

//When Select Images For Post
$imageInput.on('change', function () {
    $imagePreview.empty();
    const files = Array.from(this.files);
    
    if (files.length > 4) {
        alert("يمكنك رفع 4 صور فقط");
        $imageInput.val('');
        return;
    }
    
    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            $('<img>').attr('src', e.target.result).appendTo($imagePreview);
        };
        reader.readAsDataURL(file);
    });
});

// حدث رفع الصور
$uploadImageButton.on('click', () => $imageInput.click());

// عرض الإيموجي
$emojiButton.on('click', () => $emojiPicker.toggle());

// إضافة الإيموجي إلى النص
$emojiPicker.on('click', 'span', function () {
    $postText.val($postText.val() + $(this).text());
});

$(document).ready(function() {
    const userName = $('#getUserName').data('get-username');
    if (userName) {
        $('#postText').append(`@${userName}`);
    }
    // alert(2)
    $('#loadingIndicator').hide();
    // alert(3)

    //function to check input length
    function checkInputLength(inputSelector, counterSelector, maxLength) {
        $(document).on('input', inputSelector, function () {
            var currentLength = $(this).val().length;
    
            // تحديث العداد
            $(counterSelector).text(currentLength);
    
            // منع الكتابة بعد الحد الأقصى
            if (currentLength >= maxLength) {
                $(this).val($(this).val().substring(0, maxLength));
                $(counterSelector).text(maxLength);
            }
        });
    }

    //Post Text Input
    checkInputLength('#postText', '#countPost', 400);
    //Poll option Input
    checkInputLength('#pollQuestion', '#countPost', 200);
    checkInputLength('#poll_option1', '#optionCount1', 25);
    checkInputLength('#poll_option2', '#optionCount2', 25);
    checkInputLength('#poll_option3', '#optionCount3', 25);
    checkInputLength('#poll_option4', '#optionCount4', 25);
    

    $('#postForm').on('submit', function(e) 
    {
        e.preventDefault();

        var formData = new FormData(this);
        var errorsContainer = $('#errorsContainer');
        var csrfToken = $('input[name="_token"]').val();

        errorsContainer.empty(); // إعادة تعيين الأخطاء السابقة
        
        // إخفاء زر النشر وعرض إشارة التحميل
        $('#submitBtn').hide();
        $('#loadingIndicator').show();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                // إخفاء إشارة التحميل وعرض زر النشر
                $('#loadingIndicator').hide();
                $('#submitBtn').show();
                
                if (data.success) 
                {
                    var successMessage = `<p class="text-success">${data.message}</p>`;
                    errorsContainer.append(successMessage);
                    $('#postForm')[0].reset();
                    $('#imagePreview').empty();
                    //only in home page add post direct at document
                    const path = window.location.pathname;
                    if (path == '/') {
                        // عرض المنشور الجديد في الصفحة
                        addPostToPage(data.post);
                        $('.empty_posts').removeClass('d-block').addClass('d-none');
                    }
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

//show new post after added
function addPostToPage(post) {
    var deleteText = $('html').attr('lang') === 'ar' ? 'حذف المنشور' : 'Delete post';
    var dropMenuClass = $('html').attr('lang') === 'ar' ? 'text-end' : 'text-start';
    var userName = $('html').attr('lang') === 'ar' ? post.user.username+'@' : '@'+post.user.username;

    var user_image = post.user.cover_image != null ? post.user.cover_image : 'img/logo.png';
    // تحويل السلسلة النصية إلى مصفوفة
    var post_image = '';
    if (post.image) {
        post.image.forEach(function(image) {
            post_image += `
            <div class="col">
                <img src="${image}" class="img-fluid h-100" alt="post Image">
            </div>`;
        });
    }

    var deleteButton = post.is_owner
    ? `<li>
        <button class="dropdown-item delete-post-btn" id="${post.slug_id}" data-bs-toggle="modal" data-bs-target="#deletePostModal">
            <i class="fa-regular fa-trash-can text-orange-color"></i><span class="mx-1">${deleteText}</span>
        </button>
        </li>`
    : '_';

    var post_type = '';
    if (post.post_type === 'poll') {
        var poll_options = ''

        let totalVotes = post.poll.options.reduce((sum, option) => sum + option.votes, 0);

        post.poll.options.forEach((poll) => {
            if (poll.option_text != null) {
                let percentage = totalVotes === 0 ? 0 : (poll.votes / totalVotes) * 100;
                var vote = $('html').attr('lang') === 'ar' ? 'صوت' : 'vote';
                
                poll_options += `
                <div class="mb-3">
                    <button class="btn btn-outline-danger w-100 vote-btn" data-option="${poll.option_text}" data-post="${post.slug_id}">${poll.option_text}</button>
                    <div class="progress mt-2">
                        <div id="progress${poll.option_text}" class="progress-bar bg-danger" role="progressbar" style="width: ${percentage}%;">${Math.round(percentage)}%</div>
                    </div>
                    <span class="vote-count" id="vote-count-${poll.option_text}">
                        ${poll.votes} ${vote}
                    </span>
                </div>`;
            }
        });
        var allVotes = $('html').attr('lang') === 'ar' ? 'إجمالي التصويتات:' : 'Total votes:';
        var finishVotes = $('html').attr('lang') === 'ar' ? 'ينتهي التصويت في :' : 'Voting ends at:';
        let totalVotesHtml = `<p class="mt-3 text-muted">📊 ${allVotes} <strong>${totalVotes}</strong></p>`;

        post_type =`
        <div class="text-dark">
            <h4 class="mb-4">${post.text}</h4>
            <div class="mb-3">${poll_options}</div>
            ${totalVotesHtml}
            <p class="mt-4 text-muted">⏳ ${finishVotes} ${post.poll.expires_at}</p>
        </div>`;
    } else {
        post_type =`
        <div class="text-dark">
            <p class="post-text mb-3">${post.text ?? ''}</p>
            <div class="row">${post_image}</div>
        </div>`;
    }

    var postHtml = `
        <div class="bg-white rounded-4 p-3 mb-2" id="post${post.slug_id}">
            
            <div class="d-flex justify-content-between">
                <a href="/${post.user.username}" class="d-flex text-decoration-none text-dark">
                    <img src="${user_image}" class="rounded-circle logo-main" alt="User Image">
                    <div class="px-1">
                        <p class="mx-1 mb-0">${post.user.name}</p>
                        <p class="mx-1 mt-0 text-grey">
                            ${userName}
                            (${post.created_at})
                        </p>
                    </div>
                </a>
                    
                <div class="dropstart">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical text-orange-color"></i>
                    </button>

                    <ul class="dropdown-menu ${dropMenuClass}">
                        <li class="d-none">
                            <a class="dropdown-item" href="#">
                                <i class="fa-regular fa-bookmark text-orange-color"></i><span>إشارة مرجعية</span>
                            </a>
                        </li>
                        <li class="d-none">
                            <a class="dropdown-item" href="#">
                                <i class="fa-regular fa-flag text-orange-color"></i><span>إبلاغ عن المنشور</span>
                            </a>
                        </li>
                        <li>
                            <!-- Delete Post Link -->
                            ${deleteButton}
                        </li>
                    </ul>
                </div>
                    
            </div>
            
            ${post_type}

            <div class="row text-center mt-3">
                <div class="col">
                    <a href="posts/${post.slug_id}" class="text-decoration-none text-dark link_hover">
                        ${post.comments_count ?? 0}
                        <i class="fa-regular fa-message"></i>
                    </a>
                </div>
                <div class="col">${post.reposts_count ?? 0} <i class="fa-solid fa-rotate"></i></div>
                
                <div class="col" id="post-like-section" post-slug-data="${post.slug_id}">
                    <span class="link_hover">
                        <span id="post-like-count">${post.post_likes_count ?? 0}</span>
                        <i class="fa-regular fa-thumbs-up ${post.is_post_liked?'text-orange-color':''}" id="post-like-btn"></i>
                    </span>
                </div>

                <div class="col"><i class="fa-regular fa-share-from-square"></i></div>
            </div>

        </div>`;

    // إضافة المنشور الجديد في أعلى القائمة
    $('#display-posts-container').prepend(postHtml);
}