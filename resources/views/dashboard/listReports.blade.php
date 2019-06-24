@extends('layouts.dashboard')
@section('content')

    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-lg-12">
             <div class="alert alert-success report-alert alert-dismissible" style="display: none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong>
            </div>
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                <tr>
                                    <th><span>Reporter</span></th>
                                    <th><span>Event</span></th>
                                    <th><span>Report</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td><a href="/publicProfile/{{ $report->id }}">{{ $report->first_name . ' ' . $report->last_name }}</a></td>
                                        <td><a href="/joinEvent/{{ $report->poiID }}">{{ $report->title }}</a></td>
                                        <td>{{ $report->reportDescription }}</td>
                                        <td><div report-id="{{ $report->report_id }}" class="btn btn-primary btn-small verifyReport">Verify</div></td>
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
            $('.verifyReport').one('click', function() {
                var id = $(this).attr('report-id');
                $this = $(this);
                $.ajax({
                    url: '/verifyReport',
                    type: 'post',
                    data: {report_id: id},
                    success: function(e) {
                        if (e) {
                            $('.report-alert').css('display', 'block').append('Report verified successfully.')
                            $this.removeClass('btn-primary').addClass('btn-info').html('verified');
                        }
                        

                    }
                })
            })
        })
    </script>
@endsection
