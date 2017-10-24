@extends('admin.layouts.adminlte')
@section('title','EventQueue')
@section('style-vendor')
  @parent
@endsection
@section('style-plugin')
  @parent
<link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">
<style>
.fa-check-circle{
  color: #3D9970;
}
.fa-times-circle{
  color:hsl(0, 90%, 70%);
}
</style>
@endsection
@section('style-app')
  @parent
@endsection
@section('scripthead')
  @parent
@endsection
@section('content')
<h1 class="page-header">EMU Today Email Builder</h1>
@if (session('email_deleted'))
    <div class="alert alert-success alert-dismissible">
      <button class="btn btn-sm close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></button>
      {{ session('email_deleted') }}
    </div>
@endif
<!--DELETE MODAL-->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete email</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete "<span id="modal-title"></span>"? Type the word <strong>"delete"</strong> to confirm.</p>
        <div class="form-group">
          <label for="deleteConfirm" class="sr-only" aria-hidden="true">Type "confirm" to delete</label>
          <input type="text" class="form-control" id="deleteConfirm"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelBtn" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="deleteBtn" class="btn btn-danger" data-dismiss="modal" disabled="">Delete Email</button>
      </div>
    </div>
  </div>
</div><!--/end modal-->
<!--STATS MODAL-->
<div id="statsModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Email statistics</h4>
      </div>
      <div class="modal-body">
        <p><span id="modal-email-title"></span> basic statistics.</p>
        <ul>
          <li><span id="modal-send-date"></span></li>
        </ul>
        <div class="row text-center">
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <h5>Opens</h5>
            <span id="modal-mailgun-opens"></span>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <h5>Clicks</h5>
            <span id="modal-mailgun-clicks"></span>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <h5>Marked as Spam</h5>
            <span id="modal-mailgun-spam"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-xs-12 col-sm-8">
            <p>For more complete statistcs, log in to <a href="https://app.mailgun.org" target="_blank">Mailgun</a></p>
          </div>
          <div class="col-xs-12 col-sm-4 text-right">
            <button type="button" id="closeBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!--/end modal-->
