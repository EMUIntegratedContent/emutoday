<div id="returnPanel">
@if(isset($form))
    {{-- <p>{{$form}} - {{$sroute}} - {{$stype}}</p> --}}
        @if($form === 'queue')
            @if($sroute === 'article')
                <a class="warning button" href="/admin/magazine/{{$sroute}}/queue">RETURN</a>
            @else
                <a class="warning button" href="/admin/{{$sroute}}/queue">RETURN</a>
            @endif

        @else
            <a class="warning button" href="{{route('admin_storytype_edit', ['stype' => $stype, 'story'=> $recordid])}}">RETURN</a>
        @endif
    @else
        <a class="warning button" href="{{route('admin_storytype_edit', ['stype' => $stype, 'story'=> $recordid])}}">RETURN</a>
    @endif
</div><!-- /.returnPanel -->
{{-- <div class="backcoveropen"></div> --}}
