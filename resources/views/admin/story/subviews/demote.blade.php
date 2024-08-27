<div class="box box-primary">
    {!! html()->form('post', route('admin_story_demote'))->attributes(['onsubmit' => 'return ConfirmDelete();'])->open() !!}

    {!! html()->hidden('id', $story_id)->id('id') !!}
    {!! html()->hidden('qtype', $qtype)->id('qtype') !!}
    {!! html()->hidden('gtype', $gtype)->id('gtype') !!}
    {!! html()->hidden('stype', $stype)->id('stype') !!}

    <div class="box-header with-border">
        <div class="box-head-info pull-left">
            <h3 class="box-title">Demote this Story</h3>
        </div><!-- /.box-head-info -->
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">
        <p>This story can be demoted to a 'News' story because it does not have the required images for publication. Click the "Demote Story" button below to perform this action.</p>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <div class="form-inline">
            <div class="form-group">
                {!! html()->submit('Demote Story')->class('btn btn-warning') !!}
            </div>
        </div> <!-- /.form-inline -->
    </div><!-- /.box-footer-->

    {!! html()->form()->close() !!}
</div> <!-- /.box -->
<script>

	function ConfirmDelete () {
		if(confirm("Are you sure you want to demote this story to type 'News'?")) {
			return true;
		}
		return false;
	}

</script>

