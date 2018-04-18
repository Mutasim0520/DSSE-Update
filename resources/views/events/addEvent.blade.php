@extends('layouts.app')
@section('stylesheet')
@endsection
@section('header')
    <h2>Add Event</h2>
@endsection
@section('content')
    <div class="validation-system">
        <div class="validation-form">
            <form id="test-form" action="/storeEvent" method="post"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="col-md-12 form-group">
                    <input class="form-control" type="text" placeholder="Event Name" required="" id="eventName" name="eventName" autofocus="">
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control" type="text" name="place" placeholder="Event Place">
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control" id="datepicker1" type="text" name="eventDate" placeholder="Date">
                </div>
                <div class="form-group col-md-4">
                    <input id="timepicker1" type="text" name="time" placeholder="Time">
                </div>
                <div class="col-md-12 form-group">
                    <label class="control-label">Event Description</label>
                    <textarea  placeholder="Event Description" required="" id ="description" name="description" class="form-control ckeditor" ></textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label class="control-label">Upload Image</label>
                    <input class="form-control" type="file" name="image" />
                </div>
                <div class="col-md-12 form-group">
                    <button class="btn" id="submit" name="submit" type = "submit">Add Event</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/js/ckeditor/ckeditor.js"></script>
    <script src="/js/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'description',
            {
                customConfig : 'config.js',
                toolbar : 'simple'
            })
    </script>
    <script>
        $(document).ready(function(){
            $('#datepicker1').datepicker();
            $('#timepicker1').timepicker();
            $("#description").change(function (event) {
                var description = CKEDITOR.instances.description.getData();
                console.log(description);
            });
        });
    </script>
@endsection