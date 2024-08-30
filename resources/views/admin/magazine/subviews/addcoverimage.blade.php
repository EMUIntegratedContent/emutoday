<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Add Cover Image</h3>
  </div>
  <div class="box-body">
    {!! html()->form('post', route('store_magazine_cover', $magazine->id))->acceptsFiles()->open() !!}
    <div class="form-group">
      {!! html()->file('photo')->required()->id('photo')->class('form-control input-sm') !!}
    </div>
    <div class="form-group">
      {!! html()->label('Caption', 'caption') !!}
      {!! html()->text('caption')->class('form-control') !!}
    </div>
    <div class="form-group">
      {!! html()->label('Note', 'note') !!}
      {!! html()->text('note')->class('form-control') !!}
    </div>
    <div class="form-group">
      {!! html()->submit('Add Cover Image')->class('btn btn-primary') !!}
    </div>
    {{ csrf_field() }}
    {!! html()->form()->close() !!}

  </div> <!-- /.box-body -->

</div> <!-- /.box -->
