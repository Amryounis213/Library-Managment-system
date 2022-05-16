$('#kt_modal_add_checkup').on('hidden.bs.modal', function () {
    const oTable = $('#checkups_table').DataTable();
    oTable.draw();
})
//////////////////////////////////////////
$(document).on("click", "#kt_modal_add_checkup_submit", function () {
    checkupSubmitForm();
});

//////////////////////////////////////////
function checkupSubmitForm() {
    let checkup_id = $('#checkup_id').val();
    let orderId = $('#order_id').val();
    if (checkup_id === '') {
        $('.checkup-error-checkup_id').show();
    } else {
        $('.indicator-label').hide();
        $('.indicator-progress').show();
        $('.checkup-error-checkup_id').hide();
        $.ajax({
            url: '/order/checkup/add',
            method: 'POST',
            data: {
                order_id: orderId,
                checkup_id: checkup_id,
            },
            dataType: "JSON",
            success: function (data) {
                if (data.success) {
                    $('.indicator-label').show();
                    $('.indicator-progress').hide();
                    closeModal();
                }
            }
        });
    }
}

//////////////////////////////////////////
function closeModal() {
    $('.modal').modal('hide');
}

