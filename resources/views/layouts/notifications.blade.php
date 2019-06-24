
<div class="dropdown ">
   <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" >
        <i {{ $notifications->countDown }} class="glyphicon glyphicon-bell {{ $notifications->notificationIcon }}"></i>
    </a>

    <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

        <div class="notification-heading"><h4 class="menu-title">Notifications</h4><h4 class="menu-title pull-right"><a href="#" class="readAllNotifications" >Mark all as read</a><a href="/allNotifications"> View all<i class="glyphicon glyphicon-circle-arrow-right"></a></i></h4>
        </div>
        <li class="divider"></li>
        <div class="notifications-wrapper event-notifications-wrapper">
            @if (count($notifications) > 0)
            @foreach ($notifications as $notification)
            <a href="{{ '/joinEvent/'.$notification->poiID }}">
                <div class="notification-item notification-block-item" notification="unread" notificationType="{{ (isset($notification->hostNotificationID)?'host_notification':'event_notification') }}" id="{{ (isset($notification->hostNotificationID)?$notification->hostNotificationID:$notification->notificationID) }}">
                    <h4 class="item-title">{{ $notification->notificationType }}<span data-toggle="tooltip" title="Mark as read" class="fa fa-envelope-open notification_envelope pull-right"></span></h4>
                    <p class="item-info"><?php echo html_entity_decode($notification->message); ?></p>
                </div>
                </a>
            @endforeach

                @else
                <a class="content notification-block" href="#">
                    <div class="notification-item">
                        <h4 class="item-title"></h4>
                        <p class="item-info">No Notifications yet.</p>
                    </div>
                </a>
                @endif
        </div>

        <li class="divider"></li>
        <div class="notification-footer"><h4 class="menu-title"><a href="/allNotifications" >View all<i class="glyphicon glyphicon-circle-arrow-right"></i></a></h4></div>
    </ul>

