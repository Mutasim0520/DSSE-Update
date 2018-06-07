@extends('layouts.user')
@section('title')
    DSSE | Reset Password
@endsection

<!-- Main Content -->
@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear" style="margin-top: 50px;">
            <div class="group excerpts">
                <div class="col-md-offset-2 col-md-8 col-md-offset-2">
                    <article class="one_half">
                        <figure class="list new-group">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn butt">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </figure>
                    </article>
                </div>
            </div>
        </main>
    </div>
@endsection

@section('scripts')
    <script>
        @if (session('status'))
            $('#resetPasswordEmailSent').modal('show');
        @endif
    </script>
    @endsection
