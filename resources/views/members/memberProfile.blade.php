@extends('layouts.app')
@section('stylesheet')
    <link href="/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
@endsection
@section('header')
    <h2>Profile</h2>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card card-user">
            <div class="content">
                <div class="author">
                    <a href="#">
                        <img class="avatar border-gray" src="{{ asset('/images/1486574028.jpg') }}" alt="..."/>

                        <h4 class="title"><a href="/memberProfile/{{ encrypt($member->member_id) }}">{!! $member->firstName ,' ',$member->lastName !!} </a><br />
                            <small>{{$member->current_designation.','.$member->organization}}</small>
                        </h4>
                    </a>
                </div>
            </div>
            <hr>
            <div class="text-center" id="icon-div">
                <a href="#"> <img src="{{ asset('/images/icons/academia_bw.png') }}" style="width:2em;border:0" /></a>
                <a href="#"> <img src="{{ asset('/images/icons/academia_bw.png') }}" style="width:2em;border:0"/></a>
                <a href="#"> <img src="{{ asset('/images/icons/academia_bw.png') }}" style="width:2em;border:0"/></a>
                <a href="#"> <img src="{{ asset('/images/icons/academia_bw.png') }}" style="width:2em;border:0"/></a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav laddu-gp">
                    <li><button type="button" id="edu">Education</button></li>
                    <li><button type="button" id="Car">Carrer</button></li>
                    <li><button type="button" id="prj">Projects</button></li>
                    <li><button type="button" id="res">Researches</button></li>
                    <li><button type="button" id="Pub">Publications</button></li>
                    <li><button type="button" id="Other">Others</button></li>
                </ul>
            </div>
        </nav>
            <div class="col-md-12 laddu-tele" id="edu1" style ="visibility: hidden">
                <div class="content">
                    @foreach($MemberEducation->education as $item)
                   <div class="col-md-1"> <img src="{{asset('/images/icons/college.png')}}" style="width: 3.5em;height: 3.5em"></div>
                    <div class="col-md-11">
                            <h5 style="color: Black">{{ $item->institute }}</h5>
                            <span class="content-item">{{ $item->degree_name }}</span><span>,</span><span class="content-item">{{ $item->passing_year }}</span><br>
                            <span class="content-item" style="font-weight: bold">{{ $item->type }}: </span><span class="content-item">{{ $item->degree_subject}}</span><br>
                            @if($item->mentor !="")
                                <span class="content-item" style="font-weight: bold">Supervisor: </span><span class="content-item">{{ $item->mentor }}</span><br>
                            @endif
                        <br>
                    </div>
                    @endforeach
                </div>
            </div><div class="clearfix"></div>
        <div class="col-md-12 laddu-tele" id="car1" style="visibility: hidden">
            @foreach($MemberExperience->experience as $item)
                <span>{{ $item->organization_name }}</span>
                <span>{{ $item->designation }}</span>
                <span>{{ $item->start }}</span>
                <span>"-"</span>
                <span>{{ $item->end }}</span>
            @endforeach
        </div><div class="clearfix"></div>
        <div class="col-md-12 laddu-tele" style="visibility: hidden" id="prj1">
            <div class="content">
                @foreach($memberProject->project as $item)
                    <div class="col-md-1">
                        <img src="{{asset('/images/icons/project.png')}}" style="width: 2.5em;height: 3.5em">
                    </div>
                    <div class="col-md-11">
                        <span><a  href="/projectDetail/{{ encrypt($item->project_id) }}">{{ $item->name }}</a></span><br>
                        <span class="content-item" style="font-weight: bold"> Position:</span><span class="content-item"> {{ $item['pivot']->role }}</span><br>
                        <span class="content-item" style="font-weight: bold">Description: </span><span class="content-item">{{ $item->description }}</span><br><br>
                    </div>
                @endforeach
            </div>
        </div><div class="clearfix"></div>
        <div class="col-md-12 laddu-tele" style="visibility: hidden" id="pub1">
            @foreach($memberPublication->publication as $item)
                <a href="/publicationDetail/{{ encrypt($item->publication_id) }}" ><span>{{ $item->name }}</span></a>
            @endforeach
        </div><div class="clearfix"></div>
        <div class="col-md-12 laddu-tele" style="visibility: hidden" id="res1">
            @foreach($memberResearch->research as $item)
                <a href="/researchDetail/{{ encrypt($item->research_id) }}" ><span>{{ $item->name }}</span></a>
                <span>{{ $item['pivot']->role }}</span>
            @endforeach
        </div><div class="clearfix"></div>

    </div>

    @endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#prj").click(function () {
                $("#prj1").css("visibility", "visible");
            });
            $("#edu").click(function () {
                $("#prj1").css("visibility", "hidden");
                $("#edu1").css("visibility", "visible");

            });
        });
    </script>

@endsection