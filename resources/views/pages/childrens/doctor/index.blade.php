<x-base-layout>
    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
    @include('.layout.error')
    <!--begin::Card-->
        <div class="card card-flush bgi-position-y-center bgi-no-repeat pb-6 mb-2 mb-xl-3">
            <!--begin::Card header-->
            <div class="card-header pt-10">
                <div class="d-flex align-items-center">
                    <!--begin::Icon-->
                    <div class="symbol symbol-circle me-5">
                        <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs020.svg-->
                        {!! theme()->getSvgIcon("icons/duotune/general/gen049.svg", "svg-icon-5x svg-icon-primary") !!}
                        <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column">
                        <h2 class="mb-1">{{$order->name}}</h2>
                        <div class="text-muted fw-bolder" style="direction: ltr">
                            <span class="mx-3"></span>{{$order->patient->gender == 1 ? 'ذكر' : 'انثى'}}
                            <span
                                class="mx-3">|</span>{{$order->patient->age()}} {{$order->patient->age() > 9 ? 'عام' :  'أعوام'}}
                        </div>
                    </div>
                    <!--end::Title-->
                </div>
                <a href="{{ route('patient.show', $order->patient) }}"
                   title="السجل الطبي"
                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-10">
                    السجل الطبي
                    {!! theme()->getSvgIcon("icons/duotune/communication/com005.svg", "svg-icon-4x") !!}
                </a>
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Card-->
    {{--////////////////////////////// - Diagnosis Table - ///////////////////////////--}}
    <!--begin::Card-->
        <div class="card mb-2 mb-xl-3}">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer collapsed" role="button"
                 data-bs-target="#kt_diagnosis_details" aria-expanded="true"
                 aria-controls="kt_diagnosis_details">
                <!--begin::Card title-->

                <div class="card-title">
                {!! theme()->getSvgIcon("icons/duotune/general/gen055.svg", "svg-icon-3x svg-icon-primary") !!}
                <!--begin::Search-->
                    <h3 cla ss="fw-bolder m-3">{{ __('Diagnosis') }} </h3>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <!--begin::Add-->
                        <div class="card-toolbar">
                            <button href="#" type="button"
                                    class="btn btn-sm btn-primary add-btn-st diagnosis-open-modal-btn"
                                    data-bs-toggle="modal"
                                    data-id="{{$order->id}}"
                                    data-bs-target="#kt_modal_add_diagnosis">
                                {{__('add')}} {{__('diagnosis')}}
                            </button>
                        </div>
                        <!--end::Add-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_diagnosis_details">
                <!--begin::Card body-->
                <div class="card-body pt-6">
                    <div class="card-body border-top p-9 item" id="diagnostics_table_container">
                        <table id="diagnostics_table" class="table table-row-bordered gy-5">
                            <thead>
                            <tr class="fw-bold fs-6 text-muted">
                                <th>#</th>
                                <th>التشخيص</th>
                                <th>انشئ في</th>
                                <th>إجراء</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Card-->

    {{--////////////////////////////// - checkup Table - ///////////////////////////--}}

    <!--begin::Card-->
        <div class="card mb-2 mb-xl-3">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointe" role="button"
                 data-bs-target="#kt_laboratory_details" aria-expanded="true"
                 aria-controls="kt_laboratory_details">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    {!! theme()->getSvgIcon("icons/duotune/medicine/med005.svg", "svg-icon-3x svg-icon-primary") !!}
                    <h3 class="fw-bolder m-3">{{ __('laboratory') }} </h3>
                    <!--end::Search-->
                </div>

            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_laboratory_details">
                <!--begin::Card body-->
                <div class="card-body border-top p-9 item">
                    <select class="selectpicker pb-5 " multiple data-live-search="true" id="checkups_list">
                        @foreach($checkups as $item)
                            <option
                                value="{{$item->id}}" {{in_array($item->id, $orderCheckups)? 'selected' : '' }} >{{$item->name}}</option>
                        @endforeach
                    </select>
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Add-->
                            @if($order->in_lab < 2)
                                <div class="card-toolbar">
                                    <button href="#" type="button"
                                            class="btn btn-sm btn-primary add-btn-st checkup-add"
                                            data-id="{{$order->id}}">
                                  <span class="svg-icon svg-icon-2">
                                </span>
                                        {{__('Save')}}
                                    </button>
                                </div>
                        @endif
                        <!--end::Add-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Card-->
    {{--///////////////////////////- xray Table - ///////////////////////////--}}
    <!--begin::Card-->
        <div class="card mb-2 mb-xl-3">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer collapsed" role="button"
                 data-bs-target="#kt_xray_details"
                 aria-controls="kt_xray_details">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    {!! theme()->getSvgIcon("icons/duotune/medicine/med001.svg", "svg-icon-3x svg-icon-primary") !!}
                    <h3 class="fw-bolder m-3">{{ __('Xray') }} </h3>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_xray_details">
                <!--begin::Card body-->
                <div class="card-body border-top p-9 item">
                    <select class="selectpicker pb-5" multiple data-live-search="true" id="xrays_list">
                        @foreach($xrays as $item)
                            <option
                                value="{{$item->id}}" {{in_array($item->id, $orderXrays)? 'selected' : '' }} >{{$item->name}}</option>
                        @endforeach
                    </select>
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Add-->
                            @if($order->in_xray < 2)
                                <div class="card-toolbar">
                                    <button href="#" type="button"
                                            class="btn btn-sm btn-primary add-btn-st xray-add"
                                            data-id="{{$order->id}}">
                                  <span class="svg-icon svg-icon-2">
                                </span>
                                        {{__('Save')}}
                                    </button>
                                </div>
                        @endif
                        <!--end::Add-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Card-->
    {{--///////////////////////- Medicine Table - /////////////////////////////--}}
    <!--begin::Card-->
        <div class="card mb-2 mb-xl-3">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button"
                 data-bs-target="#kt_pharmacy_details"
                 aria-controls="kt_pharmacy_details">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    {!! theme()->getSvgIcon("icons/duotune/medicine/med002.svg", "svg-icon-3x svg-icon-primary") !!}
                    <h3 class="fw-bolder m-3">{{ __('Pharmacy') }} </h3>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->

            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_pharmacy_details">
                <!--begin::Card body-->
                <div class="card-body border-top p-9 item">
                    @if(auth()->user()->role_id == 9)
                        <form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" id="medicine-form">
                        @csrf @method('POST')
                        <!--begin::Input group-->
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <div class="row mb-6">
                                <!--begin::Col-->
                                <div class="col-lg-12">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <label
                                            class="col-lg-2 col-form-label required fw-bold fs-6">اسم الدواء</label>
                                        <div class="col-lg-7">
                                            <input type="text" name="medicine" id="gov_identity" lang="en"
                                                   class="form-control form-control-lg form-control-solid item_no patient_search"
                                                   placeholder="اسم الدواء"
                                                   value="{{ old('medicine') }}"/>
                                            <input type="hidden" value="{{ old('medicine_id') }}" name="medicine_id"
                                                   class="search-val">
                                            <input type="hidden" value="{{ old('net_price') }}" name="net_price"
                                                   class="price">
                                            <div
                                                class="fv-plugins-message-container invalid-feedback medicine-error-medicine_id"
                                                style="display: none">الدواء
                                                مطلوب
                                            </div>
                                        </div>
                                        <label class="col-lg-1 col-form-label required fw-bold fs-6">الكمية</label>
                                        <div class="col-lg-2">
                                            <input name="quantity" type="number" id="quantity" min="1" max="99"
                                                   class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                   value="{{ old('quantity',1) }}" lang="en"/>
                                            <div
                                                class="fv-plugins-message-container invalid-feedback medicine-error-quantity"
                                                style="display: none">الكمية
                                                مطلوب
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">الجرعة </label>
                                <div class="col-lg-2">
                                    <input name="dose_quantity" type="number" min="1" max="99" lang="en"
                                           class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                           value="{{ old('dose_quantity',1) }}"/>
                                </div>
                                <label class="col-lg-2 col-form-label fw-bold fs-6" style="text-align: right">
                                    <span>X</span> <span class="unit"
                                                         style="padding: 7px 30px 15px 30px; background-color: #F5F8FA; margin: 30px">unit</span>
                                </label>
                                <div class="col-lg-2">
                                    <input name="times" type="number" min="1" max="99" lang="en"
                                           class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                           value="{{ old('times',1) }}"/>
                                </div>
                                <label class="col-lg-1 col-form-label fw-bold fs-6" style="text-align: center">
                                    <span>مرات كل</span></label>
                                <div class="col-lg-2">
                                    <select name="dose_period"
                                            class="form-select form-select-solid form-select-lg">
                                        <option value="1">يوم</option>
                                        <option value="2">أسبوع</option>
                                        <option value="3">شهر</option>
                                        <option value="3">عند اللزوم</option>
                                    </select>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">المدة</label>
                                <div class="col-lg-2">
                                    <input name="duration" type="number" min="1" max="99" lang="en"
                                           class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                           value="{{ old('dose_quantity',1) }}"/>
                                </div>
                                <div class="col-lg-2">
                                    <select name="duration_period"
                                            class="form-select form-select-solid form-select-lg">
                                        <option value="1">يوم</option>
                                        <option value="2">أسبوع</option>
                                        <option value="3">شهر</option>
                                        <option value="3">عند اللزوم</option>
                                    </select>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input-->
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">التعليمات</label>
                                <div class="col-lg-10">
                                    <textarea name="instructions" id="med_instructions" rows="2" placeholder="التعليمات"
                                              class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                              value="{{ old('instructions') }}"></textarea>
                                    <div
                                        class="fv-plugins-message-container invalid-feedback medicine-error-instructions"
                                        style="display: none">
                                        التعليمات مطلوب
                                    </div>
                                </div>
                            </div>
                            <!--end::Input-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                    <!--begin::Add-->
                                    @if($order->in_pharmacy < 2)
                                        <button type="submit" id="kt_add_medicine_submit"
                                                class="btn btn-sm btn-primary add-btn-st">
                                            <span class="indicator-label">حفظ</span>
                                            <span class="indicator-progress">يرجى الانتظار...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>

                                        </button>
                                @endif
                                <!--end::Add-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card toolbar-->
                            <!--end::Input-->
                        </form>
                        <!--end::Form-->
                    @endif
                    <table id="medicines_table" class="table table-row-bordered gy-5">
                        <thead>
                        <tr class="fw-bold fs-6 text-muted">
                            <th>#</th>
                            <th>الدواء</th>
                            <th>الوحدة</th>
                            <th>الكمية</th>
                            <th>الجرعة</th>
                            <th>التكرار</th>
                            <th>المدة</th>
                            <th>التعليمات</th>
                            <th>جهة الإضافة</th>
                            <th>إجراء</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!--end::Card body-->
                <!--end::Content-->
            </div>
            <!--end::Card-->
            <!--begin::Form-->
            <form id="details_form" class="form" method="POST" action="{{ route('order.status.update') }}"
                  enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="status" value="2">
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a type="button" class="btn btn-success m-1 w-100px"
                       href="{{ route('order.diagnosis.display', $order) }}">{{__('display')}} </a>
                    {{--                    @if($order->status == 1)--}}
                    <button type="submit" class="btn btn-primary m-1 w-100px"
                            id="kt_account_profile_details_submit">
                        @include('partials.general._button-indicator', ['label' => __('send')])
                    </button>
                    {{--                    @endif--}}

                </div>
            </form>
            <!--end::Form-->
        </div>
        {{--////////////////////////////// - Modals - ////////////////////////////--}}
        @include('pages.order.modals.add_diagnosis')
        @include('pages.order.modals.add_checkup')
        @include('pages.order.modals.add_xray')
        {{--/////////////////////////////// - CSS - ///////////////////////////////--}}
        @section('styles')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
                  integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
                  crossorigin="anonymous" referrerpolicy="no-referrer"/>
            <link rel="stylesheet"
                  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
            <style>
                .add-btn-st {
                    min-width: 150px;
                }

                label {
                    text-align: left;
                }

                .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
                    width: 100%;
                }
            </style>
        @endsection

        {{--/////////////////////////////// - JS - ///////////////////////////////--}}
        @section('scripts')
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
            <script src="{{asset('demo1/plugins/custom/datatables/datatables.bundle.js')}}"></script>
            <script src="{{asset('demo1/js/custom/order/add_diagnosis_modal.js')}}"></script>
            <script src="{{asset('demo1/js/custom/order/add_backup_modal.js')}}"></script>
            <script src="{{asset('demo1/js/custom/order/add_xray_modal.js')}}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
                    integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            {{--////////////////////////////////////////////////////////////--}}
            <script type="text/javascript">
                $(document).ready(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    ////////////////////////////////////////////////
                    function empty_errors() {
                        $('.medicine-error-medicine_id').hide();
                        $('.medicine-error-instructions ').hide();
                        $('.medicine-error-quantity').hide();
                    }
                    //////////////////////////////////////////
                    $("#medicine-form").on('submit', function (event) {
                        event.preventDefault();
                        empty_errors();
                        $('.indicator-label').hide();
                        $('.indicator-progress').show();
                        let form_data = $(this).serialize();
                        $.ajax({
                            url: '{{ route('order.medicine.add') }}',
                            method: 'POST',
                            data: form_data,
                            dataType: "JSON",
                            success: function (data) {
                                if (data.success) {
                                    toastr.options.positionClass = 'toast-top-left';
                                    toastr[data.status](data.message);
                                    $("#medicine-form")[0].reset();
                                    medicinesTable.draw();
                                    $('.indicator-label').show();
                                    $('.indicator-progress').hide();
                                    $('.search-val').val("");
                                    empty_errors()
                                } else {
                                    $('.indicator-label').show();
                                    $('.indicator-progress').hide();
                                    $.each(data.errors, function (key, item) {
                                        if (key == 'medicine_id') {
                                            $('.medicine-error-medicine_id').show();
                                        }
                                        if (key == 'quantity') {
                                            $('.medicine-error-quantity').show();
                                        }
                                    });
                                }
                            }
                        });
                    });
                    ////////////////////////////////////////
                    let options = {
                        source: "{{ url('order/searchMedicine') }}",
                        minLength: 1,
                        focus: function (event, ui) {
                            let val = $(this).closest('.item').find('.search-val');
                            identity = $(this).closest('.item').find('.item_no');
                            identity.val(ui.item.label);
                            val.val(ui.item.value);
                            return false;
                        },
                        ///////////////////////////////////////////
                        select: function (event, ui) {
                            let val = $(this).closest('.item').find('.search-val');
                            identity = $(this).closest('.item').find('.item_no');
                            let unit = $(this).closest('.item').find('.unit');
                            let price = $(this).closest('.item').find('.price');
                            /////////////////////////////////////
                            identity.val(ui.item.label);
                            unit.text(ui.item.unit);
                            price.val(ui.item.price);
                            return false;
                        }
                    };
                    ///////////////////////////////////////////
                    $(".patient_search").autocomplete(options);
                    ///////////////////////////////////////////
                    $(document).on("click", ".xray-open-modal-btn", function () {
                        let orderId = $(this).attr('data-id');
                        $(".modal-body #order_id").val(orderId);
                        let xrs = {!! json_encode($xrays) !!};
                        for (var i = 0; i < xrs.length; i++) {
                            if ($('.modal-body #xray_id').find("option[value='" + xrs[i]['id'] + "']").length) {
                                $('.modal-body #xray_id').val(xrs[i]['id']).trigger('change');
                            } else {
                                var newOption = new Option(xrs[i]['name'], xrs[i]['id']);
                                $('.modal-body #xray_id').append(newOption).trigger('change');
                            }
                        }
                    });
                    /////////////////////////////////////////////
                    $(document).on("click", ".checkup-add", function () {
                        let cList = $('select#checkups_list').val()
                        let orderId = $(this).attr('data-id');
                        $.ajax({
                            type: "POST",
                            url: "{{ route('order.checkup.addCheckup') }}",
                            data: {'checkup_list': cList, 'order_id': orderId},
                            success: function (data) {
                                toastr.options.positionClass = 'toast-top-left';
                                toastr[data.status](data.message);
                            }
                        });
                    });
                    /////////////////////////////////////////////
                    $(document).on("click", ".xray-add", function () {
                        let xList = $('select#xrays_list').val()
                        let orderId = $(this).attr('data-id');
                        $.ajax({
                            type: "POST",
                            url: "{{ route('order.checkup.addXray') }}",
                            data: {'xray_list': xList, 'order_id': orderId},
                            success: function (data) {
                                toastr.options.positionClass = 'toast-top-left';
                                toastr[data.status](data.message);
                            }
                        });
                    });
                    /////////////////////////////////////////////
                    $(document).on("click", ".medicine-open-modal-btn", function () {
                        let orderId = $(this).attr('data-id');
                        $(".modal-body #order_id").val(orderId);
                        let mdcns = {!! json_encode($medicines) !!};
                        for (var i = 0; i < mdcns.length; i++) {
                            if ($('.modal-body #medicine_id').find("option[value='" + mdcns[i]['id'] + "']").length) {
                                $('.modal-body #medicine_id').val(mdcns[i]['id']).trigger('change');
                            } else {
                                let sts = '';
                                if (mdcns[i]['status'] == 0) {
                                    sts = ' ** غير متوفر ** ';
                                }
                                let newOption = new Option(mdcns[i]['name'] + sts, mdcns[i]['id']);
                                $('.modal-body #medicine_id').append(newOption).trigger('change');
                            }
                        }
                    });
                    ////////////////////////////////////////////// diagnostics_table
                    let diagnosticsTable = $('#diagnostics_table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "bPaginate": false,
                        "bInfo": false,
                        "language": {
                            "infoEmpty": "يرجى اضافة تشخيص",
                            "emptyTable": "يرجى اضافة تشخيص"
                        },
                        "ajax": {url: "{{ route('order.diagnosis.list', $order->id) }}"},
                        "columnDefs": [
                            {
                                "targets": "_all",
                                "defaultContent": ""
                            }
                        ],
                        "columns": [
                            {
                                "data": "",
                                "title": "#",
                                "orderable": false,
                                "searchable": false
                            },
                            {
                                "data": "diagnosis_id",
                                "title": "التشخيص",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "created_at",
                                "title": "انشئ في",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "actions",
                                "title": "إجراء",
                                "orderable": true,
                                "searchable": false
                            }
                        ],
                        "fnDrawCallback": function () {
                            $('.tooltips').tooltip();
                            diagnosticsTable.column(0).nodes().each(function (cell, i) {
                                cell.innerHTML = (parseInt(diagnosticsTable.page.info().start)) + i + 1;
                            });
                        },
                    });
                    //////////////////////////////////////////////
                    $(document).on('click', ".del_diagnosis_btn", function (e) {
                        e.preventDefault();
                        const id = $(this).data('id');
                        let url = "{{ route('order.diagnosis.delete', ":id") }}";
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
                                    success: function (data) {
                                        diagnosticsTable.draw();
                                        toastr.options.positionClass = 'toast-top-left';
                                        toastr[data.status](data.message);
                                    }
                                });
                            }
                        })
                    });
                    ////////////////////////////////////////////// checkups_table
                    $(document).on("click", ".checkup-open-modal-btn", function () {
                        let orderId = $(this).attr('data-id');
                        $(".modal-body #order_id").val(orderId);
                        let chps = {!! json_encode($checkups) !!};
                        for (var i = 0; i < chps.length; i++) {
                            if ($('.modal-body #checkup_id').find("option[value='" + chps[i]['id'] + "']").length) {
                                $('.modal-body #checkup_id').val(chps[i]['id']).trigger('change');
                            } else {
                                var newOption = new Option(chps[i]['name'], chps[i]['id']);
                                $('.modal-body #checkup_id').append(newOption).trigger('change');
                            }
                        }
                    });
                    //////////////////////////////////////////////
                    let checkupsTable = $('#checkups_table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {url: "{{ route('order.checkup.list', $order->id) }}"},
                        "columnDefs": [
                            {
                                "targets": "_all",
                                "defaultContent": ""
                            },
                        ],
                        "columns": [
                            {
                                "data": "",
                                "title": "#",
                                "orderable": false,
                                "searchable": false
                            },
                            {
                                "data": "checkup_id",
                                "title": "الفحص",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "result",
                                "title": "النتيجة",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "created_at",
                                "title": "انشئ في",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "actions",
                                "title": "إجراء",
                                "orderable": true,
                                "searchable": false
                            }
                        ],
                        "fnDrawCallback": function (oSettings) {
                            $('.tooltips').tooltip();
                            checkupsTable.column(0).nodes().each(function (cell, i) {
                                cell.innerHTML = (parseInt(checkupsTable.page.info().start)) + i + 1;
                            });
                        }
                    });
                    //////////////////////////////////////////////
                    $(document).on('click', ".del_checkup_btn", function (e) {
                        e.preventDefault();
                        const id = $(this).data('id');
                        let url = "{{ route('order.checkup.delete', ":id") }}";
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
                                    success: function (data) {
                                        checkupsTable.draw();
                                        toastr.options.positionClass = 'toast-top-left';
                                        toastr[data.status](data.message);
                                    }
                                });
                            }
                        })
                    });
                    ///////////////////////////////////////////// xrays table
                    let xraysTable = $('#xrays_table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {url: "{{ route('order.xray.list', $order->id) }}"},
                        "columnDefs": [
                            {
                                "targets": "_all",
                                "defaultContent": ""
                            },
                        ],
                        "columns": [
                            {
                                "data": "",
                                "title": "#",
                                "orderable": false,
                                "searchable": false
                            },
                            {
                                "data": "xray_id",
                                "title": "الأشعة",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "instructions",
                                "title": "التعليمات",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "created_at",
                                "title": "انشئ في",
                                "orderable": true,
                                "searchable": false
                            },

                            {
                                "data": "actions",
                                "title": "إجراء",
                                "orderable": true,
                                "searchable": false
                            }
                        ],
                        "fnDrawCallback": function () {
                            $('.tooltips').tooltip();
                            xraysTable.column(0).nodes().each(function (cell, i) {
                                cell.innerHTML = (parseInt(xraysTable.page.info().start)) + i + 1;
                            });
                        }
                    });
                    //////////////////////////////////////////////
                    $(document).on('click', ".del_xray_btn", function (e) {
                        e.preventDefault();
                        const id = $(this).data('id');
                        let url = "{{ route('order.xray.delete', ":id") }}";
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
                                    success: function (data) {
                                        xraysTable.draw();
                                        toastr.options.positionClass = 'toast-top-left';
                                        toastr[data.status](data.message);
                                    }
                                });
                            }
                        })
                    });
                    ///////////////////////////////////////////// medicines table
                    let medicinesTable = $('#medicines_table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {url: "{{ route('order.medicine.list', $order->id) }}"},
                        "columnDefs": [
                            {
                                "targets": "_all",
                                "defaultContent": ""
                            },
                        ],
                        "columns": [
                            {
                                "data": "",
                                "title": "#",
                                "orderable": false,
                                "searchable": false
                            },
                            {
                                "data": "medicine_id",
                                "title": "الدواء",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "unit",
                                "title": "الوحدة",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "quantity",
                                "title": "الكمية",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "dose_quantity",
                                "title": "الجرعة",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "times",
                                "title": "التكرار",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "duration",
                                "title": "المدة",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "instructions",
                                "title": "التعليمات",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "user_type",
                                "title": "جهة الإضافة",
                                "orderable": true,
                                "searchable": false
                            },
                            {
                                "data": "actions",
                                "title": "إجراء",
                                "orderable": true,
                                "searchable": false
                            }
                        ],
                        "fnDrawCallback": function () {
                            $('.tooltips').tooltip();
                            medicinesTable.column(0).nodes().each(function (cell, i) {
                                cell.innerHTML = (parseInt(medicinesTable.page.info().start)) + i + 1;
                            });
                        }
                    });
                    //////////////////////////////////////////////
                    $(document).on('click', ".del_medicine_btn", function (e) {
                        e.preventDefault();
                        const id = $(this).data('id');
                        let url = "{{ route('order.medicine.delete', ":id") }}";
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
                                    success: function (data) {
                                        medicinesTable.draw();
                                        toastr.options.positionClass = 'toast-top-left';
                                        toastr[data.status](data.message);
                                    }
                                });
                            }
                        })
                    });
                });
            </script>
        @endsection
    </div>
</x-base-layout>


