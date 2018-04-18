@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="/css/admin/dataTables.bootstrap.css" rel="stylesheet">
@endsection
@section('header')
    @if($id == "1")
        <h2>Funded Projects</h2>
    @endif
    @if($id=="2")
        <h2>Non-funded Projects</h2>
    @endif
    @if($id=="3")
        <h2>Complete Projects</h2>
    @endif
    @if($id=="4")
        <h2>Ongoing Projects</h2>
    @endif
    @if($id=="5")
        <h2>All Project</h2>
    @endif
@endsection
@section('content')
    <div class="agile-tables" style="text-align: center">
        @if(sizeof($project) == 0)
            <h4> No Projects Available for the selected criteria</h4>
        @endif
        @if(sizeof($project) > 0)
                <table class="table table-striped" id="projects">
                    <tbody >
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Delete</th>
                    <th>Update</th>
                    <?php $i=1;?>
                        @foreach($project as $Project)
                            <tr style="text-align: center">
                                <td class ="col-xsm-2" style="text-align: center; vertical-align: middle;">{{ $i }}</td>
                                <td class ="col-xsm-2" style="text-align: center; vertical-align: middle;"><a href="/admin/projectDetail/{!! encrypt($Project->project_id) !!}" data-toggle="tooltip" title="Click for detail"><b> {!! $Project->name !!} </b></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="/admin/deleteproject/{!! encrypt($Project->project_id) !!}"><img class="d" src="{{ asset('/images/icons/delete.png') }}" data-toggle="tooltip" title="Delete" style="width:1.5em;border:0"/></a></td>
                                <td class="add" style="text-align: center; vertical-align: middle;"> <a href="/admin/updateproject/{!! encrypt($Project->project_id) !!}"><img src="{{ asset('/images/icons/update.png') }}" data-toggle="tooltip" title="Update" style="width:1.5em;border:0"/></a></td>
                            </tr>
                            <?php $i=$i+1; ?>
                        @endforeach
                    </tbody>
                </table>
            @endif
                </div>
@endsection()
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#projects').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
            var allowed = $('.d').get();
            $("#add-project").mouseover(function (){
                $("#add-project").attr("src","{{ asset('/images/icons/add-project-hover.png') }}");
                console.log("found");
            });
            $("#add-project").mouseout(function (){
                $("#add-project").attr("src","{{ asset('/images/icons/add-project.png') }}");
                console.log("found");
            });
        });
    </script>
@endsection