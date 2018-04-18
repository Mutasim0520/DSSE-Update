@extends('layouts.user')
@section('title')
    @if($id=="1")
        DSSE | Funded ProjectS
    @elseif($id=="2")
        DSSE | Non-Funded Projects
    @elseif($id=="3")
        DSSE | Complete Projects
    @elseif($id=="4")
        DSSE | Ongoing Projects
    @elseif($id=="5")
        DSSE | All Projects
    @endif
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
            <div class="group excerpts">
                @if(sizeof($Project)>0)
                    <?php $i = 1; ?>
                    @foreach($Project as $item)
                        <article class="full">
                            <figure class="list new-group">
                                <div>
                                    <h5 class="item-head" style="display: inline-block;"><a href="/indivisual/project/{{encrypt($item->project_id)}}">{{ $item->name }}</a></h5><br>
                                    <div>
                                        <?php echo $item->description;?>
                                    </div>
                                    <div>
                                        <span class=" item-head"> Status: </span>
                                        <span>
                                    @if($item->status == "1") Complete
                                            @else Ongoing
                                            @endif
                                    </span><br>
                                    </div>
                                </div>
                            </figure>
                        </article>
                        <?php $i++; ?>
                    @endforeach
                    @else
                        <p>No Records Added</p>
                @endif
                    {{ $Project->links() }}
            </div>
            <div class="clear"></div>
        </main>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
        });

    </script>
@endsection