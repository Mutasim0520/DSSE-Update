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
    jQuery.validator.addMethod("srs_validation", function(value) {
        if($('#srs').val() == "1"){
            if(( $('#srs_file').prop('files')[0]) || $('#srs_link').val()){
                return true;
            }
            else return false;
        }
        return true;
    },'Please Upload a SRS file or add any link to the SRS file');
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

    jQuery.validator.addMethod("project_members_validations", function(value) {
        if(( $('#pm').val()) || $('#member').val()){
            return true;
        }
        else return false;
    },'Please select at least one project member or project manager');
    jQuery.validator.addMethod("completion_date_validation", function(value) {
        if($('#st2').val() == "1"){
            if($('#finishDate').val()){
                return true;
            }
            else return false;
        }
        return true;
    },'Please enter the finish date');



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
                remote:{
                    url: '/checkProject'
                }
            },
            src_link:{
                src_code_validation:true,
            },
            file:{
                src_code_validation:true,
            },
            srs_link:{
                srs_validation:true,
            },
            startDate:{
                required:true
            },
            finishDate:{
                completion_date_validation:true
            },
            srs_file:{
                srs_validation:true,
                extension:"pdf"
            },
            description:{
                required:true
            },
            fund_ins:{
                fund_status_validation:true
            },
            pm:{
                project_members_validations:true
            },
            member:{
                project_members_validations:true
            }

        },
        messages:{
            name:{
                remote:"This project already exist. Please enter a different name!"
            }

        }
    });

});