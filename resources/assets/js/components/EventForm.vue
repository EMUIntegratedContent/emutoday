<template>
  <p>{{ isadmin }}</p>
<!--  <form>-->
<!--    <slot name="csrf"></slot>-->
<!--    <div class="row">-->
<!--      <div v-bind:class="md12col">-->
<!--        <div v-show="formMessage.isOk" :class="calloutSuccess">-->
<!--          <h5>{{ formMessage.msg }}</h5>-->
<!--        </div>-->
<!--        <div v-show="formMessage.isErr" :class="calloutFail">-->
<!--          <h5>There are errors.</h5>-->
<!--        </div>-->
<!--        <div v-show="record.is_canceled == 1" :class="calloutFail">-->
<!--          <h5>This event has been canceled.</h5>-->
<!--        </div>-->
<!--        <div v-show="record.is_archived == 1" :class="calloutFail">-->
<!--          <h5>This event is archived because it ended more than two years ago. It will no longer display publicly.</h5>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--          <label>Title <span :class="iconStar" class="reqstar"></span></label>-->
<!--          <p class="help-text" id="title-helptext">Please enter a title ({{ titleChars }} characters left)</p>-->
<!--          <input v-model="record.title" class="form-control" :class="[formErrors.title ? 'invalid-input' : '']"-->
<!--                 name="title" type="text" maxlength="80" autofocus>-->
<!--          <p v-if="formErrors.title" class="help-text invalid"> Please Include a Title!</p>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--          <label>Short Title - for departmental use only</label>-->
<!--          <input v-model="record.short_title" class="form-control" type="text" placeholder="Short Title"-->
<!--                 name="short-title" maxlength="80">-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md12col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md12col">-->
<!--        <div :class="formGroup">-->
<!--          <label>Description <span :class="iconStar" class="reqstar"></span>-->
<!--            <p class="help-text" id="description-helptext">({{ descriptionChars }} characters left)</p></label>-->
<!--          <textarea v-model="record.description" class="form-control"-->
<!--                    :class="[formErrors.description ? 'invalid-input' : '']" name="description" type="textarea" rows="6"-->
<!--                    maxlength="255"></textarea>-->
<!--          <p v-if="formErrors.description" class="help-text invalid">Need a Description!</p>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md12col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md6col">-->
<!--        <div class="form-group">-->
<!--          <label>Is Event on Campus?-->
<!--            <input id="on-campus-yes" name="on_campus" type="checkbox" value="1" v-model="record.on_campus"/>-->
<!--          </label>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--      <div :class="md6col">-->

<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md12col">-->
<!--        <template v-if="isOnCampus">-->
<!--          <div class="row">-->
<!--            <div :class="md8col">-->
<!--              <label>Building</label>-->
<!--              <v-select-->
<!--                  v-model="building"-->
<!--                  :options="buildings"-->
<!--                  placeholder="Select a Building..."-->
<!--              ></v-select>-->
<!--            </div>&lt;!&ndash; /.md8col &ndash;&gt;-->
<!--            <div :class="md4col">-->
<!--              <label>Room</label>-->
<!--              <input v-model="record.room" :class="[formErrors.room ? 'invalid-input' : '']" name="room" type="text"-->
<!--                     class='mockh5' maxlength="80">-->
<!--            </div>&lt;!&ndash; /.md4col &ndash;&gt;-->
<!--          </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--        </template>-->
<!--        <div class="row">-->
<!--          <div :class="md12col">-->
<!--            <template v-if="isOnCampus">-->
<!--              <label>Location <span :class="iconStar" class="reqstar"></span></label>-->
<!--              <input v-model="computedLocation" class="form-control"-->
<!--                     :class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text"-->
<!--                     readonly="readonly">-->
<!--            </template>-->
<!--            <template v-else>-->
<!--              <label>Location <span :class="iconStar" class="reqstar"></span></label>-->
<!--              <input v-model="record.locationoffcampus" class="form-control"-->
<!--                     :class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text" maxlength="80">-->
<!--            </template>-->
<!--          </div>&lt;!&ndash; /.md12col &ndash;&gt;-->
<!--        </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.md12col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md6col">-->
<!--        <div class="form-group">-->
<!--          <label for="start-date">Event Start Date: <span :class="iconStar" class="reqstar"></span></label>-->
<!--          <input id="start-date" :class="[formErrors.start_date ? 'invalid-input' : '']" type="text"-->
<!--                 v-model="record.start_date" aria-describedby="errorStartDate"/>-->
<!--          <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>-->
<!--        </div>&lt;!&ndash;form-group &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--      <div :class="md6col">-->
<!--        <div class="form-group">-->
<!--          <label for="end-date">End Date: <span :class="iconStar" class="reqstar"></span></label>-->
<!--          <input id="end-date" :class="[formErrors.end_date ? 'invalid-input' : '']" type="text"-->
<!--                 v-model="record.end_date" aria-describedby="errorEndDate"/>-->
<!--          &lt;!&ndash; <datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate"></datepicker> &ndash;&gt;-->
<!--          <p v-if="formErrors.end_date" class="help-text invalid">Need an End Date</p>-->
<!--        </div>&lt;!&ndash;form-group &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->

<!--    <div class="row">-->
<!--      <div :class="md6col">-->
<!--        <div class="form-group">-->
<!--          <label for="all-day">All Day Event:-->
<!--            <input id="all-day" name="all_day" type="checkbox" value="1" v-model="record.all_day"/>-->
<!--          </label>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.small-6 column &ndash;&gt;-->
<!--      <div :class="md6col">-->
<!--        <div v-show="hasStartTime" class="form-group">-->
<!--          <label for="no-end-time">No End Time:</label>-->
<!--          <input id="no-end-time" name="no_end_time" type="checkbox" value="1" v-model="record.no_end_time"/>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.small-6 column &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md6col">-->
<!--        <div v-show="hasStartTime" class="form-group">-->
<!--          <label for="start-time">Start Time: <span :class="iconStar" class="reqstar"></span></label>-->
<!--          <input id="start-time" class="form-control" type="text" v-model="record.start_time" readonly/>-->
<!--          <p v-if="formErrors.start_time" class="help-text invalid">Need a Start Time</p>-->
<!--        </div>&lt;!&ndash; /.form-group &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--      <div :class="md6col">-->
<!--        <div v-show="hasEndTime" class="form-group">-->
<!--          <label for="end-time">End Time: <span :class="iconStar" class="reqstar"></span></label>-->
<!--          <input id="end-time" class="form-control" type="text" v-model="record.end_time" readonly/>-->
<!--        </div>&lt;!&ndash; /.form-group &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md12col">-->
<!--        <div class="form-group">-->
<!--          <label>Categories: <span :class="iconStar" class="reqstar"></span></label>-->
<!--          <v-select-->
<!--              v-model="record.categories"-->
<!--              :class="[formErrors.categories ? 'invalid-input' : '']"-->
<!--              :options="zcats"-->
<!--              :multiple="true"-->
<!--              placeholder="Select related categories..."-->
<!--          ></v-select>-->
<!--        </div>&lt;!&ndash; /.form-group &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.md12col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md6col">-->
<!--        <div class="form-group">-->
<!--          <label>Contact Person: <span :class="iconStar" class="reqstar"></span><em>(Jane Doe)</em></label>-->
<!--          <input v-model="record.contact_person" class="form-control"-->
<!--                 :class="[formErrors.contact_person ? 'invalid-input' : '']" name="contact-person" type="text"-->
<!--                 maxlength="80">-->
<!--          <p v-if="formErrors.contact_person" class="help-text invalid">Need a Contact Person!</p>-->

