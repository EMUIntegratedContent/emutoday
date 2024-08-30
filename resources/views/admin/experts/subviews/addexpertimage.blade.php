<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <form action="addnewexpertimage" method="GET">
        {{ csrf_field() }}

        {!! html()->hidden('expert_id', $expert_id)->id('expert_id') !!}
        {!! html()->hidden('img_id', $otherImage->id)->id('img_id') !!}
        {!! html()->hidden('img_name', $otherImage->name)->id('img_name') !!}

        {!! html()->button($otherImage->name)->class('btn btn-primary') !!}
        </form>
    </div>
</div>
