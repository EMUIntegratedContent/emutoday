<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title'); ?>AdminEMU</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $__env->startSection('style-vendor'); ?>

    <?php echo $__env->yieldSection(); ?>
    <?php $__env->startSection('style-plugin'); ?>

    <?php echo $__env->yieldSection(); ?>
    <?php $__env->startSection('style-app'); ?>
        <link rel="stylesheet" href="/css/admin-styles.css" />
    <?php echo $__env->yieldSection(); ?>
    <?php $__env->startSection('scripts-vendor'); ?>
        <!-- Vendor Scripts that need to be loaded in the header before other plugin or app scripts -->
    <?php echo $__env->yieldSection(); ?>
    <?php $__env->startSection('scripts-plugin'); ?>
        <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
    <?php echo $__env->yieldSection(); ?>
    <?php $__env->startSection('scripts-app'); ?>
        <!-- App related Scripts  that need to be loaded in the header -->
    <?php echo $__env->yieldSection(); ?>
    <?php /*<?php echo $__env->make('include.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
</head>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
        <?php echo $__env->make('admin.layouts.partials.header', ['currentUser' => $currentUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if(count($currentUser->mediaFiles) > 0): ?>
                    <img src="/imagecache/avatar160/<?php echo e($currentUser->mediaFiles->first()->filename); ?>" class="user-image img-circle" alt="User Image">
                <?php else: ?>
                    <img src="/assets/imgs/user/user2-160x160.jpg" class="user-image" alt="User Image">
                <?php endif; ?>
            </div>
            <div class="pull-left info">
                <p><?php echo e($currentUser->last_name); ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="search" method="GET" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="searchterm" class="form-control" placeholder="Search...">
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
    <?php echo $__env->make('admin.layouts.partials.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php /* <h1>
        <?php echo e(Route::current()->getName()); ?>

        <small>	<?php echo e(Route::current()->getActionName()); ?></small>
    </h1> */ ?>
    <div class="row">

        <div class="col-xs-6">

            <ol class="breadcrumb">
                <li><a class="btn bg-olive btn-sm" href="<?php echo e(URL::previous()); ?>"><i class="fa fa-arrow-circle-left fa-lg"></i></a></li>
                <li><a class="btn bg-purple btn-sm" href="/admin/dashboard"><i class="fa fa-dashboard fa-lg"></i></a></li>
                <li class="active">Here</li>
            </ol>

        </div><!-- /.col-xs-6 -->
        <div class="col-xs-6">
            <?php /* <?php echo link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default pull-right']); ?> */ ?>

            <?php /* <a href="<?php echo e(URL::previous()); ?>"><i class="fa fa-arrow-circle-left pull-right bg-yellow"></i></a> */ ?>
        </div><!-- /.col-xs-6 -->

    </div><!-- /.row -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin.components.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
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
<?php $__env->startSection('footer-vendor'); ?>
    <?php /* Combined scripts for js libraries used throughout admin site */ ?>
    <script src="/js/vendor-scripts.js"></script>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('footer-plugin'); ?>

<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('footer-app'); ?>
    <?php /* <script>
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
</script> */ ?>
<script src="/themes/admin-lte/js/app.js"></script>
<?php /* <script src="/js/vue-ajax-form.js" ></script> */ ?>
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('footer-script'); ?>
<?php echo $__env->yieldSection(); ?>

</body>
</html>