<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--      <div :class="md6col">-->
<!--        <div class="form-group">-->
<!--          <label>Contact Email: <span :class="iconStar" class="reqstar"></span><em>(ex.janedoe@emich.edu)</em></label>-->
<!--          <input v-model="record.contact_email" class="form-control"-->
<!--                 :class="[formErrors.contact_email ? 'invalid-input' : '']" name="contact-email" type="text"-->
<!--                 maxlength="80">-->
<!--          <p v-if="formErrors.contact_email" class="help-text invalid">Need a Contact Email!</p>-->

<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md6col">-->
<!--        <div class="form-group">-->
<!--          <label>Contact Phone: <span :class="iconStar" class="reqstar"></span> <em>(ex. 734.487.1849)</em>-->
<!--            <input v-model="record.contact_phone" class="form-control"-->
<!--                   :class="[formErrors.contact_phone ? 'invalid-input' : '']" name="contact-phone" type="text"-->
<!--                   maxlength="80">-->
<!--            <p v-if="formErrors.contact_phone" class="help-text invalid">Need a Contact Phone!</p>-->
<!--          </label>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--      <div :class="md6col">-->
<!--        <div class="form-group">-->
<!--          <label>Contact Fax: <em>(ex. 734.487.1849)</em>-->
<!--            <input v-model="record.contact_fax" class="form-control"-->
<!--                   :class="[formErrors.contact_fax ? 'invalid-input' : '']" name="contact-fax" type="text"-->
<!--                   maxlength="80">-->
<!--          </label>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->

<!--    &lt;!&ndash; RELATED LINKS &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md12col">-->
<!--        <div v-bind:class="formGroup">-->
<!--          <label>Related Link</label>-->
<!--          <p class="help-text" id="title-helptext-2">Please enter the url for your related web page. (ex.-->
<!--            www.yourlink.com)</p>-->
<!--          <div class="input-group input-group-flat">-->
<!--            <span :class="inputGroupLabel">http://</span>-->
<!--            <input v-model="record.related_link_1" class="form-control"-->
<!--                   v-bind:class="[formErrors.related_link_1 ? 'invalid-input' : '']" name="related_link_1" type="text"-->
<!--                   maxlength="255">-->
<!--          </div>-->
<!--          <p v-if="formErrors.related_link_1" class="help-text invalid">Please make sure url is properly formed.</p>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.col-md-4 &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row" v-show="record.related_link_1">-->
<!--      <div :class="md4col">-->
<!--        <div v-bind:class="formGroup">-->
<!--          <label>Descriptive text for link.<span :class="iconStar" class="reqstar"></span></label>-->
<!--          <p class="help-text" id="link_txt-helptext">(ex. The event webpage)</p>-->
<!--          <input v-model="record.related_link_1_txt" class="form-control"-->
<!--                 v-bind:class="[formErrors.related_link_1_txt ? 'invalid-input' : '']" name="related_link_1_txt"-->
<!--                 type="text" maxlength="80">-->
<!--          <p v-if="formErrors.related_link_1_txt" class="help-text invalid">Please include a descriptive text for your-->
<!--            related link.</p>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.col-md-4 &ndash;&gt;-->
<!--      <div :class="md8col">-->
<!--        <div v-bind:class="formGroup">-->
<!--          <label>Example of Related Link</label>-->
<!--          <p class="help-text">Below is how it may look. </p>-->
<!--          <h5 class="form-control">For more information, visit <a href="#"> {{ record.related_link_1_txt }}</a>.</h5>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--    </div>-->
<!--    &lt;!&ndash; Two &ndash;&gt;-->
<!--    <template v-if="record.related_link_1 && record.related_link_1_txt">-->
<!--      <div class="row">-->
<!--        <div :class="md12col">-->
<!--          <div v-bind:class="formGroup">-->
<!--            <label>Related Link</label>-->
<!--            <p class="help-text" id="title-helptext-3">Please enter the url for your related web page. (ex.-->
<!--              www.yourlink.com)</p>-->
<!--            <div class="input-group input-group-flat">-->
<!--              <span :class="inputGroupLabel">http://</span>-->
<!--              <input v-model="record.related_link_2" class="form-control"-->
<!--                     v-bind:class="[formErrors.related_link_2 ? 'invalid-input' : '']" name="related_link_2" type="text"-->
<!--                     maxlength="255">-->
<!--            </div>-->
<!--            <p v-if="formErrors.related_link_2" class="help-text invalid">Please make sure url is properly formed.</p>-->
<!--          </div>-->
<!--        </div>&lt;!&ndash; /.col-md-4 &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--      <div class="row" v-show="record.related_link_2">-->
<!--        <div :class="md4col">-->
<!--          <div v-bind:class="formGroup">-->
<!--            <label>Descriptive text for link.<span :class="iconStar" class="reqstar"></span></label>-->
<!--            <p class="help-text" id="link_txt-helptext">(ex. The event webpage)</p>-->
<!--            <input v-model="record.related_link_2_txt" class="form-control"-->
<!--                   v-bind:class="[formErrors.related_link_2_txt ? 'invalid-input' : '']" name="related_link_2_txt"-->
<!--                   type="text" maxlength="80">-->
<!--            <p v-if="formErrors.related_link_2_txt" class="help-text invalid">Please include a descriptive text for your-->
<!--              related link.</p>-->
<!--          </div>-->
<!--        </div>&lt;!&ndash; /.col-md-4 &ndash;&gt;-->
<!--        <div :class="md8col">-->
<!--          <div v-bind:class="formGroup">-->
<!--            <label>Example of Related Link</label>-->
<!--            <p class="help-text">Below is how it may look. </p>-->
<!--            <h5 class="form-control">For more information, visit: <a href="#"> {{ record.related_link_2_txt }}</a>.</h5>-->
<!--          </div>-->
<!--        </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--      </div>-->
<!--    </template>-->
<!--    &lt;!&ndash; three &ndash;&gt;-->
<!--    <template v-if="record.related_link_2 && record.related_link_2_txt">-->
<!--      <div class="row">-->
<!--        <div :class="md12col">-->
<!--          <div v-bind:class="formGroup">-->
<!--            <label>Related Link</label>-->
<!--            <p class="help-text" id="title-helptext-4">Please enter the url for your related web page. (ex.-->
<!--              www.yourlink.com)</p>-->
<!--            <div class="input-group input-group-flat">-->
<!--              <span :class="inputGroupLabel">http://</span>-->
<!--              <input v-model="record.related_link_3" class="form-control"-->
<!--                     v-bind:class="[formErrors.related_link_3 ? 'invalid-input' : '']" name="related_link_3" type="text"-->
<!--                     maxlength="255">-->
<!--            </div>-->
<!--            <p v-if="formErrors.related_link_3" class="help-text invalid">Please make sure url is properly formed.</p>-->
<!--          </div>-->
<!--        </div>&lt;!&ndash; /.col-md-4 &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--      <div class="row" v-show="record.related_link_3">-->
<!--        <div :class="md4col">-->
<!--          <div v-bind:class="formGroup">-->
<!--            <label>Descriptive text for link.<span :class="iconStar" class="reqstar"></span></label>-->
<!--            <p class="help-text" id="link_txt-helptext">(ex. The event webpage)</p>-->
<!--            <input v-model="record.related_link_3_txt" class="form-control"-->
<!--                   v-bind:class="[formErrors.related_link_3_txt ? 'invalid-input' : '']" name="related_link_3_txt"-->
<!--                   type="text" maxlength="80">-->
<!--            <p v-if="formErrors.related_link_3_txt" class="help-text invalid">Please include a descriptive text for your-->
<!--              related link.</p>-->
<!--          </div>-->
<!--        </div>&lt;!&ndash; /.col-md-4 &ndash;&gt;-->
<!--        <div :class="md8col">-->
<!--          <div v-bind:class="formGroup">-->
<!--            <label>Example of Related Link</label>-->
<!--            <p class="help-text">Below is how it may look. </p>-->
<!--            <h5 class="form-control">For more information, visit: <a href="#"> {{ record.related_link_3_txt }}</a>.</h5>-->
<!--          </div>-->
<!--        </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--      </div>-->
<!--    </template>-->
<!--    &lt;!&ndash; RELATED LINKS &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md6col">-->
<!--        <div class="form-group">-->
<!--          <label for="reg-deadline">Registration Deadline</label>-->
<!--          <input id="reg-deadline" :class="[formErrors.reg_deadline ? 'invalid-input' : '']" type="text"-->
<!--                 v-model="record.reg_deadline" aria-describedby="errorRegDeadline"/>-->
<!--          <p v-if="formErrors.reg_deadline" class="help-text invalid">Error</p>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md6col&ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md12col">-->

