@extends('layouts.site')
@section('content')
   <div class="col-lg-12">
   <div class="alert alert-success join-event-alert alert-dismissible" style="display: none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong>
    </div>
            <div onclick="goBack()" style="margin-top: 10px;" class="btn btn-success btn-sm pull-left">
                <span class="glyphicon glyphicon-circle-arrow-left"></span> Back
            </div>
            <div class="col-lg-8" style="height: 70px;">
            <h1 class="banner"> 
                @if ($markers->viewType == 'private')
                    Private Event
                @elseif($markers->viewType == 'public') 
                    Public Event
                @else 
                    Tournament Event
                @endif
                <sub>{{ '('.ucfirst($markers->markerStatus).')' }}</sub>
                </h1>
            </div>
                
                <div class="dropdown">
                  <button style="border: solid 1px #ccc;background-color: #ffffff; color: #ccc;" class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu" id="{{ $markers->id }}">
                  @if (Auth::user()->id == $markers->user_id)
                    <li><a class="deleteEvent" href="#">Delete</a></li>
                    <li><a class="editEvent" id="{{ $markers->id }}" href="#">Edit</a></li>
                    <li><a data-toggle="modal" id="inviteFriendsModalBtn" data-target="#inviteFriendsModal" href="#">Invite friends</a></li>
                    @endif
                    <li><a data-toggle="modal" id="eventReportBtn" data-target="#eventReport" class="eventReport" href="#">Report</a></li>
                  </ul>
                </div>
              </div>
             

    <section id="login" class="container secondary-page" style="margin-top: 65px;">
    


       
       
            
            <div class="panel-body">
                     <div class="col-md-3 col-md-offset-1"><div><img src="{{ $markers->eventPicture }}"/></div></div>
                    <div class="top-score-title right-score col-md-3 ">

                        <h3>{{ $markers->title }}<span class="point-int"> .</span><br />
                          
                        </h3>

                    </div>
                <div class="row">
                    <div class=" col-md-9 col-lg-9 col-lg-offset-1">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>
                                    <img alt="User Pic" width="100" src="{{ $markers->user_picture }}"
                                         class="img-circle img-responsive">
                                    &nbsp;&nbsp;&nbsp; <a
                                            href="{{ $markers->profileAccess }}">{{ $markers->first_name.' '.$markers->last_name }}</a>
                                </td>
                                <td>
                                        <input id="input-1" name="input-1"  class="rating rating-loading" data-show-caption="false"
                                               data-min="0" data-max="5" data-readonly="{{ $markers->readOnly }}" data-step="1" value="{{ $markers->rating }}">



                                </td>
                            </tr>
                             <tr>
                                <td>Total Host Rank:</td>
                                <td>{{ $markers->totalHostRank }}</td>
                            </tr>
                            <tr>
                                <td>Location:</td>
                                <td>{{ $markers->location }}</td>
                            </tr>
                            <tr>
                                <td>Date And Time</td>
                                <td>{{ $markers->dateTime }}</td>
                            </tr>

                            <tr>
                            </tr>
                            <tr class="attendees" data-toggle="dropdown" data-target="#listAttendees">
                                <td>Attendees:</td>
                                <td>
                                    @include('subView.attendees')
                                </td>

                            </tr>
                            <tr>
                                <td>Type:</td>
                                <td>{{ $markers->type }}</td>
                            </tr>
                            <tr>
                                <td>Category:</td>
                                <td>{{ $markers->category }}</td>
                            </tr>
                            <tr>
                                <td>Description:</td>
                                <td>{{ $markers->eventDescription }}</td>
                            </tr>

                            </tbody>
                        </table>
                        @if ( Auth::user()->id == $markers->user_id || $markers->markerStatus == 'close' && $markers->alreadyJoin > 0)

                        <div class="col-md-8">
                            @include('subView.imageSlider')
                        </div>

                        @endif


                        <div class="col-md-4 pull-right">
                            <div id="map_canvas" class="registerJoin"></div>
                        </div>

                        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">



                                <div class="joinShare">
                                    <!-- 1-->
                                    <div class="col-md-4">
                                        <a data-site="" class="ssba_google_share" href="javascript:mySharePopup('https://plus.google.com/share?url=http://fleek.mindgigspk.com/')" target="_blank"><img src="/img/googleShare.png" title="Google+" class="ssba ssba-img" alt="Share on Google+"></a>
                                    </div>
                                    <!-- 2-->
                                    <div class="col-md-4">
                                        <a data-site="" mobile_iframe="false" data-mobile_iframe="false" class="ssba_facebook_share"
                                           href="javascript:mySharePopup('http://www.facebook.com/sharer.php?u=http://fleek.mindgigspk.com/')"
                                           target="_blank"><img
                                                    src="/img/facebookShare.png"
                                                    title="Facebook" class="ssba ssba-img" alt="Share on Facebook"></a>
                                    </div>
                                    <!-- 3-->
                                    <div class="col-md-4">
                                        <a data-site="" class="ssba_twitter_share" href="javascript:mySharePopup('http://twitter.com/share?url=http://fleek.mindgigspk.com/')" target="_blank"><img src="/img/twitterShare.png" title="Twitter" class="ssba ssba-img" alt="Tweet about this on Twitter"></a>
                                    </div>
                            @if ($markers->user_id == Auth::user()->id && $markers->markerStatus == 'open')
                                <a href="#" class="pull-left">
                                    <button type="button"
                                    class="btn btn-lg btn-success closeEvent">Close Event</button>

                                </a>
                            @else


                                @if (count($markers->joinedUsers) == $markers->noOfAttendees && $markers->user_id != Auth::user()->id && $markers->alreadyJoin == 0)
                                    <a href="#" class="pull-left">
                                        <button type="button" id="fullEvent"
                                                class="btn btn-lg">Full Event</button>
                                    </a>
                                @else
                                    @if ($markers->user_id != Auth::user()->id || $markers->markerStatus != 'open' )
                                    <a href="#" class="pull-left">
                                        <button type="button" id="registerJoin" {{ $markers->disabled }}
                                        class="btn btn-lg {{ $markers->class }}">{{ ucfirst($markers->register) }}</button>

                                    </a>
                                    @endif
                                @endif
                            @endif
                            @if (count($markers->joinedUsers) == $markers->noOfAttendees && $markers->user_id != Auth::user()->id && $markers->alreadyJoin == 0)
                                @include('subView.openSpotButton')
                            @endif



                        </div>

                    </div>

                </div>
            </div>
