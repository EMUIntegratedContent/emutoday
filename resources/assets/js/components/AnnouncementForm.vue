<template>
    <form>
        <slot name="csrf"></slot>
        <!-- <slot name="author_id" v-model="newevent.author_id"></slot> -->
        <div class="row">
            <div v-bind:class="md12col">
                <div v-show="formMessage.isOk" :class="calloutSuccess">
                    <h5>{{formMessage.msg}}</h5>
                </div>
            </div>
            <!-- /.small-12 columns -->
        </div>
        <!-- /.row -->
        <div class="row">

            <div v-bind:class="md12col">
                <div v-bind:class="formGroup">
                    <label>Title <span v-bind:class="iconStar" class="reqstar"></span></label>
                    <p class="help-text" id="title-helptext">Please enter a title ({{titleChars}} characters left)</p>
                    <input v-model="record.title" class="form-control" v-bind:class="[formErrors.title ? 'invalid-input' : '']" name="title" type="text">
                    <p v-if="formErrors.title" class="help-text invalid"> Please Include a Title!</p>
                </div>
                <div v-bind:class="formGroup">
                    <label>Announcement <span v-bind:class="iconStar" class="reqstar"></span></i>
                        <p class="help-text" id="announcement-helptext">({{descriptionChars}} characters left)</p>

                        <textarea v-model="record.announcement" class="form-control" v-bind:class="[formErrors.announcement ? 'invalid-input' : '']" name="announcement" type="textarea" rows="8"></textarea>
                    </label>
                    <p v-if="formErrors.announcement" class="help-text invalid">Need a Description!</p>
                </div>
            </div>
            <!-- /.small-12 columns -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div :class="md12col">
                <div v-bind:class="formGroup">
                    <label>External Link</label>
                    <p class="help-text" id="title-helptext">Please enter the url for your external web page. (www.yourlink.com)</p>
                    <div class="input-group">
                        <span :class="inputGroupLabel">http://</span>
                        <input v-model="record.link" class="form-control" v-bind:class="[formErrors.link ? 'invalid-input' : '']" name="link" type="text">
                    </div>
                    <p v-if="formErrors.link" class="help-text invalid">Please make sure url is properly formed.</p>
                </div>
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
        <div class="row">
            <div :class="md4col">
                <div v-bind:class="formGroup">
                    <label>External Link Text</label>
                    <p class="help-text" id="link_txt-helptext">Please enter link text</p>
                    <input v-model="record.link_txt" class="form-control" v-bind:class="[formErrors.link_txt ? 'invalid-input' : '']" name="link_txt" type="text">
                    <p v-if="formErrors.link_txt" class="help-text invalid"> Please include a descriptive text for your external link.</p>
                </div>
            </div><!-- /.col-md-4 -->
            <div :class="md8col">
                <template v-if="record.link_txt">
                <div v-bind:class="formGroup">
                    <label>Example of External Link</label>
                    <p class="help-text">Below is how it may look. </p>
                    <h5 class="form-control">For more information visit: <a href="#"> {{record.link_txt}}</a>.</h5>
                </div>
                </template>
            </div><!-- /.md6col -->
        </div>
        <div class="row">
            <div :class="md12col">
                <div v-bind:class="formGroup">
                    <label>Email Link</label>
                    <p class="help-text" id="title-helptext">Please enter the url for your external web page. (www.yourlink.com)</p>
                    <div class="input-group">
                        <span :class="inputGroupLabel">mailto:</span>
                        <input v-model="record.email_link" class="form-control" v-bind:class="[formErrors.email_link ? 'invalid-input' : '']" name="email_link" type="text">
                    </div>
                    <p v-if="formErrors.email_link" class="help-text invalid">Please make sure email is properly formed.</p>
                </div>
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
        <div class="row">
            <div :class="md4col">
                <div v-bind:class="formGroup">
                    <label>Email Link Text</label>
                    <p class="help-text" id="email-link-helptext">Please enter email link text</p>
                    <input v-model="record.email_link_txt" class="form-control" v-bind:class="[formErrors.email_link_txt ? 'invalid-input' : '']" name="email_link_txt" type="text">
                </div>
            </div><!-- /.col-md-4 -->
            <div :class="md8col">
                <template v-if="record.email_link">
                <div v-bind:class="formGroup">
                    <label>Example of Email Link</label>
                    <p class="help-text">Below is how it may look. </p>
                    <h5 class="form-control">To request more information click: <a href="#"> {{record.email_link_txt}}</a>.</h5>
                </div>
                </template>
            </div><!-- /.md6col -->
        </div>
        <div class="row">

            <div v-bind:class="md6col">
                <div v-bind:class="formGroup">
                    <label for="start-date">Start Date: <span v-bind:class="iconStar" class="reqstar"></span></label>
                    <input id="start-date"  v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text">

                    <!-- <input v-if="startdate" :class="formControl" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text" :value="startdate" :initval="startdate"  v-flatpickr="startdate"> -->

                    <!-- <input id="start-date" :class="formControl" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text" :value="record.start_date" /> -->
                    <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
                </div>
                <!--form-group -->
            </div>
            <!-- /.small-6 columns -->
            <div v-bind:class="md6col">
                <div v-bind:class="formGroup">
                    <!-- <input id="my-end-date" v-dtpicker ddate="currentDate" /> -->
                    <label for="end-date">End Date: <span v-bind:class="iconStar" class="reqstar"></span></label>
                    <input id="end-date" v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" type="text" :value="record.end_date" />
                    <!-- <template v-if="hasStartDate">
                        <input id="end-date" v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" type="text" v-model="record.end_date"   />

                    </template>
                    <template v-else>
                    <input v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" type="text" v-model="record.end_date"  disabled="disabled" />

                </template> -->
                    <!-- <datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate"></datepicker> -->
                    <p v-if="formErrors.end_date" class="help-text invalid">Need an End Date</p>

                </div>
                <!--form-group -->
            </div>
            <!-- /.small-6 columns -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div v-bind:class="md12col">
                <div v-bind:class="formGroup">
                    <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{submitBtnLabel}}</button>
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


    /*[type='text'], [type='password'], [type='date'], [type='datetime'], [type='datetime-local'], [type='month'], [type='week'], [type='email'], [type='number'], [type='search'], [type='tel'], [type='time'], [type='url'], [type='color'],
    textarea {
        margin: 0;
        padding: 0;
        padding-left: 8px;
        width: 100%;
    }
    [type='file'], [type='checkbox'], [type='radio'] {
        margin: 0;
        margin-left: 8px;
        padding: 0;
        padding-left: 2px;
    }*/

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
    height: 34px;
    padding: 6px 12px;
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
    /*h5.ext-example {
        border: 1px solid #ccc;
    }*/

    /*
    input[type='email'],
    input[type='number'],
    input[type='password'],
    input[type='search'],
    input[type='tel'],
    input[type='text'],
    input[type='url'],
    textarea,
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: transparent;
        border: 0.1rem solid #d1d1d1;
        border-radius: 0.4rem;
        box-shadow: none;
        height: 3.8rem;
        padding: 0.6rem 1rem;
        width: 100%;
    }
    input[type='email']:focus,
    input[type='number']:focus,
    input[type='password']:focus,
    input[type='search']:focus,
    input[type='tel']:focus,
    input[type='text']:focus,
    input[type='url']:focus,
    textarea:focus,
    select:focus {
        border: 0.1rem solid #9b4dca;
        outline: 0;
    }*/


    /*select {
        padding: 0.6rem 3rem 0.6rem 1rem;
        background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIgICB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiICAgeG1sbnM6aW5rc2NhcGU9Imh0dHA6Ly93d3cuaW5rc2NhcGUub3JnL25hbWVzcGFjZXMvaW5rc2NhcGUiICAgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjkgMTQiICAgaGVpZ2h0PSIxNHB4IiAgIGlkPSJMYXllcl8xIiAgIHZlcnNpb249IjEuMSIgICB2aWV3Qm94PSIwIDAgMjkgMTQiICAgd2lkdGg9IjI5cHgiICAgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgICBpbmtzY2FwZTp2ZXJzaW9uPSIwLjQ4LjQgcjk5MzkiICAgc29kaXBvZGk6ZG9jbmFtZT0iY2FyZXQtZ3JheS5zdmciPjxtZXRhZGF0YSAgICAgaWQ9Im1ldGFkYXRhMzAzOSI+PHJkZjpSREY+PGNjOldvcmsgICAgICAgICByZGY6YWJvdXQ9IiI+PGRjOmZvcm1hdD5pbWFnZS9zdmcreG1sPC9kYzpmb3JtYXQ+PGRjOnR5cGUgICAgICAgICAgIHJkZjpyZXNvdXJjZT0iaHR0cDovL3B1cmwub3JnL2RjL2RjbWl0eXBlL1N0aWxsSW1hZ2UiIC8+PC9jYzpXb3JrPjwvcmRmOlJERj48L21ldGFkYXRhPjxkZWZzICAgICBpZD0iZGVmczMwMzciIC8+PHNvZGlwb2RpOm5hbWVkdmlldyAgICAgcGFnZWNvbG9yPSIjZmZmZmZmIiAgICAgYm9yZGVyY29sb3I9IiM2NjY2NjYiICAgICBib3JkZXJvcGFjaXR5PSIxIiAgICAgb2JqZWN0dG9sZXJhbmNlPSIxMCIgICAgIGdyaWR0b2xlcmFuY2U9IjEwIiAgICAgZ3VpZGV0b2xlcmFuY2U9IjEwIiAgICAgaW5rc2NhcGU6cGFnZW9wYWNpdHk9IjAiICAgICBpbmtzY2FwZTpwYWdlc2hhZG93PSIyIiAgICAgaW5rc2NhcGU6d2luZG93LXdpZHRoPSI5MDMiICAgICBpbmtzY2FwZTp3aW5kb3ctaGVpZ2h0PSI1OTQiICAgICBpZD0ibmFtZWR2aWV3MzAzNSIgICAgIHNob3dncmlkPSJ0cnVlIiAgICAgaW5rc2NhcGU6em9vbT0iMTIuMTM3OTMxIiAgICAgaW5rc2NhcGU6Y3g9Ii00LjExOTMxODJlLTA4IiAgICAgaW5rc2NhcGU6Y3k9IjciICAgICBpbmtzY2FwZTp3aW5kb3cteD0iNTAyIiAgICAgaW5rc2NhcGU6d2luZG93LXk9IjMwMiIgICAgIGlua3NjYXBlOndpbmRvdy1tYXhpbWl6ZWQ9IjAiICAgICBpbmtzY2FwZTpjdXJyZW50LWxheWVyPSJMYXllcl8xIj48aW5rc2NhcGU6Z3JpZCAgICAgICB0eXBlPSJ4eWdyaWQiICAgICAgIGlkPSJncmlkMzA0MSIgLz48L3NvZGlwb2RpOm5hbWVkdmlldz48cG9seWdvbiAgICAgcG9pbnRzPSIwLjE1LDAgMTQuNSwxNC4zNSAyOC44NSwwICIgICAgIGlkPSJwb2x5Z29uMzAzMyIgICAgIHRyYW5zZm9ybT0ibWF0cml4KDAuMzU0MTEzODcsMCwwLDAuNDgzMjkxMSw5LjMyNDE1NDUsMy42MjQ5OTkyKSIgICAgIHN0eWxlPSJmaWxsOiNkMWQxZDE7ZmlsbC1vcGFjaXR5OjEiIC8+PC9zdmc+) center right no-repeat;
    }
    select:focus {
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIgICB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiICAgeG1sbnM6aW5rc2NhcGU9Imh0dHA6Ly93d3cuaW5rc2NhcGUub3JnL25hbWVzcGFjZXMvaW5rc2NhcGUiICAgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjkgMTQiICAgaGVpZ2h0PSIxNHB4IiAgIGlkPSJMYXllcl8xIiAgIHZlcnNpb249IjEuMSIgICB2aWV3Qm94PSIwIDAgMjkgMTQiICAgd2lkdGg9IjI5cHgiICAgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgICBpbmtzY2FwZTp2ZXJzaW9uPSIwLjQ4LjQgcjk5MzkiICAgc29kaXBvZGk6ZG9jbmFtZT0iY2FyZXQuc3ZnIj48bWV0YWRhdGEgICAgIGlkPSJtZXRhZGF0YTMwMzkiPjxyZGY6UkRGPjxjYzpXb3JrICAgICAgICAgcmRmOmFib3V0PSIiPjxkYzpmb3JtYXQ+aW1hZ2Uvc3ZnK3htbDwvZGM6Zm9ybWF0PjxkYzp0eXBlICAgICAgICAgICByZGY6cmVzb3VyY2U9Imh0dHA6Ly9wdXJsLm9yZy9kYy9kY21pdHlwZS9TdGlsbEltYWdlIiAvPjwvY2M6V29yaz48L3JkZjpSREY+PC9tZXRhZGF0YT48ZGVmcyAgICAgaWQ9ImRlZnMzMDM3IiAvPjxzb2RpcG9kaTpuYW1lZHZpZXcgICAgIHBhZ2Vjb2xvcj0iI2ZmZmZmZiIgICAgIGJvcmRlcmNvbG9yPSIjNjY2NjY2IiAgICAgYm9yZGVyb3BhY2l0eT0iMSIgICAgIG9iamVjdHRvbGVyYW5jZT0iMTAiICAgICBncmlkdG9sZXJhbmNlPSIxMCIgICAgIGd1aWRldG9sZXJhbmNlPSIxMCIgICAgIGlua3NjYXBlOnBhZ2VvcGFjaXR5PSIwIiAgICAgaW5rc2NhcGU6cGFnZXNoYWRvdz0iMiIgICAgIGlua3NjYXBlOndpbmRvdy13aWR0aD0iOTAzIiAgICAgaW5rc2NhcGU6d2luZG93LWhlaWdodD0iNTk0IiAgICAgaWQ9Im5hbWVkdmlldzMwMzUiICAgICBzaG93Z3JpZD0idHJ1ZSIgICAgIGlua3NjYXBlOnpvb209IjEyLjEzNzkzMSIgICAgIGlua3NjYXBlOmN4PSItNC4xMTkzMTgyZS0wOCIgICAgIGlua3NjYXBlOmN5PSI3IiAgICAgaW5rc2NhcGU6d2luZG93LXg9IjUwMiIgICAgIGlua3NjYXBlOndpbmRvdy15PSIzMDIiICAgICBpbmtzY2FwZTp3aW5kb3ctbWF4aW1pemVkPSIwIiAgICAgaW5rc2NhcGU6Y3VycmVudC1sYXllcj0iTGF5ZXJfMSI+PGlua3NjYXBlOmdyaWQgICAgICAgdHlwZT0ieHlncmlkIiAgICAgICBpZD0iZ3JpZDMwNDEiIC8+PC9zb2RpcG9kaTpuYW1lZHZpZXc+PHBvbHlnb24gICAgIHBvaW50cz0iMjguODUsMCAwLjE1LDAgMTQuNSwxNC4zNSAiICAgICBpZD0icG9seWdvbjMwMzMiICAgICB0cmFuc2Zvcm09Im1hdHJpeCgwLjM1NDExMzg3LDAsMCwwLjQ4MzI5MTEsOS4zMjQxNTUzLDMuNjI1KSIgICAgIHN0eWxlPSJmaWxsOiM5YjRkY2Y7ZmlsbC1vcGFjaXR5OjEiIC8+PC9zdmc+);
    }*/


    /*textarea {
        padding-bottom: 0.6rem;
        padding-top: 0.6rem;
        min-height: 8rem;
    }

    label,
    legend {
        font-size: 1.6rem;
        font-weight: 700;
        display: block;
        margin-bottom: 0.5rem;
    }

    fieldset {
        border-width: 0;
        padding: 0;
    }

    input[type='checkbox'],
    input[type='radio'] {
        display: inline;
    }

    .label-inline {
        font-weight: normal;
        display: inline-block;
        margin-left: 0.5rem;
    }

    .container {
        margin: 0 auto;
        max-width: 112rem;
        padding: 0 2rem;
        position: relative;
        width: 100%;
    }*/

