@extends('layouts.privateProfile')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12 lead">User profile<hr></div>
          </div>
          <div class="row">
            <div class="col-md-4 text-center">
              <img class="img-circle avatar avatar-original img-responsive img-thumbnail" width="200" height="200" style="-webkit-user-select:none; 
              display:block; margin:auto;" src="{{ $users->user_picture }}">
                <div class="center-block">
                    <h2 class="bold padding-bottom-7">{{ $users->rating }} <small>/ 5</small></h2>
                    <?php $rating = $users->rating; ?>
                    @for($i=1; $i <= 5; $i++)
                    @if($rating > 0 )
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <?php $rating--; ?>
                    @else
                    <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    <?php $rating--; ?>
                    @endif
                    @endfor
                </div>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <h1 class="only-bottom-margin">{{ $users->first_name.' '.$users->last_name }}</h1>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span class="text-muted">Email:</span> {{ $users->email }}<br>
                  <span class="text-muted">Birth date:</span> {{ $users->birth_date }}<br>
                  <span class="text-muted">Phone Number:</span> {{ $users->phone_number }}<br>
                  <span class="text-muted">Gender:</span> male<br><br>
                  <span class="text-muted">Location:</span> 55 Dunlevy Ave, Vancouver, BC V6A 3A3, Canada<br><br>
                  <span class="text-muted">Gender:</span> male<br><br>
                  <small class="text-muted">Created: {{ date('M j, Y, g:i a', strtotime($users->created_at)) }}</small><br>
                  <small class="text-muted">Rating: <br>
                                                            <?php $rating = $users->rating; ?>
                                                            @for($i=1; $i <= 5; $i++)
                                                            @if($rating > 0 )
                                                            <span class="glyphicon glyphicon-star pull-left" aria-hidden="true"></span>
                                                            <?php $rating--; ?>
                                                            @else
                                                            <span class="glyphicon glyphicon-star-empty pull-left" aria-hidden="true"></span>
                                                            <?php $rating--; ?>
                                                            @endif
                                                            @endfor
                                                    </small>
                </div>
                <div class="col-md-6">
                  <div class="activity-mini">
                    <i class="glyphicon glyphicon-comment text-muted"></i> 500
                  </div>
                  <div class="activity-mini">
                    <i class="glyphicon glyphicon-thumbs-up text-muted"></i> 1500
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <hr><a class="btn btn-default pull-right" href="/profile/myUpdateInfo"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                            {{-- Panel start here --}}
                            
                                
                            {{-- panel end here --}}

                            <script>
                                $(document).ready(function() {


                                    //Disable rating start from here.
                                    $('.input-1').rating({displayOnly: true, step: 0.5});
                                    $('#input-1').after('<div class="pull-right decimalRating"> {{ $users->rating.'/5' }}</div>');
                                });
                            </script>
@endsection