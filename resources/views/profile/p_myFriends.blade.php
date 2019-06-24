@extends('layouts.privateProfile')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Your Friends
    </div>
    <div class="panel-body">
        <table class="table table-user-information table-responsive">
            <tbody>
                @forelse ($friends as $friend)

                <tr>
                    <td><a  href="/publicProfile/basicInfo/{{ $friend->id }}"><img data-toggle="tooltip" data-original-title="click to show profile" src="{{ $friend->user_picture }}" /></a></td>
                    <td><a href="/publicProfile/basicInfo/{{ $friend->id }}">{{ $friend->first_name.' '.$friend->last_name }}</a></td>
                    <td><a id="{{ $friend->host_id }}" onclick="return window.confirm('are you sure....?')" class="removeFriend">Remove Friend</a></td>
                </tr>
                @empty
                    No Record Found.
                @endforelse


            </tbody>
        </table>
        @if(!empty($friends))
        <span class="pull-right"> {!! $friends->render() !!} </span>
        @endif
    </div>
</div>
<script>
    $(document).ready(function() {
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
    })
</script>

@endsection