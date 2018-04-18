@extends('layouts.user')
@section('title')
    DSSE | {{$Project->name}}
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
            <main class="hoc container clear" >
                <div class="group excerpts">
                    <article class="full">
                        <figure class="list new-group">
                            <h4 class="item-head">{{$Project->name}}</h4>
                            <div>
                                @if($Project->fundStatus == "1")
                                    <span class="item-head">Funded by: </span><span>{{$Project->fundingOrganization}}</span><br>
                                @endif
                                <span class="item-head">Status: </span>
                                @if($Project->status == "1") <span>Completed</span><br>
                                @else <span>Ongoing</span><br>
                                @endif
                                <span class="item-head">Started At: </span>
                                <span><?php $date = date("Y-m",strtotime($Project->start_date));echo date("M  Y", strtotime($date));?>
                            </span><br>
                                @if($Project->status == "1")
                                    <span class="item-head">Finished At:</span>
                                    <span> <?php $date = date("Y-m",strtotime($Project->finish_date)); echo date("M  Y", strtotime($date));?>
                                    </span>
                                    <br>
                                @endif
                                <span class="item-head">Project Manager</span><br>
                                @foreach($Project['member'] as $item)
                                    @if($item['pivot']->role =="Project Manager")
                                        <span class="item-head" style="margin-left:20px; "><i class="fa fa-user-circle" style="margin-right: 3px;"></i><a href="/MEMBERPROFILE/{{encrypt($item->member_id)}}">{{$item->firstName}} {{$item->lastName}}</a></span>, <span>{{$item->organization}}</span><br>
                                    @endif
                                @endforeach
                                <span class="item-head">Project Members</span><br>
                                @foreach($Project['member'] as $item)
                                    @if($item['pivot']->role =="Project Member")
                                        <span class="item-head" style="margin-left:20px; "><i class="fa fa-user-circle" style="margin-right: 3px;"></i><a href="/MEMBERPROFILE/{{encrypt($item->member_id)}}">{{$item->firstName}} {{$item->lastName}}</a></span>, <span>{{$item->organization}}</span><br>
                                    @endif
                                @endforeach
                                @if(sizeof($Project['publication'])>0)
                                    <span class="item-head">Publications</span><br>
                                    @foreach($Project['publication'] as $item)
                                        <a href="/indivisual/publication/{{encrypt($item['publication_id'])}}">{{$item->name}}</a><br>
                                    @endforeach
                                @endif
                            </div>
                            <div>
                                <h5 class="item-head" style="padding-top: 5px; padding-bottom: 5px; border-bottom: 2px solid darkolivegreen;">Overview</h5>
                                <?php echo $Project->description;?>
                            </div>
                            <div>
                                <h5 class="item-head" style="padding-top: 5px; padding-bottom: 5px; border-bottom: 2px solid darkolivegreen;">Tags</h5>
                                @if(sizeof($Project['keyword']))
                                    @foreach($Project['keyword'] as $item)
                                        <span class="item-head"><i class="fa fa-tag" style="margin-right: 3px;"></i><a href="/tagWiseItem/{{encrypt($item->id)}}">{{$item->name}}</a></span>
                                    @endforeach
                                @else No tags added
                                @endif

                            </div>

                            <div>
                                <h5 class="item-head" style="padding-top: 5px; padding-bottom: 5px; border-bottom: 2px solid darkolivegreen;">Attachments</h5>
                                @if($Project->src_code_path != "null")
                                    <span class="item-head">
                                <a href="/user/download/{{$Project->src_code_path}}">
                                    Get Source Code
                                    <i class="fa fa-download"></i></a></span>
                                    <br>
                                @endif
                                @if($Project->src_code_url)
                                    <span class="item-head">
                                <a href="{{$Project->src_code_url}}">
                                    Go To Source Code Link
                                    <i class="fa fa-link"></i></a></span>
                                    <br>
                                @endif
                                @if($Project->srs_path != "null")
                                    <span class="item-head">
                                <a href="/user/download/{{$Project->srs_path}}">
                                    Get SRS
                                    <i class="fa fa-download"></i></a></span>
                                    <br>
                                @endif
                                @if($Project->srs_url)
                                    <span class="item-head">
                                <a href="{{$Project->srs_url}}">
                                    Go To SRS Link
                                    <i class="fa fa-link"></i></a></span>
                                    <br>
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