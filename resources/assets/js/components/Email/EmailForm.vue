<template>
	<div>
		<div v-if="!record.is_sent">
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
					<div v-show="formMessage.isOk" class="alert alert-success alert-dismissible">
						<button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
						<p>{{formMessage.msg}}</p>
					</div>
					<div v-show="formMessage.isErr" class="alert alert-danger alert-dismissible">
						<button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
						<p>The email could not be {{ newform ? 'created' : 'updated' }}. Please fix the following errors.</p>
						<ul v-if="formErrors">
							<li v-for="error in formErrors">{{error}}</li>
						</ul>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 text-right">
					<button class="btn btn-success" type="button" @click="submitForm">{{ newform ? 'Create Email' : 'Update Email' }}
					</button>
					<button v-if="!newform" class="btn btn-warning" type="button" data-toggle="modal" data-target="#cloneModal">
						Clone Email
					</button>
				</div>
			</div>
			<!-- TABS: BUILD STEPS -->
			<ul class="nav nav-tabs" role="tablist">
				<li :class="{ 'active' : activeBuildTab == 1 }"><a href="#step-1" role="tab" data-toggle="tab" @click="activeBuildTab = 1">Step 1: Basic Information</a></li>
				<li :class="{ 'active' : activeBuildTab == 2 }"><a href="#step-2" role="tab" data-toggle="tab" @click="activeBuildTab = 2">Step 2: Build Email</a></li>
				<li :class="{ 'active' : activeBuildTab == 3 }"><a href="#step-3" role="tab" data-toggle="tab" @click="activeBuildTab = 3">Step 3: Schedule &amp; Review</a></li>
			</ul>
			<!-- EMAIL FORM -->
			<form>
				<slot name="csrf"></slot>
				<div class="tab-content">
					<!-- MAIN TAB 1 CONTENT -->
					<div class="tab-pane active" id="step-1">
						<h2>Basic Email Information</h2>
						<div v-if="record.clone.length > 0" class="alert alert-info alert-dismissible">
							<p>This email was cloned from <a :href="'/admin/email/'+ record.clone[0].id +'/edit'">this email</a> on {{ record.created_at }}.</p>
						</div>
						<div class="form-group">
							<label for="email-title">Email Headline <span class="character-counter help-text invalid"
																														v-if="insufficientTitle">({{ minTitleChars - record.title.length }} characters left)</span></label>
							<input type="text" class="form-control" id="email-title"
										 v-bind:class="[formErrors.title ? 'invalid-input' : '']" v-model="record.title"
										 placeholder="Email headline goes here.">
							<p v-if="formErrors.title" class="help-text invalid">Title must be at least 10 characters in length.</p>
						</div>
						<div class="form-group">
              <label for="subheading">Subheading (optional)</label>
              <textarea class="form-control" id="subheading" v-model="record.subheading"></textarea>
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
									<li :class="{ 'active' : activeSubTab == 1 }"><a href="#main-story" role="tab" data-toggle="tab"
																				:class="(record.mainStories.length != 1 && record.mainStories.length != 3) ? 'insufficient' : ''" @click="activeSubTab = 1">Main
										Stories ({{ record.mainStories.length }})</a></li>
									<li :class="{ 'active' : activeSubTab == 2 }"><a href="#stories" role="tab" data-toggle="tab"
												 :class="record.otherStories.length < 1 ? 'insufficient' : ''" @click="activeSubTab = 2">Side Stories ({{
										record.otherStories.length }})</a></li>
									<li :class="{ 'active' : activeSubTab == 3 }"><a href="#announcements" role="tab" data-toggle="tab"
												 :class="record.announcements.length < 1 ? 'insufficient' : ''" @click="activeSubTab = 3">Announcements ({{
										record.announcements.length }})</a></li>
									<li :class="{ 'active' : activeSubTab == 4 }"><a href="#events" role="tab" data-toggle="tab"
												 :class="record.events.length < 1 && !record.exclude_events ? 'insufficient' : ''" @click="activeSubTab = 4">Events ({{ record.events.length }})</a>
									</li>
									<li :class="{ 'active' : activeSubTab == 5 }"><a href="#president" role="tab" data-toggle="tab"
												 :class="record.is_president_included && (!record.president_url || !record.president_teaser) ? 'insufficient' : ''" @click="activeSubTab = 5">President</a>
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane active" id="main-story">
                    <email-main-stories-queue
                        :stypes="stypes"
                        :main-stories="record.mainStories"
                        @main-story-added="handleMainStoryAdded"
                        @main-story-removed="handleMainStoryRemoved"
                        @updated-main-story-order="updateMainStoriesOrder"
                    ></email-main-stories-queue>
									</div>
									<div class="tab-pane" id="stories">
                    <email-story-queue
                        :stypes="stypes"
                        :other-stories="record.otherStories"
                        @other-story-added="handleOtherStoryAdded"
                        @other-story-removed="handleOtherStoryRemoved"
                        @updated-other-story-order="updateOtherStoriesOrder"
                    ></email-story-queue>
									</div>
									<div class="tab-pane" id="announcements">
