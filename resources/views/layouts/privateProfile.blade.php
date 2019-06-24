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
    <!-- <link href="/css/own/owl.carousel.css" rel="stylesheet">
    <link href="/css/own/owl.theme.css" rel="stylesheet"> -->
   <!--  <link href="/css/jquery.bxslider.css" rel="stylesheet">
    <link href="/css/jquery.jscrollpane.css" rel="stylesheet">
    <link href="/css/minislide/flexslider.css" rel="stylesheet"> -->
    <link href="/css/component.css" rel="stylesheet">
    <link href="/css/prettyPhoto.css" rel="stylesheet">
    <link href="/css/style_dir.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <!-- <link href="/css/animate.css" rel="stylesheet"> -->
    <link href="/css/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="/css/input-tags.css" rel="stylesheet">
    <link href="/css/loading.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.min.css" />
	<link href="/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/css/slider.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/map.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
   <!--  <link href="/css/modal-style.css" rel="stylesheet"> -->
    <link href="/css/bootstrap-notifications.css" rel="stylesheet">
    <link href="/css/chat.css" rel="stylesheet">
    <link href="/css/prettify.css" rel="stylesheet">
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/authy-forms.css/2.2/form.authy.min.css">


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
<style>
    h3 {
        margin-top: 0px;
    }
    #footer-tag {
        padding-top: 120px;
    }
</style>
<style>
    body,html{
        height: 100%;
    }

    /* remove outer padding */
    .main .row{
        padding: 0px;
        margin: 0px;
    }

    /*Remove rounded coners*/

    nav.sidebar.navbar {
        border-radius: 0px;
    }

    nav.sidebar, .main{
        -webkit-transition: margin 200ms ease-out;
        -moz-transition: margin 200ms ease-out;
        -o-transition: margin 200ms ease-out;
        transition: margin 200ms ease-out;
    }

    /* Add gap to nav and right windows.*/
    .main{
        padding: 10px 10px 0 10px;
    }

    /* .....NavBar: Icon only with coloring/layout.....*/

    /*small/medium side display*/
    @media (min-width: 768px) {

        /*Allow main to be next to Nav*/
        .main{
            position: absolute;
            width: calc(100% - 40px); /*keeps 100% minus nav size*/
            margin-left: 40px;
            float: right;
        }

        /*lets nav bar to be showed on mouseover*/
        nav.sidebar:hover + .main{
            margin-left: 200px;
        }

        /*Center Brand*/
        nav.sidebar.navbar.sidebar>.container .navbar-brand, .navbar>.container-fluid .navbar-brand {
            margin-left: 0px;
        }
        /*Center Brand*/
        nav.sidebar .navbar-brand, nav.sidebar .navbar-header{
            text-align: center;
            width: 100%;
            margin-left: 0px;
        }

        /*Center Icons*/
        nav.sidebar a{
            padding-right: 13px;
        }

        /*adds border top to first nav box */
        nav.sidebar .navbar-nav > li:first-child{
            border-top: 1px #e5e5e5 solid;
        }

        /*adds border to bottom nav boxes*/
        nav.sidebar .navbar-nav > li{
            border-bottom: 1px #e5e5e5 solid;
        }

        /* Colors/style dropdown box*/
        nav.sidebar .navbar-nav .open .dropdown-menu {
            position: static;
            float: none;
            width: auto;
            margin-top: 0;
            background-color: transparent;
            border: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        /*allows nav box to use 100% width*/
        nav.sidebar .navbar-collapse, nav.sidebar .container-fluid{
            padding: 0 0px 0 0px;
        }

        /*colors dropdown box text */
        .navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
            color: #777;
        }

        /*gives sidebar width/height*/
        nav.sidebar{
            width: 200px;
            height: 100%;
            margin-left: -160px;
            float: left;
            z-index: 8000;
            margin-bottom: 0px;
        }

        /*give sidebar 100% width;*/
        nav.sidebar li {
            width: 100%;
        }

        /* Move nav to full on mouse over*/
        nav.sidebar:hover{
            margin-left: 0px;
        }
        /*for hiden things when navbar hidden*/
        .forAnimate{
            opacity: 0;
        }
    }

    /* .....NavBar: Fully showing nav bar..... */

    @media (min-width: 1330px) {

        /*Allow main to be next to Nav*/
        .main{
            width: calc(100% - 200px); /*keeps 100% minus nav size*/
            margin-left: 200px;
        }

        /*Show all nav*/
        nav.sidebar{
            margin-left: 0px;
            float: left;
        }
        /*Show hidden items on nav*/
        nav.sidebar .forAnimate{
            opacity: 1;
        }
    }

    nav.sidebar .navbar-nav .open .dropdown-menu>li>a:hover, nav.sidebar .navbar-nav .open .dropdown-menu>li>a:focus {
        color: #CCC;
        background-color: transparent;
    }

    nav:hover .forAnimate{
        opacity: 1;
    }
    section{
        padding-left: 15px;
    }
