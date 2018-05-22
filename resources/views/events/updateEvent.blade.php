@extends('layouts.app')
@section('stylesheet')
@endsection
@section('header')
    <h2>Add Event</h2>
@endsection
@section('content')
    <div class="validation-system">
        <div class="validation-form">
            <form id="test-form" action="/admin/update/event/{{$event->id}}" method="post"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="col-md-12 form-group">
                    <label class="control-label">Event Name</label>
                    <input value="{{$event->name}}" class="form-control" type="text" placeholder="Event Name" required="" id="eventName" name="eventName" autofocus="">
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Event Place</label>
                    <input value="{{$event->place}}" class="form-control" type="text" name="place" placeholder="Event Place">
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Event Date</label>
                    <input value="{{$event->date}}" class="form-control" id="datepicker1" type="text" name="eventDate" placeholder="Date">
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Event Time</label>
                    <input value="{{$event->time}}" id="timepicker1" class="form-control" type="text" name="time" placeholder="Time">
                </div>
                <div class="col-md-12 form-group">
                    <label class="control-label">Event Description</label>
                    <textarea  placeholder="Event Description" required="" id ="description" name="description" class="form-control ckeditor" >
                        <?php echo $event->description; ?>
                    </textarea>
                </div>
                <div class="col-md-6 form-group">
                    @if(sizeof($event->events_photo)>0)
                        @foreach($event->events_photo as $item)
                            <img src="/images/events/{{$item->path}}" style="height: 100px; width: 100px;border: 1px solid black; margin-right:5px; ">
                        @endforeach
                        <br>
                    @endif
                    <label class="control-label">Upload Image</label>
                    <input class="form-control" type="file" multiple accept="image/*" name="images[]" />
                </div>
                <div class="col-md-12 form-group">
                    <button class="btn" id="submit" name="submit" type = "submit">Update Event</button>
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