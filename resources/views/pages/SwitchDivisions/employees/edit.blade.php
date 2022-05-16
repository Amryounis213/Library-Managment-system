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
                    <h6 class="fw-bolder m-0">{{ __('Edit a patient file') }}</h6>
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <h3 class="fw-bolder m-0">{{$patient->name}}</h3>

                </div>

                <!--end::Card title-->
            </div>
            <!--begin::Card header-->

            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form id="details_form" class="form" method="POST" action="{{ route('patient.update', $patient) }}"
                      enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Card body-->
                    <input type="hidden" name="id" value="{{$patient->id}}">
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label
                                class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('identity no.') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="identity"
                                       class="form-control form-control-lg form-control-solid"
                                       placeholder="{{ __('identity no.') }}" readonly
                                       value="{{ old('company', $patient->identity ?? '') }}"/>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Full Name') }}</label>
                            <div class="col-lg-8">
                                <input type="text" name="name"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                       placeholder="{{ __('Full Name') }}"
                                       value="{{ old('website', $patient->name ?? '') }}"/>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('mobile no.') }}</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="mobile" class="form-control form-control-lg form-control-solid"
                                       placeholder="{{ __('mobile no.') }}"
                                       value="{{ old('phone', $patient->mobile ?? '') }}"/>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('dob') }}</label>
                            <!--begin::Input-->
                            <div class="col-lg-8 fv-row">
                                <div class="position-relative d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                {!! theme()->getSvgIcon("icons/duotune/general/gen014.svg", "svg-icon svg-icon-2 position-absolute mx-4") !!}
                                <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Datepicker-->
                                    <input class="form-control form-control-solid ps-12 flatpickr-input"
                                           placeholder="{{ __('Select a date')}}" name="dob" type="text"
                                           readonly="readonly"
                                           value="{{ old('phone', $patient->dob ?? '') }}">
                                    <!--end::Datepicker-->
                                </div>
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('State') }}</label>
                            <div class="col-lg-8 fv-row">
                                <select name="states_id" aria-label="{{ __('Select a State') }}" data-control="select2"
                                        data-placeholder="{{ __('Select a State') }}.."
                                        class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Select a State') }}...</option>
                                    @foreach($states as $item)
                                        <option
                                            value=" {{$item->id}}" {{ $item->id === old('states_id', $patient->states_id ?? '') ? 'selected' :'' }}>
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label
                                class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('City') }}</label>
                            <div class="col-lg-8 fv-row">
                                <select name="cities_id" aria-label="{{ __('Select a City') }}"
                                        data-control="select2"
                                        data-placeholder="{{ __('Select a City') }}.."
                                        class="form-select form-select-solid form-select-lg cities_id">
                                    <option value="">{{ __('Select a City') }}...</option>
                                    @foreach($cities as $item)
                                        <option
                                            value=" {{$item->id}}" {{ $item->id === old('cities_id', $patient->cities_id ?? '') ? 'selected' :'' }}>
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Address') }}</label>
                            <div class="col-lg-8">
                                <input type="text" name="address"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                       placeholder="{{ __('Address') }}"
                                       value="{{ old('website', $patient->address ?? '') }}"/>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Gender') }}</label>
                            <div class="col-lg-8 fv-row">
                                <!--begin::Options-->
                                <div class="d-flex align-items-center mt-3">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid me-5">
                                        <input class="form-check-input" name="gender" type="radio"
                                               value="1" {{ old('gender', $patient->gender ?? '') == 1 ? 'checked' : '' }}/>
                                        <span class="fw-bold ps-2 fs-6">
                                    {{ __('Male') }}
                                </span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <input class="form-check-input" name="gender" type="radio"
                                               value="2" {{ old('gender', $patient->gender ?? '')  == 2? 'checked' : '' }}/>
                                        <span class="fw-bold ps-2 fs-6">
                                    {{ __('Female') }}
                                </span>
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Options-->
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-0">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Status') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input type="hidden" name="status" value="0">
                                    <input class="form-check-input w-45px h-30px" type="checkbox" id="status"
                                           name="status"
                                           value="1" {{ old('status', $patient->status ?? '') == 1 ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="status"></label>
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->

                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset"
                                class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button>
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            @include('partials.general._button-indicator', ['label' => __('Save Changes')])
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
            document.addEventListener('DOMContentLoaded', function (e) {
                FormValidation.formValidation(
                    document.getElementById('details_form'), {
                        fields: {
                            name: {
                                validators: {
                                    notEmpty: {
                                        message: 'الاسم مطلوب',
                                    },
                                },
                            },
                            identity: {
                                validators: {
                                    notEmpty: {
                                        message: 'رقم الهوية مطلوب',
                                    },
                                    stringLength: {
                                        min: 9,
                                        max: 9,
                                        message: 'رقم الهوية يتكون من 9 خانات',
                                    },
                                    regexp: {
                                        regexp: /^[0-9]+$/,
                                        message: 'رقم الهوية فقط أرقام',
                                    },
                                },
                            },
                            mobile: {
                                validators: {
                                    notEmpty: {
                                        message: 'رقم الجوال مطلوب',
                                    },
                                    stringLength: {
                                        min: 10,
                                        max: 10,
                                        message: 'رقم الجوال يتكون من 10 خانات',
                                    },
                                    regexp: {
                                        regexp: /^[0-9]+$/,
                                        message: 'رقم الجوال فقط أرقام',
                                    },
                                },
                            },
                            dob: {
                                validators: {
                                    notEmpty: {
                                        message: 'تاريخ الميلاد مطلوب',
                                    },
                                },
                            },
                            states_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'المحافظة مطلوب',
                                    },
                                },
                            },
                            cities_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'المدينة مطلوب',
                                    },
                                },
                            },
                            gender: {
                                validators: {
                                    notEmpty: {
                                        message: 'الجنس مطلوب',
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
