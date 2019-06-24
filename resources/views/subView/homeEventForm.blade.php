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
                            <div class="name">
                                <label for="location">* Location:</label>
                                <div class="clear"></div>
                                <input data-toggle="popover" title="Location Not Found" id="location" data-placement="top" name="location" type="text" placeholder="Canada" required="">
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
        <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function mySharePopup(url) {
            window.open(url, "myWindow", "status = 1, height = 500, width = 360, resizable = 0")
        }

    </script>
<script>
    $(document).ready(function() {
        var showMap = true;
        var image = '/img/categories/1_marker.png';
        var showEvents = true;
        var small_markers = [];
          // Reset all input field after hide modal
            $('#myModal').on('hidden.bs.modal', function(){
                $('#register-form')[0].reset();
            });

            // Set modal for public and private
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
                  // Change map marker when choose different type of event.
                var value = $('#eventCategory').val();
                image = '/img/categories/' + value + '_marker.png';
            });
            $('#eventCategory').change(function() {
                var value = $('#eventCategory').val();
                image = '/img/categories/' + value + '_marker.png';
                var viewType = $('#viewType').val();
                if (viewType == 'tournament') {
                    image = '/img/marker.png';
                }
            })

             

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

           
             // Start beside map section start from here.
            var marker;
            @if (! Auth::guest())
                var parliament = new google.maps.LatLng({{ Auth::user()->lat }}, {{ Auth::user()->lng }});
            @else
                var parliament = new google.maps.LatLng(49.288811, -123.111153);
            @endif;
            var  mapOptions = {
                zoom: 17,
                minZoom: 5,
                center: parliament,
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: true,
                overviewMapControl: true,
                rotateControl: true
            };
            var small_map;
             // Create the search box and link it to the UI element.
            var input;
            var searchBox;
            var showLocationAutoComplete = true;

            $('.createEvent').on('click', function() {
                $('#myModal').modal({
                    show: 'true'
                });
                small_map = new google.maps.Map(document.getElementById('home_map'), mapOptions);
                // Create the search box and link it to the UI element.
                input = document.getElementById('location');
                searchBox = new google.maps.places.SearchBox(input);
                google.maps.event.addListenerOnce(small_map, 'idle', function () {
                  google.maps.event.trigger(small_map, 'resize');
               });
                // Create marker section start from here.
                listenerHandle = google.maps.event.addListener(small_map, 'click', function (event) {
                     if (marker)
                        marker.setMap(null);

                        marker = new google.maps.Marker({
                        position: event.latLng, 
                        map: small_map,
                        icon: image
                    });
                        $('#lat').val(event.latLng.lat());
                        $('#lon').val(event.latLng.lng());
                        getAddressName(event.latLng);
                });

            })

         

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

                                if (data[i].eventType == 2) {
                                    small_icon = '/img/small_socialMarker.png';
                                }
                                else {
                                       if (data[i].eventType == 3) {
                                            small_icon = '/img/small_otherMarker.png';
                                       }
                                        else {
                                            small_icon = '/img/small_marker.png';
                                        }             
                                }
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

            //Create marker detail start from here.
            $("#register-form").submit(function (e) {
                @if (Auth::guest())
                        window.location = "{{ '/login' }}";
                @endif
                e.preventDefault(); // avoid to execute the actual submit of the form.
                $('#myModal').modal('hide');

              //  $(".loader").fadeIn();
                $.ajax({
                    type: 'POST',
                    url: $("#register-form").attr("action"),
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    success: function (data) {
                        $('#myModalShare').modal({
                            show: 'true'
                        });
                    }
                });
            });

            // Get address name where event is created
             function getAddressName(result, status) {
                    var location = result;
                    var request = {
                        location: result,
                        keyword: 'food',
                        radius: 500
                    };
                    service = new google.maps.places.PlacesService(small_map);

                    service.radarSearch(request, callback);
                    function callback(result, status) {
                         if (status !== google.maps.places.PlacesServiceStatus.OK) {
                            console.error(status);
                            $('#location').prop('readonly',false);
                            $('#location').attr('data-content', "We can't find the address you selected in google map record. Please enter it manualy").popover('show')
                            .val('');
                            console.log('error');
                            showLocationAutoComplete = false;
                            return;
                        } else {
                            $('#location').prop('readonly',true);
                            showLocationAutoComplete = true;
                        }
                        var result = result[0];

                        service.getDetails(result, function (result, status) {
                        if (status !== google.maps.places.PlacesServiceStatus.OK) {
                            console.error(status);
                            return;
                        }
                        address = result.formatted_address;
                        console.log(address);
                        $('#location').val(address);
                        $('#location').popover('destroy');
                        $('#lat').val(location.lat());
                        $('#lon').val(location.lng());

                    });

                    }

                  
                }

            
    })
</script>