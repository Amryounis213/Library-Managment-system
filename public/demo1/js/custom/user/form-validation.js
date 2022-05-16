const form = document.getElementById('details_form');
///////////////////////////////////////////////////////
function validatePassword() {
    const passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));
    return passwordMeter.getScore() > 50;
};
///////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function (e) {
    FormValidation.formValidation( form, {
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'االاسم الأول مطلوب',
                    },
                },
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'الاسم الأخير مطلوب',
                    },
                },
            },
            role_id: {
                validators: {
                    notEmpty: {
                        message: 'الصلاحية مطلوب',
                    },
                },
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'البريد الإلكتروني مطلوب',
                    },
                    callback: {
                        message: 'القيمة المدخلة ليست عنوان بريد إلكتروني صالحًا',
                        callback: function (input) {
                            const value = input.value;
                            if (value === '') {
                                return true;
                            }

                            // I want the value has to pass both emailAddress and regexp validators
                            return (
                                FormValidation.validators.emailAddress().validate({
                                    value: value,
                                }).valid &&
                                FormValidation.validators.regexp().validate({
                                    value: value,
                                    options: {
                                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                    },
                                }).valid
                            );
                        },
                    },
                },
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'كلمة المرور مطلوبة'
                    },
                    callback: {
                        message: 'الرجاء إدخال كلمة مرور صالحة ',
                        callback: function callback(input) {
                            if (input.value.length > 0) {
                                return validatePassword();
                            }
                        }
                    }
                }
            },
            password_confirmation : {
                validators: {
                    notEmpty: {
                        message: 'مطلوب تأكيد كلمة المرور '
                    },
                    identical: {
                        compare: function compare() {
                            return form.querySelector('[name="password"]').value;
                        },
                        message: 'كلمة المرور وتأكيدها ليسا متطابقين'
                    }
                }
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
