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

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    $("#passwordRecoveryForm").validate({
        rules: {
            p_c_email:{
                required:true,
                remote:'/password/change/check/email',
            },
        },
        messages:{
            p_c_email:{
                remote:"The email doesn't match",
            },
        }
    });

});