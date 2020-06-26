<div class="modal modal-{{ Session::get('flash_notification.level') }}" id="flash-overlay-modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span></button>
							{{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button> --}}
							<h4 class="modal-title">{{ $title }}</h4>
						</div> <!-- /.modal-header -->
						<div class="modal-body">
						  <p>{!! $body !!}</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
							{{-- <button type="button" class="btn btn-outline">Save changes</button> --}}
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->


{{-- <div class="modal" id="flash-overlay-modal">
    <div class="modal-dialog {{ Session::get('flash_notification.level') }}" >
			<div class="modal-content">
  <h4 class="modal-title">{{ $title }}</h4>
            <div class="modal-body">
                <p>{!! $body !!}</p>
            </div>
        {{ Session::get('flash_notification.message') }}
    </div>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div> --}}
