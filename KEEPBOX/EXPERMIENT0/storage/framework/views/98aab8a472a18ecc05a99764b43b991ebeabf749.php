<?php $__env->startSection('content'); ?>
<div id="content-area">
  <div id="listing-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <div id="title-grouping" class="row">
          <div class="large-5 medium-7 small-12 columns  noleftpadding"><h3 class="news-caps">Announcements <a class="smaller-title" href="">[ RSS feed ]</a></h3></div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12">
            <?php if ( ! (empty($announcements))): ?>
            <!-- <ul class="accordion" data-accordion role="tablist">
              <li class="accordion-navigation active">
                <a href="#panel1d" role="tab" id="panel1d-heading" aria-controls="panel1d">Human Resources Office will be Closed August 26</a>
                <div id="panel1d" class="content" role="tabpanel" aria-labelledby="panel1d-heading">
                  The Human Resources Office, located in 140 McKenny Hall will be closed for part of the day today, Aug. 26, from 8 a.m. to 12:30 p.m. for an off-site office function. The office will resume operation at 12:30 p.m.
                </div>
              </li>

              <li class="accordion-navigation">
                <a href="#panel2d" role="tab" id="panel2d-heading" aria-controls="panel2d">President's Welcome Picnic - Sep. 9</a>
                <div id="panel2d" class="content" role="tabpanel" aria-labelledby="panel2d-heading">
                  EMU Interim President, Provost and Executive Vice President of Academic and Student Affairs Kim Schatzel invites all members of the EMU community to enjoy a FREE welcome picnic on Wednesday, Sept. 9 from 11:30 a.m. to 1:30 p.m. on the north side of Welch Hall. During the event, guests will be invited to tour the new offices in McKenny Hall. <a href="">Learn More</a>
                </div>
              </li>
            </ul> -->
            <?php else: ?> <!-- No announcements? Display this: -->
              <p>There are no announcements at this time</p>
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