@inject('yearList', 'Emutoday\Http\Utilities\YearList')
@inject('seasonList', 'Emutoday\Http\Utilities\SeasonList')
@extends('admin.layouts.adminlte')
@section('title', $email->exists ? 'Edit Student Email' : 'Create New Student Email')
@section('style-plugin')
  @parent
  <link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
  <link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

@endsection
@section('scripthead')
  @parent
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h1 class="box-title">{{$email->exists ? 'Edit Student Email' : 'New Student Email'}} <small>The Week at EMU: Students</small></h1>
        @include('admin.components.boxtools', ['rte' => 'studentemail', 'path' => 'admin/studentemail'])
      </div>	<!-- /.box-header -->
      <div class="box-body" id="vue-studentemails">
        <student-email-form
        framework="bootstrap"
        :cuser-roles="{{$currentUser->roles}}"
        recordexists="{{$email->exists ? true: false}}"
        recordid="{{$email->exists ? $email->id : null }}"
        stypes="{{ $stypes }}"
        ></student-email-form>
      </div><!-- /.box-body -->
      <div class="box-footer">

      </div><!-- /.box-footer -->
    </div><!-- /.box -->
  </div><!-- /.col-md-6 -->
</div><!-- /.row -->
@endsection
@section('footer-app')
    @parent
    <script type="text/javascript" src="/js/vue-studentemail-form.js"></script>
@endsection
@section('scriptsfooter')
    @parent
    <script>

    </script>
@endsection
