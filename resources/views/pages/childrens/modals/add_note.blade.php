<!--begin::Modal - note - Add-->
<div class="modal fade" id="kt_modal_add_note" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                  id="kt_modal_add_note_form">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_note_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">اضافة ملاحظة</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_note_close" onclick="closeModal()"
                         class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr061.svg", "svg-icon svg-icon-1") !!}
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <input type="hidden" id="order_id" value="">
                    <input type="hidden" id="type" value="">
                    <!--begin::Input-->
                    <div class="row">
                        <label class="col-lg-2 col-form-label required fw-bold fs-6">ملاحظة</label>
                        <div class="col-lg-10 fv-row">
                            <textarea name="note"
                                      id="note"
                                      rows="3"
                                      placeholder="ملاحظة"
                                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                            </textarea>
                            <div class="fv-plugins-message-container invalid-feedback note-error"
                                 style="display: none">الملاحظة مطلوب
                            </div>
                        </div>
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_note_cancel" class="btn btn-light me-3" onclick="closeModal()"
                            onclick="">إلفــاء
                    </button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button id="kt_modal_add_note_submit" class="btn btn-primary">
                        <span class="indicator-label">حفظ</span>
                        <span class="indicator-progress">يرجى الانتظار...
                        <span
                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
                @csrf
                @method('POST')
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - note - Add-->
