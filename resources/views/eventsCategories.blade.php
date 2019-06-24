@extends('layouts.site')
@section('content')
<style>
	div > a {
		text-decoration: none !important;
	}
</style>

   <div class="container" style="margin-top: 10px;">
	   <div class="col-xs-12">
	    <div onclick="goBack()" class="btn btn-success btn-sm pull-left" style="margin: 20px 0px;">
	        <span class="glyphicon glyphicon-circle-arrow-left"></span> Back
	    </div>
        <div class="btn btn-primary btn-lg col-lg-offset-5 selectAll">Select All</div>
	   </div>
     <form action="/eventsByCategories" method="post">
     {{ csrf_field() }}
   @foreach($categories as $category)
        <div class="col-xs-6 col-lg-4 categoryBox">
            <a href="#" class="thumbnail">
            <a href="#" class="thumbnail" title="{{ $category->category }}">
            <!-- <img src="/img/categories/{{ $category->event_category_id }}_icon.png" width="300" />-->
             <input type="checkbox" id="{{ $category->event_category_id }}" class="selectCategory" value="{{ $category->event_category_id }}" name="category[]" /> 
            <h4 style="text-align: left;">{{ $category->category }}</h4>
                
            </a>
        </div>
    @endforeach
    <div id="login-submit"> 
           <input type="submit" id="sign-up" class="btn btn-success" value="Next">
     </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        var selectAllCategory = true;
        $(".categoryBox").click(function(e){ 
            if(e.target.name == 'category[]') {
                return true;
            }
            
            var actualBox = $(this).attr('type');
            var checkBox = $(this).find('.selectCategory');
            var check = checkBox.is(':checked');
        if(check)
            checkBox.prop('checked',false);
        else
           checkBox.prop('checked',true);


       return true;

        });

        //Select all categories by one click.
        $('.selectAll').on('click', function(){
            if (selectAllCategory) {
                $('.categoryBox').find('input').each(function(index) {
                $(this).prop('checked', true);
                });
                $(this).html('Unselect All');
                selectAllCategory = false;
            } else {
                $('.categoryBox').find('input').each(function(index) {
                $(this).prop('checked', false);
                });
                $(this).html('Select All');
                selectAllCategory = true;
            }
            
        });
});
</script>

@endsection