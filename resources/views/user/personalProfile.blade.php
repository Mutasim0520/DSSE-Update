@extends('layouts.user')
@section('style')
    <link href="/css/user/light-bootstrap-dashboard.css" rel="stylesheet" type="text/css" media="all">
@endsection
@section('title')
    DSSE | Profile & Info | {{$member[0]->firstName.' '.$member[0]->lastName}}
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear tab-content" style="margin-top: 50px;">
            <div class="upper" style="border:1px solid #9f0769; padding-top: 15px;">
                <div class="content">
                    <div class="author">
                        <div class="col-md-4">
                            @if($member[0]->photo)
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#update_profile_image"><i class="fa fa-cogs">Update Profile Picture</i></a>
                                <img src="/images/{{$member[0]->photo}}" alt="image not found">
                            @else
                                <div>
                                    <h4>Upload Profile Image</h4>
                                    <form action="/upload/pp" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <input type="file" name="file" required >
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#update_profile_info"><i class="fa fa-cogs">Update Profile Info</i></a>
                            <table class="table table-responsive table-striped" style="border: none;">
                                <tbody>
                                <tr>
                                    <td>
                                        Full Name
                                    </td>
                                    <td>
                                        <p class="title">{{$member[0]->firstName.' '.$member[0]->lastName}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Publication Name
                                    </td>
                                    <td>
                                        @if($member[0]->publication_name)
                                            <p class="title">{{$member[0]->publication_name}}</p>
                                        @else
                                            <p>Not Set Yet. <a style="float: right;color: #9f0769;" href="javascript:void(0);" data-toggle="modal" data-target ='#add_publication_name'>Add Publication Name</a></p>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Designation
                                    </td>
                                    <td>
                                        <p class="title">{{$member[0]->current_designation.', '.$member[0]->organization}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/images/user/google.png" class="pp">
                                    </td>
                                    <?php $google = 0;?>
                                    @if(sizeof($member[0]->social_account)>0)
                                        @foreach($member[0]->social_account as $item)
                                            @if($item->name == 'google')
                                                <td><a href="{{$item->url}}">Google Scholar Profile</a></td>
                                                <?php $google = 1;?>
                                            @endif

                                        @endforeach
                                    @endif
                                    @if($google == 0)
                                        <td><a style="color: #9f0769;" href="javascript:showAddSocilaProfileModal('google');">Add Google Scholar Profile</a></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/images/user/RG.png" class="pp">
                                    </td>
                                    <?php $rg = 0;?>
                                    @if(sizeof($member[0]->social_account)>0)
                                        @foreach($member[0]->social_account as $item)
                                            @if($item->name == 'rg')
                                                <td><a href="{{$item->url}}">ResearchGate Profile</a></td>
                                                <?php $rg = 1;?>
                                            @endif
                                        @endforeach
                                    @endif

                                    @if($rg == 0)
                                        <td><a style="color: #9f0769;" href="javascript:showAddSocilaProfileModal('rg');">Add ResearchGate Profile</a></td>
                                    @endif
                                </tr>
                                <tr>

                                    <td>
                                        <img src="/images/user/AC.jpeg" class="pp">
                                    </td>
                                    <?php $ac = 0;?>
                                    @if(sizeof($member[0]->social_account)>0)
                                        @foreach($member[0]->social_account as $item)
                                            @if($item->name == 'ac')
                                                <td><a href="{{$item->url}}">Academia Profile</a></td>
                                                <?php $ac = 1;?>
                                            @endif

                                        @endforeach
                                    @endif

                                    @if($ac == 0)
                                        <td><a style="color: #9f0769;" href="javascript:showAddSocilaProfileModal('ac');">Add Academia Profile</a></td>
                                    @endif
                                </tr>
                                <tr>

                                    <td>
                                        <img src="/images/user/DBLP.png" class="pp">

                                    </td>
                                    <?php $dblp = 0;?>
                                    @if(sizeof($member[0]->social_account)>0)
                                        @foreach($member[0]->social_account as $item)
                                            @if($item->name == 'dblp')
                                                <td><a href="{{$item->url}}">DBLP Profile</a></td>
                                                <?php $dblp = 1;?>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if($dblp == 0)
                                        <td><a style="color: #9f0769;" href="javascript:showAddSocilaProfileModal('dblp');">Add DBLP Profile</a></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <footer>
                    <ul class="faico clear">

                    </ul>
                </footer>
            </div><br>
            <div class="memberMenu">
                @include('partials/user._memnav')
            </div><br>
            <!--- Education------------------>
            <div id="education-tab" class="tab-pane fade item-container">
                <div class="section-head">Education<span style="float: right; font-size: small;"><i class="fa fa-graduation-cap"></i><a href="javascript:void(0);" data-toggle="modal" data-target="#addGraduationInfo" style="text-align: center;">Add Graduation Info</a></span>
                </div><br>
                <div class="group excerpts">
                    @if(sizeof($member[0]['education'])>0)
                        @foreach($member[0]['education'] as $item)
                            <article class="full">
                                <div class="hgroup" style="padding-bottom: 10px;">
                                    <h6 class="heading">{{ $item->degree_name }}</h6>
                                    <small>{{ $item->institute }}</small><hr></div>
                                <figure class="edu">
                                    <div style="display: inline-block; border-right: 5px;">
                                        <i class="fa fa-university fa-5x" style="color: darkolivegreen;"></i>
                                    </div>
                                    <div style="display: inline-block">
                                        <span>{{ $item->degree_subject }}</span><br>
                                        @if($item->thesis)
                                            <span class="item-head">Thesis: </span><span>{{ $item->thesis }}</span><br>
                                            <span class="item-head">Supervisor: </span><span>{{ $item->supervisor }}</span><br>
                                        @endif
                                        <span class="item-head">Session: </span><span>{{ $item->passing_year }}</span><br>
                                    </div>
                                </figure>
                            </article>
                        @endforeach
                    @else
                        <p class="item-head" style="text-align: center;">No record added yet</p>
                    @endif
                </div>
                <div id="addGraduationInfo" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Required Information</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/add/education') }}">
                                    {{ csrf_field() }}
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Degree</label>
                                        <input class="form-control" type="text" required="" name="degree" autofocus="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Subject</label>
                                        <input class="form-control" type="text" required=""  name="subject" autofocus="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Name of Institution</label>
                                        <input class="form-control" type="text" required="" name="institute" autofocus="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Session</label>
                                        <input class="form-control" type="text" required=""  name="sessions" autofocus="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">
                                            <input type ="checkbox" id="degree_name" name="thesis" autofocus="" style="display: inline-block;">
                                            Thesis</label>
                                    </div>
                                    <div class="col-md-12 form-group" id="thesis_container" style="display: none;">
                                        <label class="item-head log">Title of thesis</label>
                                        <input class="form-control" type="text"   name="thesis_title" autofocus="">
                                        <label class="item-head log">Supervisor</label>
                                        <input class="form-control" type="text"  name="thesis_mentor" autofocus="">
                                    </div>
                                    <div>
                                        <input type="submit" class="btn" value="Save">
                                    </div>
                                    <div class="clearfix"></div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="career-tab" class="tab-pane fade">
                <div class="section-head">Career<span style="float: right; font-size: small;"><i class="fa fa-briefcase"></i><a href="javascript:void(0);" data-toggle="modal" data-target="#addCarrerInfo" style="text-align: center;">Add Career Info</a></span>
                </div><br>
                <div class="group excerpts">
                    @if(sizeof($member[0]['experience'])>0)
                        @foreach($member[0]['experience'] as $item)
                            <article class="full">
                                <figure class="edu">
                                    <div style="display: inline-block; border-right: 5px;">
                                        <i class="fa fa-briefcase fa-3x" style="color: darkolivegreen;"></i>
                                    </div>
                                    <div style="display: inline-block">
                                        <span>{{ $item->organization_name }}</span><br>
                                        <span class="item-head">Designation: </span><span>{{ $item->designation }}</span><br>
                                        <span class="item-head">Working Period: </span><span>{{ $item->duration }}</span>

                                    </div>
                                </figure>
                            </article>
                        @endforeach
                    @else
                        <p class="item-head" style="text-align: center;">No record added yet</p>
                    @endif
                </div>
                <div id="addCarrerInfo" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Required Information</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/add/experience') }}">
                                    {{ csrf_field() }}
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Organization</label>
                                        <input class="form-control" type="text" required="" name="organization" autofocus="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Designation</label>
                                        <input class="form-control" type="text" required=""  name="designation" autofocus="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Work Period</label>
                                        <input class="form-control" type="text" required=""  name="sessions" autofocus="">
                                    </div>
                                    <div>
                                        <input type="submit" class="btn" value="Save">
                                    </div>
                                    <div class="clearfix"></div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="contact-tab" class="tab-pane fade">
                <div class="section-head">Contact<span style="float: right; font-size: small;"><i class="fa fa-briefcase"></i><a href="javascript:void(0);" data-toggle="modal" data-target="#addCarrerInfo" style="text-align: center;"></a></span>
                </div><br>
                <div class="group excerpts">
                    <p>No Info</p>
                </div>
                <div id="addCarrerInfo" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Required Information</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/add/experience') }}">
                                    {{ csrf_field() }}
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Organization</label>
                                        <input class="form-control" type="text" required="" name="organization" autofocus="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Designation</label>
                                        <input class="form-control" type="text" required=""  name="designation" autofocus="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="item-head log">Work Period</label>
                                        <input class="form-control" type="text" required=""  name="sessions" autofocus="">
                                    </div>
                                    <div>
                                        <input type="submit" class="btn" value="Save">
                                    </div>
                                    <div class="clearfix"></div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--- Project------------------>

            <div id="publication-tab" class="tab-pane fade in active ">
                <div class="section-head"> Publication<span style="float: right; font-size: small;"><i class="fa fa-briefcase"></i><a href="/add/publication" style="text-align: center;">Add Publications</a></span></div><br>
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
                                <div class="tab tab-pane fade in active" id="paper_{{$year}}">
                                    <div class="group excerpts">
                                        @foreach($memberPublication->publication as $item)
                                            @if(intval($year) == intval(date('Y',strtotime($item->date))))
                                                @if($item->publication_type == "book")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "journal")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "conference")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "thesis")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "other")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
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
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "journal")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "conference")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "thesis")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
                                                            <span class=" item-head"><a href="/conferenceWiseItem/{{$item->conference_name}}">{{ $item->conference_name }}</a></span><br>
                                                            <span class=" item-head"> Date: </span><span> {{ $item->date }}</span><br>
                                                        </figure>
                                                    </article>
                                                @elseif($item->publication_type == "other")
                                                    <article class="full">
                                                        <figure class="list member_item">
                                                            <span class=" item-head"> Name: </span><span><a href="/indivisual/publication/{{encrypt($item->publication_id)}}">{{ $item->name }}</a></span><br>
                                                            <span style="float: right; margin-left: 5px;"><a class="btn" href="/delete/publication/{{$item->publication_id}}"><i class="fa fa-trash"></i></a></span>
                                                            <span style="float: right"><a class="btn" href="/update/publication/{{$item->publication_id}}"><i class="fa fa-pencil"></i></a></span>
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

            <div id="project-tab" class="tab-pane fade">
                <div class="section-head">Projects<span style="float: right; font-size: small;"><i class="fa fa-plus"></i><a href="/add/project" style="text-align: center;">Add Project</a></span></div><br>
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
                                                    <span style="float: right;margin-left: 5px;"><a class="btn" href="/delete/project/{{$item->project_id}}"><i class="fa fa-trash"></i></a></span>
                                                    <span style="float: right;margin-left: 5px;"><a class="btn" href="/update/project/{{$item->project_id}}"><i class="fa fa-pencil"></i></a></span><br>

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
                                                    <span style="float: right;margin-left: 5px;"><a class="btn" href="/delete/project/{{$item->project_id}}"><i class="fa fa-trash"></i></a></span>
                                                    <span style="float: right;margin-left: 5px;"><a class="btn" href="/update/project/{{$item->project_id}}"><i class="fa fa-pencil"></i></a></span><br>

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
                </div>
                    @if($counter ==0)
                        <div class="col-md-10">
                            <p>No Record Added</p>
                        </div>
                    @endif
                </div>
        </main>
    </div>
    <div id="add_social_account_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Social Account</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add/social/link') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12 form-group">
                            <label class="item-head log">URL To Account</label>
                            <input class="form-control" type="text" required="" name="url" autofocus="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="item-head log">Select Acoount</label>
                            <select class="form-control" required name="account_type">
                                <option value="">Select Account</option>
                                <option value="google">Google Scholar</option>
                                <option value="rg">ResearchGate</option>
                                <option value="dblp">DBLP</option>
                                <option value="ac">Academia</option>
                            </select>
                        </div>
                        <div>
                            <input type="submit" class="btn" value="Save">
                        </div>
                        <div class="clearfix"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="update_profile_image" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Profile Image</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/update/profile/image') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12 form-group">
                            <label class="item-head log">Upload New Image</label>
                            <input class="form-control" type="file" required="" name="file" autofocus="">
                        </div>
                        <div>
                            <input type="submit" class="btn" value="Save">
                        </div>
                        <div class="clearfix"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="update_profile_info" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Profile Info</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/update/profile/info') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12 form-group">
                            <label class="item-head log">First Name</label>
                            <input value="{{$member[0]->firstName}}" class="form-control" type="input" required="" name="first_name" autofocus="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="item-head log">Last Name</label>
                            <input value="{{$member[0]->lastName}}" class="form-control" type="input" required="" name="last_name" autofocus="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="item-head log">Current Work Place</label>
                            <input value="{{$member[0]->organization}}"class="form-control" type="input" required="" name="work_place" autofocus="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="item-head log">Designation</label>
                            <input  value="{{$member[0]->current_designation}}"class="form-control" type="input" required="" name="designation" autofocus="">
                        </div>
                        <div>
                            <input type="submit" class="btn" value="Save">
                        </div>
                        <div class="clearfix"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="add_publication_name" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Publication Name</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/user/add/publication/name') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12 form-group">
                            <label class="item-head log">Publication Name</label>
                            <input class="form-control" type="input" required="" name="publication_name" autofocus="">
                        </div>
                        <div>
                            <input type="submit" class="btn" value="Save">
                        </div>
                        <div class="clearfix"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var active_tab = sessionStorage.getItem('active_tab');
            if(active_tab){
                $('#memnav .active').removeClass('active');
                $("#memnav li").eq(active_tab).addClass('active');
                $("#publication-tab").removeClass('in active');
                $("#project-tab").addClass('in active');
                sessionStorage.removeItem('active_tab');

            }
                //$("#memnav").tabs().tabs( "option", "active", 1);

        });
        function showAddSocilaProfileModal(account) {
            $('[name=account_type]').val(account);
            $('#add_social_account_modal').modal('show');
        }
        $('input[name=thesis]').change(function(){
            if($('input[name=thesis]:checked')){
                $('#thesis_container').show();
            }
            else{
                $('#thesis_container').css('display','none');
            }
        });
    </script>
@endsection
