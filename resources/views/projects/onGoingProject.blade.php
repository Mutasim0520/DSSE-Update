@extends('layouts.app')
@section('content')
    <ul>
        <li><a href="/addproject"> Add Project</a></li>
        <li><a href="/ongoingproject"> Ongoing Projects</a></li>
        <li><a href="/completeproject"> Complete Projects</a></li>
        <li><a href="/fundedproject"> Funded Projects</a></li>
        <li><a href="/nonfundedproject"> Non-Funded Projects</a></li>
    </ul>
    @if($status == "0")
        <h2>Ongoing Projects</h2>
    @endif
    @if($status == "1")
        <h2>Complete Projects</h2>
    @endif
    @if($fund == "1")
        <h2>Funded Projects</h2>
    @endif
    @if($fund == "0")
        <h2>Non-Funded Projects</h2>
    @endif
    <ul>
        @foreach($project as $Project)
            <li>
                <div>
                    <b>Project Name:  {!! $Project->name !!} </b>
                </div>
            </li>

        @endforeach
    </ul>
@endsection()