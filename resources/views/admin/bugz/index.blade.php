@extends('admin.layouts.adminlte')
@section('title', 'Bugz')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
		<!-- DataTables -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">
	@endsection
	@section('style-app')
		@parent
	@endsection
@section('content')
	@include('admin.layouts.modal')
	<div class="box">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Bugz List</h3>
				@include('admin.layouts.components.boxtools', ['rte' => 'bugz', 'path' => 'admin/bugz'])
			</div>	<!-- /.box-header -->




	@if(isset($bugzs))

		<div class="box-body table-responsive no-padding">
			<table class="table table-hover">

				<tr>
					<th class="text-center">id</th>
					<th class="text-center">uid</th>
					<th class="text-left">type</th>
					<th class="text-center">lvl</th>
					<th class="text-left">notes</th>
					<th class="text-left">response</th>
					<th class="text-center">done</th>
					<th class="text-center">chkd</th>
					<th class="text-center">Edit</th>
					<th class="text-center">x</th>
				</tr>

					@foreach($bugzs as $item)
						<tr>
					<td class="text-center">{{ $item->id }}</td>
					<th class="text-center">{{ $item->user_id }}</td>
					<td class="text-left">{{ $item->type }}</td>
					<td class="text-center">{{ $item->priority }}</td>
					<td class="text-left">{{ $item->notes }}</td>
					<td class="text-left">{{ $item->note_reply }}</td>
					<td class="text-center"><i class='fa {{$item->complete == 1 ? 'fa-check-square-o' :'fa-square-o'}}'></i></td>
					<td class="text-center"><i class='fa {{$item->confirmed == 1 ? 'fa-check-square-o' :'fa-square-o'}}'></i></td>
					<td class="text-center">
						<a href="{{ route('admin.bugz.edit', $item->id) }}">
						<i class="fa fa-pencil"></i>
						</a>
					</td>
					<td class="text-center">
						<i class="fa fa-trash"></i>
											{{-- <a href="{{ route('admin.role.confirm', $permission->id) }}">
																<i class="fa fa-trash"></i>
											</a> --}}
					</td>
	</tr>
					@endforeach

				</table>
			</div>
			<!-- /.box-body -->

				@endif
			</div>
			<!-- /.box -->






@endsection
@section('footer-plugin')
	@parent
	<script src="/themes/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
@endsection



@section('footer-script')
	@parent




	@endsection
