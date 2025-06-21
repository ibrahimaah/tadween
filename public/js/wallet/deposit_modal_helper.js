function createOrderFun(amount,actions)
{
    return actions.order.create({
        purchase_units: [{
            amount: {
                currency_code: 'USD',
                value: amount
            }
        }],
        application_context: {
            shipping_preference: 'NO_SHIPPING', // 👈 Hides billing/shipping fields 
        }
    });
}

function onApproveFun(actions,paymentMethod)
{
    // onApprove: function(data, actions) {
        return actions.order.capture().then(details => {
            const payerName = `${details.payer.name.given_name} ${details.payer.name.surname}`;
            const payment = details.purchase_units[0].payments.captures[0];
            const status = payment.status || 'UNKNOWN';
            const { id: captureId, amount: { value, currency_code } } = payment;

            $.ajax({
                url: window.constants.url,
                method: "POST",
                data: { 
                    amount: value,
                    captureId,
                    paymentMethod,
                    status ,
                    details
                },
                success: response => {
                    $('#balance').html(response.balance);
                    $('#noTransactionsMsg').remove();
                    $('#transactionsList').prepend(response.transaction_item_html);
                    toastr.success(window.translations.wallet_updated_success);
                    $('#depositModal').modal('hide');
                    resetModal();
                },
                error: xhr => {
                    if (xhr.status === 422) {
                        // Validation error
                        const response = xhr.responseJSON;
                        if (response && response.msg) {
                            // If msg is an array, join it; otherwise display as-is
                            const messages = Array.isArray(response.msg) ? response.msg.join('<br>') : response.msg;
                            toastr.error(messages);
                        } else {
                            toastr.error(window.translations.validation_failed);
                        }
                    } else {
                        // Other errors
                        toastr.error(window.translations.err_occur);
                        console.error(xhr);
                    }
                }

            });
        });
    // }
}