<x-base-layout>
    @include('layout.error')

    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
        <div>
            <!--begin::Patient info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">المربي الأول</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9 item">
                        <form id="details_form" class="form" method="POST" action="{{ route('switch.switchDivision') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <!--begin::Input group-->
                            <div class="row mb-2">
                                <!--begin::Col-->
                                <div class="col-lg-12">
                                    <!--begin::Col-->
                                    <div class="col-lg-12">
                                        <!--begin::Row-->
                                        <div class="row mb-2">
                                            <label class="col-lg-2 col-form-label required fw-bold fs-6">المربي
                                                الأول</label>

                                            <div class="col-lg-4">
                                                <select name="teacher1" aria-label="{{ __('Select') }} المربي "
                                                    data-placeholder="{{ __('Select') }} المربي  .."
                                                    class="form-select form-select-solid form-select-lg fw-bold"
                                                    id="teacher1" {{-- data-control="select2" --}}>
                                                    <option value="">{{ __('Select') }} المربي ...
                                                    </option>
                                                    @foreach ($employees as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == old('clinic_id') ? 'selected' : '' }}>
                                                            {{ $item->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label class="col-lg-2 col-form-label required fw-bold fs-6">الفترة</label>
                                            <div class="col-lg-4">
                                                <select name="period1" aria-label="{{ __('Select') }} الفترة"
                                                    id="period1" data-control="select2"
                                                    data-placeholder="{{ __('Select') }} الفترة .."
                                                    class="form-select form-select-solid form-select-lg fw-bold disabled" >
                                                    <option value="-1">{{ __('Select') }} الفترة...
                                                    </option>
                                                    @foreach ($periods as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == old('period1') ? 'selected' : '' }}>
                                                            {{ $item->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label required fw-bold fs-6">الشعبة</label>
                                            <div class="col-lg-4">
                                                <select name="division1" aria-label="{{ __('Select') }} الشعبة"
                                                    id="division1" data-control="select2"
                                                    data-placeholder="{{ __('Select') }} الشعبة .."
                                                    class="form-select form-select-solid form-select-lg " >
                                                    <option value="">{{ __('Select') }} الشعبة...
                                                    </option>
                                                    @foreach ($employees as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <label class="col-lg-2 col-form-label required fw-bold fs-6">المرحلة</label>
                                            <div class="col-lg-4">
                                                <select name="level1" aria-label="{{ __('Select') }} المرحلة"
                                                    id="level1" data-control="select2"
                                                    data-placeholder="{{ __('Select') }} المرحلة .."
                                                    class="form-select form-select-solid form-select-lg fw-bold"
                                                    >
                                                    <option value="">{{ __('Select') }} المرحلة...
                                                    </option>
                                                    @foreach ($levels as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>
                                        <!--end::Row-->

                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->



                            <!--begin::Order info-->
                            <div class="card mb-5 mb-xl-10">
                                <!--begin::Card header-->
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                                    data-bs-target="#kt_order_profile_details" aria-expanded="true"
                                    aria-controls="kt_order_profile_details">
                                    <!--begin::Card title-->
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0">المربي الثاني</h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--begin::Card header-->
                                <!--begin::Content-->
                                <div id="kt_order_profile_details" class="collapse show">
                                    <!--begin::Card body-->
                                    <div class=" border-top pt-9">
                                        <div class="row mb-2">
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <!--begin::Col-->
                                                <div class="col-lg-12">
                                                    <!--begin::Row-->
                                                    <div class="row mb-2">
                                                        <label
                                                            class="col-lg-2 col-form-label required fw-bold fs-6">المربي
                                                            الأول</label>

                                                        <div class="col-lg-4">
                                                            <select name="teacher2"
                                                                aria-label="{{ __('Select') }} المربي " id="teacher2"
                                                                {{-- data-control="select2" --}}
                                                                data-placeholder="{{ __('Select') }} المربي  .."
                                                                class="form-select form-select-solid form-select-lg fw-bold">
                                                                <option value="">{{ __('Select') }} المربي ...
                                                                </option>
                                                                @foreach ($employees as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == old('clinic_id') ? 'selected' : '' }}>
                                                                        {{ $item->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <label
                                                            class="col-lg-2 col-form-label required fw-bold fs-6">الفترة</label>
                                                        <div class="col-lg-4">
                                                            <select name="period2"
                                                                aria-label="{{ __('Select') }} الفترة" id="period2"
                                                                data-control="select2"
                                                                data-placeholder="{{ __('Select') }} الفترة .."
                                                                class="form-select form-select-solid form-select-lg fw-bold "
                                                                disabled
                                                                >
                                                                <option value="">{{ __('Select') }} الفترة...
                                                                </option>
                                                                @foreach ($periods as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == old('period2') ? 'selected' : '' }}>
                                                                        {{ $item->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end::Row-->
                                                    <!--begin::Row-->
                                                    <div class="row mb-3">
                                                        <label
                                                            class="col-lg-2 col-form-label required fw-bold fs-6">الشعبة</label>
                                                        <div class="col-lg-4">
                                                            <select name="division2"
                                                                aria-label="{{ __('Select') }} الشعبة" id="division2"
                                                                data-control="select2"
                                                                data-placeholder="{{ __('Select') }} الشعبة .."
                                                                class="form-select form-select-solid form-select-lg fw-bold"
                                                                >
                                                                <option value="">{{ __('Select') }} الشعبة...
                                                                </option>
                                                                @foreach ($divisions as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                        <label
                                                            class="col-lg-2 col-form-label required fw-bold fs-6">المرحلة</label>
                                                        <div class="col-lg-4">
                                                            <select name="level2"
                                                                aria-label="{{ __('Select') }} المرحلة" id="level2"
                                                                data-control="select2"
                                                                data-placeholder="{{ __('Select') }} المرحلة .."
                                                                class="form-select form-select-solid form-select-lg fw-bold"
                                                                >
                                                                <option value="">{{ __('Select') }} المرحلة...
                                                                </option>
                                                                @foreach ($levels as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <!--end::Row-->

                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Order info-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" id="btn-dscrd"
                                    class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                    @include(
                                        'partials.general._button-indicator',
                                        ['label' => __('Save')]
                                    )
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Patient info-->
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#teacher1').change(function() {

                    // let e = document.getElementById("doctor_id");
                    let id = this.value;

                    $.ajax({
                        url: "GetEmployeeData/" + id,
                        method: 'GET',
                        data: {
                            // 'doctor_id': id,
                            // 'identity': identity,
                        },
                        dataType: "JSON",
                        success: function(data) {

                            console.log(data);
                            if (data != null) {
                                $('#period1').empty();
                                $('#period1').append(`
                            <option value="${data.period.id}" selected> ${data.period.name} </option>                                     
                            `);


                                $('#division1').empty();
                                $('#division1').append(`
                            <option value="${data.division.id}" selected> ${data.division.name} </option>                                     
                            `);


                                $('#level1').empty();
                                $('#level1').append(`
                            <option value="${data.level.id}" selected> ${data.level.name} </option>                                     
                            `);



                            }
                        }
                    });





                });



                $('#teacher2').change(function() {

                    // let e = document.getElementById("doctor_id");
                    let id = this.value;

                    $.ajax({
                        url: "GetEmployeeData/" + id,
                        method: 'GET',
                        data: {
                            // 'doctor_id': id,
                            // 'identity': identity,
                        },
                        dataType: "JSON",
                        success: function(data) {

                            console.log(data);
                            if (data != null) {
                                $('#period2').empty();
                                $('#period2').append(`
                                    <option value="${data.period.id}" selected > ${data.period.name} </option>                                     
                                `);


                                $('#division2').empty();
                                $('#division2').append(`
                                    <option value="${data.division.id}" selected > ${data.division.name} </option>                                     
                                `);


                                $('#level2').empty();
                                $('#level2').append(`
                                     <option value="${data.level.id}" selected > ${data.level.name} </option>                                     
                                `);



                            }
                        }
                    });





                });
            });
        </script>


        <script>
            ////////////////////////////////////////
            document.addEventListener('DOMContentLoaded', function(e) {
                FormValidation.formValidation(
                    document.getElementById('details_form'), {
                        fields: {
                            teacher1: {
                                validators: {
                                    notEmpty: {
                                        message: 'اسم المربي مطلوب',
                                    },
                                },
                            },
                            teacher2: {
                                validators: {
                                    notEmpty: {
                                        message: 'اسم المربي مطلوب',
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
