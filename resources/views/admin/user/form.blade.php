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
          {!!  html()->form($user->exists ? 'put' : 'post', $user->exists ? route('admin_user_update', $user->id) : route('admin_user_store'))->open() !!}

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {!! html()->label('First Name')->for('first_name') !!}
                {!! html()->text('first_name', $user->first_name)->class('form-control')->attributes($user->hidden ? ['readonly' => 'readonly'] : []) !!}
              </div>
            </div><!-- /.col-md-6 -->
            <div class="col-md-6">
              <div class="form-group">
                {!! html()->label('Last Name')->for('last_name') !!}
                {!! html()->text('last_name', $user->last_name)->class('form-control')->attributes($user->hidden ? ['readonly' => 'readonly'] : []) !!}
              </div>
            </div><!-- /.col-md-6 -->
          </div><!-- /.row -->

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {!! html()->label('Email')->for('email') !!}
                {!! html()->email('email', $user->email)->class('form-control')->attributes($user->hidden ? ['readonly' => 'readonly'] : []) !!}
              </div>
            </div><!-- /.col-md-6 -->
            <div class="col-md-6">
              <div class="form-group">
                {!! html()->label('Phone')->for('phone') !!}
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  {!! html()->text('phone', $user->phone)->class('form-control')->attribute('data-inputmask', '"mask": "(999) 999-9999"')->attribute('data-mask')->attributes($user->hidden ? ['readonly' => 'readonly'] : []) !!}
                </div>
              </div>
            </div><!-- /.col-md-6 -->
          </div><!-- /.row -->

          @if(!$user->hidden)
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  {!! html()->label('Roles:')->for('role_list') !!}
                  @can('super', $user)
                    {!! html()->select('role_list[]', $userRoles, $user->roles->pluck('id')->toArray())->class('form-control select2')->multiple() !!}
                  @else
                    @if($user->exists)
                      {!! html()->text('role_list', $user->roles->pluck('name'))->class('form-control select2')->attributes($user->hidden ? ['readonly' => 'readonly'] : []) !!}
                    @endif
                  @endcan
                </div>
              </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
          @endif

          @can('super', $user)
            @if($user->exists)
              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-warning">
                    <div class="panel-body">
                      @if(!$user->hidden)
                        {!! html()->label('Archive this user on save and remove all roles?')->for('archive_user') !!}
                        {!! html()->checkbox('archive_user') !!}
                        <br>
                        <p>
                          Archiving a user removes them from all dropdowns where names can be selected throughout the
                          system.
                          It also removes all of their system roles and denies them backend access.
                          Their attributions will still be recorded on things like stories and announcements.
                          They will still show in the user table with an "Archived" tag next to their name.
                          You can unarchive a user at any time.
                        </p>
                      @else
                        {!! html()->label('Unarchive this user on save?')->for('unarchive_user') !!}
                        {!! html()->checkbox('unarchive_user') !!}
                        <p>
                          Unarchiving a user adds them back all to dropdowns where names can be selected throughout the
                          system.
                          It does not restore any roles they might have had previously, so you will need to assign them
                          roles after unarchiving.
                          You can re-archive a user at any time.
                        </p>
                      @endif
                    </div>
                  </div>
                </div><!-- /.col-md-12 -->
              </div><!-- /.row -->
            @endif
          @endcan

        </div><!-- /.box-body -->
        <div class="box-footer">
          {!! html()->submit($user->exists ? 'Save User' : 'Create New User')->class('btn btn-primary pull-right') !!}
          {!! html()->form()->close() !!}
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
            {!!  html()->form('patch', route('admin_mediafile_update', $avatar->id))->acceptsFiles()->open() !!}
            <div class="media-left">
              <img class="media-object" src="/imagecache/avatar160/{{$avatar->filename}}" alt="{{$avatar->name}}">
            </div>
            @if(!$user->hidden)
              <div class="form-group">
                {!! html()->file('photo')->required()->id('photo')->class('form-control input-sm') !!}
              </div>
              <p class="help-text">You may need to refresh page to see updated avatar </p>
              <div class="form-group">
                {!! html()->submit('Update Image')->class('btn btn-primary') !!}
              </div>
            @endif
            {{ csrf_field() }}
            {!! html()->form()->close() !!}
          </div> <!-- /.box-body -->
          @if(!$user->hidden)
            <div class="box-footer">
              <div class="form-group">
                {!! html()->form('delete', route('remove_mediafile_user', $avatar->id))->class('form')->acceptsFiles()->open() !!}
                {!! html()->submit('Delete Image')->class('btn btn-warning')->attributes(['onclick' => 'return ConfirmDelete();']) !!}
                {!! html()->form()->close() !!}
              </div>
            </div><!-- /.box-footer -->
          @endif
        </div> <!-- /.box -->
      @else

        @if($user->exists)
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add User Image</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              {!!  html()->form('post', route('store_mediafile_user', $user->id))->acceptsFiles()->open() !!}
              <div class="form-group">
                {!! html()->file('photo')->required()->id('photo')->class('form-control input-sm') !!}
              </div>
              <div class="form-group">
                {!! html()->label('Caption')->for('caption') !!}
                {!! html()->text('caption')->class('form-control') !!}
              </div>
              <div class="form-group">
                {!! html()->label('Note')->for('note') !!}
                {!! html()->text('note')->class('form-control') !!}
              </div>
              <div class="form-group">
                {!! html()->submit('Add User Image')->class('btn btn-primary') !!}
              </div>
              {{ csrf_field() }}
              {!! html()->form()->close() !!}
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
