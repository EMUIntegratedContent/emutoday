<template>
  <div>
    <div class="box box-solid" :class="item.group">
        <div class="box-header with-border">
          <div class="row">
              <div class="col-sm-12">
                  <div v-show="podType == 'mainstoryqueue'" class="pull-right">
                      <label><input type="checkbox" @click="toggleEmitMainStory(item)" v-model="checked" :checked="isMainStory" :disabled="mainStoriesFull" />  Main Story</label>
                  </div><!-- /.pull-left -->
                  <div v-show="podType == 'otherstoryqueue'" class="pull-right">
                      <label><input type="checkbox" @click="toggleEmitOtherStory(item)" v-model="checked" :checked="isOtherStory" /> Email Story</label>
                  </div><!-- /.pull-left -->
              </div>
          </div><!-- /.row -->
          <div class="row">
            <a v-on:click.prevent="toggleBody" href="#">
              <div class="col-sm-9">
                <h6 class="box-title"><label data-toggle="tooltip" data-placement="top" :title="item.story_type"><span class="item-type-icon" :class="typeIcon"></span></label>{{item.title}}</h6>
              </div><!-- /.col-md-12 -->
              <div class="col-sm-3">
                <button v-show="podType == 'mainstory'" type="button" class="btn btn-sm btn-danger pull-right" @click="emitMainStoryRemove(item)"><i class="fa fa-times" aria-hidden="true"></i></button>
                <button v-show="podType == 'otherstory'" type="button" class="btn btn-sm btn-danger pull-right" @click="emitOtherStoryRemove(item)"><i class="fa fa-times" aria-hidden="true"></i></button>
              </div><!-- /.col-md-12 -->
            </a>
          </div><!-- /.row -->
        </div>  <!-- /.box-header -->

      <div v-if="showBody" class="box-body">
            <p>ID: {{item.id}}</p>
            <p>Type: {{item.story_type}}</p>
            <p>Title: {{item.title}}</p>
            <p>Ready: {{item.is_ready}}</p>
            <p>Approved: {{item.is_approved}}</p>
            <p>Promoted: {{item.is_promoted}}</p>
            <p>Featured: {{item.is_featured}}</p>
            <p>Live: {{item.is_live}}</p>
            <p>Archived: {{item.is_archived}}</p>
            <p>Start Date: {{item.start_date}}</p>
      </div><!-- /.box-body -->
            <div class="box-footer list-footer">
                <div class="row">
                    <div class="col-sm-6">
                        Live {{ timefromNow }}
                    </div><!-- /.col-md-6 -->
                    <div class="col-sm-6">
                        <div class="btn-group pull-right">
                            <a :href="item.edit_url" target="_blank" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip" title="preview"><i class="fa fa-pencil"></i></a>
                        </div>
                    </div><!-- /.col-md-6 -->
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

        #storyform {
            display:inline-flex;
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
        h5.box-footer {
            padding: 3px;
        }
        button.footer-btn {
            border-color: #1B1B1B;

        }
        h6.box-title {
            font-size: 16px;
            color: #1B1B1B;
        }
        .callout {
            position: relative;
            background: #ddd;
            padding: 1em;
            margin: 0;
        }
        .callout .callout-danger {
            background: #ff0000;
            color:#000000;
            /*border: 1px solid #000000;*/
        }

        .callout .callout-success {
            background: #00ff00;
            color:#000000;
            /*border: 1px solid #000000;*/
        }

        .Alert__close {
            position: absolute;
            top: 1em;
            right: 1em;
            font-weight: bold;
            cursor: pointer;
        }
        .bg-hub {
            background-color: #76D7EA;
        }
        .emutoday {

            background-color: #76D7EA;
            border: 1px solid #76D7EA
        }
        .student {
            color: #1B1B1B;
            background-color: #FED85D;
            border: 1px solid #FED85D
        }
        .news  {
            color: #1B1B1B;
            background-color: #cccccc;
            border: 1px solid #cccccc;
        }
        .external  {
            color: #1B1B1B;
            background-color: #C9A0DC;
            border: 1px solid #C9A0DC;
        }
        .article  {
            color: #1B1B1B;
            background-color: #29AB87;
            border: 1px solid #29AB87;
        }
        .advisory  {
            color: #1B1B1B;
            background-color: #CD5C5C;
            border: 1px solid #CD5C5C;
        }
        .statement  {
            color: #1B1B1B;
            background-color: #FFA500;
            border: 1px solid #FFA500;
        }
        .featurephoto  {
            color: #1B1B1B;
            background-color: #488dd8;
            border: 1px solid #488dd8;
        }
        .zcallout {
            border-radius: 5px;
            border-left: 50px solid #ff0000;
        }
        .zinfo-box-icon {
            border-top-left-radius: 5px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 5px;
            display: block;
            float: left;
            height: auto;
            width: 60px;
            text-align: center;
            font-size: 45px;
            line-height: 90px;
            background: rgba(0,0,0,0.2);
        }
        .type-badge {
            width: 30px;
            height: 30px;
            font-size: 15px;
            line-height: 30px;
            position: absolute;
            color: #666;
            background: #d2d6de;
            border-radius: 50%;
            text-align: center;
            left: 18px;
            top: 0;
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

        .special-item {
            border-left: 6px solid #bfff00;

            padding-left: 3px;
            border-top-left-radius:3px;
            border-bottom-left-radius: 3px;
            margin-left: -10px;

        }
        .special-item-last {
        }
</style>
<script>

import moment from 'moment'

/** Show all stories with a emutoday_email picture type set **/
export default {
    directives: {},
    components: {},
    props: ['item','pid','mainStories','podType','draggable','otherStories'],
    data: function() {
        return {
            options: [],
            showBody: false,
            currentDate: {},
            record: {
                title: '',
                story_type: '',
                start_date: ''
            },
            patchRecord: {
              priority: 0,
            },
            checked: false,
        }
    },
    created: function () {

    },
    ready: function() {
    },
    computed: {
      mainStoriesFull: function(){
        if(!this.mainStories) return false
        return !this.checked && this.mainStories.length == 3 ? true : false
      },
      timefromNow:function() {
          return moment(this.item.start_date).fromNow()
      },
      typeIcon: function() {
          let faicon = ''
          switch (this.item.story_type) {
              case 'emutoday':
              case 'story':
              faicon = 'fa-file-image-o'
              break
              case 'news':
              faicon = 'fa-file-text-o'
              break
              case 'student':
              faicon = 'fa-graduation-cap'
              break
              case 'external':
              faicon = 'fa-external-link'
              break
              case 'article':
              faicon = 'fa-newspaper-o'
              break
              case '':
              faicon = 'fa-asterisk'
              break
              case 'advisory':
              faicon = 'fa-warning'
              break
              case 'statement':
              faicon = 'fa-commenting'
              break
              case 'featurephoto':
              faicon = 'fa-camera-retro'
              break
              default:
              faicon = 'fa-file-o'
              break
          }
          return 'fa '+ faicon + ' fa-fw'
      },
      isMainStory: function(){
        if(this.mainStories){
          for(var i = 0; i < this.mainStories.length; i++) {
            if(this.mainStories[i].id == this.item.id){
              this.checked = true
              return true
            }
          }
        }
        this.checked = false
        return false
      },
      isOtherStory: function(){
        if(this.otherStories){
          for(var i = 0; i < this.otherStories.length; i++) {
            if(this.otherStories[i].id == this.item.id){
              this.checked = true
              return true
            }
          }
        }
        this.checked = false
        return false
      }
    },
    methods: {
        fetchEmailReadyStories: function(){

        },
        toggleBody: function(ev) {
            if(this.showBody == false) {
                this.showBody = true;
            } else {
                this.showBody = false;
            }
        },
        emitMainStoryAdd: function(storyObj){
          // Dispatch an event that propagates upward along the parent chain using $dispatch()
          this.$emit('main-story-added', storyObj)
        },
        emitMainStoryRemove: function(storyObj){
          // Dispatch an event that propagates upward along the parent chain using $dispatch()
          this.$emit('main-story-removed', storyObj.id)
        },
        emitOtherStoryAdd: function(storyObj){
          // Dispatch an event that propagates upward along the parent chain using $dispatch()
          this.$emit('other-story-added', storyObj)
        },
        emitOtherStoryRemove: function(storyObj){
          // Dispatch an event that propagates upward along the parent chain using $dispatch()
          // IMPORTANT: You must emit the object id as opposed to the entire object because objects loaded from Laravel will be DIFFERENT objects
          this.$emit('other-story-removed', storyObj.id)
        },
        toggleEmitMainStory: function(storyObj){
          // function will run before this.checked is switched
          if(!this.checked){
            this.emitMainStoryAdd(storyObj)
          } else {
            this.emitMainStoryRemove(storyObj)
          }
        },
        toggleEmitOtherStory: function(storyObj){
          // function will run before this.checked is switched
          if(!this.checked){
            this.emitOtherStoryAdd(storyObj)
          } else {
            this.emitOtherStoryRemove(storyObj)
          }
        },
        /**
         * Uses vue-sortable
         */
        updateOrder: function(event){
          // https://stackoverflow.com/questions/34881844/resetting-a-vue-js-list-order-of-all-items-after-drag-and-drop
          let oldIndex = event.oldIndex
          let newIndex = event.newIndex

          // move the item in the underlying array
          this.usedStories.splice(newIndex, 0, this.usedStories.splice(oldIndex, 1)[0]);
        },
    },
    watch: {
    },

    filters: {
        momentPretty: {
            read: function(val) {
                return 	val ?  moment(val).format('MM-DD-YYYY') : '';
            },
            write: function(val, oldVal) {
                return moment(val).format('YYYY-MM-DD');
            }
        }
    },
    events: {
    }
};


</script>
