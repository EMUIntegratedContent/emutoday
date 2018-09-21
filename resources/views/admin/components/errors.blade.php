@if($errors->any())
<div class="alert alert-danger">
	  <h4><i class="icon fa fa-ban"></i> We found some errors!</h4>
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
{{-- @if($errors->any())
<div class="callout alert">
<strong>We found some errors!</strong>
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif --}}
