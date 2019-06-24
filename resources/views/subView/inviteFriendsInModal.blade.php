


    <!-- Trigger the modal after create event details -->
    <!-- Modal -->
    <div id="inviteFriendsModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 500px;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Invite Your friends</h4>
                </div>
                 <div class="col-xs-12 login-page">
                    <form method="post"  action="/inviteFriends" class="register-form" id="invite-friends-form">
                     {{ csrf_field() }}
                         @if (count($friends) > 0)
                            @foreach ($friends as $friend)
                            <div class="row" style="padding: 5px;">
                                <input type="hidden" name="id" value="{{ $markers->id }}" />
                                <input type="hidden" name="title" value="{{ $markers->title }}" />
                                <input type="hidden" name="viewType" value="{{ $markers->viewType }}" />
                                <input type="hidden" name="noOfAttendees" value="{{ $markers->noOfAttendees }}" />
                                       <div class="avatar avatarImage col-lg-4">
                                            <img id="userImage" width="50" src="{{ $friend->user_picture }}">
                                        </div>
                                            <div class="col-lg-6"><a href="/publicProfile/{{ $friend->id }}"><h4>{{ $friend->first_name.' '.$friend->last_name }}</h4></a></div>
                                            <div class="col-lg-2">
                                            <input style="margin: 15px;" id="{{ $friend->id }}" value="{{ $friend->id }}" name="inviteFriends[]" type="checkbox" />
                                            </div>
                            </div>
                                        


                            @endforeach
                        @else
                            <strong>You don't have any friends yet.</strong>
                        @endif
                        <div class="clear"></div>
                        <div class="inviteFriendsSubmit">
                            <input type="submit" id="submit" value="Submit">
                        </div>
                        </form>
                    </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        $('.dropdown-menu').on('click', function() {
        });

        $('#inviteFriendsModalBtn').on('click', function() {
              var $this = $('#inviteFriendsModal').find('.login-page');
              $this.find('form').remove();
              $this.append('<div style="margin-left: 200px;" class="loadersmall"></div>');
              $.ajax({
              url: '/getUnregisterFriends/'+{{ $markers->id }},
              type: 'get',
              success: function(data) {
                $this.find('div').remove();
                if (data.length == 0) {
                  $this.append("<strong>You don't have any friends yet.</strong>");
                } else {
                  $this.append('<form method="post"  action="/inviteFriends" class="register-form" ' + 'id="invite-friends-form">{{ csrf_field() }}<div class="clear"></div>'+
                          '<div class="inviteFriendsSubmit">' +
                             ' <input type="submit" id="submit" value="Submit">' +
                          '</div></form>');

                    $.each(data, function(key, value) {

                      $this.find('form').prepend('<div class="row" style="padding: 5px;">' +
                                    '<input type="hidden" name="id" value="{{ $markers->id }}" />' +
                                    '<input type="hidden" name="title" value="{{ $markers->title }}" />' +
                                    '<input type="hidden" name="viewType" value="{{ $markers->viewType }}" '+ '/><input type="hidden" name="noOfAttendees"' + ' value="{{ $markers->noOfAttendees }}" />' + '<div class="avatar avatarImage col-lg-4"><img id="userImage" width="50" src="' + value.user_picture + '">' + '</div><div class="col-lg-6"><a href="/publicProfile/' + value.id + '"><h4>' + value.first_name +' '+ value.last_name + '</h4></a></div> ' + '<div class="col-lg-2"><input style="margin: 15px;" id="' + value.id + '" value="' + value.id + '"' + ' name="inviteFriends[]" type="checkbox" /></div></div>');
                    })
                  }

              }
              
            })
        })

        $("#inviteFriendsModal").delegate("#invite-friends-form", 'submit', function (e) {
            e.preventDefault();

             $.ajax({
                        url: $(this).attr("action"),
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: new FormData(this),
                        success: function (data) {
                            $('#inviteFriendsModal').modal('hide');
                            if (data == 'false') {
                                $('.join-event-alert').removeClass('alert-success');
                                $('.join-event-alert').addClass('alert-danger');
                                $('.join-event-alert').find('strong').html('Sorry!');
                                $('.join-event-alert').css('display', 'block').append('Invitation unsuccessfull invitation reached out of capacity. Thanks!');
                                alert('Sorry invitation unsuccessfull invitation reached out of capacity. Thanks!');
                            } else {
                                $('.join-event-alert').css('display', 'block').append('Friends are invited successfully. Thanks!');
                            }
                            
                        }
                    });
              
         });
        $('#inviteFriendsModal').delegate('.row', 'click', function() {
           var checkBox = $(this).find('input');
            var check = checkBox.is(':checked');
          if(check)
            checkBox.prop('checked',false);
          else
             checkBox.prop('checked',true);


         return false; 
       })
    })
    
</script>