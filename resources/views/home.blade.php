@extends('layouts.site')
@section('content')
    <div class="home-wrapper">
    <div style="height: 30px; padding: 10px;">
        <button class="btn btn-primary btn-larg createEvent pull-right"><span class="glyphicon glyphicon-plus"></span>Create Event</button>
    </div>
    <div class="row homeHeading">
        <h1>Welcome</h1> 
        <h3>What are you feeling today?</h3>
    </div>
    <div class="row threeChoice" style="width: 100%;">
        <div class="col-lg-8 col-lg-offset-2 col-xs-offset-1">
            <div class="col-lg-4 col-sm-4 col-xs-12 threeBox" id="left"><a title="The Usual" href="/eventsTheUsual"><img class="thumbnail img-responsive" src="/img/three-boxes/theUsual.png"></a></div>
            <div class="col-lg-4 col-sm-4 col-xs-12 threeBox" id="middle"><a title="Some Thing New" href="/eventsCategories"><img class="thumbnail img-responsive" src="/img/three-boxes/somethingNew.png"></a></div>
            <div class="col-lg-4 col-sm-4 col-xs-12 threeBox" id="right"><a title="What Others Are Doing" href="/eventsOthersAreDoing"><img class="thumbnail img-responsive" src="/img/three-boxes/others.png"></a></div>
        </div>

</div>
@include('subView.homeEventForm')
<script>
    $(document).ready(function() {

        var today = new Date()
        var curHr = today.getHours()
        var name = '{{ Auth::user()->first_name.' '.Auth::user()->last_name }}';

        if (curHr < 12) {
            $('.homeHeading').find('h1').html('Good Morning, '+name);
        } else if (curHr < 18) {
            $('.homeHeading').find('h1').html('Good Afternoon, '+name);
        } else {
            $('.homeHeading').find('h1').html('Good Evening, '+name);
        }

        /*//Array of images which you want to show: Use path you want.
        var images=new Array('/img/bg/01.jpg','/img/bg/02.jpg','/img/bg/03.jpg');
        var nextimage=0;
        doSlideshow();

        function doSlideshow(){
            if(nextimage>=images.length){nextimage=0;}
            $('.main-wrapper')
                    .css('background-image','url("'+images[nextimage++]+'")')
                    .fadeIn(500,function(){
                        setTimeout(doSlideshow,2000);
                    });
        }*/
                painter();    
                 function painter() {
                //Background Image Slideshow- © Dynamic Drive ([url]www.dynamicdrive.com[/url])
                //For full source code, 100's more DHTML scripts, and TOS,
                //visit [url]http://www.dynamicdrive.com[/url]
                
                //Specify background images to slide
                var bgslides = [],
                        processed = [],
                        inc = 0,
                        speed = 3000,
                        dom = document.getElementById ? document.getElementById('bslide') : document.all['bslide'];
                
                bgslides[0] = '/img/bg/01.jpg';
                bgslides[1] = '/img/bg/02.jpg';
                bgslides[2] = '/img/bg/03.jpg';
                
                //preload images
                
                for (inc = 0; inc < bgslides.length; inc += 1) {
                        processed[inc] = new Image();
                        processed[inc].src = bgslides[inc];
                }
                inc = 0;
                
                function slideback() {
                        // This next statement can be removed for production
                        window.status = 'inc = ' + inc + ', slide = "url(\'' + bgslides[inc] + '\')"';
                        
                        dom.style.backgroundImage = 'url(' + bgslides[inc] + ')';
                        
                        inc = ++inc % processed.length;
                }
                slideback(); // Show initial image
                
                window.setInterval(slideback, speed); // Trigger periodic image changes
        }
        $('.createEvent').on('click', function() {
            $('.modal-backdrop').css('z-index', 0);
        })
 
    })
</script>
@endsection