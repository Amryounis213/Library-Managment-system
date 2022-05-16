<x-base-layout>
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
                            <div class="d-flex justify-content-between flex-column flex-sm-row">
                                <div>
                                    <h4 class="fw-boldest text-gray-800 fs-2x pe-5">صور أشعة</h4>
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
                                <div class="text-center">
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
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="pb-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex justify-content-between flex-column flex-md-row">
                                    <!--begin::Content-->
                                    <div class="flex-grow-1 pt-8 mb-6">
                                        <!--begin::Table-->
                                        <div class="table-responsive border-bottom mb-8">
                                            <table class="table">
                                                <thead>
                                                <tr class="border-bottom fs-6 fw-bolder text-muted text-uppercase">
                                                    <th class="min-w-70px pb-3">الأشعة</th>
                                                    <th class="min-w-175px pb-3">الإرشادات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($type == 'all')
                                                    @include('pages.order.xrayRoom._print_all')
                                                @elseif($type == 'in')
                                                    @include('pages.order.xrayRoom._print_in')
                                                @elseif($type == 'out')
                                                    @include('pages.order.xrayRoom._print_out')
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                        <!--begin::Section-->
                                        <div class="row">
                                            <!--begin::Item-->
                                            <div class="col-4 mb-3 fs-6">
                                                <div class="fw-bold text-gray-600 mb-4 text-center">العيـادة</div>
                                                <div class="text-center"> {{$order->clinic->name}}</div>
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="col-4 fs-6">
                                                <div class="fw-bold text-gray-600 mb-4 text-center">الطبيب</div>
                                                <div class="text-center">
                                                    <span>د.</span><span>{{$order->doctor ->name}}</span></div>
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="col-4 fs-6">
                                                <div class="fw-bold text-gray-600 mb-4 text-center">الأخصائي</div>
                                                <div class="text-center"><span>{{auth()->user()->name}}</span></div>
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Body-->
                            <!-- begin::Footer-->
                            <div class="d-flex  justify-content-end flex-wrap mt-lg-6 pt-13">
                                <a type="button" class="btn btn-secondary m-1 w-100px"
                                   href="{{ route('order.xrayRoom', $order->id) }}">رجــــوع</a>
                                <button type="button" class="btn btn-success w-100px m-1" onclick="window.print();">
                                    طباعة
                                </button>
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
    {{--/////////////////////////////// - CSS - ///////////////////////////////--}}
    @section('styles')
        <style>
            @media print {
                .card .card-body {
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                }

                td {
                    font-size: 10px !important;

                }

                .table > :not(caption) > * > * {
                    padding: 0;
                }

                .content {
                    padding: 0;
                }

                @page {
                    size: a5 landscape;
                }
            }
        </style>
    @endsection
</x-base-layout>
