@extends('layouts.user')
@section('title')
    DSSE | Update Publication
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
                            <center id="loading" style="display: none;">
                                <H1 style="letter-spacing: 3px">Please Wait</H1>
                                <div class="loader"></div>
                            </center>
                            <form id="test-form" action="/storepublication" method="post" enctype="multipart/form-data" >
                                {!! csrf_field() !!}
                                <div class="col-md-12 form-group">
                                    <label class="item-head log">Title</label>
                                    <input class="form-control" type="text" required="" id = "publication_name" name="name" autofocus="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="item-head log">Abstract</label>
                                    <textarea  placeholder="Abstract" required="" id ="description" name="description" class="form-control ckeditor"></textarea>
                                </div>
                                <div class="col-md-9 form-group">
                                    <label class="item-head log">Authors</label>
                                    <select id="author" class="form-control select2" multiple="multiple" data-placeholder="Select authors" required name="authors[]" style="width: 100%;">
                                        @foreach($member as $item)
                                            <option value="{{$item->member_id}}">{{$item->firstName}} {{$item->lastName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-9 form-group">
                                    <label class="item-head log">Select External Authors</label>
                                    <select class="form-control select2" multiple="multiple" data-placeholder="Select External Author" name="external_authors[]" id="external_authors" style="width:100%;">
                                        @if(sizeof($keywords)>0)
                                            <option value="">Select External </option>
                                            @foreach($external_authors as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="">No External Author Available</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <button class="btn btn-default btn-sm" id="add_new_author" style="margin-top: 22%;">Add New External Author</button>
                                </div>
                                <input type="hidden" id="new_ex_auth_status" value="0">
                                <div class="col-md-12 form-group" id="new_author_container" style="display: none;">
                                    <label class="item-head log">New Externl Authors</label>
                                    <input type="text" data-role="tagsinput" name="additional_author" id="additional_author">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="item-head log">Select Publication Type</label>
                                    <select class="selectpicker form-control" id="publication_type" name="publication_type" required>
                                        <option value=""> Select Publication Type</option>
                                        <option value="book"> Book</option>
                                        <option value="journal"> Journal Paper</option>
                                        <option value="conference"> Conference Paper</option>
                                        <option value="thesis"> Thesis</option>
                                        <option value="other"> Other</option>
                                    </select>
                                </div>
                                <div id = "book_container" style="display: none;">
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" required="" placeholder="Chapter Name" name="book_chapter_name" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" required="" placeholder="Chapter" name="book_chapter" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" required="" placeholder="Edition" name="book_adition" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" required="" placeholder="Section" name="book_section" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" required="" placeholder="Page" name="book_page" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" required="" placeholder="Publisher" name="book_publisher" required>
                                    </div>
                                </div>
                                <div id = "conference_container" style="display: none;">
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" required="" placeholder="Page" name="conf_page">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" required="" placeholder="Conference Name" name="conf_publisher">
                                    </div>
                                </div>
                                <div id = "journal_container" style="display: none;">
                                    <div class="col-md-6 form-group">
                                        <input type="text" required="" class="form-control" placeholder="Page" name="journal_page">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" required="" class="form-control" placeholder="Volume" name="journal_volume">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" required="" class="form-control" placeholder="Publisher" name="journal_publisher">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <input type="text" required="" class="form-control" placeholder="Journal Name" name="journal_name">
                                    </div>
                                </div>
                                <div id = "thesis_container" style="display: none;">
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" required="" placeholder="Pages" name="thesis_page">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <select type="text" required="" class="form-control" placeholder="Select Supervisor" id="thesis_supervisor">
                                            <option value="">Select Supervisor</option>
                                            @foreach($member as $item)
                                                <option value="{{$item->member_id}}">{{$item->firstName}} {{$item->lastName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" placeholder="University" name="thesis_university">
                                    </div>

                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="item-head log">Select Date</label>
                                    <input type="date" required name="date" class="datepicker date form-control">
                                </div>
                                <div class="col-md-9 form-group">
                                    <label class="item-head log">Select Keywords</label>
                                    <select class="form-control select2" multiple="multiple" data-placeholder="Select key words" name="keywords[]" id="keywords" style="width:100%;">
                                        @if(sizeof($keywords)>0)
                                            <option value="">Select Keyword</option>
                                            @foreach($keywords as $item)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="">No Keyword Available</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <button class="btn btn-default btn-sm" id="add_keyword" style="margin-top: 22%;">Add new keyword</button>
                                </div>
                                <input type="hidden" id="has_new_keyword" value="0">
                                <div class="col-md-12 form-group" id="keywords_container" style="display: none;">
                                    <label class="item-head log">New Keywords</label>
                                    <input type="text" data-role="tagsinput" name="new_tags" id="new_keywords">
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-4 form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="project_status" value="0" style="display: inline-block;">
                                            Under Any Project?
                                        </label>
                                    </div>
                                    <div class="col-md-8" style="display:none;" id="project_container">
                                        <div class="col-md-6">
                                            <select autocomplete="on" id="project_name" class="form-control">
                                                <option value="">Select Project</option>
                                                @foreach($Project as $item)
                                                    <option value="{{$item->project_id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6" style="text-align: right">
                                            <a href="javascript:saveInSession();" class="btn btn-default btn-sm">Add New Project</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-12 form-check">
                                        <label class="form-check-label">
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
                                    <div class="col-md-6 form-check">
                                        <label>
                                            <input type="checkbox" name="aff_ins" value="0" style="display: inline-block;">
                                            Any Affiliated Institute?
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-group" id="inst_container" style="display:none;">
                                        <label class="item-head log">Name Of Institute</label>
                                        <input type="text" class="form-control" name="ins_name">
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
                                <div class="col-md-12 form-group">
                                    <div class="col-md-3 form-check">
                                        <label>
                                            <input type="checkbox" name="dataset" value="0" style="display: inline-block;">
                                            Any Dataset?</label>
                                    </div>
                                    <div class="col-md-9 form-group" id="dataset_container" style="display:none;">
                                        <div class="col-md-5">
                                            <label class="item-head log">Upload file</label>
                                            <input type="file" name="file" id="dataset">
                                        </div>
                                        <div class="col-md-7">
                                            <label class="item-head log">File URL</label>
                                            <input type="url" class="form-control" name="dataset_link">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Upload Paper</label>
                                    <input type="file" id="publication_paper">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="col-md-6 form-group">
                                        <label>
                                            <input type="checkbox" name="document_link" value="0" style="display: inline-block;">
                                            Add link to publication document?</label>
                                    </div>
                                    <div class="col-md-6 form-group" id="publication_link_container" style="display:none;">
                                        <label class="item-head log">File URL</label>
                                        <input type="url" class="form-control" name="publication_link">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group button" style="text-align: center">
                                    <button class="btn" id="submit" name="submit" type = "submit">Add Publication</button>
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
    {{--- validation js --}}
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
            $('#new_ex_auth_status').val(1);
            $('#new_author_container').show();
        });

        $('#add_keyword').click(function (e) {
            e.preventDefault();
            $('#keywords_container').show();

            $('#has_new_keyword').val(1);
        });

        $(document).ready(function() {
            $(".select2").select2();

            $( function() {
                $(".date").datepicker();
            } );
            var all_authors = JSON.parse('{!! $publication->member !!}');
            var authors = [];
            for(var i=0;i<all_authors.length;i++){
                authors.push(all_authors[i].member_id);
            }
            $("#author").val(authors).trigger('change');
            var default_ex_auth = JSON.parse('{!! $publication->external_author !!}');
            if(default_ex_auth.length>0){
                var ex_authors = [];
                for(var i=0;i<default_ex_auth.length;i++){
                    ex_authors.push(default_ex_auth[i].member_id);
                }
                $("#external_authors").val(ex_authors).trigger('change');
            }
            $('#publication_type').val('{{$publication->publication_type}}');

            if('{{$publication->publication_type}}' == 'conference'){
                $('#conference_container').show();
                $('input[name=conf_page]').val('{{$publication->page}}');
                $('input[name=conf_date]').datepicker({ dateFormat: 'mm/dd/yy'}).datepicker("setDate", new Date('{{$publication->date}}'));
                $('input[name=conf_publisher]').val('{{$publication->conference_name}}');
            }

            else if('{{$publication->publication_type}}' == 'book'){
                $('#book_container').show();
                $('input[name=book_chapter_name]').val('{{$publication->book_chapter_name}}');
                $('input[name=book_chapter]').val('{{$publication->book_chapter}}');
                $('input[name=book_adition]').val('{{$publication->book_addition}}');
                $('input[name=book_page]').val('{{$publication->page}}');
                $('input[name=book_date]').datepicker({ dateFormat: 'mm/dd/yy'}).datepicker("setDate", new Date('{{$publication->date}}'));
                $('input[name=book_publisher]').val('{{$publication->publisher}}');
            }

            else if('{{$publication->publication_type}}' == 'journal'){
                $('#journal_container').show();
                $('input[name=journal_page]').val('{{$publication->page}}');
                $('input[name=journal_date]').datepicker({ dateFormat: 'mm/dd/yy'}).datepicker("setDate", new Date('{{$publication->date}}'));
                $('input[name=journal_publisher]').val('{{$publication->publisher}}');
                $('input[name=journal_name]').val('{{$publication->journal_name}}');
                $('input[name=journal_volume]').val('{{$publication->volume}}');

            }

            else if('{{$publication->publication_type}}' == 'thesis'){
                $('#thesis_container').show();
                $('input[name=thesis_page]').val('{{$publication->page}}');
                $('input[name=thesis_date]').datepicker({ dateFormat: 'mm/dd/yy'}).datepicker("setDate", new Date('{{$publication->date}}'));
                $('input[name=thesis_university]').val('{{$publication->university}}');
                $('input[name=thesis_supervisor]').val('{{$publication->supervisor}}');
            }

            var keywords_all = JSON.parse('{!! $publication->keyword !!}');
            var keywords = [];
            for(var i=0;i<keywords_all.length;i++){
                console.log(keywords_all[i].name);
                keywords.push(keywords_all[i].name);
            }
            $("#keywords").val(keywords).trigger('change');
            if('{{$publication->project_id}}'){
                $('input[name=project_status]').attr('checked','checked');
                $('#project_container').show();
                $('#project_name').val('{{$publication->project_id}}');
            }

            if('{{$publication->fund_organization}}'){
                $('input[name=fund_status]').attr('checked', 'checked');
                $('#fund_ins_container').show();
                $('#fund_ins').attr('value','{{$publication->fund_organization}}');
            }
            if('{{$publication->affiliated_institute}}'){
                $('input[name=aff_ins]').attr('checked','checked');
                $('#inst_container').show();
                $('input[name=ins_name]').val('{{$publication->affiliated_institute}}');
            }

            if('{{$publication->src_code_file}}' || '{{$publication->src_code_url}}'){
                $('input[name=src_code]').attr('checked', 'checked');
                $('input[name=src_code]').val(1);
                $('#source_code_container').show();
                if('{{$publication->src_code_file}}') $('#src_file_exist').show();
                if('{{$publication->src_code_url}}') $('input[name=src_link]').attr('value','{{$publication->src_code_url}}');
            }

            if('{{$publication->dataset_file}}' || '{{$publication->dataset_url}}'){
                $('input[name=dataset]').attr('checked', 'checked');
                $('input[name=dataset]').val(1);
                $('#dataset_container').show();
                if('{{$publication->dataset_file}}') $('#dataset_file_exist').show();
                if('{{$publication->dataset_url}}') $('input[name=dataset_link]').attr('value','{{$publication->dataset_url}}');
            }
            if('{{$publication->paper_path}}'){
                $('#paper_file_exist').show();
            }
            if('{{$publication->paper_url}}'){
                $('input[name=document_link]').attr('checked','checked');
                $('#publication_link_container').show();
                $('input[name=publication_link]').val('{{$publication->paper_url}}');
            }

            if(localStorage.getItem('session_data')){
                var data = JSON.parse(localStorage.getItem('session_data'));
                $('#publication_name').val(data[0].name);
                CKEDITOR.instances['description'].setData(data[0].abstract);
                $('#description').text(data[0].abstract);
                var authors = data[0].authors;
                $("#author").select2().select2().val(authors).trigger('change');

                if(data[0].publication_type == 'book'){
                    var book_data = data[0].book[0];
                    $('input[name=book_adition]').val(book_data.edition);
                    $('input[name=book_chapter_name]').val(book_data.chapter_name);
                    $('input[name=book_chapter]').val(book_data.chapter);
                    $('input[name=book_section]').val(book_data.section);
                    $('input[name=book_date]').val(book_data.date);
                    $('input[name=book_publisher]').val(book_data.publisher);
                    $('input[name=book_page]').val(book_data.page);
                }

                else if(data[0].publication_type == 'conference'){
                    var conference_data = data[0].conference[0];
                    $('input[name=conf_date]').val(conference_data.date);
                    $('input[name=conf_publisher]').val(conference_data.publisher);
                    $('input[name=conf_page]').val(conference_data.page);
                }

                else if(data[0].publication_type == 'journal'){
                    var journal_data = data[0].journal[0];
                    $('input[name=journal_date]').val(journal_data.date);
                    $('input[name=journal_publisher]').val(journal_data.publisher);
                    $('input[name=journal_name]').val(journal_data.journal_name);
                    $('input[name=journal_volume]').val(journal_data.volume);
                    $('input[name=journal_page]').val(journal_data.page);
                }

                else if(data[0].publication_type == 'thesis'){
                    var thesis_data = data[0].thesis[0];
                    $('input[name=thesis_date]').val(thesis_data.date);
                    $('input[name=thesis_university]').val(thesis_data.university);
                    $('input[name=thesis_page]').val(thesis_data.page);
                    $('#thesis_supervisor:selected').val(thesis_data.supervisor);
                }

                var string ='#'+data[0].publication_type+'_container';

                if(data[0].publication_type){
                    $('#publication_type option[value='+data[0].publication_type+']').prop('selected',true);
                    $(string).show();
                }

                var keywords = data[0].keywords;
                var external_author = data[0].external_authors;
                console.log(external_author);

                $('#external_authors').val(external_author).trigger('change');
                $("#keywords").val(keywords).trigger('change');

                var new_keyword = data[0].new_keywords.split(",");
                var new_external_author = data[0].new_external_authors.split(",");

                if(new_keyword.length>0){
                    $('#has_new_keyword').val(1);
                    for(var i = 0;i<new_keyword.length;i++){
                        $('#new_keywords').tagsinput('add', new_keyword[i]);
                    }
                    $('#keywords_container').show();
                }

                if(new_external_author.length>0){
                    $('#new_ex_auth_status').val(1);
                    for(var i = 0;i<new_external_author.length;i++){
                        $('#additional_author').tagsinput('add', new_external_author[i]);
                    }
                    $('#new_author_container').show();
                }

            }

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
                    event.preventDefault();
                    event.stopPropagation();

                    $('#test-form').hide();
                    $('#loading').show();

                    var has_new_keyword = $('#has_new_keyword').val();
                    var has_new_ex_author = $('#new_ex_auth_status').val();
                    var src_code_path = "null";
                    var dataset_path = "null";
                    var paper_path = "null";

                    if(has_new_keyword == '1'){
                        var new_keywords = $('#new_keywords').tagsinput('items');
                        $.ajax({
                            url:"/user/storekeyword",
                            type:"post",
                            data:{ _token: "{{ csrf_token() }}",keywords:new_keywords},
                            success: function(msg){
                                console.log(msg);
                            }
                        });
                        console.log('has new ');
                    }

                    if(has_new_ex_author == '1'){
                        var new_external_authors = $('#additional_author').tagsinput('items');
                        $.ajax({
                            url:"/user/store/external/author",
                            type:"post",
                            data:{ _token: "{{ csrf_token() }}",external_authors:new_external_authors},
                            success: function(msg){
                                console.log(msg);
                            }
                        });
                        console.log('has new ');
                    }

                    if(file_counter == 2){
                        if(( $('#paper').prop('files')[0]) && ( $('#dataset').prop('files')[0])){
                            var file_data = $('#paper').prop('files')[0];
                            var form_data = new FormData();
                            form_data.append('file', file_data);
                            form_data.append('_token', $("input[name ='_token']").val());
                            $.ajax({
                                url: "/user/storefile",
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
                                        url: "/user/storefile",
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
                        else if(( $('#dataset').prop('files')[0]) && ( $('#publication_paper').prop('files')[0])){
                            var file_data = $('#publication_paper').prop('files')[0];
                            var form_data = new FormData();
                            form_data.append('file', file_data);
                            form_data.append('_token', $("input[name ='_token']").val());
                            $.ajax({
                                url: "/user/storefile",
                                type: "post",
                                data: form_data,
                                cache:false,
                                processData: false,
                                contentType: false,
                                success: function (path) {
                                    paper_path = path;
                                    var file_data_2 = $('#dataset').prop('files')[0];
                                    var form_data_2 = new FormData();
                                    form_data_2.append('file', file_data_2);
                                    form_data_2.append('_token', $("input[name ='_token']").val());

                                    $.ajax({
                                        url: "/user/storefile",
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
                        else if(( $('#publication_paper').prop('files')[0]) && ( $('#paper').prop('files')[0])){
                            var file_data = $('#paper').prop('files')[0];
                            var form_data = new FormData();
                            form_data.append('file', file_data);
                            form_data.append('_token', $("input[name ='_token']").val());
                            $.ajax({
                                url: "/user/storefile",
                                type: "post",
                                data: form_data,
                                cache:false,
                                processData: false,
                                contentType: false,
                                success: function (path) {
                                    src_code_path = path;
                                    var file_data_2 = $('#publication_paper').prop('files')[0];
                                    var form_data_2 = new FormData();
                                    form_data_2.append('file', file_data_2);
                                    form_data_2.append('_token', $("input[name ='_token']").val());

                                    $.ajax({
                                        url: "/user/storefile",
                                        type: "post",
                                        data: form_data_2,
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
                        console.log("totalfile" + file_counter);

                    }

                    else if(file_counter == 3){
                        console.log("totalfile" + file_counter);

                        var file_data = $('#paper').prop('files')[0];
                        var form_data = new FormData();
                        form_data.append('file', file_data);
                        form_data.append('_token', $("input[name ='_token']").val());
                        $.ajax({
                            url: "/user/storefile",
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
                                console.log(path);

                                $.ajax({
                                    url: "/user/storefile",
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
                                        console.log(path);

                                        $.ajax({
                                            url: "/user/storefile",
                                            type: "post",
                                            data: form_data_3,
                                            cache:false,
                                            processData: false,
                                            contentType: false,
                                            success: function (path) {
                                                paper_path = path;
                                                addPublication(src_code_path, dataset_path, paper_path);
                                                console.log(path);
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
                                url: "/user/storefile",
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
                                url: "/user/storefile",
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
                                url: "/user/storefile",
                                type: "post",
                                data: form_data_2,
                                cache:false,
                                processData: false,
                                contentType: false,
                                success: function (path) {
                                    paper_path = path;
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

        function addPublication(src_code_path, dataset_path, paper_path) {
            console.log(src_code_path);
            console.log(dataset_path);
            console.log(paper_path);
            console.log(file_counter);

            var publication_name = $("#publication_name").val();
            var abstract =  CKEDITOR.instances.description.getData();
            var author = $('#author').val();
            var publication_type = $('#publication_type').val();
            var keywords = $('#keywords').val();
            var external_author = $('#external_authors').val();
            var project_status = $('input[name=project_status]').val();
            var fund_status = $('input[name=fund_status]').val();
            var aff_ins = $('input[name=aff_ins]').val();
            var aff_ins_name = $('input[name=ins_name]').val();
            var src_code = $('input[name=src_code]').val();
            var dataset = $('input[name=dataset]').val();
            var date = $('input[name=date]').val();

            var book_adition = $('input[name=book_adition]').val();
            var book_publisher = $('input[name=book_publisher]').val();
            var book_chapter_name = $('input[name=book_chapter_name]').val();
            var book_chapter = $('input[name=book_chapter]').val();
            var book_section = $('input[name=book_section]').val();
            var book_page = $('input[name=book_page]').val();

            var conf_publisher  = $('input[name=conf_publisher]').val();
            var conf_page = $('input[name=conf_page]').val();

            var journal_publisher  = $('input[name=journal_publisher]').val();
            var journal_name  = $('input[name=journal_name]').val();
            var journal_volume = $('input[name=journal_volume]').val();
            var journal_page = $('input[name=journal_page]').val();

            var thesis_university = $('input[name=thesis_university]').val();
            var thesis_page = $('input[name=thesis_page]').val();
            var thesis_supervisor = $('#thesis_supervisor:selected').val();

            var fund_ins = $('#fund_ins').val();
            var fund_amount = $('#fund_amount').val();


            var src_link = $('input[name=src_link]').val();
            var data_link = $('input[name=dataset_link]').val();

            var new_keywords = $("#new_keywords").tagsinput('items');
            var additional_authors = $('#additional_author').tagsinput('items');
            var project_name = $('#project_name').val();
            var document_link = $('input[name=publication_link]').val();
            $.ajax({
                url:"/user/storepublication",
                type:"post",
                data:{ _token: "{{ csrf_token() }}",
                    date:date,
                    publication_name:publication_name,
                    publication_type:publication_type,
                    project_name:project_name,
                    abstract:abstract,
                    author:author,
                    keywords:keywords,
                    external_author:external_author,
                    new_keywords:new_keywords,
                    project_status:project_status,
                    fund_amount:fund_amount,
                    fund_ins:fund_ins,
                    aff_ins_name:aff_ins_name,
                    src_code_path:src_code_path,
                    src_code_link:src_link,
                    dataset_path:dataset_path,
                    dataset_link:data_link,
                    book_adition:book_adition,
                    book_publisher:book_publisher,
                    book_chapter_name:book_chapter_name,
                    book_chapter:book_chapter,
                    book_page:book_page,
                    book_section:book_section,
                    conf_page:conf_page,
                    conf_publisher:conf_publisher,
                    journal_volume:journal_volume,
                    journal_page:journal_page,
                    journal_publisher:journal_publisher,
                    journal_name:journal_name,
                    thesis_supervisor:thesis_supervisor,
                    thesis_university:thesis_university,
                    thesis_page:thesis_page,
                    additional_authors:additional_authors,
                    project_name:project_name,
                    paper_path:paper_path,
                    document_link:document_link,
                },
                success: function(msg){
                    localStorage.removeItem('session_data');
                    window.location.replace('/indivisual/profile/{{encrypt(Auth::user()->id)}}')
                    console.log(msg);
                }

            });
        }

        function saveInSession() {
            console.log("got");
            var session_publication = [];
            var book = [];
            var conference = [];
            var journal = [];
            var thesis = []

            book.push({
                edition: $('input[name=book_adition]').val(),
                chapter_name: $('input[name=book_chapter_name]').val(),
                chapter:$('input[name=book_chapter]').val(),
                section : $('input[name=book_section]').val(),
                date: $('input[name=book_date]').val(),
                publisher: $('input[name=book_publisher]').val(),
                page: $('input[name=book_page]').val()
            });

            journal.push({
                date: $('input[name=journal_date]').val(),
                publisher: $('input[name=journal_publisher]').val(),
                journal_name: $('input[name=journal_name]').val(),
                volume: $('input[name=journal_volume]').val(),
                page: $('input[name=journal_page]').val(),
            });

            conference.push({
                date: $('input[name=conf_date]').val(),
                publisher: $('input[name=conf_publisher]').val(),
                page: $('input[name=conf_page]').val(),
            });

            thesis.push({
                date: $('input[name=thesis_date]').val(),
                university:$('input[name=thesis_university]').val(),
                page: $('input[name=thesis_page]').val(),
                supervisor: $('#thesis_supervisor:selected').val(),
            });

            session_publication.push({
                name:$('#publication_name').val(),
                abstract:CKEDITOR.instances.description.getData(),
                authors:$('#author').val(),
                new_external_authors:$('#additional_author').val(),
                external_authors:$('#external_authors').val(),
                publication_type:$('#publication_type').val(),
                thesis:thesis,
                journal:journal,
                conference:conference,
                book:book,
                keywords:$('#keywords').val(),
                new_keywords:$("#new_keywords").val(),
            });
            localStorage.setItem('session_data', JSON.stringify(session_publication));
            window.location.replace('/add/publication/project');
        }
    </script>
@endsection



