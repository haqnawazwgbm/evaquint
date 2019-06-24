@extends('layouts.privateProfile')
@section('content')
<div class="row">
    <div class="col-xs-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Notifications Setting
            </div>
            <div class="panel-body">
                <form action="/updateNotificationSettings" method="POST" id="notification-setting-form" class="register-form" enctype="multipart/form-data" role="form">

                        <label for="before_hours">* Notify me before event:</label>
                        <select class="form-control" id="before_hours" name="before_hours">
                            <option {{ (Auth::user()->before_hours == 1?'selected':'') }} value="1">1 hour</option>
                            <option {{ (Auth::user()->before_hours == 2?'selected':'') }} value="2">2 hours</option>
                            <option {{ (Auth::user()->before_hours == 4?'selected':'') }} value="4">4 hours</option>
                            <option {{ (Auth::user()->before_hours == 8?'selected':'') }} value="8">8 hours</option>
                            <option {{ (Auth::user()->before_hours == 16?'selected':'') }} value="16">16 hours</option>
                            <option {{ (Auth::user()->before_hours == 24?'selected':'') }} value="24">1 day</option>
                        </select>
                        <br>
                    <div class="byEmail col-xs-12">
                        <input id="notify_by_email" {{ (Auth::user()->notify_by_email == 'on'?'checked':'') }} type="checkbox" id="notify_by_email" name="notify_by_email" /> * Notify by email:
                    </div>
                    <div class="clear "></div>

                    <div id="notification-setting-submit">
                        <input class="btn btn-success pull-right" type="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    

<script>
    $(document).ready(function() {
           //Create marker detail start from here.
            $("#notification-setting-form").submit(function (e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.

              //  $(".loader").fadeIn();
                $.ajax({
                    type: 'POST',
                    url: $("#notification-setting-form").attr("action"),
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    success: function (data) {
                        $('.block-report-alert').css('display', 'block').append('Record save successfully.')
                    }
                });
            });
    })
</script>
@endsection