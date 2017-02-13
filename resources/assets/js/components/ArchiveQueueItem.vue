<template>
  <div :class="specialItem">

    <div :class="liveTimeStatusClass" class="box box-solid">

      <div class="box-header with-border">
          <div class="row">
            <a v-on:click.prevent="toggleBody" href="#">
              <div class="col-sm-12">
                <h6 class="box-title">{{item.title}}</h6>
              </div><!-- /.col-md-12 -->
            </a>
          </div><!-- /.row -->
      </div>  <!-- /.box-header -->

    <div v-if="showBody" class="box-body">
        <!--Announcements Body-->
        <div v-show="entityType == 'announcements'">
            {{ item.announcement }}
        </div>

        <!--Events Body-->
        <div v-show="entityType == 'events'">
            events
        </div>

        <!--Story Body-->
        <div v-show="entityType == 'story'">
            story
        </div>
    </div><!-- /.box-body -->
    <div :class="addSeperator" class="box-footer list-footer">
      <div class="row">
        <div class="col-sm-12 col-md-offset-9 col-md-3">
          ID: {{item.id}}
          <div class="btn-group pull-right">

            <button v-if="showButtons" @click="unarchiveItem(item)" type="button" class="btn bg-green btn-xs footer-btn" aria-label="unarchive item"><i class="fa fa-inbox"></i></button>
            <button v-if="showButtons" @click="deleteItem(item)" type="button" class="btn bg-red btn-xs footer-btn" aria-label="delete item"><i class="fa fa-trash"></i></button>
          </div><!-- /.btn-toolbar -->

        </div><!-- /.col-md-7 -->
      </div><!-- /.row -->
    </div><!-- /.box-footer -->
  </div><!-- /.box- -->
</div>
</template>
<style scoped>
.box {
  color: #1B1B1B;
  margin-bottom: 10px;
}
.box-body {
  background-color: #fff;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  margin:0;
}

.box-header {
  padding: 3px;
}
.box-footer {
  padding: 3px;
}
h5.box-footer {
  padding: 3px;
}
button.footer-btn {
  border-color: #999999;

}
h6.box-title {
  font-size: 16px;
  color: #1B1B1B;
}
form {
  display:inline-block;
}
form.mediaform {
  margin-top: 1rem;
}
.form-group {
  margin-bottom: 2px;
}
#applabel{
  margin-left: 2px;
  margin-right: 2px;
  padding-left: 2px;
  padding-right: 2px;
}

.btn-group,
.btn-group-vertical {
  display:inline-flex;
}
select.form-control {
  height:22px;
  border: 1px solid #999999;
}

h6 {
  margin-top: 0;
  margin-bottom: 0;
}
h5 {
  margin-top: 0;
  margin-bottom: 0;
}
.form-group {
  /*border: 1px solid red;*/
}
.form-group label{
  margin-bottom: 0;
}
.topitems {
  /*background-color: #9B59B6;*/
  background-color: #76D7EA;
  border: 2px solid #9B59B6;
}
.ongoing {
  background-color: #ffcc33;
  border: 1px solid #999999
}
.event-positive {

  background-color: #D8D8D8;
  border: 1px solid #999999;
}
.event-negative {

  background-color: #999999;
  border: 1px solid #999999;
}
.is-promoted {

  background-color: #76D7EA;
  /*border: 1px solid #999999*/
}
.time-is-short {
  color: #F39C12;
}
.time-is-long {
  color: #999999;
}
.time-is-over {
  color: #9B59B6;
}

.special-item {
  border-left: 6px solid #ff00bf;

  padding-left: 3px;
  border-top-left-radius:3px;
  border-bottom-left-radius: 3px;
  margin-left: -10px;

}
.special-item-both {
  border-left: 6px solid #bfff00;
}
.special-item-home {
  border-left: 6px solid #00bfff;
}
.special-item-last {
  margin-bottom: 30px;
}
</style>

<script>
import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'
module.exports  = {
  components: {VuiFlipSwitch},
  props: ['item','index','entityType'],
  data: function() {
    return {
      eventimage: '',
      showBody: false,
      showPanel: false,
      showButtons: true,
    }
  },
  created: function () {

  },
  ready: function() {

  },
  computed: {

  },
  methods:{
      toggleBody(){
          this.showBody ? this.showBody = false : this.showBody = true;
      },
      unarchiveItem(item){
          var url = '/api/archive/' + this.entityType + '/' + item.id + '/unarchive'
          this.$http.put(url, item)
              .then((response) => {
                  console.log(response)
                  this.$emit("unarchived", item.id)
                  this.showButtons = false
              }, (response) => {
                  //error callback
                  console.log("Error unarchiving record");
              }).bind(this);
      },
  },
  watch: {

  },
  directives: {
  },

  filters: {

  },
  events: {

  }
};


</script>
