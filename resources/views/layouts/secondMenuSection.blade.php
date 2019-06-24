<section class="container box-logo">
    <header>
        <div class="content-logo col-md-12" style="background-color: transparent;">
            <!-- <div class="logo">
                <img src="/img/eventLogo.jpg" width="80" style="margin-top: 0px;" alt="">
            </div> -->
            <div class="bt-menu"><a href="#" class="menu"><span>≡</span> Menu</a></div>

            <div class="box-menu">

                <nav id="cbp-hrmenu" class="cbp-hrmenu">
                    <ul id="menu">
                        <li><a class="lnk-menu {{ Request::is('home') ? ' active' : null }}" href="{{ url('/home') }}">Home</a></li>
                        <li><a class="lnk-menu {{ Request::is('map') ? ' active' : null }}" href="{{ url('/map') }}">Browse Events</a></li>
                        <li><a class="lnk-menu {{ Request::is('contactUs') ? ' active' : null }}" href="{{ '/contactUs' }}">Contact</a></li>
                        <li><a class="lnk-menu {{ Request::is('eSports') ? ' active' : null }}" href="{{ '/eSports' }}">E-Sports</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</section>