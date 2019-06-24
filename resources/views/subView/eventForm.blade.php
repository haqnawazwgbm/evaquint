   <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create event details</h4>
                </div>
                <ul class="nav nav-tabs viewType">
                    <li class="active"><a data-toggle="tab">Public</a></li>
                    <li ><a data-toggle="tab">Private</a></li>
                    <li data-toggle="tooltip" title="{{ $markers->tournamentModeTitle }}"><a data-toggle="tab" class="{{ $markers->btnTournament }}">Tournament</a></li>
                </ul>
                    <div class="col-md-12 login-page tab-pane fade in active">
                        <form method="post" enctype="multipart/form-data" action="createMarker" class="register-form"
                              id="register-form">
                            <input type="hidden" id="markerID" name="markerID"/>
                            <input type="hidden" id="viewType" name="viewType" value="public" />

                            <div class="name">
                                <label for="title">* Title:</label>
                                <div class="clear"></div>
                                <input id="title" name="title" type="text" placeholder=" Title" required="">
                            </div>
                            <div class="typeDropDown">
                                <label for="eventType">* Event Type:</label>
                                <div class="clear "></div>
                                <select class="form-control" id="eventType" name="eventType">
                                @foreach ($markers->event_types as $event_type)
                                    <option value="{{ $event_type->event_type_id }}">{{ $event_type->type }}</option>
                                @endforeach
                                </select>
                            </div>
                              <div class="typeDropDown">
                                <label for="eventCategory">* Category:</label>
                                <div class="clear "></div>

                                <select class="form-control" id="eventCategory" name="eventCategory">
                                @foreach ($markers->categories as $category)
                                    <option value="{{ $category->event_category_id }}">{{ $category->category }}</option>
                                 @endforeach
                               
                                </select>
                            </div>

                            <div class="eventPicture">
                                <label for="eventPicture">* Picture:</label>
                                <div class="clear "></div>
                                <div class="container_photo"></div>
                            </div>
                            <div class="location">
                                <label for="location">* Location:</label>
                                <div class="clear"></div>
                                <input type="text"  data-toggle="popover" title="Location Not Found" id="location" data-placement="top" name="location" placeholder="Canada" required="">
                                <a href="#" class="showMap" data-toggle="tooltip" title="Click to show map"><span class="glyphicon glyphicon-map-marker"></span></a>
                            </div>
                            <div class="dateTime">
                                <label for="dateTime">* Date And Time:</label>
                                <div class="clear"></div>
                                <input id="dateTime" name="dateTime" type="text" required=""
                                       placeholder="2016/11/16">
                            </div>
                            <div class="noOfAttendees typeDropDown">
                                <label for="noOfAttendees">* Number of Attendees:</label>
                                <div class="clear "></div>
                                <input type="number" min="2" class="form-control" id="noOfAttendees" name="noOfAttendees" required>
                            </div>
                            <div class="inviteFriends">
                                <div class="btn btn-primary"  data-toggle="dropdown" data-target="#listFriends"><span>Invite Friends</span><span class="glyphicon glyphicon-chevron-down"></span>

                                </div>
                            </div>
                            @include('subView.inviteFriends')


                            <div class="eventDescription">
                                <label for="eventDescription">* Event Description:</label>
                                <div class="clear "></div>
                                <textarea name="eventDescription" id="eventDescription" placeholder="Characters will not more than 180" rows="4"
                                          maxlength="180" required cols="40"></textarea>
                                          <div id="inputcounter"></div>
                            </div>
                            <input type="hidden" id="lat" name="lat"/>
                            <input type="hidden" id="lon" name="lon"/>
                            <div id="register-submit">
                                <input type="submit" id="submit" value="Submit">
                            </div>
                        </form>
                        <div class="ctn-img">
                            <img src="/img/federer.png">
                            <div id="home_map" style="visibility: hidden"> </div>
                            <div class="btn btn-sm btn-primary showEvents">ShowEvents</div>
                        </div><!--Close Images-->
                        <div class="clear"></div>
                            
                    </div>


            </div>

        </div>
    </div>
  <!-- Trigger the modal after create event details -->
    <!-- Modal -->
    <div id="myModalShare" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Congratulations! Your event has been posted</h4>
                </div>
                <div class="modal-body">
                    <h4>Tell your friends.</h4>
                    <div class="row">
                        <!-- 1-->
                    <div class="col-md-3">
                        <a data-site="" class="ssba_google_share"
                           href="javascript:mySharePopup('https://plus.google.com/share?url=http://fleek.mindgigspk.com/')"
                           target="_blank"><img src="/img/googleShare.png" title="Google+" class="ssba ssba-img"
                                                alt="Share on Google+"></a>
                    </div>
                    <!-- 2-->
                    <div class="col-md-3">
                        <a data-site="" mobile_iframe="false" data-mobile_iframe="false" class="ssba_facebook_share"
                           href="javascript:mySharePopup('http://www.facebook.com/sharer.php?u=http://fleek.mindgigspk.com/')"
                           target="_blank"><img
                                    src="/img/facebookShare.png"
                                    title="Facebook" class="ssba ssba-img" alt="Share on Facebook"></a>
                    </div>
                    <!-- 3-->
                    <div class="col-md-3">
                        <a data-site="" class="ssba_twitter_share"
                           href="javascript:mySharePopup('http://twitter.com/share?url=http://fleek.mindgigspk.com/')"
                           target="_blank"><img src="/img/twitterShare.png" title="Twitter" class="ssba ssba-img"
                                                alt="Tweet about this on Twitter"></a>
                    </div>


                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                
            </div>
           

        </div>
         
    </div>

