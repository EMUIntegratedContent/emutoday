<template>
  <!-- Modal -->
  <div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete email</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete "{{ emailBuilderEmail.title }}"? Type the word <strong>"delete"</strong> to
            confirm.</p>
          <div class="form-group">
            <label for="deleteConfirm" class="sr-only" aria-hidden="true">Type "confirm" to delete</label>
            <input type="text" v-model="deleteConfirm" class="form-control" id="deleteConfirm"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" @click="delEmail"
                  :disabled="deleteConfirm != 'delete'">Delete Email
          </button>
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
  mixins: [emailMixin],
  data: function () {
    return {
      deleteConfirm: null,
    }
  },
  methods: {
    delEmail: function () {
      // word 'delete' must be typed in modal
      if (this.deleteConfirm == 'delete') {
        this.deleteConfirm = null; // reset delete text
        this.$http.delete('/api/email/' + this.emailBuilderEmail.id)
        .then(() => {
          window.location.href = "/admin/email"
        }).catch((e) => {
          console.log(e)
        })
      }
    },
  }
}
</script>
