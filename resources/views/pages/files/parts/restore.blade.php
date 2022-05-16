



@can('employees.edit')
<a href="{{ route('pay-fees.restore', $model) }}"
   title="استرجاع الدفعة"
   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
    {!! theme()->getSvgIcon("icons/duotune/arrows/arr029.svg", "svg-icon-3") !!}
</a>
@endcan

@can('employees.delete')
<a data-id="{{$model->id}}"
   title="حذف"
   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm del_rec_btn">
    {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-3") !!}
</a>
@endcan