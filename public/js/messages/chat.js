let lastMessageTime = null;
let firstMessageTime = null;
let isLoading = false;
let hasMoreMessages = true;

const receiverUsername = $('#display-messages-container').data('receiver-username');
const senderUsername = $('#display-messages-container').data('sender-username');


// إضافة رسالة إلى واجهة المستخدم
function appendMessage(message, isSender = false) {
    if (!$(`#message-${message.id}`).length) {
        const messageClass = isSender ? 'text-end' : 'text-start';
        $("#display-messages-container").append(`
            <div id="message-${message.id}" class="m-2 p-2 ${messageClass}">
                <p class="badge text-dark p-2 bg-opacity-10 bg-${message.sender.username === senderUsername ? 'primary' : 'secondary'}">
                    ${message.message}
                </p>
            </div>
        `);
    }
}
function prependMessage(message, isSender = false) {
    if (!$(`#message-${message.id}`).length) {
        const messageClass = isSender ? 'text-end' : 'text-start';
        $("#display-messages-container").prepend(`
            <div id="message-${message.id}" class="m-2 p-2 ${messageClass}">
                <p class="badge text-dark p-2 bg-opacity-10 bg-${message.sender.username === senderUsername ? 'primary' : 'secondary'}">
                    ${message.message}
                </p>
            </div>
        `);
    }
}

// جلب الرسائل من الخادم
function fetchMessages(isInitialLoad = false, isFetchingOldMessages = false) {
    if (isLoading || (isFetchingOldMessages && !hasMoreMessages)) return;
    isLoading = true;

    const requestData = {
        last_message_time: isFetchingOldMessages ? null : lastMessageTime,
        first_message_time: isFetchingOldMessages ? firstMessageTime : null,
    };

    $.ajax({
        url: `/messages/${receiverUsername}`,
        type: "GET",
        data: requestData,
        success: function(response) {
            const messagesArray = response.messages;

            if (response.success && messagesArray.length > 0) {

                if (isFetchingOldMessages) {
                    messagesArray.forEach(msg => appendMessage(msg, msg.sender.username === senderUsername));
                    firstMessageTime = messagesArray[messagesArray.length - 1].created_at;
                } else {
                    
                    if (isInitialLoad) {
                        messagesArray.forEach(msg => appendMessage(msg, msg.sender.username === senderUsername));
                        lastMessageTime = messagesArray[0].created_at;
                        firstMessageTime = messagesArray[messagesArray.length - 1].created_at;
                    } else {
                        messagesArray.forEach(msg => prependMessage(msg, msg.sender.username === senderUsername));
                        lastMessageTime = messagesArray[0].created_at;
                        firstMessageTime = messagesArray[messagesArray.length - 1].created_at;
                    }
                    
                }
            } else if (isFetchingOldMessages && messagesArray.length === 0) {
                hasMoreMessages = false;
            }
        },
        complete: function() {
            isLoading = false;
        }
    });
}

// جلب الرسائل القديمة عند التمرير للاسفل
$("#display-messages-container").on("scroll", function() {
    var $this = $(this);
    var scrollHeight = this.scrollHeight;
    var scrollTop = $this.scrollTop();
    var containerHeight = $this.innerHeight();

    // نحسب المسافة المتبقية للوصول للأسفل
    var distanceFromBottom = scrollHeight - (scrollTop + containerHeight);

    // إذا كانت المسافة أقل من أو تساوي 100 بكسل (يمكنك تعديل القيمة حسب الحاجة)
    if (distanceFromBottom <= 100 && !isLoading && hasMoreMessages) {
        fetchMessages(false, true);
    }
});


// جلب الرسائل الأولى عند فتح الصفحة
fetchMessages(true, false);

// تحديث الرسائل الجديدة كل 5 ثوانٍ
setInterval(() => fetchMessages(false, false), 5000);

// إرسال رسالة جديدة
$('#send').on('click', function() {
    const message = $('#message').val().trim();
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    if (receiverUsername && message) {
        $.ajax({
            url: '/messages/store',
            type: 'POST',
            data: {
                receiver_id: receiverUsername,
                message: message,
                _token: csrfToken,
            },
            success: function(response) {
                $('.empty_messages').addClass('d-none').removeClass('d-block');
                $("#display-messages-container").prepend(`
                    <div id="message-${response.id}" class="m-2 p-2 text-end">
                        <p class="badge text-dark p-2 bg-opacity-10 bg-primary">
                            ${response.message}
                        </p>
                    </div>
                `);
                $('#message').val('');
                
            }
        });
    }
});