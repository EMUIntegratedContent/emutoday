@extends('admin.layouts.adminlte')
@section('title', $expertCategory->exists ? 'Editing '.$expertCategory->category : 'Create Category')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent

@endsection

@section('content')
    <div class="row">
      <div class="col-md-7">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{$expertCategory->exists ? 'Edit Expert Category' : 'New Expert Category'}}</h3>
            @include('admin.components.boxtools', ['rte' => 'expertcategory', 'path' => 'admin/expertcategory'])
          </div>	<!-- /.box-header -->
          <div class="box-body">
            <div id="vue-expertcategory">
              <expertcategory-form errors="{{ json_encode($errors) }}" framework="bootstrap" recordexists="{{$expertCategory->exists ? true: false}}" recordid="{{$expertCategory->exists ? $expertCategory->id : null }}">
                  <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
              </expertcategory-form>
            </div><!-- /#vue-event-form -->
          </div><!-- /.box-body -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      <div class="col-md-5">
          {{--@include('admin.experts.subviews.expertimage',['expert_id' => $expert->id ])--}}
      </div><!-- /.md5 -->
    </div><!-- /.row -->

@endsection
@section('footer-vendor')
    @parent

@endsection

@section('footer-app')
    @parent
    <script type="text/javascript" src="/js/vue-expertcategory-form.js"></script>
@endsection


@section('footer-plugin')
        @parent

@endsection
@section('scriptsfooter')
    @parent

@endsection
@section('footer-script')
    @parent

@endsection
