@extends('layouts.user')
@section('title')
    DSSE | Members
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
            <div class="group excerpts">
                <?php $i = 0;?>
                @foreach( $members as $member)
                    @if($i == 0 || $counter == 0 )
                        <?php $class = "one_third first";?>
                        @else
                            <?php $class = "one_third";?>
                        @endif
                    <div class="col-md-4">
                        <article class="{{$class}}">
                        <div class="hgroup" style="min-height: 115px;">
                            <h6 class="heading">
                                <a href="/MEMBERPROFILE/{{encrypt($member->member_id)}}">{!! $member->firstName ,' ',$member->lastName !!}</a>
                            </h6>
                            <small style="color: #A2B70D">{{$member->current_designation.','.$member->organization}}</small>
                        </div>
                        <figure>
                            @if($member->photo)
                                <img src="{{ asset('/images/').'/'.$member->photo }}"  style="height: 300px; width: 100%;"/>
                                @else
                                <img src="{{ asset('/images/user/user.png') }}"  style="height: 300px; width: 100%;" alt="Image not Found"/>
                            @endif
                        </figure>
                        <footer>
                            <ul class="faico clear">
                                <?php
                                $google_url = 'javascript:void(0)';
                                $researchgate_url = 'javascript:void(0)';
                                $academia_url = 'javascript:void(0)';
                                $dblp_url = 'javascript:void(0)';
                                ?>
                                @if(sizeof($member->social_account)>0)
                                    @foreach($member->social_account as $item)
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
                    </article>
                    </div>
                        <?php $i++;
                            $counter = fmod($i,3);
                        ?>
                @endforeach
            </div>
            {{ $members->links() }}
        </main>
    </div>

@endsection