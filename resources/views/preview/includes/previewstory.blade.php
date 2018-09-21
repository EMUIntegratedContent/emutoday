<div id="returnPanel">
@if(isset($qtype))
    {{-- <p>{{$form}} - {{$sroute}} - {{$stype}}</p> --}}

    <a class="warning button" href="/preview/return/{{$gtype}}/{{$stype}}/{{$qtype}}/{{$recordid}}">RETURN</a>

        {{-- @if($qtype === 'queueall')
            Route::get('{gtype}/{stype}/{qtype}','Admin\StoryTypeController@queue' );

            @if($sroute === 'article')
                <a class="warning button" href="/admin/magazine/{{$sroute}}/queue">RETURN</a>
            @else
                <a class="warning button" href="/admin/{{$sroute}}/queue">RETURN</a>
            @endif

        @else
            <a class="warning button" href="{{route('admin_storytype_edit', ['stype' => $stype, 'story'=> $recordid])}}">RETURN</a>
        @endif --}}
    @else
        <a class="warning button" href="{{route('admin_storytype_edit', ['stype' => $stype, 'story'=> $recordid])}}">RETURN</a>
    @endif
</div><!-- /.returnPanel -->
{{-- <div class="backcoveropen"></div> --}}
