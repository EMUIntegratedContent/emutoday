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

            <!-- /.messages-menu -->
            <?php if (app('Illuminate\Contracts\Auth\Access\Gate')->check('super', $currentUser)): ?>
                <?php echo $__env->make('admin.layouts.partials.notifications.bugz', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('admin.layouts.partials.notifications.events', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('admin.layouts.partials.notifications.announcements', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('admin.layouts.partials.notifications.storys', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        <?php echo $__env->make('admin.layouts.partials.usermenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Control Sidebar Toggle Button -->
<li>
    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
</li>
</ul>
</div>
</nav>
