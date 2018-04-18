@extends('layouts.user')
@section('title')
   DSSE | {{$Publications->name}}
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
        <main class="hoc container clear" >
            <div class="group excerpts">
                <article class="full">
                    <figure class="list new-group">
                        <h4 class="item-head">{{$Publications->name}}</h4>
                        <div>
                            @if($Publications->publication_type == 'conference')
                                <span class="item-head"><span class="item-head">Published In: </span><a href="/publisherWiseItem/{{$Publications->conference_name}}">{{$Publications->conference_name}}</a></span><br>
                            @elseif($Publications->publication_type == 'journal')
                                    <span class="item-head"><span class="item-head">Published In: </span><a href="/publisherWiseItem/{{$Publications->publisher}}">{{$Publications->publisher}}</a></span><br>
                                    <span class="item-head"><span class="item-head">Journal Name: </span><a href="/journalWiseItem/{{$Publications->journal_name}}">{{$Publications->journal_name}}</a></span><br>
                                    <span class="item-head"><span class="item-head">Volume: </span>{{$Publications->volume}}</span><br>
                            @elseif($Publications->publication_type == 'book')
                                <span class="item-head"><a href="/publisherWiseItem/{{$Publications->publisher}}"><span class="item-head">Published In: </span>{{$Publications->publisher}}</a></span><br>
                            @endif

                            <span class="item-head"><?php $date = date("Y-m",strtotime($Publications->date)); echo date("M  Y", strtotime($date));?></span><br>
                            @if($Publications->page)
                                @if($Publications->publication_type != 'journal' || $Publications->publication_type != 'conference')
                                    <span class="item-head">PP: </span><span>{{$Publications->page}}</span><br>
                                @endif
                            @endif
                            @if($Publications->affiliated_institute)
                                <span><span class="item-head">Affiliated Institute: </span>{{$Publications->affiliated_institute}}</span><br>
                            @endif
                            @foreach($Publications['member'] as $item)
                                <span class="item-head"><i class="fa fa-user-circle" style="margin-right: 3px;"></i><a href="/MEMBERPROFILE/{{encrypt($item->member_id)}}">{{$item->firstName}} {{$item->lastName}}</a></span>, <span>{{$item->organization}}</span><br>
                            @endforeach
                            @if($Publications->external_author)
                                    @foreach ($Publications->external_author as $mem)
                                        <span class="item-head disabled"><i class="fa fa-user-circle" style="margin-right: 3px;"></i>{{$mem->name}}</span>

                                @endforeach
                                <br>
                            @endif
                            @if($Publications->fund_organization)
                                    <span class="item-head">Funded By: </span><span>{{$Publications->fund_organization}}</span><br>
                            @endif
                            @if(($Publications->project_id))
                                    <span class="item-head">Project: <a href="/indivisual/project/{{encrypt($Publications->project_id)}}">{{$Publications['project']->name}}</a></span><br>
                                @endif

                        </div>
                        <div>
                            <h5 class="item-head" style="padding-top: 5px; padding-bottom: 5px; border-bottom: 2px solid darkolivegreen;">Abstract</h5>
                            <?php echo $Publications->abstract;?>
                        </div>
                        <div>
                            <h5 class="item-head" style="padding-top: 5px; padding-bottom: 5px; border-bottom: 2px solid darkolivegreen;">Tags</h5>
                            @foreach($Publications['keyword'] as $item)
                                <span class="item-head"><i class="fa fa-tag" style="margin-right: 3px;"></i><a href="/tagWiseItem/{{encrypt($item->id)}}">{{$item->name}}</a></span>
                            @endforeach
                        </div>

                        <div>
                            <h5 class="item-head" style="padding-top: 5px; padding-bottom: 5px; border-bottom: 2px solid darkolivegreen;">Attachments</h5>
                            @if($Publications->src_code_file != "null")
                                <a href="/user/download/{{$Publications->src_code_file}}"><span class="item-head">Get Source Code
                                    </span><i class="fa fa-download"></i></a>
                                <br>
                            @endif
                            @if($Publications->src_code_url)
                                <a href="{{$Publications->src_code_url}}"><span class="item-head">Link To Source Code</span>
                                <i class="fa fa-link"></i></a><br>
                            @endif
                            @if($Publications->dataset_file !="null")
                                <a href="/user/download/{{$Publications->dataset_file}}"><span class="item-head">Download Dataset</span>

                                    <i class="fa fa-download"></i></a>
                                <br>
                            @endif
                            @if($Publications->dataset_url)
                                <a href="{{$Publications->dataset_url}}"><span class="item-head">Link To Dataset</span>
                                <i class="fa fa-link"></i></a><br>
                            @endif
                            @if($Publications->paper_path!= "null")
                                <a href="/user/download/{{$Publications->paper_path}}"><span class="item-head">Download Paper</span>
                                <i class="fa fa-download"></i></a><br>
                            @endif
                            @if($Publications->paper_url)
                                <a href="{{$Publications->paper_url}}"><span class="item-head">Link To Paper</span>
                                <i class="fa fa-link"></i></a><br>
                            @endif
                        </div>
                    </figure>
                </article>
            </div>
            <div class="clear"></div>
        </main>
    </div>
@endsection
@section('scripts')
@endsection