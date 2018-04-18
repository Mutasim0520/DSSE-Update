@extends('layouts.app')
@section('stylesheet')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/css/bootstrap-tagging.css" rel="stylesheet">
@endsection
@section('header')
    <h2>Add Research</h2>
@endsection
@section('content')

    <div class="validation-system">
        <div class="validation-form">
            <form id="test-form" action="/storeresearch" method="post">
                {!! csrf_field() !!}
                <div class="col-md-12 form-group1">
                    <input type="text" placeholder="Research Name" required="" id = "R_name" name="name" autofocus="">
                </div>
                <div class="col-md-12 form-group1">
                    <textarea  placeholder="Broad Domain" required="" id="broad_domain" name="abstract" ></textarea>
                </div>
                <div class="col-md-12 form-group1">
                    <select class="selectpicker" required="" id="projectType" name="projecttype">
                        <option>Select Research Type</option>
                        <option>Web</option>
                        <option>Desktop App</option>
                        <option>Android</option>
                        <option>IOS</option>
                    </select>
                </div>
                <div class="col-md-6 form-group1">
                    <input type="text" required="" id="advisor" placeholder="Research Advisor">
                </div>
                <div class="col-md-6 form-group1">
                    <input type="text" required="" id="researcher" placeholder="Researcher">
                </div>
                <div class="col-md-6 form-group1">
                    <label for="radio" class="col-xsm-2 control-label">Funded Research</label>
                    <div class="radio-inline"><label class="col-xsm-2 control-label"><input type="radio" id ="fund" required="" name="fundstatus" value="1"> Yes</label></div>
                    <div class="radio-inline"><label class="col-xsm-2 control-label"><input type="radio" id ="fund" required="" name="fundstatus" value="0"> No</label></div>
                </div>

                <div class="col-md-6 form-group1">
                    <label for="radio" class="col-xsm-2 control-label">Research Status</label>
                    <div class="radio-inline"><label class="col-xsm-2 control-label"><input type="radio" id="complete" required="" name="status" value="0"> Ongoing</label></div>
                    <div class="radio-inline"><label class="col-xsm-2 control-label"><input type="radio" id="complete" required="" name="status" value="1"> Completed</label></div>
                </div>
                <div class="col-md-6 form-group1">
                    <input type="hidden" id="fundOrganization" val="" name="fundingOrganization" autofocus="" placeholder="Funding Organization">
                </div>
                <div class="col-md-6 form-group1">
                    <input type="hidden" id="fundAmount" name="fundAmount" val="" autofocus="" placeholder="Fund Amount">
                </div>
                <div class="col-md-12 form-group1 sbutton">
                    <button class="btn-lg laddu" id="submit" name="submit" type = "submit">Add Research</button>
                </div>
                <div class="clearfix"> </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    {{--- tagging js --}}
    <script src="/js/bootstrap-tagging.js"></script>
    <script src="/js/tapered.bundle.js"></script>
    {{--- validation js --}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="/js/validation.js"></script>

    <script>
        $(document).ready(function() {

            var members = JSON.constructor({!!  json_encode($member)  !!});
            var arr = [];
            var cities = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: members
            });
            cities.initialize();
            var elt = $('#researcher');
            console.log(members);
            console.log(typeof(elt));
            elt.tagsinput({
                itemValue: 'value',
                itemText: 'text',
                allowDuplicates: false,
                interactive:true,
                typeaheadjs: {
                    name: 'cities',
                    displayKey: 'text',
                    source: cities.ttAdapter()
                }
            });
            console.log(members);
            var elt1 = $('#advisor');
            elt1.tagsinput({
                itemValue: 'value',
                itemText: 'text',
                allowDuplicates: false,
                interactive:true,
                typeaheadjs: {
                    name: 'cities',
                    displayKey: 'text',
                    source: cities.ttAdapter()
                }
            });
            console.log("done");
            var fundstatus=0;
            var status = 0;
            $('input[name=fundstatus]').change(function () {
                fundstatus = $('input[name=fundstatus]:checked').val();
                if(fundstatus == "1"){
                    $('#fundOrganization').clone().attr('type','text').insertAfter('#fundOrganization').prev().remove();
                    $('#fundAmount').clone().attr('type','text').insertAfter('#fundAmount').prev().remove();
                }

                if(fundstatus == "0"){
                    $('#fundOrganization').clone().attr('type','hidden').insertAfter('#fundOrganization').val("").prev().remove();
                    $('#fundAmount').clone().attr('type','hidden').insertAfter('#fundAmount').val("").prev().remove();
                }
            });
            $('input[name=status]').change(function () {
                status = $('input[name=fundstatus]:checked').val();
            });

            $("#test-form").submit(function(event){
                if($(this).valid()){
                    event.preventDefault();
                    console.log("event occured");
                    console.log($('#researcher').val());
                    console.log($('#advisor').val());
                    var Research_name = $("#R_name").val();
                    var broad_domain = $("#broad_domain").val();
                    var fund = fundstatus;
                    var fund_organization = $("#fundOrganization").val();
                    var fund_amount = $("#fundAmount").val();
                    var researcher = ($('#researcher').val()).split(',');
                    var advisor = ($('#advisor').val()).split(',');
                    var complete = status
                    console.log(Research_name);
                    $.ajax({
                        type: "POST",
                        url: '/storeresearch',
                        data: { _token: "{{ csrf_token() }}", r_name:Research_name,broad_domain:broad_domain
                            , fund:fund, fund_organization:fund_organization, fund_amount:fund_amount , researcher:researcher , advisor:advisor, complete:complete },
                        success: function( msg ) {
                            console.log(msg);
                            window.location.replace('/researches');
                        }
                    });
                }
            });
        });
    </script>

@endsection



