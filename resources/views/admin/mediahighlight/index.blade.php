@extends('admin.layouts.adminlte')
@section('title', 'Media Highlights')
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
  @if (session('tag_deleted'))
      <div class="alert alert-success alert-dismissible">
        <button class="btn btn-sm close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></button>
        {{ session('tag_deleted') }}
      </div>
  @endif
  @if (session('highlight_deleted'))
      <div class="alert alert-success alert-dismissible">
        <button class="btn btn-sm close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></button>
        {{ session('highlight_deleted') }}
      </div>
  @endif
    <div class="row">
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Media Highlights List</h3>
            @include('admin.components.boxtools', ['rte' => 'mediahighlights', 'path' => 'admin/mediahighlights'])
          </div>	<!-- /.box-header -->
          <div class="box-body">
            <table class="table">
              <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Source</th>
                <th>Tags</th>
                <th>Actions</th>
              </tr>
            @foreach ($highlightsPaginated as $highlight)
              <tr>
                <td>{{ Carbon\Carbon::parse($highlight->start_date)->format('n/j/y') }}</td>
                <td>{{ $highlight->title }}</td>
                <td><a href="{{ $highlight->url }}" target="_blank">{{ $highlight->source }}</a></td>
                <td>
                  @foreach($highlight->tags as $tag)
                    <span class="badge">{{ $tag->name }}</span>
                  @endforeach
                </td>
                <td>
                  <a href="/admin/mediahighlights/{{ $highlight->id }}/edit" class="button success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="#"
                    data-toggle="modal"
                    data-id="{{ $highlight->id }}"
                    data-title="{{ $highlight->title }}"
                    data-type="highlight"
                    data-target="#deleteModal"
                  >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
            @endforeach
            </table>
            <h6 class="text-center">{!! $highlightsPaginated->links() !!}</h6>
          </div><!-- /.box-body -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      <div class="col-md-3">
        <div class="box box-secondary">
          <div class="box-header with-border">
            <h3 class="box-title">Most Used Tags</h3>
          </div>	<!-- /.box-header -->
          <div class="box-body">
            <table class="table">
              <tr>
                <th>Tag</th>
                <th>No. Highlights</th>
                <th>Actions</th>
              </tr>
              @foreach ($topTagsPaginated as $tag)
              <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->tag_count }}</td>
                <td>
                  <a href="#"
                    data-toggle="modal"
                    data-id="{{ $tag->id }}"
                    data-title="{{ $tag->name }}"
                    data-type="tag"
                    data-target="#deleteModal"
                  >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </table>
            <h6 class="text-center">{!! $topTagsPaginated->links() !!}</h6>
          </div><!-- /.box-body -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.row -->

<!--DELETE MODAL-->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete <span class="modal-type"></span></h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete the <span class="modal-type"></span> "<span id="modal-title"></span>"?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelBtn" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="deleteBtn" class="btn btn-danger" data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div><!--/end modal-->
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
    @endsection
@section('footer-script')
        @parent
        <script>
          // Handle deletion of an email via the modal
          $(document).ready(function(){
            let entityId = null;
            $('#deleteModal').on("show.bs.modal", function (e) {
                 $("#modal-title").html($(e.relatedTarget).data('title'))
                 $(".modal-type").html($(e.relatedTarget).data('type'))
                 // dynamically change id of delete button
                 $('#deleteBtn').attr('id', 'deleteBtn-' + $(e.relatedTarget).data('type'))
                 entityId = $(e.relatedTarget).data('id')
            });

            $(document).on('click', '#deleteBtn-tag', function(){
              window.location.href = '/admin/mediahighlightstags/' + entityId + '/destroy'
            });
            $(document).on('click', '#deleteBtn-highlight', function(){
              window.location.href = '/admin/mediahighlights/' + entityId + '/destroy'
            });
          })
        </script>
    @endsection
