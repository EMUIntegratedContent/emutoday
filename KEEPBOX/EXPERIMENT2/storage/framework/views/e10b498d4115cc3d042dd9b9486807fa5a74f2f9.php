<?php $__env->startSection('content'); ?>
<div id="content-area">
  <div id="listing-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <div id="title-grouping" class="row">
          <div class="large-5 medium-7 small-12 columns  noleftpadding"><h3 class="news-caps">News Headlines <a class="smaller-title" href="">[ RSS feed ]</a></h3></div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12">

            <!-- News feed will go here -->
            <ul class="news-headlines">
              <li><div class="publish-date">Aug 31, 2015</div><a href="story.html">The imaginary test story title goes here</a></li>
            </ul>
            <!-- News feed will go here -->

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