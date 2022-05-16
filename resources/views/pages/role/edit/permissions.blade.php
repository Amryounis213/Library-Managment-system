<x-base-layout>
@include('.layout.error')
<!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
             data-bs-target="#kt_account_profile_details" aria-expanded="true"
             aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h6 class="fw-bolder m-0">{{ __('Edit group permissions') }}</h6>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <h3 class="fw-bolder m-0">{{$role->name}}</h3>

            </div>

            <!--end::Card title-->
        </div>
        <!--begin::Card header-->

        <!--begin::Content-->
        <div id="kt_account_profile_details" class="collapse show">
            <!--begin::Form-->
            <form id="details_form" class="form" method="POST" action="{{ route('role.permissions', $role) }}"
                  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!--begin::Card body-->
                <div class="card-body border-top pt-0">
                    <!--begin::Input group-->
                    <div class="fv-row mb-10 fv-plugins-icon-container">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                <!--begin::Table row-->
                                <tr>
                                    <td class="text-gray-800" style="width: 200px;">
                                        <label
                                            class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                            <input class="form-check-input  m-2" type="checkbox" value=""
                                                   id="select_all">
                                            <span class="fw-bolder"
                                                  for="kt_roles_select_all">{{__('Select all')}}</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7"
                                               data-bs-toggle="tooltip" title=""
                                               data-bs-original-title="{{__('Allows a full access to the system')}}"
                                               aria-label="__('Allows a full access to the system')}}"></i>
                                        </label>
                                    </td>
                                </tr>
                                <!--end::Table row-->
                                @foreach($permissionGroup as $row)
                                    <!--begin::Table row-->
                                    <tr>
                                        <td class="text-gray-800 fw-bolder p-3"
                                            style="background-color: #fbfbfb">{{__($row->name)}}</td>
                                    </tr>
                                    <!--end::Table row-->
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Input group-->
                                        <td class="p-7">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex">
                                            @foreach($row->permissions as $item)
                                                <!--begin::Checkbox-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input chbx" type="checkbox"
                                                               id="permissions[]" name="permissions[]"
                                                               {{ $role->hasPermissionTo($item->name)? 'checked' : '' }}
                                                               value="{{ $item->name }}">
                                                        <span
                                                            class="form-check-label">{{__(getPermissionName($item->name))}}</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                @endforeach
                                            </div>
                                            <!--end::Wrapper-->
                                        </td>
                                        <!--end::Input group-->

                                    </tr>
                                    <!--end::Table row-->
                                @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
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
</x-base-layout>

<!--begin::Script-->
<script>
    $(document).ready(function () {
        $('#select_all').prop("checked", true);
        load_checked();
        ////////////////////////////////////////////////
        $(document).on('click', "#select_all", function () {
            $(".chbx").each(function () {
                var ischecked = $("#select_all").is(":checked");
                if (ischecked) {
                    $(this).prop("checked", true);
                } else {
                    $(this).prop("checked", false);
                }
            });
        });
        ////////////////////////////////////////////////
        $(document).on('click', ".chbx", function () {
            load_checked();
        });
        ////////////////////////////////////////////////
        function load_checked() {
            $('#select_all').prop("checked", true);
            $(".chbx").each(function () {
                var ischecked = $(this).is(":checked");
                if (!ischecked) {
                    $('#select_all').prop("checked", false);
                }
            });
        }
    });
</script>
<!--end::Script-->

