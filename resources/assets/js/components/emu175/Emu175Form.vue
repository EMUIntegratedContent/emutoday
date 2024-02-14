<template>
  <div>
    <div>
      <h1>EMU 175 Homepage Manager</h1>
      <p>Select which story or event will display on the front page of EMU Today.</p>
      <section id="emu-175-container">
        <div class="row" id="main-story">
          <div class="col-xs-12">
            <h2 class="subhead-title">Main Story</h2>
            <!--            <page-substory-->
            <!--                story-number="0"-->
            <!--                :story="slotStories.main_story"-->
            <!--                :stypes="stypes"-->
            <!--                @modal-data-loaded="handleSubstoryLoaded"-->
            <!--                @sub-story-swapped="handleSwap"-->
            <!--            ></page-substory>-->
          </div>
          <!-- SUCCESS/FAIL MESSAGES -->
          <div class="col-xs-12">
            <div v-if="formMessage.isOk" class="alert alert-success alert-dismissible">
              <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
              <p>{{ formMessage.msg }}</p>
            </div>
            <div v-if="formMessage.isErr" class="alert alert-danger alert-dismissible">
              <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
              <p>The information could not be updated. Please fix the following
                errors.</p>
              <ul v-if="formErrors">
                <li v-for="error in formErrors">{{ error }}</li>
              </ul>
            </div>
          </div>
          <div class="col-xs-12">
            <button class="btn btn-success" type="button" @click="submitForm">
              Update EMU 175 Info
            </button>
          </div>
        </div>
      </section><!-- end #emu-175-container -->
    </div><!-- /end root element -->
    <!--    <page-delete-modal-->
    <!--        :page="record"-->
    <!--    ></page-delete-modal>-->
  </div>
</template>

<style scoped>
.progress-done {
  background-color: #3D9970 !important;
}

.valid {
  color: #3c763d;
}

.invalid {
  color: #ff0000;
}

.valid-titleField {
  background-color: #fefefe;
  border-color: #cacaca;
}

.no-input {
  background-color: #fefefe;
  border-color: #cacaca;
}

.invalid-input {
  background-color: rgba(236, 88, 64, 0.1);
  border: 1px dotted red;
}
</style>

<script>
import moment from 'moment'
// import PageSubstory from './PageSubstory.vue'
// import PageDeleteModal from './PageDeleteModal.vue'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

export default {
  components: {
    // PageSubstory,
    // PageDeleteModal,
    flatpickr
  },
  props: {
    framework: {
      default: 'bootstrap'
    },
    user: {
      default: ''
    }
  },
  data: function () {
    return {
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      userRoles: []
    }
  },
  created: function () {
    if (this.recordexists) {
      this.fetchCurrentPage(this.recordid)
    }
  },
  computed: {
    isAdmin: function () {
      if (this.userRoles.indexOf('admin') != -1) {
        return true;
      }
      else {
        if (this.userRoles.indexOf('admin_super') != -1) {
          return true;
        }
        else {
          return false;
        }
      }
    },

    // Progress of page bulider (adds up to 100%)
    progress: function () {
      let progress = 0

      this.record.start_date ? progress += 14 : ''
      this.record.end_date ? progress += 14 : ''
      this.slotStories.main_story ? progress += 16 : ''
      this.slotStories.sub_story_1 ? progress += 14 : ''
      this.slotStories.sub_story_2 ? progress += 14 : ''
      this.slotStories.sub_story_3 ? progress += 14 : ''
      this.slotStories.sub_story_4 ? progress += 14 : ''

      return progress
    },
  },

  methods: {
    fetchCurrentPage: function (recid) {
      this.$http.get('/api/page/' + recid + '/edit')
      .then((response) => {
        this.record = response.data.newdata.data
      }).catch((e) => {
        this.formErrors = e.response.data.error.message
      })
    },
    // nowOnReload: function () {
    //   let newurl = '/admin/page/' + this.currentRecordId + '/edit'
    //   document.location = newurl
    // },
    // onRefresh: function () {
    //   this.recordId = this.currentRecordId
    //   this.fetchCurrentPage(this.currentRecordId)
    // },
    // submitForm: function () {
    //   $('html, body').animate({ scrollTop: 0 }, 'fast');
    //
    //   // Decide route to submit form to
    //   let method = (this.recordexists) ? 'put' : 'post'
    //   let route = (this.recordexists) ? '/api/page/' + this.record.id : '/api/page';
    //
    //   // Submit form.
    //   this.$http[method](route,
    //       {
    //         page: this.record,
    //         stories: this.slotStories
    //       }
    //   )
    //   .then((response) => {
    //     this.formMessage.msg = response.data.message
    //     this.formMessage.isOk = true // Success message
    //     this.formMessage.isErr = false
    //     this.currentRecordId = response.data.newdata.data.id
    //     this.formErrors = {}; // Clear errors
    //     if (this.newpage) {
    //       this.nowOnReload();
    //     }
    //     else {
    //       this.onRefresh();
    //     }
    //   }).catch((e) => {
    //     console.log(e)
    //     this.formMessage.isOk = false;
    //     this.formMessage.isErr = true;
    //   })
    // },

    toggleCallout: function (evt) {
      this.formMessage.isOk = false
      this.formMessage.isErr = false
    }
  }
};

</script>
