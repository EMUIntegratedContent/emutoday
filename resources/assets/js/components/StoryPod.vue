<template>
  <div>
    <div v-show="itemMsgStatus.show" class="callout" :class="'callout-' + itemMsgStatus.level">
      <span class="Alert__close" @click="itemMsgStatus.show = false">X</span>
      <h5>{{ itemMsgStatus.msg }}</h5>
    </div>
    <div :class="specialItem">
      <div class="box box-solid" :class="item.group">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="pull-left">
                <label data-toggle="tooltip" data-placement="top" :title="item.story_type"><span
                    class="item-type-icon" :class="typeIcon"></span></label>
                <label data-toggle="tooltip" data-placement="top" :title="isReadyStatus"><span
                    class="item-featured-icon" :class="readyIcon"></span></label>
                <label data-toggle="tooltip" data-placement="top" title="Promoted"><span class="item-featured-icon"
                                                                                         :class="promotedIcon"></span></label>
                <label data-toggle="tooltip" data-placement="top" title="Featured"><span class="item-featured-icon"
                                                                                         :class="featuredIcon"></span></label>
                <label data-toggle="tooltip" data-placement="top" title="on HomePage"><span class="item-featured-icon"
                                                                                            :class="homeIcon"></span></label>
                <label data-toggle="tooltip" data-placement="top" title="linked"><span class="item-featured-icon"
                                                                                       :class="linkedIcon"></span></label>
              </div><!-- /.pull-left -->
            </div>
            <div class="col-sm-12 col-md-6">
              <div id="storyform" class="form-inline pull-right">
                <template v-if="pid == 'items-live'">
                  <div class="form-check">
                    <label class="form-check-label">
                      Elevate
                      <input type="checkbox" class="form-check-input" @click="toggleEmitStoryElevate(item)"
                             v-model="checked" :checked="isElevatedStory"/> |
                    </label>
                  </div>
                </template>
                <template v-if="canApprove && pid != 'item-elevated'">
                  <template v-if="recordIsReady">
                    <div id="applabel" class="form-group">
                      <label>approved:</label>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                      <vui-flip-switch :id="'switch-' + item.id"
                                       v-on:click.prevent="changeIsApproved"
                                       v-model:checked="patchRecord.is_approved">
                      </vui-flip-switch>
                    </div>
                  </template>
                  <template v-else>
                    <div class="form-group">
                      <label>Not ready for approval</label>
                    </div><!-- /.form-group -->
                  </template>
                </template>
                <button v-if="pid == 'item-elevated'" type="button"
                        class="btn btn-sm btn-danger pull-right remove-story-btn" @click="emitStoryDemote(item)"><i
                    class="fa fa-times" aria-hidden="true"></i></button>
              </div><!-- /.pull-right -->
            </div><!-- /.col-md-12-->
          </div><!-- /.row -->
          <div class="row">
            <a v-on:click.prevent="toggleBody" href="#">
              <div class="col-md-12">
                <h6 class="box-title">{{ item.title }}</h6>
              </div><!-- /.col-md-12 -->
            </a>
          </div><!-- /.row -->

        </div>  <!-- /.box-header -->

        <div v-if="showBody" class="box-body">
          <p>ID: {{ item.id }}</p>
          <p>Type: {{ item.story_type }}</p>
          <p>Title: {{ item.title }}</p>
          <p>Ready: {{ item.is_ready }}</p>
          <p>Approved: {{ item.is_approved }}</p>
          <p>Promoted: {{ item.is_promoted }}</p>
          <p>Featured: {{ item.is_featured }}</p>
          <p>Live: {{ item.is_live }}</p>
          <p>Archived: {{ item.is_archived }}</p>
          <p>Start Date/Time: {{ momentFull(item.start_date) }}</p>
          <template v-if="isPartOfHub">
            <div class="btn-group btn-xs form-inline">
              <div class="form-group">
                <label>Hubs: </label>
              </div>
              <div class="form-group">
                <button v-for="hub in connectedHubs" v-on:click.prevent="gotoHub(hub.id)" class="btn bg-hub btn-xs"
                        data-toggle="tooltip" data-placement="top" :title="'Edit Hub Id: ' + hub.id"><i
                    class="fa fa-newspaper-o"></i></button>
              </div>
            </div>
          </template>
          <template v-if="isPartOfMag">
            <div class="btn-group btn-xs form-inline">
              <div class="form-group">
                <label>Mags: </label>
              </div>
              <div class="form-group">
                <button v-for="mag in connectedMags" v-on:click.prevent="gotoMag(mag.id)" class="btn bg-hub btn-xs"
                        data-toggle="tooltip" data-placement="top" :title="'Edit Mag Id: ' + mag.id"><i
                    class="fa fa-book"></i></button>
              </div>
            </div>
          </template>
        </div><!-- /.box-body -->
        <div class="box-footer list-footer">
          <div class="row">
            <div class="col-sm-12 col-md-7">
              <h5>Live {{ timefromNow }}</h5>
            </div><!-- /.col-md-7 -->
            <div class="col-sm-12 col-md-5">
              <div class="btn-group pull-right">
                <button v-on:click.prevent="editItem" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip"
                        data-placement="top" title="edit"><i class="fa fa-pencil"></i></button>
                <button v-on:click.prevent="previewItem" class="btn bg-orange btn-xs footer-btn"
                        :disabled="disabledPreview" data-toggle="tooltip" title="preview"><i class="fa fa-eye"></i>
                </button>
                <button v-on:click.prevent="archiveItem" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip"
                        data-placement="bottom" title="archive"><i class="fa fa-archive"></i></button>
              </div><!-- /.btn-toolbar -->
            </div><!-- /.col-md-7 -->
          </div><!-- /.row -->
        </div><!-- /.box-footer -->
      </div><!-- /.box- -->
    </div>
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
  margin: 0;
}

