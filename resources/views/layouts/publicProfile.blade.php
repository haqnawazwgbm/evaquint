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
</head>
<body>
<div class="row">
<div class="main-wrapper col-lg-12" id="bslide" >
<section class="content-top-login">
    <div class="container">
        <div class="col-md-12">
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
@include('_messages')

    <div class="col-lg-2" >
                    <ul id="userSettings" class="nav nav-pills nav-stacked">
                    <li class="{{ Request::is('publicProfile/41') ? ' active' : null }}"><a href="/publicProfile/41"><i class="fa fa-user fa-fw"></i> Basic Information</a>
                    </li>
                    @if ($friends->friend === 1)
                    <li class="{{ Request::is('publicProfile/attendedEvents/41') ? ' active' : null }}"><a href="/publicProfile/attendedEvents/41"><i class="glyphicon glyphicon-map-marker"></i> Hosted Events</a>
                    </li>
                    @endif
                    <li class="{{ Request::is('publicProfile/attendedEvents/41') ? ' active' : null }}"><a href="/publicProfile/attendedEvents/41"><i class="glyphicon glyphicon-map-marker"></i> Attended Events</a>
                    </li>
                    <li class="{{ Request::is('publicProfile/attendingEvents/41') ? ' active' : null }}"><a href="/publicProfile/attendingEvents/41" ><i class="glyphicon glyphicon-map-marker"></i> Attending Events</a>
                        </li>
                </ul>
                </div>
                <div class="col-lg-10">
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