</div>
<script>
	$(document).ready(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $('.notification_envelope').live('click', function() {
            var type = $(this).parents('.notification-block-item').attr('notificationType');
            var id = $(this).parents('.notification-block-item').attr('id');
            var read = $(this).parents('.notification-block-item').attr('notification');
            var data = {id: id, type: type};
            var url = '/unreadNotification'
            if (read == 'unread') {
                $(this).addClass('fa-envelope');
                $(this).removeClass('fa-envelope-open');
                $(this).attr('data-original-title', 'Mark as unread').tooltip('show');
                url = '/readNotification';
                $(this).parents('.notification-block-item').attr('notification', 'read');
                var num = +$('.glyphicon-bell').attr("data-count");
                    num = num - 1;
                    $('.glyphicon-bell').attr('data-count', num);
            } else {
                $(this).removeClass('fa-envelope');
                $(this).addClass('fa-envelope-open');
                $(this).attr('data-original-title', 'Mark as read').tooltip('show');
                $(this).parents('.notification-block-item').attr('notification', 'unread');
                var num = +$('.glyphicon-bell').attr("data-count");
                    num = num + 1;
                    $('.glyphicon-bell').attr('data-count', num);
            }
            $.ajax({
                url: url,
                data: data,
                type: 'post',
                success: function() {
                }
            })
            return false;
        })
		$('.notification-block-item').find('.btn-primary').live('click', function() {
            $(this).parent().find('.btn').attr('disabled', 'disabled');
			var notificationID = $(this).parent('.notification-block-item').attr('id');

			 var $this = $(this);
			 var title = $this.attr('title');
			  $this.html('Accepted');
              $this.parent().fadeOut('slow', function() {
                $(this).remove();
              });
              var data = {poiID: $(this).attr('id'), userID: "{{ Auth::user()->id }}", name: "{{ Auth::user()->first_name.' '.Auth::user()->last_name", hostNotificationID: notificationID, title: title};
              var num = +$('.glyphicon-bell').attr("data-count");
					num = num - 1;
					$('.glyphicon-bell').attr('data-count', num);
			  $.ajax({
                        url: "/joinRegister",
                        type: "POST",
                        data: data,
                        success: function (e) {
                            if (confirm("You want to see the accepted event page?"+$this.attr('id'))) {
                                window.location.href = '/joinEvent/'+$this.attr('id');
                            }
                        	
                            
                        }
                    });
			  return false;
			
		});

		$('.notification-block-item').find('.btn-warning').live('click', function() {
            $(this).parent().find('.btn').attr('disabled', 'disabled');
			var notificationID = $(this).parent('.notification-block-item').attr('id');
			var data = {poiID: $(this).attr('id'), hostNotificationID: notificationID};
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

          //Check notification event function start from here.
          setInterval(update,2000);

        function update() {
            var type;
            var notificationID = $('.event-notifications-wrapper').find('.notification-item').first().attr('id');
            var i = 0;
            var j = 0;
            var hostNotificationID;
            var notificationID 
            $('.event-notifications-wrapper').find('.notification-item').each(function(e) {
                type = $(this).attr('notificationType');
                if (type == 'host_notification' && i == 0) {
                    hostNotificationID = $(this).attr('id');
                    i++;
                } 
                if (type == 'event_notification' && j == 0) {
                    notificationID = $(this).attr('id');
                    j++;
                }

            })
            var currentDate = getCurrentDate('current');
            var incrementDate = getCurrentDate('increment');

            data = { notificationID: notificationID, type: type, hostNotificationID: hostNotificationID, 
                    currentDate: currentDate, incrementDate: incrementDate };
            $.ajax({
                url: '/getNewNotification',
                data: data,
                type: 'post',
                success: function(data) {
                    var totalRows = 0;
                    $.each(data, function(i, v) {
                        if (!notificationID) {
                            $('.event-notifications-wrapper').find('.notification-block').remove();
                            $('.notifications').prev().find('i').attr('data-count', 0);
                            $('.notifications').prev().find('i').addClass('notification-icon');
                        }
                        
                        $('.event-notifications-wrapper').prepend('<a href="/joinEvent/'+v.hostNotificationID+'">'+
                '<div class="notification-item notification-block-item" notification="unread" notificationType="'+((v.hostNotificationID) ? 'host_notification' : 'event_notification')+'" id="'+((v.hostNotificationID) ? v.hostNotificationID : v.notificationID)+'">'+
                    '<h4 class="item-title">'+v.notificationType+'<span data-toggle="tooltip"  data-original-title="Mark as read" title="Mark as read"'+ 'class="fa fa-envelope-open notification_envelope pull-right"></span></h4>'+
                    '<p class="item-info">'+v.message+'</p></div></a>');
                        totalRows++;
                    })
                    var num = +$('.glyphicon-bell').attr("data-count");
                    num = num + totalRows;
                    $('.glyphicon-bell').attr('data-count', num);
                    


                }
            })
        }

        $('.readAllNotifications').on('click', function() {
            $('.glyphicon-bell').attr('data-count', 0);
            $.ajax({
                url: '/readAllNotifications',
                type: 'get',
                success: function() {
                        $('.notification_envelope').parents('a').each(function() {
                        var $this = $(this).find('.notification-block-item');
                        $this.attr('notification', 'read');
                        $this.find('.notification_envelope').addClass('fa-envelope');
                        $this.find('.notification_envelope').removeClass('fa-envelope-open');
                        $this.find('.notification_envelope').attr('data-original-title', 'Mark as unread');
                       });
                }
            })

            return false;
        })
	})
 // Get current date start from here
            function getCurrentDate(date) {
                var today = new Date();
                var time = today.toLocaleTimeString().replace(/([\d]+:[\d]{2})(:[\d]{2})(.*)/, "$1$3")
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();
                var hh = today.getHours();
                var i = today.getMinutes();
                var s = today.getSeconds();
                var isPM = today.getHours() >= 12;
                var incrementHour = today.getHours() + parseInt(<?php echo Auth::user()->before_hours; ?>);
                // isPM = ;

                if (dd < 10) {
                    dd = '0' + dd
                }

                if (mm < 10) {
                    i
                    mm = '0' + mm
                }

                today = yyyy + '/' + mm + '/' + dd + ' ' + hh + ':' + i + '  ' + (isPM ? ' pm' : 'am');
                phpDate = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + i + ':' + s;
                phpIncrementDate = yyyy + '-' + mm + '-' + dd + ' ' + incrementHour + ':' + i + ':' + s;
                if (date == 'current')
                    return phpDate;
                else 
                    return phpIncrementDate;
            }
</script>
