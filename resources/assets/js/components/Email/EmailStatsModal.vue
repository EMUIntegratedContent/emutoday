<template>
  <!--STATS MODAL-->
  <div id="statsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Email basic statistics</h4>
        </div>
        <div class="modal-body">
          <ul>
            <li><strong>Title:</strong> {{ emailBuilderEmail.title }}</li>
            <li><strong>Sent At:</strong> {{ formatDate(emailBuilderEmail.send_at) }}</li>
          </ul>
          <div class="row text-center">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <h5 class="email-statistic">Opens</h5>
              <span class="email-statistic">{{ emailBuilderEmail.mailgun_opens }}</span>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <h5 class="email-statistic">Clicks</h5>
              <span class="email-statistic">{{ emailBuilderEmail.mailgun_clicks }}</span>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <h5 class="email-statistic">Marked as Spam</h5>
              <span class="email-statistic">{{ emailBuilderEmail.mailgun_spam }}</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-xs-12 col-sm-8">
              <p>For more complete statistcs, log in to <a href="https://app.mailgun.com" target="_blank">Mailgun</a></p>
            </div>
            <div class="col-xs-12 col-sm-4 text-right">
              <button type="button" id="closeBtn" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!--/end modal-->
</template>
<style scoped>
  .statistic{
    font-size: 2rem;
  }
</style>
<script>
import { emailMixin } from './email_mixin'
import moment from 'moment'
export default {
  mixins: [ emailMixin ],
  methods: {
    formatDate: function(value) {
      if (value) {
        return moment(String(value)).format('ddd MM/DD/YYYY @ h:mm A')
      }
    }
  }
}
</script>