<h2>Future Emails</h2>
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><span class="badge">{{ $emails_notready_current->total() }}</span> Not Ready: <small><em>These emails are not confirmed and/or are missing critical items.</em></small></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-left">Title</th>
                                <th class="text-center">Ready?</th>
                                <th class="text-center">Confirmed?</th>
                                <th class="text-center"><span class="fa fa-calendar" aria-hidden="true"></span></th>
                                <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                                <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($emails_notready_current))
                                @foreach($emails_notready_current as $email)
                                    <tr class="{{ $email->present()->emailScheduleStatus }}">
                                        <td>{{ $email->title }}</td>
                                        <td class="text-center">
                                          @if($email->is_ready)
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                          @else
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                          @endif
                                        </td>
                                        <td class="text-center">
                                          @if($email->is_approved)
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                          @else
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                          @endif
                                        </td>
                                        <td class="text-center"><small>{{ $email->present()->prettySendAtDate }}</small></td>
                                        <td class="text-center">
                                            <a href="{{ route('email.edit', $email->id) }}">
                                                <span class="fa fa-pencil" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a
                                               href="#"
                                               data-toggle="modal"
                                               data-id="{{ $email->id }}"
                                               data-title="{{ $email->title }}"
                                               data-target="#deleteModal">
                                              <span class="fa fa-trash" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                  {{-- MULTIPLE PAGINATION TUTORIAL: https://stackoverflow.com/questions/24086269/laravel-multiple-pagination-in-one-page/25553245#25553245 --}}
                  {{ $emails_notready_current->appends(
                      [
                        'ready_current' => $emails_notready_current->currentPage(),
                        'sent' => $emails_sent->currentPage(),
                        'notsent_past' => $emails_notsent_past->currentPage()
                      ]
                    )->links() }}
                </div><!-- /.box-footer -->
                <!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col-md-6 -->
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><span class="badge">{{ $emails_ready_current->total() }}</span> Ready: <small><em>These emails are confirmed and have all necessary assets. They will be sent at the specified date and time.</em></small></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-left">Title</th>
                                <th class="text-center"><span class="fa fa-calendar" aria-hidden="true"></span></th>
                                <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                                <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($emails_ready_current))
                                @foreach($emails_ready_current as $email)
                                    <tr class="{{ $email->present()->emailScheduleStatus }}">
                                        <td>{{ $email->title }}</td>
                                        <td class="text-center"><small>{{ $email->present()->prettySendAtDate }}</small></td>
                                        <td class="text-center">
                                            <a href="{{ route('email.edit', $email->id) }}">
                                                <span class="fa fa-pencil" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a
                                               href="#"
                                               data-toggle="modal"
                                               data-id="{{ $email->id }}"
                                               data-title="{{ $email->title }}"
                                               data-target="#deleteModal">
                                              <span class="fa fa-trash" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  {{ $emails_ready_current->appends(
                      [
                        'notready_current' => $emails_notready_current->currentPage(),
                        'sent' => $emails_sent->currentPage(),
                        'notsent_past' => $emails_notsent_past->currentPage()
                      ]
                    )->links() }}
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
    </div><!-- /.col-md-6 -->
</div><!-- /.row -->

<h2>Past Emails</h2>
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><span class="badge">{{ $emails_notsent_past->total() }}</span> Past (not sent): <small><em>These emails were never sent.</em></small></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th class="text-left">Title</th>
                              <th class="text-center"><span class="fa fa-calendar" aria-hidden="true"></span></th>
                              <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                              <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(isset($emails_notsent_past))
                              @foreach($emails_notsent_past as $email)
                                  <tr class="{{ $email->present()->emailScheduleStatus }}">
                                      <td>{{ $email->title }}</td>
                                      <td class="text-center"><small>{{ $email->present()->prettySendAtDate }}</small></td>
                                      <td class="text-center">
                                          <a href="{{ route('email.edit', $email->id) }}">
                                              <span class="fa fa-pencil" aria-hidden="true"></span>
                                          </a>
                                      </td>
                                      <td class="text-center">
                                          <a
                                             href="#"
                                             data-toggle="modal"
                                             data-id="{{ $email->id }}"
                                             data-title="{{ $email->title }}"
                                             data-target="#deleteModal">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                          </a>
                                      </td>
                                  </tr>
                              @endforeach
                          @endif
                      </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  {{ $emails_notsent_past->appends(
                      [
                        'notready_current' => $emails_notready_current->currentPage(),
                        'ready_current' => $emails_ready_current->currentPage(),
                        'sent' => $emails_sent->currentPage()
                      ]
                    )->links() }}
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col-md-6 -->
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><span class="badge">{{ $emails_sent->total() }}</span> Sent: <small><em>Nothing left to do here but view the statistics.</em></small></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th class="text-left">Title</th>
                              <th class="text-center"><span class="fa fa-calendar" aria-hidden="true"></span></th>
                              <th class="text-center"><span class="fa fa-bar-chart" aria-hidden="true"></span></th>
                              <th class="text-center"><span class="fa fa-eye" aria-hidden="true"></span></th>
                              <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(isset($emails_sent))
                              @foreach($emails_sent as $email)
                                  <tr class="{{ $email->present()->emailScheduleStatus }}">
                                      <td>{{ $email->title }}</td>
                                      <td class="text-center"><small>{{ $email->present()->prettySendAtDate }}</small></td>
                                      <td class="text-center">
                                          <a
                                             href="#"
                                             data-toggle="modal"
                                             data-id="{{ $email->id }}"
                                             data-title="{{ $email->title }}"
                                             data-sent="{{ $email->present()->prettySendAtDate }}"
                                             data-opens="{{ $email->mailgun_opens }}"
                                             data-clicks="{{ $email->mailgun_clicks }}"
                                             data-spam="{{ $email->mailgun_spam }}"
                                             data-target="#statsModal">
                                            <span class="fa fa-bar-chart" aria-hidden="true"></span>
                                          </a>
                                      </td>
                                      <td class="text-center">
                                          <a href="{{ route('email.edit', $email->id) }}">
                                              <span class="fa fa-eye" aria-hidden="true">
                                          </a>
                                      </td>
                                      <td class="text-center">
                                          <a
                                             href="#"
                                             data-toggle="modal"
                                             data-id="{{ $email->id }}"
                                             data-title="{{ $email->title }}"
                                             data-target="#deleteModal">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                          </a>
                                      </td>
                                  </tr>
                              @endforeach
                          @endif
                      </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  {{ $emails_sent->appends(
                      [
                        'notready_current' => $emails_notready_current->currentPage(),
                        'ready_current' => $emails_ready_current->currentPage(),
                        'notsent_past' => $emails_notsent_past->currentPage()
                      ]
                    )->links() }}
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
    </div><!-- /.col-md-6 -->
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
@endsection
@section('footer-script')
  @parent
  <script>
    // Handle deletion of an email via the modal
    $(document).ready(function(){
      let emailId = null;
      $('#deleteModal').on("show.bs.modal", function (e) {
           $("#modal-title").html($(e.relatedTarget).data('title'));
           emailId = $(e.relatedTarget).data('id');
      });

      $('#deleteConfirm').on('keyup', function(){
        if($(this).val() == 'delete'){
          $('#deleteBtn').removeAttr('disabled');
        } else {
          $('#deleteBtn').attr('disabled', true);
        }
      });

      $('#deleteBtn').on('click', function(){
        window.location.href = '/admin/email/destroy/' + emailId;
      });

      $('#statsModal').on("show.bs.modal", function (e) {
           $("#modal-email-title").html($(e.relatedTarget).data('title'));
           $("#modal-send-date").html($(e.relatedTarget).data('sent'));
           $("#modal-mailgun-opens").html($(e.relatedTarget).data('opens'));
           $("#modal-mailgun-clicks").html($(e.relatedTarget).data('clicks'));
           $("#modal-mailgun-spam").html($(e.relatedTarget).data('spam'));
      });

    })
  </script>
@endsection
