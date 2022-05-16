$('#kt_modal_update_price').on('hidden.bs.modal', function () {
    const oTable = $('#medicines_table').DataTable();
    oTable.draw();
});

$(document).on("click", ".btn-update-price", function (e) {

    let id = $(this).attr('data-id');
    let price = $(this).attr('data-price');
    let paymentStatus = $(this).attr('data-status');
    if (paymentStatus == 2) {
        toastr.options.positionClass = 'toast-top-left';
        toastr['error']('لا يمكن تعديل السعر بعد الدفع!');
        closeModal();
    } else {
        $(".modal-body #order_id").val(id);
        $(".modal-body #net_price").val(price);
        $(".modal-body .price-error").hide();
        $('.modal').modal('show');
    }

});
//////////////////////////////////////////
$(document).on("click", "#kt_modal_update_price_submit", function (e) {
    e.preventDefault();
    submitForm();
});

//////////////////////////////////////////
function submitForm() {
    let price = $('#net_price').val();
    let id = $('#order_id').val();
    if (price === '') {
        $('.price-error').show();
    } else {
        $('.indicator-label').hide();
        $('.indicator-progress').show();
        $('.price-error').hide();
        $.ajax({
            url: '/order/medicine/netPrice/update',
            method: 'POST',
            data: {
                id: id,
                price: price,
            },
            dataType: "JSON",
            success: function (data) {
                if (data.status === 'success') {
                    $('.indicator-label').show();
                    $('.indicator-progress').hide();
                    toastr.options.positionClass = 'toast-top-left';
                    toastr[data.status](data.message);
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
