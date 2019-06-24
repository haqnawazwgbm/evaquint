@if (count($errors) > 0)
  <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      @foreach($errors->all() as $error)
         <li> {{ $error }} </li>
      @endforeach
  </div>
@endif

@if (session('status') !== null)
  <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{ session('status') }}
  </div>
@endif
@if (session('info') !== null)
  <div class="alert alert-info alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{ session('info') }}
  </div>
@endif
<div class="alert alert-success block-report-alert alert-dismissible" style="display: none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong>
    </div>