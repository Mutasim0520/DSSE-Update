@extends('layouts.user')
@section('title')
    DSSE | Update Project
@endsection
@section('style')
    <link type="text/css" href="/css/bootstrap-tagging.css" rel="stylesheet">
    <link type="text/css" href="/css/select2.css" rel="stylesheet">
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
            <main class="hoc container clear" >
                <div class="group excerpts">
                    <article class="full">
                        <figure class="list new-group">
                            <center id="loading" style="display: none">
                                <H1 style="letter-spacing: 3px">Please Wait</H1>
                                <div class="loader"></div>
                            </center>
                            <form id="test-form" action="/p_update/{{encrypt($project->project_id)}}" method="post" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="col-md-12 form-group">
                                    <label class="item-head log">Title</label>
                                    <input class="form-control" type="text" required="" id="projectName" name="projectname" autofocus="" value="{{$project->name}}">
                                </div><div class="clearfix"></div><br>
                                <div class="col-md-12 form-group">
                                    <label class="item-head log">Abstract</label>
                                    <textarea  placeholder="Abstract" required="" id ="description" name="description" class="form-control ckeditor" >
                                    <?php echo $project->description; ?>
                                </textarea>
                                </div>
                                <div class="col-md-10 form-group">
                                    <label class="item-head log">Select Keywords</label>
                                    <select class="form-control select2" multiple="multiple" data-placeholder="Select key words" name="keywords[]" id="keywords" style="width: 100%;">
                                        @foreach($keywords as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-default btn-sm" id="add_keyword" style="margin-top: 22%;">Add new keyword</button>
                                </div>
                                <div class="col-md-12 form-group" id="project_tag_container" style="display: none;">
                                    <label class="item-head log">New Keyword</label>
                                    <input type="text" data-role="tagsinput" name="new_tags" id="new_keywords">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="item-head log">Select Project Manager</label>
                                    <select class="form-control select2" multiple="multiple" data-placeholder="Select Project Manager"  id="pm" style="width: 100%;" require>
                                        <option value="">Select Project Manager</option>
                                        @foreach($member as $item)
                                            <option value="{{$item->member_id}}">{{$item->firstName}} {{$item->lastName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="item-head log">Select Project Member</label>
                                    <select class="form-control select2" multiple="multiple" required="" data-placeholder="Select Project Member"  id="member" style="width: 100%;" required>
                                        <option value="">Select Project Member</option>
                                        @foreach($member as $item)
                                            <option value="{{$item->member_id}}">{{$item->firstName}} {{$item->lastName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="item-head log">Project Status</label>
                                    <div class="radio-inline" ><label class="col-xsm-2 control-label">
                                            <input type="radio" id="st2" required="" name="status" value="0" checked> Ongoing</label>
                                    </div>
                                    <div class="radio-inline">
                                        <label class="col-xsm-2 control-label">
                                            <input type="radio" id="st2" required="" name="status" value="1"> Completed</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="item-head log">Start Date</label>
                                    <input type="text" class="form-control" id="startDate" required="">
                                </div>
                                <div class="col-md-6 form-group" id="finishContainer" style="display: none;">
                                    <label class="item-head log">Finish Date</label>
                                    <input class="form-control" type="text" id="finishDate" class="datepicker">
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="col-md-12 form-check">
                                        <label class="item-head log form-check-label">
                                            <input class="form-check-input" type="checkbox" name="fund_status" value="0" style="display: inline-block;">
                                            Funded?</label>
                                    </div>
                                    <div class="col-md-6" id="fund_ins_container" style="display:none;">
                                        <label class="item-head log">Funding Organization</label>
                                        <input type="text" class="form-control" id="fund_ins">
                                    </div>
                                    <div class="col-md-6" id="fund_amount_container" style="display:none;">
                                        <label class="item-head log">Fund Amount</label>
                                        <input type="text" class="form-control" id="fund_amount">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="col-md-3 form-check">
                                        <label>
                                            <input type="checkbox" name="src_code" value="0" style="display: inline-block;">
                                            Any Source Code?</label>
                                    </div>
                                    <div class="col-md-9 form-group" id="source_code_container" style="display:none;">
                                        <div class="col-md-5">
                                            <label class="item-head log"><i id="src_file_exist" style="display: none;" class="fa fa-check-circle"></i>Upload file</label>
                                            <input type="file" name="file" id="paper">
                                        </div>
                                        <div class="col-md-7">
                                            <label class="item-head log">File URL</label>
                                            <input type="url"  class="form-control" name="src_link">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="col-md-3 form-check">
                                        <label>
                                            <input type="checkbox" name="srs" value="0" style="display: inline-block;">
                                            Any SRS?</label>
                                    </div>
                                    <div class="col-md-9 form-group" id="srs_container" style="display:none;">
                                        <div class="col-md-5">
                                            <label class="item-head log">
                                                <i id="srs_file_exist" style="display: none;" class="fa fa-check-circle"></i>Upload file</label>
                                            <input type="file" name="file" id="srs_file">
                                        </div>
                                        <div class="col-md-7">
                                            <label class="item-head log">File URL</label>
                                            <input type="url"  class="form-control" name="srs_link">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group" style="text-align: center">
                                    <button class="btn" id="submit" name="submit" type = "submit">Update Project</button>
                                </div>
                                <div class="clearfix"> </div>
                            </form>
                        </figure>
                    </article>
                </div>
            </main>
        </main>
    </div>
@endsection
@section('scripts')
    <script src="/js/ckeditor/ckeditor.js"></script>
    {{--- tagging js --}}
    <script src="/js/bootstrap-tagging.js"></script>
    <script src="/js/select2.full.min.js"></script>
    <script src="/js/tapered.bundle.js"></script>
    {{--- validation js --}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="/js/validation/publicationValidation.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
    <script type="text/javascript">
        $("select").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);

            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });
        var file_counter = 0;
        CKEDITOR.replace('description',
            {
                customConfig : 'config.js',
                toolbar : 'simple'
            });

        $('input[name=fund_status]').change(function () {
            if($('input[name=fund_status]').is(":checked")){
                $('input[name=fund_status]').val(1);
                $('#fund_ins_container').show();
                $('#fund_amount_container').show();
            }
            else{
                $('#fund_amount_container').css('display','none');
                $('#fund_ins_container').css('display','none');;
                $('input[name=fund_status]').val(0);
                console.log("hide");
            }
        });

        $('input[name=src_code]').change(function () {
            if($('input[name=src_code]').is(":checked")){
                $('input[name=src_code]').val(1);
                $('#source_code_container').show();
            }
            else{
                $('#source_code_container').css('display','none');
                $('input[name=src_code]').val(0);
                console.log("hikikjkj");
            }
        });

        $('input[name=srs]').change(function () {
            if($('input[name=srs]').is(":checked")){
                $('input[name=srs]').val(1);
                $('#srs_container').show();
            }
            else{
                $('#srs_container').css('display','none');
                $('input[name=srs]').val(0);
                console.log("hikikjkj");
            }
        });

        $('#add_keyword').click(function (e) {
            e.preventDefault();
            $('#project_tag_container').show();
        });

        $('#paper').change(function () {
            file_counter = file_counter+1;
        });

        $('#srs_file').change(function () {
            file_counter = file_counter+1;
        });

        $(document).ready(function() {

            $(".select2").select2();
            $( function() {
                $("#startDate").datepicker();
                $("#finishDate").datepicker();
            } );

            var keywords_all = JSON.parse('{!! $project->keyword !!}');
            var keywords = [];
            console.log(keywords_all.length);
            for(var i=0;i<keywords_all.length;i++){
                console.log(keywords_all[i].name);
                keywords.push(keywords_all[i].name);
            }
            $("#keywords").val(keywords).trigger('change');

            var all_members = JSON.parse('{!! $project->member !!}');
            var project_pm = [];
            var project_member = [];
            for(var i=0;i<all_members.length;i++){
                if(all_members[i].pivot['role'] == 'Project Manager') {
                    project_pm.push(all_members[i].member_id);
                }
                else{
                    project_member.push(all_members[i].member_id);
                }
            }
            $("#pm").val(project_pm).trigger('change');
            $("#member").val(project_member).trigger('change');

            var start_date='{{$project->start_date}}';
            var finish_date='{{$project->finish_date}}';
            if('{{$project->status}}' == '1'){
                $('#st2').prop('checked', true);
                $('#finishContainer').show();
                $('#finishDate').attr('required','required');
                $("#startDate").datepicker({ dateFormat: 'mm/dd/yy'}).datepicker("setDate", new Date(start_date));
                $("#finishDate").datepicker({ dateFormat: 'mm/dd/yy'}).datepicker("setDate", new Date(finish_date));

            }
            else {
                $('#st1').prop('checked', true);
                $("#startDate").datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", new Date(start_date));
            }

            if('{{$project->fundStatus}}' == '1'){
                $('input[name=fund_status]').attr('checked', 'checked');
                $('#fund_ins_container').show();
                $('#fund_ins').attr('value','{{$project->fundingOrganization}}');
            }

            if('{{$project->src_code_path}}' != "null" || '{{$project->src_code_url}}'){
                $('input[name=src_code]').attr('checked', 'checked');
                $('input[name=src_code]').val(1);
                $('#source_code_container').show();
                if('{{$project->src_code_path}}' != "null") $('#src_file_exist').show();
                if('{{$project->src_code_url}}') $('input[name=src_link]').attr('value','{{$project->src_code_url}}');
            }

            if('{{$project->srs_path}}' != "null" || '{{$project->srs_url}}'){
                $('input[name=srs]').attr('checked', 'checked');
                $('input[name=srs]').val(1);
                $('#srs_container').show();
                if('{{$project->srs_path}}' != "null") $('#srs_file_exist').show();
                if('{{$project->srs_url}}') $('input[name=srs_link]').attr('value','{{$project->srs_url}}');
            }


            $("#description").change(function (event) {
                var description = CKEDITOR.instances.description.getData();
            });

            $("#projectTag").change(function(){
                var tag = $("#projectTag").val();
            });

            var fundstatus=0;

            var status = 0;

            $('input[name=fundstatus]').change(function () {
                fundstatus = $('input[name=fundstatus]:checked').val();
                if(fundstatus == "1"){
                    $('#fundContainer').show();
                }

                else if(fundstatus == "0"){
                    $('#fundContainer').css('dispaly','none');
                }
            });

            $('input[name=status]').change(function () {
                status = $('input[name=status]:checked').val();
                if(status=="1"){
                    $('#finishContainer').show();
                    $('#finishDate').attr('required','required');
                }
                else {
                    $('#finishContainer').css("display", "none");
                    $('#finishDate').removeAttr('required');
                }
                console.log(status);
            });

            $("#test-form").submit(function (event) {
                if($(this).valid()){
                    event.preventDefault();
                    $('#test-form').hide();
                    $('#loading').show();
                    var newTags = $('#new_keywords').tagsinput('items');
                    var src_code_path = "null";
                    var srs_path = 'null';

                    if(newTags.length>0){
                        $.ajax({
                            url:"/storekeyword",
                            type:"post",
                            data:{ _token: "{{ csrf_token() }}",keywords:newTags},
                            success: function(msg){
                                console.log(msg);
                            }
                        });
                    }

                    if(file_counter==1){
                        if(( $('#paper').prop('files')[0])){
                            var file_data = $('#paper').prop('files')[0];
                            var form_data = new FormData();
                            form_data.append('file', file_data);
                            form_data.append('_token', $("input[name ='_token']").val());
                            $.ajax({
                                url: "/storefile",
                                type: "post",
                                data: form_data,
                                cache:false,
                                processData: false,
                                contentType: false,
                                success: function (path) {
                                    src_code_path = path;
                                    addProject(src_code_path,srs_path);
                                }
                            });
                        }

                        else if(( $('#srs_file').prop('files')[0])){
                            var file_data = $('#srs_file').prop('files')[0];
                            var form_data = new FormData();
                            form_data.append('file', file_data);
                            form_data.append('_token', $("input[name ='_token']").val());
                            $.ajax({
                                url: "/storefile",
                                type: "post",
                                data: form_data,
                                cache:false,
                                processData: false,
                                contentType: false,
                                success: function (path) {
                                    srs_path = path;
                                    addProject(src_code_path,srs_path);
                                }
                            });
                        }
                    }
                    else if(file_counter==2){
                        if(( $('#paper').prop('files')[0])){
                            var file_data = $('#paper').prop('files')[0];
                            var form_data = new FormData();
                            form_data.append('file', file_data);
                            form_data.append('_token', $("input[name ='_token']").val());
                            $.ajax({
                                url: "/storefile",
                                type: "post",
                                data: form_data,
                                cache:false,
                                processData: false,
                                contentType: false,
                                success: function (path) {
                                    src_code_path = path;
                                    var file_data = $('#srs_file').prop('files')[0];
                                    var form_data = new FormData();
                                    form_data.append('file', file_data);
                                    form_data.append('_token', $("input[name ='_token']").val());
                                    $.ajax({
                                        url: "/storefile",
                                        type: "post",
                                        data: form_data,
                                        cache:false,
                                        processData: false,
                                        contentType: false,
                                        success: function (path) {
                                            srs_path = path;
                                            addProject(src_code_path,srs_path);
                                        }
                                    });
                                }
                            });
                        }

                    }
                    else {
                        addProject(src_code_path,srs_path);
                    }

                }
            });
        });

        function addProject(src_code_path,srs_path) {
            var abstract = CKEDITOR.instances.description.getData();
            var projectName = $("#projectName").val();
            var description = abstract;
            var fund_status = $('input[name=fund_status]').val();
            var fund_ins = $('#fund_ins').val();
            var fund_amount = $('#fund_amount').val();
            var projectManager = ($('#pm').val());
            var projectMember = ($('#member').val());
            var projectType = $("#projectTag").val();
            var startDate = $("#startDate").val();
            var finishDate = $("#finishDate").val();
            var complete = $("input[name=status]:checked").val();
            var tags = $('#keywords').val();
            var newTags = $('#new_keywords').tagsinput('items');
            var src_code_url = $('input[name=src_link]').val();
            var srs_url = $('input[name=srs_link]').val();
            console.log(complete);

            $.ajax({
                type: "POST",
                url: '/p_update/"{{encrypt($project->project_id)}}"',
                data: { _token: "{{ csrf_token() }}",
                    projectName:projectName,
                    description:description,
                    fund:fund_status,
                    fundOrganization:fund_ins,
                    fundAmount:fund_amount ,
                    projectManager:projectManager ,
                    member:projectMember ,
                    projectType:projectType,
                    complete:complete,
                    finishDate:finishDate,
                    startDate:startDate,
                    keywords:tags,
                    new_keywords:newTags,
                    src_code_url:src_code_url,
                    src_code_path:src_code_path,
                    src_code_url:src_code_url,
                    complete:complete,
                    srs_path:srs_path,
                    srs_url:srs_url
                },
                success: function( msg ) {
                    sessionStorage.setItem('active_tab','1');
                    window.location.replace('/indivisual/profile/{{encrypt(Auth::user()->id)}}')
                }
            });
        }
    </script>
@endsection

