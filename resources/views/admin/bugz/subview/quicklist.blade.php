
<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Bugz List</h3>
		</div>	<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		<table class="table table-hover">
			<tr>
				<th class="text-center">id</th>
				<th class="text-center">type</th>
				<th class="text-left">notes</th>
				<th class="text-center">prty</th>
				<th class="text-center">comp</th>
				<th class="text-center">Edit</th>
				<th class="text-center">Delete</th>
			</tr>
			@foreach($bugzs as $item)
						<tr>
							<td class="text-center">
									{{ $item->id }}
							</td>
							<td class="text-center">{{ $item->type }}</td>
							<td>{{ $item->notes }}</td>
								<td class="text-center">{{ $item->priority }}</td>

								<td class="text-center"><i class='fa {{$item->complete == 1 ? 'fa-check-square-o' :'fa-square-o'}}'></i></td>

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
	</div><!-- /.box-body -->
</div><!-- /.box -->
