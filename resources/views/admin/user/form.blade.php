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


        {!! Form::model($user,[
          'method' => $user->exists ? 'put' : 'post',
          'route' => $user->exists ? ['admin.user.update', $user->id] : ['admin.user.store']
          ]) !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('first_name') !!}
                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
              </div>
            </div><!-- /.col-md-6 -->
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('last_name') !!}
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
              </div>
            </div><!-- /.col-md-6 -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('email') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
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
                  {!! Form::text('phone', null, ['class' => 'form-control', 'data-inputmask' =>'"mask": "(999) 999-9999"', "data-mask"]) !!}
                </div>
                <!-- /.input group -->
              </div><!-- /.form group -->
            </div><!-- /.col-md-6 -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                {!! Form::label('role_list', 'Roles:') !!}
                @can('super', $user)
                {!! Form::select('role_list[]',$userRoles, $user->roles->lists('id')->toArray() , ['class' => 'form-control select2', 'multiple']) !!}
                @else
                @if($user->exists)

                {!! Form::text('role_list', $user->roles->lists('name') , ['class' => 'form-control select2','readonly' => 'readonly']) !!}
                @endif
                @endcan
              </div>
            </div><!-- /.col-md-12 -->
          </div><!-- /.row -->
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
        {{-- @if(count($magazine->mediafiles) > 0)
          <h4>{{$magazine->mediafiles()->first()}}</h4>
          @else --}}
          <div class="box-header with-border">
            <h3 class="box-title">User Image</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            {!! Form::model($avatar,[
              'method' => 'patch',
              'route' => ['admin.mediafile.update', $avatar->id],
              'files' => true
              ]) !!}


              <div class="media-left">

                <img class="media-object" src="/imagecache/avatar160/{{$avatar->filename}}" alt="{{$avatar->name}}">
              </div>
              <div class="form-group">
                {!! Form::file('photo', null, array('required','id' => 'photo', 'class'=>'form-control input-sm')) !!}
              </div>
              <p class="help-text">You may need to refresh page to see updated avatar	</p>
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

          {{-- @each('admin.magazine.subviews.coverimage',$mediafiles, 'mediafile', 'admin.magazine.subviews.addcoverimage') --}}
        </div> <!-- /.col-sm-6 -->
      </div><!--/.row -->
      @endsection

      @section('footer-vendor')
      @parent
      {{-- <!-- jQuery 2.2.0 -->
        <script src="/themes/adminlte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="/themes/adminlte/bootstrap/js/bootstrap.min.js"></script> --}}
        @endsection
        @section('footer-plugin')
        @parent
        {{-- <!-- Select2 -->
          <script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
          <!-- InputMask -->
          <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
          <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
          <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
          <!-- date-range-picker -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
          <script src="/themes/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
          <!-- bootstrap datepicker -->
          <script src="/themes/admin-lte/plugins/datepicker/bootstrap-datepicker.js"></script>
          <!-- bootstrap color picker -->
          <script src="/themes/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
          <!-- bootstrap time picker -->
          <script src="/themes/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
          <!-- SlimScroll 1.3.0 -->
          <script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
          <!-- iCheck 1.0.1 -->
          <script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
          <!-- FastClick -->
          <script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
          <!-- AdminLTE App -->
          {{-- <script src="/themes/admin-lte/js/app.min.js"></script> --}}
          <!-- AdminLTE for demo purposes -->
          {{-- <script src="/themes/admin-lte/js/demo.js"></script> --}}
          @endsection
          @section('footer-app')
          @parent
          @endsection

          @section('footer-script')
          @parent
          <!-- Page script -->
          <script>
          function ConfirmDelete()
          {
            var x = confirm("Are you sure you want to delete?");
            if (x)
            return true;
            else
            return false;
          }
          </script>

          @endsection
