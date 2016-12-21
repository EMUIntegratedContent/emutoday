<?php $__env->startSection('meta'); ?>
<!-- flatpickr styles -->
<link rel="stylesheet" href="/css/flatpickr.min.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="content-area">
  <div id="listing-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <div class="row">
          <div style='float:left' class="medium-6 columns">
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
          <!--  -->
          <div class="medium-6 columns float-right">
            <div class="row">
              <div class="small-12 column">
                <h3 class="cal-caps toptitle">Your Submitted Events</h3>
                <table id="user-events-submitted-table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="text-left">Title</th>
                      <th class="text-left">Start Date</th>
                      <th class="text-left">End Date</th>
                      <th class="text-left">Submitted</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>item</td>
                      <td>item</td>
                      <td>item</td>
                      <td>item</td>
                    </tr>
                    <?php if ( ! (empty($submitteditems))): ?>
                    <?php foreach($submitteditems as $item): ?>
                    <tr>
                      <td><?php echo e($item->title); ?></td>
                      <td><?php /* $item->start_date->toFormattedDateString() */ ?></td>
                      <td><?php /* $item->end_date->toFormattedDateString() */ ?></td>
                      <td><?php /* $item->submission_date->toFormattedDateString() */ ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div><!-- /.small-12 column -->
            </div><!-- /.row -->
            <div class="row">
              <div class="small-12 column">
                <h3 class="cal-caps toptitle">Your Approved Announcements</h3>
                <table id="user-events-approved-table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="text-left">Title</th>
                      <th class="text-left">Start Date</th>
                      <th class="text-left">End Date</th>
                      <th class="text-left">Approved</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ( ! (empty($submitteditems))): ?>
                    <?php foreach($approveditems as $item): ?>
                    <tr>
                      <td><?php echo e($item->title); ?></td>
                      <td><?php /* $item->start_date->toFormattedDateString() */ ?></td>
                      <td><?php /* $item->end_date->toFormattedDateString() */ ?></td>
                      <td><?php /* $item->approved_date->toFormattedDateString() */ ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div><!-- /.small-12 column -->
            </div><!-- /.row -->
          </div><!-- /.medium-6 column -->
          <!-- End right side 'Your Announcements' -->
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="/js/flatpickr.min.js"></script>
<script type="text/javascript" src="/js/vendor/vue.js"></script>
<script>
// This is were we init our datetimepicker
new Flatpickr(document.getElementById('start-date'));
new Flatpickr(document.getElementById('end-date'));

// The Vue object
new Vue ({
  // Mount the form element
  el: '#announcement_form',
  data: {
    record: {
      title: '',
      announcement: '',
      link_txt: '',
      email_link_txt: '',
    },
    totalChars: {
      // Set the max character length for field, will be used in calculations.
      title: 50,
      announcement: 255,
    },
  },
  computed: {
    titleChars: function() {
      // Calculate title field character length
      var str = this.record.title;
      var totalchars = this.totalChars.title;
      var cclength = str.length;
      return totalchars- cclength;
    },
    announcementChars: function() {
      // Calculate announcement field character length
      var str = this.record.announcement;
      var totalchars = this.totalChars.announcement;
      var cclength = str.length;
      return totalchars- cclength;
    },
  }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>