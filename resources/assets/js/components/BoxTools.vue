<template>

<div class="toolbar-row">
    <div class="toolbar-block">
    </div><!-- /.tool-block -->
    <div class="toolbar-block pull-right">
        <div class="btn-toolbar btn-group-sm ">
            <a v-if="!disabledPreview" :id="'btn-preview-'+recordId" :href="previewLink" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>
            <a v-if="!disabledCreate" :id="'btn-new-'+recordId" :href="createNewLink" class="btn bg-orange btn-sm"><i class="fa fa-plus-square"></i></a>
            <a :id="'btn-list-'+recordId" :href="listLink" class="btn bg-orange btn-sm"><i class="fa fa-list-alt"></i></a>
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
           return this.recordId === 0
        },

        disabledPreview: function() {
            return this.recordId === 0 || this.recordId === undefined
        },

        previewLink:function() {
            let ftype = 'form'+ this.qtype + '/';
            return '/admin/preview/'+ ftype + this.gtype +  '/' +this.stype +  '/' +this.recordId;
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
        }
    }
}
</script>
