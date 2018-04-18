@extends('layouts.app')
@section('header')
        <h2>Add Member</h2>
        @endsection
@section('content')
        <div class="validation-system">
                <div class="validation-form">
                        <form id="test-form" action="/storemember" method="post"  enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                        <h3> Basic Info</h3><hr>
                                        <div class="clearfix"> </div>
                                        <div class="col-md-6 form-group1">
                                                <input type="text" placeholder="First Name" required="" id="firstName" name="firstname" autofocus="">
                                        </div>
                                        <div class="col-md-6 form-group1">
                                                <input type="text" placeholder="Last Name" required="" id="lastName" name="lastname" autofocus="">
                                        </div>
                                        <div class="col-md-12 form-group1">
                                                <input class="estyle" type="email" placeholder="Please Enter Your Email" required="" id="email" name="email" autofocus="">
                                        </div>
                                        <div class="col-md-12 form-group1">
                                                <input type="text" placeholder="Contact Number" required="" id="contactNumber" name="contactNumber" autofocus="">
                                        </div>
                                        <div class="col-md-12 form-group1">
                                                <input type="text" placeholder="Current Designation" required="" id="currentDesignation" name="currentDesignation" autofocus="">
                                        </div>
                                        <div class="col-md-12 form-group1">
                                                <input type="text" placeholder="Institute" required="" id="currentInstitute" name="currentInstitute" autofocus="">
                                        </div>
                            <div class="col-md-6">
                                <label class="control-label">Upload Image</label>
                            <input type="file" name="image" required="" />
                            </div>

                                <div class="clearfix"> </div>
                                <h3> Educational Info</h3>
                                <div class="clearfix"> </div>
                                <div class="col-md-12 form-group1" id="degree">
                                        <input type="text" placeholder="Degree Name" name="degree1" autofocus="">
                                </div>
                                <div class="col-md-6 form-group1" id="institute">
                                        <input type="text" placeholder="Institute Name" name="graduationIns1" autofocus="">
                                </div>
                                <div class="col-md-6 form-group1" id="passing-year">
                                        <input type="text" placeholder="Passing Year" name="degreePassingYear1" autofocus="">
                                </div>
                                <div class="col-md-12 form-group1" style="margin-top: 7px;">
                                        <input type="button" class="btn-xs" id="add-edu" value="add more degree">
                                </div>


                                <div class="clearfix"> </div>
                                <h3> Career Info</h3>
                                <div class="col-md-6 form-group1">
                                        <input type="text" placeholder="Organization Name" name="formerOrg1" autofocus="">
                                </div>
                                <div class="col-md-6 form-group1">
                                        <input type="text" placeholder="Designation" name="formerOrgDesg1" autofocus="">
                                </div>
                                <div class="form-group1" id="working-period">
                                        <div class="col-md-6">
                                                <input type="text" placeholder="From" name="formerOrgFrm1" autofocus="">
                                        </div>
                                        <div class="col-md-6">
                                                <input type="text" placeholder="To" name="formerOrgTo1" autofocus="">
                                        </div>
                                </div>
                                <div class="col-md-12 form-group1" style="margin-top: 7px;">
                                        <input type="button" class="btn-xs" id="add-car" value="add more carrer">
                                </div>
                                <div class="col-md-12 form-group1 sbutton">
                                        <button class="btn-lg laddu"  type = "submit" id="add">Save</button>
                                </div>
                            <input type="hidden" id="counterEdu" value="1" name="counterEdu">
                            <input type="hidden" id="counterCar" value="1" name="counterCar">

                        </form>
                </div>
        </div>

@endsection()

@section('scripts')
        <script>
            $(document).ready(function() {
                console.log("done");
                var counterEdu = 1;
                var counterCar = 1;
                $("#add-edu").click(function (event) {
                    counterEdu  = counterEdu+1;
                    $("#passing-year").after('<div class="col-md-12 form-group1">'+'<input type="text" placeholder="Degree Name" name="degree'+counterEdu +'">'+
                        '</div>'+'<div class="clearfix"></div>'+'<div class="col-md-6 form-group1">'+'<input type="text" placeholder="Institute Name" name="graduationIns'+counterEdu +'">' +'</div>'
                    +'<div class="col-md-6 form-group1">'+'<input type="text" placeholder="Passing Year" name="degreePassingYear'+counterEdu +'">'+'</div>'+'<div class="clearfix"></div>');
                    $("#counterEdu").val(counterEdu);
                });
                $("#add-car").click(function (event) {
                    counterCar = counterCar+1;
                    $("#working-period").after('<div class="col-md-6 form-group1">'+'<input type="text" placeholder="Organization Name" name="formerOrg'+counterCar +'">'+'</div>'+
                        '<div class="col-md-6 form-group1">'+'<input type="text" placeholder="Designation" name="formerOrgDesg'+counterCar +'">'+'</div>'+
                        '<div class="clearfix"></div>'+
                        '<div class="form-group1">'+
                                '<div class="col-md-6 form-group1">'+'<input type="text" placeholder="From" name="formerOrgFrm'+counterCar +'">'+'</div>'+
                                '<div class="col-md-6 form-group1">'+'<input type="text" placeholder="Degree Name" name="formerOrgTo'+counterCar +'">'+'</div>'+
                        '</div>'+'<div class="clearfix"></div>');
                    $("#counterCar").val(counterCar);
                });

            });
        </script>
@endsection
