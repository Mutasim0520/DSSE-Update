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
            name:{
                required:true,
                minlength:5,
                remote:{
                    url: '/checkProject'
                }
            },
            research:{
                required:true
            },
            author:{
                required:true
            },
            date:{
                required:true
            },
            file:{
                extension:"docx|pdf"
            }
        },
        messages:{
            name:{
                required: "Please enter at least 5 character project name!",
                remote:"This project already exist. Please enter a diffrent name!"
            },
            file:{
                extension:"Please enter the following formatted file: DOCX,PDF"
            }
        }
    });

});