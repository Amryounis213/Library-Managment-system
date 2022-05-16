<!--begin::Modal - note - Add-->
<div class="modal fade" id="kt_modal_update_price" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                  id="kt_modal_update_price_form">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_price_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">تعديل السعر الفعلي</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_update_price_close" onclick="closeModal()"
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
                        <label class="col-lg-2 col-form-label required fw-bold fs-6">السعر</label>
                        <div class="col-lg-10 fv-row">
                            <input type="text" name="net_price" id="net_price" placeholder="السعر الفعلي"
                                   class="form-control form-control-lg form-control-solid mobile"
                                   value=""/>
                            </textarea>
                            <div class="fv-plugins-message-container invalid-feedback price-error"
                                 style="display: none">السعر مطلوب
                            </div>
                        </div>
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_update_price_cancel" class="btn btn-light me-3" onclick="closeModal()"
                            onclick="">إلفــاء
                    </button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button id="kt_modal_update_price_submit" class="btn btn-primary">
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
