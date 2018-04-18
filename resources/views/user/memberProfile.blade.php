@extends('layouts.user')
@section('style')
    <link href="/css/user/light-bootstrap-dashboard.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection
@section('title')
    DSSE | {!! $member->firstName ,' ',$member->lastName !!}
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear tab-content" style="margin-top: 50px;">
            <div class="card card-user" style="background-image: url('/images/frontend/backgrounds/04.jpg');">
                <div class="content">
                    <div class="author">
                        @if($member->photo)
                            <img class="avatar border-gray" src="{{ asset('/images/').'/'.$member->photo }}" alt="..."/>
                        @else
                            <img class="avatar border-gray" src="{{ asset('/images/user/user.png')}}" alt="..." style="background-color: white"/>
                        @endif
                        <h4 class="title">{!! $member->firstName ,' ',$member->lastName !!}<br />
                            <small>{{$member->current_designation.','.$member->organization}}</small>
                        </h4>
                    </div>
                </div>
                <footer>
                    <ul class="faico clear">
                        <?php
                        $google_url = 'javascript:void(0)';
                        $researchgate_url = 'javascript:void(0)';
                        $academia_url = 'javascript:void(0)';
                        $dblp_url = 'javascript:void(0)';
                        ?>
                        @if(sizeof($social_accounts->social_account)>0)
                            @foreach($social_accounts->social_account as $item)
                                @if($item->name == 'google')
                                    <?php $google_url = $item->url; ?>
                                @endif
                                @if($item->name == 'ac')
                                    <?php $academia_url = $item->url; ?>
                                @endif
                                @if($item->name == 'rg')
                                    <?php $researchgate_url = $item->url; ?>
                                @endif
                                @if($item->name == 'dblp')
                                    <?php $dblp_url = $item->url; ?>
                                @endif
                            @endforeach
                        @endif
                        <li><a href="{{$google_url}}"><img src="/images/user/google.png" class="pp"></a></li>
                        <li><a href="{{$academia_url}}"><img src="/images/user/AC.jpeg" class="pp"></a></li>
                        <li><a href="{{$researchgate_url}}"><img src="/images/user/RG.png" class="pp"></a></li>
                        <li><a href="{{$dblp_url}}"><img src="/images/user/DBLP.png" class="pp"></a></li>
                    </ul>
                </footer>
            </div><br>
            <div class="memberMenu">
                @include('partials/user._memnav')
            </div><br>

            <div id="publication-tab" class="tab-pane fade in active ">
                <div class="section-head"> Publications</div><br>
                @if(sizeof($paper_years)>0)
                    <div class="col-md-2">
                        <ul class="nav nav-pills nav-stacked">
                            <?php $paper_year = 0; ?>
                            @foreach($paper_years as $item)
                                @if($paper_year == 0)
                                    <li class="active">
                                        <a href="#paper_{{$item}}" data-toggle="tab">{{$item}}</a>
                                    </li>
                                @else
                                    <li><a href="#paper_{{$item}}" data-toggle="tab">{{$item}}</a></li>
                                @endif
                                <?php $paper_year++; ?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-10 tab-content">
                        <?php
                        $counter = 0;
                        ?>
                        @foreach($paper_years as $year)
                            @if($counter == 0)
                                <div class="tab tab-pane fade in active" id="book_{{$year}}">
                                    <div class="group excerpts">
                                        @foreach($memberPublication->publication as $item)
                                                @if(intval($year) == intval(date('Y',strtotime($item->date))))
                                                @if($item->publication_type == "book")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "journal")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "conference")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "thesis")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "other")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class = "tab tab-pane fade" id="paper_{{$year}}">
                                    <div class="group excerpts">
                                        @foreach($memberPublication->publication as $item)
                                                @if(intval($year) == intval(date('Y',strtotime($item->date))))
                                                @if($item->publication_type == "book")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "journal")
                                                    <article class="full">
                                                            <figure class="list member_item">
                                                                <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                                <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                                <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                            </figure>
                                                        </article>
                                                @elseif($item->publication_type == "conference")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "thesis")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "other")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <?php
                            $counter++;
                            ?>
                        @endforeach
                    </div>
                @else
                    <div class="col-md-10">
                        <p>No Record Added </p>
                    </div>
                @endif

            </div>

            <div id="contact-tab" class="tab-pane fade">
                <div class="section-head">Contact
                </div><br>
                <div class="group excerpts">
                    <p>No Record Added</p>
                </div>
            </div>

            <div id="education-tab" class="tab-pane fade">
                <div class="section-head">Education</div><br>
                <div class="group excerpts">
                    @foreach($MemberEducation->education as $item)
                        <article class="full">
                            <div class="hgroup" style="padding-bottom: 10px;">
                                <h6 class="heading">{{ $item->degree_name }}</h6>
                                <small class="item-head">{{$item->passing_year }}</small>
                            </div>
                            <hr>
                            <figure class="edu">
                                <div>
                                    <p class="item-head">
                                        {{ $item->institute }}
                                    </p>
                                    <p> <span class="item-head">Subject: </span> {{ $item->degree_subject }}</p>
                                    @if($item->thesis)
                                        <p><span class="item-head">Thesis: </span>{{$item->thesis}}</p>
                                        <p><span class="item-head">Supervisor: </span>{{ $item->supervisor}}</p>
                                    @endif

                                </div>
                            </figure>
                        </article>
                    @endforeach
                    @if(sizeof($MemberEducation->education)==0)
                        <p>No Record Added</p>
                        @endif
                </div>
            </div>

            <div id="career-tab" class="tab-pane fade">
                <div class="section-head">Career</div><br>
                <div class="group excerpts">
                    @foreach($MemberExperience->experience as $item)
                        <article class="full">
                            <figure class="edu">
                                <span class="item-head">Organization: </span> <span>{{ $item->organization_name }}</span><br>
                                <span class="item-head">Designation: </span><span>{{ $item->designation }}</span><br>
                                <span class="item-head">{{ $item->duration }}</span><br>
                            </figure>
                        </article>
                    @endforeach
                    @if(sizeof($MemberExperience->experience)== 0)
                            <p>No Record Added</p>
                        @endif
                </div>
            </div>

            <div id="project-tab" class="tab-pane fade">
                <div class="section-head">Projects</div>
                <div class="col-md-2">
                    <ul class="nav nav-pills nav-stacked">
                        <?php $project_year = 0; ?>
                        @foreach($project_years as $item)
                            @if($project_year == 0)
                                <li class="active">
                                    <a href="#proj_{{$item}}" data-toggle="tab">{{$item}}</a>
                                </li>
                            @else
                                <li><a href="#proj_{{$item}}" data-toggle="tab">{{$item}}</a></li>
                            @endif
                            <?php $project_year++; ?>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-10 tab-content">
                    <?php
                    $counter = 0;
                    ?>
                    @foreach($project_years as $year)
                        @if($counter == 0)
                            <div class="tab tab-pane fade in active" id="proj_{{$year}}">
                                <div class="group excerpts">
                                    <?php $has_project = 'false'; ?>
                                    @foreach($memberProject->project as $item)
                                        @if(intval($year) == intval(date('Y',strtotime($item->start_date))))
                                            <article class="full">
                                                <figure class="list member_item">
                                                    <span class=" item-head"> Name: </span><span><a href="/indivisual/project/{{encrypt($item->project_id)}}">{{ $item->name }}</a></span><br>
                                                    <?php
                                                    echo $item->description;
                                                    ?><br>
                                                </figure>
                                            </article>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class = "tab tab-pane fade" id="proj_{{$year}}">
                                <div class="group excerpts">
                                    <?php $has_project = 'false'; ?>
                                    @foreach($memberProject->project as $item)
                                        @if(intval($year) == intval(date('Y',strtotime($item->start_date))))
                                            <article class="full">
                                                <figure class="list member_item">
                                                    <span class=" item-head"> Name: </span><span><a href="/indivisual/project/{{encrypt($item->project_id)}}">{{ $item->name }}</a></span><br>
                                                    <?php
                                                    echo $item->description;
                                                    ?><br>
                                                </figure>
                                            </article>
                                            <?php $has_project = 'true'; ?>
                                        @endif
                                    @endforeach
                                    @if($has_project== 'false')
                                        <p>No Record Added</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <?php
                        $counter++;
                        ?>
                    @endforeach
                    @if($counter ==0)
                            <div class="group excerpts">
                                    <p>No Record Added</p>
                            </div>
                        @endif
                </div>
            </div>

        </main>
    </div>
@endsection
@section('scripts')
    <script>
        function openCity(evt, cityName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("city");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " w3-red";
        }
    </script>
@endsection
