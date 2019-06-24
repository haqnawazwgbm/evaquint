@extends('layouts.site')
@section('content')
<style>
     .panel-collapsable .panel-heading h4:after {
   font-family: 'Glyphicons Halflings';
   content: "\e114";
   float: right;
   color: white;
   margin-right: 5px;
   cursor: pointer;
 }
 .panel-collapsable .collapsed h4:after {
   content: "\e080";
 }
 .panel-heading .btn-group {
   float: right;
 }
</style>
<div class="container">
    <div class="panel panel-default panel-collapsable panel-chart">
        <div class="panel-heading">
          <div class="btn-group">
            <button class="btn btn-primary toggle-dropdown" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"> <span class="glyphicon glyphicon-trash"></span>

            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                @if(!empty($notifications))
                <li><a href="/delete_all_notification/" onclick="return window.confirm('Are you sure....?')">Delete All</a></li>
                @endif
            </ul>
        </div>
        <h4 data-toggle="collapse" data-target="#sg1" aria-expanded="true">Notifications</h4>

        <div class="clearfix"></div>
    </div>
    <div id="sg1" class="panel-body collapse in" aria-expanded="true">
        <table class="table user-list">
            <tbody>
                @forelse ($notifications as $notification)
                <tr><td><a class="content notification-block" href="#">
                    <div class="notification-item"  notification="unread" notificationType="{{ (isset($notification->hostNotificationID)?'host_notification':'event_notification') }}" id="{{ (isset($notification->hostNotificationID)?$notification->hostNotificationID:$notification->notificationID) }}">

                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>

                        <h4 class="item-title">{{ $notification->notificationType }}</h4>
                        <p class="item-info"><?php echo $notification->message; ?></p>
                    </div>
                </a></td></tr>
                @empty
                No new notification
                @endforelse
            </tbody>
        </table>                      
    </div>
</div>
</div>
    <script>
        $(document).ready(function() {
            $('.notification-item').find('.close').on('click', function() {
                $(this).parent().fadeOut();
            })

    $('.notification-item').find('.btn-primary').live('click', function() {
            $(this).parent().find('.btn').attr('disabled', 'disabled');
      var notificationID = $(this).parent('.notification-item').attr('id');

       var $this = $(this);
       var title = $this.attr('title');
       var poiID = $(this).attr('id');
        $this.html('Accepted');
              $this.parent().fadeOut('slow', function() {
                $(this).remove();
              });
              var data = {poiID: poiID, userID: "{{ Auth::user()->id }}", name: "{{ Auth::user()->first_name.' '.Auth::user()->last_name }}", hostNotificationID: notificationID, title: title};
              var num = +$('.glyphicon-bell').attr("data-count");
          num = num - 1;
          $('.glyphicon-bell').attr('data-count', num);
        $.ajax({
                        url: "/joinRegister",
                        type: "POST",
                        data: data,
                        success: function (e) {
                            if (confirm("You want to see the accepted event page?"+poiID)) {
                                window.location.href = '/joinEvent/'+poiID;
                            }
                          
                            
                        }
                    });
        return false;
      
    });


    $('.notification-item').find('.btn-warning').live('click', function() {
            $(this).parent().find('.btn').attr('disabled', 'disabled');
      var notificationID = $(this).parent('.notification-item').attr('id');
      var poiID = $(this).attr('id')
      var data = {poiID: poiID, hostNotificationID: notificationID};
      var $this = $(this);
      $this.html('Rejected');
            $this.parent().fadeOut('slow', function() {
                $(this).remove();
            });
            var num = +$('.glyphicon-bell').attr("data-count");
      num = num - 1;
      $('.glyphicon-bell').attr('data-count', num);
       $.ajax({
                        url: "/removeHostNotification",
                        type: "POST",
                        data: data,
                        success: function (e) {
                          

                        }
                    });
       return false;
    })
        })
    </script>
@endsection