<template>
  <!-- Modal -->
  <div id="cloneModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Clone email</h4>
        </div>
        <div class="modal-body">
          <p v-if="!disableClone">Are you sure you want to clone "{{ emailBuilderEmail.title }}"?</p>
          <div v-if="cloneStatus.is_set && cloneStatus.is_success"  class="alert" :class="'alert-' + [cloneStatus.is_success ? 'success' : 'danger']">
            <p v-html="cloneStatus.message"></p>
          </div>
        </div>
        <div class="modal-footer">
          <template v-if="!disableClone">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" @click="cloneEmail">Clone</button>
          </template>
          <template v-else>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>

</style>
<script>
import { emailMixin } from './email_mixin'
export default {
  mixins: [ emailMixin ],
  data() {
    return {
      cloneStatus: {
        'is_set': false,
        'message': null,
        'is_success': true,
      },
      disableClone: false,
    }
  },
  ready: function() {

  },
  computed: {

  },
  methods: {
    cloneEmail: function() {
      this.$http.post('/api/email/clone', this.emailBuilderEmail)
      .then((response) =>{
        this.disableClone = true
        this.cloneStatus.is_set = true
        this.cloneStatus.message = response.data.message + ' <a href="/admin/email/' + response.data.newdata.id + '/edit">Go now.</a>'
      }).catch(() => {
        this.disableClone = true
        this.cloneStatus.is_set = true
        this.cloneStatus.is_success = false
        this.cloneStatus.message = 'There was a problem cloning this email. Please notify a site admin.'
      })
    },
    resetModal: function(){
      this.cloneStatus.is_set = false
      this.cloneStatus.message = null
      this.cloneStatus.is_success = true
      this.disableClone = false
    },
  }
}
</script>
