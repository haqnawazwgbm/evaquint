


    <!-- Trigger the modal after create event details -->
    <!-- Modal -->
    <div id="eventReport" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 500px;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Report</h4>
                </div>
                 <div class="col-xs-12 login-page">
                    <form method="post"  action="/insertReport" class="register-form" id="report-form">
                     {{ csrf_field() }}
                     <input type="hidden" name="poiID" value="{{ $markers->id }}" />
                            <div class="col-lg-12" style="padding: 5px;">
                              <div class="description">
                                  <label for="description">* Description:</label>
                                  <div class="clear "></div>
                                  <textarea rows="4" cols="70" placeholder="Description..." name="description"></textarea>
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
                            $('#eventReport').modal('hide');
                           if (e) {
                              $('.join-event-alert').css('display', 'block').append('Report created successfully.');
                           }
                            
                        }
                    });
        })


    })
    
</script>