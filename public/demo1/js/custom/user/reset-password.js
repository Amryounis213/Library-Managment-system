initSettings();
handleChangePassword();

////////////////////////////////////////////
function initSettings() {
    var passwordMainEl = document.getElementById('kt_signin_password');
    var passwordEditEl = document.getElementById('kt_signin_password_edit');

    // button elements\n\n
    var passwordChange = document.getElementById('kt_signin_password_button');
    var passwordCancel = document.getElementById('kt_password_cancel');

    // toggle UI\n\n
    var toggleChangePassword = function toggleChangePassword() {
        passwordMainEl.classList.toggle('d-none');
        passwordChange.classList.toggle('d-none');
        passwordEditEl.classList.toggle('d-none');
    };

    passwordChange.querySelector('button').addEventListener('click', function () {
        toggleChangePassword();
    });
    passwordCancel.addEventListener('click', function () {
        toggleChangePassword();
    });

};

////////////////////////////////////////////
function handleChangePassword(e) {
    var validation;
    // form elements
    var form = document.getElementById('kt_signin_change_password');
    var submitButton = form.querySelector('#kt_password_submit');
    validation = FormValidation.formValidation(form, {
        fields: {
            current_password: {
                validators: {
                    notEmpty: {
                        message: 'كلمة المرور الحالية مطلوبة'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'كلمة المرور الجديده مطلوبه'
                    }
                }
            },
            password_confirmation: {
                validators: {
                    notEmpty: {
                        message: 'تأكيد كلمة المرور مطلوبة'
                    },
                    identical: {
                        compare: function compare() {
                            return form.querySelector('[name=\"password\"]').value;
                        },
                        message: 'كلمة المرور وتأكيدها ليسا متطابقين'
                    }
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row'
            })
        }
    });
    ///////////////////////////////////////////////////////
    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        validation.validate().then(function (status) {

            if (status == 'Valid') {
                // Show loading indication
                submitButton.setAttribute('data-kt-indicator', 'on');
                // Disable button to avoid multiple click
                submitButton.disabled = true;
                // Send ajax request
                axios.post(form.getAttribute('action'), new FormData(form)).then(function (response) {
                    // alert(response);
                    // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "تم إعادة تعيين كلمة المرور الخاصة بك بنجاح. ",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "حسنًا!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    });
                })["catch"](function (error) {
                    var dataMessage = error.response.data.message;
                    var dataErrors = error.response.data.errors;
                    for (var errorsKey in dataErrors) {
                        if (!dataErrors.hasOwnProperty(errorsKey)) continue;
                        dataMessage += " " + dataErrors[errorsKey];
                    }
                    if (error.response) {
                        Swal.fire({
                            text: dataMessage,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "حسنًا!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                }).then(function () {
                    // always executed
                    // Hide loading indication
                    submitButton.removeAttribute('data-kt-indicator');
                    // Enable button
                    submitButton.disabled = false;
                });
            } else {
                Swal.fire({
                    text: "معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء ، يرجى المحاولة مرة أخرى. ",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "حسنًا!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
            }
        });
    });
};
