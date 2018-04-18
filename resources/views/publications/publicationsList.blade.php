@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('header')
        <h2>Publications</h2>
@endsection
@section('content')
    <div class="agile-tables">
            <table class="table table-striped">
                <tbody>
                <th>Publication Name</th>
                <th>Delete</th>
                <th>Update</th>

                @foreach($Publications as $Publication)
                    <tr>
                        <td>
                            <a href="/admin/publicationsDetail/{!! encrypt($Publication->publication_id) !!}">
                                <b> {!! $Publication->name !!} </b></a>
                        </td>
                        <td><a href="/deletepublication/{!! encrypt($Publication->publication_id) !!}"> <img class="d" src="{{ asset('/images/icons/delete.png') }}" data-toggle="tooltip" title="Delete" style="width:1.5em;border:0"/></a></td>
                        <td> <a href="/admin/updatepublication/{!! encrypt($Publication->publication_id) !!}"> <img src="{{ asset('/images/icons/update.png') }}" data-toggle="tooltip" title="Update" style="width:1.5em;border:0"/></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
@endsection()
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
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
    </script>
@endsection



