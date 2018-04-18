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
                    <article class="{{$class}}">
                        <div class="col-md-12">
                        <div class="col-md-4">
                            <figure><img src="/images/events/{{$item->url}}" style=" height:100%; width:100%;max-height: 191.117px;max-width: 286.15px;" alt="">
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
                                @if($today < $date)
                                <span class="upcomming">UPCOMMING</span>
                                @endif
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
                            <div class="txtwrap">
                                <p><?php echo $item->description;?></p>
                            </div>
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    
                    
                    {{--<footer><a class="btn" href="#">Read More &raquo;</a></footer>--}}
                </article>
                    <?php $i++; ?>
                @endforeach
            </div>
            <!-- ################################################################################################ -->
            <div class="clear"></div>
        </section>
    </div>

@endsection