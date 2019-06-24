

<!-- Markdown parser -->
<script src="/coverflow-slider/Markdown.Converter.min.js"></script>

<!-- Prettyprint -->
<link href="/coverflow-slider/prettify.min.css" rel="stylesheet" type="text/css"/>
<script src="/coverflow-slider/prettify.min.js"></script>

<!-- Index -->
<style>
    .preview {
        transform: rotate(90deg);
    }
    .preview-coverflow .cover {
        background-color: black;
        cursor:		pointer;
         width: 250px;
        height: 250px;
        box-shadow:	0 0 4em 1em black;
    }
</style>
<style>


    #menu {
        margin-bottom:			2em;
    }

    .preview {
        padding:				2em;
        text-align:				center;
    }

    .chapter {
        -webkit-columns:		460px;
        -moz-columns:		460px;
        columns:		460px;

        -webkit-column-gap:		4em;
        -moz-column-gap:		4em;
        column-gap:		4em;

        -webkit-column-rule:	thin solid silver;
        -moz-column-rule:	thin solid silver;
        column-rule:	thin solid silver;

        text-align:				justify;
    }



    hr {
        border-top:			double;
        margin:				2em 25%;
    }


    .output {
        font-family:		monospace;
        border:				solid thin silver;
        padding:			.2em .4em;
        background-color:	#cf3;
    }

    .clickable {
        cursor:				pointer;
    }

    pre {
        tab-size:			4;
        overflow-x:			auto;
        background-color:	#eee;
        -webkit-column-break-inside: avoid;
    }
       .preview-coverflow{
     height: 259px;
     margin-top: 35px;
      width: 40.33333333%;
   }
   .preview-coverflow > .cover >.innercover {
    display: block;
    transform: rotate(-90deg) !important;
    position: relative;
    height: 245px;
   }
   .preview-coverflow > .cover > .innercover > table tbody tr td {
        color: white;
   }
   .preview-coverflow > .cover > .innercover > table tbody tr {
    border-bottom: solid 1px;
   }
   .middleBox {
        position: relative;
        left: -316px;

   }
   .leftBox {
        position: relative;
        left: -605px;
        
   }
   .mainPreview {
        height: 100px;
   }


</style>

<!-- Plugin -->
<script src="/coverflow-slider/jquery.coverflow.js"></script>
<!-- Optionals -->
<script src="/coverflow-slider/jquery.interpolate.min.js"></script>
<script src="/coverflow-slider/jquery.touchSwipe.min.js"></script>
<!-- <script src="/coverflow-slider/reflection.js"></script>
 -->
  <div class="mainPreview">
    <div class="preview">
        <div class="leftBox preview-coverflow" style="visibility: hidden;">
            @foreach ($markers as $marker)
                  <!-- <img id="{{ $marker->id }}" class="cover" title="{{ $marker->title }}" src="{{ $marker->eventPicture }}"/> -->
                  
                  <div class="cover">
                      <div class="innercover">
                          <table>
                              <tbody>
                                  <tr>
                                      <td><img width="70" src="{{ $marker->user_picture }}" /></td>
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
                          <div style="margin-top: 20px;">
                              <a href="{{ '/map/'.$marker->event_id}}"><button>Go to map</button></a>&nbsp;&nbsp;<a href="{{ '/joinEvent/'.$marker->event_id }}"><button>Join</button></a>
                          </div>
                          
                      </div>
                  </div>
            @endforeach
        </div>
         <div  class="middleBox preview-coverflow" style="visibility: hidden;">
            @foreach ($markers as $marker)
                  <!-- <img id="{{ $marker->id }}" class="cover" title="{{ $marker->title }}" src="{{ $marker->eventPicture }}"/> -->
                  
                  <div class="cover">
                      <div class="innercover">
                          <table>
                              <tbody>
                                  <tr>
                                      <td><img width="70" src="{{ $marker->user_picture }}" /></td>
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
                          <div style="margin-top: 20px;">
                              <a href="{{ '/map/'.$marker->event_id}}"><button>Go to map</button></a>&nbsp;&nbsp;<a href="{{ '/joinEvent/'.$marker->event_id }}"><button>Join</button></a>
                          </div>
                          
                      </div>
                  </div>
            @endforeach
        </div>
            <div class="rightBox preview-coverflow"  style="visibility: hidden;">
            @foreach ($markers as $marker)
                  <!-- <img id="{{ $marker->id }}" class="cover" title="{{ $marker->title }}" src="{{ $marker->eventPicture }}"/> -->
                  
                  <div class="cover">
                      <div class="innercover">
                          <table>
                              <tbody>
                                  <tr>
                                      <td><img width="70" src="{{ $marker->user_picture }}" /></td>
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
                          <div style="margin-top: 20px;">
                              <a href="{{ '/map/'.$marker->event_id}}"><button>Go to map</button></a>&nbsp;&nbsp;<a href="{{ '/joinEvent/'.$marker->event_id }}"><button>Join</button></a>
                          </div>
                          
                      </div>
                  </div>
            @endforeach
        </div>
    </div>
</div>




        <script>
            $(function() {
               /* if ($.fn.reflect) {
                    $('#preview-coverflow .cover').reflect();	// only possible in very specific situations
                }*/
                
                     $('.preview-coverflow').coverflow({
                            index:          6,
                            density:        2,
                            innerOffset:    50,
                            innerScale:     .7,

                            animateStep:    function(event, cover, offset, isVisible, isMiddle, sin, cos) {
                                if (isVisible) {
                                    if (isMiddle) {
                                        $(cover).css({
                                            'filter':           'none',
                                            '-webkit-filter':   'none'
                                        });
                                    } else {
                                        var brightness  = 1 + Math.abs(sin),
                                                contrast    = 1 - Math.abs(sin),
                                                filter      = 'contrast('+contrast+') brightness('+brightness+')';
                                        $(cover).css({
                                            'filter':           filter,
                                            '-webkit-filter':   filter
                                        });
                                    }
                                }
                            }
                        });
               

                $('.cover').on('click', function() {
                    var currentClass = $(this).attr('class').split(' ');
                    var id = $(this).find('img').attr('id');
                        if(currentClass[1] === 'current')
                            window.location.href = '/map/' + id;
                })

                $('.threeBox').on('click', function() {
                       var type = $(this).attr('id');
                       $('.mainPreview').css('height', '600px');
                       $('.preview-coverflow').css('visibility', 'hidden');
                        if (type == 'left') {
                            $('.rightBox').css('visibility', 'visible');

                        } else {
                            if (type == 'right') {
                                $('.leftBox').css('visibility', 'visible');
                            }
                            else {
                                $('.middleBox').css('visibility', 'visible');
                            }
                        } 

                    return false;
                })
            });
        </script>


 

