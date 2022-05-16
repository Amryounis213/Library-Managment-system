$('#kt_modal_add_note').on('hidden.bs.modal', function () {
    const oTable = $('#data_table').DataTable();
    oTable.draw();
});

$(document).on("click", ".btn-add-note", function () {
    let id = $(this).attr('data-id');
    let note = $(this).attr('data-note');
    let type = $(this).attr('data-type');

    $(".modal-body #order_id").val(id);
    $(".modal-body #note").val(note);
    $(".modal-body #type").val(type);
});
//////////////////////////////////////////
$(document).on("click", "#kt_modal_add_note_submit", function (e) {
    e.preventDefault();
    noteSubmitForm();
});

//////////////////////////////////////////
function noteSubmitForm() {
    let note = $('#note').val();
    let id = $('#order_id').val();
    let type = $('#type').val();
    if (note === '') {
        $('.note-error').show();
    } else {
        $('.indicator-label').hide();
        $('.indicator-progress').show();
        $('.note-error').hide();
        $.ajax({
            url: '/order/note/add',
            method: 'POST',
            data: {
                id: id,
                note: note,
                type: type
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
