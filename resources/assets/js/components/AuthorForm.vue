<template>
  <form>
    <slot name="csrf"></slot>
    <div class="row">
      <div v-bind:class="md12col">
        <div v-if="formMessage.isOk" :class="calloutSuccess">
          <h5>{{ formMessage.msg }}</h5>
        </div>
        <div v-if="formMessage.isErr" :class="calloutFail">
          <h5>There are errors.</h5>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col" v-if="record.hidden == '1'">
        <div class="alert alert-warning" role="alert">
          This author is archived. Information cannot be changed for this author while archived.
        </div>
      </div>
      <div v-bind:class="md6col">
        <!-- First Name -->
        <div v-bind:class="formGroup">
          <label>First Name <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.first_name" class="form-control"
                 v-bind:class="[formErrors.first_name ? 'invalid-input' : '']" name="first_name" type="text" :readonly="record.hidden == '1'">
          <p v-if="formErrors.first_name" class="help-text invalid">{{ formErrors.first_name }}</p>
        </div>
      </div>
      <div v-bind:class="md6col">
        <!-- Last Name -->
        <div v-bind:class="formGroup">
          <label>Last Name <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.last_name" class="form-control"
                 v-bind:class="[formErrors.last_name ? 'invalid-input' : '']" name="last_name" type="text" :readonly="record.hidden == '1'">
          <p v-if="formErrors.last_name" class="help-text invalid">{{ formErrors.last_name }}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div :class="md6col">
        <!-- Email -->
        <div v-bind:class="formGroup">
          <label>Email <span v-bind:class="iconStar" class="reqstar"></span></label>
          <p class="help-text" id="title-helptext">Please enter the author's email address. (contact@emich.edu)</p>
          <div class="input-group input-group-flat">
            <input v-model="record.email" class="form-control" v-bind:class="[formErrors.email ? 'invalid-input' : '']"
                   name="email" type="text" :readonly="record.hidden == '1'">
          </div>
          <p v-if="formErrors.email" class="help-text invalid">Please make sure email is properly formed.</p>
        </div>
      </div><!-- /.col-md-6 -->
      <div :class="md6col">
        <!-- Phone -->
        <div v-bind:class="formGroup">
          <label>Phone</label>
          <p class="help-text" id="phone-helptext">Please enter the contact person's phone number.</p>
          <div class="input-group input-group-flat">
            <input v-model="record.phone" class="form-control" v-bind:class="[formErrors.phone ? 'invalid-input' : '']"
                   name="phone" type="text" :readonly="record.hidden == '1'">
          </div>
          <p v-if="formErrors.phone" class="help-text invalid">Please enter a phone number.</p>
        </div>
      </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
    <div class="row">
      <div :class="md6col">
        <!-- Email -->
        <div v-bind:class="formGroup">
          <label>Associated User (can be empty)</label>
          <p class="help-text" id="user-helptext">With which system user is this author associated (optional)?</p>
          <div class="input-group input-group-flat">
            <select v-model="record.user_id" :readonly="record.hidden == '1'">
              <option :value="null">-none-</option>
              <option v-for="user in users" v-bind:value="user.id" :selected="record.user_id == user.id">
                {{ user.first_name }} {{ user.last_name }}
              </option>
            </select>
          </div>
          <p v-if="formErrors.user" class="help-text invalid">Not a valid selection.</p>
        </div>
      </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
    <div class="row">
      <div :class="md6col">
        <div class="form-group">
          <label>Show this author as story contact?
            <input id="is-contact-yes" name="is_contact" type="checkbox"
                   :true-value="1" :false-value="0" v-model="record.is_contact" :readonly="record.hidden == '1'"/>
          </label>
        </div>
      </div><!-- /.md6col -->
    </div><!-- /.row -->
    <div class="row">
      <div :class="md12col">
        <div class="form-group">
          <label>This author should be the DEFAULT contact for a STORY if none is otherwise specified.
            <input id="is-principal-contact-yes" name="is_principal_contact" type="checkbox"
                   :true-value="1" :false-value="0"
                   v-model="record.is_principal_contact" :readonly="record.hidden == '1'"/>
          </label>
          <p>Notice: Selecting this will replace the currently-select principal story contact, who is
            {{ currentPrimaryContact }}.</p>
        </div>
      </div><!-- /.md6col -->
    </div><!-- /.row -->
    <div class="row">
      <div :class="md12col">
        <div class="form-group">
          <label>This author should be the DEFAULT contact for a MAGAZINE ARTICLE if none is otherwise specified.
            <input id="is-principal-magazine-contact-yes" name="is_principal_magazine_contact" type="checkbox"
                   :true-value="1" :false-value="0"
                   v-model="record.is_principal_magazine_contact" :readonly="record.hidden == '1'"/>
          </label>
          <p>Notice: Selecting this will replace the currently-select principal magazine contact, who is
            {{ currentPrimaryMagazineContact }}.</p>
        </div>
      </div><!-- /.md6col -->
    </div><!-- /.row -->
    <div class="row">
      <div :class="md12col">
        <div class="panel panel-warning">
          <div class="panel-body">
            <div v-if="showArchive">
              <label>Archive this author on save?
                <input id="archive-on-save" name="archive-on-save" type="checkbox"
                       :true-value="1" :false-value="0"
                       v-model="archiveOnSave"/>
              </label>
              <p>Notice: Selecting this removes the author as default contact for stories and/or magazine articles if they are set.
                They will no longer be selectable as an author or contacts for stories or articles.
                Their attributions will still be recorded on stories and articles, and their association with a system user will be maintained.
                They will still show in the authors table with an "Archived" tag next to their name.
                You can unarchive an author at any time.
              </p>
            </div>
            <div v-if="showUnarchive">
              <label>Unarchive this author on save?
                <input id="unarchive-on-save" name="unarchive-on-save" type="checkbox"
                       :true-value="1" :false-value="0"
                       v-model="unarchiveOnSave"/>
              </label>
              <p>Notice: Selecting this reinstates the author and gives you the option to add them as contacts for stories or articles.
                You can re-archive an author at any time.
              </p>
            </div>
          </div>
        </div>
      </div><!-- /.md6col -->
    </div><!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{ submitBtnLabel }}</button>
        </div>
      </div>
    </div>
  </form>