</style>
</head>
<body>
<div class="row">
<div class="main-wrapper col-xs-12" id="bslide" >
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
                    <input type="text" name="searchPeople" class="search-query form-control" placeholder="Search People">
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
                    @if (Auth::user()->status == 3)
                         <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @endif

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

    <nav class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span>Brand</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="{{ Request::is('profile/basicInfo') ? ' active' : null }}"><a href="/profile/basicInfo"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span> Basic Information</a></li>

                <li class="{{ Request::is('profile/myEvents') ? ' active' : null }}"><a href="/profile/myEvents"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-map-marker"></span> Created Events</a></li>

                <li class="{{ Request::is('profile/myFriends') ? ' active' : null }}"><a href="/profile/myFriends"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span> Friends ( {{ $friends->totalFriends }} )</a></li>

                <li class="{{ Request::is('profile/myAttendedEvents') ? ' active' : null }}"><a href="/profile/myAttendedEvents"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-map-marker"></span> Attended Events</a></li>

                <li class="{{ Request::is('profile/myAttendingEvents') ? ' active' : null }}"><a href="/profile/myAttendingEvents"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-map-marker"></span> Attending Events</a></li>

                <li class="{{ Request::is('profile/myNotificationSettings') ? ' active' : null }}"><a href="/profile/myNotificationSettings"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-bell"></span> Notifications Settings</a></li>

                <li class="{{ Request::is('profile/myUpdateInfo') ? ' active' : null }}"><a href="/profile/myUpdateInfo"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span> Update Information</a></li>

                <li class="{{ Request::is('profile/myProfilePicture') ? ' active' : null }}"><a href="/profile/myProfilePicture"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-picture"></span> Profile Picture</a></li>

                <li class="{{ Request::is('profile/myPassword') ? ' active' : null }}"><a href="/profile/myPassword"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-lock"></span> Change Password</a>

                {{-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>

                <div class="col-xs-10">
<div class="row">
    <div class="col-xs-8">
        @include('_messages') 
    </div>
</div>
@yield('content')  


        <!-- The Image Modal -->
        <div id="imageModal" class="imageModal">
            <span class="imageClose">&times;</span>
            <img class="imageModal-content" id="img01">
            <div id="caption"></div>
        </div>
</div>
</div>
</div>


<!-- Footer section start from here.-->
<section id="footer-tag">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-3">
                <h3>About Us</h3>
                <p>A Toronto-based start-up aiming to revolutionize the way people plan, organize and attend events. We are aiming to be the face of event organization one step at a time.</p>

            </div>
            @if (!Auth::guest())
           <!-- Load categories -->
           @include('layouts.footerCategories')
            <!-- Load popular events -->
            @include('layouts.footerTrendingEvents')
            @endif
            
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
            <!-- <div class="col-xs-12">
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
<!-- <script src="/js/bootstrap-hover-dropdown.js" type="text/javascript"></script> -->
<!--MENU-->
<!-- <script src="/js/menu/cbpHorizontalMenu.js" type="text/javascript"></script> -->
<!--END MENU-->
<!-- Button Anchor Top-->
<!-- <script src="/js/jquery.ui.totop.js" type="text/javascript"></script> -->

 <script src="/js/custom.js" type="text/javascript"></script> 
<script src="/js/bootstrap.min.js"></script>

<script src="/js/typeahead.bundle.min.js"></script>
<script src="/js/bootstrap-tagsinput.js"></script>
@yield('interestsTags')


<script type="text/javascript" src="/js/jquery.datetimepicker.full.min.js"></script>

<script type="text/javascript" src="/js/prettify.js"></script>
<script type="text/javascript" src="/js/src/jquery.picture.cut.js"></script>
<script src="/js/star-rating.min.js" type="text/javascript"></script>
<script src="/js/jssor.slider-22.0.6.mini.js" type="text/javascript"></script>
<script src="/js/jquery.twbsPagination.min.js" type="text/javascript"></script>
<script src="/js/bootstrap-slider.js" type="text/javascript"></script>
<!-- <script src="/js/jquery.flow.min.js" type="text/javascript"></script> -->
<script src="/js/markerclusterer.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/authy-forms.js/2.2/form.authy.min.js"></script>




<script src="/js/coverflow-slideshow.js"></script>
@yield('markers')
@yield('registerEvent')

<script src="https://apis.google.com/js/platform.js" async defer></script>


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

        $('#eventDescription').keyup( function() {

            var value = $(this).val();
            var maxlength = $(this).attr('maxlength');

            var compare = maxlength - value.length;
            // check for first 2 chars
            if (compare >= 0) {
                $("#inputcounter").removeClass('error').html(compare + "characters left");
            } else if (compare < 0) {
                $("#inputcounter").addClass('error').html(compare + "characters left");
            }

        });

            // Get the modal
            var modal = document.getElementById('imageModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('viewImage');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            $('.viewImage').click(function(){
                modal.style.display = "block";
                modalImg.src = this.children[0].src;

                captionText.innerHTML = this.children[0].alt;
            });

// Get the <span> element that closes the modal
            var span = document.getElementsByClassName("imageClose")[0];

// When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

    });

    function goBack() {
              window.history.back();
          }

 
</script>
</body>
</html>
