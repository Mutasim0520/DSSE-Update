@extends('layouts.app')
@section('content')
<form role="form" method="POST" action="/update/{!! encrypt($members->member_id) !!}">
    {!! csrf_field() !!}
    <label>First Name</label>
    <input class="form-control" placeholder="Fisrt Name" name="firstname" type="text" autofocus=""  value="{!! $members->firstName !!}">
    <label>Last Name</label>
    <input class="form-control" placeholder="Last Name" name="lastname" type="text" value=" {!! $members->lastName !!}">
    <label>Position</label>
    <input class="form-control" placeholder="Position" name="position" type="text" autofocus="" value="{!! $members->position !!}">
    <label>E mail</label>
    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" value="{!! $members->email !!}">
    <label>Phone Number</label>
    <input class="form-control" placeholder="Phone Number" name="phonenumber" type="text" autofocus="" value="{!! $members->phone !!}">
    <label>Address</label>
    <input name="address" type="text"  name="Address" value="{!! $members->address !!}">
    <input type="submit" name="submit" class="btn btn-primary" value="Update">
</form>
@endsection