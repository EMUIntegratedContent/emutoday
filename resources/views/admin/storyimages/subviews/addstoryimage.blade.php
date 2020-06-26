<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <form action="addnewstoryimage" method="POST">
                {{ csrf_field() }}
                {{-- {{$otherImage->id}}
                {{$otherImage->type}}
                {{$otherImage->name}} --}}
            {!! Form::hidden('story_id', 	$story_id, 	         ['id'=>'story_id']) 	!!}
            {!! Form::hidden('img_id', 		$otherImage->id, 	['id'=>'img_id']) 	!!}
            {!! Form::hidden('img_type', 	$otherImage->type, 	['id'=>'img_type']) !!}
            {!! Form::hidden('img_name', 	$otherImage->name, 	['id'=>'img_name']) !!}
            <button class="btn btn-primary" href="#">{{$otherImage->name}}</button>

        </form>
    </div>
</div>
