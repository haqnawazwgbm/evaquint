@extends('layouts.dashboard')
@section('content')
   <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                <tr>
                                    <th><span></span></th>
                                    <th><span>Title</span></th>
                                    <th><span>Description</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($markers as $marker)
                                    <tr>
                                        <td><img src="{{ $marker->eventPicture }}" width="200" alt=""></td>
                                        <td><a href="/joinEvent/{{$marker->id}}"{{ $marker->title }}</a></td>
                                        <td>{{ $marker->eventDescription }}</td>
                                        <td style="width: 20%;"><a href="/map/{{ $marker->id }}" class="table-link"> <span class="fa-stack"> <i
                                                            class="fa fa-square fa-stack-2x"></i> <i
                                                            class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span>
                                            </a> <a href="/editEvent/{{ $marker->id }}" class="table-link"> <span
                                                        class="fa-stack"> <i
                                                            class="fa fa-square fa-stack-2x"></i> <i
                                                            class="fa fa-pencil fa-stack-1x fa-inverse"></i> </span>
                                            </a> <a
                                                    href="/deleteEvent/{{ $marker->id }}" class="table-link danger"> <span class="fa-stack"> <i
                                                            class="fa fa-square fa-stack-2x"></i> <i
                                                            class="fa fa-trash-o fa-stack-1x fa-inverse"></i> </span>
                                            </a>
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
    @endsection