<!--begin::Action--->
@php
    $x = App\Models\YearSubscriptions::where('subsraction_id' , $model->subscription_id)->where('static_fee' , 0)->exists();

@endphp


<td class="text-end">
    @can('kindergarten.edit')
        <a href="{{ route('children-subscriptions.edit', $model) }}"
           title="تعديل"
           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mb-1">
            {!! theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-3") !!}
        </a>
    @endcan
    @can('kindergarten.delete')
     @if ($x) 
    <a data-id="{{$model->id}}"
        title="حذف"
        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm del_rec_btn mb-1">
         {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-3") !!}
     </a>
    @endif
        
    @endcan
</td>
<!--end::Action--->