</style>


<script>

// var moment = require('moment')
import moment from 'moment';
import flatpickr from 'flatpickr';
module.exports = {
    directives: {},
    components: {},
    props: {
        authorid: {
            default: '0'
        },
        recordexists: {
            default: false
        },
        recordid: {
            default: ''
        },
        framework: {
            default: 'foundation'
        }
    },
    data: function() {
        return {
            startdatePicker: null,
            enddatePicker: null,

            currentDate: {},
            dateObject: {
                startDateMin: '',
                startDateDefault: '',
                endDateMin:'',
                endDateDefault: ''
            },
            record: {
                title: '',
                announcement: '',
                start_date: '',
                end_date: '',
                approved_date: '',
                submission_date: '',
                is_approved: 0,
                is_archived: 0,
                is_promoted: 0,
                link_txt: '',
                link: ''
            },
            // dateOptions: {
            //     minDate: "today",
            //     enableTime: false,
            //     altFormat: "m-d-Y",
            //     altInput: true,
            //     altInputClass:"form-control",
            //     dateFormat: "Y-m-d",
            // },
            totalChars: {
                start: 0,
                title: 50,
                announcement: 255
            },
            response: {

            },
            formMessage: {
                isOk: false,
                msg: ''
            },
            formInputs: {},
            formErrors: {}
        }
    },
    created: function() {
        this.currentDate = moment();
        console.log('this.currentDate=' + this.currentDate)
    },
    ready() {
        this.record.user_id = this.authorid;
        if(this.recordexists){
            console.log('recordid'+ this.recordid)
            this.fetchCurrentRecord(this.recordid)
        } else {
            //this.record.start_date = this.currentDate;
            this.setupDatePickers();
        }




        //
        //    if (this.date)
        //        this.$refs.flatpickr.value = this.date;
    },
    // ready: function() {
    //
    //         if(this.recordexists){
    //             console.log('editeventid'+ this.editid)
    //             this.fetchCurrentRecord(this.editid)
    //
    //         }
    //
    // },


    computed: {
        md6col: function() {
            return (this.framework == 'foundation' ? 'medium-6 columns' : 'col-md-6')
        },
        md12col: function() {
            return (this.framework == 'foundation' ? 'medium-12 columns' : 'col-md-12')
        },
        md8col: function() {
            return (this.framework == 'foundation' ? 'medium-8 columns' : 'col-md-8')
        },
        md4col: function() {
            return (this.framework == 'foundation' ? 'medium-4 columns' : 'col-md-4')
        },
        btnPrimary: function() {
            return (this.framework == 'foundation' ? 'button button-primary' : 'btn btn-primary')
        },
        formGroup: function() {
            return (this.framework == 'foundation' ? 'form-group' : 'form-group')
        },
        formControl: function() {
            return (this.framework == 'foundation' ? '' : 'form-control')
        },
        calloutSuccess:function(){
            return (this.framework == 'foundation')? 'callout success':'alert alert-success'

        },

        iconStar: function() {
            return (this.framework == 'foundation' ? 'fi-star ' : 'fa fa-star')
        },
        inputGroupLabel:function(){
                return (this.framework=='foundation')?'input-group-label':'input-group-addon'
        },
        submitBtnLabel:function(){

            return (this.recordexists)?'Update Announcement': 'Submit For Approval'
        },
        // disableEndDate: function(){
        //     if (this.record.start_date === undefined || this.record.start_date == '') {
        //         return true
        //     } else {
        //         return false
        //     }
        // },
        // readyForEndDate: function() {
        //     console.log('record' + this.record.start_date)
        //     if (this.record.start_date === undefined || this.record.start_date == '') {
        //         return false
        //     } else {
        //         return true
        //     }
        //
        // },
        hasStartDate: function() {
            if (this.record.start_date === undefined || this.record.start_date == '') {
                return false
            } else {
                return true
            }

        },
        titleChars: function() {
            var str = this.record.title;


            console.log(str.length);
            var cclength = str.length;
            return this.totalChars.title - cclength;
            // this.totalChars.title - (this.newevent.title).length
        },
        descriptionChars: function() {
            var str = this.record.announcement;
            console.log(str.length);
            var cclength = str.length;
            return this.totalChars.announcement - cclength;
            // this.totalChars.title - (this.newevent.title).length
        }

    },
    methods: {
    //     checkSetEndDate: function() {
    //         document.getElementById("end-date").flatpickr({
    //             disable: [
    //                 {
    //                     from: "2016-08-16",
    //                     to: "2016-08-19"
    //                 },
    //         "2016-08-24",
    //         new Date().fp_incr(30) // 30 days from now
    //     ]
    // });
    //     },
        readyAgain: function() {

        },
        fetchCurrentRecord: function(recid) {
            this.$http.get('/api/announcement/' + recid + '/edit')

            .then((response) => {
                //response.status;
                console.log('response.status=' + response.status);
                console.log('response.ok=' + response.ok);
                console.log('response.statusText=' + response.statusText);
                console.log('response.data=' + response.data);
                // data = response.data;
                this.$set('record', response.data.data)
                //this.record = response.data.data;
                console.log('this.record= ' + this.record);

                this.checkOverData();
            }, (response) => {
                //error callback
                console.log("ERRORS");

                this.formErrors = response.data.error.message;

            }).bind(this);
        },
        checkOverData: function() {
            console.log('this.record' + this.record.id)

            if(this.startdatePicker === null){
                this.setupDatePickers();
            }
            // this.setupDatePickers();
            //this.startdate = this.record.start_date;

        },
        setupDatePickers:function(){
            var self = this;
            console.log("setupDatePickers");
            if (this.record.start_date === '') {
                this.dateObject.startDateMin = this.currentDate;
                this.dateObject.startDateDefault = null;

                this.dateObject.endDateMin = null;
                this.dateObject.endDateDefault = null;
            } else {
                this.dateObject.startDateMin = this.record.start_date;
                this.dateObject.startDateDefault = this.record.start_date;
                this.dateObject.endDateMin = this.record.start_date;
                this.dateObject.endDateDefault = this.record.end_date;
            }
            this.startdatePicker = flatpickr(document.getElementById("start-date"), {
                minDate: self.dateObject.startDateMin,
                defaultDate: self.dateObject.startDateDefault,
                enableTime: false,
                altFormat: "m-d-Y",
                altInput: true,
                altInputClass: "form-control",
                dateFormat: "Y-m-d",
                // minDate: new Date(),
                onChange(dateObject, dateString) {
                    self.enddatePicker.set("minDate", dateObject);
                    self.record.start_date = dateString;
                    self.startdatePicker.value = dateString;
                }

            });

            this.enddatePicker = flatpickr(document.getElementById("end-date"), {
                minDate: self.dateObject.endDateMin,
                defaultDate: self.dateObject.endDateDefault,
                enableTime: false,
                altFormat: "m-d-Y",
                altInput: true,
                altInputClass: "form-control",
                dateFormat: "Y-m-d",
                // minDate: new Date(),
                onChange(dateObject, dateString) {
                    self.startdatePicker.set("maxDate", dateObject);
                    self.record.end_date = dateString;
                    self.enddatePicker.value = dateString;
                }

            });
        },


        submitForm: function(e) {
            //  console.log('this.eventform=' + this.eventform.$valid);
            e.preventDefault();
            // this.newevent.start_date = this.sdate;
            // this.newevent.end_date = this.edate;
            // this.newevent.reg_deadline = this.rdate;
            this.record.user_id = this.authorid;
            let tempid;
            if (typeof this.currentRecordId != 'undefined'){
                tempid = this.currentRecordId;
            } else {
                tempid =this.record.id;
            }
            let method = (this.recordexists) ? 'put' : 'post'
            let route =  (this.recordexists) ? '/api/announcement/' + tempid : '/api/announcement/';


          //   this.$http.post('/api/story', this.record)
            this.$http[method](route, this.record)

            //this.$http.post('/api/announcement', this.record)

            .then((response) => {
                //response.status;
                console.log('response.status=' + response.status);
                console.log('response.ok=' + response.ok);
                console.log('response.statusText=' + response.statusText);
                console.log('response.data=' + response.data.message);
                this.formMessage.msg = response.data.message;
                this.currentRecordId = response.data.newdata.record_id;
                this.formMessage.isOk = response.ok;
                this.recordexists = true;
                // this.record.id = this.currentRecordId;
                this.formErrors = {};
                this.fetchCurrentRecord(this.currentRecordId)

            }, (response) => {
                //error callback
                this.formErrors = response.data.error.message;
            }).bind(this);
        }
    },
    watch: {

    },

    filters: {
        momentstart: {
            read: function(val) {
                console.log('read-val' + val)

                return val ? val : '';
            },
            write: function(val, oldVal) {
                console.log('write-val' + val + '--' + oldVal)
                return moment(val).format('MM-DD-YYYY');
            }
        },
        momentfilter: {
            read: function(val) {
                console.log('read-val' + val)

                return val ? moment(val).format('MM-DD-YYYY') : '';
            },
            write: function(val, oldVal) {
                console.log('write-val' + val + '--' + oldVal)

                return moment(val).format('YYYY-MM-DD');
            }
        },
    },
    events: {

        // 'building-change':function(name) {
        // 	this.newbuilding = '';
        // 	this.newbuilding = name;
        // 	console.log(this.newbuilding);
        // },
        // 'categories-change':function(list) {
        // 	this.categories = '';
        // 	this.categories = list;
        // 	console.log(this.categories);
        // }
    }
};

</script>
