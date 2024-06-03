<template>
  <v-form ref="ideaForm" @submit.prevent="submitPreflight">
    <v-card class="mb-3">
      <v-toolbar title="Submission Information" color="grey-darken-3" density="compact"></v-toolbar>
      <template v-if="!idea.is_submitted">
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <v-alert
                  v-if="idea.created_at"
                  density="compact"
                  type="info"
                  class="mb-3"
              >This is a draft. Please click the "Submit Idea" button to finalize your idea.</v-alert>
              <v-text-field
                  v-model="idea.title"
                  variant="outlined"
                  density="compact"
                  :rules="[v => !!v || 'Title is required']"
                  @update:modelValue="formModified = true"
              >
                <template #label>
                  Title <span class="text-error">*</span>
                </template>
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                  v-model="idea.teaser"
                  variant="outlined"
                  density="compact"
                  label="Teaser"
                  @update:modelValue="formModified = true"
              >
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <v-textarea
                  v-model="idea.content"
                  variant="outlined"
                  density="compact"
                  :rules="[v => !!v || 'Content is required']"
                  @update:modelValue="formModified = true"
              >
                <template #label>
                  Your idea <span class="text-error">*</span>
                </template>
              </v-textarea>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                  v-model="idea.contributor_first"
                  variant="outlined"
                  density="compact"
                  :rules="[v => !!v || 'Your first name is required']"
                  @update:modelValue="formModified = true"
              >
                <template #label>
                  Your First Name <span class="text-error">*</span>
                </template>
              </v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                  v-model="idea.contributor_last"
                  variant="outlined"
                  density="compact"
                  :rules="[v => !!v || 'Your last name is required']"
                  @update:modelValue="formModified = true"
              >
                <template #label>
                  Your Last Name <span class="text-error">*</span>
                </template>
              </v-text-field>
            </v-col>
          </v-row>
          <p v-if="formModified && !showSuccess && !errSaving" class="text-error">You have unsaved changes.</p>
          <p v-if="errSaving" class="text-error">Error saving your idea.</p>
          <p v-if="showSuccess" class="text-success">Your idea has been saved.</p>
        </v-card-text>
        <v-card-actions>
          <v-btn
              type="submit"
              variant="elevated"
              id="submitBtn"
              color="#036937"
              class="mr-2"
              :loading="savingIdea"
          >Submit Idea
          </v-btn>
          <v-btn
              type="submit"
              variant="outlined"
              id="draftBtn"
              color="#036937"
              class="mr-2"
              :loading="savingDraft"
          >Save As Draft
          </v-btn>
          <v-btn
              v-if="formModified"
              type="button"
              color="grey-darken-3"
              variant="outlined"
              @click="resetForm"
          >Reset Changes
          </v-btn>
        </v-card-actions>
      </template>
      <template v-else>
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <v-alert class="mb-3" color="#036937" density="compact">Submitted on
                {{ slashdate(idea.created_at) }}
              </v-alert>
              <p>
                <strong>Suggested Title</strong>
                <br>{{ idea.title }}
              </p>
              <p v-if="idea.teaser">
                <strong>Suggested Teaser</strong>
                <br>{{ idea.teaser }}
              </p>
              <div class="mb-3">
                <strong>Suggested Content</strong>
                <br>
                <span v-html="idea.content"></span>
              </div>
              <p>
                Note: Submitted ideas are subject to review and may be edited for clarity and length. Ideas are not editable once submitted.
              </p>
            </v-col>
          </v-row>
          <!--        <IntcommIdeaImages :mode="mode"></IntcommIdeaImages>-->
        </v-card-text>
      </template>
    </v-card>
  </v-form>
</template>

<script>
import store from '../../../vuex/intcomm_store'
// import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"
import { ckeditorIntcommMixin } from '../../ckeditor_intcomm_config'
import { slashdate } from '../../filters'
// import IntcommPostImages from './IntcommPostImages.vue'

