@can('admin', $currentUser)
<li class="treeview {{ set_active('admin/announcement*') }}">
  <a href="#"><i class="fa fa-bullhorn"></i> <span>Announcements</span> <!-- <i class="fa fa-angle-left pull-right"></i> --></a>
  <ul class="treeview-menu">
    <li><a href="#"><i class="fa fa-circle-o"></i>General <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span></a>
    <ul class="treeview-menu {{ set_active('admin/announcement/*/general') }}">
      <li class="{{ set_active('admin/announcement/*/general') }}"><a href="/admin/announcement/queue/general"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
      <li class="{{ set_active('admin/announcement/*/general') }}"><a href="/admin/announcement/form/general"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    </ul>
  </li>
  <li><a href="#"><i class="fa fa-circle-o"></i>HR <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
      </span></a>
      <ul class="treeview-menu {{ set_active('admin/announcement/*/hr') }}">
        <li class="{{ set_active('admin/announcement/*/hr') }}"><a href="/admin/announcement/queue/hr"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
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
    <li class="{{ set_active('admin/event*') }}"><a href="/admin/event/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
  </ul>
</li>
@endcan
@can('lbc_approve', $currentUser)
<li><a href="/admin/lbcqueue"><i class="fa fa-university"></i> <span>LBC Approve</span></a></li>
@endcan
@can('rewards', $currentUser)
<li><a href="/admin/hscqueue"><i class="fa fa-graduation-cap"></i> <span>Eagle Rewards</span></a></li>
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
      <li class="{{ set_active('admin/story*') }}"><a href="/admin/queuenews/news/news/form"><i class="fa fa-plus-square"></i><span>New News Story</span></a></li>
    </ul>
    </li>
  @can('story_promote', $currentUser)
    <li><a href="#"><i class="fa fa-circle-o"></i>Media Advisories <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span></a>
    <ul class="treeview-menu {{ set_active('admin/story/advisory*') }}">
      <li class="{{ set_active('admin/story/advisory*') }}"><a href="/admin/story/advisory/queueadvisory"><i class="fa fa-rocket"></i> <span>Advisory Queue</span></a></li>
      <li class="{{ set_active('admin/story*') }}"><a href="/admin/queuenews/advisory/advisory/form"><i class="fa fa-plus-square"></i><span>New Advisory</span></a></li>
    </ul>
  </li>
  <li><a href="#"><i class="fa fa-circle-o"></i>Statements <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span></a>
    <ul class="treeview-menu {{ set_active('admin/story/statement*') }}">
      <li class="{{ set_active('admin/story/statement*') }}"><a href="/admin/story/statement/queuestatement"><i class="fa fa-rocket"></i> <span>Statement Queue</span></a></li>
      <li class="{{ set_active('admin/story*') }}"><a href="/admin/queuenews/statement/statement/form"><i class="fa fa-plus-square"></i><span>New Statement</span></a></li>
    </ul>
  </li>
  <li><a href="#"><i class="fa fa-circle-o"></i>All Stories <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span></a>
    <ul class="treeview-menu {{ set_active('admin/story/all') }}">
      <li class="{{ set_active('admin/story*') }}"><a href="/admin/story/all/queueall"><i class="fa fa-rocket"></i> <span>Queue</span></a></li>
      <li class="{{ set_active('admin/story*') }}"><a href="/admin/queueall/story/story/form"><i class="fa fa-plus-square"></i><span>New Story</span></a></li>
    </ul>
  </li>
  <li><a href="/admin/archive/queue/stories"><i class="fa fa-archive"></i>Archives <span class="pull-right-container"></a></li>
  @endcan
</ul>
</li>
@endcan

@can('admin', $currentUser)
<li class="treeview {{ set_active('admin/page*') }}">
  <a href="#"><i class="fa fa-sitemap"></i> <span>Hub</span></a>
  <ul class="treeview-menu">
    <li class="{{ set_active('admin/page*') }}"><a href="/admin/page"><i class="fa fa-list"></i> <span>List</span></a></li>
    <li class="{{ set_active('admin/page*') }}"><a href="/admin/page/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
  </ul>
