@extends('admin.layouts.adminlte')
@section('title', 'Edit OAuth Clients')
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
      <div class="col-md-9">
        <h1>OAuth Client Request</h1>
        <div id="vue-oauth-client">
          <oauth-client-form></oauth-client-form>
        </div>
        <div id="vue-oauth-personal-access-tokens">
          <personal-access-tokens></personal-access-tokens>
        </div>
      </div><!-- /.box -->
    </div><!-- /.row -->
  @endsection
  @section('footer-vendor')
    @parent
  @endsection

  @section('footer-plugin')
    @parent

  @endsection

  @section('footer-app')
    @parent
    <script type="text/javascript" src="/js/vue-oauth-clients.js"></script>
    <script type="text/javascript" src="/js/vue-oauth-personal-access-tokens.js"></script>
  @endsection
  @section('footer-script')
        @parent
  @endsection
