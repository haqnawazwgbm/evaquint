@extends('layouts.site')
@section('content')
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible map-alert" style="position:static;display: {{$users->display}};">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Oops!</strong> The result your looking not found.
                    </div>
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <caption>All People</caption>
                                <tbody>
                                @foreach ($users as $user)

                                    <tr>
                                        <td><a  href="/publicProfile/basicInfo/{{ $user->id }}"><img data-toggle="tooltip" data-original-title="Click to show public profile" width="100" height="100" src="{{ $user->user_picture }}" /></a></td>
                                        <td><a href="/publicProfile/basicInfo/{{ $user->id }}">{{ $user->first_name.' '.$user->last_name }}</a></td>
                                        <td>
                                            @if ($user->friend_accepted == 'yes')
                                            <div class="btn-group">
                                              <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="{{ $user->id }}" data-hover="dropdown" aria-expanded="false">Unfriend</button>
                                              <!-- <ul class="dropdown-menu">
                                                <li><a id="{{ $user->id }}" href="#">Unfriend</a></li>
                                              </ul> -->
                                            </div>
                                            @else
                                                @if ($user->friend_accepted == 'no')
                                                    <div class="btn btn-primary">Request Sent</div>
                                                @else
                                                    <div id="{{ $user->id }}" class="btn btn-primary friend">Add Friend</div>
                                                @endif
                                            @endif

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
    <script>
        $(document).ready(function() {
            $('.friend').one( "click", function() {
                $(this).html('Request Sent');
                var host_id = $(this).attr('id');
                var data = { 'host_id': host_id, 'guest_id': {{ Auth::user()->id }}};
                $.ajax({
                    url: '/friend',
                    type: 'post',
                    data: data,
                    success: function(e) {
                        friend_id = e;
                    }
                })
            })
            $('.btn-group').find('.btn-primary').one('click', function() {
                var $this = $(this);
                    
                    if (confirm('Are you want to remove this friend?')) {
                        $this.html('Removing Friend');
                        $.ajax({
                        url: '/unFriend/'+$(this).attr('id'),
                        type: 'get',
                        success: function(e) {
                            $this.removeClass('btn-primary');
                            $this.addClass('btn-danger');
                            $this.html('Friend Removed');

                        }
                    });
              }
              
               
            })
        })
    </script>
@endsection