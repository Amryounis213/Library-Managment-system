<x-base-layout>
    @include('layout.error')
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
                            <div class="d-flex justify-content-between  flex-sm-row mb-12">
                                <div>
                                    <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">السجل الطبي</h4>
                                    <div class="fs-6 fw-bold mb-2 mt-6">
                                        <span class="text-gray-600"> الاســم:</span>
                                        <span class="text-gray-800">{{$patient->name}}</span>
                                    </div>
                                    <div class="fs-6 fw-bold mb-3">
                                        <span class="text-gray-600">العنوان:</span>
                                        <span class="text-gray-800">{{$patient->address}}</span>
                                    </div>
                                </div>
                                <!--end::Logo-->
                                <div class="text-center">
                                    <!--begin::Logo-->
                                    <img alt="Logo" src="{{asset('demo1/media/logos/logo_image.jpg')}}" width="120">
                                    <!--end::Logo-->
                                    <!--begin::Text-->
                                    <div class="fw-bold fs-4 text-muted mt-2 text-center">
                                        <div>مكتبة pdf- خانيونس</div>
                                        <div>Islamic Association - Khanyunis</div>
                                    </div>
                                    <!--end::Text-->
                                </div>
                            </div>
                            <!--end::Header-->
                        @foreach($orders as $order)
                            <!--begin::Body-->
                                <div class="pb-3">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex justify-content-between flex-column flex-md-row">
                                        <!--begin::Content-->
                                        <div class="flex-grow-1 pt-8 mb-6">
                                            <!--begin::Section-->
                                            <div class="d-flex flex-column border-bottom mb-8">
                                                <div class="d-flex flex-column mw-md-300px">
                                                    <!--end::Item--> <!--begin::Item-->
                                                    <div class="d-flex flex-stack text-gray-800 mb-3 fs-6">
                                                        <!--begin::Accountnumber-->
                                                        <div class="fw-bold pe-5"> تاريخ الزيارة:</div>
                                                        <!--end::Accountnumber-->
                                                        <!--begin::Number-->
                                                        <div
                                                            class="text-end fw-norma">{{$order->patient->created_at->format('d-m-y  **  H:m A')}}</div>
                                                        <!--end::Number-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack text-gray-800 mb-3 fs-6">
                                                        <!--begin::Accountname-->
                                                        <div class="fw-bold pe-5"> العيـادة:</div>
                                                        <!--end::Accountname-->
                                                        <!--begin::Label-->
                                                        <div
                                                            class="text-end fw-norma"> {{$order->clinic->name}}</div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack text-gray-800 mb-3 fs-6">
                                                        <!--begin::Accountnumber-->
                                                        <div class="fw-bold pe-5"> الطبيب:</div>
                                                        <!--end::Accountnumber-->
                                                        <!--begin::Number-->
                                                        <div
                                                            class="text-end fw-norma">{{auth()->user()->name}}</div>
                                                        <!--end::Number-->
                                                    </div>

                                                </div>
                                            </div>
                                            <!--end::Section-->
                                            <!--begin::Table-->
                                            <div class="table-responsive border-bottom-dotted mb-8">
                                                <table class="table">
                                                    <thead>
                                                    <tr class="border-bottom fs-6 fw-bolder text-muted text-uppercase">
                                                        <th class="pb-9">الخدمة</th>
                                                        <th class="pb-9">البيان</th>
                                                        <th class="pb-9">التعليمات</th>
                                                        <th class="pb-9">الكمية</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $data = 0; ?>
                                                    @if(sizeof($order->diagnostics) > 0)
                                                        <?php $data = 1; ?>
                                                        @foreach($order->diagnostics as $item)
                                                            <tr class="fw-bolder text-gray-700 fs-5">
                                                                <td class="text-start pt-5">
                                                                    <i class="fa fa-genderless text-warning fs-1 me-2"></i>تشخيص
                                                                </td>
                                                                <td class="pt-5"
                                                                    colspan="3">{{$item->diagnosis->description}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    @if(sizeof($order->medicines) > 0)
                                                        <?php $data = 1; ?>

                                                        @foreach($order->medicines as $item)
                                                            <tr class="fw-bolder text-gray-700 fs-5">
                                                                <td class="text-start pt-5">
                                                                    <i class="fa fa-genderless text-danger fs-1 me-2"></i>أدوية
                                                                </td>
                                                                <td class="pt-5">{{$item->medicine->name}}</td>
                                                                <td class="pt-5">{{$item->instructions}}</td>
                                                                <td class="pt-5">{{$item->quantity}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    @if(sizeof($order->checkups) > 0)
                                                        <?php $data = 1; ?>

                                                        @foreach($order->checkups as $item)
                                                            <tr class="fw-bolder text-gray-700 fs-5">
                                                                <td class="text-start pt-5">
                                                                    <i class="fa fa-genderless text-success fs-1 me-2"></i>تحاليل
                                                                    مخبرية
                                                                </td>
                                                                <td class="pt-5">{{$item->checkup->name}}</td>
                                                                <td class="pt-5"
                                                                    colspan="2">{{$item->instructions}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    @if(sizeof($order->xrays) > 0)
                                                        <?php $data = 1; ?>

                                                        @foreach($order->xrays as $item)
                                                            <tr class="fw-bolder text-gray-700 fs-5">
                                                                <td class="text-start pt-5">
                                                                    <i class="fa fa-genderless text-primary fs-1 me-2"></i>صور
                                                                    أشعة
                                                                </td>
                                                                <td class="pt-5">{{$item->xray->name}}</td>
                                                                <td class="pt-5"
                                                                    colspan="2">{{$item->instructions}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    @if($data == 0)
                                                        <tr class="fw-bolder text-gray-700 fs-5">
                                                            <td colspan="4" class="text-center">
                                                                لا يوجد بيانات ..
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->

                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Body-->
                        @endforeach
                        <!-- begin::Footer-->
                            <div class="d-flex  justify-content-end flex-wrap mt-lg-6">
                                <a type="button" class="btn btn-secondary m-1 w-100px"
                                   href="{{ URL::previous() }}">رجــــوع</a>
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
</x-base-layout>