<!--        <div class="row">-->
<!--          <div :class="md2col">-->
<!--            <label>Free</label>-->
<!--            <div :class="formGroup">-->
<!--              <input id="free" name="free" type="checkbox" value="1" v-model="record.free"/>-->
<!--            </div>&lt;!&ndash; /.form-group &ndash;&gt;-->
<!--          </div>&lt;!&ndash; /.md4col &ndash;&gt;-->
<!--          <div :class="md10col">-->
<!--            <label>Event Cost <span :class="iconStar" class="reqstar"></span></label>-->
<!--            <div v-if="hasCost" class="form-group">-->
<!--              <div class="input-group">-->
<!--                &lt;!&ndash;            <span :class="inputGroupLabel">$</span>&ndash;&gt;-->
<!--                <input v-model="record.cost" class="form-control" :class="[formErrors.cost ? 'invalid-input' : '']"-->
<!--                       name="event-cost">-->
<!--              </div>&lt;!&ndash; /. input-group &ndash;&gt;-->
<!--            </div>-->
<!--            <div v-else :class="formGroup">-->
<!--              <div class="input-group">-->
<!--                &lt;!&ndash;            <span :class="inputGroupLabel">$</span>&ndash;&gt;-->
<!--                <input v-model="record.cost" class="form-control" :class="[formErrors.cost ? 'invalid-input' : '']"-->
<!--                       name="event-cost" readonly="readonly">-->
<!--              </div>&lt;!&ndash; /. input-group &ndash;&gt;-->
<!--            </div>-->
<!--          </div>&lt;!&ndash; /.md8col &ndash;&gt;-->
<!--        </div>&lt;!&ndash; /.row &ndash;&gt;-->


