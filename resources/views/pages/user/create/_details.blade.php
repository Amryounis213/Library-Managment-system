<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Create a user') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="details_form" class="form" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Avatar') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Image input-->
                        <div
                            class="image-input image-input-outline image-input-empty
                            }
                            }"
                            data-kt-image-input="true"
                            style="background-image: url({{ asset(theme()->getMediaUrlPath() . 'avatars/blank.png') }})">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px"
                                 style="background-image: none;"></div>
                            <!--end::Preview existing avatar-->

                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>

                                <!--begin::Inputs-->
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                <input type="hidden" name="avatar_remove"/>
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->

                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->

                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                  data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->

                        <!--begin::Hint-->
                        <div class="form-text">{{ __('Allowed file types') }}: png, jpg, jpeg.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Full Name') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <input type="text" name="first_name"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                       placeholder="{{ __('First Name') }}"
                                       value="{{ old('first_name') }}"/>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <input type="text" name="last_name"
                                       class="form-control form-control-lg form-control-solid"
                                       placeholder="{{ __('Last Name') }}"
                                       value="{{ old('last_name') }}"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Email') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="email" class="form-control form-control-lg form-control-solid"
                               placeholder="{{ __('Email') }}" value="{{ old('email') }}"/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">مواعيد العمل</label>
                    <!--begin::Input-->
                    <div class="col-lg-4 fv-row">
                        <div class="position-relative d-flex align-items-center">
                            {!! theme()->getSvgIcon("icons/duotune/general/gen014.svg", "svg-icon svg-icon-2 position-absolute mx-4") !!}
                            <input class="form-control form-control-solid ps-12 flatpickr-input"
                                   placeholder="وقت الحضور" name="attendance_time" type="text"
                                   value="{{ old('attendance_time') }}"  readonly="readonly">
                        </div>
                    </div>
                    <!--end::Input-->
                    <!--begin::Input-->
                    <div class="col-lg-4 fv-row">
                        <div class="position-relative d-flex align-items-center">
                            {!! theme()->getSvgIcon("icons/duotune/general/gen014.svg", "svg-icon svg-icon-2 position-absolute mx-4") !!}
                            <input class="form-control form-control-solid ps-12 flatpickr-input1"
                                   placeholder="وقت الانصراف" name="checkout_time" type="text"
                                   value="{{ old('checkout_time') }}"  readonly="readonly">
                        </div>
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Input-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">{{ __('roles') }}</span>
                    </label>
                    <div class="col-lg-8 fv-row">
                        <select name="role_id" aria-label="{{ __('Select a role') }}" data-control="select2" data-placeholder="{{ __('Select a role') }}.." class="form-select form-select-solid form-select-lg fw-bold">
                            <option value="">{{ __('Select a role') }}...</option>
                            @foreach($roles as $item)
                            <option value="{{$item->id}}" {{ $item->id == old('role_id') ? 'selected' :'' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6" data-kt-password-meter="true">
                    <!--begin::Wrapper-->

                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">
                        {{ __('Password') }}
                    </label>
                    <!--end::Label-->
                    <div class="col-lg-8 fv-row">
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="new-password"/>

                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <!--end::Input wrapper-->

                        <!--begin::Meter-->
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <!--end::Meter-->

                        <!--begin::Hint-->
                        <div class="text-muted">
                            {{ __('Use 8 or more characters with a mix of letters, numbers & symbols.') }}
                        </div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Input group--->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Confirm Password') }}</label>
                    <div class="col-lg-8 fv-row">
                        <input class="form-control form-control-lg form-control-solid" type="password" name="password_confirmation" autocomplete="off"/>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-0">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Status') }}</label>
                    <!--begin::Label-->

                    <!--begin::Label-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <div class="form-check form-check-solid form-switch fv-row">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input w-45px h-30px" type="checkbox" id="status"
                                   name="status" value="1" {{ old('status') == 1 ? 'checked' : '' }}/>
                            <label class="form-check-label" for="status"></label>
                        </div>
                    </div>
                    <!--begin::Label-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button>
                <button type="submit" class="btn btn-primary" id="kt_sign_up_submit">
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
<script src="{{asset('demo1/js/custom/user/password-meter.js')}}"></script>
<script src="{{asset('demo1/js/custom/user/form-validation.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
$(".flatpickr-input").flatpickr({
    enableTime: true,
    noCalendar: true,
    defaultDate: "14:00",
    
});
$(".flatpickr-input1").flatpickr({
    enableTime: true,
    noCalendar: true,
    defaultDate: "19:00",
    
});
</script>

@endsection
