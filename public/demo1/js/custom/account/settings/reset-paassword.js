
// Class definition
function KTAccountSettingsSigninMethods() {
    // Private functions
    var initSettings = function initSettings() {
        var signInMainEl = document.getElementById('kt_signin_email');
        var signInEditEl = document.getElementById('kt_signin_email_edit');
        var passwordMainEl = document.getElementById('kt_signin_password');
        var passwordEditEl = document.getElementById('kt_signin_password_edit');

        // button elements\n\n
        var signInChangeEmail = document.getElementById('kt_signin_email_button');
        var signInCancelEmail = document.getElementById('kt_signin_cancel');
        var passwordChange = document.getElementById('kt_signin_password_button');
        var passwordCancel = document.getElementById('kt_password_cancel');
        // toggle UI\n\n
        var toggleChangeEmail = function toggleChangeEmail() {
            signInMainEl.classList.toggle('d-none');
            signInChangeEmail.classList.toggle('d-none');
            signInEditEl.classList.toggle('d-none');
        };
        var toggleChangePassword = function toggleChangePassword() {
            passwordMainEl.classList.toggle('d-none');
            passwordChange.classList.toggle('d-none');
            passwordEditEl.classList.toggle('d-none');
        };
        signInChangeEmail.querySelector('button').addEventListener('click', function () {
            toggleChangeEmail();
        });
        signInCancelEmail.addEventListener('click', function () {
            toggleChangeEmail();
        });
        passwordChange.querySelector('button').addEventListener('click', function () {
            toggleChangePassword();
        });
        passwordCancel.addEventListener('click', function () {
            toggleChangePassword();
        });

    };
    var handleChangeEmail = function handleChangeEmail(e) {
        var validation;
        // form elements\n\n
        var form = document.getElementById('kt_signin_change_email');
        var submitButton = form.querySelector('#kt_signin_submit');
        validation = FormValidation.formValidation(form, {
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        },
                        emailAddress: {
                            message: 'The value is not a valid email address'
                        },
                    },
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Password is required'
                        }
                    }
                }
            },
            plugins: {
                //Learn more: https://formvalidation.io/guide/plugins\n
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({rowSelector: '.fv-row'})
            }
        });
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();
            validation.validate().then(function (status) {
                if (status === 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    // Disable button to avoid multiple click\n\n
                    submitButton.disabled = true;
                    // Send ajax request\n\n
                    axios.post(form.getAttribute('action'), new FormData(form)).then(function (response) {
                        // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Your email has been successfully changed.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
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
                                confirmButtonText: "Ok, got it!",
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
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText:
                            "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    });
                }
            });
        });
    };
    var handleChangePassword = function handleChangePassword(e) {
        var validation;
        // form elements
        var form = document.getElementById('kt_signin_change_password');
        var submitButton = form.querySelector('#kt_password_submit');
        validation = FormValidation.formValidation(form, {
            fields: {
                current_password: {
                    validators: {
                        notEmpty: {
                            message: 'Current Password is required'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'New Password is required'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        notEmpty: {
                            message: 'Confirm Password is required'
                        },
                        identical: {
                            compare: function compare() {
                                return form.querySelector('[name=\"password\"]').value;
                            },
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            },
            plugins: {
                //Learn more: https://formvalidation.io/guide/plugins
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.fv-row'
                })
            }
        });
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
                        // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Your password has been successfully reset.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
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
                                confirmButtonText: "Ok, got it!",
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
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    });
                }
            });
        });
    };

    // Public methods
    return {
        init: function init() {
            initSettings();
            handleChangeEmail();
            handleChangePassword();
        }
    };
}

