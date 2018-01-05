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
          <p v-if="!disableClone">Are you sure you want to clone "{{ email.title }}"?</p>
          <div v-show="cloneStatus.is_set && cloneStatus.is_success"  class="alert" :class="'alert-' + [cloneStatus.is_success ? 'success' : 'danger']">
            <p>{{{ cloneStatus.message }}}</p>
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
export default {
  directives: {},
  components: {},
  props: ['email'],
  data: function() {
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
      this.$http.post('/api/email/clone', this.email)
      .then((response) =>{
        this.disableClone = true
        this.cloneStatus.is_set = true
        this.cloneStatus.message = response.data.message + ' <a href="/admin/email/' + response.data.newdata.data.id + '/edit">Go now.</a>'
      }, (response) => {
        this.disableClone = true
        this.cloneStatus.is_set = true
        this.cloneStatus.is_success = false
        this.cloneStatus.message = 'There was a problem cloning this email. Please notify a site admin.'
      }).bind(this);
    },
    resetModal: function(){
      this.cloneStatus.is_set = false
      this.cloneStatus.message = null
      this.cloneStatus.is_success = true
      this.disableClone = false
    },
  },
  filters: {

  },
  events: {

  },
  watch: {

  },
}
</script>
