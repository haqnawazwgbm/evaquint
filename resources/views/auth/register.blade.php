@extends('layouts.site')

@section('content')
    <section id="login" class="container secondary-page">
        <div class="top-score-title right-score col-md-12">
            <h3>Register <span>Now</span><span class="point-int"> !</span></h3>
            <div class="col-md-12 login-page">
                <form method="POST" class="register-form" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                    <div class="name">
                        <label for="firstname">* First Name:</label>
                        <div class="clear"></div>
                        <input id="first_name" class="{{ $errors->has('first_name') ? ' has-error' : '' }}"
                               name="first_name" value="{{ old('first_name') }}" type="text" placeholder="e.g. Mr. John"
                               required="">
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                               <strong>{{ $errors->first('first_name') }}</strong>
                      </span>
                        @endif
                    </div>
                    <div class="name">
                        <label for="lastname">* Last Name:</label>
                        <div class="clear"></div>
                        <input id="last_name" name="last_name"
                               class="{{ $errors->has('last_name') ? ' has-error' : '' }}"
                               value="{{ old('last_name') }}" type="text" placeholder="e.g. Mr. Doe" required="">
                        @if ($errors->has('last_name'))
                            <span class="help-block">
                               <strong>{{ $errors->first('last_name') }}</strong>
                      </span>
                        @endif
                    </div>
                    <div class="emailPhone">
                        <label for="emailPhone">* Email Or Mobile:</label>
                        <div class="clear"></div>
                        <input id="emailPhone" name="emailPhone" class="{{ $errors->has('emailPhone') ? ' has-error' : '' }}"
                               value="{{ old('emailPhone') }}" type="text" placeholder="Mobile number or email address" onchange="this.setCustomValidity('')" required="">
                        @if ($errors->has('emailPhone'))
                            <span class="help-block">
                               <strong>{{ $errors->first('emailPhone') }}</strong>
                      </span>
                        @endif
                    </div>
                    <div class="birth_date">
                        <label for="birth_date">* Date of Birth:</label>
                        <div class="clear"></div>
                        <input id="birth_date" name="birth_date"
                               class="{{ $errors->has('birth_date') ? ' has-error' : '' }}"
                               value="{{ old('birth_date') }}"  type="text" placeholder="2016-11-16" required="">
                        @if ($errors->has('birth_date'))
                            <span class="help-block">
                               <strong>{{ $errors->first('birth_date') }}</strong>
                      </span>
                        @endif
                    </div>
                    <div class="tags">
                        <label for="tags">* Your Interests:</label>
                        <div class="clear"></div>
                        <input type="text" name="interests-tags" data-role="tagsinput" id="interests-tags" />
                    </div>
                    <div class="country_code">
                        <label for="country_code">* Country Code:</label>
                        <div class="clear"></div>
                        <input type="text" name="country_code" id="authy-countries" />
                        @if ($errors->has('country_code'))
                            <span class="help-block">
                               <strong>{{ $errors->first('country_code') }}</strong>
                      </span>
                        @endif
                    </div>


                    <div class="name">
                        <label for="password">* Password:</label>
                        <div class="clear"></div>
                        <input id="password" name="password" class="{{ $errors->has('password') ? ' has-error' : '' }}"
                               type="password" placeholder="********" required="">
                        @if ($errors->has('password'))
                            <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                      </span>
                        @endif
                    </div>
                    <div class="password_confirmation">
                        <label for="confirm_password">* Password:</label>
                        <div class="clear"></div>
                        <input id="password_confirmation"
                               class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}"
                               name="password_confirmation" type="password" placeholder="********" required="">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                               <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div id="register-submit">
                        <input type="submit" value="Submit">
                    </div>
                </form>
                <div class="ctn-img">
                    <img src="/img/federer.png">
                </div><!--Close Images-->
                <div class="clear"></div>
            </div>

        </div>
    </section>

@endsection
@section('interestsTags')
    <script>
        var cities = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '/assets/interestsTags.json'
        });
        cities.initialize();

        var elt = $('#interests-tags');
        elt.tagsinput({
            itemValue: 'value',
            itemText: 'text',
            typeaheadjs: {
                name: 'cities',
                displayKey: 'text',
                source: cities.ttAdapter()
            }
        });
        elt.tagsinput('add', { "value": 1 , "text": "Sports"   , "continent": "Sports"    });
        $(document).ready(function() {
            //Initialize bootstrap datepicker from here
            $('#birth_date').datetimepicker({

                format: 'Y-m-d',
                maxDate: 'today',
                formatDate: 'Y.m.d',
                //defaultDate:'8.12.1986', // it's my birthday
                defaultDate: '+1970.01.03', // it's my birthday
                timepickerScrollbar: false,
                timepicker: false,
                maxYear: "2017"
            });
        })

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
            $('.register-form').attr('action', '/register');
            $(this).attr('name', 'email');
            $(this).attr('oninvalid', this.setCustomValidity(''));
            $('.country_code').css('display', 'none');
        } else {
            if (phonenumber(emailPhone)) {
                $(this).attr('name', 'phone_number');
                $('.register-form').attr('action', '/user/create');
                $(this).attr('oninvalid', this.setCustomValidity(''));
                $('.country_code').css('display', 'block');
            } else {
                $(this).attr('name', 'emailPhone');
                $(this).attr('oninvalid', this.setCustomValidity('Please enter a valid email or phone.'));
            }
        }
    })
   /* function validate() {
      $("#result").text("");
      var email = $("#email").val();
      if (validateEmail(email)) {
        $("#result").text(email + " is valid :)");
        $("#result").css("color", "green");
      } else {
        $("#result").text(email + " is not valid :(");
        $("#result").css("color", "red");
      }
      return false;
    }*/
})

    </script>

@endsection