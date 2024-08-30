<div class="box box-warning hasajax">
  <div class="box-header with-border">
    {{-- <h3 class="box-title">Bug Tracker</h3> --}}
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="POST"
        action="/api/bugz"
        complete="Okay, Bug Added" userid="{{$currentUser->id}}"
  >
    {{-- <form method="POST"
action="/api/bugz"
v-myajax complete="Okay, Bug Added" userid="{{$currentUser->id}}"
    > --}}
    {{-- <form role="form"> --}}
    <div class="box-body">
      {{ csrf_field() }}
      {!! html()->hidden('user_id', $currentUser->id) !!}

      <div class="form-group">
        {!! html()->label('Type', 'type') !!}
        {!! html()->select('type', ['bug' => 'bug', 'design' => 'design', 'comment' => 'comment', 'other' => 'other'])->placeholder('Type...')->class('form-control') !!}
      </div>
      <div class="form-group">
        {!! html()->label('Screen', 'screen') !!}
        {!! html()->text('screen')->class('form-control input-sm') !!}
      </div>
      <div class="form-group">
        {!! html()->label('Notes', 'notes') !!}
        {!! html()->textarea('notes')->class('form-control input-sm')->rows(4) !!}
      </div>
      <div class="form-group">
        {!! html()->label('Priority', 'priority') !!}
        {!! html()->select('priority', ['0' => 'low', '3' => 'medium', '6' => 'high', '9' => 'critical'])->placeholder('Priority...')->class('form-control') !!}
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button id="bugz-submit" class="btn btn-warning btn-block btn-sm" type="submit">Submit</button>
    </div>
  </form>

</div>
