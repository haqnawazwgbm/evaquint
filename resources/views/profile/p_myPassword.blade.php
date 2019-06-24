@extends('layouts.privateProfile')
@section('content')

                      <!-- My password start from here. -->
                            <h3>Change Password:</h3>
                            <form method="POST" class="register-form" id="change-password-form" action="{{ url('/changePassword') }}" type="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="name">
                                    <label for="current_password">* Current Password:</label>
                                    <div class="clear"></div>
                                    <input id="current_password" name="current_password" type="password" placeholder="Old Password" required="">
                                </div>
                                <div class="name">
                                    <label for="password">* Password:</label>
                                    <div class="clear"></div>
                                    <input id="password" name="password" type="password" placeholder="New Password" required="">
                                </div>
                                <div class="name">
                                    <label for="password_confirmation">* Confirm Password:</label>
                                    <div class="clear"></div>
                                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repeat New Password" required="">
                                </div>
                                 <span class="help-block">
                                    </span>


                                <div id="register-submit">
                                    <input type="submit" value="Update Password">
                                    <button  class="btn-cancel">Cancel</button>
                                </div>

                            </form>
<script>
    $(document).ready(function() {
         // Change password start from here.
    // this is the id of the form
    $("#change-password-form").submit(function(e) {

        var url = "/changePassword"; // the script where you handle the form input.

        $.ajax({
               type: "POST",
               url: url,
               data: $("#change-password-form").serialize(), // serializes the form's elements.
               success: function(data)
               {
                    if (data == 'ok') {

                        $('.block-report-alert').css('display','block').append(' Password changed successfully.');
                    }
               },
               error: function(xhr,textStatus,thrownError) {
                    var er = JSON.parse(xhr.responseText);
                    $.each(er.error, function(i,n) {
                        $('.help-block').find('strong').remove();
                        $('.help-block').append('<strong>'+n+'</strong>');
                    });
            
                }
             });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    })
</script>
@endsection