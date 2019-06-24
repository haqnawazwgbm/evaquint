@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

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
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="top-score-title right-score col-md-12">
    <h3>Register <span>Now</span><span class="point-int"> !</span></h3>
    <div class="col-md-12 login-page">
        <form method="post" class="register-form" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="email{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">* Email:</label>
                <div class="clear"></div>
                <input id="email" name="email" type="text" placeholder="example@domain.com" required="">
                @if ($errors->has('email'))
                    <span class="help-block">
                               <strong>{{ $errors->first('email') }}</strong>
                      </span>
                @endif
            </div>
            <div class="email{{ $errors->has('confirm_email') ? ' has-error' : '' }}">
                <label for="confirm">* Confirm Email:</label>
                <div class="clear"></div>
                <input id="confirm" name="confirm_email" type="text" placeholder="example@domain.com" required="">
                @if ($errors->has('email'))
                    <span class="help-block">
                               <strong>{{ $errors->first('email') }}</strong>
                      </span>
                @endif
            </div>
            <div class="name{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="firstname">* First Name:</label>
                <div class="clear"></div>
                <input id="firstname" name="first_name" type="text" placeholder="e.g. Mr. John" required="">
                @if ($errors->has('first_name'))
                    <span class="help-block">
                               <strong>{{ $errors->first('first_name') }}</strong>
                      </span>
                @endif
            </div>
            <div class="name{{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="lastname">* Last Name:</label>
                <div class="clear"></div>
                <input id="lastname" name="last_name" type="text" placeholder="e.g. Mr. Doe" required="">
                @if ($errors->has('last_name'))
                    <span class="help-block">
                               <strong>{{ $errors->first('last_name') }}</strong>
                      </span>
                @endif
            </div>
            <div class="name{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">* Password:</label>
                <div class="clear"></div>
                <input id="password" name="password" type="password" placeholder="********" required="">
                @if ($errors->has('password'))
                    <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                      </span>
                @endif
            </div>
            <div class="confirm_password{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                <label for="confirm_password">* Password:</label>
                <div class="clear"></div>
                <input id="confirm_password" name="confirm_password" type="password" placeholder="********" required="">
                @if ($errors->has('confirm_password'))
                    <span class="help-block">
                               <strong>{{ $errors->first('confirm_password') }}</strong>
                    </span>
                @endif
            </div>
            <div id="register-submit">
                <input type="submit" value="Submit">
            </div>
        </form>
        <div class="ctn-img">
            <img src="images/federer.png">
        </div><!--Close Images-->
        <div class="clear"></div>
    </div>

</div>