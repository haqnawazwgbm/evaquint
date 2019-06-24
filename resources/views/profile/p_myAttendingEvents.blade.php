@extends('layouts.privateProfile')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Events Your Attending
    </div>
    <div class="panel-body">
        <table class="table table-user-information">
            <tbody>
                @foreach ($attendingEvents as $attendingEvent)
                <tr>
                    <td><a  href="/map/{{ $attendingEvent->id }}"><img data-toggle="tooltip" data-original-title="Click to show event on map" src="/img/marker.png" /></a></td>
                    <td><p><a href="/joinEvent/{{ $attendingEvent->id }}">{{ $attendingEvent->title }}</a></p><p>{{ date('M j, Y, g:i a', strtotime($attendingEvent->dateTime)) }}</p></td>
                    <td>
                        @foreach ($attendingEvent->eventImages as $eventImage)
                        <div class="eventPictures viewImage thumb"><img src="{{ $eventImage->path }}" /></div>
                        @endforeach
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <span class="pull-right">  {!! $attendingEvents->render() !!} </span>
    </div>
</div>
@endsection