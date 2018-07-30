@extends('layouts.user')
@section('title')
   DSSE | Update Career
@endsection
@section('style')
@endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
        <main class="hoc container clear" >
            <div class="group excerpts">
                <article class="full">
                    <figure class="list new-group">
                        <form id="graduation_edit_form" class="form-horizontal" role="form" method="POST" action="/update/career/{{$experience->id}}">
                            {{ csrf_field() }}
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Organization</label>
                                <input class="form-control" type="text" required="" name="organization" value="{{$experience->organization_name}}" autofocus="">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Designation</label>
                                <input class="form-control" type="text" required="" value="{{$experience->designation}}"  name="designation" autofocus="">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Work Period</label>
                                <input class="form-control" type="text" required="" value="{{$experience->duration}}"  name="sessions" autofocus="">
                            </div>
                            <div>
                                <input type="submit" class="btn" value="Save">
                            </div>
                            <div class="clearfix"></div>

                        </form>
                    </figure>
                </article>
            </div>
        </main>
        </main>
    </div>
@endsection
@section('scripts')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="/js/validation/projectValidation.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
    <script type="text/javascript">
        $('document').ready(function(){
        });
    </script>
@endsection

