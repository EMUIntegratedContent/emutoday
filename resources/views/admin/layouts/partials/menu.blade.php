
@can('admin', $currentUser)
<li class="treeview {{ set_active('admin/announcement*') }}">
    <a href="#"><i class="fa fa-bullhorn"></i> <span>Announcements</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ set_active('admin/announcement*') }}"><a href="/admin/announcement/queue"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
        {{-- <li class="{{ set_active('admin/announcement*') }}"><a href="/admin/announcement"><i class="fa fa-list"></i> <span>List</span></a></li> --}}
        <li class="{{ set_active('admin/announcement*') }}"><a href="/admin/announcement/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    </ul>
</li>
<li class="treeview {{ set_active('admin/event*') }}">
    <a href="#"><i class="fa fa-calendar"></i> <span>Events</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ set_active('admin/event*') }}"><a href="/admin/event/queue"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>

        {{-- <li class="{{ set_active('admin/event*') }}"><a href="/admin/event"><i class="fa fa-list"></i> <span>List</span></a></li> --}}
        <li class="{{ set_active('admin/event*') }}"><a href="/admin/event/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    </ul>
</li>
@endcan
@can('story_create', $currentUser)
<li class="treeview {{ set_active('admin/story*') }}">
    <a href="#"><i class="fa fa-file-text-o"></i> <span>Stories</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">

        @can('story_approve', $currentUser)

        <li class="{{ set_active('admin/story*') }}"><a href="/admin/story/queue"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
        @endcan
        @can('story_promote', $currentUser)

        <li class="{{ set_active('admin/story/news*') }}"><a href="/admin/story/news/queue"><i class="fa fa-rocket"></i> <span>News Queue</span></a></li>
        @endcan
        {{-- <li class="{{ set_active('admin/story*') }}"><a href="/admin/story/all"><i class="fa fa-list"></i> <span>List All</span></a></li> --}}
        <li class="{{ set_active('admin/story*') }}"><a href="/admin/story/new/setup"><i class="fa fa-plus-square"></i><span>New Story</span></a></li>

    </ul>
</li>
@endcan

@can('admin', $currentUser)
<li class="treeview {{ set_active('admin/page*') }}">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Hub</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ set_active('admin/page*') }}"><a href="/admin/page"><i class="fa fa-list"></i> <span>List</span></a></li>
        <li class="{{ set_active('admin/page*') }}"><a href="/admin/page/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    </ul>
</li>
@endcan
{{-- @can('super',$currentUser)
<li class="treeview {{ set_active('admin/page*') }}">
    <a href="#"><i class="fa fa-envelope-o"></i> <span>Email Blasts</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ set_active('admin/emailblast*') }}"><a href="#"><i class="fa fa-list"></i> <span>List</span></a></li>
        <li class="{{ set_active('admin/emailblast*') }}"><a href="#"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    </ul>
</li>
@endcan --}}

@can('admin', $currentUser)
<li class="treeview {{ set_active('admin/magazine*') }}">
    <a href="#"><i class="fa fa-book"></i> <span>Magazine</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine"><i class="fa fa-list"></i> <span>List</span></a></li>
        <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
        <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine/article/queue"><i class="fa fa-rocket"></i><span>Articles</span></a></li>
        <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine/article/setup"><i class="fa fa-plus-square"></i><span>Add Article</span></a></li>
    </ul>
</li>
@endcan
@can('super', $currentUser)
<li class="treeview {{ set_active('admin/storyimages*') }}">
    <a href="#"><i class="fa fa-picture-o"></i> <span>Images</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ set_active('admin/storyimages*') }}"><a href="/admin/storyimages"><i class="fa fa-list"></i> <span>List</span></a></li>
        <li class="{{ set_active('admin/storyimages*') }}"><a href="/admin/storyimages/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    </ul>
</li>
<li class="header">
    Other
</li>
<li class="treeview {{ set_active('admin/bugz*') }}">
    <a href="#"><i class="fa fa-bug"></i> <span>Bugz</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ set_active('admin/bugz*') }}"><a href="/admin/bugz/app"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
        <li class="{{ set_active('admin/bugz*') }}"><a href="/admin/bugz"><i class="fa fa-list"></i> <span>List</span></a></li>
        <li class="{{ set_active('admin/bugz*') }}"><a href="/admin/bugz/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    </ul>
</li>
<li class="{{ set_active('admin/user*') }}"><a href="/admin/user"><i class="fa fa-users"></i> <span>Users</span></a></li>

<li class="treeview {{ set_active('admin/twitter*') }}"><a href="/admin/twitter"><i class="fa fa-twitter"></i> <span>Tweets</span></a></li>
@endcan
