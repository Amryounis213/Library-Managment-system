



@can('childrens.edit')
<a href="{{ route('children.restore', $model) }}"
   title="استرجاع الطالب"
   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
    {!! theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-3") !!}
</a>
@endcan

@can('childrens.delete')
<a data-id="{{$model->id}}"
   title="حذف"
   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm del_rec_btn">
    {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-3") !!}
</a>
@endcan