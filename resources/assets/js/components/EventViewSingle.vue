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
      <a href="http://emich.edu/maps/?building={{item.building}}" target="_blank">{{item.location}}</a>
    </template>
    <template v-else>
      <p>{{item.location}}</p>
    </template>

    <div class="event-item" v-if="showBody" transition="expand">
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
        <p>Additional Information:</p>
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
      <p v-else>Cost: {{item.cost | currency }}</p>
      <p>{{eventParticipation}}</p>
      <p>LBC Approved: {{item.lbc_approved | yesNo }}</p>
      <template v-if="item.tickets">
        <p v-if="item.ticket_details_online">For Tickets Visit: <a href="{{item.ticket_details_online | hasHttp}}">{{item.ticket_details_online}}</a></p>
        <p v-if="item.ticket_details_phone">For Tickets Call: {{item.ticket_details_phone}}</p>
        <p v-if="item.ticket_details_office">For Tickets Office: {{item.ticket_details_office}}</p>
        <p v-if="item.ticket_details_other">Or: {{item.ticket_details_other}}</p>
      </template>

      <!--<form method="POST" action="api/calendar/addevent">
        <input type="hidden" name="eventId" value="{{item.id}}" />
        <input type="submit" value="+ Add to Calendar" />
      </form>-->

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
  color: #333;
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
    yesNo: function(value) {
      return (value == true) ? 'Yes' : 'No';
    },
    hasHttp: function(value) { // Checks if links given 'http'
      return (value.substr(0, 4)) == 'http' ? value : 'https://'+value;
    }
  },
  watch: {},
  events: {}
};
</script>
