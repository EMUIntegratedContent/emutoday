@extends('admin.layouts.adminlte')
@section('title', 'Expert Media Requests')
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
  <div id="vue-expert-request-list">
    <expert-mediarequest-list></expert-mediarequest-list>
  </div>
  {{--
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Expert Media Requests</h3>
          </div>	<!-- /.box-header -->
          <div class="box-body">
            <table class="table">
              <tr>
                <th>Submitted</th>
                <th>Requester</th>
                <th>Media outlet</th>
                <th>Requested Expert</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            @foreach ($expertRequestsPaginated as $request)
              <tr>
                <td>{{ Carbon\Carbon::parse($request->created_at)->format('F j, Y') }}</td>
                <td>{{ $request->name }}</td>
                <td>{{ $request->media_outlet }}</td>
                <td>{{ $request->expert->first_name }} {{ $request->expert->last_name }}</td>
                <td>{{ $request->deadline }}</td>
                <td>
                    @if($request->is_acknowledged)
                        <span class="label label-info">Viewed</span>
                    @else
                        <span class="label label-warning">New</span>
                    @endif
                </td>
                <td><a href="/admin/expertrequests/{{ $request->id }}/edit" class="button success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
              </tr>
            @endforeach
            </table>
            <h6 class="text-center">{!! $expertRequestsPaginated->links() !!}</h6>
          </div><!-- /.box-body -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.row -->
    --}}
@endsection
@section('footer-vendor')
  @parent
@endsection
@section('footer-plugin')
  @parent
@endsection
@section('footer-app')
  @parent
  <script type="text/javascript" src="/js/vue-expert-request-list.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
