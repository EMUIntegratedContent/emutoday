<template>
  <div>
    <div v-if="!emailBuilderEmail.is_sent">
      <!-- PROGRESS BAR -->
      <div class="progress">
        <div class="progress-bar" :class="progress == 100 ? 'progress-done' : ''" role="progressbar"
             :aria-valuenow="progress"
             aria-valuemin="0" aria-valuemax="100" :style="'width:' + progress + '%'">
          <span v-if="progress < 100">{{ progress }}% Complete</span>
          <span v-else>I'm Ready!</span>
        </div>
      </div>
      <!-- SUCCESS/FAIL MESSAGES -->
      <div class="row">
        <div class="col-xs-12 col-sm-8">
          <div v-if="formMessage.isOk" class="alert alert-success alert-dismissible">
            <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
            <p>{{ formMessage.msg }}</p>
          </div>
          <div v-if="formMessage.isErr" class="alert alert-danger alert-dismissible">
            <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
            <p>The email could not be {{ newform ? 'created' : 'updated' }}. Please fix the following errors.</p>
            <ul v-if="formErrors">
              <li v-for="error in formErrors">{{ error }}</li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 text-right">
          <button class="btn btn-success" type="button" @click="submitForm">{{
              newform ? 'Create Email' : 'Update Email'
            }}
          </button>
          &nbsp;
          <button v-if="!newform" class="btn btn-warning" type="button" data-toggle="modal" data-target="#cloneModal">
            Clone Email
          </button>
        </div>
      </div>
      <!-- TABS: BUILD STEPS -->
      <ul class="nav nav-tabs" role="tablist">
        <li :class="{ 'active' : activeBuildTab == 1 }"><a href="#step-1" role="tab" data-toggle="tab"
                                                           @click="activeBuildTab = 1">Step 1: Basic Information</a>
        </li>
        <li :class="{ 'active' : activeBuildTab == 2 }"><a href="#step-2" role="tab" data-toggle="tab"
                                                           @click="activeBuildTab = 2">Step 2: Build Email</a></li>
        <li :class="{ 'active' : activeBuildTab == 3 }"><a href="#step-3" role="tab" data-toggle="tab"
                                                           @click="activeBuildTab = 3">Step 3: Schedule &amp; Review</a>
        </li>
      </ul>
      <!-- EMAIL FORM -->
      <form>
        <slot name="csrf"></slot>
        <div class="tab-content">
          <!-- MAIN TAB 1 CONTENT -->
          <div class="tab-pane active" id="step-1">
            <h2>Basic Email Information</h2>
            <div v-if="emailBuilderEmail.clone.length > 0" class="alert alert-info alert-dismissible">
              <p>This email was cloned from <a :href="'/admin/email/'+ emailBuilderEmail.clone[0].id +'/edit'">this
                email</a> on
                {{ emailBuilderEmail.created_at }}.</p>
            </div>
            <div class="form-group">
              <label for="email-title">Email Headline <span class="character-counter help-text invalid"
                                                            v-if="insufficientTitle">({{
                  minTitleChars - emailBuilderEmail.title.length
                }} characters left)</span></label>
              <input type="text" class="form-control" id="email-title"
                     v-bind:class="[formErrors.title ? 'invalid-input' : '']" v-model="emailBuilderEmail.title"
                     placeholder="Email headline goes here.">
              <p v-if="formErrors.title" class="help-text invalid">Title must be at least 10 characters in length.</p>
            </div>
            <div class="form-group">
              <label for="subheading">Subheading (optional)</label>
              <textarea class="form-control" id="subheading" v-model="emailBuilderEmail.subheading"></textarea>
            </div>
          </div>
          <!-- MAIN TAB 2 CONTENT -->
          <div class="tab-pane" id="step-2">
            <div class="row">
              <!-- EMAIL LIVE BUILDER VIEW AREA -->
              <!-- BUILDER TOOLS AREA -->
              <div v-bind:class="[md12col, lg5col]">
                <h2>Build Your Email</h2>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li :class="{ 'active' : activeSubTab === 1 }"><a href="#main-story" role="tab" data-toggle="tab"
                                                                   :class="(emailBuilderEmail.mainStories.length != 1 && emailBuilderEmail.mainStories.length != 3) ? 'insufficient' : ''"
                                                                   @click="activeSubTab = 1">Main
                    Stories ({{ emailBuilderEmail.mainStories.length }})</a></li>
                  <li :class="{ 'active' : activeSubTab === 2 }"><a href="#stories" role="tab" data-toggle="tab"
                                                                   :class="emailBuilderEmail.otherStories.length < 1 ? 'insufficient' : ''"
                                                                   @click="activeSubTab = 2">Side Stories ({{
                      emailBuilderEmail.otherStories.length
                    }})</a></li>
                  <li :class="{ 'active' : activeSubTab === 3 }"><a href="#announcements" role="tab" data-toggle="tab"
                                                                   :class="emailBuilderEmail.announcements.length < 1 ? 'insufficient' : ''"
                                                                   @click="activeSubTab = 3">Announcements ({{
                      emailBuilderEmail.announcements.length
                    }})</a></li>
                  <li :class="{ 'active' : activeSubTab === 4 }"><a href="#events" role="tab" data-toggle="tab"
                                                                   :class="emailBuilderEmail.events.length < 1 && !emailBuilderEmail.exclude_events ? 'insufficient' : ''"
                                                                   @click="activeSubTab = 4">Events
                    ({{ emailBuilderEmail.events.length }})</a>
                  </li>
                  <li :class="{ 'active' : activeSubTab === 5 }"><a href="#insidePosts" role="tab" data-toggle="tab"
                                                                   :class="emailBuilderEmail.insidePosts.length < 1 && !emailBuilderEmail.exclude_inside_posts ? 'insufficient' : ''"
                                                                   @click="activeSubTab = 5">Inside EMU
                    ({{ emailBuilderEmail.insidePosts.length }})</a>
                  </li>
                  <li :class="{ 'active' : activeSubTab === 6 }"><a href="#president" role="tab" data-toggle="tab"
                                                                   :class="emailBuilderEmail.is_president_included && (!emailBuilderEmail.president_url || !emailBuilderEmail.president_teaser) ? 'insufficient' : ''"
                                                                   @click="activeSubTab = 6">President</a>
                  </li>
                  <li :class="{ 'active' : activeSubTab === 7 }"><a href="#emu-175-email" role="tab" data-toggle="tab"
                                                                   :class="emailBuilderEmail.is_emu175_included && (!emailBuilderEmail.emu175_url || !emailBuilderEmail.emu175_teaser) ? 'insufficient' : ''"
                                                                   @click="activeSubTab = 7">EMU 175</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active" id="main-story">
                    <email-main-stories-queue
                        :stypes="stypes"
                    ></email-main-stories-queue>
                  </div>
                  <div class="tab-pane" id="stories">
                    <email-story-queue
                        :stypes="stypes"
                    ></email-story-queue>
                  </div>
                  <div class="tab-pane" id="announcements">
                    <email-announcement-queue></email-announcement-queue>
                  </div>
                  <div class="tab-pane" id="events">
                    <email-event-queue></email-event-queue>
                  </div>
                  <div class="tab-pane" id="insidePosts">
                    <email-inside-posts-queue></email-inside-posts-queue>
                  </div>
                  <div class="tab-pane" id="president">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="presidentIncl">Include the presidential section in this email?</label>
                          &nbsp;
                          <input
                              type="checkbox"
                              id="presIncl"
                              v-model="emailBuilderEmail.is_president_included"
                              :true-value="1"
                              :false-value="0"
                          >
                        </div><!-- /input-group -->
                      </div><!-- /.col-md-12 -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="presidentTeaser">Teaser text</label>
                          <textarea class="form-control" id="presidentTeaser"
                                    v-bind:class="[formErrors.president_teaser ? 'invalid-input' : '']"
                                    v-model="emailBuilderEmail.president_teaser">{{ emailBuilderEmail.president_teaser }}</textarea>
                          <p v-if="formErrors.president_teaser" class="help-text invalid">The teaser is required when
                            including a presidential message.</p>
                        </div>
                      </div><!-- /.col-md-12 -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="presidentUrl">URL to president's statement</label>
                          <input type="text" class="form-control" id="presidentUrl"
                                 v-bind:class="[formErrors.president_url ? 'invalid-input' : '']"
                                 v-model="emailBuilderEmail.president_url"
                                 placeholder="https://emich.edu/president-statement"/>
                          <p v-if="formErrors.president_url" class="help-text invalid">The URL field is not valid.</p>
                        </div>
                      </div><!-- /.col-md-12 -->
                    </div><!-- ./row -->
                  </div>
                  <div class="tab-pane" id="emu-175-email">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="presidentIncl">Include EMU 175th Anniversary information in this email?</label>
                          &nbsp;
                          <input
                              type="checkbox"
                              id="emu175Incl"
                              v-model="emailBuilderEmail.is_emu175_included"
                              :true-value="1"
                              :false-value="0"
                          >
                        </div><!-- /input-group -->
                      </div><!-- /.col-md-12 -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="emu175Teaser">Teaser text</label>
                          <textarea class="form-control" id="emu175Teaser"
                                    v-bind:class="[formErrors.emu175_teaser ? 'invalid-input' : '']"
                                    v-model="emailBuilderEmail.emu175_teaser">{{ emailBuilderEmail.emu175_teaser }}</textarea>
                          <p v-if="formErrors.emu175_teaser" class="help-text invalid">The teaser is required when
                            including EMU 175th Anniversary information.</p>
                        </div>
                      </div><!-- /.col-md-12 -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="emu175Url">URL to EMU 175 information</label>
                          <input type="text" class="form-control" id="emu175Url"
                                 v-bind:class="[formErrors.emu175_url ? 'invalid-input' : '']"
                                 v-model="emailBuilderEmail.emu175_url"
                          />
                          <p v-if="formErrors.emu175_url" class="help-text invalid">The URL field is not valid.</p>
                        </div>
                      </div><!-- /.col-md-12 -->
                    </div><!-- ./row -->
                  </div>
                </div>
              </div>
              <!-- /.medium-4 columns -->
              <!-- "LIVE VIEW" OF EMAIL -->
              <div v-bind:class="[md12col, lg7col]">
                <email-live-view></email-live-view>
              </div>
              <!-- /.medium-8 columns -->
            </div>
            <!-- /.row -->
          </div>
          <!-- MAIN TAB 3 CONTENT -->
          <div class="tab-pane" id="step-3">
            <h2>Schedule and Review</h2>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h3>When should this email be sent?</h3>
                <p>Checking the box next to the date picker will schedule the email for delivery at the date and time
                  chosen. In addition, this email must have all mandatory criteria (see checklists on this page) and
                  must
                  be approved.</p>
                <div class="input-group">
								<span class="input-group-addon">
									<input type="checkbox" v-model="emailBuilderEmail.is_approved" :true-value="1" :false-value="0"
                         aria-label="Set as time">
								</span>
                  <flatpickr
                      v-model="emailBuilderEmail.send_at"
                      id="send-at"
                      :config="flatpickrConfig"
                      class="form-control"
                      name="sendAt"
                  >
                  </flatpickr>
                </div><!-- /input-group -->
                <h3>To which mailing list(s) should this email be sent?</h3>
                <ul>
                  <li v-for="(recipient, i) in emailBuilderEmail.recipients" :key="'recip-'+i">
                    {{ recipient.email_address }}
                  </li>
                </ul>
                <label style="width: 300px">Select recipient(s)
                  <v-select id="minical"
                            v-model="emailBuilderEmail.recipients"
                            :options="recipientsList"
                            :multiple="true"
                            placeholder="Select recipient(s)"
                            label="email_address"
                  >
                  </v-select>
                </label>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="input-group" :class="successFailure">
											<span class="input-group-btn">
												<button class="btn btn-primary" type="button" @click.prevent="toggleAddRecipient">{{
                            showAddRecipient ? 'Hide me' : 'Add unlisted recipient'
                          }}</button>
											</span>
                      <input v-if="showAddRecipient" type="text" v-model="newRecipient" class="form-control"
                             placeholder="mailing_list@emich.edu">
                      <span v-if="showAddRecipient" class="input-group-btn">
												<button class="btn btn-default" type="button" @click.prevent="saveUnlistedRecipient"><i
                            class="fa fa-plus-square" aria-hidden="true"></i></button>
											</span>
                    </div><!-- /input-group -->
                    <p v-if="showAddRecipient && formErrors.email_address" class="help-text invalid">
                      {{ formErrors.email_address }}</p>
                    <p v-if="showAddRecipient && formSuccess.email_address" class="help-text valid">
                      {{ formSuccess.email_address }}</p>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h3>Mandatory Criteria Checklist</h3>
                <p>This email will not send unless all of the mandatory criteria are met. You may still save emails that
                  are not ready to be sent.</p>
                <ul class="list-group">
                  <li class="list-group-item"><i
                      :class="emailBuilderEmail.title ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email {{ emailBuilderEmail.title ? 'has' : 'does not have' }} a title.
                  </li>
                  <li class="list-group-item"><i
                      :class="emailBuilderEmail.mainStories.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email
                    {{ emailBuilderEmail.mainStories.length > 0 ? 'has' : 'does not have' }} a main
                    story.
                  </li>
                  <li class="list-group-item"><i
                      :class="emailBuilderEmail.mainStories.length == 2 ? 'fa fa-times-circle fa-3x' : 'fa fa-check-circle fa-3x'"
                      aria-hidden="true"></i> Email {{
                      emailBuilderEmail.mainStories.length == 2 ? 'only has 1 sub-main story (0 or 2 required)' : 'has 0 or 2 sub-main stories'
                    }}.
                  </li>
                  <li class="list-group-item"><i
                      :class="emailBuilderEmail.otherStories.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email
                    {{ emailBuilderEmail.otherStories.length > 0 ? 'has' : 'does not have' }} at
                    least one side story.
                  </li>
                  <li class="list-group-item">
                    <template v-if="emailBuilderEmail.exclude_events">
                      <i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
                      Events have been excluded from this email.
                    </template>
                    <template v-else>
                      <i
                          :class="emailBuilderEmail.events.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                          aria-hidden="true"></i> Email {{
                        emailBuilderEmail.events.length > 0 ? 'has' : 'does not have'
                      }} at
                      least one
                      event.
                    </template>
                  </li>
                  <li class="list-group-item"><i
                      :class="emailBuilderEmail.announcements.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email
                    {{ emailBuilderEmail.announcements.length > 0 ? 'has' : 'does not have' }} at
                    least one announcement.
                  </li>
                  <li class="list-group-item" v-if="emailBuilderEmail.is_emu175_included"><i
                      :class="emailBuilderEmail.emu175_teaser ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email {{ emailBuilderEmail.emu175_teaser ? 'has' : 'does not have' }}
                    teaser text
                    for the EMU 175 link.
                  </li>
                  <li class="list-group-item" v-if="emailBuilderEmail.is_emu175_included"><i
                      :class="emailBuilderEmail.emu175_url ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email {{ emailBuilderEmail.emu175_url ? 'has' : 'does not have' }} a
                    URL to the
                    for the EMU 175 link.
                  </li>
                  <li class="list-group-item" v-if="emailBuilderEmail.is_president_included"><i
                      :class="emailBuilderEmail.president_teaser ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email {{ emailBuilderEmail.president_teaser ? 'has' : 'does not have' }}
                    teaser text
                    for the message from the president.
                  </li>
                  <li class="list-group-item" v-if="emailBuilderEmail.is_president_included"><i
                      :class="emailBuilderEmail.president_url ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email {{ emailBuilderEmail.president_url ? 'has' : 'does not have' }} a
                    URL to the
                    message from the president.
                  </li>
                  <li class="list-group-item"><i
                      :class="emailBuilderEmail.recipients.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email {{
                      emailBuilderEmail.recipients.length > 0 ? 'has' : 'does not have'
                    }} at
                    least
                    one recipient.
                  </li>
                  <li class="list-group-item"><i
                      :class="emailBuilderEmail.is_approved && emailBuilderEmail.send_at ? 'fa fa-calendar fa-3x' : 'fa fa-times-circle fa-3x'"
                      aria-hidden="true"></i> Email send date and time {{
                      emailBuilderEmail.is_approved && emailBuilderEmail.send_at ? 'have' :
                          'have not'
                    }} been confirmed.
                  </li>
                </ul>
                <h3>Optional Criteria Checklist</h3>
                <ul class="list-group">
                  <li class="list-group-item"><i
                      :class="emailBuilderEmail.is_president_included ? 'fa fa-check-circle fa-3x' : 'fa fa-exclamation-triangle fa-3x'"
                      aria-hidden="true"></i> Email {{
                      emailBuilderEmail.is_president_included ? 'has' : 'does not have'
                    }} a
                    message
                    from the president.
                  </li>
                  <li class="list-group-item"><i
                      :class="emailBuilderEmail.subheading ? 'fa fa-check-circle fa-3x' : 'fa fa-exclamation-triangle fa-3x'"
                      aria-hidden="true"></i> Email {{ emailBuilderEmail.subheading ? 'has' : 'does not have' }} a
                    subheading.
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.row -->
            <div class="row" v-if="existingEmail">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <!-- Trigger the delete modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete Email
                </button>
              </div>
            </div>
            <!-- /.row -->
          </div>
        </div>
      </form><!-- /end form -->
    </div><!-- end if !emailBuilderEmail.is_sent -->
    <div v-else>
      <div class="row">
        <div v-bind:class="[md12col, lg4col]">
          <h2>This email has already been sent!</h2>
          <h3>Sent</h3>
          <p>{{ formatDate(emailBuilderEmail.send_at) }}</p>
          <h3>Recipients</h3>
          <template v-if="emailBuilderEmail.recipients.length > 0">
            <ul>
              <li v-for="recipient in emailBuilderEmail.recipients">{{ recipient.email_address }}</li>
            </ul>
          </template>
          <template v-else>
            <p>Nobody</p>
          </template>
          <h3>Statistics</h3>
          <p>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#statsModal"><span
                class="fa fa-bar-chart" aria-hidden="true"></span> View Statistics
            </button>
          </p>
          <h3>Actions</h3>
          <p>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete Email
            </button>
          </p>
        </div>
        <!-- /.medium-4 columns -->
        <div v-bind:class="[md12col, lg8col]">
          <email-live-view></email-live-view>
        </div>
        <!-- /.medium-8 columns -->
      </div>
      <!-- /.row -->
    </div>
    <email-delete-modal></email-delete-modal>
    <email-stats-modal></email-stats-modal>
    <email-clone-modal></email-clone-modal>
  </div>
