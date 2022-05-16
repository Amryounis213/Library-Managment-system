<!--begin::Table-->
{{-- $dataTable->table() --}}
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
    {{-- $dataTable->scripts() --}}


    <script>
        const Table = $('#patients-table');
        Table.on('preXhr.dt', function(e, settings, data) {
            data.children = $('#children_id').val();
            data.year = $('#year').val();
            // data.kindergarten= $('#kindergarten_id').val();
        });


        $('#children_id').change(function() {

            let x = Table.DataTable().ajax.reload();

            let id = this.value;

            $.ajax({
                url: "GetChildrenData/" + id,
                method: 'GET',
                data: {
                    // 'doctor_id': id,
                    // 'identity': identity,
                },
                dataType: "JSON",
                success: function(data) {

                    console.log(data);
                    if (data != null) {



                        if (data.year != null) {
                            // $('#year').empty();
                            // $('#year').append(
                            //     ` <option value="${data.year.id}" selected> ${data.year.name} </option>  
                        // `);

                            $('#division_id').empty();

                            $('#division_id').val(data.division.name)

                            $('#level_id').empty();
                            $('#level_id').val(data.level.name)


                        } else {
                            $('#division_id').empty();

                            $('#division_id').val('غير مسكن')

                            $('#level_id').empty();
                            $('#level_id').val('غير مسكن')
                        }




                        $('#required_amount').val('');
                        $('#discount').val(0);
                        $('#discount_amount').val('');
                        $('#total').val(0);
                        $('#subscription_id').prop('selectedIndex', 0);
                        $('#year').prop('selectedIndex', 0);
                        let dis = $('#discount_id');
                        dis.prop('selectedIndex', 0);
                        dis.prop("disabled", true);


                    }
                }
            });


        });




        $('#year').change(function() {
            let x = Table.DataTable().ajax.reload();
        });



        $('#subscription_id').change(function() {


            let id = this.value;

            $.ajax({
                url: "GetSubscriptionData/" + id,
                method: 'GET',
                data: {
                    // 'doctor_id': id,
                    // 'identity': identity,
                },
                dataType: "JSON",
                success: function(data) {

                    console.log(data);
                    if (data != null) {


                        $('#required_amount').empty();
                        $('#required_amount').val(data.year_subscription.price)

                        $('#discount_amount').val(0);
                        $('#discount').val(0);

                        $('#total').val(data.year_subscription.price);
                        // $('#discount_id').find('option:first').attr('selected', 'selected');
                        $("#discount_id")[0].selectedIndex = '';

                        if ($('#subscription_id').val() != '') {
                            $('#discount_id').removeAttr('disabled');
                        } else {
                            $('#discount_id').attr('disabled');

                        }

                    }
                }
            });


        });


        $('#discount_id').change(function() {


            let id = this.value;
            let sub = $('#required_amount');
            $.ajax({
                url: "GetDiscountData/" + id,
                method: 'GET',
                data: {
                    // 'doctor_id': id,
                    // 'identity': identity,
                },
                dataType: "JSON",
                success: function(data) {

                    console.log(data);
                    if (data != null) {

                        $('#discount').empty();
                        $('#discount').val(data.per);

                        let r = $('#required_amount').val();

                        $('#discount_amount').val(sub.val() * data.per / 100);
                        let d = $('#discount_amount').val();

                        $('#total').val(r - d + ' شيكل');

                    }
                }
            });


        });



        $("#discount").keyup(function() {
            let discount = $(this).val();
            let x = $("#required_amount").val();
            $('#total').empty();
            let discounttotal = x * discount / 100;

            $('#total').val(x - discounttotal + ' شيكل');


        });

        // $('#kindergarten_id').change(function() {
        //     let x =Table.DataTable().ajax.reload();
        // });
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#after_father1').addClass("disabled");
            $('#after_father2').addClass("disabled");
            $('#after_father3').addClass("disabled");

            $('#father_id2').attr("disabled", true);
            $('#father_id3').attr("disabled", true);
            $('#father_id4').attr("disabled", true);



            $('#father_id').change(function() {

                id = $('#father_id').val();
                $.ajax({
                    method: "GET",
                    url: "/GetDataByTitles/" + id,
                    data: {
                        // "name": $('#sub_sub_section').val(),
                        // "status": $('#sub_sub_section_status').val(),
                        // "sub_section_id": $('#father_id3').val(),
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);

                        if (data != null || data != []) {
                            toastr.options.positionClass = 'toast-top-left';
                            toastr['success']('تم تغيير الحالة');
                            $('#father_id2').empty();
                            $('#father_id2').append(
                                `<option value="">اختر قسم</option>`);
                            $.each(data, function(key, value) {
                                $('#father_id2').append(
                                    `<option value="${value.id}">${value.name}</option>`
                                    );
                            });



                        }


                    }
                });




                if ($('#father_id').val() == '') {
                    $('#after_father1').addClass("disabled");
                    $('#father_id2').attr("disabled", true);
                    $('#father_id2').val(null);
                    $('#father_id2').append(
                        `<option>اختر القسم</option>`);

                    $('#after_father2').addClass("disabled");


                    $('#father_id3').attr("disabled", true);
                    $('#father_id3').empty();
                    $('#father_id3').append(
                        `<option>اختر الفرع</option>`);


                    $('#father_id4').attr("disabled", true);
                    $('#father_id4').empty();
                    $('#father_id4').append(
                        `<option>اختر الفرع</option>`);
                    $('#after_father3').addClass("disabled");


                } else {
                    $('#after_father1').removeClass("disabled");
                    $('#father_id2').attr("disabled", false);
                }



            });



            $('#father_id2').change(function() {

                id = $('#father_id2').val();
                $.ajax({
                    method: "GET",
                    url: "/GetDataBySections/" + id,
                    data: {
                        // "name": $('#sub_sub_section').val(),
                        // "status": $('#sub_sub_section_status').val(),
                        // "sub_section_id": $('#father_id3').val(),
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);

                        if (data != null || data != []) {
                            toastr.options.positionClass = 'toast-top-left';
                            toastr['success']('تم تغيير الحالة');
                            $('#father_id3').empty();
                            $('#father_id3').append(
                                `<option value="">اختر فرع</option>`);
                            $.each(data, function(key, value) {
                                $('#father_id3').append(
                                    `<option value="${value.id}">${value.name}</option>`
                                    );
                            });



                        }


                    }
                });
                if ($('#father_id2').val() == '') {

                 
                    $('#after_father2').addClass("disabled");
                    $('#father_id3').attr("disabled", true);
                    $('#father_id3').empty();
                    $('#father_id3').append(
                        `<option value=" " >اختر فرع</option>`);



                    $('#after_father3').addClass("disabled");
                    $('#father_id4').attr("disabled", true);
                    $('#father_id4').empty();
                    $('#father_id4').append(
                        `<option value="">اختر الفرع</option>`);


                } else {
                    $('#after_father2').removeClass("disabled");
                    $('#father_id3').attr("disabled", false);
                }



            });



            $('#father_id3').change(function() {
               
                if ($('#father_id3').val() == '') {
                  
                    $('#after_father3').addClass("disabled");

                    $('#father_id4').attr("disabled", true);

                } else {
                    $('#after_father3').removeClass("disabled");
                    $('#father_id4').attr("disabled", false);

                }



            });



            $('#sub').on('click', function(e) {
                e.preventDefault();
                $('.section_type').removeAttr('hidden', true);
                $(this).attr('disabled' , true);
            });



            $('#titles_btn').on('click', function() {
                let result = $('#kt_share_earn_link_input').val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('job-titles.store') }}",
                    data: {
                        "name": $('#title').val(),
                        "status": $('#title_status').val(),
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        toastr.options.positionClass = 'toast-top-left';
                        toastr[data.status](data.message);

                        $('#father_id').append(
                            `<option value="${data.data.id}">${data.data.name}</option>`);
                        $('#section1').modal('toggle');

                    }
                });


            });








            $('#section_add').on('click', function() {
                let result = $('#kt_share_earn_link_input').val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('sections.store') }}",
                    data: {
                        "name": $('#section').val(),
                        "status": $('#section_status').val(),
                        "title_id": $('#father_id').val(),
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        toastr.options.positionClass = 'toast-top-left';
                        toastr[data.status](data.message);

                        $('#father_id2').append(
                            `<option value="${data.data.id}">${data.data.name}</option>`);
                        $('#section2').modal('toggle');

                    }
                });


            });



            $('#sub_section_add').on('click', function() {
                let result = $('#kt_share_earn_link_input').val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('sub-sections.store') }}",
                    data: {
                        "name": $('#sub_section').val(),
                        "status": $('#sub_section_status').val(),
                        "section_id": $('#father_id2').val(),
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        toastr.options.positionClass = 'toast-top-left';
                        toastr[data.status](data.message);

                        $('#father_id3').append(
                            `<option value="${data.data.id}">${data.data.name}</option>`);
                        $('#section3').modal('toggle');

                    }
                });


            });




            $('#sub_sub_section_add').on('click', function() {
                $.ajax({
                    method: "POST",
                    url: "{{ route('sub-sub-sections.store') }}",
                    data: {
                        "name": $('#sub_sub_section').val(),
                        "status": $('#sub_sub_section_status').val(),
                        "sub_section_id": $('#father_id3').val(),
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        toastr.options.positionClass = 'toast-top-left';
                        toastr[data.status](data.message);

                        $('#father_id4').append(
                            `<option value="${data.data.id}">${data.data.name}</option>`);
                        $('#section4').modal('toggle');

                    }
                });


            });




        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const oTable = $('#patients-table').DataTable();
            $(document).on('click', ".del_rec_btn", function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                let url = "{{-- route('year-sub.destroy', ":id") --}}";
                url = url.replace(':id', id);

                Swal.fire({
                    title: 'تحذبر!',
                    text: 'هل أنت متأكد من حذف البيانات؟',
                    icon: 'warning',
                    confirmButtonText: 'نعم، حذف',
                    confirmButtonColor: '#d33',
                    cancelButtonText: 'لا، إلغاء',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            success: function(data) {
                                oTable.draw();
                                toastr.options.positionClass = 'toast-top-left';
                                toastr[data.status](data.message);
                            }
                        });
                    }
                })
            });
        });
    </script>
    <script>
        $(document).on('click', '.sts-fld', function(e) {
            //e.preventDefault();
            const id = $(this).data('id');
            const checkedValue = $(this).is(":checked");
            $.ajax({
                type: "POST",
                url: "{{-- route('year-sub.status') --}}",
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data.type === 'yes') {
                        $(this).prop("checked", checkedValue);
                    } else if (data.type === 'no') {
                        $(this).prop("checked", !checkedValue);
                    }
                    toastr.options.positionClass = 'toast-top-left';
                    toastr[data.status](data.message);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let oTable = $('#patients-table').DataTable();
            oTable.on('order.dt search.dt', function() {
                oTable.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            $('#myInputSearchField').keyup(function() {
                oTable.search($(this).val()).draw();
            });
            oTable.draw();
        });
    </script>

    <script>
        ////////////////////////////////////////
        document.addEventListener('DOMContentLoaded', function(e) {
            FormValidation.formValidation(
                document.getElementById('details_form'), {
                    fields: {
                        year: {
                            validators: {
                                notEmpty: {
                                    message: 'السنة الدراسية مطلوبة',
                                },
                            },
                        },
                        children_id: {
                            validators: {
                                notEmpty: {
                                    message: 'اسم الطالب مطلوب',
                                },
                            },
                        },




                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        bootstrap: new FormValidation.plugins.Bootstrap5(),
                    },
                });
        });
    </script>
@endsection
