<x-base-layout>
@include('layout.error')
<!--begin::Container-->

    
    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
        <h3 class="p-4">  تسجيل حضور اليوم : {{date('y-m-d')}}</h3>
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-1 pt-6">
                <!--begin::Card title-->
                <div class="card-title d-flex justify-content-between">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                          transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            
                                <input type="text" id="myInputSearchField" class="form-control form-control-solid w-250px ps-15 ml-5" placeholder="البحث عن اسم موظف ...">
                                <button type="submit" class="btn btn-success">{{__('Search')}}</button>
                            

                        <!--end::Svg Icon-->
                       
                    </div>

                   
                   
                   

                  
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <label> تحديد الكل حضور</label>
                        <input  type="checkbox" value="0" onclick="CheckAll('box1', this)">
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none"
                         data-kt-customer-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
                        </div>
                        <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">
                            Delete
                            Selected
                        </button>
                    </div>
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <form action="{{route('attendance.store')}}"  method="POST">
            @csrf
            <div class="card-body pt-6">
                @include('pages.Attendance.employees.parts._table')
            </div>
            
            <div class="p-2 container text-center">
                <hr>
                <button class="btn btn-success " type="submit"> تأكيد الحضور</button>
            </div>
            <!--end::Card body-->
            </form>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</x-base-layout>

