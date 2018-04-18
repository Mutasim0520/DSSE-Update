@extends('layouts.app')
@section('content')
   <section>
       <div class="col-md-12">
           <div class="col-md-12">
               <h1>Members</h1>
           </div>
           <div class="col-md-12">
               <table class="table table-bordered">
                   <thead>
                   <th>S/N</th>
                   <th>Member Name</th>
                   <th>
                       Action
                   </th>
                   </thead>
                   <tbody>
                        <?php
                            $i =1;
                        ?>
                        @foreach($members as $item)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item->firstName}} {{$item->lastName}}</td>
                                <td>
                                    @if($item->external_author == 'none')
                                        No Action Required
                                    @else
                                        <a data-toggle="tooltip" title="Synchronize this member with external members"  href="/admin/sync/exauth/{{$item->member_id}}/{{encrypt($item->external_author)}}" class="btn btn-info"><i class="fa fa-refresh fa-2x"></i></a>
                                    @endif
                                </td>
                            </tr>
                            <?php
                            $i++;
                            ?>
                        @endforeach
                   </tbody>
               </table>
           </div>
       </div>
   </section>
   @if(sizeof($User)>0)
       <section>
           <div class="col-md-12">
               <div class="col-md-12">
                   <h1>Member Request</h1>
               </div>
               <div class="col-md-12 laddu-tele">
                   <table class="table table-striped">
                       <thead>
                       <th>S/N</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Current Designation</th>
                       <th>Is External Member?</th>
                       <th>Action</th>
                       </thead>
                       <tbody>
                       <?php $k = 1;?>
                       @foreach($User as $item)
                           <tr>
                               <td>{{$k}}</td>
                               <td>
                                   <?php
                                   $member = $item->member;
                                   ?>
                                   {{$member->firstName}} {{$member->lastName}}
                               </td>
                               <td>{{$item->email}}</td>
                               <td>
                                   {{$member->current_designation}},{{$member->organization}}
                               </td>
                               <td>
                                   @if($member->external_author == 'none')
                                       N/A
                                   @else
                                       @foreach($external_author as $item2)
                                           @if($item2->id == $member->external_author)
                                               {{$item2->name}}
                                           @endif
                                       @endforeach
                                   @endif
                               </td>
                               <td>
                                   <a  data-toggle="tooltip" title="Accept Request" href="/admin/acceptUser/{{encrypt($item->id)}}" class="btn btn-success"><i class="fa fa-check-circle fa-2x"></i></a>
                                   <a data-toggle="tooltip" title="Reject Request"  href="/admin/rejectUser/{{encrypt($item->id)}}" class="btn btn-danger"><i class="fa fa-trash-o fa-2x"></i></a>
                               </td>
                           </tr>
                           <?php $k++;?>
                       @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </section>
       @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @endsection