export default {
  mixins: [ckeditorIntcommMixin],
  props: {
    netid: {
      type: String,
      required: true
    },
    ideaid: {
      type: String,
      required: false
    }
  },
  components: {
    // IntcommPostImages,
    flatpickr,
    intcomm_store: store
  },
  created () {
    if (this.ideaid) {
      this.fetchIdea()
    }
    else {
      this.setIdeaProp({ prop: 'contributor_netid', value: this.netid })
      this.originalIdea = JSON.parse(JSON.stringify(this.idea))
    }
  },
  data: function () {
    return {
      // currentDate: moment(),
      // flatpickrConfig: {
      //   altFormat: "m/d/Y h:i K", // format the user sees
      //   altInput: true,
      //   dateFormat: "Y-m-d H:i:S", // format sumbitted to the API
      //   enableTime: true
      // },
      errSaving: false,
      formModified: false,
      loadingIdea: false,
      originalIdea: null,
      savingDraft: null,
      savingIdea: false,
      showSuccess: false
      // wordLimit: 700
    }
  },
  computed: {
    ...mapState(['idea'])
  },
  methods: {
    slashdate,
    ...mapMutations(['setIdea', 'setIdeaProp']),
    async fetchIdea () {
      this.loadingIdea = true
      let routeurl = '/api/intcomm/ideas/user/' + this.ideaid

      await this.$http.get(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.originalIdea = JSON.parse(JSON.stringify(this.idea))
        this.loadingIdea = false
      })
      .catch(() => {
        this.isErr = true
        this.errorMsg = 'Error fetching idea.'
      })
    },
    resetForm () {
      this.setIdea(JSON.parse(JSON.stringify(this.originalIdea)))
      this.originalIdea = JSON.parse(JSON.stringify(this.idea))
      this.formModified = false
    },
    async submitPreflight (evt) {
      const btnId = evt.submitter.id // determine whether submitting or saving a draft
      let saveType = 'submit'
      this.errSaving = false
      if (btnId === 'submitBtn') {
        // Non-draft submissions require full validation
        const { valid } = await this.$refs.ideaForm.validate()
        if(!valid) {
          alert('Please fill out all required fields.')
          return
        }
        if(!confirm('Are you sure you are ready to submit this idea? Ideas are not editable once submitted.')) return
        this.savingIdea = true
      } else {
        if(!this.idea.title || !this.idea.contributor_first || !this.idea.contributor_last) {
          alert('Saving as a draft requires at least: Title, Your First Name, and Your Last Name.')
          return
        }
        saveType = 'draft'
        this.savingDraft = true
      }
      await this.saveIdea(saveType)
    },
    async saveIdea (saveType) {
      // // Assuming `fileInput` is an input element with type="file"
      // let fileInput = document.querySelector('#file-input');
      // let files = fileInput.files;
      //
      // for (let i = 0; i < files.length; i++) {
      //   formData.append('images[]', files[i]);
      // }

      const data = new FormData()
      data.append('idea', JSON.stringify(this.idea))
      data.append('saveType', saveType)

      // Laravel doesn't like handing FormData in PUT methods.
      // To get around this, always submit as POST, but add _method=PUT to the end of the route
      const httpVerb = this.idea.ideaId && this.idea.ideaId != 0 ? 'put' : 'post'
      const routeurl = httpVerb === 'put' ? `/api/intcomm/ideas/user/${this.idea.ideaId}?_method=PUT` : '/api/intcomm/ideas/user'

      await this.$http.post(routeurl, data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then((r) => {
        // Send new submissions to the edit form
        if(httpVerb === 'post') {
          window.location.href = '/intcomm/ideas/' + r.data.ideaId + '/edit'
        } else {
          this.setIdea(r.data)
          this.originalIdea = JSON.parse(JSON.stringify(this.idea))
        }
        this.savingIdea = false
        this.savingDraft = false
        this.formModified = false
        this.showSuccess = true
        setTimeout(() => {
          this.showSuccess = false
        }, 2000)
      })
      .catch(() => {
        this.errSaving = true
      })
    }
  }
}
</script>
<style scoped>

</style>
