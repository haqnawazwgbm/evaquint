@extends('layouts.site')
@section('content')
<div class="mapSearch" style="height: 0px;">
    <!--Google Maps-->
    <div class="changeSearchIcon col-lg-offset-4 col-xs-offset-3 " style="height: 0px;">

        @if (isset($markers->searchByEvent))
            <input id="pac-input" class="controls col-xs-5" type="text" placeholder="Search By Event">
            <span class="glyphicon glyphicon-map-marker searchIcon" data-toggle="tooltip" title="Click to search by place"
                  data-original-title="Click to search by place"></span>
        @else
            <input id="pac-input" class="controls col-xs-4" type="text" placeholder="Search By Place">
            <span class="glyphicon glyphicon-globe searchIcon" data-toggle="tooltip" title="Click to search by events"
                  data-original-title="Click to search by events"></span>
        @endif
        <div class="btn btn-primary btn-small btnSetRadius">Set Radius</div>
            <input type="text" class="span2" id="bootstrapSlider" data-slider-min="1"  data-slider-max="250" data-slider-step="1" data-slider-tooltip-position="bottom"  data-slider-value="{{ (isset($markers->radius)? $markers->radius : 1) }}" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show">


    </div>
    <ul class="pagination pull-right mapPagination" id="pagination">
    </ul>
    <a href="#" class="btn add-button-event btn-success btn-lg pull-right col-xs-3 visible-xs visible-sm hidden-md hidden-lg">
        <span class="glyphicon glyphicon-plus-sign"></span> Add
    </a>

