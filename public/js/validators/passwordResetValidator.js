$(document).ready(function () {
    $.validator.setDefaults({
        errorClass: 'help-block',
        highlight:function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight:function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        }
    });
    $("#password_reset").validate({
        rules: {
            email:{
                required:true,
                remote:{
                    url: '/check/exist/email'
                }
            }
        },
        messages:{
            email:{
                remote:"This email does not exist in our record. Please try again."
            }
        }
    });

});