<!--																			<email-announcement-queue-->
<!--																					:announcements="record.announcements"-->
<!--																					@announcement-added="handleAnnouncementAdded"-->
<!--																					@announcement-removed="handleAnnouncementRemoved"-->
<!--																					@updated-announcement-order="updateAnnouncementsOrder"-->
<!--																			></email-announcement-queue>-->
									</div>
									<div class="tab-pane" id="events">
<!--																			<email-event-queue-->
<!--																					:events="record.events"-->
<!--																					:exclude-events-checked="record.exclude_events"-->
<!--																					@event-added="handleEventAdded"-->
<!--																					@event-removed="handleEventRemoved"-->
<!--																					@updated-event-order="updateEventsOrder"-->
<!--																					@toggle-exclude-events="handleToggleExcludeEvents"-->
<!--																			></email-event-queue>-->
									</div>
									<div class="tab-pane" id="president">
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label>
														Include the presidential section in this email? <input type="checkbox"
																																									 v-model="record.is_president_included">
													</label>
												</div><!-- /input-group -->
											</div><!-- /.col-md-12 -->
											<div class="col-xs-12">
												<div class="form-group">
													<label>Teaser text
                            <textarea class="form-control" id="presidentTeaser"
                                      v-bind:class="[formErrors.president_teaser ? 'invalid-input' : '']"
                                      v-model="record.president_teaser">{{ record.president_teaser }}</textarea>
                          </label>
													<p v-if="formErrors.president_teaser" class="help-text invalid">The teaser is required when
														including a presidential message.</p>
												</div>
											</div><!-- /.col-md-12 -->
											<div class="col-xs-12">
												<div class="form-group">
													<label>URL to president's statement
													<input type="text" class="form-control" id="presidentUrl"
																 v-bind:class="[formErrors.president_url ? 'invalid-input' : '']"
																 v-model="record.president_url" placeholder="https://emich.edu/president-statement"/>
                          </label>
													<p v-if="formErrors.president_url" class="help-text invalid">The URL field is not valid.</p>
												</div>
											</div><!-- /.col-md-12 -->
										</div><!-- ./row -->
									</div>
								</div>
							</div>
							<!-- /.medium-4 columns -->
							<!-- "LIVE VIEW" OF EMAIL -->
							<div v-bind:class="[md12col, lg7col]">
