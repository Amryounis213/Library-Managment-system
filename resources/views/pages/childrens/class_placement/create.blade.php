<x-base-layout>

    @include('.layout.error')
    @php
        if ($emp) {
            $children = App\Models\Children::with('ClassPlacement')
                ->where('id', $emp->id)
                ->first();
        } else {
            $children = null;
        }
    @endphp
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
                        <h3 class="fw-bolder m-0">تسكين صفي جديد</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9 item">
                        <form id="details_form" class="form" method="POST"
                            action="{{ route('classplacement.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <!--begin::Input group-->
                            <div class="card-body border-top p-9">

                                @if (Auth::user()->kindergarten_id == null)
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">الروضة</label>
                                        <div class="col-lg-8 fv-row">
                                            <select id="kindergarten_id" name="kindergarten_id"
                                                aria-label="اختر الروضة ." {{-- data-control="select2" --}}
                                                data-placeholder="اختر الروضة..."
                                                class="form-select form-select-solid form-select-lg period_id">
                                                <option value="">اختر الروضة....</option>
                                                @foreach ($kinder as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id ==($children->ClassPlacement ?? null ? $children->ClassPlacement->kindergarten_id : old('kindergarten_id'))? 'selected': '' }}
                                                        }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">الروضة</label>
                                        <div class="col-lg-8 fv-row">
                                            <select id="kindergarten_id" name="kindergarten_id"
                                                aria-label="اختر الروضة ." {{-- data-control="select2" --}}
                                                data-placeholder="اختر الروضة..."
                                                class="form-select form-select-solid form-select-lg period_id"
                                                {{ Auth::user()->kindergarten_id != null ? 'disabled' : '' }}
                                                >
                                                <option value="">اختر الروضة....</option>
                                                @foreach ($kinder as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == Auth::user()->kindergarten_id ? 'selected' : '' }}>
                                                        {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6"> اسم الطالب</label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="children_id" aria-label="اختر اسم الطالب" data-control="select2"
                                            data-placeholder="اختر اسم الطالب.."
                                            class="form-select form-select-solid form-select-lg employee_id">
                                            <option value="">اختر اسم الطالب...</option>
                                            @foreach ($childrens as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == ($emp->id ?? old('children_id')) ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6"> العام الدراسي</label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="year" aria-label="اختر العام الدراسي" data-control="select2"
                                            data-placeholder="اختر العام الدراسي.."
                                            class="form-select form-select-solid form-select-lg employee_id">
                                            <option value="">اختر العام الدراسي...</option>
                                            @foreach ($years as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == ($children->ClassPlacement ?? null ? $children->ClassPlacement->year : old('year'))? 'selected': '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6"> اسم المربية</label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="employee_id" id="employee_id" aria-label="اختر اسم المربية"
                                            data-control="select2" data-placeholder="اختر اسم المربية.."
                                            class="form-select form-select-solid form-select-lg employee_id">
                                            <option value="">اختر اسم المربية...</option>
                                            @foreach ($employees as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id ==($children->ClassPlacement ?? null ? $children->ClassPlacement->employee_id : old('employee_id'))? 'selected': '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->



                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">الفترة </label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="period_id" aria-label="اختر فترة الدوام" data-control="select2"
                                            data-placeholder="اختر فترة الدوام.."
                                            class="form-select form-select-solid form-select-lg job_id">
                                            <option value="">اختر فترة الدوام...</option>
                                            @foreach ($periods as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == ($children->ClassPlacement ?? null ? $children->ClassPlacement->period_id : old('period_id'))? 'selected': '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">المرحلة</label>
                                    <div class="col-lg-8 fv-row">
                                        <select id="level" name="level_id" aria-label="اختر المرحلة الدراسي."
                                            {{-- data-control="select2" --}} data-placeholder="اختر المرحلة الدراسي..."
                                            class="form-select form-select-solid form-select-lg period_id">
                                            <option value="">اختر المرحلة الدراسي....</option>
                                            @foreach ($levels as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == ($children->ClassPlacement ?? null ? $children->ClassPlacement->level_id : old('level_id'))? 'selected': '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">الشعبة</label>
                                    <div class="col-lg-8 fv-row">
                                        <select id="division" name="division_id" aria-label="اختر الشعبة الدراسية."
                                            data-control="select2" data-placeholder="اختر الشعبة الدراسية"
                                            class="form-select form-select-solid form-select-lg period_id">
                                            <option value="">اختر الشعبة الدراسية ...</option>
                                            @foreach ($divisions as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id ==($children->ClassPlacement ?? null ? $children->ClassPlacement->division_id : old('division_id'))? 'selected': '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>










                                <!--begin::Actions-->
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="reset" id="btn-dscrd"
                                        class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button>
                                    <button type="submit" class="btn btn-primary"
                                        id="kt_account_profile_details_submit">
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
    @section('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
            integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


        <style>
            label {
                text-align: left;
            }

            .select2-selection__placeholder {
                color: #A1A5B7;
            }

        </style>
    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function(e) {
                FormValidation.formValidation(
                    document.getElementById('details_form'), {
                        fields: {
                            children_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'الاسم مطلوب',
                                    },
                                },
                            },


                            employee_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'المعلمة مطلوبة',
                                    },
                                },
                            },
                            year: {
                                validators: {
                                    notEmpty: {
                                        message: 'العام الدراسي مطلوب',
                                    },
                                },
                            },
                            kindergarten_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'الروضة مطلوبة',
                                    },
                                },
                            },
                            period_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'الفترة مطلوبة ',
                                    },
                                },
                            },
                            level_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'المرحلة مطلوب',
                                    },
                                },
                            },
                            division_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'الشعبة مطلوبة',
                                    },
                                },
                            },
                            kindergarten_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'الروضة مطلوبة',
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
        <script>
            $(document).ready(function() {

                //  alert($('#employee_id').val());

                $('#level').change(function() {

                    // let e = document.getElementById("doctor_id");
                    let id = $(this).val();
                    let kinder = $('#kindergarten_id').val();

                    $.ajax({
                        url: "/GetDivisionByLevel/" + id + '/' + kinder,
                        method: 'GET',
                        data: {


                        },
                        dataType: "JSON",
                        success: function(data) {


                            if (data != null) {
                                $('#division').empty();

                                data.forEach(element => {
                                    $('#division').append(
                                        `<option value="${element['id']}">${element['name']}</option>`
                                    );
                                });





                            }
                        }
                    });





                });



                $('#kindergarten_id').change(function() {


                    let id = $(this).val();

                    $.ajax({
                        url: "/GetDivisionByKindergarten/" + id,
                        method: 'GET',
                        data: {


                        },
                        dataType: "JSON",
                        success: function(data) {


                            if (data != null) {

                                $('#level').empty();
                                $('#level').append(
                                    `<option value="1">تمهيدي</option>
                                    <option value="2">بستان</option>
                                    <option value="3">حضانة</option>
                                    `
                                );


                                $('#division').empty();
                                data.forEach(element => {
                                    $('#division').append(
                                        `<option value="${element['id']}">${element['name']}</option>`
                                    );
                                });






                            }
                        }
                    });






                    $.ajax({
                        url: "/GetEmployeeByKindergarten/" + id,
                        method: 'GET',
                        data: {


                        },
                        dataType: "JSON",
                        success: function(data) {

                            console.log(data);
                            if (data != null) {



                                $('#employee_id').empty();
                                data.forEach(element => {
                                    $('#employee_id').append(
                                        `<option value="${element['id']}">${element['name']}</option>`
                                    );
                                });






                            }
                        }
                    });





                });



            });
        </script>
    @endsection


</x-base-layout>
