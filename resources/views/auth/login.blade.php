@extends('layouts.app')

@section('content')
    <div class="top-score-title right-score col-md-6 col-md-offset-3">
        <h3>Login<span> Now</span><span class="point-int"> !</span></h3>
        <div class="col-md-12 login-page">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            <form method="post" class="login-form" action="{{ url('/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="name">
                    <label for="name_login">Email Or Mobile:</label>
                    <div class="clear"></div>
                    <input id="emailPhone" name="email" type="text" placeholder="Mobile number or email address"
                           value="{{ old('email') }}" required autofocus>
                           <input type="hidden" class="type" name="type" value="" />
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="pwd">
                    <label for="password_login">Password:</label>
                    <div class="clear"></div>
                    <input id="password_login" name="password" onchange="this.setCustomValidity('')" type="password" placeholder="********" required="">

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif

                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                    <a href="/password/reset">Forget Password</a>
                </div>
                <div id="login-submit">
                    <input type="submit" value="Submit">
                    <a href="register">
                        <button type="button" id="sign-up" class="btn btn-success">Sign Up</button>
                    </a>
                </div>

            </form>
            <div class="row" style="width: 85%;">
            <div class="col-lg-6">
                <a href="redirect/facebook" class="btn btn-block btn-social btn-facebook">
                    <i class="fa fa-facebook"></i> Sign in with Facebook
                </a>
            </div>
            <div class="col-lg-6">
                <a href="redirect/twitter" class="btn btn-block btn-social btn-twitter">
                    <i class="fa fa-twitter"></i> Sign in with Twitter
                </a>
            </div>
            </div>
        </div><!-- .login-->

    </div>
    <script>
        $(document).ready(function() {
    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function phonenumber(str) {
      var patt = new RegExp(/^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g);
      return patt.test(str);
    }

    $('#emailPhone').on('blur', function() {
        var emailPhone = $(this).val();
        if (validateEmail(emailPhone)) {
            $(this).attr('name', 'email');
            $(this).attr('oninvalid', this.setCustomValidity(''));
            $('.type').val('email');
        } else {
            if (phonenumber(emailPhone)) {
                $(this).attr('name', 'phone_number');
                $(this).attr('oninvalid', this.setCustomValidity(''));
                $('.type').val('phone');
            } else {
                $(this).attr('name', 'emailPhone');
                $(this).attr('oninvalid', this.setCustomValidity('Please enter a valid email or phone.'));
            }
        }
    })
   
// Background slider start from here. 
       painter();    
                 function painter() {
                //Background Image Slideshow- © Dynamic Drive ([url]www.dynamicdrive.com[/url])
                //For full source code, 100's more DHTML scripts, and TOS,
                //visit [url]http://www.dynamicdrive.com[/url]
                
                //Specify background images to slide
                var bgslides = [],
                        processed = [],
                        inc = 0,
                        speed = 3000,
                        dom = document.getElementById ? document.getElementById('bslide') : document.all['bslide'];
                
                bgslides[0] = '/img/bg/01.jpg';
                bgslides[1] = '/img/bg/02.jpg';
                bgslides[2] = '/img/bg/03.jpg';
                
                //preload images
                
                for (inc = 0; inc < bgslides.length; inc += 1) {
                        processed[inc] = new Image();
                        processed[inc].src = bgslides[inc];
                }
                inc = 0;
                
                function slideback() {
                        // This next statement can be removed for production
                        window.status = 'inc = ' + inc + ', slide = "url(\'' + bgslides[inc] + '\')"';
                        
                        dom.style.backgroundImage = 'url(' + bgslides[inc] + ')';
                        
                        inc = ++inc % processed.length;
                }
                slideback(); // Show initial image
                
                window.setInterval(slideback, speed); // Trigger periodic image changes
        }
})
    </script>
@endsection
