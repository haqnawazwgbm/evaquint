@extends('layouts.privateProfile')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Events You Created
    </div>
    <div class="panel-body">
        <table class="table table-user-information table-responsive">
            <tbody>
                @foreach ($myEvents as $myEvent)
                <tr>
                    <td>
                        <a  href="/map/{{ $myEvent->id }}"><img class="img-responsive" width="50" height="40" data-toggle="tooltip" data-original-title="Click to show event on map" src="{{ $myEvent->eventPicture }}" /></a>
                    </td>
                    <td>
                        <a href="/joinEvent/{{ $myEvent->id }}">{{ $myEvent->title }}</a> ( {{ date('M j, Y, g:i a', strtotime($myEvent->dateTime)) }} )
                    </td>
                    <td>
                        <div class="col-sm-8 col-xs-12">
                            <div class="rating-block">
                                {{-- <h4>Average user rating</h4>
                                <h2 class="bold padding-bottom-7">{{ $myEvent->rating }} <small>/ 5</small></h2> --}}
                                <?php $rating = 3; ?>
                                @for($i=1; $i<= 5; $i++)
                                @if($rating > 0 )
                                    <span class="glyphicon glyphicon-star pull-left" aria-hidden="true"></span>
                                <?php $rating--; ?>
                                @else
                                  <span class="glyphicon glyphicon-star-empty pull-left" aria-hidden="true"></span>
                                <?php $rating--; ?>
                                @endif
                                @endfor
                            </div>
                        </div>
                    </td>
                    <td>
                        @foreach ($myEvent->eventImages as $eventImage)
                        <div class="eventPictures viewImage thumb"><img src="{{ $eventImage->path }}" /></div>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right">{!! $myEvents->render() !!}</div>
    </div>
</div>


<script>
    $(document).ready(function() {
         //Disable rating start from here.
             $('.input-1').rating({displayOnly: true, step: 0.5});
    })
</script>
@endsection