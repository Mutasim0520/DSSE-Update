$(document).ready(function () {

    jQuery.validator.addMethod("src_code_validation", function(value) {
        if($('#src_code').val() == "1"){
            if(( $('#paper').prop('files')[0]) || $('#src_link').val()){
                return true;
            }
            else return false;
        }
        return true;
    },'Please Upload a source file or add any link to the source file');
    jQuery.validator.addMethod("dataset_validation", function(value) {
        if($('#dataset_status').val() == "1"){
            if(( $('#dataset').prop('files')[0]) || $('#dataset_link').val()){
                return true;
            }
            else return false;
        }
        return true;
    },'Please Upload a dataset file or add any link to the dataset file');
    jQuery.validator.addMethod("fund_status_validation", function(value) {
        if($('#fund_status').val() == "1"){
            if( $('#fund_ins').val()){
                return true;
            }
            else return false;
        }
        return true;
    },'Please state the funding organization');
    jQuery.validator.addMethod("affiliated_status_validation", function(value) {
        if($('#aff_ins').val() == "1"){
            if($('#ins_name').val()){
                return true;
            }
            else return false;
        }
        return true;
    },'Please state the affiliated institute name');



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
            src_code:{
                src_code_validation:true,
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
                extension:"pdf"
            },
            description:{
                required:true
            },
            dataset:{
                dataset_validation:true
            },
            fund_status:{
                fund_status_validation:true
            },
            aff_ins:{
                affiliated_status_validation:true
            }

        },
        messages:{
            name:{
                required: "Please enter at least 5 character project name!",
                remote:"This project already exist. Please enter a diffrent name!"
            },
            file:{
                extension:"Please enter the following pdf formatted file"
            }

        }
    });

});