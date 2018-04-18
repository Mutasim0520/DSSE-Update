@extends('layouts.app')
@section('stylesheet')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/css/bootstrap-tagging.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link type="text/css" href="/css/select2.css" rel="stylesheet">
@endsection
@section('header')
    <h2>Add Project</h2>
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="group excerpts">
                <article class="full">
                    <figure class="list new-group">
                        <form id="test-form" action="/storeproject" method="post">
                            {!! csrf_field() !!}
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Title</label>
                                <input class="form-control" type="text" required="" id="projectName" name="projectname" autofocus="">
                            </div><div class="clearfix"></div><br>
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Abstract</label>
                                <textarea  placeholder="Abstract" required="" id ="description" name="description" class="form-control ckeditor" ></textarea>
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
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select Project Manager"  id="pm" style="width: 100%;">
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
                                        <input type="radio" id="st1" required="" name="status" value="0"> Ongoing</label>
                                </div>
                                <div class="radio-inline">
                                    <label class="col-xsm-2 control-label">
                                        <input type="radio" id="st2" required="" name="status" value="1"> Completed</label>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="item-head log">Start Date</label>
                                <input type="text" class="form-control" id="startDate">
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
                                        <label class="item-head log">Upload file</label>
                                        <input type="file" name="file" id="paper">
                                    </div>
                                    <div class="col-md-7">
                                        <label class="item-head log">File URL</label>
                                        <input type="url"  class="form-control" name="src_link">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group" style="text-align: center">
                                <button class="btn" id="submit" name="submit" type = "submit">Add Project</button>
                            </div>
                            <div class="clearfix"> </div>
                        </form>
                    </figure>
                </article>
            </div>
        </main>
    </div>
@endsection

@section('scripts')
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="/js/bootstrap-tagging.js"></script>
    <script src="/js/tapered.bundle.js"></script>
    <script src="/js/select2.full.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="/js/validation/validation.js"></script>
    <script src="/js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        var file_counter = 0;
        CKEDITOR.replace( 'description',
            {
                customConfig : 'config.js',
                toolbar : 'simple'
            })
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
        $('#add_keyword').click(function (e) {
            e.preventDefault();
            $('#project_tag_container').show();
        });
        $('#paper').change(function () {
            file_counter = file_counter+1;
        });
        $(document).ready(function() {
            $(".select2").select2();
            ///get ckeditor data
            $("#description").change(function (event) {
                var description = CKEDITOR.instances.description.getData();
                console.log(description);
            });

            $( function() {
                $("#startDate").datepicker();
                $("#finishDate").datepicker();
            } );

            $("#projectTag").change(function(){
                var tag = $("#projectTag").val();
            });
            $('#st1').prop('checked', true);

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
                }
                else {
                    $('#finishContainer').css("display", "none");
                }
                console.log(status);
            });

            $("#test-form").submit(function (event) {
                if($(this).valid()){
                    event.preventDefault();
                    console.log(abstract);
                    console.log("event occured");
                    var newTags = $('#new_keywords').tagsinput('items');

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

                    if(file_counter>0){
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
                                    addProject(src_code_path);
                                }
                            });
                        }
                    }

                }
            });
        });

        function addProject(src_code_path) {
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
            var complete = status;
            var tags = $('#keywords').val();
            var newTags = $('#new_keywords').tagsinput('items');
            var src_code_url = $('input[name=src_link]').val();


            $.ajax({
                type: "POST",
                url: '/admin/storeproject',
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
                },
                success: function( msg ) {
                    console.log(msg);
                    window.location.replace('/admin/projectlist/5');
                }
            });
        }
    </script>
@endsection
