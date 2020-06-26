@if(Session::has('flash_notification.message'))
	<div class="alert alert-{{ Session::get('flash_notification.level') }} alert-dismissible" data-closable>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			{{ Session::get('flash_notification.message') }}
    </div>
@endif
