$('#kt_modal_add_diagnosis').on('hidden.bs.modal', function () {
    const oTable = $('#diagnostics_table').DataTable();
    oTable.draw();
});

$(document).on("click", ".diagnosis-open-modal-btn", function () {
    let orderId = $(this).attr('data-id');
    $(".modal-body #order_id").val(orderId);
});
//////////////////////////////////////////
$(document).on("click", "#kt_modal_add_diagnosis_submit", function () {
    diagnosisSubmitForm();
});

//////////////////////////////////////////
function diagnosisSubmitForm() {
    let description = $('#description').val();
    let orderId = $('#order_id').val();
    if (description === '') {
        $('.diagnosis-error-description').show();
    } else {
        $('.indicator-label').hide();
        $('.indicator-progress').show();
        $('.diagnosis-error-description').hide();
        $.ajax({
            url: '/order/diagnosis/add',
            method: 'POST',
            data: {
                order_id: orderId,
                description: description,
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
