<template>
  <div class="panel panel-default">
    <div :class="panelType + '-panel-heading'" class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" :href="'#collapse-' + slugify(storyidea.medium.medium) + '-' + panelType + '-' + index">{{{ icon }}} {{ storyidea.title }}</a>
      </h4>
    </div>
    <div :id="'collapse-' + slugify(storyidea.medium.medium) + '-' + panelType + '-' + index" class="panel-collapse collapse">
      <div class="panel-body">
        {{ storyidea.idea }}
        <hr />
        <label class="pull-right">Complete <input v-model="storyidea.is_completed" @change="emitUpdateIdeaStatus()" type="checkbox"></label>
      </div>
    </div>
    <div class="ideapod-panel-footer panel-footer">
      <div class="row">
          <div class="col-sm-12 col-md-7">
              Due {{ timefromNow() }}
          </div><!-- /.col-md-7 -->
          <div class="col-sm-12 col-md-5">
              <div class="btn-group pull-right">
                  <a :href="'/admin/storyideas/' + storyidea.id + '/edit'" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip" data-placement="top" title="edit"><i class="fa fa-pencil"></i></a>
                  <button v-if="role == 'admin' || role == 'admin_super'" @click="emitArchiveIdea()" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip" data-placement="bottom" title="archive"><i class="fa fa-archive"></i></button>
              </div><!-- /.btn-toolbar -->
          </div><!-- /.col-md-7 -->
      </div><!-- /.row -->
    </div>
  </div>
</template>
<style scoped>
.ideapod-panel-footer{
  border-top: 1px solid #cccccc !important;
  background-color: #eeeeee !important;
}
.completed-panel-heading{
  background-color: #29AB87 !important;
}
.future-panel-heading{
  background-color: #ffcc33 !important;
}
.past-panel-heading{
  background-color: #999999 !important;
}
.panel-heading a:hover, .panel-heading a:active, .panel-heading a:focus{
  color: #000000 !important;
}
.footer-btn{
  border:1px solid black;
}
</style>
<script>
import moment from 'moment'

module.exports = {
  components: {},
  props: {
    index: {
      type: Number,
      default: 0,
    },
    panelType: {
      type: String,
      default: 'future'
    },
    role: {
      type: String,
      required: true,
    },
    storyidea: {
      type: Object,
      required: true,
    },
  },
  data: function() {
    return {
    }
  },
  created: function () {

  },
  ready: function() {
  },
  computed: {
    icon: function(){
      if(this.panelType == 'completed'){
        return '<i class="fa fa-check-circle-o" aria-hidden="true"></i>'
      } else if(this.panelType == 'past'){
        return '<i class="fa fa-frown-o" aria-hidden="true"></i>'
      } else {
        return '<i class="fa fa-lightbulb-o" aria-hidden="true"></i>'
      }
    }
  },

  methods: {
    emitArchiveIdea(){
      this.$emit('archive-story-idea', this.storyidea)
    },
    slugify: function(str){
      return  str.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, '')
    },
    timefromNow:function() {
      return moment(this.storyidea.deadline.date).fromNow()
    },
    emitUpdateIdeaStatus: function(){
      this.$emit('update-story-idea', this.storyidea)
    },
  },
  watch: {
  },
  filters: {
  },
  events: {
  },
  directives: {

  }
};

</script>