.box-header {
  padding: 3px;
}

.box-footer {
  padding: 3px;
}

#storyform {
  display: inline-flex;
}

.form-group {
  margin-bottom: 2px;
}

#applabel {
  margin-left: 2px;
  margin-right: 2px;
  padding-left: 2px;
  padding-right: 2px;
}

.btn-group,
.btn-group-vertical {
  display: inline-flex;
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
  color: #000000;
  /*border: 1px solid #000000;*/
}

.callout .callout-success {
  background: #00ff00;
  color: #000000;
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

.news {
  color: #1B1B1B;
  background-color: #cccccc;
  border: 1px solid #cccccc;
}

.external {
  color: #1B1B1B;
  background-color: #C9A0DC;
  border: 1px solid #C9A0DC;
}

.featurephoto {
  color: #1B1B1B;
  background-color: #488dd8;
  border: 1px solid #488dd8;
}

.article {
  color: #1B1B1B;
  background-color: #29AB87;
  border: 1px solid #29AB87;
}

.advisory {
  color: #1B1B1B;
  background-color: #CD5C5C;
  border: 1px solid #CD5C5C;
}

.statement {
  color: #1B1B1B;
  background-color: #FFA500;
  border: 1px solid #FFA500;
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
  background: rgba(0, 0, 0, 0.2);
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
  height: 22px;
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

.form-group label {
  margin-bottom: 0;
}

.special-item {
  border-left: 6px solid #bfff00;

  padding-left: 3px;
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
  margin-left: -10px;

}

.special-item-last {
}

.remove-story-btn {
  margin-left: 10px;
}
label > span.fa{
  margin-right: 3px;
}
</style>
<script>

import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'

export default {
  directives: {},
  components: {VuiFlipSwitch},
  props: ['item', 'pid', 'sroute', 'qtype', 'gtype', 'stype', 'index', 'role', 'elevatedStorys'],
  data: function () {
    return {
      checked: false,
      response_msg: '',
      response_approval: '',
      showBody: false,
      currentDate: {},
      record: {
        title: '',
        story_type: '',
        start_date: ''
      },
      itemMsgStatus: {
        show: false,
        level: '',
        msg: ''
      },
      initRecord: {
        is_approved: 0,
        priority: 0,
        is_canceled: 0,
        eventimage: ''
      },
      patchRecord: {
        is_approved: 0,
        priority: 0,
        is_canceled: 0,
        eventimage: ''
      },
    }
  },
  created () {
    this.initRecord.is_approved = this.patchRecord.is_approved = this.item.is_approved;
    this.initRecord.priority = this.patchRecord.priority = this.item.priority;
    this.initRecord.is_canceled = this.patchRecord.is_canceled = this.item.is_canceled;
    this.initRecord.eventimage = this.patchRecord.eventimage = this.item.eventimage;
  },
  computed: {
    specialItem: function () {
      let extrasep;
      if (this.qtype == 'queuenews' && this.pid == 'items-live' && this.index < 5) {

        if (this.index === 4) {
          extrasep = 'special-item special-item-last'
        } else {
          extrasep = 'special-item'
        }

      } else {
        extrasep = ''
      }
      return extrasep;
    },
    canApprove: function () {
      if (this.role === 'admin' || this.role === 'admin_super' || this.role === 'contributor_2' || this.role === 'editor') {
        return true
      }
      return false
    },
    isLiveColumn: function () {
      if (this.pid === 'items-live') {
        return true;
      } else {
        return false;
      }
    },
    hasIsApprovedChanged: function () {
      if (this.initRecord.is_approved != this.patchRecord.is_approved) {
        return true
      } else {
        return false
      }
    },
    connectedHubs: function () {
      return this.item.pages;
    },
    connectedMags: function () {
      return this.item.magazines;
    },
    isPartOfHub: function () {
      if (this.item.pages.length > 0) {
        return 1
      } else {
        return 0
      }
    },
    isPartOfMag: function () {
      if (this.item.magazines.length > 0) {
        return 1
      } else {
        return 0
      }
    },
    isPartOfHubOrMag: function () {
      if (this.isPartOfHub === 1 || this.isPartOfMag === 1) {
        return 1
      } else {
        return 0
      }
    },
    timefromNow: function () {
      return moment(this.item.start_date).fromNow()
    },
    isApproved: function () {
      return this.item.is_approved;
    },
    itemEditPath: function () {
      return '/admin/' + this.qtype + '/' + this.gtype + '/' + this.item.story_type + '/' + this.item.id + '/edit'
    },
    itemPreviewPath: function () {
      return '/preview/' + this.qtype + '/' + this.gtype + '/' + this.item.story_type + '/' + this.item.id
    },
    typeClass: function () {

    },
    readyIcon: function () {
      let pIcon = 'fa fa-circle-o'
      if (this.item.is_ready === 1) {
        pIcon = 'fa fa-circle'
      }
      return pIcon
    },
    promotedIcon: function () {
      let pIcon = ''
      if (this.item.is_promoted === 1) {
        pIcon = 'fa fa-arrow-circle-up'
      }
      return pIcon
    },
    liveIcon: function () {
      let lIcon = ''
      if (this.item.is_live === 1) {
        lIcon = 'fa fa-home'
      }
      return lIcon
    },
    linkedIcon: function () {
      if (this.isPartOfHubOrMag) {
        return 'fa fa-chain'
      }
      return ''
    },
    homeIcon: function () {
    },
    archivedIcon: function () {
      let aIcon = ''
      if (this.item.archived === 1) {
        aIcon = 'fa fa-archive'
      }
      return aIcon
    },
    featuredIcon: function () {
      let featuredicon = ''
      if (this.item.is_featured === 1) {
        featuredicon = 'fa fa-star'
      }
      return featuredicon
    },
    isReadyStatus: function () {
      return (this.item.is_ready === 1) ? 'Ready' : 'Not Ready';
    },
    typeIcon: function () {
      let faicon
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
      return 'fa ' + faicon + ' fa-fw'
    },
    recordIsReady: function () {
      switch (this.item.story_type) {
        case 'article':
        case 'story':
        case 'student':
        case 'external':
          if (this.item.is_promoted === 1) {
            return true
          } else {
            return false
          }
          break;
        case 'featurephoto':
          if (this.item.is_ready === 1) {
            return true
          }
          return false
          break;
        default:
          return true;
      }
    },
    recordNotReady: function () {
      return (this.recordIsReady) ? false : true;
    },
    disabledArchive: function () {
      if (this.isPartOfHubOrMag) {
        return true
      } else {
        return false
      }
    },
    disabledPreview: function () {
      if (this.recordIsReady) {
        return false
      } else {
        return true
      }
    },
    isElevatedStory: function () {
      if (this.elevatedStorys) {
        for (var i = 0; i < this.elevatedStorys.length; i++) {
          if (this.elevatedStorys[i].id == this.item.id) {
            this.checked = true
            return true
          }
        }
      }
      this.checked = false
      return false
    },
  },
  methods: {
    gotoHub: function (itemid) {
      window.location.href = '/admin/page/' + itemid + '/edit';
    },
    gotoMag: function (itemid) {
      window.location.href = '/admin/magazine/' + itemid + '/edit';
    },
    editItem: function (ev) {
      window.location.href = this.itemEditPath;
    },
    previewItem: function (ev) {
      window.location.href = this.itemPreviewPath;
    },
    toggleBody: function (ev) {
      if (this.showBody == false) {
        this.showBody = true;
      } else {
        this.showBody = false;
      }
    },
    approveItem: function (ev) {

      if (this.item.is_approved === 1) {
        this.item.xIs_approved = 0;
      } else {
        this.item.xIs_approved = 1;
      }
      this.updateRecordStatus();
    },
    changeIsApproved: function () {
      this.patchRecord.is_approved = (this.item.is_approved === 0) ? 1 : 0;
      this.updateItem();

    },
    archiveItem: function () {
      this.patchRecord.is_archived = 1;

      this.$http.patch('/api/story/archiveitem/' + this.item.id, this.patchRecord, {
        method: 'PATCH'
      })
          .then((response) => {
            this.checkAfterUpdate(response.data.newdata)
          }).catch((e) => {

          })
    },
    updateItem: function () {
      this.patchRecord.is_archived = this.item.is_archived;

      this.$http.patch('/api/story/updateitem/' + this.item.id, this.patchRecord, {
        method: 'PATCH'
      })
          .then((response) => {
            this.checkAfterUpdate(response.data.newdata)
          }).catch((e) => {
          })
    },
    checkAfterUpdate: function (ndata) {
      this.item.is_approved = this.initRecord.is_approved = ndata.is_approved;
      this.item.priority = this.initRecord.priority = ndata.priority;
      this.item.is_archived = this.initRecord.is_archived = ndata.is_archived;

      // Unapproved stories lose priority status
      if (!this.item.is_approved) {
        this.emitStoryDemote(this.item)
      }
    },
    updateRecordStatus: function () {
      let self = this
      this.$http.patch('/api/story/updateQueue', this.item, {
        method: 'PATCH'
      })
          .then((response) => {
            self.response_approval = response.data.isapproved;
            self.item.is_approved = (self.response_approval == 1) ? 1 : 0;

            self.$emit('item-change', self.item);

          }).catch((e) => {
            self.itemMsgStatus.show = true;
            self.itemMsgStatus.level = 'danger';
            self.itemMsgStatus.msg = e.response.data.error.message
          });
    },
    doThis: function (ev) {
      this.item.is_approved = (this.is_approved === 0) ? 1 : 0;
      this.$emit('item-change', this.item);
    },
    emitStoryElevate: function (storyObj) {
      // Dispatch an event that propagates upward along the parent chain using $dispatch()
      this.$dispatch('story-elevated', storyObj)
    },
    emitStoryDemote: function (storyObj) {
      // Dispatch an event that propagates upward along the parent chain using $dispatch()
      // IMPORTANT: You must emit the object id as opposed to the entire object because objects loaded from Laravel will be DIFFERENT objects
      this.$dispatch('story-demoted', storyObj.id)
    },
    toggleEmitStoryElevate: function (storyObj) {
      // function will run before this.checked is switched

      //Check if browser is Safari. Safari treats the true/false nature of checkboxes differently than chrome and firefox
      // https://www.learningjquery.com/2017/05/how-to-use-javascript-to-detect-browser
      if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
        if (this.checked === true) {
          this.emitStoryElevate(storyObj)
        } else {
          this.emitStoryDemote(storyObj)
        }
      } else {
        if (this.checked === false) {
          this.emitStoryElevate(storyObj)
        } else {
          this.emitStoryDemote(storyObj)
        }
      }
    },
    momentFull(val) {
      return val ? moment(val).format('ddd MMM gg, YYYY @ h:mm a') : ''
    }
  }
};


</script>
