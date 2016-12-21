<?php $__env->startSection('meta'); ?>
<!-- flatpickr styles -->
<link rel="stylesheet" href="/css/flatpickr.min.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="medium-6 columns float-left">
  <h3 class="cal-caps toptitle">Announcements</h3>
  <div>
    <?php if ( ! (empty($success))): ?>
    <!-- On success -->
    <div data-alert class="alert-box success radius">
      The Announcement has been submitted.
      <a href="#" class="close">&times;</a>
    </div>
    <?php endif; ?>

    <?php echo $__env->make('components.AnnouncementForm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  </div><!-- /.medium-6 columns -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php echo $__env->make('components.announcementFormControls', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>