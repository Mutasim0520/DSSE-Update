@extends('layouts.user')
@section('page-title')
   Add Supporting Documents
@endsection
@section('style')
    <link type="text/css" href="/css/bootstrap-tagging.css" rel="stylesheet">
    <link type="text/css" href="/css/select2.css" rel="stylesheet">
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
            <div class="group excerpts">
                <article class="full">
                    <figure class="list new-group">
                        <form id="test-form" action="/admin/storeSupportingDocs" method="post" enctype="multipart/form-data" >
                            {!! csrf_field() !!}
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Title</label>
                                <input type="text" class="form-control" required="" name="title" autofocus="">
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="item-head log">Select Document Type</label>
                                <select class="selectpicker form-control" id="publication_type" name="doc_type" required>
                                    <option value=""> Select Document Type</option>
                                    <option value="dataset">Data Set</option>
                                    <option value="srs">SRS</option>
                                    <option value="src">Source Code</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="item-head log">Upload File</label>
                                <input type="file" class="form-control" name="file" autofocus="">
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="item-head log">Download URL</label>
                                <input type="url" class="form-control" name="url" autofocus="">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Purpose Of Document</label>
                                <textarea name="purpose" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="col-md-12 form-group" style="text-align: center">
                                <button class="btn" id="submit" name="submit" type = "submit">Add Document</button>
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
    <script src="/js/ckeditor/ckeditor.js"></script>
    {{--- tagging js --}}
    <script src="/js/bootstrap-tagging.js"></script>
    <script src="/js/select2.full.min.js"></script>
    <script src="/js/tapered.bundle.js"></script>
    {{--- validation js --}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="/js/validation/publicationValidation.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
@endsection