</li>
@endcan
{{-- Gate Facade allows multiple permission checks (unlike @can) --}}
@if(Gate::check('admin') || Gate::check('experts'))
    <li class="treeview {{ set_active('admin/expert*') }}">
      <a href="#"><i class="fa fa-blind"></i> <span>Experts</span></a>
      <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-circle-o"></i>Eastern Experts <span class="pull-right-container">
            @if(count($bugExperts) > 0)
            <span class="label label-success">{{ count($bugExperts) }} NEW</span>
            @endif
            <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu {{ set_active('admin/expert*') }}">
                <li class="{{ set_active('admin/experts*') }}"><a href="/admin/experts"><i class="fa fa-list"></i> <span>List</span></a></li>
                <li class="{{ set_active('admin/experts*') }}"><a href="/admin/experts/show"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
            </ul>
        </li>
        <li><a href="#"><i class="fa fa-circle-o"></i>Media Requests <span class="pull-right-container">
            @if(count($bugExpertMediaRequests) > 0)
            <span class="label label-success">{{ count($bugExpertMediaRequests) }} NEW</span>
            @endif
            <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu {{ set_active('admin/experts/requests*') }}">
                <li class="{{ set_active('admin/expertrequests/*') }}"><a href="/admin/expertrequests"><i class="fa fa-list"></i> <span>List</span></a></li>
            </ul>
        </li>
        <li><a href="#"><i class="fa fa-circle-o"></i>Categories <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu {{ set_active('admin/experts/category*') }}">
                <li class="{{ set_active('admin/expertcategory/*') }}"><a href="/admin/expertcategory"><i class="fa fa-list"></i> <span>List</span></a></li>
                <li class="{{ set_active('admin/expertcategory/*') }}"><a href="/admin/expertcategory/show"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
            </ul>
        </li>
      </ul>
    </li>
@endif
@can('admin', $currentUser)
<li class="treeview {{ set_active('admin/magazine*') }}">
  <a href="#"><i class="fa fa-book"></i> <span>Magazine</span></a>
  <ul class="treeview-menu">
    <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine"><i class="fa fa-list"></i> <span>List</span></a></li>
    <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
    <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/magazine/article/queuearticle"><i class="fa fa-rocket"></i><span>Articles</span></a></li>
    <li class="{{ set_active('admin/magazine*') }}"><a href="/admin/queuearticle/magazine/article/form"><i class="fa fa-plus-square"></i><span>Add Article</span></a></li>
  </ul>
</li>
@endcan
@if(Gate::check('admin') || Gate::check('emails'))
    <li class="treeview {{ set_active('admin/email*') }}">
      <a href="#"><i class="fa fa-envelope"></i> <span>Email Builder</span></a>
      <ul class="treeview-menu">
        <li class="{{ set_active('admin/email*') }}"><a href="/admin/email"><i class="fa fa-list"></i> <span>List</span></a></li>
        <li class="{{ set_active('admin/email*') }}"><a href="/admin/email/show"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
      </ul>
    </li>
@endif
@if(Gate::check('admin') || Gate::check('editor'))
    <li class="treeview {{ set_active('admin/mediahighlights*') }}">
      <a href="#"><i class="fa fa-newspaper-o"></i> <span>Media Highlights</span></a>
      <ul class="treeview-menu">
        <li class="{{ set_active('admin/mediahighlights*') }}"><a href="/admin/mediahighlights"><i class="fa fa-list"></i> <span>List</span></a></li>
        <li class="{{ set_active('admin/mediahighlights*') }}"><a href="/admin/mediahighlights/form"><i class="fa fa-plus-square"></i> <span>Create</span></a></li>
      </ul>
    </li>
@endif
@can('admin', $currentUser)
<li><a href="/admin/authors/list"><i class="fa fa-pencil"></i> <span>Authors</span></a></li>
@endcan
@can('super', $currentUser)
<hr/> <!-- //////////////////////////////// -->
<li class="{{ set_active('admin/user*') }}"><a href="/admin/user"><i class="fa fa-users"></i> <span>Users</span></a></li>
@endcan
