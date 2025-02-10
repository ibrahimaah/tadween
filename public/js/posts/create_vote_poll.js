////////////// تخزين الأصوات//////////////////
$(document).on("click", ".vote-btn", function() {
    let optionId = $(this).data("option");
    let slug_id = $(this).data("post");
    const csrfToken = $('meta[name="csrf-token"]').attr('content'); // احصل على CSRF Token
    var vote = $('html').attr('lang') === 'ar' ? 'صوت' : 'vote';

    $.ajax({
        url: "/vote",  // استبدلها برابط التصويت في الخادم
        method: "POST",
        data: {
            slug_id: slug_id,
            option_id: optionId,
            _token: csrfToken
        },
        success: function(response) {
            if (response.success) {
                let totalVotes = response.poll.options.reduce((sum, option) => sum + option.votes, 0);

                $('.toast .toast-body').text(response.message);
                
                response.poll.options.forEach(option => {
                    if (option.option_text != null) {
                        let percentage = totalVotes === 0 ? 0 : (option.votes / totalVotes) * 100;
                        $(`#progress${option.id}`).css("width", percentage + "%").text(Math.round(percentage) + "%");
                        $(`#vote-count-${option.id}`).text(`${option.votes} ${vote}`);
                    }
                });
            } else {
                $('.toast .toast-body').text(response.message);
            }
            // تفعيل التوست
            var toast = new bootstrap.Toast($('.toast'));
            toast.show();
        }
    });
    
});
//////////////////////////////////////////////