<!--begin::Modal - Update role-->
<div class="modal fade" id="kt_modal_update_role_{{$model->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{__('Update Roles')}}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action_{{$model->id}}="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                            </svg>
                        </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_update_role_form_{{$model->id}}" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll_{{$model->id}}" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header_{{$model->id}}" data-kt-scroll-wrappers="#kt_modal_update_role_scroll_{{$model->id}}" data-kt-scroll-offset="300px"
{{--                         style="max-height: 102px;"--}}
                    >
                        <!--begin::Input group-->
                        <div class="fv-row mb-10 fv-plugins-icon-container">
                            <!--begin::Label-->
                            {{--                                <label class="col-lg-4 fs-5 fw-bolder form-label mb-2">--}}
                            <div class="row mb-6">
                                <label class="col-lg-2 fs-5 fw-bolder col-form-label mb-2">
                                    <span>{{__('Group name')}}</span>
                                </label>
                                {{$model->id}}
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="col-lg-10">
                                    <input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name" value="Developer" readonly>
                                </div>
                            </div>
                            <!--end::Input-->
                            <!--end::Input group-->
                            <!--begin::Permissions-->
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bolder form-label mb-2">{{__('Role Permissions')}}</label>
                                <!--end::Label-->
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-bold">
                                        <!--begin::Table row-->
                                        <tr>
                                            <td class="text-gray-800">{{__('Administrator Access')}}
                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="{{__('Allows a full access to the system')}}" aria-label="__('Allows a full access to the system')}}"></i></td>
                                            <td>
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                    <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all_{{$model->id}}">
                                                    <span class="form-check-label" for="kt_roles_select_all">{{__('Select all')}}</span>
                                                </label>
                                                <!--end::Checkbox-->
                                            </td>
                                        </tr>
                                        <!--end::Table row-->

                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Label-->
                                            <td class="text-gray-800">User Management</td>
                                            <!--end::Label-->

                                            <!--begin::Input group-->
                                            <td>
                                                <!--begin::Wrapper-->
                                                <div class="d-flex">
                                                @foreach($model->permissions as $item)
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input" type="checkbox" value="" name="user_management_read">
                                                        <span class="form-check-label">{{$item->name}}</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                @endforeach
                                                </div>
                                                <!--end::Wrapper-->
                                            </td>
                                            <!--end::Input group-->

                                        </tr>
                                        <!--end::Table row-->

                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Permissions-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action_{{$model->id}}="cancel">
                                {{__('Discard')}}</button>
                            <button type="submit" class="btn btn-primary" data-kt-roles-modal-action_{{$model->id}}="submit">
                                <span class="indicator-label">{{__('Save Changes')}}</span>
                                <span class="indicator-progress">{{__('Please wait')}}...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                        </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Update role-->
{{-- Inject Scripts --}}
@section('scripts')
{{--<script>--}}
{{--    $('#kt_modal_update_role').on('show', function(e) {--}}
{{--        let link = e.relatedTarget(),--}}
{{--            modal = $(this),--}}
{{--            id = link.data("id");--}}
{{--        // modal.find("#username").val(username);--}}
{{--    });--}}
{{--</script>--}}
@endsection
