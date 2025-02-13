<template>
  <div class="eventview">
    <a v-on:click.prevent="toggleBody" href="#">
      <h6>{{ item.title }}<span class="event-cancel" v-if="item.is_canceled"> - canceled</span></h6>
    </a>
    <template v-if="item.all_day">
      <p>All Day</p>
    </template>
    <template v-else>
      <p v-if="item.no_end_time">{{ item.start_time }}</p>
      <p v-else>
        From: {{ item.start_time }} to {{ item.end_time }}
      </p>
    </template>
    <template v-if="isOnCampus">
      <a :href="'https://www.emich.edu/map/?location='+item.building" target="_blank">{{ item.location }}</a>
    </template>
    <template v-else>
      <p>{{ item.location }}</p>
    </template>

    <transition name="expand" mode="out-in">
      <div class="event-item" v-if="showBody">
        <div class="new-cal"><span v-html="addToCalendar.innerHTML"></span></div>
        <p>{{ item.description }}</p>
        <template v-if="item.contact_person || item.contact_person || item.contact_person">
          <p>Contact:</p>
          <ul>
            <li v-if="item.contact_person">{{ item.contact_person }}</li>
            <li v-if="item.contact_email">Email: <a :href="'mailto:'+item.contact_email">{{ item.contact_email }}</a>
            </li>
            <li v-if="item.contact_phone">Phone: <a :href="'tel:'+item.contact_phone">{{ item.contact_phone }}</a></li>
          </ul>
        </template>
        <template v-if="item.related_link_1">
          <p>For more information, visit:</p>
          <ul>
            <li><a :href="hasHttp(item.related_link_1)" target="_blank">
              <template v-if="item.related_link_1_txt">{{ item.related_link_1_txt }}</template>
              <template v-else>{{ item.related_link_1 }}</template>
            </a></li>
            <li v-if="item.related_link_2"><a :href="hasHttp(item.related_link_2)" target="_blank">
              <template v-if="item.related_link_2_txt">{{ item.related_link_2_txt }}</template>
              <template v-else>{{ item.related_link_2 }}</template>
            </a></li>
            <li v-if="item.related_link_3"><a :href="hasHttp(item.related_link_3)" target="_blank">
              <template v-if="item.related_link_3_txt">{{ item.related_link_3_txt }}</template>
              <template v-else>{{ item.related_link_3 }}</template>
            </a></li>
          </ul>
        </template>
        <p v-if="item.free">Cost: Free</p>
        <p v-else>
          <template v-if="isNumeric(item.cost)">
            Cost: {{ currency(item.cost) }}
          </template>
          <template v-else>
            Cost: {{ item.cost }}
          </template>
        </p>
        <p>{{ eventParticipation }}</p>
        <p>LBC Approved: {{ yesNo(item.lbc_approved) }}</p>
        <p v-if="item.hsc_rewards">Eagle Rewards: {{ item.hsc_rewards }}</p>
        <template v-if="item.tickets">
          <p v-if="item.ticket_details_online"><a :href="hasHttp(item.ticket_details_online)">Get Tickets Online</a>
          </p>
          <p v-if="item.ticket_details_phone">For tickets, call {{ item.ticket_details_phone }}.</p>
          <p v-if="item.ticket_details_office">For tickets, visit {{ item.ticket_details_office }}.</p>
          <p v-if="item.ticket_details_other">Or {{ item.ticket_details_other }}</p>
        </template>
      </div>
    </transition>
  </div>
</template>
<style>
.eventview {
  padding-top: 0.8rem;
  padding-bottom: 0.3rem;
  border-bottom: 1px dotted #bebdbd;
}

.event-cancel {
  font-size: 90%;
  font-weight: normal;
  color: #b20c0c;
}

h6 {
  color: #0f654a;
}

p {
  padding: 0;
  margin: 0;
  line-height: 1.4rem;
  font-size: 1rem;
}

div.event-item {
  padding-left: 1rem;
}

p.description {
  padding-left: 1rem;
}

.expand-enter-active, .expand-leave-active {
  transition: all .7s;
  max-height: 1000px;
}

.expand-enter, .expand-leave-to {
  opacity: 0;
  max-height: 0px;
}