</template>

<style scoped>
p {
  margin: 0;
}

label {
  margin-top: 3px;
  margin-bottom: 3px;
  display: block;
  /*margin-bottom: 1.5em;*/
}

label > span {
  display: inline-block;
  /*width: 8em;*/
  vertical-align: top;
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

fieldset label.radiobtns {
  display: inline;
  margin: 4px;
  padding: 2px;
}

.reqstar {
  font-size: .6rem;
  color: #E33100;
  vertical-align: text-top;
}

button.button-primary {
  margin-top: 0.8rem;
}

select {
  margin: 0;
}

[type='submit'],
[type='button'] {
  margin-top: 0.8rem;
}

input[type="number"] {
  margin: 0;
}

input[type="text"] {
  margin: 0;
}

h5.form-control {
  margin: 0;
  display: block;
  width: 100%;
  height: 2.4375rem;
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
</style>


<script>
export default {
  props: {
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
      default: 'foundation'
    },
    type: {
      default: 'general'
    },
    user: {
      default: ''
    }
  },
  data: function () {
    return {
      record_id: null,
      record_exists: false,
      startdatePicker: null,
      enddatePicker: null,
      currentPrimaryContact: '',
      currentPrimaryMagazineContact: '',
      isCurrentContact: false,
      currentDate: {},
      dateObject: {
        startDateMin: '',
        startDateDefault: '',
        endDateMin: '',
        endDateDefault: ''
      },
      record: {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        is_contact: '',
        is_principal_contact: '',
        is_principal_magazine_contact: '',
        user_id: null,
        hidden: 0
      },
      totalChars: {
        start: 0,
        title: 50,
        hr: 80,
        announcement: 255
      },
      response: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      formInputs: {},
      formErrors: {},
      users: [],
      showUnarchive: false,
      showArchive: false,
      archiveOnSave: false,
      unarchiveOnSave: false
    }
  },
  created: function () {
    this.fetchUsers()
    if (this.recordexists) {
      this.record_id = this.recordid
      this.record_exists = this.recordexists
      this.fetchCurrentRecord(this.record_id)
      this.fetchCurrentPrimaryContact()
      this.fetchCurrentPrimaryMagainzeContact()
    }
  },
  computed: {

    // switch classes based on css framework. foundation or bootstrap
    md6col: function () {
      return (this.framework == 'foundation' ? 'medium-6 columns' : 'col-md-6')
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
    btnPrimary: function () {
      return (this.framework == 'foundation' ? 'button button-primary' : 'btn btn-primary')
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

    // Switch verbage of submit button.
    submitBtnLabel: function () {
      return (this.record_exists) ? 'Update Author' : 'Create Author'
    },
  },

  methods: {
    fetchUsers: function (recid) {
      let route = (recid) ? '/api/users/' + recid : '/api/users';
      this.$http.get(route)
      .then((response) => {
        this.users = response.data.newdata

      }).catch((e) => {
        this.formErrors = e.response.data.error.message;
      });
    },
    fetchCurrentRecord: function (recid) {
      this.$http.get('/api/authors/' + recid + '/edit')
      .then((response) => {
        this.record = response.data.data
        this.record.user_id = response.data.data.user_id
        this.fetchUsers(this.record.user_id)
        this.formMessage = {
          isOk: false,
              isErr: false,
              msg: ''
        }

        // Handle un-archiving of authors
        if(this.record.hidden == '1') {
          this.showUnarchive = true
          this.showArchive = false
        } else {
          this.showArchive = true
          this.showUnarchive = false
        }
        this.archiveOnSave = false
        this.unarchiveOnSave = false
      }).catch((e) => {
        this.formErrors = e.response.data.error.message;
      });
    },
    fetchCurrentPrimaryContact: function () {
      this.$http.get('/api/authors/primarycontact')
      .then((response) => {
        this.currentPrimaryContact = response.data.newdata.name;
      }).catch((e) => {
        this.formErrors = e.response.data.error.message;
      });
    },
    fetchCurrentPrimaryMagainzeContact: function () {
      this.$http.get('/api/authors/primarymagazinecontact')
      .then((response) => {
        this.currentPrimaryMagazineContact = response.data.newdata.name;
      }).catch((e) => {
        this.formErrors = e.response.data.error.message;
      });
    },

    submitForm: function (e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      this.record.type = this.type;

      // Decide route to submit form to
      let method = (this.record_exists) ? 'put' : 'post'
      let route = (this.record_exists) ? '/api/authors/' + this.record.id : '/api/authors';

      // Make a couple of changes to the archived record based on the un/archive status selected.
      if(this.archiveOnSave) {
        this.record.is_contact = 0
        this.record.is_principal_contact = 0
        this.record.is_principal_magazine_contact = 0
        this.record.hidden = 1
      } else if (this.unarchiveOnSave) {
        this.record.hidden = 0
      }

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => {
        this.formMessage.msg = 'Author saved'
        this.formMessage.isOk = true // Success message
        this.currentRecordId = response.data.newdata.record_id
        this.record_id = response.data.newdata.record_id
        this.record.id = response.data.newdata.record_id
        this.formMessage.isErr = false
        this.record_exists = true
        this.formErrors = {} // Clear errors?
        this.fetchCurrentRecord(this.record.id)
      }).catch((e) => { // If invalid. error callback
        console.log(e)
        this.formMessage.isOk = false
        this.formMessage.isErr = true
        // Set errors from validation to vue data
        this.formErrors = e.response.data.error.message;
      })
    }
  }
}

</script>
