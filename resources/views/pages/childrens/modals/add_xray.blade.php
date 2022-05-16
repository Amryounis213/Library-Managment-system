<!--begin::Modal - Checkup - Add-->
<div class="modal fade" id="kt_modal_add_xray" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                  id="kt_modal_add_xray_form">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_xray_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">اضافة أشعة</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_xray_close" onclick="closeModal()"
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
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label required fw-bold fs-6">الأشعة</label>
                        <div class="col-lg-10 fv-row">
                            <select name="xray_id"
                                    id="xray_id"
                                    data-control="select2"
                                    data-dropdown-parent="#kt_modal_add_xray"
                                    class="form-select form-select-solid form-select-lg">
                                <option value="">{{ __('Select') }} {{ __('xray') }}...</option>
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback  xray-error-xray_id"
                                 style="display: none">الأشعة مطلوب
                            </div>
                        </div>
                    </div>
                    <!--end::Input-->
                    <!--begin::Input-->
                    <div class="row">
                        <label class="col-lg-2 col-form-label required fw-bold fs-6">التعليمات</label>
                        <div class="col-lg-10 fv-row">
                            <textarea name="instructions"
                                      id="xr_instructions"
                                      rows="2"
                                      placeholder="التعليمات"
                                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                      value="{{ old('instructions') }}"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback xray-error-instructions"
                                 style="display: none">التعليمات مطلوب
                            </div>
                        </div>
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_xray_cancel" class="btn btn-light me-3"
                            onclick="closeModal()">إلفــاء
                    </button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_xray_submit" class="btn btn-primary">
                        <span class="indicator-label">حفظ</span>
                        <span class="indicator-progress">يرجى الانتظار...
                        <span
                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->

            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Checkup - Add-->