<!--									<email-live-view-->
<!--											:email="record"-->
<!--											:announcements="record.announcements"-->
<!--											:events="record.events"-->
<!--											:other-stories="record.otherStories"-->
<!--											:main-stories="record.mainStories"-->
<!--									></email-live-view>-->
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
									chosen. In addition, this email must have all mandatory criteria (see checklists on this page) and must
									be approved.</p>
								<div class="input-group">
								<span class="input-group-addon">
									<input type="checkbox" v-model="record.is_approved" aria-label="Set as time">
								</span>
                <flatpickr
                    v-model="record.send_at"
                    id="send-at"
                    :config="flatpickrConfig"
                    class="form-control"
                    name="sendAt"
                >
                </flatpickr>
								</div><!-- /input-group -->
								<h3>To which mailing list(s) should this email be sent?</h3>
								<ul>
									<li v-for="recipient in record.recipients">{{ recipient.email_address }}</li>
								</ul>
								<label style="width: 300px">Select recipient(s)
									<v-select id="minical"
														v-model="record.recipients"
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
												<button class="btn btn-primary" type="button" @click.prevent="toggleAddRecipient">{{ showAddRecipient ? 'Hide me' : 'Add unlisted recipient' }}</button>
											</span>
											<input v-show="showAddRecipient" type="text" v-model="newRecipient" class="form-control"
														 placeholder="mailing_list@emich.edu">
											<span v-show="showAddRecipient" class="input-group-btn">
												<button class="btn btn-default" type="button" @click.prevent="saveUnlistedRecipient"><i
														class="fa fa-plus-square" aria-hidden="true"></i></button>
											</span>
										</div><!-- /input-group -->
										<p v-show="showAddRecipient && formErrors.email_address" class="help-text invalid">{{ formErrors.email_address }}</p>
										<p v-show="showAddRecipient && formSuccess.email_address" class="help-text valid">{{ formSuccess.email_address }}</p>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h3>Mandatory Criteria Checklist</h3>
								<p>This email will not send unless all of the mandatory criteria are met. You may still save emails that
									are not ready to be sent.</p>
								<ul class="list-group">
									<li class="list-group-item"><i
											:class="record.title ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
											aria-hidden="true"></i> Email {{ record.title ? 'has' : 'does not have' }} a title.
									</li>
									<li class="list-group-item"><i
											:class="record.mainStories.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
											aria-hidden="true"></i> Email {{ record.mainStories.length > 0 ? 'has' : 'does not have' }} a main
										story.
									</li>
									<li class="list-group-item"><i
											:class="record.mainStories.length == 2 ? 'fa fa-times-circle fa-3x' : 'fa fa-check-circle fa-3x'"
											aria-hidden="true"></i> Email {{ record.mainStories.length == 2 ? 'only has 1 sub-main story (0 or 2 required)' : 'has 0 or 2 sub-main stories' }}.
									</li>
									<li class="list-group-item"><i
											:class="record.otherStories.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
											aria-hidden="true"></i> Email {{ record.otherStories.length > 0 ? 'has' : 'does not have' }} at
										least one side story.
									</li>
									<li class="list-group-item">
										<template v-if="record.exclude_events">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											Events have been excluded from this email.
										</template>
										<template v-else>
											<i
													:class="record.events.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
													aria-hidden="true"></i> Email {{ record.events.length > 0 ? 'has' : 'does not have' }} at least one
											event.
										</template>
									</li>
									<li class="list-group-item"><i
											:class="record.announcements.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
											aria-hidden="true"></i> Email {{ record.announcements.length > 0 ? 'has' : 'does not have' }} at
										least one announcement.
									</li>
									<li class="list-group-item" v-if="record.is_president_included"><i
											:class="record.president_teaser ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
											aria-hidden="true"></i> Email {{ record.president_teaser ? 'has' : 'does not have' }} teaser text
										for the message from the president.
									</li>
									<li class="list-group-item" v-if="record.is_president_included"><i
											:class="record.president_url ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
											aria-hidden="true"></i> Email {{ record.president_url ? 'has' : 'does not have' }} a URL to the
										message from the president.
									</li>
									<li class="list-group-item"><i
											:class="record.recipients.length > 0 ? 'fa fa-check-circle fa-3x' : 'fa fa-times-circle fa-3x'"
											aria-hidden="true"></i> Email {{ record.recipients.length > 0 ? 'has' : 'does not have' }} at least
										one recipient.
									</li>
									<li class="list-group-item"><i
											:class="record.is_approved && record.send_at ? 'fa fa-calendar fa-3x' : 'fa fa-times-circle fa-3x'"
											aria-hidden="true"></i> Email send date and time {{ record.is_approved && record.send_at ? 'have' :
										'have not' }} been confirmed.
									</li>
								</ul>
								<h3>Optional Criteria Checklist</h3>
								<ul class="list-group">
									<li class="list-group-item"><i
											:class="record.is_president_included ? 'fa fa-check-circle fa-3x' : 'fa fa-exclamation-triangle fa-3x'"
											aria-hidden="true"></i> Email {{ record.is_president_included ? 'has' : 'does not have' }} a message
										from the president.
									</li>
									<li class="list-group-item"><i
											:class="record.subheading ? 'fa fa-check-circle fa-3x' : 'fa fa-exclamation-triangle fa-3x'"
											aria-hidden="true"></i> Email {{ record.subheading ? 'has' : 'does not have' }} a subheading.
									</li>
								</ul>
							</div>
						</div>
						<!-- /.row -->
						<div class="row" v-show="existingEmail">
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
		</div><!-- end if !record.is_sent -->
		<div v-else>
			<div class="row">
				<div v-bind:class="[md12col, lg4col]">
					<h2>This email has already been sent!</h2>
					<h3>Sent</h3>
					<p>{{ record.send_at | formatDate }}</p>
					<h3>Recipients</h3>
					<template v-if="record.recipients.length > 0">
						<ul>
							<li v-for="recipient in record.recipients">{{ recipient.email_address }}</li>
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
<!--					<email-live-view-->
<!--							:email="record"-->
<!--							:announcements="record.announcements"-->
<!--							:events="record.events"-->
<!--							:other-stories="record.otherStories"-->
<!--							:main-stories="record.mainStories"-->
<!--					></email-live-view>-->
				</div>
				<!-- /.medium-8 columns -->
			</div>
			<!-- /.row -->
		</div>
