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
                                    <th><span>User</span></th>
                                    <th><span>Created</span></th>
                                    <th><span>Email</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><img src="http://bootdey.com/img/Content/user_1.jpg" alt=""> <a href="#"
                                                                                                            class="user-link">{{ $user->first_name }} {{ $user->last_name }} </a>
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td><a href="#">{{ $user->email }}</a></td>
                                        <td style="width: 20%;"><a href="#" class="table-link"> <span class="fa-stack"> <i
                                                            class="fa fa-square fa-stack-2x"></i> <i
                                                            class="fa fa-search-plus fa-stack-1x fa-inverse"></i> </span>
                                            </a> <a href="/getProfile/{{ $user->id }}" class="table-link"> <span
                                                        class="fa-stack"> <i
                                                            class="fa fa-square fa-stack-2x"></i> <i
                                                            class="fa fa-pencil fa-stack-1x fa-inverse"></i> </span>
                                            </a> <a
                                                    href="{{ $user->id }}" class="table-link danger"> <span class="fa-stack"> <i
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