/* BUTTON STYLES */
.add-to-calendar-checkbox {
  padding: 10px;
  box-shadow: 0 0 0 0.5px rgba(50, 50, 93, .17), 0 2px 5px 0 rgba(50, 50, 93, .1), 0 1px 1.5px 0 rgba(0, 0, 0, .07), 0 1px 2px 0 rgba(0, 0, 0, .08), 0 0 0 0 transparent !important;
  color: #000;
  font-size: 15px;
  text-decoration: none;
  max-width: 155px;
  margin: 5px 0px 20px 0px;
}

.add-to-calendar-checkbox:hover {
  background-color: #fafafa;
}
</style>
<script>

import moment from 'moment'

export default {
  components: {},
  props: ['item', 'index', 'targeteventid'],
  data: function () {
    return {
      showBody: false,
      eventRange: {},
      addToCalendar: null,
    }
  },
  mounted () {
    const start_datetime = moment(this.calendarDate(this.item.start_date) + ' ' + this.convertTimeformat(this.item.start_time), 'YYYY-MM-DD HH:mm:ss');
    const end_datetime = moment(this.calendarDate(this.item.end_date) + ' ' + this.convertTimeformat(this.item.end_time), 'YYYY-MM-DD HH:mm:ss');

    this.addToCalendar = createCalendar({
      options: {
        class: 'addtocal-btn',
        id: 'event-' + this.item.id                                // You need to pass an ID. If you don't, one will be generated for you.
      },
      data: {
        title: this.item.title,     // Event title
        start: new Date(start_datetime), // Event start date
        end: new Date(end_datetime), // You can also choose to set an end time.
        address: this.item.location,
        description: this.item.description,
        timezone: 'America/Detroit'
      }
    });
    if (this.item.id == this.targeteventid) {
      this.showBody = true;
    }
    else {
      this.showBody = false;
    }
    /** UNCOMMENT THIS FOR AddEvent plugin **/
    //setTimeout(function(){addeventatc.refresh();}, 300);
  },
  computed: {
    isOnCampus: function () {
      if (this.item.building === null || this.item.building === "undefined") {
        return false
      }
      else {
        return true
      }

    },
    eventParticipation: function () {
      switch (this.item.participants) {
        case 'campus':
          return 'Campus Only'
        case 'public':
          return 'Open to Public'
        case 'students':
          return 'Students Only'
        case 'employees':
          return 'Employees Only'
        case 'invite':
          return 'Invitation Only'
        case 'tickets':
          return 'Tickets Required'
        default:
          return ''
      }

    }
  },
  methods: {
    currency (amount) {
      if (isNaN(amount)) {
        return amount
      }
      return '$' + parseFloat(amount).toFixed(2)
    },
    yesNo: function (value) {
      return (value == true) ? 'Yes' : 'No';
    },
    hasHttp: function (value) { // Checks if links given 'http'
      return (value.substr(0, 4)) == 'http' ? value : 'https://' + value;
    },
    isNumeric: function (n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
    },
    toggleBody: function (ev) {

      if (this.showBody == false) {
        this.showBody = true;
      }
      else {
        this.showBody = false;
      }
      /** UNCOMMENT THIS FOR AddEvent plugin **/
      //setTimeout(function(){addeventatc.refresh();}, 300);
    },
    sortKeyInt: function ($key) {
      return parseInt($key);
    },
    calendarDate: function (value) {
      const arr = value.split(' ');
      return arr[0]
    },
    convertTimeformat: function (time) {
      let hours = Number(time.match(/^(\d+)/)[1])
      let minutes = Number(time.match(/:(\d+)/)[1])
      let AMPM = time.match(/\s(.*)$/)[1]
      if (AMPM == "p.m." && hours < 12) {
        hours = hours + 12
      }
      if (AMPM == "a.m." && hours == 12) {
        hours = hours - 12
      }
      let sHours = hours.toString()
      let sMinutes = minutes.toString()
      if (hours < 10) {
        sHours = "0" + sHours
      }
      if (minutes < 10) {
        sMinutes = "0" + sMinutes
      }
      return sHours + ':' + sMinutes
    }
  }
}
</script>
