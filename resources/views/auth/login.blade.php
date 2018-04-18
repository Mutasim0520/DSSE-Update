@extends('layouts.user')
@section('title')
        DSSE | Sign In
    @endsection
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
            <div class="group excerpts">
            	<div class="col-md-6">
            		<article class="one_half">
                    <figure class="list new-group">
                        <form autocomplete="off" style="padding: 10px;" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div style="text-align: center">
                                    <label class="item-head log" for="email">E-Mail Address</label>
                                </div>
                                <div>
                                    <input type="email" class="form-control" name="email" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div style="text-align: center">
                                    <label class="item-head log" for="password">Password</label>
                                </div>

                                <div>
                                    <input type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="checkbox-inline">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                        </label>
                                    </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary butt">Login</button>
                                    {{--<a class="btn btn-link" href="{{ url('/password/reset') }}">--}}
                                        {{--Forgot Your Password?--}}
                                    {{--</a>--}}
                            </div>
                        </form>
                        <center><a href="javascript:void(0);" data-toggle="modal" data-target="#forgotPassword">Forgot Password</a></center>
                    </figure>
                </article>
            	</div>
            	<div class="col-md-6">
            		<article class="one_half">
                    <figure class="list new-group" style="text-align: center">
                        <h4 class="header" style="text-align: center;">
                            If You are not a member of this group.
                        </h4>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#memberRequest" style="text-align: center; font-size: 20px;"> Request For Membership</a>
                    </figure>
                </article>
            	</div>              
            </div>
        </main>
    </div>
    <div id="memberRequest" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Required Information</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" id="registration_form" class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                           {{ csrf_field() }}

                           <div class="form-group">
                               <label for="name" class="col-md-4 control-label">First Name</label>

                               <div class="col-md-6">
                                   <input id="name" type="text" class="form-control" name="name" required autofocus>

                                   @if ($errors->has('name'))
                                       <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                   @endif
                               </div>
                           </div>
                        <div class="form-group">
                            <label for="LastName" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="publication_name" class="col-md-4 control-label">Publication Name</label>

                            <div class="col-md-6">
                                <input id="publication_name" type="text" class="form-control" name="publication_name">
                                <span>(Please provide your publication name. If any publication name is not being provided we will follow the convention by IEEE. The first letter of your first name '.' your last name e.g <i> <b>Charles Babbage</b></i> --> <i><b> C.Babbage</b></i> )</span>
                            </div>

                        </div>

                           <div class="form-group">
                               <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                               <div class="col-md-6">
                                   <input id="email" type="email" class="form-control" name="email" required>

                                   @if ($errors->has('email'))
                                       <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                               <label for="password" class="col-md-4 control-label">Password</label>

                               <div class="col-md-6">
                                   <input id="password" type="password" class="form-control" name="password" required>

                                   @if ($errors->has('password'))
                                       <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group">
                               <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                               <div class="col-md-6">
                                   <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                               </div>
                           </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Current Workstation</label>

                            <div class="col-md-6">
                                <input id="work_station" type="text" class="form-control" name="current_work_station" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Designation</label>

                            <div class="col-md-6">
                                <input id="designation" type="text" class="form-control" name="current_designation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <label>Please identify yourself if you are one of them.</label>
                                <select class="form-control" name="external_author_identification" required>
                                    <option value="">---</option>
                                    <option value="none">None Of Them</option>
                                    @foreach($external_authors as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                           <div class="form-group">
                               <div class="col-md-6 col-md-offset-4">
                                   <button type="submit" class="btn btn-primary">
                                      Send Request
                                   </button>
                               </div>
                           </div>
                       </form>
                </div>
            </div>

        </div>
    </div>
    <div id="forgotPassword" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Password Recovery</h4>
                    <center><small>Please enter your email. A password recovery mail will be sent</small></center>

                </div>
                <div class="modal-body">
                    <form autocomplete="off" id="passwordRecoveryForm" class="form-horizontal" role="form" method="POST" action="{{ url('/send/password/recovery/mail') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="p_c_email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="p_c_email" type="email" class="form-control" name="p_c_email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div><br>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send Password Recovery Mail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="/js/validators/validator.js"></script>
    <script type="text/javascript" src="/js/validators/registrationValidator.js"></script>
    <script type="text/javascript" src="/js/validators/passwordChangeValidator.js"></script>
    <script>
        $('#passwordRecoveryForm').validate({
            success: function(label) {
                var name = label.attr('for');
                label.text('The mail is found');
            }
        });
    </script>
@endsection