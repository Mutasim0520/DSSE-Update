@if(Session::has('ProjectAdd'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('ProjectAdd') }}
    </div>
@endif
@if(Session::has('ProjectUpdate'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('ProjectUpdate') }}
    </div>
@endif

@if(Session::has('ProjectDelete'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('ProjectDelete') }}
    </div>
@endif

@if(Session::has('PublicationDelete'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('PublicationDelete') }}
    </div>
@endif
@if(Session::has('ResearchAdd'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('ResearchAdd') }}
    </div>
@endif
@if(Session::has('ResearchUpdate'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('ResearchUpdate') }}
    </div>
@endif

@if(Session::has('ResearchDelete'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('ResearchDelete') }}
    </div>
@endif
@if(Session::has('PublicationAdd'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('PublicationAdd') }}
    </div>
@endif
@if(Session::has('PublicationUpdate'))
    <div class="alert alert-success">
        <strong> Success: </strong> {{ Session('PublicationUpdate') }}
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
                    <img src="http://osmhotels.com//assets/check-true.jpg">
                    <p class="lead">{{Session::get('registration_request_send')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif
