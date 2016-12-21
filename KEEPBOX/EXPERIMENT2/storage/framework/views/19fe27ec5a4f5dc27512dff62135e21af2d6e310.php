<!-- User Account Menu -->
<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->

        <?php if(count($currentUser->mediaFiles) > 0): ?>
            <img src="/imagecache/avatar160/<?php echo e($currentUser->mediaFiles->first()->filename); ?>" class="user-image" alt="User Image">
        <?php else: ?>
            <img src="/assets/imgs/user/user2-160x160.jpg" class="user-image" alt="User Image">
        <?php endif; ?>


        <?php /* <img src="<?php echo e($currentUser->mediaFiles->); ?>" class="user-image" alt="User Image"> */ ?>

        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs"><?php echo e($currentUser->last_name); ?></span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
            <?php if(count($currentUser->mediaFiles) > 0): ?>
                <img src="/imagecache/avatar160/<?php echo e($currentUser->mediaFiles->first()->filename); ?>" class="img-circle" alt="User Image">
            <?php else: ?>
                <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image">
            <?php endif; ?>

            <p>
                <?php echo e($currentUser->first_name); ?> <?php echo e($currentUser->last_name); ?>


                <small><?php echo e($currentUser->roles->pluck('name')); ?></small>
            </p>
        </li>
        <!-- Menu Body -->

<!-- Menu Footer-->
<li class="user-footer bg-purple">
    <div class="pull-left">
        <a href="/admin/user/<?php echo e($currentUser->id); ?>" class="btn btn-default btn-flat">Profile</a>
    </div>
    <div class="pull-right">
        <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
    </div>
</li>
</ul>
</li>
