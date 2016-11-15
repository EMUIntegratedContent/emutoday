<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin tools') - AdminEMU</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @section('style-vendor')

    @show
    @section('style-plugin')

    @show
    @section('style-app')
        <link rel="stylesheet" href="/css/admin-styles.css" />
    @show
    @section('scripts-vendor')
        <!-- Vendor Scripts that need to be loaded in the header before other plugin or app scripts -->
    @show
    @section('scripts-plugin')
        <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
    @show
    @section('scripts-app')
        <!-- App related Scripts  that need to be loaded in the header -->
        
    @show
    @include('include.js')
    <meta name="_token" content="{{ csrf_token() }}">
</head>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
        @include('admin.layouts.partials.header', ['currentUser' => $currentUser])

    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(count($currentUser->mediaFiles) > 0)
                    <img src="/imagecache/avatar160/{{$currentUser->mediaFiles->first()->filename}}" class="user-image img-circle" alt="User Image">
                @else
                    <img src="/assets/imgs/user/user2-160x160.jpg" class="user-image" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ $currentUser->last_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="search" method="GET" id="admin-search-form" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="searchterm" id="searchterm" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
<!-- /.search form -->

<!-- ********************************
Sidebar Menu
******************************** -->
<ul class="sidebar-menu">
    @include('admin.layouts.partials.menu')

</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        {{-- <h1>
        {{Route::current()->getName()}}
        <small>	{{Route::current()->getActionName()}}</small>
    </h1> --}}
    <div class="row">

        <div class="col-xs-6">

            <ol class="breadcrumb">
                <li><a class="btn bg-olive btn-sm" href="{{URL::previous()}}"><i class="fa fa-arrow-circle-left fa-lg"></i></a></li>
                <li><a class="btn bg-purple btn-sm" href="/admin/dashboard"><i class="fa fa-dashboard fa-lg"></i></a></li>
                <li class="active">Here</li>
            </ol>

        </div><!-- /.col-xs-6 -->
        <div class="col-xs-6">
            {{-- {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default pull-right']) !!} --}}

            {{-- <a href="{{URL::previous()}}"><i class="fa fa-arrow-circle-left pull-right bg-yellow"></i></a> --}}
        </div><!-- /.col-xs-6 -->

    </div><!-- /.row -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    @include('flash::message')
    @include('admin.components.errors')
    @yield('content')
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        2016
    </div>
    <!-- Default to the left -->
    <strong><a href="#">EMU-Today</a></strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript::;">
                        <i class="menu-icon fa fa-newspaper-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">EMU-Today Weekly</h4>

                            <p>Wednesday July 6th, 2016</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript::;">
                        <i class="menu-icon fa fa-book bg-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">EMU Magazine Launch</h4>

                            <p>Monday August 1st, 2016</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript::;">
                        <h4 class="control-sidebar-subheading">
                            Compile Magazine Content
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Google Analytics
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div> <!-- wrapper -->
@section('footer-vendor')
    {{-- Combined scripts for js libraries used throughout admin site --}}
    <script src="/js/vendor-scripts.js"></script>
@show
@section('footer-plugin')

@show
@section('footer-app')
    {{-- <script>
    var AdminLTEOptions = {
    //Enable sidebar expand on hover effect for sidebar mini
    //This option is forced to true if both the fixed layout and sidebar mini
    //are used together
    sidebarExpandOnHover: false,
    //BoxRefresh Plugin
    enableBoxRefresh: true,
    //Bootstrap.js tooltip
    enableBSToppltip: true
};
</script> --}}
<script src="/themes/admin-lte/js/app.js"></script>
{{-- <script src="/js/vue-ajax-form.js" ></script> --}}
<script src="/js/admin-emucustom.js"></script>
@show

@section('footer-script')
@show

</body>
</html>
