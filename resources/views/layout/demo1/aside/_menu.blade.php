{{--begin::Aside Menu--}}
@php
    $menu = bootstrap()->getAsideMenu();
    \App\Core\Adapters\Menu::filterMenuPermissions($menu->items);
@endphp

<div
    class="hover-scroll-overlay-y my-5 my-lg-5"
    id="kt_aside_menu_wrapper"
    data-kt-scroll="true"
    data-kt-scroll-activate="{default: false, lg: true}"
    data-kt-scroll-height="auto"
    data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
    data-kt-scroll-wrappers="#kt_aside_menu"
    data-kt-scroll-offset="0"
>
    {{--begin::Menu--}}
    <div
        class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
        id="#kt_aside_menu" data-kt-menu="true">
        {!! $menu->build() !!}
{{--        <div style="width: 100%; padding: 20px 50px;">--}}
{{--            <a href="{{route('role.assign')}}" style="color: white;">Assign</a>--}}
{{--        </div>--}}
{{--        <div style="width: 100%; padding: 0 50px;">--}}
{{--            <a href="{{route('role.revoke')}}" style="color: white;">Revoke</a>--}}
{{--        </div>--}}
    </div>
    {{--end::Menu--}}

</div>
{{--end::Aside Menu--}}
