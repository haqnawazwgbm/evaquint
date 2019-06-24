
  <!-- Trigger the modal after create event details -->
    <!-- Modal -->
    <div id="blockUser" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 500px;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Block User</h4>
                </div>
                 <div class="col-xs-12 login-page">
                    <form method="post"  action="/blockUser" class="register-form" id="block-user-form">
                     {{ csrf_field() }}
                     <input type="hidden" id="user_id" name="user_id" value="{{ $users->id }}" />
                            <div class="col-lg-12" style="padding: 5px;">
                            <p>Are you sure you want to block {{ $users->first_name.' '.$users->last_name }}?</p>
                            <p>{{ $users->first_name.' '.$users->last_name }} will no longer be able to see your events and not can register your events.</p>
                              
                            </div>

                        
                        </form>
                    </div>
                <div class="modal-footer">

                    <button type="button" id="confirm-block" class="btn btn-primary">Confirm</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
       <!-- Trigger the modal after create event details -->
    <!-- Modal -->
    <div id="userReport" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 500px;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Report</h4>
                </div>
                 <div class="col-xs-12 login-page">
                    <form method="post"  action="/insertUserReport" class="register-form" id="report-form">
                     {{ csrf_field() }}
                     <input type="hidden" class="form-control" name="user_id" value="{{ $users->id }}" />
                            <div class="col-xs-12" style="padding: 5px;">
                              <div class="description">
                                  <label for="description">* Description:</label>
                                  <div class="clear "></div>
                                  <textarea class="form-control" placeholder="Description..." name="description"></textarea>
                              </div>
                            </div>

                        <div class="reportSubmit">
                            <input style="margin-bottom: 0px; margin-left: 5px;" type="submit" id="submit" value="Submit">
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



        $('#report-form').on('submit', function(e) {
          e.preventDefault();
            var $this = $(this);
            $.ajax({
                        url: $(this).attr("action"),
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: new FormData(this),
                        success: function (e) {
                            $('#userReport').modal('hide');
                           if (e) {
                              $('.block-report-alert').css('display', 'block').append('Report created successfully.');
                           }
                            
                        }
                    });
        })
        $('#confirm-block').on('click', function(e) {
          e.preventDefault();
            var $this = $('#block-user-form');
            var id = $('#block-user-form').find('#user_id').val();
            $.ajax({
                        url: $('#block-user-form').attr("action"),
                        type: 'POST',
                        data: {user_id: id},
                        success: function (e) {
                            $('#blockUser').modal('hide');
                           if (e) {
                              $('.block-report-alert').css('display', 'block').append('User blocked successfully.');
                           }
                            
                        }
                    });
        })
	})
</script>