@extends('layouts.app')
@section('header')
    <h2>User Request Deatil</h2>
@endsection
@section('content')
    <div class="col-md-12 laddu-tele">
        <div class="agile-tables" style="text-align: center">
            <table class="table table-striped">
                <thead>
                <th>S/N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
                </thead>
                <tbody>
                <?php $k = 1;?>
                @foreach($User as $item)
                    <tr>
                        <td>{$k</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td><a href="/admin/acceptUser/{{encrypt($item->id)}}" class="btn btn-default">Accept</a>
                        <a href="/admin/rejectUser/{{encrypt($item->id)}}" class="btn btn-danger">Reject</a></td>
                    </tr>
                    <?php $k++;?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection