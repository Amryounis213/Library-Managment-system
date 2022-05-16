<x-base-layout>
    @include('layout.error')

    @php
        $titles = \App\Models\Titles::where('status', 1)->get();
        $sections = \App\Models\Section::where('status', 1)->get();
        $subsections = \App\Models\SubSection::where('status', 1)->get();
        $subsubsections = \App\Models\SubSubSection::where('status', 1)->get();
        
        //  $sub_sections = \App\Models\SubSection::where('status' , 1)->get();
        
    @endphp
    <!--begin::Container-->
    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">

        <div class="card card-custom mb-3">

            <div class="card-body">
                <!--begin: Search Form-->
                <form class="mb-5" id="details_form">

                    <div class="row mb-6">
                        <div class="col-lg-3">
                            <select name="father_id" aria-label="{{ __('Select') }} العنوان" id="father_id"
                                data-placeholder="{{ __('Select') }} العنوان .."
                                class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select') }} العنوان...
                                </option>

                                @foreach ($titles as $title)
                                    <option value="{{ $title->id }}">
                                        {{ $title->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <select aria-label="{{ __('Select') }}القسم" id="father_id2"
                                data-placeholder="{{ __('Select') }}القسم .."
                                class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select') }}القسم...
                                </option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">
                                        {{ $section->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-lg-3">
                            <select id="father_id3" name="father_id3" aria-label="{{ __('Select') }}  المرحلة  "
                                id="father_id3" data-placeholder="{{ __('Select') }}  المرحلة "
                                class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select') }} المرحلة </option>
                                @foreach ($subsections as $section)
                                    <option value="{{ $section->id }}">
                                        {{ $section->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-lg-3">
                            <select id="father_id4" name="father_id4" aria-label="{{ __('Select') }} العنوان"
                                id="father_id" data-placeholder="{{ __('Select') }} العنوان .."
                                class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Select') }} العنوان...
                                </option>
                                @foreach ($subsubsections as $section)
                                    <option value="{{ $section->id }}">
                                        {{ $section->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    <div class="row mb-6">

                        <div class="col-lg-4 mb-lg-0 mb-6">
                            <label>اسم الملف :</label>
                            <input name="name" id="name" type="text" class="form-control datatable-input" placeholder=""
                                data-col-index="4">
                        </div>
                        <div class="col-lg-4 mb-lg-0 mb-6">
                            <label>رابط الملف :</label>
                            <input name="link"  type="text" class="form-control datatable-input" placeholder=""
                                data-col-index="4">
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label>نوع الملف :</label>
                            <select name="father_id" aria-label="اختر نوع" id="father_id"
                                data-placeholder="اختر نوع .."
                                class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">اختر نوع
                                </option>

                    
                            </select>
                        </div>


                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <button class="btn btn-success btn-success--icon mt-5" id="sub">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>اضافة الملف</span>
                                </span>
                            </button>&nbsp;&nbsp;
                        </div>


                    </div>
                   


                    {{-- <div class="col-lg-12 text-center mb-lg-0 mb-6">
                        <button class="btn btn-success btn-success--icon mt-5" id="sub">
                            <span>
                                <i class="la la-plus"></i>
                                <span>اضافة الملف</span>
                            </span>
                        </button>&nbsp;&nbsp;
                    </div> --}}


            </div>




            </form>
            <!--begin: Datatable-->
            <!--begin: Datatable-->

            <!--end: Datatable-->
        </div>


        <!--begin::Card-->
        <div class="card">


            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->

                <!--begin::Card title-->


            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                @include('pages.childrenpayment.parts._table')
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</x-base-layout>
