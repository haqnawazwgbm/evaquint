
<div class="col-md-3 cat-footer">
    <div class="footer-map"></div>
        <h3 class="last-cat">Categories</h3>
            <ul class="last-tips">
            @foreach ($categories as $category)
                <li><a href="{{ '/eventsByCategory/'.$category->event_category_id }}">{{ $category->category }}</a></li>
            @endforeach
            </ul>
</div>