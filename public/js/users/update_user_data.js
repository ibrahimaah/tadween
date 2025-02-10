$(document).ready(function() {
    $('#loadingIndicatorPersonal').hide();
    $('#loadingIndicatorProfile').hide();
    $('#loadingIndicatorDeleteAccount').hide();
    

    //Personal Information
    $('#personalInformationForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var csrfToken = $('input[name="_token"]').val();


        $('#submitBtnPersonal').hide();
        $('#loadingIndicatorPersonal').show();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                // إخفاء إشارة التحميل وعرض زر النشر
                $('#loadingIndicatorPersonal').hide();
                $('#submitBtnPersonal').show();
                
                if (data.success) {
                    // تحديث رسالة التوست
                    $('.toast .toast-body').text(data.message);
                } else {
                    var errorData = data.message;
                    if (typeof errorData === 'object' && !Array.isArray(errorData)) {
                        // إذا كانت الرسالة كائن يحتوي على مصفوفات أخطاء
                        for (var field in errorData) {
                            errorData[field].forEach(function(error) {
                                $('.toast .toast-body').text(error);
                            });
                        }
                    } else {
                        // في حالة وجود رسالة خطأ مباشرة
                        $('.toast .toast-body').text(errorData);
                    }
                }
                // تفعيل التوست
                var toast = new bootstrap.Toast($('.toast'));
                toast.show();
            },
            
        });
    });

    //Profile Information
    $('#profileInformationForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var csrfToken = $('input[name="_token"]').val();

        $('#submitBtnProfile').hide();
        $('#loadingIndicatorProfile').show();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                // إخفاء إشارة التحميل وعرض زر النشر
                $('#loadingIndicatorProfile').hide();
                $('#submitBtnProfile').show();
                
                if (data.success) {
                    // تحديث رسالة التوست
                    $('.toast .toast-body').text(data.message);
                } else {
                    var errorData = data.message;
                    if (typeof errorData === 'object' && !Array.isArray(errorData)) {
                        // إذا كانت الرسالة كائن يحتوي على مصفوفات أخطاء
                        for (var field in errorData) {
                            errorData[field].forEach(function(error) {
                                $('.toast .toast-body').text(error);
                            });
                        }
                    } else {
                        // في حالة وجود رسالة خطأ مباشرة
                        $('.toast .toast-body').text(errorData);
                    }
                }
                // تفعيل التوست
                var toast = new bootstrap.Toast($('.toast'));
                toast.show();
            },
            
        });
    });

    //Delete Account By User
    $('#deleteAccountByUser').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var csrfToken = $('input[name="_token"]').val();

        $('#submitBtnDeleteAccount').hide();
        $('#loadingIndicatorDeleteAccount').show();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                // إخفاء إشارة التحميل وعرض زر النشر
                $('#loadingIndicatorDeleteAccount').hide();
                $('#submitBtnDeleteAccount').show();
                
                if (data.success) {
                    $('#deleteMessage').html(`<p class="alert alert-success">${data.message}</p>`);

                    setTimeout(function () {
                        window.location.href='/';
                    }, 1000);
                } else {
                    $('#deleteMessage').html(`<p class="alert alert-danger">${data.message}</p>`);
                }
            },
            
        });
    });
});