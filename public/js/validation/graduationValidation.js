$(document).ready(function () {

    jQuery.validator.addMethod("thesis_title_validation", function(value) {
        if($('#src_code').val() == "1"){
            if(( $('#paper').prop('files')[0]) || $('#src_link').val()){
                return true;
            }
            else return false;
        }
        return true;
    },'Please insert a thesis title');

    $.validator.setDefaults({
        errorClass: 'help-block',
        highlight:function (element) {
            $(element).closest('.form-group1').addClass('has-error');
        },
        unhighlight:function (element) {
            $(element).closest('.form-group1').removeClass('has-error');
        }
    });
    $("#graduation_add_form").validate({
        rules: {
            degree:{
                required:true,
                remote:{
                    url: '/checkGraduation'
                }
            },
            subject:{
                required:true
            },
            sessions:{
                required:true
            },
            institute:{
                required:true
            },

        },
        messages:{
            degree:{
                remote:"This degree already exist. Please enter a different name!"
            },

        }
    });

});