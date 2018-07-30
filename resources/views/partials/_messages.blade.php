@if(Session::has('ProjectAdd'))
    <div class="modal fade success-popup" id="ProjectAdd" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Success</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('ProjectAdd')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('ProjectUpdate'))
    <div class="modal fade success-popup" id="ProjectUpdate" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Success</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('ProjectUpdate')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif

@if(Session::has('ProjectDelete'))
    <div class="modal fade success-popup" id="ProjectDelete" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Success</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('ProjectDelete')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif

@if(Session::has('PublicationDelete'))
    <div class="modal fade success-popup" id="PublicationDelete" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Success</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('PublicationDelete')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('PublicationAdd'))
    <div class="modal fade success-popup" id="PublicationAdd" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Success</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('PublicationAdd')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('PublicationUpdate'))
    <div class="modal fade success-popup" id="PublicationUpdate" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Success</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('PublicationUpdate')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('EventAdd'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('EventAdd') }}
    </div>
@endif

@if(Session::has('registration_request_send'))
    <div class="modal fade success-popup" id="registration_request_send" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('registration_request_send')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="modal fade success-popup" id="resetPasswordEmailSent" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center">Success</h4>
            </div>
            <div class="modal-body text-center">
                <img src="/images/icons/check.png">
                <p class="lead">Please check your email to reset the password.</p>
            </div>
        </div>
    </div>
</div>

@if(Session::has('GraduationUpdate'))
    <div class="modal fade success-popup" id="GraduationUpdate" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('GraduationUpdate')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('GraduationAdd'))
    <div class="modal fade success-popup" id="GraduationAdd" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('GraduationAdd')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('GraduationDelete'))
    <div class="modal fade success-popup" id="GraduationDelete" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('GraduationDelete')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('CareerAdd'))
    <div class="modal fade success-popup" id="CareerAdd" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('CareerAdd')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('CareerUpdate'))
    <div class="modal fade success-popup" id="CareerUpdate" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('CareerUpdate')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('CareerDelete'))
    <div class="modal fade success-popup" id="CareerDelete" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('CareerDelete')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('ContactUpdate'))
    <div class="modal fade success-popup" id="ContactUpdate" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('ContactUpdate')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('ContactDelete'))
    <div class="modal fade success-popup" id="ContactDelete" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="/images/icons/check.png">
                    <p class="lead">{{Session::get('ContactDelete')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
