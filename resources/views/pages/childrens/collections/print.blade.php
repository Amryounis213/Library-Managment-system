<?php
$total = 0;
?>
<x-base-layout>
    @include('.layout.error')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!-- begin::Invoice 1-->
                <div class="card">
                    <!-- begin::Body-->
                    <div class="card-body py-20">
                        <!-- begin::Wrapper-->
                        <div class="mw-lg-950px mx-auto w-100">
                            <!-- begin::Header-->
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="fw-boldest text-gray-800 fs-1 pe-5">فاتورة دفع</h4>
                                    <div class="fs-6 fw-bold mt-6">
                                        <span class="text-gray-600">الاســم:</span>
                                        <span class="text-gray-800">{{$order->name}}</span>
                                    </div>
                                    <div class="fs-6 fw-bold">
                                        <span class="text-gray-600">العمر:</span>
                                        <span
                                            class="text-gray-800">{{$order->patient->age()}} {{$order->patient->age() > 9 ?  'عام' : 'أعوام'}}</span>
                                    </div>
                                    <div class="fs-6 fw-bold">
                                        <span class="text-gray-600">التاريخ:</span>
                                        <span class="text-gray-800 ">{{$date}}</span>
                                    </div>
                                </div>
                                <!--end::Logo-->
                                <div class="text-center col-4">
                                    <!--begin::Logo-->
                                    <img alt="Logo" src="{{asset('demo1/media/logos/logo_image.jpg')}}" width="100">
                                    <!--end::Logo-->
                                    <!--begin::Text-->
                                    <div class="fw-bold text-muted mt-2 text-center">
                                        <div>مكتبة pdf- خانيونس</div>
                                        <div>Islamic Association - Khanyunis</div>
                                    </div>
                                    <!--end::Text-->
                                </div>
                            </div>
                            <!--end::Header-->                        <!--begin::Body-->
                            <div class="pb-3">
                                <!--begin::Image-->
                                <!--end::Image-->
                                <!--begin::Wrapper-->
                                <div class="d-flex justify-content-between flex-column flex-md-row">
                                    <!--begin::Content-->
                                    <div class="flex-grow-1 pt-8 mb-6">
                                        <!--begin::Table-->
                                        <div class="table-responsive border-bottom mb-3">
                                            <table class="table">
                                                <thead>
                                                <tr class="border-bottom fs-6 fw-bolder text-muted text-uppercase">
                                                    <th class="min-w-100px pb-3">الخدمة</th>
                                                    <th class="min-w-175px pb-3">البيان</th>
                                                    <th class="min-w-70px pb-3 text-end">الوحدة/الكود</th>
                                                    <th class="min-w-70px pb-3 text-end">الكمية</th>
                                                    <th class="min-w-80px pb-3 text-end">سعر الوحده</th>
                                                    <th class="min-w-100px pe-lg-6 pb-3 text-end">المجموع</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(sizeof($order->medicines) > 0 && $order->pharmacy_payment > -1)
                                                    @foreach($order->medicines as $item)
                                                        @if($item->status == 1 && $item->payment_status == 1)
                                                            <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                                                <td class="text-start">
                                                                    <i class="fa fa-genderless text-danger fs-1 me-2"></i>أدوية
                                                                </td>
                                                                <td class="d-flex">{{$item->medicine->name}}</td>
                                                                <td>{{$item->medicine->unit}}</td>
                                                                <td>{{$item->quantity}}</td>
                                                                <td>{{getDecimal($item->net_price)}} <i
                                                                        class="fas fa-shekel-sign"> </i></td>
                                                                <td class="fs-5 pe-lg-6 text-dark fw-boldest">
                                                                    {{getDecimal($item->net_price * $item->quantity)}}
                                                                    <i
                                                                        class="fas fa-shekel-sign"
                                                                        style="color: #0b0b10"></i>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $total += $item->net_price * $item->quantity
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if(sizeof($order->checkups) > 0 && $order->lab_payment > -1)
                                                    <tr class="fw-bolder text-gray-700 fs-5 text-end border-bottom"></tr>
                                                    @foreach($order->checkups as $item)
                                                        @if($item->status == 1 &&  $item->payment_status == 1)
                                                            <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                                                <td class="text-start">
                                                                    <i class="fa fa-genderless text-success fs-1 me-2"></i>تحاليل
                                                                    مخبرية
                                                                </td>
                                                                <td class="d-flex">{{$item->checkup->name}}</td>
                                                                <td>{{$item->checkup->no}}</td>
                                                                <td> -</td>
                                                                <td> -
{{--                                                                    {{getDecimal($item->checkup->price)}} --}}
{{--                                                                    <i class="fas fa-shekel-sign"></i>--}}
                                                                </td>
                                                                <td class="fs-5 pe-lg-6 text-dark fw-boldest">-
{{--                                                                    {{getDecimal($item->checkup->price)}}--}}
{{--                                                                    <i class="fas fa-shekel-sign"--}}
{{--                                                                       style="color: #0b0b10"></i>--}}
                                                                </td>
                                                            </tr>
                                                            <?php
