<!--begin::Filter-->
<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end">
    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
    <span class="svg-icon svg-icon-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             viewBox="0 0 24 24" fill="none">
            <path
                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                fill="black"></path>
        </svg>
    </span>
    <!--end::Svg Icon-->Filter
</button>
<!--begin::Menu 1-->
<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
     id="kt-toolbar-filter">
    <!--begin::Header-->
    <div class="px-7 py-5">
        <div class="fs-4 text-dark fw-bolder">Filter Options</div>
    </div>
    <!--end::Header-->
    <!--begin::Separator-->
    <div class="separator border-gray-200"></div>
    <!--end::Separator-->
    <!--begin::Content-->
    <div class="px-7 py-5">
        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label fs-5 fw-bold mb-3">Month:</label>
            <!--end::Label-->
            <!--begin::Input-->
            <select class="form-select form-select-solid fw-bolder select2-hidden-accessible"
                    data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true"
                    data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter"
                    data-select2-id="select2-data-10-k36g" tabindex="-1" aria-hidden="true">
                <option data-select2-id="select2-data-12-ejxp"></option>
                <option value="aug">August</option>
                <option value="sep">September</option>
                <option value="oct">October</option>
                <option value="nov">November</option>
                <option value="dec">December</option>
            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr"
                           data-select2-id="select2-data-11-aj9f" style="width: 100%;"><span
                    class="selection"><span
                        class="select2-selection select2-selection--single form-select form-select-solid fw-bolder"
                        role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                        aria-disabled="false" aria-labelledby="select2-tcxs-container"
                        aria-controls="select2-tcxs-container"><span
                            class="select2-selection__rendered" id="select2-tcxs-container"
                            role="textbox" aria-readonly="true" title="Select option"><span
                                class="select2-selection__placeholder">Select option</span></span><span
                            class="select2-selection__arrow" role="presentation"><b
                                role="presentation"></b></span></span></span><span
                    class="dropdown-wrapper" aria-hidden="true"></span></span>
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label fs-5 fw-bold mb-3">Payment Type:</label>
            <!--end::Label-->
            <!--begin::Options-->
            <div class="d-flex flex-column flex-wrap fw-bold"
                 data-kt-customer-table-filter="payment_type">
                <!--begin::Option-->
                <label
                    class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                    <input class="form-check-input" type="radio" name="payment_type" value="all"
                           checked="checked">
                    <span class="form-check-label text-gray-600">All</span>
                </label>
                <!--end::Option-->
                <!--begin::Option-->
                <label
                    class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                    <input class="form-check-input" type="radio" name="payment_type" value="visa">
                    <span class="form-check-label text-gray-600">Visa</span>
                </label>
                <!--end::Option-->
                <!--begin::Option-->
                <label class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                    <input class="form-check-input" type="radio" name="payment_type"
                           value="mastercard">
                    <span class="form-check-label text-gray-600">Mastercard</span>
                </label>
                <!--end::Option-->
                <!--begin::Option-->
                <label class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="payment_type"
                           value="american_express">
                    <span class="form-check-label text-gray-600">American Express</span>
                </label>
                <!--end::Option-->
            </div>
            <!--end::Options-->
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="d-flex justify-content-end">
            <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                    data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset
            </button>
            <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true"
                    data-kt-customer-table-filter="filter">Apply
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Content-->
</div>
<!--end::Menu 1-->
<!--end::Filter-->
