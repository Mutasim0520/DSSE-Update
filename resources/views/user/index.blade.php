@extends('layouts.user')
@section('title')
   DSSE | Home
@endsection
@section('content')
    <div class="wrapper row1" style="background-color: #f5f5f5;">
        <section id="pageintro" class="hoc clear" style="max-width: 100%;">
            <div>
                <!-- ################################################################################################ -->
                <h2 class="heading">Distributed System And Sotware Engineering</h2>
                {{--<footer><a class="btn" href="#">Vulputate</a></footer>--}}
                <!-- ################################################################################################ -->
            </div>
        </section>
    </div>
    <div id="row2_about" class="wrapper row2">
        <section class="hoc container clear effect">
            <!-- ################################################################################################ -->
            <div class="sectiontitle">
                <h6 class="heading">About Us</h6>
                {{--<p>Augue sapien et sapien nunc urna duis eget libero non.</p>--}}
            </div>
            <div class="full" style="text-align: justify; font-size: 18px;">
                Distributed Systems and Software Engineering (DSSE) is a relatively new area of research in Bangladesh. It is noteworthy that the founding Members of DSSE group first took the initiatives to start Software Engineering education in Bangladesh back in 2008. At the Institute of Information Technology (IIT), University of Dhaka, first ever the Bachelor of Science in Software Engineering (BSSE) and Master of Science in Software Engineering (MSSE) degrees were started in this country. Traditional degrees are for laying the foundation of specific domain knowledge and research is for creating new knowledge to advancing the domain. Tertiary education is considered incomplete without having that research component. Hence, the students of BSSE and MSSE formed a research group called Distributed Systems and Software Engineering (DSSE) in 2012.
                Since the applications of today’s world are inherently distributed, the aim of this group is set to investigate Software Engineering principles and practices on distributed systems. Software engineering possesses a broad area of research, where people can explore on various sub-disciplines such as requirements engineering to software project management. DSSE focuses on some of these fields that include software design, requirements prioritization, software performance testing, code analysis, defect prediction, test automation, software maintenance, etc.
                Primarily, DSSE should be considered as the common platform for communicating between software engineering researchers internally (within the group) and externally (outside the group). This should also be the place where all the Software Engineering research related resources will be available for the ongoing and future researches. At the same time, DSSE should act as the mediator for all research and research project collaboration in home and abroad.
            </div>
            <!-- ################################################################################################ -->
            <div class="clear"></div>
        </section>
    </div>
    <div id="row2_project" class="wrapper row2">
        <section class="hoc container clear effect">
            <div class="sectiontitle">
                <h6 class="heading">Our Projects</h6>
            </div>
            <div class="col-md-6">
                <div class="one_half first project-list">
                <ul class="nospace group services" style="text-align: left;">
                    <?php
                        if(sizeof($projects)>7){
                            $counter = 7;
                        }else{
                            $counter = sizeof($projects);
                        }
                    ?>
                    @for($i = 0; $i<$counter;$i++)
                        <li style="margin-bottom: 10px;">
                            <a href="/indivisual/project/{{encrypt($projects[$i]->project_id)}}">
                                <i class="fa fa-long-arrow-right" aria-hidden="true" style="margin-right: 5px; color:#3949a0;"></i>
                                <span style="color: #3949a0">{{$projects[$i]->name}}</span>
                            </a>
                        </li>
                    @endfor
                </ul>
                <a href="/PROJECTS/5" class="seebutton">See All</a>
            </div>
            </div>
            <div class="col-md-6">
                <img class="one_half" id="project" src="/images/user/backgrounds/project_1.png" alt="no">
            </div>
            
            
            
            <!-- ################################################################################################ -->
            <div class="clear"></div>
        </section>
    </div>
    <div id="row3_publication">
        <section class="hoc container clear effect" style="margin-bottom: 20px;">            
            <div class="sectiontitle">
                <h6 class="heading">Our Publications</h6>
            </div>
            <div class="col-md-6">
                <img class="one_half first" id="project" src="/images/user/backgrounds/publication_1.jpg" alt="no">
            </div>
            <div class="col-md-6">
                <div class="one_half" style="font-size: 18px;">
                <ul class="nospace group services" style="text-align: left;">
                    <?php
                    if(sizeof($publications)>7){
                        $counter = 7;
                    }else{
                        $counter = sizeof($publications);
                    }
                    ?>
                        @for($i = 0;$i<$counter;$i++)
                            <li>
                                <a href="indivisual/publication/{{encrypt($publications[$i]->publication_id)}}">
                                    <i class="fa fa-book fa-1x" style="margin-right: 5px; color:#3949a0;"></i>
                                    <span style="color: #3949a0">{{$publications[$i]->name}}</span>
                                </a>
                            </li>
                        @endfor
                </ul>
                <div style="margin-top: 10px;">
                   <a href="/publication" class="seebutton">See All</a> 
                </div>
                
            </div>
            </div>
            
            
            <div class="clear"></div>
        </section>
    </div>
    <div id="row3_member" class="wrapper row3">
        <section class="hoc container clear effect" style="margin-bottom: 31px;">
            <!-- ################################################################################################ -->
            <div class="sectiontitle">
                <h6 class="heading">Our Members</h6>
            </div>
            <div class="sreen-gallery-cursual">
            <ul id="owl-demo" class="nospace group services" style="text-align: center;">
                <?php $i=0;?>
                @foreach($members as $item)
                        @if($i ==0)
                            <?php $class = "one_third first";?>
                        @else
                            <?php $class = "one_third";?>
                        @endif
                            <li class="one_third first" style="width: 100%; min-height: 280px; border: 1px solid #9f0769">
                                <a href="MEMBERPROFILE/{{encrypt($item->member_id)}}" class="hover">
                                    <article class="prohover" style="min-height: 280px;">
                                        @if($item->photo)
                                            <img src="/images/{{$item->photo}}" class="img-rounded" style="border-radius: 50%;">
                                        @else
                                            <img src="/images/user/user.png" class="img-rounded">
                                        @endif
                                        <p style="text-align: center;">{{$item->firstName}} {{$item->lastName}}</p>
                                            <p><small class="item-head">{{$item->current_designation}}</small></p>
                                            <p><small class="item-head">{{$item->organization}}</small></p>
                                    </article>
                                </a>
                            </li>
                    <?php $i++;?>
                @endforeach
            </ul>
            </div>
            <!-- ################################################################################################ -->
            <div class="clear"></div>
        </section>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

            $(document).ready(function () {
                $("#owl-demo").owlCarousel({
                    items: 4,
                    lazyLoad: true,
                    autoPlay: true,
                    navigation: false,
                    navigationText: false,
                    pagination: true,
                });
            });
            $('#nav_container').css('transition','none');
            $('#nav_container').css('max-height','80px');

            $('#row3_publication').addClass("visible").viewportChecker({
                classToAdd: 'animated fadeInUp',
                offset: 100
            });
            $('#row3_member').addClass("visible").viewportChecker({
                classToAdd: 'animated fadeInLeft',
                offset: 100
            });
            $('#row2_project').addClass("visible").viewportChecker({
                classToAdd: 'animated fadeInRight',
                offset: 100
            });

            $('#row2_about').addClass("visible").viewportChecker({
                classToAdd: 'animated fadeIn',
                offset: 100
            });

        });
    </script>
@endsection