@extends('layouts.site')
@section('content')

    <!--Google Maps-->
        <a href="#" class="btn add-button-event btn-success btn-lg pull-right visible-xs visible-sm hidden-md hidden-lg" >
            <span class="glyphicon glyphicon-plus-sign"></span> Add
        </a>
   <input id="pac-input" class="controls col-md-offset-4  col-md-3" type="text" placeholder="Search Box">
    <ul style=" z-index: 1;
    position: relative;
    top: 40px;" class="pagination pull-right mapPagination" id="pagination">
    </ul>
    <div id="map_container">
        <div id="map_canvas"></div>
    </div>



 <div class="pull-left map-target"><span class="glyphicon glyphicon-screenshot"></span></div>

@endsection

@section('markers')
    <script type="text/javascript">
        /********************************************
         GOOGLE MAPS
         ********************************************/

        // The following example creates a marker in Stockholm, Sweden
        // using a DROP animation. Clicking on the marker will toggle
        // the animation between a BOUNCE animation and no animation.
        $(document).ready(function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            "use strict";
             @if (! Auth::guest())
                var userID = {{ Auth::user()->id }};
                var parliament = new google.maps.LatLng({{ Auth::user()->lat }}, {{ Auth::user()->lng }});
             @else
                  var parliament = new google.maps.LatLng(49.288811, -123.111153);
            @endif;
            var button = 'rightclick';
            var title;
            var stockholm = new google.maps.LatLng(49.288811, -123.111153);
            var image = '/img/marker.png';
            var i;
            var marker;
            var myMarkers = [];
            var myIndexMarkers = [];
            var map;
            var newMarker = true;
            var infowindow = new google.maps.InfoWindow({
                content: '<center><a href="#">Join Game</a></center>'
            });
            var cloc;
            var pos;
            var notFirstTime = false;
            var service;
            var today;
            var address;
            var phpDate;
            var location;
            var a = 0;
            var preLocation;
            var newMarker = true;
            var listenerHandle;

            function initialize() {
         
                var mapOptions = {
                    zoom: 14,
                    //styles: styleArray,
                    center: stockholm,
                    panControl: true,
                    zoomControl: true,
                    mapTypeControl: true,
                    scaleControl: true,
                    streetViewControl: true,
                    overviewMapControl: true,
                    rotateControl: true,
                    ControlPosition: true
                };
                map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
                map.setCenter(parliament);

                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });

                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function(marker) {
                        marker.setMap(null);
                    });
                    markers = [];

                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });

                // If user is authorized then get the previous markers from database..
                @if (! Auth::guest())
                        {{ $i = 0 }}
                        @foreach ($markers as $marker)
                           
                            image = '{{ "/img/categories/" . $marker->event_category_id . "_marker.png" }}'; 
                     var markerParliament = new google.maps.LatLng({{ $marker->lat }}, {{ $marker->lon }});

                        marker = new google.maps.Marker({
                            id: {{ $marker->id }},
                            map: map,
                            draggable: false,
                            animation: google.maps.Animation.DROP,
                            icon: image,
                            position: markerParliament
                        });
                          myMarkers[{{ $marker->id }}] = marker;
                            i = {{ $i }};
                        myIndexMarkers[{{ $i }}] = marker;
                        // process multiple info windows
                        (function(marker, i) {
                            // add click event
                            google.maps.event.addListener(marker, 'click', function() {
                                if(infowindow.opened) {
                                    infowindow.close();
                                }
                                infowindow = new google.maps.InfoWindow({
                                    content: '<div class="mapPopup"><center><a class="editEvent" href="#" id="'+
                                    {{ $marker->id }}+'">Edit</a>'+'' +
                                    ' | <a class="deleteEvent" href="#" id="'+
                                    {{ $marker->id }}+'">Delete</a></center><div class="event-avatar">'+
                                    '<img alt="" src="{{ $marker->eventPicture }}">'+
                                    '</div>Title: {{ $marker->title }}' +
                                    '<br />Date: {{ $marker->dateTime }}' +
                                    '<br />Location: ' +
                                    '{{ $marker->location }}' +
                                    '<center><a href="/joinEvent/{{ $marker->id }}">' +
                                    'Join Game</a></center></div>'

                                });
                                infowindow.open(map, marker);
                                infowindow.opened = true;

                            });
                            // add dbclick event
                            google.maps.event.addListener(marker, 'dblclick', function() {
                                window.location.href = "/joinEvent/{{ $marker->id }}";
                            });
                        })(marker, i);
                        {{ $i++ }}
                        @endforeach
                @endif
                $('.loader').fadeOut('fast');

                @if ($i > 0)
                    // Event pagination start from here.
                    var obj = $('#pagination').twbsPagination({
                        totalPages: {{ $i }},
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (notFirstTime) {
                                map.setCenter(myIndexMarkers[page - 1].getPosition());
                                google.maps.event.trigger(myIndexMarkers[page - 1], 'click');
                            }
                            notFirstTime = true;

                        }
                    });
                @endif

                @if (! Session::get('useCurrentLocation') == 'notshow')
                     $('#useCurrentLocation').modal({
                        show: 'true'
                    });
                @endif
                // Set muliple markers section start from here.
                listenerHandle = google.maps.event.addListener(map, button, function (event) {
                    newMarker = true;

                    placeMarker(map, event.latLng);
                });

                function placeMarker(map, location) {
                    //parliament = new google.maps.LatLng(location.lat(), location.lng());
                    today = getCurrentDate();
                    drawInfoWindow(map, location, today);
                }
                // Set muliple markers section end from here.



                // Start change event listener from here.
                $('.add-button-event').click(function(){
                    if($(this).hasClass( "btn-success" )) {
                        $(this).removeClass('btn-success');
                        $(this).addClass('btn-warning');
                        button = 'click';
                        // Set muliple markers section start from here.
                        google.maps.event.removeListener(listenerHandle);
                        listenerHandle = google.maps.event.addListener(map, button, function (event) {
                            newMarker = true;

                            placeMarker(map, event.latLng);
                        });
                    }

                    else {
                        $(this).removeClass('btn-warning');
                        $(this).addClass('btn-success');
                        button = 'rightclick';
                        // Set muliple markers section start from here.
                        google.maps.event.removeListener(listenerHandle);
                        listenerHandle = google.maps.event.addListener(map, button, function (event) {
                            newMarker = true;

                            placeMarker(map, event.latLng);
                        });
                    }

                });

                //Close all marker popups by click start from here.
                google.maps.event.addListener(map, 'click', function() {
                    if(button=='rightclick') {
                        if (infowindow) {
                            infowindow.close();
							$('.gm-style-iw').parent().toggle();
                        }
                    }
                });
            }
            // Draw popup upon on marker start from here.
            function drawInfoWindow(map, result, today) {
                     $('#myModal').modal({
                    show: 'true'
                });

                 location = result;
                var request = {
                    location: result,
                    keyword: 'food',
                    radius: 500
                };

                service = new google.maps.places.PlacesService(map);
                service.radarSearch(request, callback);
                function callback(result, status) {
                    if (status !== google.maps.places.PlacesServiceStatus.OK) {
                        console.error(status);
                        return;
                    }
                    var result = result[0];
                    getAddressName(result);
                }

                function getAddressName(result, status) {
                    service.getDetails(result, function (result, status) {
                        if (status !== google.maps.places.PlacesServiceStatus.OK) {
                            console.error(status);
                            return;
                        }
                        address = result.formatted_address;
                        $('#location').val(address);
                        $('#lat').val(location.lat());
                        $('#lon').val(location.lng());

                    });
                }
            }
            // Draw popup upon on marker end from here.

            // Get current date start from here
            function getCurrentDate() {
                var today = new Date();
                var time = today.toLocaleTimeString().replace(/([\d]+:[\d]{2})(:[\d]{2})(.*)/, "$1$3")
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();
                var hh = today.getHours();
                var i = today.getMinutes();
                var s = today.getSeconds();
                var isPM = today.getHours() >= 12;
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
                return today;
            }
            // Get current date end from here

            // Disable current location start from here.
            function disableCurrentLocation() {

                var data = { lat: pos.lat, lng: pos.lng, userID: userID};
                $.ajax({
                    url: '/disableCurrentLocation',
                    type: 'post',
                    data: data,
                    success: function(e) {
                    }
                })
            }



            google.maps.event.addDomListener(window, 'load', initialize);

            // Get users current location on map start from here.
            function userCurrentLocation() {

                var infoWindow = new google.maps.InfoWindow({map: map});
                $('#useCurrentLocation').modal('hide');
                $('.loader').fadeIn();

                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    var location_timeout = setTimeout("handleLocationError(true, infoWindow, map.getCenter())", 10000);
                    navigator.geolocation.getCurrentPosition(function(position) {
                         pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        var marker = new google.maps.Marker({
                            position: pos,
                            map: map,
                            title: 'Your are here.'
                        });

                        map.setCenter(pos);
                        $('.loader').fadeOut('fast');
                        disableCurrentLocation();

                    }, function() {
                        clearTimeout(location_timeout);
                        handleLocationError(true, infoWindow, map.getCenter());

                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }

                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(browserHasGeolocation ?
                            'Error: The Geolocation service failed.' :
                            'Error: Your browser doesn\'t support geolocation.');
                }

            }
            $('#tbnCurrentLocation').click(function(){
                userCurrentLocation();
            });


            //Initialize bootstrap datepicker from here
            $('#dateTime').datetimepicker({

                formatTime:'H:i A',
                format:'Y-m-d g:i A',
                formatDate:'Y.m.d',
                //defaultDate:'8.12.1986', // it's my birthday
                defaultDate:'+1970.01.03', // it's my birthday
                defaultTime:'10:00',
                timepickerScrollbar:false
            });



            //Create marker detail start from here.
            $("#register-form").submit(function (e) {
                @if (Auth::guest())
                        window.location = "{{ '/login' }}";
                @endif
                e.preventDefault(); // avoid to execute the actual submit of the form.
                $('#myModal').modal('hide');
                $(".loader").fadeIn();
                $.ajax({
                    type: 'POST',
                    url: $("#register-form").attr("action"),
                    processData: false,
                    contentType: false,
                    data: new FormData( this ),
                    success: function (data) {
                        $('.loader').fadeOut();
                        var parseData = JSON.parse(data);
                        var id = parseData[0].id;
                        if (newMarker) {
                            marker = new google.maps.Marker({
                                position: location,
                                map: map,
                                animation: google.maps.Animation.DROP,
                                icon: image
                            });
                            myMarkers[id] = marker;
                        } else {
                            infowindow.close();
                        }
                            $('#myModalShare').modal({
                                show: 'true'
                            });

                            if (a>0) {
                                infowindow.close();
                            }


                            infowindow = new google.maps.InfoWindow({
                                content: '<div class="mapPopup"><center><a class="editEvent" href="#" id="'+id+'">Edit</a>'+'' +
                                ' | <a class="deleteEvent" href="#" id="'+id+'">Delete</a></center><div class="event-avatar">'+
                                '<img alt="" src="'+parseData[0].path+'">'+
                                '</div>Title: ' + title +
                                '<br />Date: ' + today +
                                '<br />Location:'+address+
                                '<center><a href="joinEvent/'+id+'">Join Game</a></center></div>'
                            });
                        if (newMarker) {
                            infowindow.open(map, marker);
                        } else {
                            infowindow.open(map, myMarkers[id]);
                        }

                            $('#register-form').attr('action','createMarker');
                            a++;

                        //Reset form fields
                        $('#register-form')[0].reset();

                    }
                });
            });
            // Initialize all global variables of modal form.
            $( "body" ).delegate('#submit','click', function(){
                title = $('#title').val();
                today = $('#dateTime').val();
                address = $('#location').val();
            });
            // Edit event
            $( "body" ).delegate( ".editEvent", "click", function() {
                newMarker = false;
                var id = $(this).attr('id');
                $.ajax({
                    url: "/editMarker/"+id,
                    type: "GET",
                    success: function(data){
                        var parseData = JSON.parse(data);
                        $('.showMap').css('display', 'none');
                        $('#location').attr("readonly","readonly");
                        $('#register-form').attr('action','/updateMarker');
                        $('#markerID').val(parseData[0].id);
                        $('#title').val(parseData[0].title);
                        $('#eventType').val(parseData[0].eventType);
                        $('#location').val(parseData[0].location);
                        $('#dateTime').val(parseData[0].dateTime);
                        $('#noOfAttendees').val(parseData[0].noOfAttendees);
                        $('.viewType').find('li').removeClass('active');
                        if (parseData[0].viewType == 'public') {
                            $('.viewType').find('li:first-child').addClass('active');
                            $('.noOfAttendees').show();
                            $('#publicView').attr('checked', 'checked');
                        } else {
                            $('.viewType').find('li:last-child').addClass('active');
                            $('.noOfAttendees').hide();
                            $('.noOfAttendees').attr('min', 0);
                            $('#privateView').attr('checked', 'checked');
                        }

                        $('#image').val(parseData[0].eventPicture);
                        $('#eventDescription').val(parseData[0].eventDescription);
                            $("#eventType").val(parseData[0].event_type_id).attr('selected', true);
                         $typeID = parseData[0].event_type_id;
                         $categoryID = parseData[0].event_category_id;
                        $('#eventCategory').attr('disabled', 'disabled');
                        $.ajax({
                            url: '/eventCategories/'+$typeID,
                            type: 'GET',
                            success: function(data) {
                                $('#eventCategory').empty();
                                $('#eventCategory').attr('disabled', false);
                                $.each( data, function( index, value ) {
                                    if (value.event_category_id == $categoryID) {
                                        $('#eventCategory').append('<option selected value="'+value.event_category_id+'">'+value.category+'</option>');
                                    } else {
                                        $('#eventCategory').append('<option value="'+value.event_category_id+'">'+value.category+'</option>');
                                    }
                                    
                                });

                            }
                        })
                        $('#myModal').modal({
                            show: 'true'
                        });
                    }
                });
            });
            // Delete event
            $( "body" ).delegate( ".deleteEvent", "click", function() {
                var id = $(this).attr('id');
                if (confirm("Are you sure to delete this event?")) {
                    $(".loader").fadeIn();
                    $.ajax({
                        url: "/deleteMarker/"+id,
                        type: "GET",
                        success: function(data){
                            $(".loader").fadeOut();
                            myMarkers[id].setMap(null);

                        }
                    });
                }

            });

         /*   window.onload = function() {
                $('#myModalPostCode').modal({
                    show: 'true'
                });
            };*/



            $(".dropdown-toggle").dropdown();

            //Image crop start from here.
            $(".container_photo").PictureCut({
                InputOfImageDirectory       : "image",
                PluginFolderOnServer        : "/js/",
                FolderOnServer              : "/uploads/",
                EnableCrop                  : true,
                CropWindowStyle             : "Bootstrap"
            });

            prettyPrint();

        //Move user to previous position on map where it came from.
            $('.map-target').click(function(){
                map.setCenter(parliament);
            });
			
			 // Reset all input field after hide modal
            $('#myModal').on('hidden.bs.modal', function(){
                $('#register-form')[0].reset();
				$('#register-form').attr('action','/createMarker');
            });

        });
    </script>

    <!--Start facebook SDK from here.  -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function mySharePopup(url) {
            window.open(url, "myWindow", "status = 1, height = 500, width = 360, resizable = 0")
        }

    </script>
 <!-- Load event form start from here -->
 @include('subView.eventForm')
 


    <!-- Trigger the modal after create event details -->
    <!-- Modal -->
    <div id="myModalShare" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">congratulations! Your event has been posted</h4>
                </div>
                <div class="modal-body">
                    <h4>Tell your friends.</h4>
                    <div class="row">


                    </div>
                </div>
                <div class="modal-footer">

                    <!-- 1-->
                    <div class="col-md-3">
                        <a data-site="" class="ssba_google_share" href="javascript:mySharePopup('https://plus.google.com/share?url=http://fleek.mindgigspk.com/')" target="_blank"><img src="/img/googleShare.png" title="Google+" class="ssba ssba-img" alt="Share on Google+"></a>
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
                        <a data-site="" class="ssba_twitter_share" href="javascript:mySharePopup('http://twitter.com/share?url=http://fleek.mindgigspk.com/')" target="_blank"><img src="/img/twitterShare.png" title="Twitter" class="ssba ssba-img" alt="Tweet about this on Twitter"></a>
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Trigger the modal user current location after loading  -->
    <!-- Modal -->
    <div id="useCurrentLocation" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">If you want to use you'r current location click on "Use Current Location"</h4>
                </div>
                <div class="modal-body">
                    <button class="btn btn-primary" id="tbnCurrentLocation">Use Current Location</button>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div  class="loader" >
     <!--   <div class="bg_load"></div>
        <div class="wrapper">
            <div class="inner">
                <span>L</span>
                <span>o</span>
                <span>a</span>
                <span>d</span>
                <span>i</span>
                <span>n</span>
                <span>g</span>
            </div>
        </div>-->
    </div>

@endsection