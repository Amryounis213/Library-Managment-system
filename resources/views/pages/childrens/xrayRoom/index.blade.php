<x-base-layout>
    @include('.layout.error')
    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
        <!--begin::Card-->
        <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10">
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
                                class="mx-3">|</span>{{$order->patient->age()}} {{$order->patient->age() > 9 ? 'أعوام' : 'عام'}}
                        </div>
                    </div>
                    <!--end::Title-->
                </div>
                <div class="d-flex my-4  no-print">
                    <!--begin::Menu-->
                    <div class="d-flex flex-wrap">
{{--                        <!--begin::Stat-->--}}
{{--                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">--}}
{{--                            <!--begin::Number-->--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <div id="total-price" class="fs-2 fw-bolder" data-kt-countup="true"--}}
{{--                                     data-kt-countup-value="0"--}}
{{--                                     data-kt-countup-decimal-places="1" data-kt-countup-prefix=""--}}
{{--                                     style="color: #009EF7;">0--}}
{{--                                </div>--}}
{{--                                <i class="fas fa-shekel-sign m-1"></i>--}}
{{--                            </div>--}}
{{--                            <!--end::Number-->--}}
{{--                            <!--begin::Label-->--}}
{{--                            <div class="fw-bold fs-6 text-gray-400">الإجمالي</div>--}}
{{--                            <!--end::Label-->--}}
{{--                        </div>--}}
{{--                        <!--end::Stat-->--}}
{{--                        <!--begin::Stat-->--}}
{{--                        <div--}}
{{--                            class="{{$order->xray_payment <= 0 ? 'alert-danger' : 'alert-success'}}  border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3 text-center">--}}
{{--                            <h3 style="color: {{$order->xray_payment <= 0 ? 'red' : 'green'}}; margin: 10px 0px;">{{$order->xray_payment <= 0 ? 'غير مدفوع' : 'مدفوع'}}</h3>--}}
{{--                            <!--end::Label-->--}}
{{--                        </div>--}}
{{--                        <!--end::Stat-->--}}
                    </div>
                    <!--end::Menu-->
                </div>
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Card-->
    {{--////////////////////////////// - Tables - ///////////////////////////--}}
    <!--begin::Card-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button"
                 data-bs-toggle="collapse"
                 data-bs-target="#kt_pharmacy_details" aria-expanded="true"
                 aria-controls="kt_pharmacy_details">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    {!! theme()->getSvgIcon("icons/duotune/medicine/med001.svg", "svg-icon-3x svg-icon-primary") !!}
                    <h3 class="fw-bolder m-3">{{ __('Xray') }} </h3>
                    <!--end::Search-->
                </div>
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_xray_details" class="show collapse">
                <!--begin::Card body-->
                <div class="card-body border-top p-9 item">
                    <table id="data_table" class="table table-row-bordered gy-5">
                        <thead>
                        <tr class="fw-bold fs-6 text-muted">
                            <th>#</th>
                            <th>الأشعة</th>
                            <th>الكود</th>
                            <th>تعليمات</th>
{{--                            <th>السـعر</th>--}}
{{--                            <th>حالة الدفع</th>--}}
                            <th>متـوفــر</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Card-->
        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <a type="button" class="btn btn-secondary m-1 w-150px" href="{{ route('order.index') }}">رجــــوع</a>
            <a type="button" class="btn btn-primary m-1 w-150px"
               href="{{ route('order.xray.print', ['type' => 'all' ,'order' => $order]) }}">طباعة
                الكل</a>
            <a type="button" class="btn btn-warning m-1 w-150px"
               href="{{ route('order.xray.print', ['type' => 'out' ,'order' => $order]) }}">طباعة
                النواقص</a>
            @if($order->status > 3  && $order->xray_payment > 0)
                <a type="button" class="btn btn-success m-1 w-150px"
                   href="{{ route('order.xray.print', ['type' => 'in' ,'order' => $order]) }}">طباعة
                    المستلمة </a>
            @endif
            @if( $order->xray_payment < 0)
            <!--begin::Form-->
                <form id="details_form" class="form" method="POST" action="{{ route('order.status.update') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <input type="hidden" name="status" value="3">
                    <input type="hidden" name="xray_payment" value="0">
                    <button type="submit" class="btn btn-danger m-1 w-150px" id="kt_account_profile_details_submit">
                        @include('partials.general._button-indicator', ['label' => 'ارسال للدفع'])
                    </button>
                </form>
                <!--end::Form-->
            @endif
            {{--        @if($order->status > 3)--}}
            {{--            <!--begin::Form-->--}}
            {{--                <form method="POST" action="{{ route('order.field.update') }}" enctype="multipart/form-data">--}}
            {{--                    @csrf--}}
            {{--                    @method('POST')--}}
            {{--                    <input type="hidden" name="order_id" value="{{$order->id}}">--}}
            {{--                    <input type="hidden" name="in_xray" value="2">--}}
            {{--                    <button type="submit" class="btn btn-danger m-1 w-125px" id="kt_account_profile_details_submit">--}}
            {{--                        @include('partials.general._button-indicator', ['label' => 'انهــــــاء'])--}}
            {{--                    </button>--}}
            {{--                </form>--}}
            {{--                <!--end::Form-->--}}
            {{--            @endif--}}
        </div>
        <!--end::Actions-->
    </div>
    @include('pages.order.modals.add_note')

    {{--/////////////////////////////// - CSS - ///////////////////////////////--}}
    @section('styles')
        <style>
            @media print {
                .no-print {
                    visibility: hidden;
                }
            }
        </style>

    @endsection

    {{--/////////////////////////////// - JS - ///////////////////////////////--}}
    @section('scripts')
        <script src="{{asset('demo1/plugins/custom/datatables/datatables.bundle.js')}}"></script>
        <script src="{{asset('demo1/js/custom/order/add_note_modal.js')}}"></script>
        {{--////////////////////////////////////////////////////////////--}}
        <script type="text/javascript">
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                totalPrice();

                ///////////////////////////////////////////// medicines table
                function totalPrice() {
                    const id = {{$order->id}};
                    $.ajax({
                        type: "POST",
                        url: "{{ route('order.xray.total') }}",
                        data: {'id': id},
                        success: function (data) {
                            $('#total-price').attr('data-kt-countup-value', data);
                            $('#total-price').removeClass('counted');
                            startCounter();
                        }
                    });
                }

                ////////////////////////////////////////////
                function startCounter() {
                    var elements = [].slice.call(document.querySelectorAll('[data-kt-countup="true"]:not(.counted)'));
                    elements.map(function (element) {
                        var options = {};
                        var value = element.getAttribute('data-kt-countup-value');
                        value = parseFloat(value.replace(/,/, ''));
                        if (element.hasAttribute('data-kt-countup-start-val')) {
                            options.startVal = parseFloat(element.getAttribute('data-kt-countup-start-val'));
                        }
                        if (element.hasAttribute('data-kt-countup-duration')) {
                            options.duration = parseInt(element.getAttribute('data-kt-countup-duration'));
                        }
                        if (element.hasAttribute('data-kt-countup-decimal-places')) {
                            options.decimalPlaces = parseInt(element.getAttribute('data-kt-countup-decimal-places'));
                        }
                        if (element.hasAttribute('data-kt-countup-prefix')) {
                            options.prefix = element.getAttribute('data-kt-countup-prefix');
                        }
                        if (element.hasAttribute('data-kt-countup-suffix')) {
                            options.suffix = element.getAttribute('data-kt-countup-suffix');
                        }
                        var count = new countUp.CountUp(element, value, options);
                        count.start();
                        element.classList.add('counted');
                    });
                }

                //////////////////////////////////////////////
                let xraysTable = $('#data_table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "info": false,
                    "paging": false,
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
                            "data": "code",
                            "title": "الكود",
                            "orderable": true,
                            "searchable": false
                        },
                        {
                            "data": "instructions",
                            "title": "التعليمات",
                            "orderable": true,
                            "searchable": false
                        },
                        // {
                        //     "data": "price",
                        //     "title": "السعر",
                        //     "orderable": true,
                        //     "searchable": false
                        // },
                        // {
                        //     "data": "payment_status",
                        //     "title": "حالة الدفع",
                        //     "orderable": true,
                        //     "searchable": false
                        // },
                        {
                            "data": "status",
                            "title": "متـوفــر",
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
                $(document).on('click', '.sts-fld', function (e) {
                    //e.preventDefault();
                    const id = $(this).data('id');
                    const checkedValue = $(this).is(":checked");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('order.xray.status') }}",
                        data: {'id': id},
                        success: function (data) {
                            totalPrice();
                            if (data.type === 'yes') {
                                startCounter();
                                $(this).prop("checked", checkedValue);
                            } else if (data.type === 'no') {
                                $(this).prop("checked", !checkedValue);
                                startCounter();
                            }
                            xraysTable.draw();
                            toastr.options.positionClass = 'toast-top-left';
                            toastr[data.status](data.message);
                        }
                    });
                });
            });
        </script>
    @endsection

</x-base-layout>


