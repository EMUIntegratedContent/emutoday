
@can('admin', $currentUser)
<li class="treeview {{ set_active('admin/announcement*') }}">
  <a href="#"><i class="fa fa-bullhorn"></i> <span>Announcements</span> <!-- <i class="fa fa-angle-left pull-right"></i> --></a>
  <ul class="treeview-menu">
    <li><a href="#"><i class="fa fa-circle-o"></i>General <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span></a>
    <ul class="treeview-menu {{ set_active('admin/announcement/*/general') }}">
      <li class="{{ set_active('admin/announcement/*/general') }}"><a href="/admin/announcement/queue/general"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
      {{-- <li class="{{ set_active('admin/announcement*') }}"><a href="/admin/announcement"><i class="fa fa-list"></i> <span>List</span></a></li> --}}
      <li class="{{ set_active('admin/announcement/*/general') }}"><a href="/admin/announcement/form/general"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    </ul>
  </li>
  <li><a href="#"><i class="fa fa-circle-o"></i>HR <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
      </span></a>
      <ul class="treeview-menu {{ set_active('admin/announcement/*/hr') }}">
        <li class="{{ set_active('admin/announcement/*/hr') }}"><a href="/admin/announcement/queue/hr"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
        {{-- <li class="{{ set_active('admin/announcement*') }}"><a href="/admin/announcement"><i class="fa fa-list"></i> <span>List</span></a></li> --}}
        <li class="{{ set_active('admin/announcement/*/hr') }}"><a href="/admin/announcement/form/hr"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
      </ul>
    </li>
    <li><a href="/admin/archive/queue/announcements"><i class="fa fa-archive"></i>Archives <span class="pull-right-container"></a></li>
</ul>
</li>
<li class="treeview {{ set_active('admin/event*') }}">
  <a href="#"><i class="fa fa-calendar"></i> <span>Events</span> <!-- <i class="fa fa-angle-left pull-right"></i>--></a>
  <ul class="treeview-menu">
    <li class="{{ set_active('admin/event*') }}"><a href="/admin/event/queue"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
    {{-- <li class="{{ set_active('admin/event*') }}"><a href="/admin/event"><i class="fa fa-list"></i> <span>List</span></a></li> --}}
    <li class="{{ set_active('admin/event*') }}"><a href="/admin/event/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
  </ul>
</li>
@endcan
@can('lbc_approve', $currentUser)
<li><a href="/admin/lbcqueue"><i class="fa fa-university"></i> <span>LBC Approve</span></a></li>
@endcan
@can('story_create', $currentUser)
<li class="treeview {{ set_active('admin/story*') }}">
  <a href="#"><i class="fa fa-file-text-o"></i> <span>Stories</span> <!-- <i class="fa fa-angle-left pull-right"> --></i></a>
  <ul class="treeview-menu">
    <li><a href="#"><i class="fa fa-circle-o"></i>News <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span></a>
    <ul class="treeview-menu {{ set_active('admin/story/news*') }}">
      <li class="{{ set_active('admin/story/news*') }}"><a href="/admin/story/news/queuenews"><i class="fa fa-rocket"></i> <span>News Queue</span></a></li>
      {{-- <li class="{{ set_active('admin/announcement*') }}"><a href="/admin/announcement"><i class="fa fa-list"></i> <span>List</span></a></li> --}}
      <li class="{{ set_active('admin/story*') }}"><a href="/admin/queuenews/story/news/form"><i class="fa fa-plus-square"></i><span>New News Story</span></a></li>
    </ul>
  </li>
  @can('story_promote', $currentUser)
  <li><a href="#"><i class="fa fa-circle-o"></i>All Stories <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span></a>
  <ul class="treeview-menu {{ set_active('admin/story/all') }}">
    <li class="{{ set_active('admin/story*') }}"><a href="/admin/story/all/queueall"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
    {{-- <li class="{{ set_active('admin/announcement*') }}"><a href="/admin/announcement"><i class="fa fa-list"></i> <span>List</span></a></li> --}}
    <li class="{{ set_active('admin/story*') }}"><a href="/admin/queueall/story/story/form"><i class="fa fa-plus-square"></i><span>New Story</span></a></li>
  </ul>
  <li><a href="/admin/archive/queue/stories"><i class="fa fa-archive"></i>Archives <span class="pull-right-container"></a></li>
