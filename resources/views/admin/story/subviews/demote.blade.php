<div class="box box-primary">
    {!! Form::open([
        'method' => 'post',
        'route' => ['admin_story_demote'],
        'onsubmit' => 'return ConfirmDelete();'
    ]) !!}
    {{ Form::hidden('id', $story_id, array('id' => 'id')) }}
    {{ Form::hidden('qtype', $qtype, array('id' => 'qtype')) }}
    {{ Form::hidden('gtype', $gtype, array('id' => 'gtype')) }}
    {{ Form::hidden('stype', $stype, array('id' => 'stype')) }}
    <div class="box-header with-border">
        <div class="box-head-info pull-left">
            <h3 class="box-title">Demote this {{ $stype }}</h3>
        </div><!-- /.box-head-info -->
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                    data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <p>This {{ $stype }} can be demoted to a 'News' story because it does not have the required images for
            publication. Click the "Demote Story" button below to perform this action.</p>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <div class="form-inline">
            <div class="form-group">
                {!! Form::submit('Demote Story', array('class'=>'btn btn-warning')) !!}
                {!! Form::close() !!}
            </div>
        </div> <!-- /.form-inline -->
    </div><!-- /.box-footer-->

</div> <!-- /.box -->
<script>

	function ConfirmDelete () {
		console.log("FRIGG!")
		if(confirm("Are you sure you want to demote this story to type 'News'?")) {
			return true;
		}
		return false;
	}

</script>

