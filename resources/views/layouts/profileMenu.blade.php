<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="glyphicon glyphicon-user"></span>
        {{ Auth::user()->first_name }}
        <span class="glyphicon glyphicon-chevron-down"></span>
    </a>
    <ul class="dropdown-menu top-profile-menu">
        <li>
            <div class="navbar-login">
                <div class="row">
                    <div class="col-lg-4">
                        <p class="text-center">
                            <img class="img-profile" src="{{ Auth::user()->user_picture  }}" />
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <p class="text-left"><strong>{{ Auth::user()->first_name.' '.Auth::user()->last_name  }}</strong></p>
                        <p class="text-left small">{{ Auth::user()->email }} </p>
                        <p class="text-left">
                            <a href="/profile/basicInfo" class="btn btn-primary btn-block btn-sm">Profile</a>
                        </p>
                    </div>
                </div>
            </div>
        </li>
        <li class="divider navbar-login-session-bg"></li>
        <li><a href="/myActiveEvents">Manage Active Events<span class="glyphicon glyphicon-cog pull-right"></span></a></li>
        <li><a href="/myFinishedEvents">Manage Finished Events<span class="glyphicon glyphicon-cog pull-right"></span></a></li>
        <li><a href="/profile/basicInfo">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
        <li>
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                Log Out<span class="glyphicon glyphicon-log-out pull-right"></span>
            </a>
        </li>
    </ul>
</li>