<?php
return array(
    'index' => array(
        'title' => 'الرئيسية',
        'description' => '',
        'view' => 'index',
        'layout' => array(
            'page-title' => array(
                'description' => true,
                'breadcrumb' => false,
            ),
        ),
        'assets' => array(
            'custom' => array(
                'js' => array(),
            ),
        ),
    ),

    'login' => array(
        'title' => 'Login',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/sign-in/general.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),

    'register' => array(
        'title' => 'Register',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/sign-up/general.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),

    'forgot-password' => array(
        'title' => 'Forgot Password',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/password-reset/password-reset.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),
//
//    'patient' => array(
//        'index' => array(
//            'title' => 'عرض المرضى',
//            'assets' => array(
//                'custom' => array(
//                    'css' => array(
//                        'plugins/custom/datatables/datatables.bundle.css',
//                    ),
//                    'js' => array(
//                        'plugins/custom/datatables/datatables.bundle.js',
//                    ),
//                ),
//            ),
//        ),
//        'create' => array(
//            'title' => 'إضافة ملف مريض',
//        ),
//        'edit' => array(
//            'title' => 'تعديل ملف مريض',
//        ),
//    ),

'kindergarden' => array(
    'title' => 'قائمة الروضات',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'الروضات',
        'edit' => array(
            'title' => 'تعديل ملف مريض',
        ),
    ),
),

'levels' => array(
    'title' => 'قائمة الروضات',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'المستويات الدراسية',
        'edit' => array(
            'title' => 'تعديل ملف مريض',
        ),
    ),
),
'childrens' => array(
    'title' => 'قائمة الاطفال',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'الأطفال',
        'edit' => array(
            'title' => 'تعديل ملف مريض',
        ),
    ),
),

// قائمة الحضور للموظفين
'employee' => array(
    'title' => 'قائمة الروضات',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'حضور الموظفين اليومي',
        'edit' => array(
            'title' => 'تعديل ملف مريض',
        ),
    ),
),
'switch' => array(
    'title' => 'قائمة الروضات',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'تبديل الشعب بين المربيات',
       
    ),
),
//قائمة الحضور للطلاب
'children' => array(
    'title' => 'قائمة الروضات',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'حضور الطلاب اليومي',
        'edit' => array(
            'title' => 'تعديل ملف مريض',
        ),
    ),
),
'classplacement' => array(
    'title' => ' ',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => '  التسكين الصفي للطلاب',
        'edit' => array(
            'title' => 'تعديل ملف مريض',
        ),
    ),
),
'employees' => array(
    'title' => 'قائمة الموظفين',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'الموظفين',
        'edit' => array(
            'title' => 'تعديل ملف مريض',
        ),
        
    ),
),
'drivers' => array(
    'title' => 'قائمة السائقين',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'السائقين',
        'create' => array(
            'title' => 'اضافة سائق',
        ),
        'edit' => array(
            'title' => 'تعديل ملف سائق',
        ),
        
    ),
),
'children-subscriptions' => array(
    'title' => 'اشتراكات الأطفال',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'اشتراكات الأطفال',
        
       
        
    ),
),