<!--      </div>&lt;!&ndash; /.medium-6 &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md12col">-->
<!--        <div :class="formGroup">-->
<!--          <label>Tickets Available</label>-->
<!--          <select v-model="record.tickets" class="form-control">-->
<!--            <option v-for="ticketoption in ticketoptions" :value="ticketoption.value">-->
<!--              {{ ticketoption.label }}-->
<!--            </option>-->
<!--          </select>-->
<!--          <template v-if="record.tickets == 'online' || record.tickets == 'all'">-->
<!--            <label>Link: <em>(ex. http://www.emich.edu/calendar)</em>-->
<!--              <input v-model="record.ticket_details_online" class="form-control"-->
<!--                     :class="[formErrors.ticket_details_online ? 'invalid-input' : '']" name="ticket-details-online"-->
<!--                     type="text">-->
<!--            </label>-->
<!--          </template>-->
<!--          <template v-if="record.tickets == 'phone' || record.tickets == 'all'">-->
<!--            <label>Tickets by Phone <em>(ex. 734.487.1849)</em>-->
<!--              <input v-model="record.ticket_details_phone" class="form-control"-->
<!--                     :class="[formErrors.ticket_details_phone ? 'invalid-input' : '']" name="ticket-details-phone"-->
<!--                     type="text">-->
<!--            </label>-->
<!--          </template>-->
<!--          <template v-if="record.tickets == 'office' || record.tickets == 'all'">-->
<!--            <label>Address-->
<!--              <input v-model="record.ticket_details_office" class="form-control"-->
<!--                     :class="[formErrors.ticket_details_office ? 'invalid-input' : '']" name="ticket-details-office"-->
<!--                     type="text">-->
<!--            </label>-->
<!--          </template>-->
<!--          <template v-if="record.tickets == 'other'">-->
<!--            <label>Other-->
<!--              <input v-model="record.ticket_details_other" class="form-control"-->
<!--                     :class="[formErrors.ticket_details_other ? 'invalid-input' : '']" name="ticket-details-other"-->
<!--                     type="text">-->
<!--            </label>-->
<!--          </template>-->
<!--        </div>&lt;!&ndash; /.form-group &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.md12col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md12col">-->
<!--        <div :class="formGroup">-->
<!--          <label>Participants</label>-->
<!--          <select v-model="record.participants" class="form-control">-->
<!--            <option v-for="participant in participants" :value="participant.value">-->
<!--              {{ participant.label }}-->
<!--            </option>-->
<!--          </select>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash;/.md12col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md6col">-->
<!--        <div :class="formGroup">-->
<!--          <label for="lbc-approved">Request for LBC-->
<!--            <input id="lbc-approved" name="lbc-approved" type="checkbox" value="1" v-model="record.lbc_approved"/>-->
<!--          </label>-->
<!--        </div>-->
<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--      <div :class="md6col">-->

<!--      </div>&lt;!&ndash; /.md6col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row">-->
<!--      <div :class="md12col">-->
<!--      </div>&lt;!&ndash; /.md12col &ndash;&gt;-->

<!--      <div :class="md12col">-->
<!--        <label for="minical">Select your department's mini calendar(s)-->
<!--          <v-select id="minical"-->
<!--                    v-model="record.minicalendars"-->
<!--                    :options="minicalslist"-->
<!--                    :multiple="true"-->
<!--                    placeholder="Select Mini Calendar"-->
<!--          ></v-select>-->
<!--        </label>-->
<!--      </div>&lt;!&ndash; /.md12col &ndash;&gt;-->
<!--    </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--    <div class="row" id="submit-area">-->
<!--      <div v-if="isadmin" :class="md4col">-->
<!--        <div class="checkbox">-->
<!--          <label><input type="checkbox" v-model="record.admin_pre_approved">Auto Approve</label>-->
<!--        </div>-->
<!--        <div class="checkbox">-->
<!--          <label><input type="checkbox" v-model="record.is_hidden">Hide from EMU Today Calendar (will still show on mini-->
<!--            calendars, if applicable)</label>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div :class="md8col">-->
<!--        <div :class="formGroup">-->
<!--          <button id="btn-event" v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{ submitBtnLabel }}-->
<!--          </button>-->
<!--          <button v-if="thisRecordExists" id="btn-clone" v-on:click="cloneEvent" type="submit"-->
<!--                  v-bind:class="btnPrimary">Clone Event-->
<!--          </button>-->
<!--          <button v-if="thisRecordExists && isAdmin" id="btn-cancel" v-on:click="cancelEvent" type="submit"-->
<!--                  v-bind:class="btnPrimary">{{ cancelStatus }}-->
<!--          </button>-->
<!--          <button v-if="thisRecordExists" id="btn-delete" v-on:click="delEvent" type="submit" class="redBtn"-->
<!--                  v-bind:class="btnPrimary">Delete Event-->
<!--          </button>-->
<!--        </div>&lt;!&ndash; /.md12col &ndash;&gt;-->
<!--      </div>&lt;!&ndash; /.md12col &ndash;&gt;-->
<!--    </div>-->
<!--  </form>-->

</template>
<style scoped>
#submit-area {
  background: #e1e1e1;
  margin: 20px 0 0 0;
}

p {
  margin: 0;
}

label {
  margin-top: 3px;
  margin-bottom: 3px;
  display: block;
}

label > span {
  display: inline-block;
  vertical-align: top;
}

.input-group input[type='text'] {
  marging-bottom: 0;
}

label input {
  font-weight: 400;
}

input[type='number'] {
  marging-bottom: 0;
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

.invalid {
  color: #ff0000;
}

.reqstar {
  font-size: .7rem;
  color: #E33100;
  vertical-align: text-top;
}

select {
  margin: 0;
}

[type='submit'], [type='button'] {
  margin-top: 0.8rem;
}

input[type="number"] {
  margin: 0;
}

input[type="text"] {
  margin: 0;
}

form {
  padding-bottom: 20px;
}

.yellowBtn {
  background: hsl(60, 70%, 50%);
}

.redBtn {
  background: hsl(0, 90%, 70%);
}

h5.form-control, .mockh5 {
  margin: 0;
  display: block;
  width: 100%;
  padding: .5rem;
  font-size: 14px;
  line-height: 1.42857143;
  color: #222222;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}

textarea {
  resize: vertical !important;
}
</style>

<style>
.v-select {
  position: relative;
  font-family: inherit
}

.v-select, .v-select * {
  box-sizing: border-box
}

@-webkit-keyframes vSelectSpinner {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg)
  }
  to {
    -webkit-transform: rotate(1turn);
    transform: rotate(1turn)
  }
}

@keyframes vSelectSpinner {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg)
  }
  to {
    -webkit-transform: rotate(1turn);
    transform: rotate(1turn)
  }
}

.vs__fade-enter-active, .vs__fade-leave-active {
  transition: opacity .15s cubic-bezier(1, .5, .8, 1)
}

.vs__fade-enter, .vs__fade-leave-to {
  opacity: 0
}

.vs--disabled .vs__clear, .vs--disabled .vs__dropdown-toggle, .vs--disabled .vs__open-indicator, .vs--disabled .vs__search, .vs--disabled .vs__selected {
  cursor: not-allowed;
  background-color: #f8f8f8
}

.v-select[dir=rtl] .vs__actions {
  padding: 0 3px 0 6px
}

.v-select[dir=rtl] .vs__clear {
  margin-left: 6px;
  margin-right: 0
}

.v-select[dir=rtl] .vs__deselect {
  margin-left: 0;
  margin-right: 2px
}

.v-select[dir=rtl] .vs__dropdown-menu {
  text-align: right
}

