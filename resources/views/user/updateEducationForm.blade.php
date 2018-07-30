@extends('layouts.user')
@section('title')
   DSSE | Update Graduation
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
                        <form id="graduation_edit_form" class="form-horizontal" role="form" method="POST" action="/update/graduation/{{$education->degree_name}}">
                            {{ csrf_field() }}
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Degree</label>
                                <input class="form-control" type="text" required="" name="degree" autofocus="" value="{{$education->degree_name}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Subject</label>
                                <input class="form-control" type="text" required=""  name="subject" autofocus="" value="{{$education->degree_subject}}" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Name of Institution</label>
                                <input class="form-control" type="text" required="" name="institute" autofocus="" required value="{{$education->institute}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="item-head log">Session</label>
                                <input class="form-control" type="text" required=""  name="sessions" autofocus="" required value="{{$education->passing_year}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="item-head log">
                                    <input type ="checkbox" id="thesis_status" name="thesis" autofocus="" style="display: inline-block;">
                                    Thesis</label>
                            </div>
                            <div class="col-md-12 form-group" id="thesis_container" style="display: none;">
                                <label class="item-head log">Title of thesis</label>
                                <input class="form-control" type="text"  id="add_thesis_title"  name="thesis_title" autofocus="" value="{{$education->thesis}}">
                                <label class="item-head log">Supervisor</label>
                                <input class="form-control" type="text"  name="thesis_mentor" autofocus="" value="{{$education->supervisor}}">
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
            @if($education->thesis)
                $('input[name=thesis]').attr('checked','checked');
                $('#thesis_container').show();
            @endif
        });
        $('input[name=thesis]').change(function(){
            if($('input[name=thesis]:checked').length >0){
                $('#thesis_container').show();
                $('input[name=thesis_title]').attr('required','required');
            }
            else{
                $('#thesis_container').css('display','none');
                $('input[name=thesis_title]').val("");
                $('input[name=thesis_mentor]').val("");
                $('input[name=thesis_title]').removeAttr('required');
            }
        });
    </script>
@endsection