'installments' => array(
    'title' => ' الاقساط',
    'assets' => array(
        'custom' => array(
            'css' => array(
                'plugins/custom/datatables/datatables.bundle.css',
            ),
            'js' => array(
                'plugins/custom/datatables/datatables.bundle.js',
            ),
        ),
    ),
    '*' => array(
        'title' => 'الاقساط',
        
        
    ),
),

    'patient' => array(
        'title' => 'قائمة المرضى',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js' => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'title' => 'المرضى',
            'edit' => array(
                'title' => 'تعديل ملف مريض',
            ),
        ),
    ),

    'order' => array(
        'title' => 'طلبات الفحص الطبي',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js' => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'title' => 'طلبات الفحص الطبي',
            'edit' => array(
                'title' => 'تعديل طلب فحص طبي',
            ),
        ),
    ),


    'medicine' => array(
        'title' => 'قائمة الأدوية',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js' => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'title' => 'الأدوية',
            'edit' => array(
                'title' => 'تعديل دواء',
            ),
        ),
    ),

    'clinic' => array(
        'title' => 'قائمة العيادات',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js' => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'title' => 'العيادات',
            'edit' => array(
                'title' => 'تعديل عيادة',
            ),
        ),
    ),

    'checkup' => array(
        'title' => 'قائمة التحاليل المخبرية',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js' => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'title' => 'التحاليل المخبرية',
            'edit' => array(
                'title' => 'تعديل تحليل مخبري',
            ),
        ),
    ),

    'xray' => array(
        'title' => 'قامة الأشعة',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js' => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'title' => 'الأشعة',
            'edit' => array(
                'title' => 'تعديل الأشعة',
            ),
        ),
    ),

    'user' => array(
        'title' => 'قائمة المستخدمين',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js' => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'title' => 'المستخدمين',
            'edit' => array(
                'title' => 'تعديل بيانات المستخدم',
            ),
        ),
    ),

    'role' => array(
        'title' => 'قائمة الصلاحيات',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js' => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'title' => 'الصلاحيات',
            'edit' => array(
                'title' => 'تعديل صلاحية الوصول',
            ),
        ),
    ),

    'log' => array(
        'audit' => array(
            'title' => 'سجل التدقيق',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            ),
        ),
        'system' => array(
            'title' => 'سجل النظام',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            ),
        ),
    ),

    'account' => array(
        'overview' => array(
            'title' => 'عرض الحساب',
            'view' => 'account/overview/overview',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/widgets.js',
                    ),
                ),
            ),
        ),

        'settings' => array(
            'title' => 'اعدادات الحساب',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/account/settings/profile-details.js',
                        'js/custom/account/settings/signin-methods.js',
                        'js/custom/modals/two-factor-authentication.js',
                    ),
                ),
            ),
        ),
    ),

    // Documentation pages
    'documentation' => array(
        '*' => array(
            'assets' => array(
                'vendors' => array(
                    'css' => array(
                        'plugins/custom/prismjs/prismjs.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/prismjs/prismjs.bundle.js',
                    ),
                ),
                'custom' => array(
                    'js' => array(
                        'js/custom/documentation/documentation.js',
                    ),
                ),
            ),

            'layout' => array(
                'base' => 'docs', // Set base layout: default|docs

                // Content
                'content' => array(
                    'width' => 'fixed', // Set fixed|fluid to change width type
                    'layout' => 'documentation'  // Set content type
                ),
            ),
        ),

        'getting-started' => array(
            'overview' => array(
                'title' => 'Overview',
                'description' => '',
                'view' => 'documentation/getting-started/overview',
            ),

            'build' => array(
                'title' => 'Gulp',
                'description' => '',
                'view' => 'documentation/getting-started/build/build',
            ),

            'multi-demo' => array(
                'overview' => array(
                    'title' => 'Overview',
                    'description' => '',
                    'view' => 'documentation/getting-started/multi-demo/overview',
                ),
                'build' => array(
                    'title' => 'Multi-demo Build',
                    'description' => '',
                    'view' => 'documentation/getting-started/multi-demo/build',
                ),
            ),

            'file-structure' => array(
                'title' => 'File Structure',
                'description' => '',
                'view' => 'documentation/getting-started/file-structure',
            ),

            'customization' => array(
                'sass' => array(
                    'title' => 'SASS',
                    'description' => '',
                    'view' => 'documentation/getting-started/customization/sass',
                ),
                'javascript' => array(
                    'title' => 'Javascript',
                    'description' => '',
                    'view' => 'documentation/getting-started/customization/javascript',
                ),
            ),

            'dark-mode' => array(
                'title' => 'Dark Mode Version',
                'view' => 'documentation/getting-started/dark-mode',
            ),

            'rtl' => array(
                'title' => 'RTL Version',
                'view' => 'documentation/getting-started/rtl',
            ),

            'troubleshoot' => array(
                'title' => 'Troubleshoot',
                'view' => 'documentation/getting-started/troubleshoot',
            ),

            'changelog' => array(
                'title' => 'Changelog',
                'description' => 'version and update info',
                'view' => 'documentation/getting-started/changelog/changelog',
            ),

            'updates' => array(
                'title' => 'Updates',
                'description' => 'components preview and usage',
                'view' => 'documentation/getting-started/updates',
            ),

            'references' => array(
                'title' => 'References',
                'description' => '',
                'view' => 'documentation/getting-started/references',
            ),
        ),

        'general' => array(
            'datatables' => array(
                'overview' => array(
                    'title' => 'Overview',
                    'description' => 'plugin overview',
                    'view' => 'documentation/general/datatables/overview/overview',
                ),
            ),
            'remove-demos' => array(
                'title' => 'Remove Demos',
                'description' => 'How to remove unused demos',
                'view' => 'documentation/general/remove-demos/index',
            ),
        ),

        'configuration' => array(
            'general' => array(
                'title' => 'General Configuration',
                'description' => '',
                'view' => 'documentation/configuration/general',
            ),
            'menu' => array(
                'title' => 'Menu Configuration',
                'description' => '',
                'view' => 'documentation/configuration/menu',
            ),
            'page' => array(
                'title' => 'Page Configuration',
                'description' => '',
                'view' => 'documentation/configuration/page',
            ),
        ),
    ),
);