//                                                            $total += $item->checkup->price
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if(sizeof($order->xrays) > 0 && $order->xray_payment > -1 )
                                                    <tr class="fw-bolder text-gray-700 fs-5 text-end border-bottom"></tr>
                                                    @foreach($order->xrays as $item)
                                                        @if($item->status == 1 && $item->payment_status == 1)
                                                            <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                                                <td class="text-start">
                                                                    <i class="fa fa-genderless text-primary fs-1 me-2"></i>صور
                                                                    أشعة
                                                                </td>
                                                                <td class="d-flex">{{$item->xray->name}}</td>
                                                                <td>{{$item->xray->no}}</td>
                                                                <td> -</td>
                                                                <td> -
{{--                                                                    {{getDecimal($item->xray->price)}} --}}
{{--                                                                    <i  class="fas fa-shekel-sign"></i>--}}
                                                                </td>
                                                                <td class="fs-5 pe-lg-6 text-dark fw-boldest"> -
{{--                                                                    {{getDecimal($item->xray->price)}} --}}
{{--                                                                    <i class="fas fa-shekel-sign"--}}
{{--                                                                        style="color: #0b0b10"></i>--}}
                                                                </td>
                                                            </tr>
                                                            <?php
//                                                            $total += $item->xray->price
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                        <!--begin::Section-->
                                        <div class="row">
                                            <!--begin::Item-->
                                            <div class="col-4 mb-3 fs-6">
                                                <div class="fw-bold text-gray-600 mb-2 text-center">العيـادة</div>
                                                <div class="text-center"> {{$order->clinic->name}}</div>
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="col-4 fs-6">
                                                <div class="fw-bold text-gray-600 mb-2 text-center">المحصل</div>
                                                <div class="text-center">{{auth()->user()->name}}</div>
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="col-4 mb-3 fs-6">
                                                <div class="fw-bold text-gray-600 mb-2 text-center">طريقة الدفــع</div>
                                                <div class="text-center">نقدي</div>
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="border-end d-none d-md-block mh-450px mx-9"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="text-end pt-total">
                                        <!--begin::Total Amount-->
                                        <div class="fs-3 fw-bolder text-muted mb-3">الإجمالي</div>
                                        <div class="fs-xl-2x fs-2 fw-boldest">{{getDecimal($total)}} <i
                                                class="fas fa-shekel-sign"
                                                style="color: #0b0b10"></i>
                                        </div>
                                        <div class="text-muted fw-bold">شامل قيمة الضريبة المضافة</div>
                                        <!--end::Total Amount-->
                                        <div class="border-bottom w-100 my-7 my-lg-6"></div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Body-->
                            <!-- begin::Footer-->
                            <div class="d-flex  justify-content-end flex-wrap mt-lg-6 pt-13">
                                <a type="button" class="btn btn-secondary m-1 w-100px"
                                   href="{{ route('order.collections', $order) }}">رجــوع</a>
                                <button type="button" class="btn btn-success w-100px m-1" onclick="window.print();">
                                    طبـاعة
                                </button>
                                <form class="form" method="POST" action="{{ route('order.collections.pay') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <button type="submit" class="btn btn-primary w-100px m-1">دفــــع</button>
                                </form>
                                <!-- end::Action-->
                            </div>
                            <!-- end::Footer-->
                        </div>
                        <!-- end::Wrapper-->
                    </div>
                    <!-- end::Body-->
                </div>
                <!-- end::Invoice 1-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    @section('styles')
        <style>
            .pt-total {
                padding-top: 2.5rem;
            }

            .fa-shekel-sign {
                font-size: 12px;
            }

            @media print {
                .card .card-body {
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                }

                td {
                    font-size: 10px !important;

                }

                .fa-shekel-sign {
                    font-size: 10px;
                }

                .table > :not(caption) > * > * {
                    padding: 0;
                }

                .content {
                    padding: 0;
                }

                .pt-total {
                    padding-top: 0;
                }

                @page {
                    size: a5 landscape;
                }
            }
        </style>
    @endsection
</x-base-layout>

