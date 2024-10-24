<div class="box-tools">
    <div class="btn-toolbar btn-group-sm">
        @if($rte == 'story' ||$rte == 'student'|| $rte == 'article' || $rte == 'news')
          @if(isset($id))
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
        @elseif($rte == 'magazine')
          @if(isset($id))
            <a href="/admin/preview/{{$rte}}/{{$id}}" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>
          @endif
            <a href="/admin/{{$rte}}/form" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
            <a href="/admin/{{$rte}}" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
        @elseif($rte == 'page')
            @if(isset($id))
              <a href="/admin/preview/{{$rte}}/{{$id}}" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>
            @endif
              <a href="/admin/{{$rte}}/form" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
              <a href="/admin/{{$rte}}" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
        @elseif($rte == 'announcement')
          <a href="/admin/{{$rte}}/form/{{$atype}}" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
          <a href="/admin/{{$rte}}/queue/{{$atype}}" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
        @elseif($rte == 'event')
          <a href="/admin/{{$rte}}/form" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
          <a href="/admin/{{$rte}}/queue" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
        @elseif($rte == 'expertcategory')
          <a href="/admin/{{$rte}}/show" class="btn bg-orange {{ set_active($path.'/show', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
          <a href="/admin/{{$rte}}" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
        @elseif($rte == 'email')
          <a href="/admin/{{$rte}}/show" class="btn bg-orange {{ set_active($path.'/show', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
          <a href="/admin/{{$rte}}" class="btn bg-orange {{ set_active($path, 'disabled') }}"><i class="fa fa-list-alt"></i></a>
        @elseif($rte == 'mediahighlights')
          <a href="/admin/{{$rte}}/form" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
        @else
          <a href="/admin/{{$rte}}/form" class="btn bg-purple {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
        @endif
    </div><!-- /.btn-toolbar -->
</div><!-- /.box-tools -->
