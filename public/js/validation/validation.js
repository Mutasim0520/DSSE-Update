$(document).ready(function () {
    $.validator.setDefaults({
        errorClass: 'help-block',
        highlight:function (element) {
            $(element).closest('.form-group1').addClass('has-error');
        },
        unhighlight:function (element) {
            $(element).closest('.form-group1').removeClass('has-error');
        }
    });
    $("#test-form").validate({
        rules: {
            projectname:{
                required:true,
                minlength:5,
                remote:{
                    url: '/checkProject'
                }
            }
        },
        messages:{
            projectname:{
                required: "Please enter at least 5 character project name!",
                remote:"This project already exist. Please enter a diffrent name!"
            }
        }
    });

});