.vs__dropdown-toggle {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  display: flex;
  padding: 0 0 4px;
  background: none;
  border: 1px solid rgba(60, 60, 60, .26);
  border-radius: 4px;
  white-space: normal
}

.vs__selected-options {
  display: flex;
  flex-basis: 100%;
  flex-grow: 1;
  flex-wrap: wrap;
  padding: 0 2px;
  position: relative
}

.vs__actions {
  display: flex;
  align-items: center;
  padding: 4px 6px 0 3px
}

.vs--searchable .vs__dropdown-toggle {
  cursor: text
}

.vs--unsearchable .vs__dropdown-toggle {
  cursor: pointer
}

.vs--open .vs__dropdown-toggle {
  border-bottom-color: transparent;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0
}

.vs__open-indicator {
  fill: rgba(60, 60, 60, .5);
  -webkit-transform: scale(1);
  transform: scale(1);
  transition: -webkit-transform .15s cubic-bezier(1, -.115, .975, .855);
  transition: transform .15s cubic-bezier(1, -.115, .975, .855);
  transition: transform .15s cubic-bezier(1, -.115, .975, .855), -webkit-transform .15s cubic-bezier(1, -.115, .975, .855);
  transition-timing-function: cubic-bezier(1, -.115, .975, .855)
}

.vs--open .vs__open-indicator {
  -webkit-transform: rotate(180deg) scale(1);
  transform: rotate(180deg) scale(1)
}

.vs--loading .vs__open-indicator {
  opacity: 0
}

.vs__clear {
  fill: rgba(60, 60, 60, .5);
  padding: 0;
  border: 0;
  background-color: transparent;
  cursor: pointer;
  margin-right: 8px
}

.vs__dropdown-menu {
  display: block;
  position: absolute;
  top: calc(100% - 1px);
  left: 0;
  z-index: 1000;
  padding: 5px 0;
  margin: 0;
  width: 100%;
  max-height: 350px;
  min-width: 160px;
  overflow-y: auto;
  box-shadow: 0 3px 6px 0 rgba(0, 0, 0, .15);
  border: 1px solid rgba(60, 60, 60, .26);
  border-top-style: none;
  border-radius: 0 0 4px 4px;
  text-align: left;
  list-style: none;
  background: #fff
}

.vs__no-options {
  text-align: center
}

.vs__dropdown-option {
  line-height: 1.42857143;
  display: block;
  padding: 3px 20px;
  clear: both;
  color: #333;
  white-space: nowrap
}

.vs__dropdown-option:hover {
  cursor: pointer
}

.vs__dropdown-option--highlight {
  background: #5897fb;
  color: #fff
}

.vs__selected {
  display: flex;
  align-items: center;
  background-color: #f0f0f0;
  border: 1px solid rgba(60, 60, 60, .26);
  border-radius: 4px;
  color: #333;
  line-height: 1.4;
  margin: 4px 2px 0;
  padding: 0 .25em
}

.vs__deselect {
  display: inline-flex;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  margin-left: 4px;
  padding: 0;
  border: 0;
  cursor: pointer;
  background: none;
  fill: rgba(60, 60, 60, .5);
  text-shadow: 0 1px 0 #fff
}

.vs--single .vs__selected {
  background-color: transparent;
  border-color: transparent
}

.vs--single.vs--open .vs__selected {
  position: absolute;
  opacity: .4
}

.vs--single.vs--searching .vs__selected {
  display: none
}

.vs__search::-ms-clear, .vs__search::-webkit-search-cancel-button, .vs__search::-webkit-search-decoration, .vs__search::-webkit-search-results-button, .vs__search::-webkit-search-results-decoration {
  display: none
}

.vs__search, .vs__search:focus {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  line-height: 1.4;
  font-size: 1em;
  border: 1px solid transparent;
  border-left: none;
  outline: none;
  margin: 4px 0 0;
  padding: 0 7px;
  background: none;
  box-shadow: none;
  width: 0;
  max-width: 100%;
  flex-grow: 1
}

.vs__search::-webkit-input-placeholder {
  color: inherit
}

.vs__search:-ms-input-placeholder {
  color: inherit
}

.vs__search::-ms-input-placeholder {
  color: inherit
}

.vs__search::placeholder {
  color: inherit
}

.vs--unsearchable .vs__search {
  opacity: 1
}

.vs--unsearchable .vs__search:hover {
  cursor: pointer
}

.vs--single.vs--searching:not(.vs--open):not(.vs--loading) .vs__search {
  opacity: .2
}

.vs__spinner {
  align-self: center;
  opacity: 0;
  font-size: 5px;
  text-indent: -9999em;
  overflow: hidden;
  border: .9em solid hsla(0, 0%, 39.2%, .1);
  border-left-color: rgba(60, 60, 60, .45);
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation: vSelectSpinner 1.1s linear infinite;
  animation: vSelectSpinner 1.1s linear infinite;
  transition: opacity .1s
}

.vs__spinner, .vs__spinner:after {
  border-radius: 50%;
  width: 5em;
  height: 5em
}

.vs--loading .vs__spinner {
  opacity: 1
}
</style>

<script>
// import flatpickr from "flatpickr"
import vSelect from "vue-select"

