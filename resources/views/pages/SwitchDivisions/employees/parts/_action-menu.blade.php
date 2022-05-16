<!--begin::Action--->
<td class="text-end">
   @can('patients.edit')
  
    <!--begin::Options-->
    @if(!$model->attendance()->where('attendence_date',date('Y-m-d'))->first())

        <!--begin::Option-->
        <label class="form-check form-check-inline form-check-solid ">
            <input class="form-check-input" name="attendences{{$model->id}}" type="radio" id="gender-male" value="1">
            <span class="fw-bold ps-2 fs-6 gender">حاضر </span>
        </label>

        <!--end::Option-->
        <!--begin::Option-->
        <label class="form-check form-check-inline form-check-solid">
            <input class="form-check-input" name="attendences{{$model->id}}" type="radio" id="gender-female" value="2">
            <span class="fw-bold ps-2 fs-6">غائب</span>
        </label>
        <!--end::Option-->
    <!--end::Options-->
    @else
     <!--begin::Option-->
     <label class="form-check form-check-inline form-check-solid ">
        <input class="form-check-input" name="attendences{{$model->id}}"
         disabled  
         {{ $model->attendance()->first()->attendence_status == 1 ? 'checked' : '' }}
         type="radio" id="gender-male" value="1">
        <span class="fw-bold ps-2 fs-6 gender">حاضر </span>
    </label>

    <!--end::Option-->
    <!--begin::Option-->
    <label class="form-check form-check-inline form-check-solid">
        <input class="form-check-input" name="attendences{{$model->id}}"
        disabled  
        {{ $model->attendance()->first()->attendence_status == 0 ? 'checked' : '' }}
        type="radio" id="gender-female" value="2">
        <span class="fw-bold ps-2 fs-6">غائب</span>
    </label>
    @endif
    @endcan
   
</td>
<!--end::Action--->
