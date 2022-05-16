<x-base-layout>
    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
        <!--begin::Basic info-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h6 class="fw-bolder m-0"> تعديل اشتراك سنوي</h6>
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <h3 class="fw-bolder m-0">{{ $sub->name }}</h3>

                </div>

                <!--end::Card title-->
            </div>
            <!--begin::Card header-->

            <div class="card card-custom mb-3">

                <div class="card-body">
                    <!--begin: Search Form-->
                    <form class="mb-5" action="{{route('children-subscriptions.update' ,$sub->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-6">
                            <div class="col-lg-3 mb-lg-0 mb-6">
                                <label>اسم الطالب:</label>
                                <select id="children_id" name="children_id" class="form-control datatable-input"
                                    data-col-index="2">
                                    <option value="">اختر طالب</option>
                                    @foreach ($childrens as $children)
                                        <option value="{{ $children->id }}" selected>{{ $children->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 mb-lg-0 mb-6">
                                <label>االشعبة:</label>
                                <input id="division_id" type="text" disabled class="form-control datatable-input"
                                    placeholder="" data-col-index="1">
                            </div>

                            <div class="col-lg-3 mb-lg-0 mb-6">
                                <label>المستوى:</label>
                                <input id="level_id" type="text" disabled class="form-control datatable-input"
                                    placeholder="" data-col-index="4">
                            </div>

                            <div class="col-lg-3 mb-lg-0 mb-6">
                                <label>العام الدراسي:</label>
                                <select id="year" name="year" class="form-control datatable-input" data-col-index="2">
                                    <option value="">اختيار السنة الدراسية</option>

                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}"
                                            {{ $year->id == $sub->year ? 'selected' : '' }}>{{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <div class="col-lg-2 mb-lg-0 mb-6">
                                <label>نوع الاشتراك:</label>
                                <select id="subscription_id" name="subscription_id" class="form-control datatable-input"
                                    data-col-index="2">
                                    <option value="">اختر اشتراك</option>
                                    @foreach ($subs as $subs)
                                        <option value="{{ $subs->id }}"
                                            {{ $subs->id == $sub->subscription_id ? 'selected' : '' }}>
                                            {{ $subs->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 mb-lg-0 mb-6">
                                <label>القيمة الافتراضية:</label>
                                <input id="required_amount" name="required_amount" type="text" disabled
                                    class="form-control datatable-input" placeholder="" data-col-index="1">
                            </div>
                            <div class="col-lg-2 mb-lg-0 mb-6">
                                <label>نوع الخصم:</label>
                                <select id="discount_id" name="discount_id" class="form-control datatable-input"
                                    data-col-index="2">
                                    <option value="">اختر خصم</option>
                                    @foreach ($dicsounts as $dis)
                                        <option value="{{ $dis->id }}"
                                            {{ $dis->id == $sub->discount_id ? 'selected' : '' }}>
                                            {{ $dis->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 mb-lg-0 mb-6">
                                <label>نسبة الخصم:</label>
                                <input id="discount" name="discount" disabled type="text"
                                    class="form-control datatable-input" placeholder="" data-col-index="4">
                            </div>
                            <div class="col-lg-2 mb-lg-0 mb-6">
                                <label>المبلغ المخصوم:</label>
                                <input name="discount_amount" id="discount_amount" readonly type="text" class="form-control datatable-input"
                                    placeholder="مثال : 40" data-col-index="4">
                            </div>
                            <div class="col-lg-2 mb-lg-0 mb-6">
                                <label> الاجمالي (المطلوب دفعه) :</label>
                                <input name="total" id="total" type="text" disabled class="form-control datatable-input"
                                    placeholder="مثال : 40" data-col-index="4">
                            </div>
                        </div>
                        <div class="row mt-8">
                            <div class="col-lg-12">
                                <button class="btn btn-primary btn-primary--icon" id="sub">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span> تعديل الاشتراك </span>
                                    </span>
                                </button>&nbsp;&nbsp;
                                <button class="btn btn-secondary btn-secondary--icon" type="reset" id="kt_reset">
                                    <span>
                                        <i class="la la-close"></i>
                                        <span>افراغ</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!--begin: Datatable-->
                    <!--begin: Datatable-->

                    <!--end: Datatable-->
                </div>
            </div>
        </div>
        <!--end::Basic info-->
    </div>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endsection
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script type="text/javascript">
            $(".flatpickr-input").flatpickr();
        </script>
        <script>
            let id = $('#subscription_id').val();

            $.ajax({
                url: "/GetSubscriptionData/" + id,
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
                        //   $("#discount_id")[0].selectedIndex = '';
                        if ($('#discount_id').val() != null) {
                            let id = $('#discount_id').val();
                            let sub = $('#required_amount');
                            $.ajax({
                                url: "/GetDiscountData/" + id,
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

                        }
                        if ($('#subscription_id').val() != '') {
                            $('#discount_id').removeAttr('disabled');
                        } else {
                            $('#discount_id').attr('disabled');

                        }

                    }
                }
            });
        </script>
        <script>
            $('#subscription_id').change(function() {


                let id = this.value;

                $.ajax({
                    url: "/GetSubscriptionData/" + id,
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
                    url: "/GetDiscountData/" + id,
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
        </script>
        <script>
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
                            subsraction_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'اسم الاشتراك مطلوب',
                                    },
                                },
                            },

                            price: {
                                validators: {
                                    notEmpty: {
                                        message: 'السعر  مطلوب',
                                    },

                                    regexp: {
                                        regexp: /^[0-9]+$/,
                                        message: ' السعر فقط أرقام',
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
</x-base-layout>
