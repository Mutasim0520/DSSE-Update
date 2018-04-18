@extends('layouts.user')
@section('title')
    @if($type == 'dataset')
        DSSE | Dataset
        @elseif($type == 'src')
        DSSE | Source Code
        @elseif($type == 'srs')
        DSSE | SRS
        @elseif($type == 'other')
        DSSE | Other
    @endif
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
            <div class="group excerpts">
                <?php $i = 1; ?>
                <?php $k = 1;
                $url;?>
                @if(sizeof($Documents)>0)
                    @foreach($Documents as $item)
                        <article class="full">
                            <figure class="list new-group">
                                <span class="tag-data" style="text-transform: capitalize">{{ $item->belongs_to }}</span>
                                <div>
                                    <div style="text-align: justify;">
                                        @if($item->belongs_to == 'project')
                                            <a href="/indivisual/project/{{encrypt($item['project']->project_id)}}">
                                                <h5><strong>{{ $item['project']->name }}</strong></h5></a>
                                        <p style="text-align: center">
                                            @if($item->type =='src')
                                                <a href="/user/download/{{$item['project']->src_code_path}}" class="btn"><small>Download File</small></a>
                                            @elseif($item->type =='srs')
                                                <a href="/user/download/{{$item['project']->srs_path}}" class="btn"><small>Download File</small></a>
                                            @endif
                                        </p>

                                        @elseif($item->belongs_to == 'publication')
                                            <a href="/indivisual/publication/{{encrypt($item['publication']->publication_id)}}">
                                                <h5><strong>{{ $item['publication']->name }}</strong></h5></a>
                                            <p style="text-align: center">
                                            @if($item->type =='src')
                                                <a href="/user/download/{{$item['publication']->src_code_file}}" class="btn"><small>Download File</small></a>
                                            @elseif($item->type =='srs')
                                                <a href="/user/download/{{$item['publication']->srs_file}}" class="btn"><small>Download File</small></a>
                                            @elseif($item->type =='dataset')
                                                <a href="/user/download/{{$item['publication']->paper_path}}" class="btn"><small>Download File</small></a>
                                            @endif
                                            </p>
                                        @endif
                                       </div>
                                </div>
                            </figure>
                        </article><br>
                        <?php $i++; ?>
                    @endforeach
                    @else
                    No records found
                    @endif
                    {{ $Documents->links() }}
            </div>
            <div class="clear"></div>
        </main>
    </div>
@endsection
@section('scripts')
@endsection