<!--		<email-delete-modal-->
<!--				:email="record"-->
<!--		></email-delete-modal>-->
<!--		<email-stats-modal-->
<!--				:email="record"-->
<!--		></email-stats-modal>-->
<!--		<email-clone-modal-->
<!--				:email="record"-->
<!--		></email-clone-modal>-->
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
    import {Sortable} from "sortablejs-vue3"
		import EmailMainStoriesQueue from './EmailMainStoriesQueue.vue'
		import EmailStoryQueue from './EmailStoryQueue.vue'
		// import EmailEventQueue from './EmailEventQueue.vue'
		// import EmailAnnouncementQueue from './EmailAnnouncementQueue.vue'
		// import EmailDeleteModal from './EmailDeleteModal.vue'
		// import EmailStatsModal from './EmailStatsModal.vue'
		// import EmailCloneModal from './EmailCloneModal.vue'
		// import EmailLiveView from './EmailLiveView.vue'

		export default {
			components: {
        vSelect,
        flatpickr,
        Sortable,
        EmailMainStoriesQueue,
        EmailStoryQueue,
        // EmailEventQueue,
        // EmailAnnouncementQueue,
        // EmailLiveView,
        // EmailDeleteModal,
        // EmailStatsModal,
        // EmailCloneModal,
        // DatePicker
      },
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
			data: function () {
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
					record: {
						id: '',
						clone: [],
						created_at: null,
						exclude_events: 0,
						is_approved: false,
						is_president_included: false,
						is_ready: false,
						mailgun_clicks: 0,
						mailgun_opens: 0,
						mailgun_spam: 0,
						president_teaser: null,
						president_url: null,
						send_at: null,
						subheading: null,
						title: null,
						announcements: [],
						events: [],
						mainStories: [],
						otherStories: [],
						recipients: [],
					},
					original: {
						id: '',
						clone: [],
						created_at: null,
						is_approved: false,
						is_ready: false,
						mailgun_clicks: 0,
						mailgun_opens: 0,
						mailgun_spam: 0,
						send_at: null,
						subheading: null,
						title: null,
						announcements: [],
						events: [],
						mainStories: [],
						otherStories: [],
						recipients: [],
					},
					response: {},
					totalChars: {
						title: 50,
					},
					userRoles: [],
					dateObject: {
						sendAtMin: '',
						sendAtDefault: '',
					},
					sendAtdatePicker: null,
					showAddRecipient: false,
					newRecipient: null,
					existingEmail: false, // set to the value of prop recordexisits; updatable so as not to manipulte prop recordexists
          flatpickrConfig: {
            altFormat: "m/d/Y h:i K", // format the user sees
            altInput: true,
            dateFormat: "Y-m-d H:i:s", // format sumbitted to the API
            enableTime: true
          }
				}
			},
			created: function () {
				if (this.recordexists) {
					this.fetchCurrentEmail(this.recordid)
					this.existingEmail = true
				}
				else {
					this.newform = true;
					this.setupDatePickers()
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
					if (this.record.title && this.record.title.length < this.minTitleChars) {
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
				// Switch verbage of submit button.
				submitBtnLabel: function () {
					return (this.existingEmail) ? 'Update Email' : 'Create Email'
				},
				// Progress of email bulider (adds up to 100%)
				progress: function () {
					let progress = 0

					// Normal (NO presidential message, with events)
					if (!this.record.is_president_included && !this.record.exclude_events) {
						this.record.title ? progress += 13 : ''
						this.record.mainStories.length == 1 || this.record.mainStories.length == 3 ? progress += 15 : ''
						this.record.events.length > 0 ? progress += 15 : ''
						this.record.announcements.length > 0 ? progress += 15 : ''
						this.record.otherStories.length > 0 ? progress += 15 : ''
						this.record.recipients.length > 0 ? progress += 14 : ''
						this.record.send_at && this.record.is_approved ? progress += 13 : ''
					}
					// Presidential message, with events
					else if(this.record.is_president_included && !this.record.exclude_events) {
						this.record.title ? progress += 12 : ''
						this.record.mainStories.length == 1 || this.record.mainStories.length == 3 ? progress += 15 : ''
						this.record.events.length > 0 ? progress += 11 : ''
						this.record.announcements.length > 0 ? progress += 11 : ''
						this.record.otherStories.length > 0 ? progress += 11 : ''
						this.record.recipients.length > 0 ? progress += 11 : ''
						this.record.send_at && this.record.is_approved ? progress += 13 : ''
						this.record.president_teaser ? progress += 8 : ''
						this.record.president_url ? progress += 8 : ''
					}
					// Presidential message, NO events
					else if(this.record.is_president_included && this.record.exclude_events) {
						this.record.title ? progress += 13 : ''
						this.record.mainStories.length == 1 || this.record.mainStories.length == 3 ? progress += 15 : ''
						this.record.announcements.length > 0 ? progress += 15 : ''
						this.record.otherStories.length > 0 ? progress += 15 : ''
						this.record.recipients.length > 0 ? progress += 15 : ''
						this.record.send_at && this.record.is_approved ? progress += 15 : ''
						this.record.president_teaser ? progress += 6 : ''
						this.record.president_url ? progress += 6 : ''
					}
					// NO presidential message, NO events
					else if(!this.record.is_president_included && this.record.exclude_events) {
						this.record.title ? progress += 16 : ''
						this.record.mainStories.length == 1 || this.record.mainStories.length == 3 ? progress += 17 : ''
						this.record.announcements.length > 0 ? progress += 17 : ''
						this.record.otherStories.length > 0 ? progress += 17 : ''
						this.record.recipients.length > 0 ? progress += 17 : ''
						this.record.send_at && this.record.is_approved ? progress += 16 : ''
					}

					return progress
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
					this.$http.get('/api/email/' + recid + '/edit')

					.then((response) => {
						this.record = response.data.newdata.data
						this.setupDatePickers();
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
					let route = (this.existingEmail) ? '/api/email/' + this.record.id : '/api/email';

					// Submit form.
					this.$http[method](route, this.record) //

					// Do this when response gets back.
					.then((response) => {
						this.formMessage.msg = response.data.message;
						this.formMessage.isOk = response.ok; // Success message
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

				setupDatePickers: function () {
					let today = moment()

					//this.dateObject.sendAtMin = today.format('YYYY-MM-DD')
					if (!this.record.send_at) {
						this.dateObject.sendAtDefault = today.add(1, 'hour').format('YYYY-MM-DD HH:00:00')
					}
					else {
						this.dateObject.sendAtDefault = this.record.send_at;
					}
				},
				handleMainStoryAdded: function (mainStoryObj) {
					if (mainStoryObj) {
						this.record.mainStories.push(mainStoryObj)
					}
				},
				handleMainStoryRemoved: function (mainStoryId) {
					for (let i = 0; i < this.record.mainStories.length; i++) {
						if (mainStoryId == this.record.mainStories[i].id) {
							this.record.mainStories.splice(i, 1)
						}
					}
				},
				handleOtherStoryAdded: function (otherStoryObj) {
					if (otherStoryObj) {
						this.record.otherStories.push(otherStoryObj)
					}
				},
				handleOtherStoryRemoved: function (otherStoryId) {
					for (let i = 0; i < this.record.otherStories.length; i++) {
						if (otherStoryId == this.record.otherStories[i].id) {
							this.record.otherStories.splice(i, 1)
							return
						}
					}
				},
				handleAnnouncementAdded: function (anouncementObj) {
					if (anouncementObj) {
						this.record.announcements.push(anouncementObj)
					}
				},
				handleAnnouncementRemoved: function (announcementId) {
					for (let i = 0; i < this.record.announcements.length; i++) {
						if (announcementId == this.record.announcements[i].id) {
							this.record.announcements.splice(i, 1)
							return
						}
					}
				},
				handleEventAdded: function (eventObj) {
					if (eventObj) {
						this.record.events.push(eventObj)
					}
				},
				handleEventRemoved: function (eventId) {
					for (let i = 0; i < this.record.events.length; i++) {
						if (eventId == this.record.events[i].id) {
							this.record.events.splice(i, 1)
							return
						}
					}
				},
				updateMainStoriesOrder(evt) {
					this.record.mainStories = evt
				},
				updateOtherStoriesOrder(evt) {
					this.record.otherStories = evt
				},
				updateAnnouncementsOrder(evt) {
					this.record.announcements = evt
				},
				updateEventsOrder(evt) {
					this.record.events = evt
				},
				handleToggleExcludeEvents(evt) {
					this.record.exclude_events = evt
				}
			},
			watch: {

			},
			filters: {
				formatDate: function (value) {
					if (value) {
						return moment(String(value)).format('LLLL')
					}
				},
			},
		};

	</script>
