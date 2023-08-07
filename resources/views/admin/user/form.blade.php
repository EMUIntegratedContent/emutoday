@extends('admin.layouts.adminlte')
@section('title', $user->exists ? 'Editing '.$user->name : 'Create New User')
@section('style-vendor')
@parent
@endsection

@section('style-plugin')
@parent

@endsection

@section('style-app')
@parent
@endsection
@section('scripthead')
@parent
@endsection

@section('content')

<div class="row">
	<div class="col-sm-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">{{$user->exists ? 'Editing User: '. $user->first_name. ' ' .$user->last_name: 'Create New User'}}</h3>
			</div>
			<div class="box-body">
				@if($user->hidden)
					<div class="alert alert-warning" role="alert">
						This user is archived. Information cannot be changed for this user while archived.
					</div>
				@endif
				{!! Form::model($user,[
            'method' => $user->exists ? 'put' : 'post',
            'route' => $user->exists ? ['admin_user_update', $user->id] : ['admin_user_store']
            ]) !!}
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('first_name') !!}
							{!! Form::text('first_name', null, ['class' => 'form-control', 'disabled' => $user->hidden]) !!}
						</div>
					</div><!-- /.col-md-6 -->
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('last_name') !!}
							{!! Form::text('last_name', null, ['class' => 'form-control', 'disabled' => $user->hidden]) !!}
						</div>
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('email') !!}
							{!! Form::text('email', null, ['class' => 'form-control', 'disabled' => $user->hidden ]) !!}
						</div>
					</div><!-- /.col-md-6 -->
					<div class="col-md-6">
						<!-- phone mask -->
						<div class="form-group">
							{!! Form::label('phone') !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('phone', null, ['class' => 'form-control', 'data-inputmask' =>'"mask": "(999) 999-9999"', "data-mask", 'disabled' => $user->hidden ]) !!}
							</div>
							<!-- /.input group -->
						</div><!-- /.form group -->
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
				@if(!$user->hidden)
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							{!! Form::label('role_list', 'Roles:') !!}
							@can('super', $user)
							{!! Form::select('role_list[]',$userRoles, $user->roles->pluck('id')->toArray() , ['class' => 'form-control select2', 'multiple']) !!}
							@else
							@if($user->exists)

							{!! Form::text('role_list', $user->roles->pluck('name') , ['class' => 'form-control select2','readonly' => 'readonly']) !!}
							@endif
							@endcan
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				@endif
				@can('super', $user)
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-warning">
							<div class="panel-body">
								@if(!$user->hidden)
									{!! Form::label('archive_user', 'Archive this user on save and remove all roles?') !!}
									{!! Form::checkbox('archive_user') !!}
									<br>
									<p>
										Archiving a user removes them from all dropdowns where names can be selected throughout the system.
										It also removes all of their system roles and denies them backend access.
										Their attributions will still be recorded on things like stories and announcements.
										They will still show in the user table with an "Archived" tag next to their name.
										You can unarchive a user at any time.
									</p>
								@else
									{!! Form::label('unarchive_user', 'Unarchive this user on save?') !!}
									{!! Form::checkbox('unarchive_user') !!}
									<p>
										Unarchiving a user adds them back all to dropdowns where names can be selected throughout the system.
										It does not restore any roles they might have had previously, so you will need to assign them roles after unarchiving.
										You can re-archive a user at any time.
									</p>
								@endif
							</div>
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				@endcan
			</div><!-- /.box-body -->
			<div class="box-footer">
				{!! Form::submit($user->exists ? 'Save User' : 'Create New User', ['class' => 'btn btn-primary pull-right']) !!}
				{!! Form::close() !!}
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div><!--	/.col-sm-12 -->
	<div class="col-sm-6">
		@if(isset($avatar))
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">User Image</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				{!! Form::model($avatar,[
              'method' => 'patch',
              'route' => ['admin_mediafile_update', $avatar->id],
              'files' => true
              ]) !!}


				<div class="media-left">

					<img class="media-object" src="/imagecache/avatar160/{{$avatar->filename}}" alt="{{$avatar->name}}">
				</div>
				<div class="form-group">
					{!! Form::file('photo', null, array('required','id' => 'photo', 'class'=>'form-control input-sm')) !!}
				</div>
				<p class="help-text">You may need to refresh page to see updated avatar </p>
				<div class="form-group">
					{!! Form::submit('Update Image', array('class'=>'btn btn-primary')) !!}
				</div>
				{{ csrf_field() }}
				{!! Form::close() !!}
			</div> <!-- /.box-body -->
			<div class="box-footer">
				<div class="form-group">
					{!! Form::model($avatar, ['route' => ['remove_mediafile_user', $avatar->id],
              'method' => 'DELETE',
              'class' => 'form',
              'files' => true]
              ) !!}
					{!! Form::submit('Delete Image', array('class'=>'btn btn-warning', 'Onclick' => 'return ConfirmDelete();')) !!}
					{!! Form::close() !!}
				</div>
			</div><!-- /.box-footer -->
		</div> <!-- /.box -->
		@else

		@if($user->exists)
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Add User Image</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				{!! Form::open(array('method' => 'post',
              'route' => ['store_mediafile_user', $user->id],
              'files' => true)) !!}
				<div class="form-group">
					{!! Form::file('photo', null, array('required','id' => 'photo', 'class'=>'form-control input-sm')) !!}
				</div>
				<div class="form-group">
					{!! Form::label('caption') !!}
					{!! Form::text('caption', null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('note') !!}
					{!! Form::text('note', null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Add User Image', array('class'=>'btn btn-primary')) !!}
				</div>
				{{ csrf_field() }}
				{!! Form::close() !!}

			</div> <!-- /.box-body -->

		</div> <!-- /.box -->
		@endif

		@endif
	</div> <!-- /.col-sm-6 -->
</div><!--/.row -->
@endsection

@section('footer-vendor')
  @parent
@endsection
@section('footer-plugin')
  @parent
@endsection
@section('footer-app')
  @parent
@endsection

@section('footer-script')
  @parent
  <!-- Page script -->
<script>
	function ConfirmDelete () {
		var x = confirm("Are you sure you want to delete?");
		if (x) {
			return true;
		}
		else {
			return false;
		}
	}
</script>

		@endsection