<script>
    $(document).ready(function() {
       
        //var image = '/img/categories/1_marker.png';
        var showMap = 'true';
        var showEvents = true;
        var small_markers = [];
          // Reset all input field after hide modal
            $('#myModal').on('hidden.bs.modal', function(){
                $('#register-form')[0].reset();
            });

            // Set modal for public, private and tournament
            $('.viewType').find('li').on('click', function() {
                var title = $(this).find('a').html();
                if (title == 'Public') {
                    $('#viewType').val('public');
                    $('.noOfAttendees').show();
                    $('#noOfAttendees').attr('min', 2).val('');
                } else {
                    if (title == 'Private') {
                        $('#viewType').val('private');
                        $('.noOfAttendees').hide()
                        $('#noOfAttendees').val(1).attr('min', 0);
                    } else {
                        if ($(this).find('a').hasClass( "btnTournament" )) {
                            return false;
                        } else {
                            $('#viewType').val('tournament');
                            $('.noOfAttendees').show();
                            $('#noOfAttendees').attr('min', 2).val('');
                            image = '/img/marker.png';
                        }
                        
                    }
                    

                }
            });

                  //Image crop start from here.
            $(".container_photo").PictureCut({
                InputOfImageDirectory: "image",
                PluginFolderOnServer: "/js/",
                FolderOnServer: "/uploads/",
                EnableCrop: true,
                CropWindowStyle: "Bootstrap"
            });

            prettyPrint();

             // Initialize all global variables of modal form.
            $("body").delegate('#submit', 'click', function () {
                title = $('#title').val();
                today = $('#dateTime').val();
                address = $('#location').val();
             
                
            });
          
             

            //Initialize bootstrap datepicker from here
            $('#dateTime').datetimepicker({

                formatTime: 'H:i A',
                format: 'Y-m-d g:i A',
                formatDate: 'Y.m.d',
                //defaultDate:'8.12.1986', // it's my birthday
                defaultDate: '+1970.01.03', // it's my birthday
                defaultTime: '10:00',
                minDate: 'today',
                timepickerScrollbar: false
            });

            // Load event types start from here.
            $('#eventType').on('change', function() {

                $id = $(this).val();
                $('#eventCategory').attr('disabled', 'disabled');
                $.ajax({
                    url: '/eventCategories/'+$id,
                    type: 'GET',
                    success: function(data) {
                        $('#eventCategory').empty();
                        $('#eventCategory').attr('disabled', false);
                        $.each( data, function( index, value ) {
                            $('#eventCategory').append('<option value="'+value.event_category_id+'">'+value.category+'</option>');
                        });
                        var value = $('#eventCategory').val();
                             image = '/img/categories/' + value + '_marker.png';
                        var viewType = $('#viewType').val();
                        if (viewType == 'tournament') {
                            image = '/img/marker.png';
                        }

                    }
                })
            })
            $('#eventCategory').change(function() {
                var value = $('#eventCategory').val();
                image = '/img/categories/' + value + '_marker.png';
                var viewType = $('#viewType').val();
                if (viewType == 'tournament') {
                    image = '/img/marker.png';
                }
            })

           
       /* Start beside map section start from here */
        
       
        $('#myModal').on('show.bs.modal', function(){

           

                });
            //Show map beside after click on marker icon.
            $('.showMap').on('click', function() {
                if (showMap) {
                    $('#home_map').css('visibility', 'visible');
                    $('.showEvents').css('display', 'inline-block');
                    showMap = false;
                } else {
                    $('#home_map').css('visibility', 'hidden');
                    $('.showEvents').css('display', 'none');
                    showMap = true;
                }

            });

            //Show sevents on small map section start from here.
            $('.showEvents').on('click', function() {
                var $this = $(this);
                $this.attr("disabled",true);
                if (showEvents) {
                    $(this).html('Hide Events');
                    var small_icon;
                    var markerParliament;
                    var marker;
                    $.ajax({
                        url: '/getEventsForSmallMap',
                        type: 'get',
                        success: function(data) {
                            for (i = 0; i<data.length; i++) {
                                small_icon = '/img/categories/' + data[i].event_category_id + '_marker.png';
                               
                                markerParliament = new google.maps.LatLng(data[i].lat, data[i].lon);
                                     
                                marker = new google.maps.Marker({
                                    id: data[i].id,
                                    map: small_map,
                                    draggable: false,
                                    animation: google.maps.Animation.DROP,
                                    icon: small_icon,
                                    position: markerParliament
                                });
                                small_markers.push(marker);
                            }
                            $this.attr("disabled",false);
                        }
                    });
                    showEvents = false;
            } else {
                $(this).html('Show Events');
                showEvents = true;
                for (var i=0; i<small_markers.length; i++){
                    console.log(small_markers[i]);
                    small_markers[i].setMap(null);
                }
                $this.attr("disabled",false);
                small_markers = [];
            }

     })


            
    })
</script>