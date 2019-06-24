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
    <link href="/css/own/owl.carousel.css" rel="stylesheet">
    <link href="/css/own/owl.theme.css" rel="stylesheet">
    <link href="/css/jquery.bxslider.css" rel="stylesheet">
    <link href="/css/jquery.jscrollpane.css" rel="stylesheet">
    <link href="/css/minislide/flexslider.css" rel="stylesheet">
    <link href="/css/component.css" rel="stylesheet">
    <link href="/css/prettyPhoto.css" rel="stylesheet">
    <link href="/css/style_dir.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="/css/input-tags.css" rel="stylesheet">
    <link href="/css/loading.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.min.css" />
	<link href="/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/css/slider.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/map.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/modal-style.css" rel="stylesheet">
    <link href="/css/bootstrap-notifications.css" rel="stylesheet">
    <link href="/css/chat.css" rel="stylesheet">
    <link href="/css/prettify.css" rel="stylesheet">


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

<section class="content-top-login" data-spy="affix">
    <div class="container">
        <div class="col-md-12">
            <div class="box-support">
                <p class="support-info"><!--<i class="fa fa-envelope-o"></i>--><i><a href="/home">Evaquint</a></i></p>
            </div>
            <div class="searchPeople col-md-6 col-lg-offset-1">

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

<div id="msg" style="height:50px;"></div>

@yield('content')


<!-- Footer section start from here.-->
<section id="footer-tag">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-3">
                <h3>About Us</h3>
                <p>A Toronto-based start-up aiming to revolutionize the way people plan, organize and attend events. We are aiming to be the face of event organization one step at a time.</p>

            </div>
           <!-- Load categories -->
           @include('layouts.footerCategories')
            <!-- Load popular events -->
            @include('layouts.footerPopularEvents')
            
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
            <div class="col-xs-12">
                <ul class="social">
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                    <li><a href=""><i class="fa fa-digg"></i></a></li>
                    <li><a href=""><i class="fa fa-rss"></i></a></li>
                    <li><a href=""><i class="fa fa-youtube"></i></a></li>
                    <li><a href=""><i class="fa fa-tumblr"></i></a></li>

                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!--MENU-->
<script src="/js/menu/cbpHorizontalMenu.js" type="text/javascript"></script>
<!--END MENU-->
<!-- Button Anchor Top-->
<script src="/js/jquery.ui.totop.js" type="text/javascript"></script>

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
<script src="/js/jquery.flow.min.js" type="text/javascript"></script>
<script src="/js/markerclusterer.js" type="text/javascript"></script>


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
    });

    function goBack() {
              window.history.back();
          } 
</script>
</body>
</html>
