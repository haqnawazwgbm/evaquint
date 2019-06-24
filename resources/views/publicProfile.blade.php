@extends('layouts.site')
@section('content')


    <div class="tab-pane fade active in" id="profile-settings">

        <div class="row">
            <div class="col-sm-3">
                <ul id="userSettings" class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#basicInformation" data-toggle="tab"><i class="fa fa-user fa-fw"></i> Basic Information</a>
                    </li>
                    @if ($users->friend === 1)
                    <li class=""><a href="#myEvents" data-toggle="tab"><i class="glyphicon glyphicon-map-marker"></i> Hosted Events</a>
                    </li>
                    @endif
                    <li class=""><a href="#attendedEvents" data-toggle="tab"><i class="glyphicon glyphicon-map-marker"></i> Attended Events</a>
                    </li>
                    <li class=""><a href="#attendingEvents" data-toggle="tab"><i class="glyphicon glyphicon-map-marker"></i> Attending Events</a>
                        </li>
                </ul>
            </div>
            <div class="col-sm-9">
                <div id="userSettingsContent" class="tab-content">
                    <div class="tab-pane fade active in" id="basicInformation">
                        <section id="login" class="container secondary-page">

                            <div class="panel-body">
                                <div class="top-score-title right-score col-md-3 col-xs-4 profilePicture pull-left">
                                    <img alt="User Pic" width="200" src="{{ $users->user_picture }}" class="img-circle img-responsive">
                                </div>
                                <p>
                                    @if ($users->id != Auth::user()->id)
                                        @if ($users->friend === 3)
                                        <span class="glyphicon glyphicon-plus addFriend"></span>
                                        <span class="addFriendText">Add as a friend</span>
                                        @else
                                            @if ($users->friend === 2)
                                            <span class="addFriendText">Request send</span>
                                             @else
                                            <span class="glyphicon glyphicon-remove addFriend"></span>
                                            <span class="addFriendText">Remove Friend</span>
                                            @endif
                                        @endif
                                    @endif
                                    <br />
                                <div class="profileName"><h3>{{ $users->first_name.' '.$users->last_name }}
                                
                            </h3>@include('subView.blockReportUsers')</div>
                            
                                </p>
                                <div class="col-lg-12">
                                    <div class=" col-md-9 col-lg-9">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Followers:</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Rating:
                                                </td>
                                                <td>
                                                    <input id="input-1" class="rating hide input-1" data-show-caption="false" data-min="0" data-max="5" data-step="1"  value="{{ $users->rating }}">

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Location:</td>
                                                <td>55 Dunlevy Ave, Vancouver, BC V6A 3A3, Canada</td>
                                            </tr>
                                            @if (Auth::user()->id == $users->id)
                                            <tr>
                                                <td>Email:</td>
                                                <td>{{ $users->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone number:</td>
                                                <td>{{ $users->phone }}</td>
                                            </tr>
                                            @endif


                                            <tr>
                                                <td>Interests:</td>
                                                <td>Athletics,
                                                    Games,
                                                    Social gatherings</td>
                                            </tr>


                                            </tbody>
                                        </table>
                                        <!-- Include pie chart -->
                                        @include('subView.pieChart')




                                    </div>
                                        <div class="col-lg-8">
                                        <div data-toggle="modal" data-target="#userReport" class="btn btn-lg btn-info">Report</div>
                                        <div data-toggle="modal" data-target="#blockUser" class="btn btn-lg btn-warning">Block</div>
                                    </div>

                                </div>
                                
                            </div>


                        </section>

                        <script>
                            $(document).ready(function() {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                var friend = true;
                                var friend_id;

                                //Add friend start from here.
                                if ($('.addFriend').hasClass( "glyphicon-remove" )) {
                                    friend = false;
                                    friend_id = {{ $users->id }};
                                }
                                
                                $('.addFriend').click(function() {
                                    data = {host_id: {{ $users->id }}, guest_id: {{ Auth::user()->id }}, friend: 'yes'};
                                    if (friend) {
                                        $(this).removeClass('glyphicon-plus');
                                        $(this).addClass('glyphicon-remove');
                                        $('.addFriendText').html('Friend request sent');
                                        friend = false;
                                        $.ajax({
                                            url: '/friend',
                                            type: 'post',
                                            data: data,
                                            success: function(e) {
                                                friend_id = e;
                                                alert('Friend request send successfully');
                                            }
                                        })
                                    } else {
                                        $.ajax({
                                            url: '/unFriend/{{ $users->id }}',
                                            type: 'get',
                                            success: function(e) {
                                                alert('Friend request canceled successfully');
                                            }
                                        })
                                        $(this).removeClass('glyphicon-remove');
                                        $(this).addClass('glyphicon-plus');
                                        $('.addFriendText').html('Add as a friend');
                                        friend = true;
                                    }

                                });

                                //Disable rating start from here.
                                $('.input-1').rating({displayOnly: true, step: 0.5});
                                $('#input-1').after('<div class="pull-right decimalRating"> {{ $users->rating.'/5' }}</div>');
                            });
                        </script>
                    </div>

                    <div class="tab-pane fade col-lg-12" id="attendedEvents">
                        <h3>Events Your Attended</h3>
                        <table class="table table-user-information">
                            <tbody>
                            @foreach ($users->attendedEvents as $attendedEvent)

                                <tr>
                                    <td><a  href="/map/{{ $attendedEvent->id }}"><img data-toggle="tooltip" data-original-title="Click to show event on map" src="/img/marker.png" /></a></td>
                                    <td><p><a href="/joinEvent/{{ $attendedEvent->id }}">{{ $attendedEvent->title }}</a></p><p>{{ $attendedEvent->dateTime }}</p></td>
                                    
                                        @foreach ($attendedEvent->eventImages as $eventImage)
                                            <div class="eventPictures viewImage thumb"><img src="{{ $eventImage->path }}" /></div>
                                        @endforeach
                                    </td>

                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>

                     <div class="tab-pane fade col-lg-12" id="attendingEvents">
                                            <h3>Events Your Attending</h3>
                                            <table class="table table-user-information">
                                                <tbody>
                                                @foreach ($users->attendingEvents as $attendingEvent)

                                                    <tr>
                                                        <td><a  href="/map/{{ $attendingEvent->id }}"><img data-toggle="tooltip" data-original-title="Click to show event on map" src="/img/marker.png" /></a></td>
                                                        <td><p><a href="/joinEvent/{{ $attendingEvent->id }}">{{ $attendingEvent->title }}</a></p><p>{{ $attendingEvent->dateTime }}</p></td>
                                                        <td>
                                                            @foreach ($attendingEvent->eventImages as $eventImage)
                                                                    <div class="eventPictures viewImage thumb"><img src="{{ $eventImage->path }}" /></div>
                                                            @endforeach
                                                        </td>

                                                    </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>

                            </div>


                    <!-- My events start from here. -->
                    <div class="tab-pane fade col-lg-12" id="myEvents">
                        <h3>Hosted Events</h3>
                        <table class="table table-user-information">
                            <tbody>
                            @foreach ($users->myEvents as $myEvent)

                                <tr>
                                    <td><a  href="/map/{{ $myEvent->id }}"><img width="100" data-toggle="tooltip" data-original-title="Click to show event on map" src="{{ $myEvent->eventPicture }}" /></a></td>
                                    <td><p><a href="/joinEvent/{{ $myEvent->id }}">{{ $myEvent->title }}</a></p><p>{{ $myEvent->dateTime }}</p></td>
                                    <td><input name="input-1" class="input-1 rating hide" data-show-caption="false" data-min="0" data-max="5" data-step="1" value="{{ $myEvent->rating }}"></td>
                                    <td>
                                    <td>
                                        @foreach ($myEvent->eventImages as $eventImage)
                                            <div class="eventPictures viewImage thumb"><img src="{{ $eventImage->path }}" /></div>
                                        @endforeach
                                    </td>

                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

    </div>
    </div>


    <!-- The Image Modal -->
    <div id="imageModal" class="imageModal">
        <span class="imageClose">&times;</span>
        <img class="imageModal-content" id="img01">
        <div id="caption"></div>
    </div>

    <script>
        $(document).ready(function () {
            //Image crop start from here.
            $(".container_photo").PictureCut({
                InputOfImageDirectory       : "image",
                PluginFolderOnServer        : "/js/",
                FolderOnServer              : "/uploads/",
                EnableCrop                  : true,
                CropWindowStyle             : "Bootstrap"
            });

            prettyPrint();

            // Get the modal
            var modal = document.getElementById('imageModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('viewImage');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            $('.viewImage').click(function(){
                modal.style.display = "block";
                modalImg.src = this.children[0].src;

                captionText.innerHTML = this.children[0].alt;
            });

// Get the <span> element that closes the modal
            var span = document.getElementsByClassName("imageClose")[0];

// When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
        });
    </script>

@endsection