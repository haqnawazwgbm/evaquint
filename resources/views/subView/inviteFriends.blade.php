
<li class="dropdown" id="listFriends">

    <ul class="dropdown-menu" style="min-width: 300px; padding-left: 10px;">
    

    </ul>
</li>
<script type="text/javascript">
    $(document).ready(function() {
        $('.inviteFriends').on('click', function() {
          var $this = $(this).next();
              $this.find('ul').find('li').each(function() {
                $(this).remove();
              });
              $this.find('ul').append('<div class="loadersmall"></div>');
              $.ajax({
              url: '/getFriends',
              type: 'get',
              success: function(data) {
                $this.find('ul').find('div').remove();
                if (data.length == 0) {
                  $this.find('ul').append("<strong>You don't have any friends yet.</strong>");
                } else {
                  $.each(data, function(key, value) {
                    $this.find('ul').append('<li>'+
                                ' <div class="avatar avatarImage">' + 
                                  '<img style="margin-right: 20px;" id="userImage" width="50" src="' + value.user_picture + '">' + 
                                  '<span><a  data-toggle="popover" class="showPublicProfile" name="' + value.first_name+' '+value.last_name + '"id="' + value.friend_id + '" ' + 'href="#">' + value.first_name +' ' + value.last_name + '</a></span></div>' + '<input id="' + value.id + '" value="' +value.id + '" name="inviteFriends[]" class="selectInviteFriend"' + ' type="checkbox" /></li>')
                  })
                }

                
                

              }
              
            })

      })

       $('#listFriends').delegate('.showPublicProfile', 'click', function() {
       $('[data-toggle="popover"]').popover('hide');
       var id = $(this).attr('id');
        $(this).popover({
                title: $(this).attr('name'),
                animation: false,
                content: '<a href="publicProfile/'+id+'" >Go to profile</a><br/><a class="invitePopover" href="#">Mark for invite</a>',
                html: true,
                placement: "top",
                trigger: "click"
            });
        $(this).popover('show');
          $('[data-toggle="popover"]').on("show.bs.popover", function () { $(this).data("bs.popover").tip().css("position", "fixed"); }); 
        return false;
       }) 
       $('html').on('click', function() {
          $('[data-toggle="popover"]').popover('hide');
       })
       $('#listFriends').delegate('.invitePopover', 'click', function() {
            $(this).parents('.avatarImage').find('.selectInviteFriend').prop('checked', true);

            return false;
       })

       //Handle the click event for checkbox
       $('#listFriends').delegate('.avatarImage', 'click', function() {
        if ( $(this).hasClass( 'avatarImage' ) ) {
            var checkBox = $(this).next('.selectInviteFriend');
            var check = checkBox.is(':checked');
            if(check)
              checkBox.prop('checked',false);
            else
               checkBox.prop('checked',true);

           return false;
         }
            
       })
  
    })
</script>