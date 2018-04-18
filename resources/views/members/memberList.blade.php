@extends('layouts.app')
@section('stylesheet')
    <link href="/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
@endsection
@section('header')
    <h2 >Members</h2>
@endsection
@section('content')
    <div class="addmember-fa">
        <a href="/addmember"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
    </div>
        <div class ="col-md-12" id="col-md-10" style="float:left;">
            @foreach( $members as $member)
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="content">
                            <div class="author">
                                <a href="#">
                                    <img class="avatar border-gray" src="{{ asset('/images/').'/'.$member->photo }}"  alt="..."/>
                                    <h4 class="title"><a href="/memberProfile/{{ encrypt($member->member_id) }}">{!! $member->firstName ,' ',$member->lastName !!} </a><br />
                                        <small>{{$member->current_designation.','.$member->organization}}</small>
                                    </h4>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center" id="icon-div">
                            <a href="/updatemember/{!! encrypt($member->member_id) !!}" data-toggle="tooltip" title="Update" > <img src="{{ asset('/images/icons/update.png') }}" style="width:2.5em;border:0; margin-right:8px" /></a>
                            <a href="/deletemember/{!! encrypt($member->member_id) !!}" data-toggle="tooltip" title="Delete"> <img src="{{ asset('/images/icons/delete.png') }}" style="width:2.5em;border:0; margin-left:8px"/></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection()
@section('scripts')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection