@extends('layouts.privateProfile')
@section('content')
<style>
     .panel-collapsable .panel-heading h4:after {
   font-family: 'Glyphicons Halflings';
   content: "\e114";
   float: right;
   color: white;
   margin-right: 5px;
   cursor: pointer;
 }
 .panel-collapsable .collapsed h4:after {
   content: "\e080";
 }
 .panel-heading .btn-group {
   float: right;
 }
</style>

    <div class="panel panel-default panel-collapsable panel-chart">
        <div class="panel-heading">
          <div class="btn-group">
            <button class="btn btn-primary toggle-dropdown" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"> <span class="glyphicon glyphicon-cog"></span>

            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                @if ($users->id != Auth::user()->id)
                    @if ($users->friend === 3)
                        <li><a href="#" class="addFriendText addFriend"><span class="glyphicon glyphicon-plus"></span> add as friend</a></li>
                    @else
                        @if ($users->friend === 2)
                            <li><a href="#">request send</a></li>
                        @else
                            <li><a href="#" class="addFriendText addFriend"><span class="glyphicon glyphicon-remove"></span> Remove Friend</a></li>
                        @endif
                    @endif
                @endif
                <li><a class="block-user" data-toggle="modal" data-target="#blockUser" href="#">Block</a></li>
                <li><a class="report-user" data-toggle="modal" data-target="#userReport" href="#">Report</a></li>
            </ul>
      </div>
      <h4 data-toggle="collapse" data-target="#sg1" aria-expanded="true">{{ $users->first_name.' '.$users->last_name }}</h4>

      <div class="clearfix"></div>
  </div>
  <div id="sg1" class="panel-body collapse in" aria-expanded="true">
    <div class="row">
        <div class="col-xs-3">
            @if(!empty($users->user_picture))
                <img alt="User Pic" width="200" src="{{ $users->user_picture }}" class="img-circle img-responsive">
            @else
                <img alt="User Pic" width="200" src="/img/userDefault.jpg" class="img-circle img-responsive">
            @endif
            <br>
        </div>
        <div class="col-xs-9">
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>{{ $users->first_name.' '.$users->last_name }}</th>
                    </tr>
                </thead>
                <tbody>
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
                        <td>Athletics, Games, Social gatherings</td>
                    </tr>
                    <tr>
                        <td>Rating:</td>
                        <td>
                            <div class="col-xs-12">
                                <div class="rating-block">
                                    <h4>Average rating</h4>
                                    <h2 class="bold padding-bottom-7">{{ $users->rating }} <small>/ 5</small></h2>
                                    <?php $rating = 0; ?>
                                    @for($i=0; $i <= 5; $i++)
                                    @if($rating > 0 )
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                      <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <?php $rating--; ?>
                                    @else
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                      <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <?php $rating--; ?>
                                    @endif
                                    @endfor
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

      
    @include('subView.blockReportUsers')</div>

                            
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
@endsection