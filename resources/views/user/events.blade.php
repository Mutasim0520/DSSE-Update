@extends('layouts.user')
@section('title')
   DSSE | Upcomming Events
@endsection
@section('content')
    <div class="wrapper row3">
        <section class="hoc container clear" style="margin-top: 50px;">
            <div class="group excerpts">
                <?php $i = 0;?>
                @foreach( $events as $item)
                        @if($i ==0)
                            <?php $class = "one_third first";?>
                        @else
                            <?php $class = "one_third";?>
                        @endif
                    <div class="col-md-6">
                        <a href="/events/{{$item->id}}">
                        <article class="{{$class}} max-h-css">
                        <div class="col-md-4">
                                <figure>
                                    @if(sizeof($item->events_photo)>0)
                                        <?php
                                            $path = "/images/events/".$item->events_photo[0]->path;
                                        ?>
                                    @else
                                        <?php
                                        $path = "/images/events/event.png";
                                        ?>
                                    @endif
                                    <img src="{{$path}}" style=" height: 160px; width: auto;" alt="">
                                <figcaption>
                                    <time datetime="2045-04-06T08:15+00:00">
                                        <strong>
                                            <?php
                                                $date = strtotime($item->date);
                                                $day = date("d",$date);
                                                $Month = date("M",$date);
                                                echo $day;
                                            ?>
                                        </strong>
                                        <em>
                                            {{$Month}}
                                        </em>
                                    </time>
                                </figcaption>
                                <?php
                                $today = strtotime(date("m/d/Y"));
                                $date = strtotime($item->date);
                                ?>
                                </figure>
                            
                        </div>
                        <div class="col-md-8">
                            <div class="hgroup">
                                <h4 class="heading">{{$item->name}}</h4>
                                <ul class="nospace meta">
                                    <li><i class="fa fa-map-marker"></i> <spanp>{{$item->place}}</spanp></li>
                                    <li><i class="fa fa-clock-o"></i> <spanp>{{$item->time}}</spanp></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    
                    {{--<footer><a class="btn" href="#">Read More &raquo;</a></footer>--}}
                </article>
                        </a>
                    </div>
                    <?php $i++; ?>
                @endforeach
            </div>
        {{ $events->links() }}
            <!-- ################################################################################################ -->
            <div class="clear"></div>
        </section>
    </div>

@endsection