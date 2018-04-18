@extends('layouts.app')
@section('content')
    <br></br>
    <div class="grid-form1">
        <div class="tab-content">
            <div>
                <h4 class="title">Research Name</h4>
                <p class="description">{{ $Research->name }}</p>
            </div>
            <div>
                <h4 class="title">Research Type</h4>
                <p class="description">{{ $Research->type }}</p>
            </div>
            <div>
                <h4 class="title">Broad Domain</h4>
                <p class="description">{{ $Research->broadDomain }}</p>
            </div>
            <div>
                <h5 class="title">Advisor</h5>
                @foreach($Research->member as $p)
                    @if($p->pivot['role'] == "Advisor")
                        <p class="description">{{  $p['firstName']." ".$p['lastName'] }}</p>
                    @endif
                @endforeach
                <h5 class="title">Research Member</h5>
                @foreach($Research->member as $p)
                    @if($p->pivot['role'] == "Researcher")
                        <p class="description">{{  $p['firstName']." ".$p['lastName'] }}</p>
                    @endif
                @endforeach
            </div>
            @if($Research->fundStatus == "1")
                <div>
                    <h4 class="title">Funding Organization</h4>
                    <p class="description">{{ $Research->fundingOrganization }}</p>
                    <h5 class="title">Fund Amount</h5>
                    <p class="description">{{ $Research->fundAmount }}</p>
                </div>
            @endif
            <div>
                <h4 class="title">Publications</h4>
                @foreach($ResearchPublication->publication as $item)
                    <p> {{ $item->name }} </p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
