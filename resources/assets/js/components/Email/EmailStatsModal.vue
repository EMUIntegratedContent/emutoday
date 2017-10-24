<template>
  <!--STATS MODAL-->
  <div id="statsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Email statistics</h4>
        </div>
        <div class="modal-body">
          <p>{{ email.title }} basic statistics.</p>
          <ul>
            <li>{{ email.send_at }}</li>
          </ul>
          <div class="row text-center">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <h5>Opens</h5>
              {{ email.mailgun_opens }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <h5>Clicks</h5>
              {{ email.mailgun_clicks }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <h5>Marked as Spam</h5>
              {{ email.mailgun_spam }}
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-xs-12 col-sm-8">
              <p>For more complete statistcs, log in to <a href="https://app.mailgun.org" target="_blank">Mailgun</a></p>
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

</style>
<script>
export default {
  directives: {},
  components: {},
  props: ['email'],
  data: function() {
    return {
      deleteConfirm: null,
    }
  },
  ready: function() {

  },
  computed: {

  },
  methods: {

  },
  filters: {

  },
  events: {

  },
  watch: {

  },
}
</script>
