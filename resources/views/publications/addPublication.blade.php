@extends('layouts.app')
@section('stylesheet')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/css/bootstrap-tagging.css" rel="stylesheet">
    <link type="text/css" href="/css/select2.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('header')
    <h2>Add Publication</h2>
@endsection
@section('content')
    <div class="validation-system">
        <div class="validation-form">
            <form id="test-form" action="/storepublication" method="post" enctype="multipart/form-data" >
                {!! csrf_field() !!}
                <div class="col-md-12 form-group1">
                    <input type="text" placeholder="Publication Name" required="" id = "publication_name" name="name" autofocus="">
                </div>
                <div class="col-md-12 form-group1">
                    <textarea  placeholder="Abstract" required="" id ="description" name="description" class="form-control ckeditor"></textarea>
                </div>
                <div class="col-md-12 form-group1">
                    <select id="author" class="form-control select2" multiple="multiple" data-placeholder="Select authors" required name="authors[]">
                        @foreach($member as $item)
                            <option value="{{$item->member_id}}">{{$item->firstName}} {{$item->lastName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group1">
                   <select class="selectpicker" id="publication_type" name="publication_type" required>
                       <option> Select Publication Type</option>
                       <option value="book"> Book</option>
                       <option value="journal"> Journal Paper</option>
                       <option value="conference"> Conference Paper</option>
                       <option value="thesis"> Thesis</option>
                       <option value="other"> Other</option>
                   </select>
                </div>
                <div class="col-md-3 form-group1">
                    <button class="btn btn-default" id="add_new_author">Add External Author</button>
                </div>
                <div class="col-md-6 form-group1" id="new_author_container" style="display: none;">
                    <input type="text" data-role="tagsinput" name="additional_author" id="additional_author">
                </div>
                <div id = "book_container" style="display: none;">
                    <div class="col-md-6 form-group1">
                        <input type="text" required="" placeholder="Adition" name="book_adition">
                    </div>
                    <div class="col-md-6 form-group1">
                        <input type="text" class="datepicker date" required="" placeholder="Published Date" name="book_date">
                    </div>
                    <div class="col-md-12 form-group1">
                        <input type="text" class="form-control" required="" placeholder="Publisher" name="book_publisher">
                    </div>
                </div>
                <div id = "conference_container" style="display: none;">
                    <div class="col-md-6 form-group1">
                        <input type="text" required="" placeholder="Page" name="conf_page">
                    </div>
                    <div class="col-md-6 form-group1">
                        <input type="text" class="datepicker date" required="" placeholder="Published Date" name="conf_date">
                    </div>
                    <div class="col-md-6 form-group1">
                        <input type="text" required="" placeholder="Conference Name" name="conf_publisher">
                    </div>
                </div>
                <div id = "journal_container" style="display: none;">
                    <div class="col-md-6 form-group1">
                        <input type="text" required="" placeholder="Page" name="journal_page">
                    </div>
                    <div class="col-md-6 form-group1">
                        <input type="text" required="" placeholder="Volume" name="journal_volume">
                    </div>
                    <div class="col-md-6 form-group1">
                        <input type="text" class="datepicker date" required="" placeholder="Published Date" name="journal_date">
                    </div>
                    <div class="col-md-6 form-group1">
                        <input type="text" required="" placeholder="Publisher" name="journal_publisher">
                    </div>

                    <div class="col-md-6 form-group1">
                        <input type="text" required="" placeholder="Journal Name" name="journal_name">
                    </div>
                </div>
                <div id = "thesis_container" style="display: none;">
                    <div class="col-md-6 form-group1">
                        <input type="text" required="" placeholder="Pages" name="thesis_page">
                    </div>
                    <div class="col-md-6 form-group1">
                        <select type="text" required="" placeholder="Select Supervisor" id="thesis_supervisor">
                            <option value="">Select Supervisor</option>
                            @foreach($member as $item)
                                <option value="{{$item->member_id}}">{{$item->firstName}} {{$item->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group1">
                        <input type="text" placeholder="University" name="thesis_university">
                    </div>
                    <div class="col-md-6 form-group1">
                        <input type="text" class="datepicker date" required="" placeholder="Published Date" name="thesis_date">
                    </div>
                </div>

                <div class="col-md-10 form-group1">
                    <select class="form-control select2" multiple="multiple" data-placeholder="Select key words" name="keywords[]" id="keywords" style="width: 100%;">
                       @foreach($keywords as $item)
                        <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-default btn-sm" id="add_keyword">Add new keyword</button>
                </div>
                <input type="hidden" id="has_new_keyword" value="0">
                <div class="col-md-12 form-group1" id="keywords_container" style="display: none;">
                    <input type="text" data-role="tagsinput" name="new_tags" id="new_keywords">
                </div>
                <div class="col-md-3">
                    <div class="col-md-6 form-group1">
                        <label>Project?</label>
                        <input type="checkbox" name="project_status" value="0">
                    </div>
                </div>
                <div class="col-md-9" style="display:none;" id="project_container">
                    <select autocomplete="on" id="project_name" class="form-control">
                        <option value="">Select Project</option>
                        @foreach($Project as $item)
                            <option value="{{$item->project_id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 form-group1">
                        <label>Funded?</label>
                        <input type="checkbox" name="fund_status" value="0">
                    </div>
                    <div class="col-md-6 form-group1" id="fund_ins_container" style="display:none;">
                        <input type="text" placeholder="Funding Institute" id="fund_ins">
                    </div>
                    <div class="col-md-6 form-group1" id="fund_amount_container" style="display:none;">
                        <input type="text" placeholder="Fund Amount" id="fund_amount" value="0">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 form-group1">
                        <label>Affiliated Institute?</label>
                        <input type="checkbox" name="aff_ins" value="0">
                    </div>
                    <div class="col-md-12 form-group1" id="inst_container" style="display:none;">
                        <input type="text" name="ins_name" placeholder="Institute Name">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-12 form-group1">
                        <label>Source Code</label>
                        <input type="checkbox" name="src_code" value="0">
                    </div>
                    <div class="col-md-6 form-group1" id="source_code_container" style="display:none;">
                        <label class="control-label">Upload file</label>
                        <input type="file" name="file" id="paper">
                        <input type="url" placeholder="Enter Download Link" name="src_link">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-12 form-group1">
                        <label>Dataset?</label>
                        <input type="checkbox" name="dataset" value="0">
                    </div>
                    <div class="col-md-6 form-group1" id="dataset_container" style="display:none;">
                        <label class="control-label">Upload file</label>
                        <input type="file" name="file" id="dataset">
                        <input type="url" placeholder="Enter Download Link" name="dataset_link">
                    </div>
                </div>
                <div class="col-md-12">
                    <label>Upload Paper</label>
                    <input type="file" id="publication_paper">
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 form-group1">
                        <label>Add link to publication document?</label>
                        <input type="checkbox" name="document_link" value="0">
                    </div>
                    <div class="col-md-6 form-group1" id="publication_link_container" style="display:none;">
                        <input type="url" placeholder="Enter Download Link" name="publication_link">
                    </div>
                </div>

                <div class="col-md-12 form-group1 sbutton">
                    <button class="btn-lg laddu" id="submit" name="submit" type = "submit">Add</button>
                </div>
                <div class="clearfix"> </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="/js/ckeditor/ckeditor.js"></script>
    {{--- tagging js --}}
    <script src="/js/bootstrap-tagging.js"></script>
    <script src="/js/select2.full.min.js"></script>
    <script src="/js/tapered.bundle.js"></script>
    {{--- validation js --}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="/js/validation/publicationValidation.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

    <script>
        var file_counter =0;
        $('#paper').change(function () {
            file_counter = file_counter+1;
        });
        $('#dataset').change(function () {
            file_counter = file_counter+1;
        });
        $('#publication_paper').change(function () {
            file_counter = file_counter+1;
        });

        $('input[name=project_status]').change(function () {
            if($('input[name=project_status]').is(":checked")){
                $('input[name=project_status]').val(1);
                $('#project_container').show();
                $('#project_name').attr("required",true);
            }
            else {
                $('input[name=project_status]').val(0);
                $('#project_container').css('display','none');
                $('#project_name').attr("required",false);
            }
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

        $('input[name=aff_ins]').change(function () {
            if($('input[name=aff_ins]').is(":checked")){
                $('input[name=aff_ins]').val(1);
                $('#inst_container').show();
            }
            else{
                $('#inst_container').css('display','none');
                $('input[name=aff_ins]').val(0);
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
        $('input[name=document_link]').change(function () {
            if($('input[name=document_link]').is(":checked")){
                $('input[name=document_link]').val(1);
                $('#publication_link_container').show();
            }
            else{
                $('#publication_link_container').css('display','none');
                $('input[name=document_link]').val(0);
                console.log("hikikjkj");
            }
        });
        $('input[name=dataset]').change(function () {
            if($('input[name=dataset]').is(":checked")){
                $('input[name=dataset]').val(1);
                $('#dataset_container').show();
            }
            else{
                $('input[name=dataset]').val(0);
                $('#dataset_container').css('display','none');
                console.log("hikikjkj");
            }
        });
        $('#add_new_author').click(function (e) {
            e.preventDefault();
            $('#new_author_container').show();
        });
        $(document).ready(function() {
            CKEDITOR.replace( 'description',
                {
                    customConfig : 'config.js',
                    toolbar : 'simple'
                });
            $(".select2").select2();
            $( function() {
                $(".date").datepicker();
            } );

            $("#publication_type").on('change' ,function () {
                var publication_type = $("#publication_type").val();
                console.log(publication_type);
                if(publication_type == "book"){
                    $('#book_container').show();
                    $('#journal_container').css('display','none');
                    $('#conference_container').css('display','none');
                    $('#thesis_container').css('display','none');
                }
                else if(publication_type == "journal") {
                    $('#book_container').css('display','none');
                    $('#journal_container').show();
                    $('#conference_container').css('display','none');
                    $('#thesis_container').css('display','none');
                }
                else if(publication_type == "other") {
                    $('#book_container').css('display','none');
                    $('#journal_container').css('display','none');
                    $('#conference_container').css('display','none');
                    $('#thesis_container').css('display','none');
                }
                else if(publication_type == "conference") {
                    $('#book_container').css('display','none');
                    $('#journal_container').css('display','none');
                    $('#conference_container').show();
                    $('#thesis_container').css('display','none');
                }
                else if(publication_type == "thesis") {
                    $('#book_container').css('display','none');
                    $('#journal_container').css('display','none');
                    $('#conference_container').css('display','none');
                    $('#thesis_container').show();
                }

            });
            $("#test-form").submit(function (event) {
                if($(this).valid()){
                    event.stopPropagation();
                    event.preventDefault();
                    var has_new_keyword = $('#has_new_keyword').val();
                    var src_code_path = "null";
                    var dataset_path = "null";
                    var paper_path = "null";

                    if(has_new_keyword == '1'){
                        $.ajax({
                            url:"/storekeyword",
                            type:"post",
                            data:{ _token: "{{ csrf_token() }}",keywords:new_keywords},
                            success: function(msg){
                                console.log(msg);
                            }
                        });
                    }

                    if(file_counter == 2){
                        console.log("totalfile" + file_counter);
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
                                var file_data_2 = $('#dataset').prop('files')[0];
                                var form_data_2 = new FormData();
                                form_data_2.append('file', file_data_2);
                                form_data_2.append('_token', $("input[name ='_token']").val());

                                $.ajax({
                                    url: "/storefile",
                                    type: "post",
                                    data: form_data_2,
                                    cache:false,
                                    processData: false,
                                    contentType: false,
                                    success: function (path) {
                                        dataset_path = path;
                                        addPublication(src_code_path, dataset_path, paper_path);
                                    }
                                });
                            }
                        });

                    }

                    else if(file_counter == 3){
                        console.log("totalfile" + file_counter);

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
                                var file_data_2 = $('#dataset').prop('files')[0];
                                var form_data_2 = new FormData();
                                form_data_2.append('file', file_data_2);
                                form_data_2.append('_token', $("input[name ='_token']").val());

                                $.ajax({
                                    url: "/storefile",
                                    type: "post",
                                    data: form_data_2,
                                    cache:false,
                                    processData: false,
                                    contentType: false,
                                    success: function (path) {
                                        dataset_path = path;
                                        var file_data_3 = $('#publication_paper').prop('files')[0];
                                        var form_data_3 = new FormData();
                                        form_data_3.append('file', file_data_3);
                                        form_data_3.append('_token', $("input[name ='_token']").val());

                                        $.ajax({
                                            url: "/storefile",
                                            type: "post",
                                            data: form_data_3,
                                            cache:false,
                                            processData: false,
                                            contentType: false,
                                            success: function (path) {
                                                paper_path = path;
                                                addPublication(src_code_path, dataset_path, paper_path);
                                            }
                                        });
                                    }
                                });
                            }
                        });

                    }

                    else if(file_counter == 1){
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
                                    addPublication(src_code_path,dataset_path, paper_path);
                                }
                            });
                        }
                        else if(( $('#dataset').prop('files')[0])){
                            var file_data_2 = $('#dataset').prop('files')[0];
                            var form_data_2 = new FormData();
                            form_data_2.append('file', file_data_2);
                            form_data_2.append('_token', $("input[name ='_token']").val());

                            $.ajax({
                                url: "/storefile",
                                type: "post",
                                data: form_data_2,
                                cache:false,
                                processData: false,
                                contentType: false,
                                success: function (path) {
                                    dataset_path = path;
                                    addPublication(src_code_path,dataset_path, paper_path);
                                }
                            });
                        }

                        else if(( $('#publication_paper').prop('files')[0])){
                            var file_data_2 = $('#publication_paper').prop('files')[0];
                            var form_data_2 = new FormData();
                            form_data_2.append('file', file_data_2);
                            form_data_2.append('_token', $("input[name ='_token']").val());

                            $.ajax({
                                url: "/storefile",
                                type: "post",
                                data: form_data_2,
                                cache:false,
                                processData: false,
                                contentType: false,
                                success: function (path) {
                                    dataset_path = path;
                                    addPublication(src_code_path,dataset_path, paper_path);
                                }
                            });
                        }

                    }

                    else{
                        addPublication(src_code_path, dataset_path, paper_path);
                    }

                }
            });
        });



        $('#add_keyword').click(function ( e) {
            event.preventDefault(e);
            $('#keywords_container').show();
            $('#has_new_keyword').val(1);
        });

        function addPublication(src_code_path, dataset_path, paper_path) {
            console.log(src_code_path);
            console.log(dataset_path);
            console.log(paper_path);
            console.log(file_counter);
            var publication_name = $("#publication_name").val();
            var abstract =  CKEDITOR.instances.description.getData();
            var author = ($('#author').val());
            var publication_type = $('#publication_type').val();
            var keywords = $('#keywords').val();
            var project_status = $('input[name=project_status]').val();
            var fund_status = $('input[name=fund_status]').val();
            var aff_ins = $('input[name=aff_ins]').val();
            var aff_ins_name = $('input[name=ins_name]').val();
            var src_code = $('input[name=src_code]').val();
            var dataset = $('input[name=dataset]').val();

            var book_date = $('input[name=book_date]').val();
            var book_adition = $('input[name=book_adition]').val();
            var book_publisher = $('input[name=book_publisher]').val();

            var conf_date = $('input[name=conf_date]').val();
            var conf_publisher  = $('input[name=conf_publisher]').val();
            var conf_page = $('input[name=conf_page]').val();

            var journal_date = $('input[name=journal_date]').val();
            var journal_publisher  = $('input[name=journal_publisher]').val();
            var journal_name  = $('input[name=journal_name]').val();
            var journal_volume = $('input[name=journal_volume]').val();
            var journal_page = $('input[name=journal_page]').val();

            var thesis_date = $('input[name=thesis_date]').val();
            var thesis_university = $('input[name=thesis_university]').val();
            var thesis_page = $('input[name=thesis_page]').val();
            var thesis_supervisor = $('#thesis_supervisor:selected').val();

            var fund_ins = $('#fund_ins').val();
            var fund_amount = $('#fund_amount').val();


            var src_link = $('input[name=src_link]').val();
            var data_link = $('input[name=dataset_link]').val();

            var new_keywords = $("#new_keywords").tagsinput('items');
            var additional_authors = $('#additional_author').val();
            var project_name = $('#project_name').val();
            var document_link = $('input[name=publication_link]').val();
            $.ajax({
                url:"/user/storepublication",
                type:"post",
                data:{ _token: "{{ csrf_token() }}",
                    publication_name:publication_name,
                    publication_type:publication_type,
                    abstract:abstract,
                    author:author,
                    keywords:keywords,
                    newKeywords:new_keywords,
                    project_status:project_status,
                    fund_amount:fund_amount,
                    fund_ins:fund_ins,
                    aff_ins_name:aff_ins_name,
                    src_code_path:src_code_path,
                    src_code_link:src_link,
                    dataset_path:dataset_path,
                    dataset_link:data_link,
                    book_date:book_date,
                    book_adition:book_adition,
                    book_publisher:book_publisher,
                    conf_date:conf_date,
                    conf_page:conf_page,
                    conf_publisher:conf_publisher,
                    journal_date:journal_date,
                    journal_volume:journal_volume,
                    journal_page:journal_page,
                    journal_publisher:journal_publisher,
                    journal_name:journal_name,
                    thesis_date:thesis_date,
                    thesis_supervisor:thesis_supervisor,
                    thesis_university:thesis_university,
                    thesis_page:thesis_page,
                    additional_authors:additional_authors,
                    project_name:project_name,
                    paper_path:paper_path,
                    document_link:document_link,
                },
                success: function(msg){
                    window.location.replace('/indivisual/profile/{{encrypt(auth::user()->id)}}');
                    console.log(msg);
                }

            });
        }
    </script>
@endsection



