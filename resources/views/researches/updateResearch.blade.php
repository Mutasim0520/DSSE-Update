@extends('layouts.app')
@section('stylesheet')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/css/bootstrap-tagging.css" rel="stylesheet">
@endsection
@section('content')

    <div class="validation-system">
        <div class="validation-form">
            <form id="test-form" action="/storeresearch" method="post">
                {!! csrf_field() !!}
                <div class="col-md-12 form-group1">
                    <label class="control-label">Research Name</label>
                    <input type="text" placeholder="Research Name" required="" id = "R_name" name="name" autofocus="" value="{{ $memberResearch->name }}">
                </div>
                <div class="col-md-12 form-group1">
                    <label class="control-label">Broad Domain</label>
                    <textarea  placeholder="Abstract" required="" id="abstract" name="abstract" ></textarea>
                </div>
                <div class="col-md-12 form-group1">
                    <label class="control-label">Research Type</label>
                    <select class="selectpicker" required="" id="projectType" name="projecttype">
                        <option>Select Project Type</option>
                        <option>Web</option>
                        <option>Desktop App</option>
                        <option>Android</option>
                        <option>IOS</option>
                    </select>
                </div>
                <div class="col-md-6 form-group1">
                    <label class="control-label">Research Advisor</label>
                    <input type="text" required="" id="advisor">
                </div>
                <div class="col-md-6 form-group1">
                    <label class="control-label">Researcher</label>
                    <input type="text" required="" id="researcher">
                </div>
                <div class="col-md-6 form-group1">
                    <label for="radio" class="col-xsm-2 control-label">Funded Project</label>
                    <div class="radio-inline"><label class="col-xsm-2 control-label"><input type="radio" id="fs1"  name="fundstatus" value="1"> Yes</label></div>
                    <div class="radio-inline"><label class="col-xsm-2 control-label"><input type="radio" id="fs2" name="fundstatus" value="0"> No</label></div>
                </div>
                <div class="col-md-6 form-group1">
                    <label for="radio" class="col-xsm-2 control-label">Project Status</label>
                    <div class="radio-inline"><label class="col-xsm-2 control-label"><input type="radio" id="st1"  name="status" value="0"> Ongoing</label></div>
                    <div class="radio-inline"><label class="col-xsm-2 control-label"><input type="radio" id="st2"  name="status" value="1"> Completed</label></div>
                </div>
                <div class="col-md-6 form-group1">
                    <input type="hidden" id = "fundOrganization" placeholder="Funding Organization" name="fundingorganization" autofocus="">
                </div>
                <div class="col-md-6 form-group1">
                    <input type="hidden" id="fundAmount" name="fundamount" placeholder="Fund Amount" autofocus="">
                </div>
                <div class="col-md-12 form-group1 sbutton">
                    <button class="btn-lg laddu" id="submit" name="submit" type = "submit">Update</button>
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
        var members = {!!  json_encode($member)  !!};
        console.log(members);
        var arr = [];
        var cities = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: members
        });
        cities.initialize();
        var elt = $('#researcher');
        elt.tagsinput({
            itemValue: 'value',
            itemText: 'text',
            allowDuplicates: false,
            typeaheadjs: {
                name: 'cities',
                displayKey: 'text',
                source: cities.ttAdapter()
            }
        });
        var elt1 = $('#advisor');
        elt1.tagsinput({
            itemValue: 'value',
            itemText: 'text',
            allowDuplicates: false,
            typeaheadjs: {
                name: 'cities',
                displayKey: 'text',
                source: cities.ttAdapter()
            }
        });

        var memberResearch = {!! json_encode($memberResearch->member) !!};
        memberResearch.forEach(function(entry) {
            var text = entry["firstName"].concat(" ", entry["lastName"]);
            var value = entry["member_id"];
            if(entry["pivot"]["role"] == "Researcher"){
                elt.tagsinput('add' , {"value" : value, "text" : text});
            }
            if(entry["pivot"]["role"] == "Advisor"){
                elt1.tagsinput('add' , {"value" : value, "text" : text});
            }
        });

        var fundstatus = "{{ $memberResearch->fundStatus }}";
        var status = "{{ $memberResearch->status }}";
        if (fundstatus == "1"){
            var fundOrg = "{{ $memberResearch->fundingOrganization }}";
            var fundAmnt = "{{ $memberResearch->fundAmount }}";
            $('#fs1').prop('checked', true);
            $('#fundOrganization').clone().attr('type','text').insertAfter('#fundOrganization').val(fundOrg).prev().remove();
            $('#fundAmount').clone().attr('type','text').insertAfter('#fundAmount').val(fundAmnt).prev().remove();
        }
        else {
            $('#fs2').prop('checked', true);
        }

        if(status == "1"){
            $('#st2').prop('checked', true);
        }
        else {
            $('#st1').prop('checked', true);
        }

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
            console.log("event occured");
            event.preventDefault();
            var Research_name = $("#R_name").val();
            var broad_domain = $("#broad_domain").val();
            var fund = fundstatus;
            var fund_organization = $("#fundOrganization").val();
            var fund_amount = $("#fundAmount").val();
            var researcher = ($('#researcher').val()).split(',');
            var advisor = ($('#advisor').val()).split(',');
            var complete = status
            console.log(Research_name);
            var url = '/r_update/'.concat(memberResearch[0]["pivot"]["research_id"]);
            console.log(url);
            $.ajax({
                type: "POST",
                url: url,
                data: { _token: "{{ csrf_token() }}", r_name:Research_name, broad_domain:broad_domain
                    ,fund:fund, fund_organization:fund_organization, fund_amount:fund_amount , researcher:researcher , advisor:advisor,complete:complete },
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
