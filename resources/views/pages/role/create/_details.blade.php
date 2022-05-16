<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
         data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Create a group') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="details_form" class="form" method="POST" action="{{ route('role.store') }}"
              enctype="multipart/form-data">
        @csrf
        @method('POST')
        <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Group name') }}</label>
                    <div class="col-lg-8">
                        <input type="text" name="name"
                               class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                               placeholder="{{ __('Group name') }}" value="{{ old('name', $info->name ?? '') }}"/>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                    @include('partials.general._button-indicator', ['label' => __('Save')])
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript">$(".flatpickr-input").flatpickr();</script>
    <script>
        document.addEventListener('DOMContentLoaded', function (e) {
            FormValidation.formValidation(
                document.getElementById('details_form'), {
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: 'اسم المجموعة  مطلوب',
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9_-]+$/,
                                    message: 'يمكن أن يتكون اسم المجموعة فقط من حروف انجليزية ورقم وشرطة',
                                },
                                stringLength: {
                                    min: 3,
                                    message: 'يجب أن اسم المجموعة من 3 أحرف على الأقل',
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
