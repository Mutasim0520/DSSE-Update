@extends('layouts.app')
@section('content')
    <ul>
        <li><a href="/addresearch"> Add Research</a></li>
    </ul>
    <div class="grid-form1">
        <div class="tab-content">
            <table class="table table-striped">
                <tbody>
                <th>Research Name</th>
                <th>Research Type</th>
                <th>Delete</th>
                <th>Update</th>

                @foreach($Researches as $reserach)
                    <tr>
                        <td>
                            <a href="/researchDetail/{!! encrypt($reserach->research_id) !!}">
                                <b> {!! $reserach->name !!} </b></a>
                        </td>
                        <td>{!! $reserach->type !!}</td>
                        <td><a href="/deleteresearch/{!! encrypt($reserach->research_id) !!}"> Delete</a></td>
                        <td> <a href="/updateresearch/{!! encrypt($reserach->research_id) !!}"> Update</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection()



