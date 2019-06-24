@extends('layouts.site')
@section('content')
<link rel='stylesheet' id='ms-main-css'  href='/coverflow-slider/masterslider.main.css?ver=3.1.1' type='text/css' media='all' />
<script type='text/javascript' src='/coverflow-slider/masterslider.min.js?ver=1.5.8'></script>
<script>window.$ = jQuery.noConflict();</script>

<style>
	.ms-slide {
		background-color: #000;
	}
	tbody > tr {
		 border-bottom: solid 1px;
	}
	td {
		color: #ffffff;
		padding: 5px;
	}
                                .master-slider{
	-moz-transform:translate3d(0,0,1px);
}
.ms-staff-carousel{
	max-width:880px;
	height: 700px;
	overflow: hidden;
	margin: 25px auto;
	position: relative;
}
.master-slider {
	position: relative;
    top: 230px;
}

.ms-staff-carousel .ms-view{
	overflow:visible;
	background-color: transparent;
}

.ms-staff-carousel .ms-nav-prev,
.ms-staff-carousel .ms-nav-next {
    background: url(arrows.png) white no-repeat -7px -57px;
    width: 35px;
    height: 40px;
    left: -35px;
    margin-top: -17px;
    box-shadow: 0px 1px 0px 0px rgb(190, 190, 190);
    position: absolute;
    top:50%;
    cursor: pointer;
}
.ms-staff-carousel .ms-nav-next {
	background-position: -6px -7px;
	right:-35px;
	left:auto;
}

.ms-slide-info.ms-dir-h {
    position: relative;
}

.ms-staff-carousel .ms-staff-info{
	font-family: 'Lato', sans-serif;
	text-align: center;
	margin:0 auto;
	max-width: 600px;
	margin-top:30px;
	min-height:300px;
	color:#222222;
}
	.ms-staff-carousel .ms-staff-info h3{
		font-weight: 300;
		font-size: 22pt;
		margin:0px;
	}
	
	.ms-staff-carousel .ms-staff-info h4{
		font-weight: 300;
		color:#787878;
		font-size: 15pt;
		margin:3px;
	}
	
	.ms-staff-carousel .ms-staff-info .email a{text-decoration: none; color:#3f95ab;}
	.ms-staff-carousel .ms-staff-info.email,.ms-staff-info p {
	    margin: 4px;
	     font-size: 11pt;
	}
	
	.ms-staff-carousel .ms-staff-info .ms-socials {
	    list-style: none;
	    display: inline-block;
	    padding: 0;
	    margin: 15px 0 0 0;
	    text-shadow: none;
	    zoom: 1;
        *display: inline;
	}
	
	.ms-staff-carousel .ms-staff-info .ms-socials li{
		  float: left;
	}
	.ms-staff-carousel .ms-staff-info .ms-socials li a {
	    text-indent: 9999px;
	    width: 35px;
	    height: 35px;
	    background: url(sicons.png);
	    margin: 0 2px;
	    display: block;
	}
	
	.ms-staff-carousel .ms-staff-info .ms-socials .ms-ico-tw a{background-position: 115px 0px;}
	.ms-staff-carousel .ms-staff-info .ms-socials .ms-ico-gp a{background-position: 75px 0px;}
	.ms-staff-carousel .ms-staff-info .ms-socials .ms-ico-yt a{background-position: 35px 0px;}

	.ms-staff-carousel.ms-round .ms-slide-bgcont {
		border-radius: 5000px;
		border: solid 8px rgb(230, 230, 230);
		margin: 0 -8px;
	}
	
	.ms-staff-carousel.ms-round .ms-nav-prev,
	.ms-staff-carousel.ms-round .ms-nav-next {
	    background-color:transparent;
	    box-shadow : none;
	    left:-45px;
	 }
	 
	.ms-staff-carousel.ms-round .ms-nav-next {
	    left:auto;
	    right:-45px;
	 }


</style>


<section class="widget-video  one_one">
            
    <div class="video-embed-container fit-embed-vid-yes"><!-- template -->
            <div onclick="goBack()" class="btn btn-success btn-sm col-xs-offset-2">
	        <span class="glyphicon glyphicon-circle-arrow-left"></span> Back
	    </div>
		<div class="ms-staff-carousel">
			<!-- masterslider -->
			<div class="master-slider" id="masterslider">
			@if(count($markers) > 0)
				@foreach ($markers as $marker)
				    <div class="ms-slide">
				           <table>
	                              <tbody>
	                                  <tr>
	                                      <td><img width="70" src="{{ $marker->eventPicture }}" /></td>
	                                      <td>{{ $marker->first_name.' '.$marker->last_name }}</td>
	                                  </tr>
	                                  <tr>
	                                      <td>Event: </td><td>{{ $marker->title }}</td>
	                                  </tr>
	                                  <tr>
	                                      <td>Location: </td><td>{{ $marker->location }}</td>
	                                  </tr>
	                                   <tr>
	                                      <td>Description: </td><td>{{ $marker->eventDescription }}</td>
	                                  </tr>
	                              </tbody>
	                          </table>   
	                          <div style="margin-top: 180px;" class="ms-info">
	                              <a href="{{ '/map/'.$marker->event_id}}"><button>Go to map</button></a>&nbsp;&nbsp;<a href="{{ '/joinEvent/'.$marker->event_id }}"><button>Join</button></a>
	                          </div> 
				    </div>
				@endforeach
				@else
					<h1 style="text-align: center;">No events of this category near you</h1>
			@endif
			 
			</div>
			<!-- end of masterslider -->
			<div class="ms-staff-info" id="staff-info"> </div>
		</div>
		<!-- end of template --></div>            
        </section><!-- end widget-video -->

        <script type="text/javascript">
$(document).ready(function(){		
		var slider = new MasterSlider();
		slider.setup('masterslider' , {
			loop:true,
			width:250,
			height:250,
			swipe: true,
			speed:20,
			view:'flow',
			mouse: true,
			keyboard: true,
			preload:0,
			space:0,
			wheel:true,
			dir: 'v'
		});
		slider.control('slideinfo',{insertTo:'#staff-info'});
		});
$('.ms-staff-carousel').on('mousewheel', function(event) {
    $('body').css('overflow-y', 'hidden');
});
$('.ms-staff-carousel').on('mouseleave', function(event) {
	$('body').css('overflow-y', 'visible');
})
</script> 
@endsection