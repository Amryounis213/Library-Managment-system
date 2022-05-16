<x-base-layout>
    @include('layout.error')

    @php
        $titles =\App\Models\Titles::where('status' , 1)->get();
        $sections =\App\Models\Section::where('status' , 1)->get();
        $subsections = \App\Models\SubSection::where('status' ,1)->get();
        $subsubsections = \App\Models\SubSubSection::where('status' ,1)->get();

      //  $sub_sections = \App\Models\SubSection::where('status' , 1)->get();
    @endphp

    <!--begin::Container-->
    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">

        <div class="card card-custom mb-3">

            <div class="card-body">
                <!--begin: Search Form-->

                <form class="mb-5" id="details_form">
                    <div class="row mb-6">

                        <div class="col-lg-2">
                            <select name="father_id" aria-label="{{ __('Select') }} العنوان" id="father_id"
                                 data-placeholder="{{ __('Select') }} العنوان .."
                                class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select') }} العنوان...
                                </option>

                                @foreach ($titles as $title)
                                <option value="{{$title->id}}">
                                    {{$title->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-1">
                            <a  data-bs-toggle="modal" data-bs-target="#section1"  href="#" class="btn btn-md btn-primary ">

                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                     

                        <div class="col-lg-2">
                            <select  aria-label="{{ __('Select') }}القسم" id="father_id2"
                                 data-placeholder="{{ __('Select') }}القسم .."
                                class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select') }}القسم...
                                </option>
                                @foreach ($sections as $section)
                                <option value="{{$section->id}}">
                                    {{$section->name}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-lg-1">
                            <a id="after_father1" data-bs-toggle="modal" data-bs-target="#section2"  href="#" class="btn btn-md btn-primary ">

                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>

                        <div class="col-lg-2">
                            <select id="father_id3" name="father_id3" aria-label="{{ __('Select') }}  المرحلة  " id="father_id3"
                                 data-placeholder="{{ __('Select') }}  المرحلة "
                                class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select') }}  المرحلة  </option>
                                @foreach ($subsections as $section)
                                <option value="{{$section->id}}">
                                    {{$section->name}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-lg-1">
                            <a id="after_father2" data-bs-toggle="modal" data-bs-target="#section3"  href="#" class="btn btn-md btn-primary ">

                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <select id="father_id4" name="father_id4" aria-label="{{ __('Select') }} العنوان" id="father_id"
                                 data-placeholder="{{ __('Select') }} العنوان .."
                                class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select') }} العنوان...
                                </option>
                                @foreach ($subsubsections as $section)
                                <option value="{{$section->id}}">
                                    {{$section->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-1">
                            <a id="after_father3" data-bs-toggle="modal" data-bs-target="#section4"  href="#" class="btn btn-md btn-primary btn-primary--icon">

                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>

                    </div>

                    <div class="row mb-6 section_type" hidden >

                        <div class="col-lg-2">
                            <select     name="father_id" aria-label="{{ __('Select') }} العنوان" id="father_id"
                                 data-placeholder="{{ __('Select') }} العنوان .."
                                class="form-select form-select-solid form-select-lg fw-bold ">
                                <option value="">{{ __('Select') }} العنوان...
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-1">
                            <a id="after_father4" data-bs-toggle="modal"  data-bs-target="#section5"  href="#" class="btn btn-md btn-light-primary">

                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                     

                      

                    </div>
                    <br><br><br>
                   <hr>
                    <div class="row mt-8">
                        <div class="col-lg-12 text-center">
                            <button class="btn btn-primary btn-primary--icon" id="sub">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>اضافة قسم جديد</span>
                                </span>
                            </button>&nbsp;&nbsp;




                        </div>
                </form>
                <!--begin: Datatable-->
                <!--begin: Datatable-->

                <!--end: Datatable-->
            </div>
        </div>


        <!--begin::Card-->
        <div class="card">


         


         @include('pages.childrensubscriptions.parts.modals')

            
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                @include('pages.childrensubscriptions.parts._table')
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</x-base-layout>
