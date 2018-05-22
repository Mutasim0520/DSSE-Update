@extends('layouts.user')
@section('title')
   DSSE | Events Detail
@endsection
@section('content')
    <div class="wrapper row3">
        <section class="hoc container clear" style="margin-top: 50px;">
            <div class="group excerpts">
                <h3>Take a look at our Event photo gallery for better Understanding</h3>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    @if(sizeof($event->events_photo)>0)
                            <ol class="carousel-indicators">
                                <?php $i=0; ?>
                                @foreach($event->events_photo as $item)
                                    @if($i == 0)
                                        <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
                                    @else
                                        <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                                    @endif
                                    <?php
                                    $i++;
                                    ?>
                                @endforeach

                            </ol>
                        <?php $i=0; ?>
                        <div class="carousel-inner">
                        @foreach($event->events_photo as $item)
                            @if($i == 0)
                                    <div class="item active">
                                        <img src="/images/events/{{$item->path}}" alt="slide {{$i}}" style="width:100%; max-height: 318px;">
                                    </div>
                            @else
                                    <div class="item">
                                        <img src="/images/events/{{$item->path}}" alt="slide {{$i}}o" style="width:100%; max-height: 318px;">
                                    </div>
                            @endif
                            <?php
                            $i++;
                            ?>

                        @endforeach
                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    @else
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

                        </ol>
                        <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="/images/events/event.png" alt="slide 0" style="width:100%; max-height: 318px;">
                                    </div>
                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                @endif
                </div>
                <br>
                <div class="col-md-12">
                        <article class="one_third">
                                <div class="hgroup">
                                    <center>
                                        <h4 class="heading">{{$event->name}}</h4>
                                        <ul class="nospace meta">
                                            <li><i class="fa fa-map-marker"></i> <spanp>{{$event->place}}</spanp></li>
                                            <li><i class="fa fa-clock-o"></i> <spanp>{{$event->time}}</spanp></li>
                                        </ul>
                                    </center>
                                    <p style="text-align: justify">
                                        <?php
                                            echo $event->description;
                                        ?>
                                    </p>
                                </div>
                        </article>
                    </a>
                </div>
            </div>
            <div class="clear"></div>
        </section>
    </div>

@endsection