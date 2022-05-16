$('#kt_modal_add_medicine').on('hidden.bs.modal', function () {
    const oTable = $('#medicines_table').DataTable();
    oTable.draw();
})
//////////////////////////////////////////
$(document).on("click", "#kt_modal_add_medicine_submit", function () {
    medicineSubmitForm();
});

//////////////////////////////////////////
function medicineSubmitForm() {
    let medicine_id = $('#medicine_id').val();
    let orderId = $('#order_id').val();
    let instructions = $('#med_instructions').val();
    let quantity = $('#quantity').val();
    if (medicine_id === '') {
        $('.medicine-error-medicine_id').show();
    } else  if (instructions === '') {
        $('.medicine-error-instructions').show();
    } else if (quantity === '' || quantity === 0) {
        $('.medicine-error-quantity').show();
    }else {
        $('.indicator-label').hide();
        $('.indicator-progress').show();
        $('.medicine-error-medicine_id').hide();
        $('.medicine-error-instructions ').hide();
        $('.medicine-error-quantity').hide();
        $.ajax({
            url: '/order/medicine/add',
            method: 'POST',
            data: {
                order_id: orderId,
                medicine_id: medicine_id,
                instructions: instructions,
                quantity: quantity,
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
