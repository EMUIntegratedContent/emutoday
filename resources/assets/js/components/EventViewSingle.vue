<template>
  <div class="eventview">
    <a v-on:click.prevent="toggleBody" href="#">
      <h6>{{item.title}}<span class="event-cancel" v-if="item.is_canceled"> - canceled</span></h6>
    </a>
    <template v-if="item.all_day">
      <p>All Day</p>
    </template>
    <template v-else>
      <p v-if="item.no_end_time">{{item.start_time}}</p>
      <p v-else>
        From: {{item.start_time}} to {{item.end_time}}
      </p>
    </template>
    <template v-if="isOnCampus">
      <a href="https://emich.edu/map/?location={{item.building}}" target="_blank">{{item.location}}</a>
    </template>
    <template v-else>
      <p>{{item.location}}</p>
    </template>

    <div class="event-item" v-if="showBody" transition="expand">
        <!-- AddEvent plugin script -->
        <div title="Add to Calendar" class="addeventatc">
            Add to Calendar
            <span class="start">{{ item.start_date | calendarDate }} {{ item.start_time | amPm }}</span>
            <span class="end">{{item.end_date | calendarDate }} {{ item.end_time | amPm }}</span>
            <span class="timezone">America/Detroit</span>
            <span class="title">{{item.title}}</span>
            <span class="description">{{item.description}}</span>
            <span class="location">{{item.location}}</span>
            <span class="organizer">{{item.contact_person}}</span>
            <span class="organizer_email">{{item.contact_email}}</span>
            <span class="all_day_event">{{ item.all_day ? true : false }}</span>
            <span class="date_format">YYYY-MM-DD</span>
            <span class="client">atdkyfGQrzEzDlSNTmQU26933</span>
        </div><br /><br />

      <p>{{item.description}}</p>
      <template v-if="item.contact_person || item.contact_person || item.contact_person">
        <p>Contact:</p>
        <ul>
          <li v-if="item.contact_person">{{item.contact_person}}</li>
          <li v-if="item.contact_email">Email: {{item.contact_email}}</li>
          <li v-if="item.contact_phone">Phone: {{item.contact_phone}}</li>
        </ul>
      </template>
      <template v-if="item.related_link_1">
        <p>For more information, visit:</p>
        <ul>
          <li><a href="{{item.related_link_1 | hasHttp}}" target="_blank">
            <template v-if="item.related_link_1_txt">{{item.related_link_1_txt}}</template>
            <template v-else>{{item.related_link_1}}</template>
          </a></li>
          <li v-if="item.related_link_2"><a href="{{item.related_link_2 | hasHttp}}" target="_blank">
            <template v-if="item.related_link_2_txt">{{item.related_link_2_txt}}</template>
            <template v-else>{{item.related_link_2}}</template>
          </a></li>
          <li v-if="item.related_link_3"><a href="{{item.related_link_3 | hasHttp}}" target="_blank">
            <template v-if="item.related_link_3_txt">{{item.related_link_3_txt}}</template>
            <template v-else>{{item.related_link_3}}</template>
          </a></li>
        </ul>
      </template>
      <p v-if="item.free">Cost: Free</p>
      <p v-else>
        <template v-if="item.cost | isNumeric">
          Cost: {{item.cost | currency }}
        </template>
        <template v-else>
          Cost: {{item.cost}}
        </template>
      </p>
      <p>{{eventParticipation}}</p>
      <p>LBC Approved: {{item.lbc_approved | yesNo }}</p>
      <p v-if="item.hsc_rewards">Eagle Rewards: {{item.hsc_rewards}}</p>
      <template v-if="item.tickets">
        <p v-if="item.ticket_details_online"><a href="{{item.ticket_details_online | hasHttp}}">Get Tickets Online</a></p>
        <p v-if="item.ticket_details_phone">For tickets, call {{item.ticket_details_phone}}.</p>
        <p v-if="item.ticket_details_office">For tickets, visit {{item.ticket_details_office}}.</p>
        <p v-if="item.ticket_details_other">Or {{item.ticket_details_other}}</p>
      </template>
    </div>
  </div>

</template>
<style>
.eventview {
  padding-top: 0.8rem;
  padding-bottom: 0.3rem;
  border-bottom: 1px dotted  #bebdbd;
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
  margin:0;
  line-height: 1.4rem;
  font-size: 1rem;
}
div.event-item {
  padding-left: 1rem;
}
p.description {
  padding-left: 1rem;
}
/* always present */
.expand-transition {
  transition: all .6s ease;
  height: 100%;
  padding: 10px;
  background-color: #fff;
  overflow: hidden;
}
/* .expand-enter defines the starting state for entering */
/* .expand-leave defines the ending state for leaving */
.expand-enter, .expand-leave {
  height: 0;
  padding: 0 10px;
  opacity: 0;
}
</style>
<script>
module.exports  = {
  components: {},
  props:['item','$index','targeteventid'],
  data: function() {
    return {
      showBody: false,
      eventRange: {}
    }
  },
  ready() {
    if(this.item.id == this.targeteventid){
      this.showBody = true;
    } else {
      this.showBody = false;
    }
    console.log(this.item)
    setTimeout(function(){addeventatc.refresh();}, 300);
  },
  computed: {

    isOnCampus:function(){
      if(this.item.building === null || this.item.building === "undefined"){
        return false
      } else {
        return true
      }

    },
    eventParticipation:function(){
      switch (this.item.participants){
        case 'campus':
        return 'Campus Only'
        break;
        case 'public':
        return 'Open to Public'
        break;
        case 'students':
        return 'Students Only'
        break;
        case 'invite':
        return 'Invitation Only'
        break;
        case 'tickets':
        return 'Tickets Required'
        break;
        default:
        return ''
      }

    }
  },
  methods: {
    toggleBody: function(ev) {

      if(this.showBody == false) {
        this.showBody = true;
      } else {
        this.showBody = false;
      }
      console.log('toggleBody' + this.showBody)
      setTimeout(function(){addeventatc.refresh();}, 300);
    },
    sortKeyInt: function ($key) {
      return parseInt($key);
    },
  },
  filters: {
    reformatDate: function (value) {
      var arr = value.split('-');
      return arr[1] + '/' + arr[2] + '/' + arr[0];
    },
    calendarDate: function (value) {
      var arr = value.split(' ');
      return arr[0]
    },
    amPm: function (value) {
        if(value){
            var arr = value.split(' ');

            if(arr[1] == 'a.m.'){
                return arr[0] + ' AM'
            }
            if(arr[1] == 'p.m.'){
                return arr[0] + ' PM'
            }
            return value
        }
        return
    },
    yesNo: function(value) {
      return (value == true) ? 'Yes' : 'No';
    },
    hasHttp: function(value) { // Checks if links given 'http'
      return (value.substr(0, 4)) == 'http' ? value : 'https://'+value;
    },
    isNumeric: function(n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
    }
  },
  watch: {},
  events: {}
};
</script>
