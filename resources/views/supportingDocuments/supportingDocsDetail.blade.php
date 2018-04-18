@extends('layouts.app')
@section('header')
    <h2>{{ $Publication->name }}</h2>
@endsection
@section('stylesheet')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="col-md-12 laddu-tele">
        <div class="col-md-4">
            <span class="title">Publication Type:</span>
            <span style="color: black">{{ $Publication->publication_type }}</span>
        </div>
        <div class="col-md-4">
            <span class="title">Authors</span>
            <?php $i=1; ?>
            @foreach($Publication->member as $p)
                <span class="small" style="font-weight: bold">
                    <?php
                    if($i==1) echo $i.'st author: ';
                    else if($i ==2 ) echo $i.'nd author: ';
                    else if($i ==3 ) echo $i.'rd author: ';
                    else echo $i.'th author: ';
                    ?></span>
                <a class="small" href="/memberProfile/{{ encrypt($p->member_id) }}">{{  $p['firstName']." ".$p['lastName']." " }}</a>
                <?php $i= $i+1; ?>
            @endforeach
        </div>
        <div class="col-md-4">
            <span class="title">Conference Name:</span>
            <span style="color: black">{{ $Publication->conference_name }}</span>
        </div>
        <div class="col-md-12">
            <span class="title">Book Name:</span>
            <span style="color: black">{{ $Publication->book_name }}</span>
        </div>
        <div class="col-md-12">
            <span class="title">Published Date:</span>
            <span style="color: black">{{ $Publication->date }}</span>
        </div>
        <div class="col-md-12">
            <span class="title">Download File:</span>
            <a href="download/{{ $Publication->url }}"><img src="{{ asset('/images/icons/download.png') }}" data-toggle="tooltip" title="Download File" style="width:2.5em;border:0"/></a>
        </div><div class="clearfix"></div>
    </div>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection


