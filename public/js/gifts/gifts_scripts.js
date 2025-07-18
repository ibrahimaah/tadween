$(document).ready(function () {
    const giftsContainer = $('#giftsContainer');
    const emptyMessage = $('.empty_gifts');
    const loadingIndicator = $('#pullToRefreshIndicator');
    const {
        currentAuthId,
        csrfToken,
        translations: t
    } = window.giftPageData;

    function loadGifts() {
        loadingIndicator.removeClass('d-none');
        $.ajax({
            url: window.location.href,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                loadingIndicator.addClass('d-none');
                if (response.success && response.data.length > 0) {
                    emptyMessage.addClass('d-none');
                    renderGifts(response.data);
                } else {
                    giftsContainer.empty();
                    emptyMessage.removeClass('d-none');
                    toastr.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                loadingIndicator.addClass('d-none');
                emptyMessage.removeClass('d-none').text(t.somethingWentWrong);
                toastr.error(`Error ${xhr.status}: ${xhr.statusText}`);
                console.error('AJAX Error:', xhr);
            }
        });
    }

    function renderGifts(giftsData) {
        giftsContainer.empty();

        giftsData.forEach(userGift => {
            if (userGift.is_hidden && currentAuthId != userGift.receiverId) {
                return;
            }

            const isReceiver = currentAuthId == userGift.receiverId;
            const isHidden = userGift.is_hidden;

            let senderDisplay = '';
            if (userGift.visibility === 'anonymous') {
                senderDisplay = `<h6 class='text-center'><span class="text-muted">${t.anonymous}</span></h6>`;
            } else if (userGift.visibility === 'public' || (userGift.visibility === 'private' && isReceiver)) {
                senderDisplay = `<h6 class='text-center'><span><a class='text-decoration-none text-orange-color' href='/${userGift.senderUserName}'>${userGift.senderName}</a></span></h6>`;
            } else {
                senderDisplay = `<h6 class='text-center'><span class="text-muted">${t.anonymous}</span></h6>`;
            }

            const hiddenClass = isHidden ? 'hidden-gift' : '';
            const hiddenStyle = isHidden ? 'style="opacity:0.6;"' : '';

            let actionButtons = '';
            if (isReceiver) {
                const showAction = isHidden
                    ? `<li><span class="dropdown-item show-gift" style="cursor:pointer" data-user-gift-id="${userGift.userGiftId}">
                            <i class="fas fa-eye me-2 text-secondary"></i> ${t.show}
                        </span></li>`
                    : `<li><span class="dropdown-item hide-gift" style="cursor:pointer" data-user-gift-id="${userGift.userGiftId}">
                            <i class="fas fa-eye-slash me-2 text-secondary"></i> ${t.hide}
                        </span></li>`;

                actionButtons = `
                    <div class="gift-actions">
                        <div class="dropdown">
                            <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                ${showAction}
                                <li><span class="dropdown-item delete-gift" style="cursor:pointer" data-user-gift-id="${userGift.userGiftId}">
                                    <i class="fas fa-trash me-2 text-danger"></i> ${t.delete}
                                </span></li>
                            </ul>
                        </div>
                    </div>`;
            }

            const giftHtml = `
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm ${hiddenClass}" ${hiddenStyle}>
                        ${actionButtons}
                        <img src="${userGift.giftIcon}" class="card-img-top gift-img" alt="Gift">
                        <div class="card-body">
                            ${senderDisplay}
                            <p class="card-text text-center">${userGift.msg}</p>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <small class="text-muted">${userGift.receive_date}</small>
                        </div>
                    </div>
                </div>`;
            giftsContainer.append(giftHtml);
        });

        $('.hide-gift').click(function () {
            handleGiftAction('hide', $(this).data('user-gift-id'));
        });

        $('.show-gift').click(function () {
            handleGiftAction('show', $(this).data('user-gift-id'));
        });

        $('.delete-gift').click(function () {
            handleGiftAction('delete', $(this).data('user-gift-id'));
        });
    }

    function handleGiftAction(action, userGiftId) {
        const messages = t.areYouSure;

        if (messages[action]) {
            $('#modal_msg').text(messages[action]);
            $('#user_gift_id').val(userGiftId);
            $('#gift_action').val(action);
            $('#confirmModal').modal('show');
        }
    }

    $(document).on('click', '.confirm_btn', function () {
        const modal = $('#confirmModal');
        const userGiftId = modal.find('#user_gift_id').val();
        const giftAction = modal.find('#gift_action').val();

        $.ajax({
            url: `/gifts/${userGiftId}/${giftAction}`,
            method: 'POST',
            data: {
                _token: csrfToken,
                _method: 'POST'
            },
            beforeSend: function () {
                giftsContainer.empty();
                $('#modal_spinner').removeClass('d-none');
                $('#modal_msg').addClass('d-none');
            },
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    loadGifts();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function () {
                toastr.error(t.somethingWentWrong);
            },
            complete: function () {
                $('#modal_spinner').addClass('d-none');
                $('#modal_msg').removeClass('d-none');
                modal.modal('hide');
            }
        });
    });

    loadGifts();
});
