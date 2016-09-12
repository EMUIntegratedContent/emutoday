<!-- Logo -->
<a href="/" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>EMU</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>EMU</b>-TODAY</span>
</a>
<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bug"></i>
                    <span class="label label-alert"></span>
                </a>
                <ul class="dropdown-menu">
                    {{-- <li class="header">You have tracked 4 bugz</li> --}}
                    <li>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                            @include('admin.bugz.subview.miniform')
                        </ul>
                        <!-- /.menu -->
                    </li>
                    <li class="footer"><a href="#" class="btn btn-info expanded btn-xs" data-toggle="collapse">close</a>
                    </li>
                </ul>
            </li>
            <!-- /.messages-menu -->
            @can('super', $currentUser)
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-calendar-o"></i>
                        <span class="label label-warning">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 events to approve</li>
                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <i class="fa fa-calendar bg-orange"></i>
                                            {{-- <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            Event 1
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>EMU Picnic</p>
                                    </a>
                                </li>
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <i class="fa fa-calendar bg-orange"></i>
                                            {{-- <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            Event 2
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>EMU Registration</p>
                                    </a>
                                </li>
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <i class="fa fa-calendar bg-orange"></i>
                                            {{-- <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            Event 3
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>EMU Concert</p>
                                    </a>
                                </li>
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <i class="fa fa-calendar bg-orange"></i>
                                            {{-- <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            Event 4
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>EMU Sporting Event</p>
                                    </a>
                                </li>
                                <!-- end message -->
                            </ul>
                            <!-- /.menu -->
                        </li>
                        <li class="footer"><a href="/admin/event">See All Events</a></li>
                    </ul>
                </li>
                <!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bullhorn"></i>
                        <span class="label label-danger">3</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 3 Announcements to approve</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-bullhorn text-red"></i> Announcement 1
                                    </a>
                                </li>
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-bullhorn text-red"></i> Announcement 2
                                    </a>
                                </li>
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-bullhorn text-red"></i> Announcement 3
                                    </a>
                                </li>
                                <!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="/admin/announcement">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-files-o"></i>
                        <span class="label label-success">2</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 2 Stories to approve</li>
                        <li>
                            <!-- Inner menu: contains the tasks -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-file-text text-green"></i> Story 1
                                    </a>
                                </li>
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-file-text text-green"></i> Story 2
                                    </a>
                                </li>
                                {{-- <li><!-- Task item -->
                                <a href="#">
                                <!-- Task title and progress text -->
                                <h3>
                                Design some buttons
                                <small class="pull-right">20%</small>
                            </h3>
                            <!-- The progress bar -->
                            <div class="progress xs">
                            <!-- Change the css width attribute to simulate progress -->
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
                        </div>
                    </div>
                </a>
            </li> --}}
            <!-- end task item -->
        </ul>
    </li>
    <li class="footer">
        <a href="/admin/story">View all stories</a>
    </li>
</ul>
</li>
@endcan
<!-- User Account Menu -->
<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->

        @if(count($currentUser->mediaFiles) > 0)
            <img src="/imagecache/avatar160/{{$currentUser->mediaFiles->first()->filename}}" class="user-image" alt="User Image">
        @else
            <img src="/assets/imgs/user/user2-160x160.jpg" class="user-image" alt="User Image">
        @endif


        {{-- <img src="{{$currentUser->mediaFiles->}}" class="user-image" alt="User Image"> --}}

        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">{{$currentUser->last_name}}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
            @if(count($currentUser->mediaFiles) > 0)
                <img src="/imagecache/avatar160/{{$currentUser->mediaFiles->first()->filename}}" class="img-circle" alt="User Image">
            @else
                <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image">
            @endif

            <p>
                {{$currentUser->first_name}} {{$currentUser->last_name}}

                <small>{{$currentUser->roles->pluck('name')}}</small>
            </p>
        </li>
        <!-- Menu Body -->
        {{-- <li class="user-body">
        <div class="row">
        <div class="col-xs-4 text-center">
        <a href="#">Followers</a>
    </div>
    <div class="col-xs-4 text-center">
    <a href="#">Sales</a>
</div>
<div class="col-xs-4 text-center">
<a href="#">Friends</a>
</div>
</div>
<!-- /.row -->
</li> --}}
<!-- Menu Footer-->
<li class="user-footer bg-purple">
    <div class="pull-left">
        <a href="/admin/users/{{$currentUser->id}}" class="btn btn-default btn-flat">Profile</a>
    </div>
    <div class="pull-right">
        <a href="logout" class="btn btn-default btn-flat">Sign out</a>
    </div>
</li>
</ul>
</li>
<!-- Control Sidebar Toggle Button -->
<li>
    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
</li>
</ul>
</div>
</nav>
