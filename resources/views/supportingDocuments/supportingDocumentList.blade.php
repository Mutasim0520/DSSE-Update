@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('header')
        <h2>Supporting Documents</h2>
@endsection
@section('content')
    <div class="col-md-12 add">
        <a href="/addSupportingDocs">
            <img id="add-publications" src="{{ asset('/images/icons/add-project.png') }}" data-toggle="tooltip" title="Add Supporting Docs" style="width:5em;border:0"/>
        </a>
    </div><div class="clearfix"></div>
    <div class="agile-tables" style="text-align: center">
            <table class="table table-striped">
                <thead>
                    <th>S/N</th>
                    <th>Document Name</th>
                    <th>Document Type</th>
                    <th>Download Link</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php $k = 1;?>
                    @foreach($Documents as $item)
                        <tr>
                            <td>{{$k}}</td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target = "#supportingDocDetail_{{$k}}">{{$item->title}}</a></td>
                            <td>{{strtoupper($item->type)}}</td>
                            <td><a href="{{$item->url}}">{{$item->url}}</a></td>
                            <td><a class="btn btn-danger" data-toggle="confirmation" data-title="Sure you want to delete?" href="javascript:deleteSupportingDoc({{$item->id}})" target="_blank">Delete</a></td>
                        </tr>
                        <?php $k++; ?>
                    @endforeach
                </tbody>
            </table>
    </div>
    <?php $i = 1;?>
    @foreach($Documents as $item)
        <div id="supportingDocDetail_{{$i}}" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{$item->title}}</h4>
                    </div>
                    <div class="modal-body">
                        <label>Uploaded By</label>
                        <p><a href="/memberProfile/{{encrypt($item['member']->member_id)}}">{{$item['member']->firstName}} {{$item['member']->lastName}}</a></p>
                        <label>Uploaded At</label>
                        <p>{{$item->created_at}}</p>
                        <label>Purpose</label>
                        <p>{{$item->purpose}}</p>
                        <label>Download Link</label>
                        <p><a href="{{$item->url}}">{{$item->url}}</a></p>
                    </div>
                </div>

            </div>
        </div>
        <?php $i++; ?>
    @endforeach
@endsection()
@section('scripts')
    <script src="/js/bootstrap-confirmation.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
            });
            var allowed = $('.d').get();
            $("#add-publications").mouseover(function (){
                $("#add-publications").attr("src","{{ asset('/images/icons/add-project-hover.png') }}");
                console.log("found");
            });
            $("#add-publications").mouseout(function (){
                $("#add-publications").attr("src","{{ asset('/images/icons/add-project.png') }}");
                console.log("found");
            });
        });
        function deleteSupportingDoc (id) {
            $.ajax({
                type:'POST',
                url:'/admin/deleteSD',
                data:{_token: "{{ csrf_token() }}",id:id
                },
                success: function( msg ) {
                    location.reload();
                }
            });
        }
    </script>
@endsection



