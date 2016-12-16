@extends('admin.layouts.adminlte')
@section('title', $author->exists ? 'Editing '.$author->first_name. ' ' . $author->last_name : 'Create Author')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent
    <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">

    @endsection
    @section('style-app')
        @parent
        @endsection
        @section('scripthead')
        @parent
    @endsection
@section('content')

    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{$author->exists ? 'Edit Author' : 'New Author'}}</h3>
            @include('admin.components.boxtools', ['rte' => 'author', 'path' => 'admin/author'])
          </div>	<!-- /.box-header -->
          <div class="box-body">
            <div id="vue-authors">
              <author-form errors="{{ json_encode($errors) }}" framework="bootstrap" authorid="{{$currentUser->id}}" recordexists="{{$author->exists ? true: false}}" recordid="{{$author->exists ? $author->id : null }}">
                  <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
              </author-form>
            </div><!-- /#vue-event-form -->
          </div><!-- /.box-body -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.row -->

@endsection
@section('footer-vendor')
    @parent
    {{-- <script src="/js/admintools.js"></script> --}}
@endsection

@section('footer-plugin')
    @parent

    @endsection

    @section('footer-app')
    @parent
    <script type="text/javascript" src="/js/vue-author-form.js"></script>
    @endsection
@section('footer-script')
        @parent

        <script>
        </script>
    @endsection
