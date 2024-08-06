<template>
  <v-form ref="ideaForm" @submit.prevent="submitPreflight">
    <v-card class="mb-3">
      <v-card-text>
        <p><strong>Submission Guidelines</strong></p>
        <ul>
          <li>Submissions must involve an official EMU unit or have a direct connection to the University.</li>
          <li>Entries must be received by <mark>Tuesday at noon</mark> in order to be considered for inclusion in <span style="font-style: italic">The Week at EMU</span> email, which comes out on Wednesday.</li>
          <li>Keep all entries concise (500 words maximum).</li>
          <li>Include a descriptive headline; date, time, and place; a brief description of the event, award, or story; any deadlines or RSVP dates; and a contact name and email address.</li>
          <li>Do not include job openings or solicitations or fundraising requests.</li>
          <li>All content is intended for EMU employees. The final decision to publish your submission is at the discretion of the editor.</li>
        </ul>
      </v-card-text>
    </v-card>
    <v-card class="mb-3">
      <v-toolbar title="Submission Information" color="grey-darken-3" density="compact"></v-toolbar>
      <template v-if="!idea.submitted_at">
        <v-card-text class="pb-2">
          <v-row>
            <v-col cols="12">
              <v-alert
                  v-if="idea.created_at"
                  density="compact"
                  type="info"
                  class="mb-4"
              >This is a draft. Please click the "Confirm Submission" button to finalize your entry.</v-alert>
              <v-text-field
                  v-model="idea.title"
                  variant="outlined"
                  density="compact"
                  :rules="[v => !!v || 'Headline is required']"
                  @update:modelValue="formModified = true"
              >
                <template #label>
                  Headline <span class="text-error">*</span>
                </template>
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <v-textarea
                    v-model="idea.content"
                    variant="outlined"
                    density="compact"
                    persistent-hint
                    :hint="`${contentWords}/500 words`"
                    :rules="wordLimitRule.concat(requiredRule)"
                    @update:modelValue="formModified = true"
                >
                  <template #label>
                    Submission Body <span class="text-error">*</span>
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
            <v-col cols="12">
              <v-checkbox
                  v-model="idea.use_other_source"
                  label="Credit another source for this idea"
                  density="compact"
                  hide-details
                  :true-value="1"
                  :false-value="0"
                  @update:modelValue="formModified = true">
              </v-checkbox>
              <v-text-field
                  v-if="idea.use_other_source"
                  v-model="idea.other_source"
                  variant="outlined"
                  density="compact"
                  persistent-hint
                  hint="By default, you will be credited for this submission. If you would like to credit another source, please provide that here."
                  :rules="[v => !!v || 'Other source is required. If you do not wish to credit another source, please uncheck the box above.']"
                  @update:modelValue="formModified = true">
                <template #label>
                  Other Source <span class="text-error">*</span>
                </template>
              </v-text-field>
            </v-col>
          </v-row>
          <InsideemuIdeaImages @imagesUpdated="formModified = true" :editMode="true"></InsideemuIdeaImages>
          <v-alert v-if="formModified && !showSuccess && !errSaving" type="info" color="warning" density="compact" class="my-2">You have unsaved changes.</v-alert>
          <v-alert v-if="errSaving" type="error" density="compact" class="my-2">Your submission could not be saved.</v-alert>
          <v-alert v-if="showSuccess" type="success" density="compact" class="my-2">Your submission has been saved.</v-alert>
        </v-card-text>
        <v-card-actions>
          <v-btn
              type="submit"
              variant="elevated"
              id="submitBtn"
              color="#036937"
              class="mr-2"
              :loading="savingIdea"
          >Confirm Submission
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
              <div class="mb-3">
                <strong>Credit</strong>
                <br>
                <span v-if="idea.use_other_source && idea.other_source">{{ idea.other_source}}</span>
                <span v-else>{{ idea.contributor_fullname }}</span>
              </div>
              <p>
                Note: Submissions are subject to review and may be edited for clarity and length. Entries are not editable once submitted.
              </p>
            </v-col>
          </v-row>
          <InsideemuIdeaImages></InsideemuIdeaImages>
        </v-card-text>
      </template>
    </v-card>
  </v-form>
</template>

<script>
import store from '../../../vuex/insideemu_store'
// import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"
import { ckeditorInsideemuMixin } from '../../ckeditor_insideemu_config'
import { slashdate } from '../../filters'
import InsideemuIdeaImages from './InsideemuIdeaImages.vue'

export default {
  mixins: [ckeditorInsideemuMixin],
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
    InsideemuIdeaImages,
    flatpickr,
    insideemu_store: store
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
      errSaving: false,
      formModified: false,
      loadingIdea: false,
      originalIdea: null,
      savingDraft: null,
      savingIdea: false,
      showSuccess: false,
      wordLimitRule: [
        v => v.split(' ').length <= 500 || 'Must be 500 words or fewer.'
      ],
      requiredRule: [
        v => !!v || 'This field is required.'
      ]
    }
  },
  computed: {
    ...mapState(['idea']),
    // Use spaces and hyphens to count words (mirrors Laravel's str_word_count)
    contentWords () {
      if(!this.idea || !this.idea.content) return 0
      return this.idea.content.split(' ').length - 1
    }
  },
  methods: {
    slashdate,
    ...mapMutations(['setIdea', 'setIdeaProp', 'setIdeaImagsForUpload']),
    async fetchIdea () {
      this.loadingIdea = true
      let routeurl = '/api/insideemu/ideas/user/' + this.ideaid

      await this.$http.get(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.originalIdea = JSON.parse(JSON.stringify(r.data))
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
      this.$refs.ideaForm.resetValidation() // resets validation
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
        if(!confirm('Are you sure you are ready to submit this entry? Submissions are not editable once submitted.')) return
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
      const data = new FormData()
      data.append('idea', JSON.stringify(this.idea))
      data.append('saveType', saveType)

      // Attach any new images to the form data
      this.idea.images.forEach((image, index) => {
        // New images have a temporary ID starting with 'new-'. Existing images are just numbers.
        if (typeof image.id === 'string' && image.id.startsWith('new-')) {
          data.append(`images[${index}]`, image.file);
          data.append(`descriptions[${index}]`, image.description);
        }
      });

      // Laravel doesn't like handing FormData in PUT methods.
      // To get around this, always submit as POST, but add _method=PUT to the end of the route
      const httpVerb = this.idea.ideaId && this.idea.ideaId != 0 ? 'put' : 'post'
      const routeurl = httpVerb === 'put' ? `/api/insideemu/ideas/user/${this.idea.ideaId}?_method=PUT` : '/api/insideemu/ideas/user'

      await this.$http.post(routeurl, data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then((r) => {
        // Send new submissions to the edit form
        if(httpVerb === 'post') {
          window.location.href = '/insideemu/ideas/' + r.data.ideaId + '/edit'
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
        this.savingIdea = false
        this.savingDraft = false
        this.errSaving = true
      })
    }
  }
}
</script>
<style scoped>

</style>
