@extends('layouts.publicProfile')
@section('content')
 <h3>Events Your Attended</h3>
                        <table class="table table-user-information">
                            <tbody>
                            @foreach ($attendedEvents as $attendedEvent)

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

              {!! $attendedEvents->render() !!}             
@endsection