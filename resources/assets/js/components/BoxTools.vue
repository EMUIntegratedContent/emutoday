<template>

<div class="toolbar-row">
    <div class="toolbar-block">
        <!-- theRecordID:{{thisRecordId}} theRecordState:{{thisRecordState}} isDirty:{{thisRecordIsDirty}} -->
    </div><!-- /.tool-block -->
    <div class="toolbar-block pull-right">
        <div class="btn-toolbar btn-group-sm ">

            <a id="btn-preview-{{id}}" :href="previewLink"  :disabled="disabledPreview" v-show="!disabledPreview" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>
            <a id="btn-new-{{id}}" :href="createNewLink" :disabled="thisRecordIsDirty" class="btn bg-orange btn-sm"><i class="fa fa-plus-square"></i></a>
            <a id="btn-list-{{id}}" :href="listLink"  :disabled="thisRecordIsDirty" class="btn bg-orange btn-sm"><i class="fa fa-list-alt"></i></a>
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
}​
#items-unapproved .box {
    margin-bottom: 4px;
}
#items-approved .box {
    margin-bottom: 4px;

}
</style>
<script>
import { getRecordId, getRecordIsDirty, getRecordState } from '../vuex/getters'

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
    vuex: {
        getters: {
            // note that you're passing the function itself, and not the value 'getCount()'
            // counterValue: getCount,
            thisRecordId: getRecordId,
            thisRecordIsDirty: getRecordIsDirty,
            thisRecordState: getRecordState,

        },
    },


    ready() {
        console.log('BoxTools')
    },
    data: function() {
        return {

        }
    },
    computed: {
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

            // if(this.sroute === 'magazine'){
            //     return '/admin/'+ this.sroute + '/'+ this.stype + '/queue';
            // } else {
            //     return '/admin/'+ this.sroute + '/'+ this.qtype +'/queue';
            //
            // }
        },
        createNewLink:function() {
            return '/admin/'+ this.gtype +'/' + this.stype +  '/setup'
        },
    },

    methods : {
        // checkIndexWithValue: function (chitem){
        // 	return
        // },
        // viewPreview: function(evt) {
        //     var vurl = '/preview/' + this.rte +  '/' + this.thisRecordId;
        //     console.log(vurl);
        //     document.location = vurl;
        //
        // },
        // viewList: function(evt) {
        //     var url = '/admin/story/' + this.rte +  '/'
        //     console.log(url);
        //     document.location = url;
        // },
        // createNew: function(evt) {
        //     var url = '/admin/story/' + this.rte +  '/setup'
        //     console.log('this.rte='+ this.rte)
        // },

    },


    // the `events` option simply calls `$on` for you
    // when the instance is created
    events: {

    }
}
</script>
