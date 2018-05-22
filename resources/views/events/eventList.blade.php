@extends('layouts.app')

@section('stylesheet')
@endsection
@section('header')
    <h2>Events</h2>
@endsection
@section('content')
    <div class="col-md-12 add">
        <a href="/admin/addevent">
            <img id="add-event" src="{{ asset('/images/icons/event.png') }}" data-toggle="tooltip" title="Add event" style="width:5em;border:0"/>
        </a>
    </div><div class="clearfix"></div>
    <div class="agile-tables" style="text-align: center">
        <table class="table table-striped">
            <thead>
            <th>S/N</th>
            <th>Event Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Place</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php $k = 1;?>
            @foreach($event as $item)
                <tr>
                    <td>{{$k}}</td>
                    <td><a href="javascript:void(0);" data-toggle="modal" data-target = "#eventDetail_{{$k}}">{{$item->name}}</a></td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->time}}</td>
                    <td>{{$item->place}}</td>
                    <td>
                        <a class="btn btn-danger" data-toggle="confirmation" data-title="Sure you want to delete?" href="javascript:deleteEvent({{$item->id}})" target="_blank">Delete</a>
                        <a class="btn btn-primary" href="/admin/update/event/{{$item->id}}">Update</a>
                    </td>
                </tr>
                <?php $k++;?>
            @endforeach
            </tbody>
        </table>
    </div>
    <?php $i = 1;?>
    @foreach($event as $item)
        <div id="eventDetail_{{$i}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{$item->name}}</h4>
                    </div>
                    <div class="modal-body">
                        <div style="display:inline-block; text-align: center; margin-bottom: 10px;">
                            @if(sizeof($item->events_photo)>0)
                                @foreach($item->events_photo as $image)
                                    <img src="/images/events/{{$image->path}}" style="height: 100px; width: 100px;border: 1px solid black; margin-right:5px; ">
                                @endforeach
                                @else
                                No image added to this event
                                @endif

                        </div>
                        <div style="display:inline-block;">
                            <span><i class="fa fa-calendar" style="margin-right: 3px;"></i>{{$item->date}}</span>
                            <span><i class="fa fa-clock-o" style="margin-right: 3px;"></i>{{$item->time}}</span>
                            <span><i class="fa fa-map-marker" style="margin-right: 3px;"></i>{{$item->place}}</span>
                            <p><?php echo $item->description;?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php $i++; ?>
    @endforeach
@endsection

@section('scripts')
    <script src="/js/bootstrap-confirmation.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            });
            $('[data-toggle="tooltip"]').tooltip();
            $("#add-event").mouseover(function (){
                $("#add-event").attr("src","{{ asset('/images/icons/event-hover.png') }}");
                console.log("found");
            });
            $("#add-event").mouseout(function (){
                $("#add-event").attr("src","{{ asset('/images/icons/event.png') }}");
                console.log("found");
            });
        });
        function deleteEvent(id) {
            $.ajax({
                type:'POST',
                url:'/admin/deleteEvent',
                data:{_token: "{{ csrf_token() }}",id:id
                },
                success: function( msg ) {
                    location.reload();
                }
            });
        }
    </script>
@endsection