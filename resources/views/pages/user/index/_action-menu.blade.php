<!--begin::Action--->
<td class="text-end">
    @can('users.edit')
        <a href="{{ route('user.edit', $model) }}"
           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
            {!! theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-3") !!}
        </a>
    @endcan
    @can('users.delete')
        <a data-id="{{$model->id}}"
           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm del_rec_btn">
            {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-3") !!}
        </a>
    @endcan
</td>
<!--end::Action--->
