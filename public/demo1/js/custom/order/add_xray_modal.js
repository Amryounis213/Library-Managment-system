$('#kt_modal_add_xray').on('hidden.bs.modal', function () {
    const oTable = $('#xrays_table').DataTable();
    oTable.draw();
})
//////////////////////////////////////////
$(document).on("click", "#kt_modal_add_xray_submit", function () {
    xraySubmitForm();
});

//////////////////////////////////////////
function xraySubmitForm() {
    let xray_id = $('#xray_id').val();
    let orderId = $('#order_id').val();
    let instructions = $('#xr_instructions').val();
    if (xray_id === '') {
        $('.xray-error-xray_id').show();
    } else  {
        $('.indicator-label').hide();
        $('.indicator-progress').show();
        $('.xray-error-xray_id').hide();
        $('.xray-error-instructions').hide();
        $.ajax({
            url: '/order/xray/add',
            method: 'POST',
            data: {
                order_id: orderId,
                xray_id: xray_id,
                instructions: instructions,
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
