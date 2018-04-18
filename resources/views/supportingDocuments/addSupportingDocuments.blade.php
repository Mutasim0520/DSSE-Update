@extends('layouts.app')
@section('stylesheet')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/css/bootstrap-tagging.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('header')
    <h2>Add Supporting Docs</h2>
@endsection

@section('content')
    <div class="validation-system" style="margin-top: 50px;">
        <div class="validation-form">
            <form id="test-form" action="/admin/storeSupportingDocs" method="post" enctype="multipart/form-data" >
                {!! csrf_field() !!}
                <div class="col-md-12 form-group1">
                    <input type="text" placeholder="Title of document" required="" name="title" autofocus="">
                </div>

                <div class="col-md-6 form-group1">
                   <select class="selectpicker" id="publication_type" name="doc_type" required>
                       <option value=""> Select Document Type</option>
                       <option value="dataset">Data Set</option>
                       <option value="srs">SRS</option>
                       <option value="src">Source Code</option>
                       <option value="other">Other</option>
                   </select>
                </div>

                <div class="col-md-6 form-group1">
                    <select class="selectpicker" id="publication_type" name="doc_owner" required>
                        <option value=""> Select Owner Of Document</option>
                        @foreach($Members as $item)
                            <option value="{{$item->member_id}}">{{$item->firstName}} {{$item->lastName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group1">
                    <label class="item-head log">Upload File</label>
                    <input type="file" class="form-control" name="file" autofocus="">
                </div>

                <div class="col-md-12 form-group1">
                    <input type="url" placeholder="Documents Download Link" name="url" autofocus="">
                </div>
                <div class="col-md-12 form-group1">
                   <textarea name="purpose" rows="3" placeholder="Purpose of this document"></textarea>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    {{--- tagging js --}}
    <script src="/js/bootstrap-tagging.js"></script>
    <script src="/js/tapered.bundle.js"></script>
    {{--- validation js --}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="/js/validation/publicationValidation.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {

            $("#publication_type").on('change' ,function () {
                var publication_type = $("#publication_type").val();
                console.log(publication_type);
                if(publication_type == "book"){
                    $('#publication_book').clone().attr('type','text','required').insertAfter('#publication_book').prev().remove();
                    $('#con_name').clone().attr('type','text','required').insertAfter('#con_name').prev().remove();
                }
                else if(publication_type == "journal" || publication_type == "conference") {
                    $('#publication_book').clone().attr('type','hidden').insertAfter('#publication_book').prev().remove();
                    $('#con_name').clone().attr('type','text','required').insertAfter('#con_name').prev().remove();

                }
                else if(publication_type == "other") {
                    $('#publication_book').clone().attr('type','hidden').insertAfter('#publication_book').prev().remove();
                    $('#con_name').clone().attr('type','hidden').insertAfter('#con_name').prev().remove();

                }

            });
        });
    </script>

@endsection