export default {
  directives: {},
  components: {
    vSelect
  },
  props: {
    // recordexists: {default: false},
    // recordid: {default: ''},
    // framework: {default: 'foundation'},
    isadmin: {default: false},
  },
  data: function () {
    return {
    //   minicalslist: [],
    //   dateObject: {
    //     startDateMin: '',
    //     startDateDefault: '',
    //     endDateMin: '',
    //     endDateDefault: '',
    //     startTimeDefault: '',
    //     endTimeDefault: '',
    //     regDateMin: '',
    //     regDateDefault: ''
    //   },
    //   startdatePicker: null,
    //   enddatePicker: null,
    //   starttimePicker: null,
    //   endtimePicker: null,
    //   regdeadlinePicker: null,
    //   sdate: '',
    //   edate: '',
    //   stime: '',
    //   rdate: '',
    //   ticketoptions: [
    //     {label: 'Online', value: 'online'},
    //     {label: 'Phone', value: 'phone'},
    //     {label: 'Ticket Office', value: 'office'},
    //     {label: 'Online, Phone and Ticket Office', value: 'all'},
    //     {label: 'Other', value: 'other'},
    //   ],
    //   participants: [
    //     {label: 'Campus Only', value: 'campus'},
    //     {label: 'Open to Public', value: 'public'},
    //     {label: 'Students Only', value: 'students'},
    //     {label: 'Invitation Only', value: 'invite'},
    //     {label: 'Tickets Required', value: 'tickets'},
    //   ],
    //   totalChars: {
    //     start: 0,
    //     title: 80,
    //     description: 255
    //   },
    //   building_in: [],
    //   building: null,
    //   room: '',
    //   buildings: [],
    //   zcategories: [],
    //   zcats: [],
    //   categories: [],
    //   minicals: null,
    //   minicalendars: {},
    //   record: {
    //     id: null,
    //     on_campus: 1,
    //     all_day: 0,
    //     no_end_time: 0,
    //     free: 0,
    //     title: '',
    //     description: '',
    //     mini_calendar: '',
    //     building: '',
    //     categories: [],
    //     is_canceled: 0,
    //     is_hidden: 0,
    //     start_time: '12:00 PM',
    //     end_time: '12:00 PM',
    //     admin_pre_approved: false,
    //   },
    //   record_exists: false,
    //   response: {},
    //   formStatus: {},
    //   vModelLike: "",
    //   formMessage: {
    //     isOk: false,
    //     isErr: false,
    //     msg: ''
    //   },
    //   formInputs: {},
    //   formErrors: {}
    }
  },
  mounted() {
    // this.record_exists = this.recordexists;
    // if (this.thisRecordExists) {
    //   let fetchme = this.recordid ? this.recordid : this.record.id;
    //   this.fetchCurrentRecord(fetchme)
    // }
    // this.setupDatePickers();
    // this.fetchMiniCalsList();
    // this.fetchForSelectBuildingList("");
    // this.fetchForSelectCategoriesList("");
    //
    // // Don't submit form on 'enter'
    // $(document).on('keyup keypress', 'form input[type="text"]', function (e) {
    //   if (e.which == 13) {
    //     e.preventDefault();
    //     return false;
    //   }
    // });
  },

  computed: {
    // dropDownSelect: function () {
    //   return (this.framework == 'foundation') ? 'fdropdown' : ''
    // },
    // md6col: function () {
    //   return (this.framework == 'foundation') ? 'medium-6 columns' : 'col-md-6'
    // },
    // md12col: function () {
    //   return (this.framework == 'foundation') ? 'medium-12 columns' : 'col-md-12'
    // },
    // md8col: function () {
    //   return (this.framework == 'foundation') ? 'medium-8 columns' : 'col-md-8'
    // },
    // md4col: function () {
    //   return (this.framework == 'foundation') ? 'medium-4 columns' : 'col-md-4'
    // },
    // md2col: function () {
    //   return (this.framework == 'foundation') ? 'medium-2 columns' : 'col-md-2'
    // },
    // md10col: function () {
    //   return (this.framework == 'foundation') ? 'medium-10 columns' : 'col-md-10'
    // },
    // btnPrimary: function () {
    //   return (this.framework == 'foundation') ? 'button button-primary' : 'btn btn-primary'
    // },
    // formGroup: function () {
    //   return (this.framework == 'foundation') ? 'form-group' : 'form-group'
    // },
    // inputGroupLabel: function () {
    //   return (this.framework == 'foundation') ? 'input-group-label' : 'input-group-addon'
    // },
    // iconStar: function () {
    //   return (this.framework == 'foundation') ? 'fi-star' : 'fa fa-star'
    // },
    // calloutSuccess: function () {
    //   return (this.framework == 'foundation') ? 'callout success' : 'alert alert-success'
    // },
    // calloutFail: function () {
    //   return (this.framework == 'foundation') ? 'callout alert' : 'alert alert-danger'
    // },
    // submitBtnLabel: function () {
    //   return (this.thisRecordExists) ? 'Update Event' : 'Submit For Approval'
    // },
    // computedLocation: function () {
    //   let bldg, room;
    //
    //   if (this.building) {
    //     this.record.building = this.building.name;
    //     bldg = this.record.building
    //     room = (this.record.room) ? ' - ' + this.record.room : '';
    //   } else {
    //     bldg = ''
    //     room = ''
    //   }
    //   return bldg + room;
    // },
    // cancelStatus: function () {
    //   return (this.record.is_canceled == 1) ? 'Uncancel Event' : 'Cancel Event'
    // },
    // isOnCampus: function () {
    //   return this.record.on_campus == 1 ? true : false;
    // },
    // realCost: function () {
    //   if (this.record.free == 1) {
    //     return '0.00';
    //   } else {
    //     return '';
    //   }
    // },
    // hasCost: function () {
    //   if (this.record.free == 1) {
    //     this.record.cost = '0.00';
    //     return false;
    //   } else {
    //     return true;
    //   }
    // },
    // titleChars: function () {
    //   var str = this.record.title;
    //   var cclength = str.length;
    //   return this.totalChars.title - cclength;
    // },
    // descriptionChars: function () {
    //   var str = this.record.description;
    //   var cclength = str.length;
    //   return this.totalChars.description - cclength;
    // },
    // hasStartTime: function () {
    //   return this.record.all_day == 1 ? false : true;
    // },
    // hasEndTime: function () {
    //   return (this.record.all_day == 1 || this.record.no_end_time == 1) ? false : true;
    // },
    // isAdmin: function () {
    //   return window.location.href.indexOf("admin") > -1;
    // },
    // thisRecordExists: function () {
    //   if (this.recordexists || this.record_exists) {
    //     return true;
    //   }
    //   return false;
    // }
  },
  methods: {
    // refreshUserEventTable: function () {
    //   $.get('/calendar/user/events', function (data) {
    //     data = $.parseJSON(data);
    //     $('#user-events-tables').html(data);
    //   });
    // },
    //
    // fetchMiniCalsList: function () {
    //   this.$http.get('/api/minicalslist')
    //       .then((response) => {
    //         this.minicalslist = response.data;
    //
    //         let self = this;
    //
    //         $.each(response.data, function (index, value) {
    //           self.minicalslist[index].label = value.calendar;
    //           self.minicalslist[index].code = value.value;
    //         });
    //       }, (response) => {
    //         //error callback
    //         console.log("ERRORS");
    //         this.formErrors = response.data.error.message;
    //
    //       }).bind(this);
    // },
    // setupDatePickers: function () {
    //   var self = this;
    //   if (this.record.start_date === '') {
    //     this.dateObject.startDateMin = this.currentDate;
    //     this.dateObject.startDateDefault = null;
    //
    //     this.dateObject.endDateMin = null;
    //     this.dateObject.endDateDefault = null;
    //   } else {
    //     this.dateObject.startDateMin = this.record.start_date;
    //     this.dateObject.startDateDefault = this.record.start_date;
    //     this.dateObject.endDateMin = this.record.start_date;
    //     this.dateObject.endDateDefault = this.record.end_date;
    //     this.dateObject.startTimeDefault = this.record.start_time;
    //     this.dateObject.endTimeDefault = this.record.end_time;
    //     this.dateObject.regDateMin = this.record.start_date;
    //     this.dateObject.regDateDefault = this.record.reg_deadline;
    //   }
    //   this.startdatePicker = flatpickr(document.getElementById("start-date"), {
    //     // minDate: self.dateObject.startDateMin,
    //     defaultDate: self.dateObject.startDateDefault,
    //     enableTime: false,
    //     // altFormat: "m-d-Y",
    //     altInput: true,
    //     altInputClass: "form-control",
    //     dateFormat: "Y-m-d",
    //     // minDate: new Date(),
    //     onChange(dateObject, dateString) {
    //       self.enddatePicker.set("minDate", dateObject);
    //       self.record.start_date = dateString;
    //       self.startdatePicker.value = dateString;
    //     }
    //   });
    //
    //   this.enddatePicker = flatpickr(document.getElementById("end-date"), {
    //     minDate: self.dateObject.endDateMin,
    //     defaultDate: self.dateObject.endDateDefault,
    //     enableTime: false,
    //     // altFormat: "m-d-Y",
    //     altInput: true,
    //     altInputClass: "form-control",
    //     dateFormat: "Y-m-d",
    //     // minDate: new Date(),
    //     onChange(dateObject, dateString) {
    //       self.startdatePicker.set("maxDate", dateObject);
    //       self.record.end_date = dateString;
    //       self.enddatePicker.value = dateString;
    //     }
    //   });
    //
    //   this.starttimePicker = flatpickr(document.getElementById("start-time"), {
    //     noCalendar: true,
    //     enableTime: true,
    //     defaultDate: self.dateObject.startTimeDefault,
    //     dateFormat: "h:i K",
    //     onChange(timeObject, timeString) {
    //       self.record.start_time = timeString;
    //       self.starttimePicker.value = timeString;
    //     }
    //   });
    //   this.endtimePicker = flatpickr(document.getElementById("end-time"), {
    //     noCalendar: true,
    //     enableTime: true,
    //     defaultDate: self.dateObject.endTimeDefault,
    //     dateFormat: "h:i K",
    //     onChange(timeObject, timeString) {
    //       self.record.end_time = timeString;
    //       self.endtimePicker.value = timeString;
    //     }
    //   });
    //
    //   this.regdeadlinePicker = flatpickr(document.getElementById("reg-deadline"), {
    //     minDate: self.dateObject.regDateMin,
    //     defaultDate: self.dateObject.regDateDefault,
    //     enableTime: false,
    //     // altFormat: "m-d-Y",
    //     altInput: true,
    //     altInputClass: "form-control",
    //     dateFormat: "Y-m-d",
    //     onChange(dateObject, dateString) {
    //       self.record.reg_deadline = dateString;
    //       self.regdeadlinePicker.value = dateString;
    //     }
    //   });
    // },
    //
    // fetchSubmittedRecord: function (recid) {
    //   // Sets params for update record, Passes an id to fetchCurrentRecord
    //   this.record.exists = this.record_exists = true;
    //   this.formMessage.isOk = false;
    //   this.formMessage.isErr = false;
    //   this.record.id = recid;
    //   this.formErrors = {};
    //   this.fetchCurrentRecord();
    // },
    //
    // cancelRecord: function (recid) {
    //   // toggles cancel
    //   this.formMessage.isOk = false;
    //   this.formMessage.msg = false;
    //
    //   this.$http.patch('/api/event/' + recid + '/cancel')
    //       .then((response) => {
    //         this.formMessage.isOk = response.ok;
    //         this.formMessage.msg = response.body.message;
    //       }, (response) => {
    //         console.log(JSON.stringify(response))
    //       }).bind(this);
    //   this.refreshUserEventTable();
    // },
    //
    // fetchCurrentRecord: function () {
    //   var fetchme = this.recordid ? this.recordid : this.record.id;
    //   this.$http.get('/api/event/' + fetchme + '/edit')
    //
    //       .then((response) => {
    //         this.record = response.data.data;
    //         this.record.exists = this.record_exists = true;
    //         this.currentRecordId = this.record.id;
    //         this.checkOverData();
    //         this.record.start_time = response.data.data.start_time;
    //       }, (response) => {
    //         //error callback
    //         console.log(response);
    //         console.log("FETCH ERRORS");
    //       }).bind(this);
    // },
    // checkOverData: function () { // Used after fetching an event
    //   // Check event location
    //   // not null and has more than white space
    //   if (this.record.building != null && /\S/.test(this.record.building)) {
    //     // Is on campus
    //     this.record.on_campus = 1; // bool
    //     this.building = {id: 0, name: this.convertFromSlug(this.record.building)};
    //     this.building.label = this.building.name;
    //   } else {
    //     // Not on campus
    //     this.record.on_campus = 0; // bool
    //     this.record.locationoffcampus = this.record.location;
    //   }
    //
    //   if (!this.record.categories) {
    //     this.record.categories = [];
    //   }
    //   let self = this;
    //
    //   $.each(this.record.eventcategories, function (index, value) {
    //     self.record.eventcategories[index].label = value.category;
    //     self.record.eventcategories[index].code = value.value;
    //   });
    //
    //   $.each(this.record.minicalendars, function (index, value) {
    //     self.record.minicalendars[index].label = value.calendar;
    //     self.record.minicalendars[index].code = value.value;
    //   });
    //
    //   this.record.categories = self.record.eventcategories;
    //
    //   this.setupDatePickers();
    // },
    // fetchForSelectCategoriesList(search, loading) {
    //   loading ? loading(true) : undefined;
    //   this.$http.get('/api/categorylist', {
    //     q: search
    //   }).then(resp => {
    //     this.zcats = resp.data;
    //     let self = this;
    //
    //     $.each(resp.data, function (index, value) {
    //       self.zcats[index].label = value.category;
    //       self.zcats[index].code = value.value;
    //     });
    //
    //     loading ? loading(true) : undefined;
    //   })
    // },
    // fetchForSelectBuildingList(search, loading) {
    //   loading ? loading(true) : undefined;
    //
    //   this.$http.get('/api/buildinglist', {
    //     q: search
    //   }).then(resp => {
    //     this.buildings = resp.data;
    //     let self = this;
    //
    //     $.each(resp.data, function (index, value) {
    //       self.buildings[index].label = value.name;
    //     });
    //
    //     loading ? loading(true) : undefined;
    //   })
    // },
    // delEvent: function (e) {
    //   e.preventDefault();
    //   this.formMessage.isOk = false;
    //   this.formMessage.isErr = false;
    //
    //   if (confirm('Would you like to delete this event?') == true) {
    //     $('html, body').animate({scrollTop: 0}, 'fast');
    //
    //     var tempid = 0;
    //
    //
    //     this.currentRecordId ? tempid = this.currentRecordId : tempid = this.record.id;
    //     this.$http.post('/api/event/' + tempid + '/delete')
    //
    //         .then((response) => {
    //           // If user admin
    //           if (window.location.href.indexOf("admin") > -1) {
    //             window.location.href = "/admin/event/queue";
    //           } else { // Not user admin
    //             // Clear out values;
    //             this.record = {
    //               on_campus: 1,
    //               all_day: 0,
    //               no_end_time: 0,
    //               free: 0,
    //               title: '',
    //               description: '',
    //               mini_calendar: '',
    //               building: '',
    //               categories: []
    //             };
    //             this.record.location = '';
    //             this.building = null;
    //             this.buildings = null;
    //             this.record.room = null;
    //             this.record.building = null;
    //             this.record.building_id = null;
    //             this.record.lbc_approved = false;
    //             this.record.sdate = '';
    //             this.record.edate = '';
    //             this.record.stime = '';
    //             this.record.rdate = '';
    //             this.formMessage.isOk = response.ok;
    //             this.formMessage.msg = response.body;
    //             this.record.exists = this.record_exists = false;
    //             var d = new Date();
    //             var tempdate = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
    //             this.record.start_date = tempdate;
    //             this.record.end_date = tempdate;
    //             this.record.reg_deadline = tempdate;
    //             this.setupDatePickers();
    //           }
    //         }, (response) => {
    //           console.log('Error: ' + JSON.stringify(response))
    //         }).bind(this);
    //     this.refreshUserEventTable();
    //   }
    // },
    //
    // cloneEvent: function (e) {
    //   if (confirm('Would you like to clone this event?') == true) {
    //     this.record.exists = this.record_exists = false;
    //     e.preventDefault();
    //     this.submitForm(e, true);
    //   }
    // },
    //
    // cancelEvent: function (e) {
    //   e.preventDefault();
    //   this.formMessage.isOk = false;
    //   this.formMessage.isErr = false;
    //
    //   if (confirm('Would you like to cancel this event?') == true) {
    //     $('html, body').animate({scrollTop: 0}, 'fast');
    //     let tempid
    //     this.currentRecordId ? tempid = this.currentRecordId : tempid = this.record.id;
    //     this.$http.patch('/api/event/' + tempid + '/cancel')
    //
    //         .then((response) => {
    //           if (this.record.is_canceled == 0) {
    //             this.record.is_canceled = 1
    //           } else {
    //             this.record.is_canceled = 0
    //           }
    //
    //           this.formMessage.msg = "Event's status has been changed.";
    //           this.formMessage.isOk = response.ok;
    //         }, (response) => {
    //           console.log('Error: ' + JSON.stringify(response))
    //         }).bind(this);
    //     this.refreshUserEventTable();
    //   }
    // },
    //
    // submitForm: function (e, doClone) {
    //   e.preventDefault();
    //   this.formMessage.isOk = false;
    //   this.formMessage.isErr = false;
    //
    //   $('html, body').animate({scrollTop: 0}, 'fast');
    //
    //   if (this.record.on_campus == true) {
    //     this.record.location = this.computedLocation;
    //   } else {
    //     this.record.location = this.record.locationoffcampus;
    //     // clearout these values
    //     this.record.building = null;
    //     this.record.building_id = null;
    //     this.record.room = null;
    //   }
    //   this.record.minicals = (this.record.minicalendars) ? this.record.minicalendars : null;
    //
    //   let method = (!this.record.id || doClone === true) ? 'post' : 'put'
    //   let route = (!this.record.id || doClone === true) ? '/api/event' : '/api/event/' + this.record.id;
    //
    //   this.$http[method](route, this.record)
    //
    //       .then((response) => {
    //         response.status;
    //         this.formMessage.msg = response.data.message;
    //         this.formMessage.isOk = response.ok;
    //         this.formMessage.isErr = false;
    //         this.currentRecordId = response.data.newdata.record_id;
    //         this.record_id = response.data.newdata.record_id;
    //         this.record.id = response.data.newdata.record_id;
    //         this.record.exists = true;
    //         this.formErrors = {};
    //         this.refreshUserEventTable();
    //         this.fetchCurrentRecord(this.currentRecordId)
    //       }, (response) => {
    //         this.formMessage.isOk = false;
    //         this.formMessage.isErr = true;
    //         //error callback
    //         this.formErrors = response.data.error.message;
    //       }).bind(this);
    // },
    // convertToSlug: function (value) {
    //   return value.toLowerCase()
    //       .replace(/[^a-z0-9-]+/g, '-')
    //       .replace(/^-+|-+$/g, '');
    // },
    // convertFromSlug: function (value) {
    //
    //   /* READ: for some reason, buildings do not have foreign key relations to events;
    //   * they are merely being stored as slugs in the events table.
    //   * This causes problems when trying to reproduce names that have capital letters other than the first letter
    //   * (e.g. "McKenny Hall" or "Rec/IM Building")
    //   * In lieu of breaking the entire events table, whenever a slug has special formatting, just put it in a conditional statement
    //   *
    //   * CP 1/22/18
    //   */
    //   if (value == 'mckenny-hall') {
    //     return 'McKenny Hall'
    //   } else if (value == 'recim-building' || value == 'rec/im-building') {
    //     return 'Rec/IM Building'
    //   } else if (value == 'rec/im-softball-complex') {
    //     return 'Rec/IM Softball Complex'
    //   } else {
    //     return value.replace(/-/g, " ").replace(/\b[a-z]/g, function () {
    //       return arguments[0].toUpperCase()
    //     })
    //   }
    //
    // }
  }
};
</script>
