<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A Toronto-based start-up aiming to revolutionize the way people plan, organize and attend events. We are aiming to be the face of event organization one step at a time.">
    <meta name="keywords" content="evaquint,event,toronto">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Facebook meta start from here. -->
    <meta property="og:url"           content="http://fleek.mindgigspk.com/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Fleek" />
    <meta property="og:description"   content="The fleek which can create an event" />
    <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />
    
    <title>{{ config('app.name', 'Evaquint') }}</title>

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">


    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300'
          rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,300,200,500,600,700,800,900' rel='stylesheet'
          type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

    <link href="/css/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="/css/component.css" rel="stylesheet">
    <link href="/css/prettyPhoto.css" rel="stylesheet">
    <link href="/css/style_dir.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">

    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/modal-style.css" rel="stylesheet">
    <link href="/css/bootstrap-notifications.css" rel="stylesheet">
    <link href="/css/chat.css" rel="stylesheet">
    <link href="/css/prettify.css" rel="stylesheet">
    <link href="/css/sb-admin.css" rel="stylesheet">


    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABzqz481iFVBMSQIEQMViPh5MjowfsLYE&libraries=places"></script>

     <link rel="canonical" href="http://fleek.mindgigspk.com/" />
        <!-- Scripts -->
        <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
</head>
<body>
<div class="main-wrapper" id="bslide">
<section class="content-top-login">
    <div class="container">
        <div class="col-xs-12">
            <div class="box-support">
                <p class="support-info"><!--<i class="fa fa-envelope-o"></i>--><i><a href="/home">Evaquint</a></i></p>
            </div>
            @if (!Auth::guest())
            <div class="searchPeople col-md-8 col-sm-8 col-xs-7 col-lg-6 col-lg-offset-1 col-xs-offset-2">
                <form action="{{ url('/searchPeople') }}" class="searchPeopleForm" method="post">
                    {{ csrf_field() }}
                    <input type="text" name="searchPeople" class="  search-query form-control" placeholder="Search People">
                    <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                    </span>
                </form>
             </div>
             @endif

            <div class="box-login">
                <!-- <a href="login.html">Login</a>-->
                @if (Auth::guest())
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                @else
                    @include('layouts.notifications')
                    @include('layouts.friendRequests')
                    <a href="{{ url('/dashboard') }}">Dashboard</a>

                    @include('layouts.profileMenu')
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
            </div>

        </div>
    </div>
</section>

<section class="container box-logo">
    <header>
        <div class="content-logo col-xs-12" style="background-color: transparent;">
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
@include('_messages')
<div class="col-xs-2">
                    <ul id="userSettings" class="nav nav-pills nav-stacked">
                        <li class="{{ Request::is('dashboard') ? ' active' : null }}"><a href="/dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li class="{{ Request::is('dashboard/events') ? ' active' : null }}"><a href="/dashboard/events" ><i class="glyphicon glyphicon-map-marker"></i> Total Events</a>
                        </li>
                        <li class="{{ Request::is('dashboard/users') ? ' active' : null }}"><a href="/dashboard/users"><i id="friendTab" class="glyphicon glyphicon-user"></i> Users</a>
                        </li>
                        <li class="{{ Request::is('dashboard/blockUsers') ? ' active' : null }}"><a href="/dashboard/blockUsers"><i id="friendTab" class="glyphicon glyphicon-user"></i> Block Users</a>
                        </li>
                        <li class="{{ Request::is('dashboard/eventReports') ? ' active' : null }}"><a href="/dashboard/eventReports"><i class="fa fa-flag pull-left"></i> Event Reports</a>
                        </li>
                        <li class="{{ Request::is('dashboard/userReports') ? ' active' : null }}"><a href="/dashboard/userReports"><i class="fa fa-flag pull-left"></i> User Reports</a>
                        </li>
                        <li class="{{ Request::is('dashboard/underTwoAndHalfStars') ? ' active' : null }}"><a href="/dashboard/underTwoAndHalfStars"><i class="glyphicon glyphicon-map-marker"></i> Under 2.5 Stars Events</a>
                        </li>
                        <li class=""><a href="#updateInformation"><i class="fa fa-cog"></i> Update Information</a>
                        </li>
                        <li class=""><a href="#billingInformation"><i class="fa fa-cog"></i> Billing Information</a>
                        </li>
                    </ul>
                </div>
        <div class="col-xs-10">
        @yield('content')
        </div>
</div>

<!-- Footer section start from here.-->
<section id="footer-tag" class="col-xs-12">
    <div class="container">
        <div class="col-xs-12">
            <div class="col-xs-3">
                <h3>About Us</h3>
                <p>A Toronto-based start-up aiming to revolutionize the way people plan, organize and attend events. We are aiming to be the face of event organization one step at a time.</p>

            </div>
           <!-- Load categories -->
           @include('layouts.footerCategories')
            <!-- Load popular events -->
            @include('layouts.footerTrendingEvents')
            
           <!--  <div class="col-md-3 footer-newsletters">
                <h3>Newsletters</h3>
                <form method="post">
                    <div class="name">
                        <label for="name">* Name:</label>
                        <div class="clear"></div>
                        <input id="name" name="name" type="text" placeholder="e.g. Mr. John Doe" required="">
                    </div>
                    <div class="email">
                        <label for="email">* Email:</label>
                        <div class="clear"></div>
                        <input id="email" name="email" type="text" placeholder="example@domain.com" required="">
                    </div>
                    <div id="loader">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div> -->
          <!--   <div class="col-xs-12">
                <ul class="social">
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                    <li><a href=""><i class="fa fa-digg"></i></a></li>
                    <li><a href=""><i class="fa fa-rss"></i></a></li>
                    <li><a href=""><i class="fa fa-youtube"></i></a></li>
                    <li><a href=""><i class="fa fa-tumblr"></i></a></li>

                </ul>
            </div> -->
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!--MENU-->
<!--END MENU-->
<!-- Button Anchor Top-->

<script src="/js/custom.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js"></script>

@yield('interestsTags')




<script src="//cdnjs.cloudflare.com/ajax/libs/authy-forms.js/2.2/form.authy.min.js"></script>




<script src="/js/coverflow-slideshow.js"></script>
@yield('markers')
@yield('registerEvent')



<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('body').on('click', '.notification-block', function(e) {
            //e.preventDefault();
            return false;
        });

        $('body').on('click', '.notification_circle', function(e) {
            $(this).remove();
            $('.tooltip').tooltip('hide');
        });

    });

    function goBack() {
              window.history.back();
          }

 
</script>
</body>
</html>
