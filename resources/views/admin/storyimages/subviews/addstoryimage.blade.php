<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        {!! html()->form('POST', 'addnewstoryimage')->open() !!}
        {{ csrf_field() }}

        {!! html()->hidden('story_id', $story_id)->id('story_id') !!}
        {!! html()->hidden('img_id', $otherImage->id)->id('img_id') !!}
        {!! html()->hidden('img_type', $otherImage->type)->id('img_type') !!}
        {!! html()->hidden('img_name', $otherImage->name)->id('img_name') !!}

        {!! html()->button($otherImage->name)->class('btn btn-primary') !!}
        {!! html()->form()->close() !!}
    </div>
</div>
