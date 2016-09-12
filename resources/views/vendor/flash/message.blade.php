@if (session()->has('flash_notification.message'))
    @if (session()->has('flash_notification.overlay'))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => session('flash_notification.title'),
            'body'       => session('flash_notification.message')
        ])

    @else
			<div class="box box-{{ session('flash_notification.level') }}  box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{!! session('flash_notification.message') !!}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            {{-- <div class="box-body">
              	{!! session('flash_notification.message') !!}
            </div> --}}
            <!-- /.box-body -->
          </div>
        {{-- <div class="callout callout-{{ session('flash_notification.level') }} callout-dismissible" data-closable>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
					{!! session('flash_notification.message') !!}
        </div> --}}
    @endif
@endif
