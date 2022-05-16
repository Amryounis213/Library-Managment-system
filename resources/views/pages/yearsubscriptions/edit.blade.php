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
                    <h6 class="fw-bolder m-0">  تعديل اشتراك سنوي</h6>
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <h3 class="fw-bolder m-0">{{$sub->name}}</h3>

                </div>

                <!--end::Card title-->
            </div>
            <!--begin::Card header-->

             <!--begin::Content-->
             <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form id="details_form" class="form" method="POST" action="{{ route('year-sub.update' , $sub->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">


                        <div class="row mb-2">
                            <label
                                class="col-lg-2 col-form-label required fw-bold fs-6">نوع الاشتراك</label>
                            <div class="col-lg-4">
                                <select name="subsraction_id"
                                        aria-label="{{ __('Select') }} الاشتراك"
                                        id="subsraction_id"
                                        data-control="select2"
                                        data-placeholder="{{ __('Select') }} الاشتراك .."
                                        class="form-select form-select-solid form-select-lg fw-bold"
                                >
                                    <option value="">{{ __('Select') }} الاشتراك...
                                    </option>
                                    @foreach($subs as $item)
                                        <option
                                            value="{{$item->id}}" {{ $item->id == $sub->subsraction_id   ? 'selected' :'' }}> {{$item->name}}  </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-lg-2 col-form-label required  fw-bold fs-6">  رسم الاشتراك المراد تعديله  (شيكل)</label>
                            <div class="col-lg-4">
                                <input type="text" name="price"
                                       class="form-control form-control-lg form-control-solid mobile"
                                       placeholder="مثال : 100" value="{{$sub->price}}">
                                <div
                                    class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <!--begin::Col-->
                            <div class="col-lg-12">
                                <!--begin::Row-->
                                <div class="row">
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">السنة الدراسية</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="year"
                                            class="form-control form-control-lg form-control-solid mobile"
                                            placeholder="السنة الدراسية" value="{{$sub->year}}" />
                                    </div>
                                   


                                    <label
                                    class="col-lg-2 col-form-label required  fw-bold fs-6">رسوم ثابثة</label>
                                <div class="col-lg-4 d-flex align-items-center">
                                    <div
                                        class="form-check form-check-solid form-switch fv-row">
                                        <input type="hidden" name="static_fee" value="0">
                                        <input class="form-check-input w-45px h-30px"
                                               type="checkbox" id="static_fee" name="static_fee"
                                               {{ $sub->static_fee ? 'checked' : '' }}
                                               value="1">
                                        <label class="form-check-label"
                                               for="static_fee"></label>
                                    </div>
                                </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                       
                    </div>
                    <!--end::Card body-->

                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset"
                            class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button>
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            @include('partials.general._button-indicator', [
                                'label' => __('Save'),
                            ])
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Basic info-->
    </div>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endsection
    @section('scripts')

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script type="text/javascript">$(".flatpickr-input").flatpickr();</script>
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