</template>

<style scoped>
.redBtn {
  background: hsl(0, 90%, 70%);
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
  color: #3c8dbc;
}

.nav-tabs a.disabled {
  color: #d2d6de;
}

.tab-pane {
  padding-top: 20px;
}

.insufficient {
  color: hsl(0, 90%, 70%) !important;
}

.progress-done {
  background-color: #3D9970 !important;
}

.fa-check-circle, .fa-calendar {
  color: #3D9970;
}

.fa-times-circle {
  color: hsl(0, 90%, 70%);
}

.fa-exclamation-triangle {
  color: #FFCC00;
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
import "vue-select/dist/vue-select.css"
import vSelect from 'vue-select'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { Sortable } from "sortablejs-vue3"
import EmailMainStoriesQueue from './EmailMainStoriesQueue.vue'
import EmailStoryQueue from './EmailStoryQueue.vue'
import { emailMixin } from './email_mixin'
import EmailAnnouncementQueue from './EmailAnnouncementQueue.vue'
import EmailEventQueue from './EmailEventQueue.vue'
import EmailInsidePostsQueue from './EmailInsidePostsQueue.vue'
import EmailDeleteModal from './EmailDeleteModal.vue'
import EmailStatsModal from './EmailStatsModal.vue'
import EmailCloneModal from './EmailCloneModal.vue'
import EmailLiveView from './EmailLiveView.vue'

export default {
  components: {
    vSelect,
    flatpickr,
    Sortable,
    EmailMainStoriesQueue,
    EmailStoryQueue,
    EmailAnnouncementQueue,
    EmailEventQueue,
    EmailInsidePostsQueue,
    EmailLiveView,
    EmailDeleteModal,
    EmailStatsModal,
    EmailCloneModal
  },
  mixins: [emailMixin],
  props: {
    cuserRoles: { default: {} },
    errors: {
      default: ''
    },
    recordexists: {
      default: false
    },
    recordid: {
      default: ''
    },
    framework: {
      default: 'bootstrap'
    },
    user: {
      default: ''
    },
    stypes: {
      default: []
    }
  },
  data () {
    return {
      activeBuildTab: 1,
      activeSubTab: 1,
      sendtimes: [],
      formErrors: {},
      formSuccess: {
        email_address: [],
      },
      minTitleChars: 10, // minimum title characters allowed
      formInputs: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      newform: false,
      recipientsList: [],
      recordState: '',
      currentRecordId: null,
      totalChars: {
        title: 50,
      },
      userRoles: [],
      sendAtdatePicker: null,
      showAddRecipient: false,
      newRecipient: null,
      existingEmail: false, // set to the value of prop recordexisits; updatable so as not to manipulte prop recordexists
      flatpickrConfig: {
        altFormat: "m/d/Y h:i K", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d H:i:S", // format sumbitted to the API
        enableTime: true
      },
      iterator: 0
    }
  },
  created: function () {
    if (this.recordexists) {
      this.fetchCurrentEmail(this.recordid)
      this.existingEmail = true
    }
    else {
      this.newform = true
    }

    this.fetchRecipientsList()
  },
  computed: {
    // switch classes based on css framework. foundation or bootstrap
    md5col: function () {
      return (this.framework == 'foundation' ? 'medium-5 columns' : 'col-md-5')
    },
    md6col: function () {
      return (this.framework == 'foundation' ? 'medium-6 columns' : 'col-md-6')
    },
    md7col: function () {
      return (this.framework == 'foundation' ? 'medium-7 columns' : 'col-md-7')
    },
    md12col: function () {
      return (this.framework == 'foundation' ? 'medium-12 columns' : 'col-md-12')
    },
    md8col: function () {
      return (this.framework == 'foundation' ? 'medium-8 columns' : 'col-md-8')
    },
    md4col: function () {
      return (this.framework == 'foundation' ? 'medium-4 columns' : 'col-md-4')
    },
    lg5col: function () {
      return (this.framework == 'foundation' ? 'large-5 columns' : 'col-lg-5')
    },
    lg6col: function () {
      return (this.framework == 'foundation' ? 'large-6 columns' : 'col-lg-6')
    },
    lg7col: function () {
      return (this.framework == 'foundation' ? 'large-7 columns' : 'col-lg-7')
    },
    lg12col: function () {
      return (this.framework == 'foundation' ? 'large-12 columns' : 'col-lg-12')
    },
    lg8col: function () {
      return (this.framework == 'foundation' ? 'large-8 columns' : 'col-lg-8')
    },
    lg4col: function () {
      return (this.framework == 'foundation' ? 'large-4 columns' : 'col-lg-4')
    },
    btnPrimary: function () {
      return (this.framework == 'foundation' ? 'button button-primary' : 'btn btn-primary')
    },
    btnSecondary: function () {
      return (this.framework == 'foundation' ? 'button button-secondary' : 'btn btn-link')
    },
    formGroup: function () {
      return (this.framework == 'foundation' ? 'form-group' : 'form-group')
    },
    formControl: function () {
      return (this.framework == 'foundation' ? '' : 'form-control')
    },
    calloutSuccess: function () {
      return (this.framework == 'foundation') ? 'callout success' : 'alert alert-success'
    },
    calloutFail: function () {
      return (this.framework == 'foundation') ? 'callout alert' : 'alert alert-danger'
    },
    iconStar: function () {
      return (this.framework == 'foundation' ? 'fi-star ' : 'fa fa-star')
    },
    inputGroupLabel: function () {
      return (this.framework == 'foundation') ? 'input-group-label' : 'input-group-addon'
    },
    insufficientTitle: function () {
      if (this.emailBuilderEmail.title && this.emailBuilderEmail.title.length < this.minTitleChars) {
        return true;
      }
      return false;
    },
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
    // Progress of email bulider (adds up to 100%)
    progress: function () {
      let progress = 0

      let steps = 9 // there are anywhere from 7 to 11 steps in the email builder
      if(this.emailBuilderEmail.is_president_included) {
        steps += 1
      }
      if(this.emailBuilderEmail.is_emu175_included) {
        steps += 1
      }
      if(this.emailBuilderEmail.exclude_events) {
        steps -= 1
      }
      if(this.emailBuilderEmail.exclude_inside_posts) {
        steps -= 1
      }

      // TODO finish this and get rid of all the commented out code below when done
      const stepValue = 100 / steps
      this.emailBuilderEmail.title ? progress += stepValue : ''

      return progress
      // // Normal (NO presidential message, with events, NO EMU 175)
      // if (!this.emailBuilderEmail.is_president_included && !this.emailBuilderEmail.exclude_events && !this.emailBuilderEmail.is_emu175_included) {
      //   this.emailBuilderEmail.title ? progress += 13 : ''
      //   this.emailBuilderEmail.mainStories.length == 1 || this.emailBuilderEmail.mainStories.length == 3 ? progress += 15 : ''
      //   this.emailBuilderEmail.events.length > 0 ? progress += 15 : ''
      //   this.emailBuilderEmail.announcements.length > 0 ? progress += 15 : ''
      //   this.emailBuilderEmail.otherStories.length > 0 ? progress += 15 : ''
      //   this.emailBuilderEmail.recipients.length > 0 ? progress += 14 : ''
      //   this.emailBuilderEmail.send_at && this.emailBuilderEmail.is_approved ? progress += 13 : ''
      // }
      // // Presidential message, with events, NO EMU 175
      // else if (this.emailBuilderEmail.is_president_included && !this.emailBuilderEmail.exclude_events && !this.emailBuilderEmail.is_emu175_included) {
      //   this.emailBuilderEmail.title ? progress += 12 : ''
      //   this.emailBuilderEmail.mainStories.length == 1 || this.emailBuilderEmail.mainStories.length == 3 ? progress += 15 : ''
      //   this.emailBuilderEmail.events.length > 0 ? progress += 11 : ''
      //   this.emailBuilderEmail.announcements.length > 0 ? progress += 11 : ''
      //   this.emailBuilderEmail.otherStories.length > 0 ? progress += 11 : ''
      //   this.emailBuilderEmail.recipients.length > 0 ? progress += 11 : ''
      //   this.emailBuilderEmail.send_at && this.emailBuilderEmail.is_approved ? progress += 13 : ''
      //   this.emailBuilderEmail.president_teaser ? progress += 8 : ''
      //   this.emailBuilderEmail.president_url ? progress += 8 : ''
      // }
      // // Presidential message, NO events, NO EMU 175
      // else if (this.emailBuilderEmail.is_president_included && this.emailBuilderEmail.exclude_events && !this.emailBuilderEmail.is_emu175_included) {
      //   this.emailBuilderEmail.title ? progress += 13 : ''
      //   this.emailBuilderEmail.mainStories.length == 1 || this.emailBuilderEmail.mainStories.length == 3 ? progress += 15 : ''
      //   this.emailBuilderEmail.announcements.length > 0 ? progress += 15 : ''
      //   this.emailBuilderEmail.otherStories.length > 0 ? progress += 15 : ''
      //   this.emailBuilderEmail.recipients.length > 0 ? progress += 15 : ''
      //   this.emailBuilderEmail.send_at && this.emailBuilderEmail.is_approved ? progress += 15 : ''
      //   this.emailBuilderEmail.president_teaser ? progress += 6 : ''
      //   this.emailBuilderEmail.president_url ? progress += 6 : ''
      // }
      // // Presidential message, with events, WITH EMU 175
      // else if(this.emailBuilderEmail.is_president_included && !this.emailBuilderEmail.exclude_events && this.emailBuilderEmail.is_emu175_included) {
      //   this.emailBuilderEmail.title ? progress += 14 : ''
      //   this.emailBuilderEmail.mainStories.length == 1 || this.emailBuilderEmail.mainStories.length == 3 ? progress += 12 : ''
      //   this.emailBuilderEmail.events.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.announcements.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.otherStories.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.recipients.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.send_at && this.emailBuilderEmail.is_approved ? progress += 10 : ''
      //   this.emailBuilderEmail.president_teaser ? progress += 6 : ''
      //   this.emailBuilderEmail.president_url ? progress += 6 : ''
      //   this.emailBuilderEmail.emu175_teaser ? progress += 6 : ''
      //   this.emailBuilderEmail.emu175_url ? progress += 6 : ''
      // }
      // // Presidential message, NO events, WITH EMU 175
      // else if(this.emailBuilderEmail.is_president_included && this.emailBuilderEmail.exclude_events && this.emailBuilderEmail.is_emu175_included) {
      //   this.emailBuilderEmail.title ? progress += 14 : ''
      //   this.emailBuilderEmail.mainStories.length == 1 || this.emailBuilderEmail.mainStories.length == 3 ? progress += 14 : ''
      //   this.emailBuilderEmail.announcements.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.otherStories.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.recipients.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.send_at && this.emailBuilderEmail.is_approved ? progress += 10 : ''
      //   this.emailBuilderEmail.president_teaser ? progress += 8 : ''
      //   this.emailBuilderEmail.president_url ? progress += 8 : ''
      //   this.emailBuilderEmail.emu175_teaser ? progress += 8 : ''
      //   this.emailBuilderEmail.emu175_url ? progress += 8 : ''
      // }
      // // NO Presidential message, with events, WITH EMU 175
      // else if(!this.emailBuilderEmail.is_president_included && !this.emailBuilderEmail.exclude_events && this.emailBuilderEmail.is_emu175_included) {
      //   this.emailBuilderEmail.title ? progress += 14 : ''
      //   this.emailBuilderEmail.mainStories.length == 1 || this.emailBuilderEmail.mainStories.length == 3 ? progress += 15 : ''
      //   this.emailBuilderEmail.events.length > 0 ? progress += 13 : ''
      //   this.emailBuilderEmail.announcements.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.otherStories.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.recipients.length > 0 ? progress += 10 : ''
      //   this.emailBuilderEmail.send_at && this.emailBuilderEmail.is_approved ? progress += 10 : ''
      //   this.emailBuilderEmail.emu175_teaser ? progress += 9 : ''
      //   this.emailBuilderEmail.emu175_url ? progress += 9 : ''
      // }
      // // NO Presidential message, NO events, WITH EMU 175
      // else if(!this.emailBuilderEmail.is_president_included && this.emailBuilderEmail.exclude_events && this.emailBuilderEmail.is_emu175_included) {
      //   this.emailBuilderEmail.title ? progress += 15 : ''
      //   this.emailBuilderEmail.mainStories.length == 1 || this.emailBuilderEmail.mainStories.length == 3 ? progress += 15 : ''
      //   this.emailBuilderEmail.announcements.length > 0 ? progress += 12 : ''
      //   this.emailBuilderEmail.otherStories.length > 0 ? progress += 12 : ''
      //   this.emailBuilderEmail.recipients.length > 0 ? progress += 12 : ''
      //   this.emailBuilderEmail.send_at && this.emailBuilderEmail.is_approved ? progress += 12 : ''
      //   this.emailBuilderEmail.emu175_teaser ? progress += 12 : ''
      //   this.emailBuilderEmail.emu175_url ? progress += 10 : ''
      // }
      // // NO presidential message, NO events, NO EMU 175
      // else if (!this.emailBuilderEmail.is_president_included && this.emailBuilderEmail.exclude_events && !this.emailBuilderEmail.is_emu175_included) {
      //   this.emailBuilderEmail.title ? progress += 16 : ''
      //   this.emailBuilderEmail.mainStories.length == 1 || this.emailBuilderEmail.mainStories.length == 3 ? progress += 17 : ''
      //   this.emailBuilderEmail.announcements.length > 0 ? progress += 17 : ''
      //   this.emailBuilderEmail.otherStories.length > 0 ? progress += 17 : ''
      //   this.emailBuilderEmail.recipients.length > 0 ? progress += 17 : ''
      //   this.emailBuilderEmail.send_at && this.emailBuilderEmail.is_approved ? progress += 16 : ''
      // }
      //
      // return progress
    },
    successFailure: function () {
      return {
        'has-success': this.formSuccess.email_address != '',
        'has-error': this.formErrors.email_address
      }
    },
  },

  methods: {
    fetchCurrentEmail: function (recid) {
      this.resetEmailBuilderEmail()
      this.$http.get('/api/email/' + recid + '/edit')
      .then((response) => {
        this.setEmailBuilderEmail(response.data.newdata.data)
      }).catch((e) => {
        this.formErrors = e.response.data.error.message;
      });
    },

    fetchRecipientsList: function () {
      this.$http.get('/api/email/recipients')
      .then((response) => {
        this.recipientsList = response.data.newdata
      }).catch((e) => {
        this.formErrors = e.response.data.error.message;
      });
    },

    nowOnReload: function () {
      let newurl = '/admin/email/' + this.currentRecordId + '/edit';
      document.location = newurl;
    },

    onRefresh: function () {
      this.recordId = this.currentRecordId;
      this.existingEmail = true;
      this.fetchCurrentEmail(this.currentRecordId);
    },

    submitForm: function () {
      $('html, body').animate({ scrollTop: 0 }, 'fast');

      // Decide route to submit form to
      let method = (this.existingEmail) ? 'put' : 'post'
      let route = (this.existingEmail) ? '/api/email/' + this.emailBuilderEmail.id : '/api/email';

      // Submit form.
      this.$http[method](route, this.emailBuilderEmail) //

      // Do this when response gets back.
      .then((response) => {
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = true; // Success message
        this.formMessage.isErr = false;
        this.currentRecordId = response.data.newdata.data.id;
        this.existingEmail = true;
        this.formErrors = {}; // Clear errors

        if (this.newform) {
          this.nowOnReload();
        }
        else {
          this.onRefresh();
        }
      }).catch((e) => {
        this.formMessage.isOk = false;
        this.formMessage.isErr = true;
        this.formErrors = e.response.data.error.message;
      })
    },

    /**
     * Save a previously unlisted email address to the mailinglists database table
     */
    saveUnlistedRecipient: function () {
      let method = 'post'
      let route = '/api/email/recipients';

      let recipientObj = { email_address: this.newRecipient }

      // Submit form.
      this.$http[method](route, recipientObj)

      // Do this when response gets back.
      .then((response) => {
        this.formSuccess.email_address = [] //clear form success
        this.formErrors = {}
        this.formSuccess.email_address.push(response.data.message) //create success message

        this.fetchRecipientsList() //get updated list of recipients
      }).catch((e) => {
        this.formSuccess.email_address = []
        this.formErrors = e.response.data.error.message;
      })
    },

    toggleCallout: function (evt) {
      this.formMessage.isOk = false
      this.formMessage.isErr = false
    },

    /**
     * Controls if add recipient fiels are shown
     */
    toggleAddRecipient: function () {
      this.showAddRecipient ? this.showAddRecipient = false : this.showAddRecipient = true
      this.formSuccess.email_address = []
      this.formErrors = {}
      this.newRecipient = null
    },
    formatDate: function (date) {
      if (date) {
        return moment(date).format("LLLL")
      }
    }
  }
};

</script>
