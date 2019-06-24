
<div class="dropdown ">
   <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" >
        <i {{ $requests->countDown }} class="fa fa-users {{ $requests->notificationIcon }}"></i>
    </a>
    <ul class="dropdown-menu friendRequest" role="menu" aria-labelledby="dLabel">

        <div class="notification-heading"><h4 class="menu-title">Friend Requests</h4>
        </div>
        <li class="divider"></li>
        <div class="notifications-wrapper friend-request-wrapper">
        @if ($requests->totalRequests > 0)
            @foreach ($requests as $request)

                <a class="content requests-block" href="#">
                    <div class="notification-item">
                        <img src="{{ $request->user_picture }}" width="60" />
                        <a class="friendRequestName" href="publicProfile/{{ $request->id }}">{{ $request->first_name.' '.$request->last_name }}</a>
                       <div id="{{ $request->guest_id }}" friend-id="{{ $request->friend_id }}" class="btn btn-primary btn-small acceptRequest">Accept</div>
                        <div id="{{ $request->guest_id }}" class="btn btn-warning  btn-small rejectRequest">Reject</div>

                    </div>
                </a>
                @endforeach
        @else
                <a class="content notification-block" href="#">
                    <div class="notification-item">
                        <h4 class="item-title"></h4>
                        <p class="item-info">No Friend Requests yet.</p>
                    </div>
                </a>
        @endif    
        </div>

        <li class="divider"></li>
    </ul>


</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $('.friend-request-wrapper').find('.notification-item').find('.acceptRequest').live( 'click', function() {
            $(this).parent().find('.btn').attr('disabled', 'disabled');
            var $this = $(this);
            var data = { guest_id: $(this).attr('id'), decision: 'yes' };
            $.ajax({
                url: '/friendRequest',
                type: 'post',
                data: data,
                success: function(e) {
                    $this.html('Accepted');
                    $this.parent().fadeOut('slow', function() {
                        $this.remove(); 
                    });
                      var num = +$('.fa-users').attr("data-count");
					    num = num - 1;
					    $('.fa-users').attr('data-count', num);
                }
            });
            return false;
        })
        $('.friend-request-wrapper').find('.notification-item').find('.rejectRequest').live('click', function() {
             $(this).parent().find('.btn').attr('disabled', 'disabled');
            var $this = $(this);
            var data = { guest_id: $(this).attr('id'), decision: 'no' };
            $.ajax({
                url: '/friendRequest',
                type: 'post',
                data: data,
                success: function(e) {
                    $this.html('Rejected');
                    $this.parent().fadeOut('slow', function() {
                        $this.remove();
                    });
                    var num = +$('.fa-users').attr("data-count");
					    num = num - 1;
					    $('.fa-users').attr('data-count', num);
                }
            });
            return false
        })


        //Check friend request event function start from here.
        setInterval(update,3000);

        function update() {
            var id = $('.friend-request-wrapper').find('.notification-item').last().find('.acceptRequest').attr('id');
            var friendID = $('.friend-request-wrapper').find('.notification-item').last().find('.acceptRequest').attr('friend-id');
            data = { guest_id: id, friend_id: friendID };
            $.ajax({
                url: '/getFrinedRequest',
                data: data,
                type: 'post',
                success: function(data) {
                    var totalRows = 0;
                    $.each(data, function(i, v) {
                        if (!friendID) {
                            $('.friend-request-wrapper').find('.notification-block').remove();
                            $('.friendRequest').prev().find('i').attr('data-count', 0);
                            $('.friendRequest').prev().find('i').addClass('notification-icon');
                         }
                        $('.friend-request-wrapper').append(' <a class="content requests-block" href="#">'+
                    '<div class="notification-item">'+
                        '<img src="'+v.user_picture+'" width="40" />'+
                        '<a class="friendRequestName" href="publicProfile/'+v.id+'">'+v.first_name+" "+v.last_name+'</a>'+
                        '<div id="'+v.guest_id+'" friend-id="'+v.friend_id+'" class="btn btn-primary btn-small acceptRequest">Accept</div>'+
                        '<div id="'+v.guest_id+'" class="btn btn-warning  btn-small rejectRequest">Reject</div>'+

                    '</div></a>');
                        totalRows++;
                    })
                     var num = +$('.dropdown').find('a').find('.fa-users').attr("data-count");
                        num = num + totalRows;
                        $('.dropdown').find('a').find('.fa-users').attr('data-count', num);
                }
            })
        }
    })
</script>