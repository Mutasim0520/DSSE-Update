@if(Session::has('ProjectAdd'))
    <div class="modal fade success-popup" id="ProjectAdd" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
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
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
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
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
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
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">Thank You !</h4>
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
