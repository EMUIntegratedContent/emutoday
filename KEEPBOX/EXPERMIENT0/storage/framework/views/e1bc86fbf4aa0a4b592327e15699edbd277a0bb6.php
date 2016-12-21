<?php $__env->startSection('content'); ?>
<div id="content-area">
  <div id="listing-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <div id="title-grouping" class="row">
          <div class="large-5 medium-7 small-12 columns  noleftpadding"><h3 class="news-caps">Announcements <!-- <a class="smaller-title" href="">[ RSS feed ]</a> --></h3></div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12">

            <?php if ( ! (empty($announcements))): ?>
            <ul class="accordion" data-accordion role="tablist">
              <?php foreach($announcements as $announcement): ?>
              <li class="accordion-navigation">
                <a href="#panel<?php echo e($announcement->id); ?>d" role="tab" id="panel1d-heading" aria-controls="panel<?php echo e($announcement->id); ?>d"><?php echo e($announcement->title); ?></a>
                <div id="panel<?php echo e($announcement->id); ?>d" class="content" role="tabpanel" aria-labelledby="panel<?php echo e($announcement->id); ?>d-heading">
                  <p><?php echo e($announcement->announcement); ?></p>
                  <?php if($announcement->link): ?>
                  <p>For more information visit: <a href="http://<?php echo e($announcement->link); ?>" class="accordion-link" target="_blank"><?php echo e(isset($announcement->link_txt) ? $announcement->link_txt : 'More Info'); ?></a></p>
                  <?php endif; ?>
                  <?php if($announcement->email_link): ?>
                  <p>For more information click: <a href="mailto://<?php echo e($announcement->email_link); ?>" class="accordion-link" target="_blank"><?php echo e(isset($announcement->email_link_txt) ? $announcement->email_link_txt : $announcement->email_link); ?></a></p>
                  <?php endif; ?>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php else: ?> <!-- No announcements? Display this: -->
            <p>There are no announcements at this time.</p>
            <?php endif; ?>

            <div id="base-grouping" class="row">
              <div class="large-5 medium-7 hide-for-small columns">&nbsp;</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>   <!--end content area-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>