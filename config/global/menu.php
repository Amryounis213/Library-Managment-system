<?php

return array(
    // Documentation menu
    'documentation' => array(
        // Getting Started
        array(
            'heading' => 'Getting Started',
        ),

        // Overview
        array(
            'title' => 'Overview',
            'path' => 'documentation/getting-started/overview',
        ),

        // Build
        array(
            'title' => 'Build',
            'path' => 'documentation/getting-started/build',
        ),

        array(
            'title' => 'Multi-demo',
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'classes' => array('item' => 'menu-accordion'),
            'sub' => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title' => 'Overview',
                        'path' => 'documentation/getting-started/multi-demo/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => 'Build',
                        'path' => 'documentation/getting-started/multi-demo/build',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // File Structure
        array(
            'title' => 'File Structure',
            'path' => 'documentation/getting-started/file-structure',
        ),

        // Customization
        array(
            'title' => 'Customization',
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'classes' => array('item' => 'menu-accordion'),
            'sub' => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title' => 'SASS',
                        'path' => 'documentation/getting-started/customization/sass',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => 'Javascript',
                        'path' => 'documentation/getting-started/customization/javascript',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Dark skin
        array(
            'title' => 'Dark Mode Version',
            'path' => 'documentation/getting-started/dark-mode',
        ),

        // RTL
        array(
            'title' => 'RTL Version',
            'path' => 'documentation/getting-started/rtl',
        ),

        // Troubleshoot
        array(
            'title' => 'Troubleshoot',
            'path' => 'documentation/getting-started/troubleshoot',
        ),

        // Changelog
        array(
            'title' => 'Changelog <span class="badge badge-changelog badge-light-danger bg-hover-danger text-hover-white fw-bold fs-9 px-2 ms-2">v' . theme()->getVersion() . '</span>',
            'breadcrumb-title' => 'Changelog',
            'path' => 'documentation/getting-started/changelog',
        ),

        // References
        array(
            'title' => 'References',
            'path' => 'documentation/getting-started/references',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // Configuration
        array(
            'heading' => 'Configuration',
        ),

        // General
        array(
            'title' => 'General',
            'path' => 'documentation/configuration/general',
        ),

        // Menu
        array(
            'title' => 'Menu',
            'path' => 'documentation/configuration/menu',
        ),

        // Page
        array(
            'title' => 'Page',
            'path' => 'documentation/configuration/page',
        ),

        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // General
        array(
            'heading' => 'General',
        ),

        // DataTables
        array(
            'title' => 'DataTables',
            'classes' => array('item' => 'menu-accordion'),
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'sub' => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title' => 'Overview',
                        'path' => 'documentation/general/datatables/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Remove demos
        array(
            'title' => 'Remove Demos',
            'path' => 'documentation/general/remove-demos',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // HTML Theme
        array(
            'heading' => 'HTML Theme',
        ),

        array(
            'title' => 'Components',
            'path' => '//preview.keenthemes.com/metronic8/demo1/documentation/base/utilities.html',
        ),

        array(
            'title' => 'Documentation',
            'path' => '//preview.keenthemes.com/metronic8/demo1/documentation/getting-started.html',
        ),
    ),

    // Main menu
    'main' => array(

        // ????????????????
        array(
            'title' => '????????????????',
            'path' => 'index',
            'icon' => theme()->getSvgIcon("demo1/media/icons/duotune/art/art002.svg", "svg-icon-2"),
        ),

        //// Modules
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'permission' => array('users.show', 'users.create', 'users.edit', 'users.delete',
                'patients.show', 'patients.create', 'patients.edit', 'patients.delete',
                'permissions.show', 'permissions.create', 'permissions.edit', 'permissions.delete',
            ),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">??????????????</span>',
        ),

        // ??????????????
        array(
            'title' => '??????????????',
            'permission' => array('kindergarten.show', 'kindergarten.create', 'kindergarten.edit', 'kindergarten.delete'),
            'icon' => array(
                'svg' => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen055.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes' => array('item' => 'menu-accordion'),
            'badge' => '',
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub' => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title' => '??????',
                        'path' => 'kindergarden',
                        'classes' => array('item' => 'show-menu-bdg'),
                        'permission' => 'kindergarten.show',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                   
                ),
            ),
        ),

        // ??????????????
        array(
            'title' => '??????????????',
            'permission' => array('orders.show', 'orders.create', 'orders.edit', 'orders.delete'),
            'icon' => array(
                'svg' => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen055.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes' => array('item' => 'menu-accordion'),
            'badge' => '',
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'path' => 'levels',
    
        ),

       
        


    

        
        // ??????????????
        array(
            'title' => '??????????????',
            'permission' => array('orders.show', 'orders.create', 'orders.edit', 'orders.delete'),
            'icon' => array(
                'svg' => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen055.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes' => array('item' => 'menu-accordion'),
            'badge' => '',
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub' => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title' => '?????? ?????????????????? ??????????????????',
                        'path' => 'educational-level',
                        'classes' => array('item' => 'show-menu-bdg'),
                        'permission' => 'childrens.show',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => ' ?????? ?????????????? ?????????????? ????????????',
                        'permission' => 'childrens.show',
                        'path' => 'father-relations',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => ' ????????????????',
                        'permission' => 'childrens.create',
                        'path' => 'majors',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => '?????? ???????????? ????????????',
                        'permission' => 'childrens.create',
                        'path' => 'father-jobs',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => '?????? ???????????????? ???????????????? ',
                        'permission' => 'childrens.delete',
                        'path' => 'job-titles',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),

                ),
            ),
        ),

        // ????????????????????
        array(
            'title' => '?????????? ????????????????????',
            'permission' => array('users.show', 'users.create', 'users.edit', 'users.delete', 'permissions.show', 'permissions.create', 'permissions.edit', 'permissions.delete'),
            'icon' => array(
                'svg' => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen051.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes' => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub' => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title' => '????????????????????',
                        'permission' => array('users.show', 'users.create', 'users.edit', 'users.delete'),
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'classes' => array('item' => 'menu-accordion'),
                        'attributes' => array(
                            "data-kt-menu-trigger" => "click",
                        ),
                        'sub' => array(
                            'class' => 'menu-sub-accordion menu-active-bg',
                            'items' => array(
                                array(
                                    'title' => '??????',
                                    'path' => 'user',
                                    'permission' => 'users.show',
                                    'bullet' => '<span class="bullet bullet-dot"></span>',
                                ),
                                array(
                                    'title' => '??????????',
                                    'path' => 'user/create',
                                    'permission' => 'users.create',
                                    'bullet' => '<span class="bullet bullet-dot"></span>',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'title' => '??????????????????',
                        'permission' => array('permissions.show', 'permissions.create', 'permissions.edit', 'permissions.delete'),
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'classes' => array('item' => 'menu-accordion'),
                        'attributes' => array(
                            "data-kt-menu-trigger" => "click",
                        ),
                        'sub' => array(
                            'class' => 'menu-sub-accordion menu-active-bg',
                            'items' => array(
                                array(
                                    'title' => '??????',
                                    'permission' => 'permissions.show',
                                    'path' => 'role',
                                    'bullet' => '<span class="bullet bullet-dot"></span>',
                                ),
                                array(
                                    'title' => '??????????',
                                    'permission' => 'permissions.create',
                                    'path' => 'role/create',
                                    'bullet' => '<span class="bullet bullet-dot"></span>',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),

        // Separator
        array(
            'content' => '<div class="separator mx-1 my-4"></div>',
            'permission' => array('profile.show', 'profile.edit'),

        ),

        //// Modules
        array(
            'classes' => array('content' => 'pt-2 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">????????????</span>',
            'permission' => array('profile.show', 'profile.edit'),
        ),

        // Account
        array(
            'title' => '??????????',
            'permission' => array('profile.show', 'profile.edit'),
            'icon' => array(
                'svg' => theme()->getSvgIcon("demo1/media/icons/duotune/communication/com006.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),

            'classes' => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub' => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title' => '??????',
                        'path' => 'account/overview',
                        'permission' => array('profile.show'),
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => '??????????',
                        'path' => 'account/settings',
                        'permission' => array('profile.edit'),
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Separator
        array(
            'content' => '<div class="separator mx-1 my-4"></div>',
            'permission' => array('settings.show', 'settings.create', 'settings.edit', 'settings.delete', 'profile.show', 'profile.edit'),
        ),

        //// Modules
        array(
            'classes' => array('content' => 'pt-2 pb-2'),
            'permission' => array('settings.show', 'settings.create', 'settings.edit', 'settings.delete'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">????????????</span>',
        ),

        // System
        array(
            'title' => '????????????',
            'permission' => array('settings.show', 'settings.create', 'settings.edit', 'settings.delete'),
            'icon' => array(
                'svg' => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen025.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-layers fs-3"></i>',
            ),
            'classes' => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub' => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title' => '??????????????????',
                        'permission' => 'settings.show',
                        'path' => '#',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'attributes' => array(
                            'link' => array(
                                "title" => "??????????",
                                "data-bs-toggle" => "tooltip",
                                "data-bs-trigger" => "hover",
                                "data-bs-dismiss" => "click",
                                "data-bs-placement" => "right",
                            ),
                        ),
                    ),
                    array(
                        'title' => '?????? ??????????????',
                        'permission' => 'settings.show',
                        'path' => 'log/audit',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => '?????? ????????????',
                        'permission' => 'settings.show',
                        'path' => 'log/system',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),


        // Changelog
//        array(
//            'title' => '?????? ?????????????????? v'.theme()->getVersion(),
//            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen005.svg", "svg-icon-2"),
//            'path'  => 'documentation/getting-started/changelog',
//        ),
    ),

    // Horizontal menu
    'horizontal' => array(
        // Dashboard
        array(
            'title' => '????????????????',
            'path' => 'index',
            'classes' => array('item' => 'me-lg-1'),
        ),

        // Resources
        array(
            'title' => 'Resources',
            'classes' => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger' => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub' => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    // Documentation
                    array(
                        'title' => 'Documentation',
                        'icon' => theme()->getSvgIcon("demo1/media/icons/duotune/abstract/abs027.svg", "svg-icon-2"),
                        'path' => 'documentation/getting-started/overview',
                    ),

                    // Changelog
                    array(
                        'title' => '?????? ?????????????????? v' . theme()->getVersion(),
                        'icon' => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen005.svg", "svg-icon-2"),
                        'path' => 'documentation/getting-started/changelog',
                    ),
                ),
            ),
        ),

        // Account
        array(
            'title' => '??????????',
            'classes' => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger' => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub' => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    array(
                        'title' => '??????',
                        'path' => 'account/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => '??????????????????',
                        'path' => 'account/settings',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => '????????????',
                        'path' => '#',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'attributes' => array(
                            'link' => array(
                                "title" => "Coming soon",
                                "data-bs-toggle" => "tooltip",
                                "data-bs-trigger" => "hover",
                                "data-bs-dismiss" => "click",
                                "data-bs-placement" => "right",
                            ),
                        ),
                    ),
                ),
            ),
        ),

        // System
        array(
            'title' => '????????????',
            'classes' => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger' => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub' => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    array(
                        'title' => '??????????????????',
                        'path' => '#',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'attributes' => array(
                            'link' => array(
                                "title" => "??????????",
                                "data-bs-toggle" => "tooltip",
                                "data-bs-trigger" => "hover",
                                "data-bs-dismiss" => "click",
                                "data-bs-placement" => "right",
                            ),
                        ),
                    ),
                    array(
                        'title' => '?????? ??????????????',
                        'path' => 'log/audit',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title' => '?????? ????????????',
                        'path' => 'log/system',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),
    ),
);
