
<td class="text-end">
    <a href="{{ route('classplacement.create', $model)}}"
       title="تسكين صفي"
       class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        {!! theme()->getSvgIcon("icons/duotune/general/gen019.svg", "svg-icon-3") !!}
    </a>
    @can('childrens.edit')
    <a href="{{ route('childrens.edit', $model) }}"
       title="تعديل"
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
</td>

<script>
    function popupWindow(url, windowName, win, w, h) {
        const y = win.top.outerHeight / 2 + win.top.screenY - (h / 2);
        const x = win.top.outerWidth / 2 + win.top.screenX - (w / 2);
        return win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
    }

</script>
<!--end::Action--->
