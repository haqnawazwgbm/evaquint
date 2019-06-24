@extends('layouts.site')
@section('content')


        <div class="tab-pane fade active in" id="profile-settings">

            <div class="row">
                <div class="col-sm-3" >
                    <ul id="userSettings" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#basicInformation" data-toggle="tab"><i class="fa fa-user fa-fw"></i> Basic Information</a>
                        </li>
                        <li class=""><a href="#myEvents" data-toggle="tab"><i class="glyphicon glyphicon-map-marker"></i> Events you created</a>
                        </li>
<<<<<<< HEAD
                        <li class=""><a href="#friends" data-toggle="tab"><i id="friendTab" data-count="" class="glyphicon glyphicon-user "></i> Friends ( {{ $users->totalFriends }} )</a>
=======
                        <li class=""><a href="#friends" data-toggle="tab"><i id="friendTab" data-count="{{ $users->totalFriends }}" class="glyphicon glyphicon-user notification-icon"></i> Friends</a>
>>>>>>> 2a3096a8cbf87757bd50c848bf67af61ec2fcf98
                        </li>
                        <li class=""><a href="#attendedEvents" data-toggle="tab"><i class="glyphicon glyphicon-map-marker"></i> Events you've attended</a>
                        </li>
                        <li class=""><a href="#attendingEvents" data-toggle="tab"><i class="glyphicon glyphicon-map-marker"></i> Events you're attending</a>
                        </li>
                        <li class=""><a href="#notificationSettings" data-toggle="tab"><i class="glyphicon glyphicon-bell"></i> Notifications Settings</a>
                        </li>
                        <li class=""><a href="#updateInformation" data-toggle="tab"><i class="fa fa-cog"></i> Update Information</a>
                        </li>
                        <!-- <li class=""><a href="#billingInformation" data-toggle="tab"><i class="fa fa-cog"></i> Billing Information</a>
                        </li> -->
                        <li class=""><a href="#profilePicture" data-toggle="tab"><i class="fa fa-picture-o fa-fw"></i> Profile Picture</a>
                        </li>
                        <li class=""><a href="#changePassword" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> Change Password</a>
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

                                        <br />
                                        <div class="profileName"><h3>{{ $users->first_name.' '.$users->last_name }}</h3></div>

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
                                                        <input id="input-1" name="input-1" class="rating hide input-1" data-show-caption="false" data-min="0" data-max="5" data-step="1" value="{{ $users->rating }}">

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Location:</td>
                                                    <td>55 Dunlevy Ave, Vancouver, BC V6A 3A3, Canada</td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td>{{ $users->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone number:</td>
                                                    <td>{{ $users->phone_number }}</td>
                                                </tr>


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

                                    </div>
                                </div>


                            </section>

                            <script>
                                $(document).ready(function() {


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
                                                        
                                                        <td>
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
                            <!-- Notification settings -->
                            @include('subView.profile.notificationSettings')

                        <!-- list friends -->
                        <div class="tab-pane fade col-lg-12" id="friends">
                            <h3>Your Friends</h3>
                            <table class="table table-user-information">
                                <tbody>
                                @foreach ($users->friends as $friend)

                                    <tr>
                                        <td><a  href="/publicProfile/{{ $friend->id }}"><img data-toggle="tooltip" data-original-title="click to show profile" src="{{ $friend->user_picture }}" /></a></td>
                                        <td><p>{{ $friend->first_name.' '.$friend->last_name }}</p></td>
                                        <td><div id="{{ $friend->host_id }}" class="btn btn-danger removeFriend">Remove Friend</div></td>


                                    </tr>
                                @endforeach


                                </tbody>
                            </table>

                        </div>


                        <!-- My events start from here. -->
                        <div class="tab-pane fade col-lg-12" id="myEvents">
                            <h3>Events You Created</h3>
                            <table class="table table-user-information">
                                <tbody>
                                @foreach ($users->myEvents as $myEvent)

                                    <tr>
                                        <td><a  href="/map/{{ $myEvent->id }}"><img width="100" data-toggle="tooltip" data-original-title="Click to show event on map" src="{{ $myEvent->eventPicture }}" /></a></td>
                                        <td><p><a href="/joinEvent/{{ $myEvent->id }}">{{ $myEvent->title }}</a></p><p>{{ $myEvent->dateTime }}</p></td>
                                        <td><input name="input-1" class="rating hide input-1" data-show-caption="false" data-min="0" data-max="5" data-step="1" value="{{ $myEvent->rating }}"></td>
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


                        <div class="tab-pane fade col-lg-12" id="updateInformation">
                            <form method="POST" class="register-form" action="{{ url('/editProfile') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $users->id  }}" />
                                <div class="name">
                                    <label for="firstname">* First Name:</label>
                                    <div class="clear"></div>
                                    <input id="first_name" class="{{ $errors->has('first_name') ? ' has-error' : '' }}" name="first_name" value="{{ $users->first_name }}" type="text"
                                           placeholder="e.g. Mr. John" required="">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                               <strong>{{ $errors->first('first_name') }}</strong>
                      </span>
                                    @endif
                                </div>
                                <div class="name">
                                    <label for="lastname">* Last Name:</label>
                                    <div class="clear"></div>
                                    <input id="last_name" class="{{ $errors->has('last_name') ? ' has-error' : '' }}" name="last_name" value="{{ $users->last_name }}" type="text" placeholder="e.g. Mr. Doe" required="">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                               <strong>{{ $errors->first('last_name') }}</strong>
                      </span>
                                    @endif
                                </div>
                                <div class="email">
                                    <label for="email">* Email:</label>
                                    <div class="clear"></div>
                                    <input id="email" name="email" class="{{ $errors->has('email') ? ' has-error' : '' }}" value="{{ $users->email }}" type="text"
                                           placeholder="example@domain.com" required="">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                               <strong>{{ $errors->first('email') }}</strong>
                      </span>
                                    @endif

                                </div>


                                <div id="register-submit">
                                    <input type="submit" value="Update">
                                </div>
                            </form>
                        </div>
                        <!-- Billing information start from here -->
                        <div class="tab-pane fade col-lg-12" id="billingInformation">
                            <form method="POST" class="register-form" action="{{ url('/insertBilling') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $users->id  }}" />
                                <div class="name">
                                    <label for="firstname">* Full Name:</label>
                                    <div class="clear"></div>
                                    <input id="full_name" class="{{ $errors->has('full_name') ? ' has-error' : '' }}" name="full_name" type="text"
                                           placeholder="e.g. Mr. John" required="">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                               <strong>{{ $errors->first('full_name') }}</strong>
                      </span>
                                    @endif
                                </div>
                                <div class="fullAddress">
                                    <label for="fullAddress">* Full Address:</label>
                                    <div class="clear"></div>
                                    <input id="fullAddress" class="{{ $errors->has('fullAddress') ? ' has-error' : '' }}" name="fullAddress" type="text" placeholder="e.g. stree, 1223" required="">
                                    @if ($errors->has('fullAddress'))
                                        <span class="help-block">
                               <strong>{{ $errors->first('fullAddress') }}</strong>
                      </span>
                                    @endif
                                </div>
                                <div class="country">
                                    <label for="country">* Country:</label>
                                    <div class="clear"></div>
                                    <input id="country" name="country" class="{{ $errors->has('country') ? ' has-error' : '' }}" type="text"
                                           placeholder="Pakistan, Canada" required="">
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                               <strong>{{ $errors->first('country') }}</strong>
                      </span>
                                    @endif

                                </div>
                                <div class="vatIdNumber">
                                    <label for="vatIdNumber">* Vat Id Number:</label>
                                    <div class="clear"></div>
                                    <input id="vatIdNumber" name="country" class="{{ $errors->has('vatIdNumber') ? ' has-error' : '' }}" type="text"
                                           placeholder=" " required="">
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                               <strong>{{ $errors->first('vatIdNumber') }}</strong>
                      </span>
                                    @endif

                                </div>
                                <div class="interestedInvoice">
                                    <input id="vatIdNumber" name="country" class="{{ $errors->has('vatIdNumber') ? ' has-error' : '' }}" type="checkbox"
                                           placeholder=" " required="">
                                    <P>I'm interested receiving invoices for my payments</P>

                                </div>


                                <div id="register-submit">
                                    <input type="submit" value="Update">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade  col-lg-12" id="profilePicture">
                            <h3>Current Picture:</h3>
                            <br>
                            <form class="register-form" action="/updateProfilePicture">
                                <div class="form-group">
                                    <div id="container_photo" class="container_photo"></div>
                                    <label>Choose a New Image</label>
                                    <p class="help-block"><i class="fa fa-warning"></i> Image must be no larger than 500x500 pixels. Supported formats: JPG, GIF, PNG</p>

                                </div>
                                <input type="hidden" name="userID" value="{{ $users->id  }}" />
                                <div id="register-submit">
                                    <input type="submit" value="Update Profile Picture" />
                                </div>
                            </form>


                        </div>
                        <div class="tab-pane fade col-lg-12" id="changePassword">
                            <h3>Change Password:</h3>
                            <form method="POST" class="register-form" id="change-password-form" action="{{ url('/changePassword') }}" type="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="name">
                                    <label for="current_password">* Current Password:</label>
                                    <div class="clear"></div>
                                    <input id="current_password" name="current_password" type="password" placeholder="Old Password" required="">
                                </div>
                                <div class="name">
                                    <label for="password">* Password:</label>
                                    <div class="clear"></div>
                                    <input id="password" name="password" type="password" placeholder="New Password" required="">
                                </div>
                                <div class="name">
                                    <label for="password_confirmation">* Confirm Password:</label>
                                    <div class="clear"></div>
                                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repeat New Password" required="">
                                </div>
                                 <span class="help-block">
                                    </span>

                                <div id="register-submit">
                                    <input type="submit" value="Update Password">
                                    <button  class="btn-cancel">Cancel</button>
                                </div>

                            </form>
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

            $('.removeFriend').one('click', function() {
                var $this = $(this);
                $this.html('Removing Friend');
                $.ajax({
                    url: '/unFriend/'+$(this).attr('id'),
                    type: 'get',
                    success: function(e) {
                        $this.parent().parent().fadeOut('slow');
                        var num = +$('#friendTab').attr("data-count");
                        num = num - 1;
                         $('#friendTab').attr('data-count', num);
                    }
                });
            });

    // Change password start from here.
    // this is the id of the form
    $("#change-password-form").submit(function(e) {

        var url = "/changePassword"; // the script where you handle the form input.

        $.ajax({
               type: "POST",
               url: url,
               data: $("#change-password-form").serialize(), // serializes the form's elements.
               success: function(data)
               {
                   alert(data); // show response from the php script.
               },
               error: function(xhr,textStatus,thrownError) {
                    var er = JSON.parse(xhr.responseText);
                    $.each(er.error, function(i,n) {
                        $('.help-block').append('<br /><strong>'+n+'</strong>');
                    });
            
                }
             });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
        });
    </script>

@endsection