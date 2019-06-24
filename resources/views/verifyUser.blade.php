@extends('layouts.site')

@section('title')
    Verify
@endsection

@section('content')
<div class="col-md-12 login-page">
    <h1>Just To Be Safe...</h1>
    <p>
        Your account has been created, but we need to make sure you're a human
        in control of the phone number you gave us. Can you please enter the
        verification code we just sent to your phone?
    </p>
    
<form method="POST" class="register-form" action="/user/verify" accept-charset="UTF-8">{{ csrf_field() }}
        <div class="form-group">
            <label for="token">Token</label>
            <input class="form-control" name="token" type="text" value="" id="token">
        </div>
        <button type="submit" class="btn btn-primary">Verify Token</button>
    </form>
    <hr>
    <form method="POST" style="margin-top: 10px;" class="register-form"  action="/user/verify/resend" accept-charset="UTF-8">{{ csrf_field() }}
        <button type="submit" class="btn">Resend code</button>
    </form>
    </div>
@endsection
