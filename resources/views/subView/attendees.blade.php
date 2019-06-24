<span class="noOfParticipant">{{ count($markers->joinedUsers) }}</span>/<span
        class="totalAttendees">{{ $markers->noOfAttendees }}</span>
<li class="dropdown" id="listAttendees">

    <ul class="dropdown-menu" style="min-width: 200px; padding-left: 10px;">
        @if (count($markers->joinedUsers) > 0)
            @foreach ($markers->joinedUsers as $joinedUser)
                <li>
                    <div class="row">
                        <div class="avatar avatarImage">
                            <img id="userImage" src="{{ $joinedUser->user_picture }}">
                        </div>

                        <span><a class="showPublicProfile" id="{{ $joinedUser->id }}" href="/{{ $joinedUser->id == $markers->user_id ? 'profile' : 'publicProfile/'.$joinedUser->id }}">{{ $joinedUser->first_name.' '.$joinedUser->last_name }}</a></span>
                        @if ($markers->user_id == Auth::user()->id)
                        <a href="#" class="deleteUserFromEvent"
                           id="{{ $joinedUser->joinEventID }}">
                            <span class="glyphicon glyphicon-remove  pull-right"></span>
                        </a>
                            @endif
                    </div>

                </li>
            @endforeach
        @else
            <strong>No one joined this event yet.</strong>
        @endif
    </ul>
</li>
<script>
$(document).ready(function() {
      //Delete users from event section start here.
            $("body").delegate('.deleteUserFromEvent', 'click', function (e) {
                e.preventDefault();
                if (confirm("Are your sure to remove this user from you'r event?")) {
                    var joinEventID = $(this).attr('id');
                    var data = {joinEventID: joinEventID, title: "{{ $markers->title }}", poiID: {{ $markers->id }}};
                    var $this = $(this);
                    $.ajax({
                        url: "/deleteUserFromEvent",
                        type: "POST",
                        data: data,
                        success: function(e) {
                            $this.parent().parent().remove();
                            $('.alert-success').css('display', 'block').append(' User removed successfully.');
                        }
                    });

                }

            });
            $('body').on('click', '.showPublicProfile', function(e) {
                var href = $(this).attr('href');
                window.location.href = href;
            });
        });
</script>