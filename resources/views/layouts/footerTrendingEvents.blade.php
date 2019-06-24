
	<div class="col-md-4">
                <h3>Trending Events</h3>
                <ul class="footer-last-news">
                @foreach ($popularEvents as $popularEvent)
                    <li><a href="{{ '/joinEvent/'.$popularEvent->poiID }}" ><img src="{{ $popularEvent->eventPicture }}" alt=""></a>
                      <h4>{{ $popularEvent->title }}</h4>  <p>{{ $popularEvent->eventDescription }}</p></li>
                @endforeach
                   <!--  <li><img src="http://placehold.it/320x213" alt="">
                        <p>Fusce risus metus, placerat in consectetur eu...</p></li>
                    <li><img src="http://placehold.it/320x213" alt="">
                        <p>Fusce risus metus, placerat in consectetur eu...</p></li> -->
                </ul>
            </div>