</div>



    <div id="map_container">
    @if (isset($markers->searchByEvent))
        <div class="alert alert-danger alert-dismissible map-alert" style="display: {{$markers->display}};">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Oops!</strong> The result your looking not found.
         </div>
    @endif
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
        var showLocationAutoComplete = true;
        var small_map;
        var image = '/img/categories/1_marker.png';
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
            var searchMode = 'place';
             @if (isset($markers->searchByEvent))
                    searchMode = 'event';
            @endif;
            var title;
            var marker;
            var myMarkers = [];
            var pos;
            var myIndexMarkers = [];
            var newMarker = true;

            var infowindow = new google.maps.InfoWindow({
                content: '<center><a href="#">Join Game</a></center>'
            });
            var cloc;
            var service;
            var today;
            var address;
            var phpDate;
            var location;
            var a = 0;
            var newMarker = true;
            var listenerHandle;
            var circle;
            var notFirstTime = false;
            // set zoom for map.
             @if (isset($markers->radius))
                    var radius = getZoomLevel({{ $markers->radius }});
                    $('.btnSetRadius').trigger('click');
                    @else
                    var radius = 14;
             @endif

            var mapOptions = {
                zoom: radius,
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
            var bounds;
            var icon;
            var input;
            var markers = [];
            var markerParliament;
            var places;
            var searchBox;
            var global_markers = [];
            var i;
            var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
            var setRadius = true;


            function getZoomLevel(radius2) {
			    var scale = radius2 / 500;
			    var zoomLevel = (5 - Math.log(scale) / Math.log(2));
				return parseInt(zoomLevel);
			} 

			//Convert radius to kilometer
			function toKilometre(val) {
				return (val/6378.1)*6378100;

			}

            



            function initialize() {



                // Create the search box and link it to the UI element.
                input = document.getElementById('pac-input');
                searchBox = new google.maps.places.SearchBox(input);


                $('#pac-input').change(function () {
                    //if search mode is place then execute this section start from here.
                    if (searchMode == 'place') {
                        // Bias the SearchBox results towards current map's viewport.
                        map.addListener('bounds_changed', function () {
                            searchBox.setBounds(map.getBounds());
                        });
                        // Listen for the event fired when the user selects a prediction and retrieve
                        // more details for that place.
                        searchBox.addListener('places_changed', function () {
                            places = searchBox.getPlaces();

                            if (places.length == 0) {
                                return;
                            }

                            // Clear out the old markers.
                            markers.forEach(function (marker) {
                                marker.setMap(null);
                            });
                            markers = [];

                            // For each place, get the icon, name and location.
                            bounds = new google.maps.LatLngBounds();
                            places.forEach(function (place) {
                                if (!place.geometry) {
                                    console.log("Returned place contains no geometry");
                                    return;
                                }
                                icon = {
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
                    } else {
                        searchEvent();
                    }
                });



                // If user is authorized then get the previous markers from database..
                {{ $i = 0 }}
                        @foreach ($markers as $marker)
                             image = '{{ "/img/categories/" . $marker->event_category_id . "_marker.png" }}'; 
                        markerParliament = new google.maps.LatLng({{ $marker->lat }}, {{ $marker->lon }});

                marker = new google.maps.Marker({
                    id: {{ $marker->id }},
                    map: map,
                    draggable: false,
                    animation: google.maps.Animation.DROP,
                    icon: image,
                    position: markerParliament
                });
                myMarkers[{{ $marker->id }}] = marker;
                global_markers.push(marker);
                i = {{ $i }};
                myIndexMarkers[{{ $i }}] = marker;
                // process multiple info windows
                (function (marker, i) {
                    // add click event
                    google.maps.event.addListener(marker, 'click', function () {
                        if (infowindow.opened) {
                            infowindow.close();
                        }
                        infowindow = new google.maps.InfoWindow({
                            content: '<div style="opacity: 0.8;" class="mapPopup"><center><a class="editEvent" href="#" id="{{ $marker->id }}"></a>' +
                            '<a class="deleteEvent" href="#" id="{{ $marker->id }}">' +
                            '</a></center><div class="event-avatar">' +
                            '<img alt="" src="{{ $marker->eventPicture }}">' +
                            '</div>Title: {{ $marker->title }}' +
                            "<br />Date: {{ date('F j, Y, g:i a', strtotime($marker->dateTime)) }}" +
                            '<br />Location: ' +
                            '{{ $marker->location }}' +
                            '<center><a href="/joinEvent/{{ $marker->id }}">' +
                            'Join Game</a></center></div>'
                        });
                        infowindow.open(map, marker);
                        infowindow.opened = true;

                    });
                    // add dbclick event
                    google.maps.event.addListener(marker, 'dblclick', function () {
                        window.location.href = "/joinEvent/{{ $marker->id }}";
                    });
                })(marker, i);
                {{ $i++ }}
                @endforeach

                // Call cluster function 
                createCluster(map, global_markers);

                //Stay user on his own position


                $('.loader').fadeOut('fast');
                @if ($i > 0)
                var i = {{ $i }};
                // Event pagination start from here.
                var obj = $('#pagination').twbsPagination({
                    totalPages: {{ $i }},
                    visiblePages: 5,
                    onPageClick: function (event, page) {
                        if (notFirstTime || i == 1) {
                            map.setCenter(myIndexMarkers[page - 1].getPosition());
                            google.maps.event.trigger(myIndexMarkers[page - 1], 'click');
                        }
                        notFirstTime = true;


                    }
                });
                @endif


                @if (! Session::get('useCurrentLocation') == 'notshow' && Auth::user()->show_current_location == 'yes')
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
                   // parliament = new google.maps.LatLng(location.lat(), location.lng());
                    today = getCurrentDate();
                    drawInfoWindow(map, location, today);
                }

                //Cluster function start from here.
                 function createCluster(map, globalmarkers){
                    console.log(globalmarkers);
                   var markerCluster = new MarkerClusterer(map, globalmarkers,
                       {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
               }

                // Set muliple markers section end from here.


                // Start change event listener from here.
                $('.add-button-event').click(function () {
                    if ($(this).hasClass("btn-success")) {
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
                google.maps.event.addListener(map, 'click', function () {
                    if (button == 'rightclick') {
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
                $('#lat').val(location.lat());
                $('#lon').val(location.lng());
                //Small map section start from here.
                        var small_marker;
                            small_map;
                        var small_input;
                        var small_searchBox;
                         small_marker = new google.maps.Marker({
                                    position: parliament, 
                                    map: small_map,
                                    icon: image
                                });
                         // Create the search box and link it to the UI element.
                          small_map = new google.maps.Map(document.getElementById('home_map'), mapOptions);
                          small_input = document.getElementById('location');
                          small_searchBox = new google.maps.places.SearchBox(small_input);
                            
                            google.maps.event.addListenerOnce(small_map, 'idle', function () {
                              google.maps.event.trigger(small_map, 'resize');
                           });

                            // Create marker section start from here.
                            small_listenerHandle = google.maps.event.addListener(small_map, 'click', function (event) {
                                image = '/img/categories/' + $('#eventCategory').val() + '_marker.png';
                                var viewType = $('#viewType').val();
                                if (viewType == 'tournament') {
                                    image = '/img/marker.png';
                                }
                                 if (small_marker)
                                    small_marker.setMap(null);

                                    small_marker = new google.maps.Marker({
                                    position: event.latLng, 
                                    map: small_map,
                                    icon: image
                                });
                                    $('#lat').val(event.latLng.lat());
                                    $('#lon').val(event.latLng.lng());
                                    location = event.latLng;
                                    getSmallMapAddressName(event.latLng);
                            });
                            // End of the small map section here.
                var request = {
                    location: location,
                    keyword: 'food',
                    radius: 500
                };

                service = new google.maps.places.PlacesService(map);
                service.radarSearch(request, callback);
                function callback(result, status) {
                    if (status !== google.maps.places.PlacesServiceStatus.OK) {
                        $('#location').prop('readonly',false);
                        $('#location').attr('data-content', "We can't find the address you selected in google map record. Please enter it manualy").popover('show')
                            .val('');
                        showLocationAutoComplete = false;
                    } else {
                        $('#location').prop('readonly',true);
                        showLocationAutoComplete = true;
                    }
                    var result = result[0];                   
                    getAddressName(result);
                }

                function getAddressName(result, status) {
                    service.getDetails(result, function (result, status) {
                        console.log('true');
                        if (status !== google.maps.places.PlacesServiceStatus.OK) {
                            $('#location').attr('data-content', "We can't find the address you selected in google map record. Please enter it manualy").popover('show')
                            .val('');
                            showLocationAutoComplete = false;
                            return;
                        } else {
                            showLocationAutoComplete = true;
                        }
                        address = result.formatted_address;
                        $('#location').val(address);
                        
                        

                    });
                }

                            // Get address name where event is created
             function getSmallMapAddressName(result, status) {
                    var location = result;
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
                            $('#location').prop('readonly',false);
                            $('#location').attr('data-content', "We can't find the address you selected in google map record. Please enter it manualy").popover('show')
                            .val('');
                            showLocationAutoComplete = false;
                            console.log('error');
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

                var data = {lat: pos.lat, lng: pos.lng, userID: userID};
                $.ajax({
                    url: '/disableCurrentLocation',
                    type: 'post',
                    data: data,
                    success: function (e) {
                    }
                })
            }

            google.maps.event.addDomListener(window, 'load', initialize);


            // Get users current location on map start from here.
            function userCurrentLocation() {

                $('#useCurrentLocation').modal('hide');
                $('.loader').fadeIn();

                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    /*var location_timeout = setTimeout("handleLocationError(true, infoWindow, map.getCenter())", 10000);*/
                    navigator.geolocation.getCurrentPosition(function (position) {

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

                    }, function () {
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

            $('#tbnCurrentLocation').click(function () {
                userCurrentLocation();
            });
            $('#btnDoNotAskMeAgain').click(function() {
                var data = {show_current_location: 'no'};
                $.ajax({
                    url: '/disableCurrentLocation',
                    type: 'post',
                    data: data,
                    success: function (e) {
                        $('.loader').fadeOut('fast');
                        $('#useCurrentLocation').modal('hide');
                    }
                })
            })




       
           


            /*   window.onload = function() {
             $('#myModalPostCode').modal({
             show: 'true'
             });
             };*/


            $(".dropdown-toggle").dropdown();

      

            //Move user to previous position on map where it came from.
            $('.map-target').click(function () {
                setMapPos();
            });

            function setMapPos()  {
                map.setCenter(parliament);
            }

            //Change search mode by click start from here.
            $('.searchIcon').on('click', function () {
                if (searchMode == 'place') {
                    $('#pac-input').attr('placeholder', 'Search By Events').attr('value', '');
                    $('.searchIcon').attr('data-original-title', 'Click to search by place').tooltip('show');
                    $('.searchIcon').removeClass('glyphicon-globe');
                    $('.searchIcon').addClass('glyphicon-map-marker');
                    google.maps.event.clearInstanceListeners(input);
                    searchMode = 'event';
                } else {
                    $('#pac-input').attr('placeholder', 'Search By Place');
                    $('.searchIcon').attr('data-original-title', 'Click to search by events').tooltip('show');
                    $('.searchIcon').removeClass('glyphicon-map-marker');
                    $('.searchIcon').addClass('glyphicon-globe');
                    searchBox = new google.maps.places.SearchBox(input);
                    searchMode = 'place';
                }

            });

            //search by event start from here.
            function searchEvent() {
                var value = $('#pac-input').val();
                var radius = $('.slider').find('.tooltip').find('.tooltip-inner').html();
                var showRadius = true;
                if (!setRadius) {

                } else {
                    showRadius = false;
                }
                window.location = '/searchEvent/' + value + '/'+ radius + '/' + showRadius;
            }

            // Hide/show slider tooltip when mouse over
            $('.slider').find('.tooltip').live('mouseover', function() {
                $(this).hide();
            })
            $('.slider-track').find('.slider-handle').live('mouseover', function() {
                $('.slider').find('.tooltip').show();
            })

            $('#bootstrapSlider').slider({tooltip: 'always', tooltip_position: "bottom" }); // Initialize slider from here.
          
           



            $('.btnSetRadius').on('click', function() {
                if (setRadius) {
                    $(".slider-horizontal").css('visibility', 'visible');
                    $(this).html('Unset Radius');

                    var val = $('.tooltip').find('.tooltip-inner').html();
                    var zoom = getZoomLevel(val);
                     circle = new google.maps.Circle({center:parliament,
                        radius: toKilometre(val),
                        fillOpacity: 0.35,
                        fillColor: "#FF0000",
                        strokeOpacity: 0.62,
                        strokeWeight: 1,
                        map: map});
                    circle.setRadius(toKilometre(val));
                    setMapPos();

                    map.setZoom(zoom);
                    setRadius = false;
                } else {
                    $(".slider-horizontal").css('visibility', 'hidden');
                    $(this).html('Set Radius');
                    circle.setRadius(null);
                    setRadius = true;
                }

            });

            // If radius is set then show radius slider.
             @if (isset($markers->radius) && $markers->showRadius == 'true')
                    $('.btnSetRadius').trigger('click');
             @endif



          
          

            $('.slider-track').find('.slider-handle').on('mouseup', function() {
            	var val = $('.tooltip').find('.tooltip-inner').html();
            	var	zoom = getZoomLevel(val);
            	circle.setRadius(toKilometre(val));

            	map.setZoom(zoom);
            });

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
                        $('.loader').fadeOut();

                        var parseData = JSON.parse(data);
                        console.log(parseData);
                        var id = parseData[0].id;
                        var title = parseData[0].title;
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

                        if (a > 0) {
                            infowindow.close();
                        }


                        infowindow = new google.maps.InfoWindow({
                            content: '<div class="mapPopup"><center><a class="editEvent" href="#" id="' + id + '"></a>' + '' +
                            '<a class="deleteEvent" href="#" id="' + id + '"></a></center><div class="event-avatar">' +
                            '<img alt="" src="' + parseData[0].path + '">' +
                            '</div>Title: ' + title +
                            '<br />Date: ' + today +
                            '<br />Location: ' + address +
                            '<center><a href="joinEvent/' + id + '">Join Game</a></center></div>'
                        });
                        if (newMarker) {
                            infowindow.open(map, marker);
                        } else {
                            infowindow.open(map, myMarkers[id]);
                        }

                        $('#register-form').attr('action', 'createMarker');
                        a++;

                    }
                });
            });


          



        });


    </script>
    <!--Start facebook SDK from here.  -->
    <div id="fb-root"></div>
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

    <!-- Trigger the modal user current location after loading  -->
    <!-- Modal -->
<<<<<<< HEAD
    <div id="useCurrentLocation" class="modal fade col-xs-8" role="dialog">
=======
    <div id="useCurrentLocation" class="modal fade" role="dialog">
>>>>>>> a758bcd9be9f13b716a1fb1d7956c11b4773a106
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">If you want to use you'r current location click on "Use Current
                        Location"</h4>
                </div>
                <div class="modal-body">
                    <button class="btn btn-primary" id="tbnCurrentLocation">Use Current Location</button>
                    <button class="btn btn-danger" id="btnDoNotAskMeAgain">Do Not Ask Me Again</button>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="loader row">
        <div class="bg_load"></div>
    </div>
@endsection