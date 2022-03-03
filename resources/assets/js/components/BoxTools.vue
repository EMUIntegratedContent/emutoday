<template>

<div class="toolbar-row">
    <div class="toolbar-block">
    </div><!-- /.tool-block -->
    <div class="toolbar-block pull-right">
        <div class="btn-toolbar btn-group-sm ">
            <a v-if="!disabledPreview" :id="'btn-preview-'+recordId" :href="previewLink"  :disabled="disabledPreview" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>
            <a :id="'btn-new-'+recordId" :href="createNewLink" :disabled="thisRecordIsDirty" class="btn bg-orange btn-sm"><i class="fa fa-plus-square"></i></a>
            <a :id="'btn-list-'+recordId" :href="listLink"  :disabled="thisRecordIsDirty" class="btn bg-orange btn-sm"><i class="fa fa-list-alt"></i></a>
        </div><!-- /.btn-toolbar -->
    </div><!-- /.toolbar-block -->
</div><!-- /.center-text -->

</template>
<style>
.toolbar-row {
  width: 100%;
text-align: right;
}

.toolbar-block {

  display: inline-block;
}
#items-unapproved .box {
    margin-bottom: 4px;
}
#items-approved .box {
    margin-bottom: 4px;

}
</style>
<script>
import { mapGetters } from "vuex"

export default  {
    props: [
        'viewtype',
        'recordId',
        'currentUser',
        'role',
        'stype',
        'sroute',
        'gtype',
        'qtype'
    ],
    ready() {
    },
    data: function() {
        return {

        }
    },
    computed: {
      ...mapGetters(
        {
          thisRecordId: 'getRecordId',
          thisRecordIsDirty: 'getRecordIsDirty',
          thisRecordState: 'getRecordState'
        }
      ),
        canSeeListView:function(){
            if(this.viewType == 'list'){
                return false
            }else {
                return true
            }

        },
        canSeePreviewView:function(){
            if(this.viewType == 'list'){
                return false
            }else {
                return true
            }

        },
        disabledCreate: function() {
            if(this.thisRecordState == 'new'){
                return true
            } else {
                return false
            }
        },

        disabledPreview: function() {
            if(this.thisRecordIsDirty){
                return true
            } else {
                if (this.thisRecordId === 0 || this.thisRecordId === undefined) {
                    return true
                } else {
                    return false
                }

            }
        },

        previewLink:function() {
            let ftype = 'form'+ this.qtype + '/';
            return '/preview/'+ ftype + this.gtype +  '/' +this.stype +  '/' +this.thisRecordId;
        },
        listLink:function() {
             return '/admin/'+ this.gtype + '/'+ this.stype + '/'+ this.qtype;
        },
        createNewLink:function() {
            if(this.gtype == 'story'){
                return '/admin/'+ this.qtype +'/' + this.gtype +  '/' + this.stype + '/form';
            } else {
                return '/admin/'+ this.gtype +'/' + this.stype +  '/setup'
            }
        },
    },

    methods : {


    },


    // the `events` option simply calls `$on` for you
    // when the instance is created
    events: {

    }
}
</script>
