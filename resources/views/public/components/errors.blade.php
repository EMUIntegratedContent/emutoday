@if($errors->any())
    <div class="callout alert">
    <h5><i class="icon fa fa-ban"></i> We found some errors!</h5>
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
