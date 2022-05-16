<x-base-layout>

    @php
        $per1 = 0;
        $per2 = 0;
        $per3 = 0;
        $per4 = 0;
        //الطلاب
        if ($ChildrenMorning != 0) {
            $per1 = round(($ChildrenMorning / $AllChildrenMorning) * 100, 2);
        }
        
        if ($ChildrenNight != 0) {
            $per2 = round(($ChildrenNight / $AllChildrenNight) * 100, 2);
        }
        // الموظفين
        // $per3 = round(($employeeAtt / $employeeCount) * 100, 2);
       
        
        if ($EmployeeMorning != 0) {
            $per3 = round(($EmployeeMorning / $AllEmployeeMorning) * 100, 2);
        }
        
        if ($EmployeeNight != 0) {
            $per4 = round(($EmployeeNight / $AllEmployeeNight) * 100, 2);
        }
        
    @endphp
    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
        <div class="row g-5 g-xl-8">
            <!--begin::Col-->

            <div class="col-xl-4">
                <div class="col-md-12 row">
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 1-->
                        <div class="card  bgi-no-repeat bg-dark card-xl-stretch mb-5 mb-xl-8"
                            style="background-position: right top; background-size: 20% auto; background-image: url({{ '/demo1/media/svg/shapes/abstract-2.svg' }})">
                            <!--begin::Body-->
                            <div class="card-body">
                                <a href="#"
                                    class="card-title text-dark fw-bolder text-muted  text-hover-primary fs-7">موظفين
                                    مسكنين</a>
                                <div class="fw-bolder text-primary fs-3qx" data-kt-countup="true"
                                    data-kt-countup-value="{{ $employeeJob }}">0
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Statistics Widget 1-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 1-->
                        <div class="card  bgi-no-repeat bg-dark card-xl-stretch mb-5 mb-xl-8"
                            style="background-position: right top; background-size: 20% auto; background-image: url({{ '/demo1/media/svg/shapes/abstract-2.svg' }})">
                            <!--begin::Body-->
                            <div class="card-body">
                                <a href="#" class="card-title text-dark fw-bolder text-muted  text-hover-primary fs-7">
                                    غير مسكنين
                                </a>
                                <div class="fw-bolder text-primary fs-3qx" data-kt-countup="true"
                                    data-kt-countup-value="{{ $employeewithoutJob }}">0
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Statistics Widget 1-->
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-xl-6">
                        <div class="card boxing bgi-no-repeat card-xl-stretch mb-5 mb-xl-8"
                            style="background-position: right top; background-size: 20% auto; background-image: url({{ '/demo1/media/svg/shapes/abstract-2.svg' }})">
                            <!--begin::Body-->
                            <div class="card-body">
                                <a href="#" class="card-title text-dark fw-bolder  text-hover-primary fs-7">
                                    سائقين مسكنين
                                </a>
                                <div class="fw-bolder text-dark fs-3qx" data-kt-countup="true"
                                    data-kt-countup-value="{{ $driversCount }}">0
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card boxing bgi-no-repeat card-xl-stretch mb-5 mb-xl-8"
                            style="background-position: right top; background-size: 20% auto; background-image: url({{ '/demo1/media/svg/shapes/abstract-2.svg' }})">
                            <!--begin::Body-->
                            <div class="card-body">
                                <a href="#" class="card-title text-dark fw-bolder  text-hover-primary fs-7">
                                    غير مسكنين
                                </a>
                                <div class="fw-bolder text-dark fs-3qx" data-kt-countup="true"
                                    data-kt-countup-value="{{ $driverwithoutPlacment }}">0
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-xl-6">
                        <div class="card bgi-no-repeat card-xl-stretch mb-5 mb-xl-8"
                            style="background-position: right top; background-size: 20% auto; background-image: url({{ '/demo1/media/svg/shapes/abstract-2.svg' }})">
                            <!--begin::Body-->
                            <div class="card-body">
                                <a href="#" class="card-title fw-bolder text-muted text-hover-primary fs-7">
                                    طلاب مسكنين
                                </a>
                                <div class="fw-bolder text-primary fs-3qx" data-kt-countup="true"
                                    data-kt-countup-value="{{ $classplacementstudent }}">0
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card bgi-no-repeat card-xl-stretch mb-5 mb-xl-8"
                            style="background-position: right top; background-size: 20% auto; background-image: url({{ '/demo1/media/svg/shapes/abstract-2.svg' }})">
                            <!--begin::Body-->
                            <div class="card-body">
                                <a href="#" class="card-title fw-bolder text-muted text-hover-primary fs-7">
                                    غير مسكنين
                                </a>
                                <div class="fw-bolder text-primary fs-3qx" data-kt-countup="true"
                                    data-kt-countup-value="{{ $studentsCount - $classplacementstudent }}">0
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="col-md-12">
                    <div class="card bgi-no-repeat card-xl-stretch mb-xl-5">
                        <!--begin::Body-->
                        <div class="card-body my-3">
                            <div class="d-flex">
                                <span class="svg-icon svg-icon-success svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar1.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13"
                                                rx="1.5" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8"
                                                rx="1.5" />
                                            <path
                                                d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6"
                                                rx="1.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <a href="#" class="card-title fw-bolder text-success fs-5 mb-3 d-block">
                                    نسبة حضور الموظفين - الفترة الصباحية
                                </a>
                            </div>
                            <div class="py-1">
                                <span class="text-dark fs-1 fw-bolder me-2" data-kt-countup="true"
                                    data-kt-countup-value="{{ $per3 }}"> {{ $per3 }}</span>
                                <span class="fw-bold text-muted fs-7">%</span>
                            </div>
                            <div class="progress h-7px bg-success bg-opacity-50 mt-7">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $per3 }}%" aria-valuenow="{{ $per3 }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="card-footer">
                                <strong> الحضور / الكل :</strong>
                                <span>{{ $EmployeeMorning }} من اصل {{ $AllEmployeeMorning }} موظف</span>
                            </div>
                        </div>
                        <!--end:: Body-->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card bgi-no-repeat card-xl-stretch mb-xl-2">
                        <!--begin::Body-->
                        <div class="card-body my-3">
                            <div class="d-flex">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar1.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13"
                                                rx="1.5" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8"
                                                rx="1.5" />
                                            <path
                                                d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6"
                                                rx="1.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <a href="#" class="card-title fw-bolder text-primary fs-5 mb-3 d-block">
                                    نسبة حضور الموظفين - الفترة المسائية
                                </a>
                            </div>
                            <div class="py-1">
                                <span class="text-dark fs-1 fw-bolder me-2" data-kt-countup="true"
                                    data-kt-countup-value="{{ $per4 }}">{{ $per4 }}</span>
                                <span class="fw-bold text-muted fs-7">%</span>
                            </div>
                            <div class="progress h-7px bg-primary bg-opacity-50 mt-7">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ $per4 }}%" aria-valuenow="{{ $per4 }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="card-footer">
                                <strong> الحضور / الكل :</strong>
                                <span>{{ $EmployeeNight }} من اصل {{ $AllEmployeeNight }} موظف</span>
                            </div>
                        </div>
                        <!--end:: Body-->
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="col-md-12">
                    <div class="card bgi-no-repeat card-xl-stretch mb-xl-5">
                        <!--begin::Body-->
                        <div class="card-body my-3">
                            <div class="d-flex">
                                <span class="svg-icon svg-icon-success svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar1.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13"
                                                rx="1.5" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8"
                                                rx="1.5" />
                                            <path
                                                d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6"
                                                rx="1.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <a href="#" class="card-title fw-bolder text-success fs-5 mb-3 d-block">
                                    نسبة حضور الطلاب - الفترة الصباحية
                                </a>
                            </div>
                            <div class="py-1">
                                <span class="text-dark fs-1 fw-bolder me-2" data-kt-countup="true"
                                    data-kt-countup-value="{{ $per1 }}"> {{ $per1 }}</span>
                                <span class="fw-bold text-muted fs-7">%</span>
                            </div>
                            <div class="progress h-7px bg-success bg-opacity-50 mt-7">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $per1 }}%" aria-valuenow="{{ $per1 }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="card-footer">
                                <strong> الحضور / الكل :</strong>
                                <span> {{ $ChildrenMorning }} من اصل {{ $AllChildrenMorning }} طالب مسكن</span>
                            </div>
                        </div>
                        <!--end:: Body-->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card bgi-no-repeat card-xl-stretch mb-xl-2">
                        <!--begin::Body-->
                        <div class="card-body my-3">
                            <div class="d-flex">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar1.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13"
                                                rx="1.5" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8"
                                                rx="1.5" />
                                            <path
                                                d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6"
                                                rx="1.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <a href="#" class="card-title fw-bolder text-primary fs-5 mb-3 d-block">
                                    نسبة حضور الطلاب - الفترة المسائية
                                </a>
                            </div>
                            <div class="py-1">
                                <span class="text-dark fs-1 fw-bolder me-2" data-kt-countup="true"
                                    data-kt-countup-value="{{ $per2 }}">{{ $per2 }}</span>
                                <span class="fw-bold text-muted fs-7">%</span>
                            </div>
                            <div class="progress h-7px bg-primary bg-opacity-50 mt-7">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ $per2 }}%" aria-valuenow="{{ $per2 }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="card-footer">
                                <strong> الحضور / الكل :</strong>
                                <span> {{ $ChildrenNight }} من اصل {{ $AllChildrenNight }} طالب مسكن</span>
                            </div>

                        </div>
                        <!--end:: Body-->
                    </div>
                </div>
            </div>
          
            <!--end::Col-->
        </div>
        <div class="col-xl-12">
            <div class="card mb-5 mb-xxl-8">
                <!--begin::Header-->
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bolder mb-2 text-dark">الأقساط المستحقة للشهر الحالي</span>
                        <span class="text-muted fw-bold fs-7"></span>
                    </h3>
                    <div class="card-toolbar">

                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    <!--begin::Timeline-->
                    <div class="timeline-label">
                        <!--begin::Item-->
                        <div class="timeline-item ">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">100 ₪</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="timeline-content fw-bolder text-gray-800 ps-3">&nbsp;
                                استحقاق مالي على
                                <a href="#" class="text-primary">اسماعيل جمال محمد صلاح</a>
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">100 ₪</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-success fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Content-->
                            <div class="timeline-content fw-bolder text-gray-800 ps-3">&nbsp;
                                استحقاق مالي على
                                <a href="#" class="text-primary">حسن عبد الله جمال محسن</a>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">100 ₪</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Desc-->
                            <div class="timeline-content fw-bolder text-gray-800 ps-3">&nbsp;
                                استحقاق مالي على
                                <a href="#" class="text-primary">خالد محمد هشام محمود</a>
                            </div>
                            <!--end::Desc-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">150 ₪</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Desc-->
                            <div class="timeline-content fw-bolder text-gray-800 ps-3">&nbsp;
                                استحقاق مالي على
                                <a href="#" class="text-primary">محمد سمير كمال عبد الله</a>
                            </div>
                            <!--end::Desc-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Timeline-->
                </div>
                <!--end: Card Body-->
            </div>
        </div>
        <div class="card-body py-15">
            <!--begin::Statistics-->
            <div class="card bg-light mb-18">
                <!--begin::Body-->
                <div class="card-body py-15">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center">
                        <!--begin::Items-->
                        <div class="d-flex justify-content-between mb-10 mx-auto w-xl-900px">
                            <!--begin::Item-->
                            <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-2">
                                <!--begin::Content-->
                                <div class="text-center">
                                    <!--begin::Symbol-->
                                    <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                <path
                                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="mt-1">
                                        <!--begin::Animation-->
                                        <div class="fs-lg-2hx fs-2x fw-bolder text-gray-800 d-flex align-items-center">
                                            <div class="min-w-70px" data-kt-countup="true"
                                                data-kt-countup-value="700">0
                                            </div>
                                            +
                                        </div>
                                        <!--end::Animation-->
                                        <!--begin::Label-->
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">المصروفات</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-2">
                                <!--begin::Content-->
                                <div class="text-center">
                                    <!--begin::Symbol-->
                                    <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                <path
                                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="mt-1">
                                        <!--begin::Animation-->
                                        <div class="fs-lg-2hx fs-2x fw-bolder text-gray-800 d-flex align-items-center">
                                            <div class="min-w-70px" data-kt-countup="true"
                                                data-kt-countup-value="700">0
                                            </div>
                                        </div>
                                        <!--end::Animation-->
                                        <!--begin::Label-->
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">الايرادات</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-2">
                                <!--begin::Content-->
                                <div class="text-center">
                                    <!--begin::Symbol-->
                                    <!--begin::Svg Icon | path: icons/duotone/Interface/Pie-04.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M13.998 21.9445C13.4491 22.0057 13 21.5523 13 21L13 14C13 13.4477 13.4477 13 14 13L21 13C21.5523 13 22.0058 13.4491 21.9445 13.998C21.8509 14.8372 21.6394 15.6609 21.3149 16.4442C20.8626 17.5361 20.1997 18.5282 19.364 19.364C18.5282 20.1997 17.5361 20.8626 16.4442 21.3149C15.6609 21.6394 14.8373 21.8509 13.998 21.9445Z"
                                                fill="#12131A" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M21.9445 10.0019C22.0057 10.5508 21.5523 10.9999 21 10.9999L14 10.9999C13.4477 10.9999 13 10.5521 13 9.99986L13 2.99986C13 2.44758 13.4491 1.99412 13.9979 2.05536C14.8372 2.149 15.6609 2.3605 16.4441 2.68495C17.5361 3.13724 18.5282 3.80017 19.3639 4.6359C20.1997 5.47163 20.8626 6.46378 21.3149 7.55571C21.6393 8.33899 21.8508 9.16262 21.9445 10.0019Z"
                                                fill="#12131A" />
                                            <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10.002 3.05559C10.5509 2.99437 11 3.44784 11 4.00012L11 20.0001C11 20.5524 10.5509 21.0059 10.002 20.9446C7.98222 20.7193 6.08694 19.815 4.63604 18.3641C2.94821 16.6763 2 14.3871 2 12.0001C2 9.61317 2.94821 7.32398 4.63604 5.63616C6.08694 4.18525 7.98222 3.2809 10.002 3.05559Z"
                                                fill="#12131A" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="mt-1">
                                        <!--begin::Animation-->
                                        <div class="fs-lg-2hx fs-2x fw-bolder text-gray-800 d-flex align-items-center">
                                            <div class="min-w-50px" data-kt-countup="true"
                                                data-kt-countup-value="80">0
                                            </div>
                                            K+
                                        </div>
                                        <!--end::Animation-->
                                        <!--begin::Label-->
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">التقارير</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-2">
                                <!--begin::Content-->
                                <div class="text-center">
                                    <!--begin::Symbol-->
                                    <!--begin::Svg Icon | path: icons/duotone/Shopping/Cart4.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.25"
                                                d="M3.19406 11.1644C3.09247 10.5549 3.56251 10 4.18045 10H19.8195C20.4375 10 20.9075 10.5549 20.8059 11.1644L19.4178 19.4932C19.1767 20.9398 17.9251 22 16.4586 22H7.54138C6.07486 22 4.82329 20.9398 4.58219 19.4932L3.19406 11.1644Z"
                                                fill="#7E8299" />
                                            <path
                                                d="M2 9.5C2 8.67157 2.67157 8 3.5 8H20.5C21.3284 8 22 8.67157 22 9.5C22 10.3284 21.3284 11 20.5 11H3.5C2.67157 11 2 10.3284 2 9.5Z"
                                                fill="#7E8299" />
                                            <path
                                                d="M10 13C9.44772 13 9 13.4477 9 14V18C9 18.5523 9.44772 19 10 19C10.5523 19 11 18.5523 11 18V14C11 13.4477 10.5523 13 10 13Z"
                                                fill="#7E8299" />
                                            <path
                                                d="M14 13C13.4477 13 13 13.4477 13 14V18C13 18.5523 13.4477 19 14 19C14.5523 19 15 18.5523 15 18V14C15 13.4477 14.5523 13 14 13Z"
                                                fill="#7E8299" />
                                            <g opacity="0.25">
                                                <path
                                                    d="M10.7071 3.70711C11.0976 3.31658 11.0976 2.68342 10.7071 2.29289C10.3166 1.90237 9.68342 1.90237 9.29289 2.29289L4.29289 7.29289C3.90237 7.68342 3.90237 8.31658 4.29289 8.70711C4.68342 9.09763 5.31658 9.09763 5.70711 8.70711L10.7071 3.70711Z"
                                                    fill="#7E8299" />
                                                <path
                                                    d="M13.2929 3.70711C12.9024 3.31658 12.9024 2.68342 13.2929 2.29289C13.6834 1.90237 14.3166 1.90237 14.7071 2.29289L19.7071 7.29289C20.0976 7.68342 20.0976 8.31658 19.7071 8.70711C19.3166 9.09763 18.6834 9.09763 18.2929 8.70711L13.2929 3.70711Z"
                                                    fill="#7E8299" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="mt-1">
                                        <!--begin::Animation-->

                                        <div class="fs-lg-2hx fs-2x fw-bolder text-gray-800 d-flex align-items-center">
                                            <div class="min-w-50px" data-kt-countup="true"
                                                data-kt-countup-value="35">0
                                            </div>
                                            M+
                                        </div>
                                        <!--end::Animation-->
                                        <!--begin::Label-->
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">الاشتراكات</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Item-->

                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Wrapper-->

                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics-->

        </div>


        <!--begin::Row-->
        {{-- <div class="row gy-5 g-xl-8"> --}}
        {{-- <!--begin::Col--> --}}
        {{-- <div class="col-xxl-4"> --}}
        {{-- {{ theme()->getView('partials/widgets/mixed/_widget-2', array('class' => 'card-xxl-stretch', 'chartColor' => 'danger', 'chartHeight' => '200px')) }} --}}
        {{-- </div> --}}
        {{-- <!--end::Col--> --}}

        {{-- <!--begin::Col--> --}}
        {{-- <div class="col-xxl-4"> --}}
        {{-- {{ theme()->getView('partials/widgets/lists/_widget-5', array('class' => 'card-xxl-stretch')) }} --}}
        {{-- </div> --}}
        {{-- <!--end::Col--> --}}

        {{-- <!--begin::Col--> --}}
        {{-- <div class="col-xxl-4"> --}}
        {{-- {{ theme()->getView('partials/widgets/mixed/_widget-7', array('class' => 'card-xxl-stretch-50 mb-5 mb-xl-8', 'chartColor' => 'primary', 'chartHeight' => '150px')) }} --}}

        {{-- {{ theme()->getView('partials/widgets/mixed/_widget-10', array('class' => 'card-xxl-stretch-50 mb-5 mb-xl-8', 'chartColor' => 'primary', 'chartHeight' => '175px')) }} --}}
        {{-- </div> --}}
        {{-- <!--end::Col--> --}}
        {{-- </div> --}}
        <!- -end::Row-->

            {{-- <!--begin::Row--> --}}
            {{-- <div class="row gy-5 gx-xl-8"> --}}
            {{-- <!--begin::Col--> --}}
            {{-- <div class="col-xxl-4"> --}}
            {{-- {{ theme()->getView('partials/widgets/lists/_widget-3', array('class' => 'card-xxl-stretch mb-xl-3')) }} --}}
            {{-- </div> --}}
            {{-- <!--end::Col--> --}}

            {{-- <!--begin::Col--> --}}
            {{-- <div class="col-xl-8"> --}}
            {{-- {{ theme()->getView('partials/widgets/tables/_widget-9', array('class' => 'card-xxl-stretch mb-5 mb-xl-8')) }} --}}
            {{-- </div> --}}
            {{-- <!--end::Col--> --}}
            {{-- </div> --}}
            {{-- <!--end::Row--> --}}

            {{-- <!--begin::Row--> --}}
            {{-- <div class="row gy-5 g-xl-8"> --}}
            {{-- <!--begin::Col--> --}}
            {{-- <div class="col-xl-4"> --}}
            {{-- {{ theme()->getView('partials/widgets/lists/_widget-2', array('class' => 'card-xl-stretch mb-xl-8')) }} --}}
            {{-- </div> --}}
            {{-- <!--end::Col--> --}}

            {{-- <!--begin::Col--> --}}
            {{-- <div class="col-xl-4"> --}}
            {{-- {{ theme()->getView('partials/widgets/lists/_widget-6', array('class' => 'card-xl-stretch mb-xl-8')) }} --}}
            {{-- </div> --}}
            {{-- <!--end::Col--> --}}

            {{-- <!--begin::Col--> --}}
            {{-- <div class="col-xl-4"> --}}
            {{-- {{ theme()->getView('partials/widgets/lists/_widget-4', array('class' => 'card-xl-stretch mb-5 mb-xl-8', 'items' => '5')) }} --}}
            {{-- </div> --}}
            {{-- <!--end::Col--> --}}
            {{-- </div> --}}
            {{-- <!--end::Row--> --}}

            {{-- <!--begin::Row--> --}}
            {{-- <div class="row g-5 gx-xxl-8"> --}}
            {{-- <!--begin::Col--> --}}
            {{-- <div class="col-xxl-4"> --}}
            {{-- {{ theme()->getView('partials/widgets/mixed/_widget-5', array('class' => 'card-xxl-stretch mb-xl-3', 'chartColor' => 'success', 'chartHeight' => '150px')) }} --}}
            {{-- </div> --}}
            {{-- <!--end::Col--> --}}

            {{-- <!--begin::Col--> --}}
            {{-- <div class="col-xxl-8"> --}}
            {{-- {{ theme()->getView('partials/widgets/tables/_widget-5', array('class' => 'card-xxl-stretch mb-5 mb-xxl-8')) }} --}}
            {{-- </div> --}}
            {{-- <!--end::Col--> --}}
            {{-- </div> --}}
            {{-- <!--end::Row--> --}}
    </div>
    @section('styles')
        <style>
            .card-footer {
                padding: 1rem 0.25rem !important;
            }

            .boxing {
                background-color: #49c9c3;
            }

            .boxing2 {
                background-color: #49c9c3;
            }

            .boxing3 {
                background-color: #49c9c3;
            }

            .boxing4 {
                background-color: #49c9c3;
            }

        </style>
    @endsection
    @section('scripts')
        <script>
            var x1 = {{ round(88, 2) }};
            var element = document.getElementById("kt_mixed_widget_14_chart");
            //  alert(x1);
            //  console.log(element);
            //   var height = parseInt(KTUtil.css(element, 'height'));
            //   var chart = new ApexCharts(element, options);
            //   chart.render();
        </script>
    @endsection
</x-base-layout>