<!-- Include discussion board from subView -->
@include('subView.discussionBoard')

    </section>



    <!-- Trigger the modal after create event details -->
    <!-- Modal -->
    <div id="myModalShare" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Congratulations! You are now registered for this event. Tell your friends</h4>
                </div>
                <div class="modal-body">
                    <h4>Tell your friends.</h4>
                    <div class="row">

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
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

  <!-- Load event form start from here -->
 @include('subView.eventForm')


 <!--    <div  class="loader" >
       {{-- <div class="bg_load"></div>
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
        </div>--}}
    </div>  -->
    @include('subView.inviteFriendsInModal')
    @include('subView.reportFormInModal')

@endsection

@section('registerEvent')
    <script>
        $(document).ready(function () {


            function initialize() {
                var stockholm = new google.maps.LatLng({{ $markers->lat }}, {{ $markers->lon }});
                var styleArray = [
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "hue": "#ff0000"
                            },
                            {
                                "saturation": "-100"
                            },
                            {
                                "lightness": "8"
                            },
                            {
                                "gamma": "3.95"
                            },
                            {
                                "weight": "6.60"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    }
                ];
                var image = '/img/small_marker.png';
                @if ($markers->eventType == 2)
                    image = '/img/small_socialMarker.png';
                    @else
                         @if ($markers->eventType == 3)
                                image = '/img/small_otherMarker.png';
                         @else
                              image = '/img/small_marker.png';
                     @endif
                 @endif
                var parliament = new google.maps.LatLng({{ $markers->lat }}, {{ $markers->lon }});
                var marker;
                var mapOptions = {
                    zoom: 14,
                    center: stockholm
                };
                var map;
                map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
                marker = new google.maps.Marker({
                    map: map,
                    draggable: false,
                    animation: google.maps.Animation.DROP,
                    icon: image,
                    position: parliament
                });
            }

            google.maps.event.addDomListener(window, 'load', initialize);

// Start ajax from here to register viewer for event.
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#registerJoin').click(function (e) {

                var data = { title: '{{  $markers->title }}', poiID: {{ $markers->id }},
                    email: '{{ $markers->email }}', hostID: {{ $markers->user_id }}};
                $register = $('#registerJoin').html();
                if ($register == 'Unregister') {
                    $('.displayChat').addClass('hide');
                    $('#registerJoin').html('Register');
                    $('#registerJoin').removeClass('btn-danger');
                    $('#registerJoin').addClass('btn-success');
                    $('.noOfParticipant').html(parseInt($('.noOfParticipant').html(), 10) - 1);
                    $.ajax({
                        url: "/joinUnegister",
                        type: "POST",
                        data: data,
                        success: function (e) {
                        }
                    });
                } else {
                    $('.displayChat').removeClass('hide');
                    $('#registerJoin').html('Unregister');
                    $('#registerJoin').removeClass('btn-success');
                    $('#registerJoin').addClass('btn-danger');
                    $('.noOfParticipant').html(parseInt($('.noOfParticipant').html(), 10) + 1);
                    $('#myModalShare').modal({
                        show: 'true'
                    });
                    $.ajax({
                        url: "/joinRegister",
                        type: "POST",
                        data: data,
                        success: function (e) {
                            

                        }
                    });
                }
              

                return false;



            });


        });


      


        <!--
                function mySharePopup(url) {
                    window.open(url, "myWindow", "status = 1, height = 500, width = 360, resizable = 0")
                }
        //-->



        $(function () {


            //Image crop start from here.
            $(".container_photo").PictureCut({
                InputOfImageDirectory       : "image",
                PluginFolderOnServer        : "/js/",
                FolderOnServer              : "/uploads/",
                EnableCrop                  : true,
                CropWindowStyle             : "Bootstrap"
            });

            prettyPrint();

            // Edit event
          $( "body" ).delegate( ".editEvent", "click", function() {
                newMarker = false;
                var id = $(this).attr('id');
                $.ajax({
                    url: "/editMarker/"+id,
                    type: "GET",
                    success: function(data){
                        var parseData = JSON.parse(data);
                        $('#location').attr("readonly","readonly");
                        $('#register-form').attr('action','/updateMarker');
                        $('#markerID').val(parseData[0].id);
                        $('#title').val(parseData[0].title);
                        $('#eventType').val(parseData[0].eventType);
                        $('#location').val(parseData[0].location);
                        $('#dateTime').val(parseData[0].dateTime);
                        $('#noOfAttendees').val(parseData[0].noOfAttendees);
                        $('.viewType').find('li').removeClass('active');
                       if (parseData[0].viewType == 'private') {
                            $('.viewType').find('li').eq( 0 ).addClass('active');
                            $('.noOfAttendees').show();
                            $('#publicView').attr('checked', 'checked');
                        } else  {
                            if (parseData[0].viewType == 'public') {
                                $('.viewType').find('li').eq( 1 ).addClass('active');
                                $('.noOfAttendees').hide();
                                $('.noOfAttendees').attr('min', 0);
                                $('#privateView').attr('checked', 'checked'); 
                            } else {
                                $('.viewType').find('li').eq( 2 ).addClass('active');
                                $('.noOfAttendees').show();
                                $('#publicView').attr('checked', 'checked');
                            }
                            
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
                            window.location = "{{ '/map' }}";

                        }
                    });
                }

            });

            //Create marker detail start from here.
            $("#register-form").submit(function (e) {
                @if (Auth::guest())
                        window.location = "{{ '/login' }}";
                @endif
                $(".loader").fadeIn();
                e.preventDefault(); // avoid to execute the actual submit of the form.
                $('#myModal').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: $("#register-form").attr("action"),
                    processData: false,
                    contentType: false,
                    data: new FormData( this ),
                    success: function (data) {
                        $(".loader").fadeOut();
                        $('.banner').html(adta[0].viewType + ' Event');
                        $('.top-score-title').find('h3').html(data[0].title);
                        $('.table-user-information').find('tbody').find('tr').eq(0).find('td').eq(0).find('img').attr('src', data[0].eventPicture);
                        $('.table-user-information').find('tbody').find('tr').eq(1).find('td').eq(1).html(data[0].location);
                        $('.table-user-information').find('tbody').find('tr').eq(2).find('td').eq(1).html(data[0].dateTime);
                        $('.table-user-information').find('tbody').find('tr').eq(3).find('td').eq(1).html(data[0].noOfAttendees);
                        $('.table-user-information').find('tbody').find('tr').eq(4).find('td').eq(1).html(data[0].eventDescription);
                        $('.table-user-information').find('tbody').find('tr').eq(5).find('td').eq(1).html(data[0].type);
                        $('.table-user-information').find('tbody').find('tr').eq(6).find('td').eq(1).html(data[0].category);

                        

                       $('.alert-success').css('display', 'block').append(' Event updated successfully.');
                    }
                });
            });

            // Update rating value in database
            $('#input-1').change(function(){
                var value = $(this).val();
                var data = { rating: value, userID: {{ $markers->user_id }}, poiID: {{ $markers->id }}};
                $.ajax({
                    url: '/updateRating',
                    data: data,
                    type: 'post',
                    success: function(e) {
                    }
                });
            });



            $('#input-1').after('<div class="pull-right"> {{ $markers->rating.'/5' }}</div>');
            $(".loader").fadeOut('slow');


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

            //Close event start from here.
            $('.closeEvent').one('click', function() {
                var $this = $(this);
                $this.html('Event Closing');
                $this.attr('disabled', 'disabled');
                
                var data = {poiID: {{ $markers->id }}, title: '{{ $markers->title }}'};
                $.ajax({
                    url: '/closeEvent',
                    type: 'post',
                    data: data,
                    success: function(e) {
                        $this.fadeOut('slow');
                        $('.alert-success').css('display', 'block').append(' Event closed successfully.');
                    }
                })
                return false;
            });

            $('.rating').on('mouseover', function() {
                $(this).attr('data-original-title', '{{ $markers->rateTitle }}').tooltip('show');
            });

        });
        function goBack() {
              window.history.back();
          }
    </script>

@endsection