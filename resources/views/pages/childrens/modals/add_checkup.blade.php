<!--begin::Modal - Checkup - Add-->
<div class="modal fade" id="kt_modal_add_checkup" tabindex="-1" aria-hidden="true" data-focus="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                  id="kt_modal_add_checkup_form">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_checkup_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">اضافة تحليل مخبري</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_checkup_close" onclick="closeModal()"
                         class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16"
                                      height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)"
                                      fill="black"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                      transform="rotate(45 7.41422 6)"
                                      fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <input type="hidden" id="order_id" value="">
                    <!--begin::Input-->
                    <div class="row">
                        <label class="col-lg-3 col-form-label required fw-bold fs-6">الفحص المخبري</label>
                        <div class="col-lg-9 fv-row">
                            <select name="checkup_id"
                                    id="checkup_id"
                                    data-control="select2"
                                    data-dropdown-parent="#kt_modal_add_checkup"
                                    class="form-select form-select-solid form-select-lg">
                                <option value="">{{ __('Select') }} {{ __('checkup') }}...</option>
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback checkup-error-checkup_id"
                                 style="display: none">التحليل المخبري مطلوب
                            </div>
                        </div>
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_checkup_cancel" class="btn btn-light me-3"
                            onclick="closeModal()">إلفــاء
                    </button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_checkup_submit" class="btn btn-primary">
                        <span class="indicator-label">حفظ</span>
                        <span class="indicator-progress">يرجى الانتظار...
                        <span
                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
                <div></div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Checkup - Add-->
