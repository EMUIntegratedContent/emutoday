<template>

<div class="toolbar-row">
    <div class="toolbar-block">

    </div><!-- /.tool-block -->
    <div class="toolbar-block pull-right">
        <div class="btn-toolbar btn-group-sm ">
            <!--<a id="btn-preview-{{id}}" :href="previewLink" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>-->
            <a id="btn-new-{{id}}" :href="createNewLink" class="btn bg-orange btn-sm"><i class="fa fa-plus-square"></i></a>
            <a id="btn-list-{{id}}" :href="listLink" class="btn bg-orange btn-sm"><i class="fa fa-list-alt"></i></a>
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

export default  {
    props: [
        'viewtype',
        'recordId',
        'currentUser',
        'role',
    ],


    ready() {
    },
    data: function() {
        return {

        }
    },
    computed: {
        previewLink:function() {
            return '/preview/experts/' + this.recordId;
        },
        listLink:function() {
             return '/admin/experts';
        },
        createNewLink:function() {
            return '/admin/experts/form';
        }

    },

    methods : {


    },


    // the `events` option simply calls `$on` for you
    // when the instance is created
    events: {

    }
}
</script>
