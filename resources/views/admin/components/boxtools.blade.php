<div class="box-tools">
    <div class="btn-toolbar btn-group-sm">
        {{-- <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div> --}}

            {{-- @can('super', $cuser) --}}
                {{-- <div class="btn-group btn-group-sm" role="group">
                     <a class="btn bg-orange dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus-square"></i><span class="caret"></span></a>
                     <ul class="dropdown-menu dropdown-menu-justified">
                         <li><a href="{{ route('admin_story_setup', ['stype' => 'storybasic']) }}" class="btn bg-orange btn-sm btn-block">Create News Story</a></li>
                         <li><a href="{{ route('admin_story_setup', ['stype' => 'story']) }}" class="btn bg-orange  btn-sm btn-block">Create Promoted Story</a></li>
                         <li><a href="{{ route('admin_story_setup', ['stype' => 'storyexternal']) }}" class="btn bg-orange  btn-sm btn-block">Create External Story</a></li>
                     </ul>
                 </div> --}}


                @if($rte == 'story' ||$rte == 'student'|| $rte == 'article' || $rte == 'news')
                             @if(isset($id))
                                 {{-- <a id="{{$rte}}-preview" href="/preview/{{$rte}}/{{$id}}" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a> --}}

                             <button id="{{$rte}}-preview" href="#" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></button>
                             @endif

                            <a id="{{$rte}}-new" href="/admin/story/{{$rte}}/setup" class="btn bg-orange btn-sm {{ set_active($path.'/setup', 'disabled') }}"><i class="fa fa-plus-square"></i></a>

                            @if($rte == 'article')
                                <a id="{{$rte}}-list" href="/admin/story/{{$rte}}" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
                            @else
                                <a id="{{$rte}}-list" href="/admin/story/" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
                            @endif
                @elseif($rte == 'all')

                    <a href="/admin/story/story/setup" class="btn bg-orange btn-sm {{ set_active($path.'/setup', 'disabled') }}"><i class="fa fa-plus-square"></i></a>

                   {{-- <a href="/admin/story/create" class="btn bg-orange btn-sm {{ set_active($path.'/setup', 'disabled') }}"><i class="fa fa-plus-square"></i></a> --}}


                @elseif($rte == 'magazine')
                        @if(isset($id))
                            <a href="/preview/{{$rte}}/{{$id}}" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>
                        @endif
                            <a href="/admin/{{$rte}}/form" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
                            <a href="/admin/{{$rte}}" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
                @elseif($rte == 'page')
                        @if(isset($id))
                            <a href="/preview/{{$rte}}/{{$id}}" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>
                        @endif
                            <a href="/admin/{{$rte}}/form" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
                            <a href="/admin/{{$rte}}" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
                @elseif($rte == 'announcement')
                    <a href="/admin/{{$rte}}/form/{{$atype}}" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
                    <a href="/admin/{{$rte}}/queue/{{$atype}}" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>

                @else
                        <a href="/admin/{{$rte}}/form" class="btn bg-purple {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
                @endif
    </div><!-- /.btn-toolbar -->

</div><!-- /.box-tools -->
