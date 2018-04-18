@extends('layouts.user')
@section('title')
DSSE | "{{$Result->name}}"
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
        <main class="hoc container clear" >
            <div class="group excerpts">
                @if(sizeof($Result->publication)>0)
                    @foreach($Result->publication as $item)
                        <article class="full">
                            <figure class="list new-group">
                                <span class="tag-data">{{strtoupper($item->publication_type)}} PAPER</span>
                                <div>
                                    @foreach($item->member as $item2)
                                        <a href="/MEMBERPROFILE/{{encrypt($item2->member_id)}}">
                                            @if($item2->publication_name)
                                                {{$item2->publication_name}}
                                            @else
                                                <?php
                                                $firstLetter = $item2->firstName;
                                                echo $firstLetter[0].('.').$item2->lastName;
                                                ?>
                                            @endif
                                        </a>,
                                    @endforeach
                                    <a style="color: darkolivegreen;" href="/indivisual/publication/{{encrypt($item->publication_id)}}">
                                        "{{ $item->name }}"
                                    </a>
                                    @if($item->publication_type == 'book')
                                        <span>
                                                "{{$item->book_chapter_name}}," in <i>{{$item->name}}</i>,{{$book_addition}} ed,
                                            </span>
                                    @elseif($item->publication_type == 'journal')
                                        <span>
                                                <a href="/journalWiseItem/{{$item->journal_name}}"><i>,{{$item->journal_name}}</i></a>,Vol.{{$item->volume}},
                                            </span>
                                    @endif
                                    @if($item->publication_type == 'conference')
                                        <a href="/publisherWiseItem/{{$item->conference_name}}">, <i>{{$item->conference_name}}</i></a>
                                    @elseif($item->publication_type == 'book' || $item->publication_type == 'journal')
                                        <a href="/publisherWiseItem/{{$item->publisher}}">, <i>{{$item->publisher}}</i></a>
                                    @else
                                        {{$item->thesis_completion_university}}
                                    @endif
                                    ,<?php $date = date("Y",strtotime($item->date)); echo date("Y", strtotime($date));?>, pp. {{$item->page}}.
                                </div>
                            </figure>
                        </article><br>
                    @endforeach
                @endif
                    @if(sizeof($Result->project)>0)
                        @foreach($Result->project as $item)
                            <article class="full">
                                <figure class="list new-group">
                                    <span class="tag-data">Project</span>
                                    <div>
                                        <h5 class="item-head" style="display: inline-block;"><a href="/indivisual/project/{{encrypt($item->project_id)}}">{{ $item->name }}</a></h5><br>
                                        <div>
                                            <?php echo $item->description;?>
                                        </div>
                                        <div>
                                            <span class=" item-head"> Status: </span>
                                            <span>
                                    @if($item->status == "1") Complete
                                                @else Ongoing
                                                @endif
                                    </span><br>
                                        </div>
                                    </div>
                                </figure>
                            </article>
                        @endforeach
                    @endif
            </div>
            <div class="clear"></div>
        </main>
    </div>
@endsection
@section('scripts')
@endsection