</li>
@endcan
</ul>


{{--
  <ul class="treeview-menu">
    @can('story_approve', $currentUser)
    <li class="{{ set_active('admin/story*') }}"><a href="/admin/story/all/queueall"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
    @endcan
    <li class="{{ set_active('admin/story*') }}"><a href="/admin/queueall/story/story/form"><i class="fa fa-plus-square"></i><span>New Story</span></a></li>


    @can('story_promote', $currentUser)

    <li class="{{ set_active('admin/story/news*') }}"><a href="/admin/story/news/queuenews"><i class="fa fa-rocket"></i> <span>News Queue</span></a></li>
    @endcan
    <li class="{{ set_active('admin/story*') }}"><a href="/admin/queuenews/story/news/form"><i class="fa fa-plus-square"></i><span>New News Story</span></a></li>

  </ul> --}}
</li>
@endcan

@can('admin', $currentUser)
<li class="treeview {{ set_active('admin/page*') }}">
  <a href="#"><i class="fa fa-newspaper-o"></i> <span>Hub</span> <!-- <i class="fa fa-angle-left pull-right"></i> --></a>
  <ul class="treeview-menu">
    <li class="{{ set_active('admin/page*') }}"><a href="/admin/page"><i class="fa fa-list"></i> <span>List</span></a></li>
    <li class="{{ set_active('admin/page*') }}"><a href="/admin/page/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
  </ul>
</li>
@endcan
{{-- @can('super',$currentUser)
<li class="treeview {{ set_active('admin/page*') }}">
  <a href="#"><i class="fa fa-envelope-o"></i> <span>Email Blasts</span> <!-- <i class="fa fa-angle-left pull-right"> --></i></a>
  <ul class="treeview-menu">
    <li class="{{ set_active('admin/emailblast*') }}"><a href="#"><i class="fa fa-list"></i> <span>List</span></a></li>
    <li class="{{ set_active('admin/emailblast*') }}"><a href="#"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
  </ul>
</li>
@endcan --}}

@can('admin', $currentUser)
<li class="treeview {{ set_active('admin/magazine*') }}">
  <a href="#"><i class="fa fa-book"></i> <span>Magazine</span> <!-- <i class="fa fa-angle-left pull-right"></i> --> </a>
  <ul class="treeview-menu">
    <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine"><i class="fa fa-list"></i> <span>List</span></a></li>
    <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine/article/queuearticle"><i class="fa fa-rocket"></i><span>Articles</span></a></li>
    <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/queuearticle/magazine/article/form"><i class="fa fa-plus-square"></i><span>Add Article</span></a></li>
  </ul>
</li>
<li><a href="/admin/authors/list"><i class="fa fa-pencil"></i> <span>Authors</span></a></li>
@endcan
@can('super', $currentUser)
{{--
<li class="treeview {{ set_active('admin/storyimages*') }}">
  <a href="#"><i class="fa fa-picture-o"></i> <span>Images</span></a>
  <ul class="treeview-menu">
    <li class="{{ set_active('admin/storyimages*') }}"><a href="/admin/storyimages"><i class="fa fa-list"></i> <span>List</span></a></li>
    <li class="{{ set_active('admin/storyimages*') }}"><a href="/admin/storyimages/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
  </ul>
</li>
--}}
<hr/> <!-- //////////////////////////////// -->

<li class="{{ set_active('admin/user*') }}"><a href="/admin/user"><i class="fa fa-users"></i> <span>Users</span></a></li>

  @endcan
