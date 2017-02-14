<template>
<div>

    <div :class="unarchivedStatus" class="box box-solid">

        <div class="box-header with-border">
            <div class="row">
                <a v-on:click.prevent="toggleBody" href="#">
                    <div class="col-sm-12">
                        <h6 class="box-title"><span class="arrowBuffer"><i :class="expandArrow"></i></span> {{item.title}}</h6>
                    </div>
                    <!-- /.col-md-12 -->
                </a>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-header -->

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
        </div>
        <!-- /.box-body -->
        <div :class="addSeperator" class="box-footer list-footer">
            <div class="row">
                <div class="col-sm-12 col-md-9">
                    Submitted on {{ formattedDate }} by {{ item.submitter }}
                </div>
                <div class="col-sm-12 col-md-3">
                    <div v-show="showArchivedButtons">
                        <div class="btn-group pull-right">
                            <button @click="unarchiveItem(item)" type="button" class="btn bg-green btn-xs footer-btn" aria-label="unarchive item"><i class="fa fa-inbox"></i></button>
                            <button @click="deleteItemConfirm" type="button" class="btn bg-red btn-xs footer-btn" aria-label="delete item initial step"><i class="fa fa-trash"></i></button>
                            <div v-show="confirmDelete" class="btn-group pull-right">
                                <span class="confirmDelete">Sure?</span>
                                <button @click="confirmDelete = false" type="button" class="btn bg-gray btn-xs footer-btn" aria-label="delete item no">No</button>
                                <button @click="deleteItem(item)" type="button" class="btn bg-red btn-xs footer-btn" aria-label="delete item yes">YES</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.btn-toolbar -->
                    <div v-show="showUnarchivedButtons">
                        <span class="success"><i class="fa fa-check"></i> Unarchived</span>
                        <div class="btn-group pull-right">
                            <a :href="editItem(item)" type="button" class="btn bg-orange btn-xs footer-btn" aria-label="edit item"><i class="fa fa-pencil"></i></a>
                        </div>
                    </div>
                    <!-- /.btn-toolbar -->
                    <div v-show="showRetryButtons">
                        <span class="fail"><i class="fa fa-exclamation-triangle"></i> Error</span>
                        <div class="btn-group pull-right">
                            <button @click="unarchiveItem(item)" type="button" class="btn bg-orange btn-xs footer-btn" aria-label="unarchive item"><i class="fa fa-refresh"></i></button>
                            <button @click="deleteItemConfirm" type="button" class="btn bg-red btn-xs footer-btn" aria-label="delete item initial step"><i class="fa fa-trash"></i></button>
                            <div v-show="confirmDelete" class="btn-group pull-right">
                                <span class="confirmDelete">Sure?</span>
                                <button @click="confirmDelete = false" type="button" class="btn bg-gray btn-xs footer-btn" aria-label="delete item no">No</button>
                                <button @click="deleteItem(item)" type="button" class="btn bg-red btn-xs footer-btn" aria-label="delete item yes">YES</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.btn-toolbar -->
                    <div v-show="isDeleted" class="pull-right">
                        <span class="fail"><i class="fa fa-trash"></i> Item Deleted</span>
                    </div>
                </div>
                <!-- /.col-md-7 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-footer -->
    </div>
    <!-- /.box- -->
</div>
</template>
<style scoped>
.arrowBuffer {
    width: 25px;
    display: inline-block;
    padding-left: 5px;
}

.box {
    color: #1B1B1B;
    margin-bottom: 10px;
    border: 1px solid #999999;
}

.box-body {
    background-color: #fff;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    margin: 0;
}

.box-header {
    padding: 10px;
    background-color: #D8D8D8;
}

.box-footer {
    padding: 3px 10px 3px 10px;
}

h5.box-footer {
    padding: 3px;
}

button.footer-btn {
    border-color: #999999;
}

.confirmDelete{
    padding: 0px 5px 0px 5px;
    font-weight: bold;
}

h6.box-title {
    font-size: 16px;
    color: #1B1B1B;
}

form {
    display: inline-block;
}

form.mediaform {
    margin-top: 1rem;
}

.form-group {
    margin-bottom: 2px;
}

.btn-group,
.btn-group-vertical {
    display: inline-flex;
}

h6 {
    margin-top: 0;
    margin-bottom: 0;
}

h5 {
    margin-top: 0;
    margin-bottom: 0;
}
.fail{
    color: #dd4b39;
}

.form-group label {
    margin-bottom: 0;
}

.success{
    color: #00a65a;
}

.unarchived {
    background-color: #00a65a !important;
    border: 2px solid #00a65a !important;
}
.unarchive-fail {
    background-color: #dd4b39 !important;
    border: 2px solid #dd4b39 !important;
}
</style>

<script>
import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'
module.exports = {
    components: {
        VuiFlipSwitch
    },
    props: ['item', 'index', 'entityType'],
    data: function() {
        return {
            eventimage: '',
            showBody: false,
            showPanel: false,
            showArchivedButtons: true,
            showUnarchivedButtons: false,
            showRetryButtons: false,
            isUnarchived: false,
            isDeleted: false,
            confirmDelete: false,
        }
    },
    created: function() {

    },
    ready: function() {

    },
    computed: {
        unarchivedStatus: function() {
            if (this.isUnarchived) {
                return 'unarchived'
            }

            if (this.isDeleted) {
                return 'unarchive-fail'
            }

            if (this.showRetryButtons) {
                return 'unarchive-fail'
            }
        },
        expandArrow: function() {
            return this.showBody ? 'fa fa-angle-down' : 'fa fa-angle-right'
        },
        formattedDate: function() {
            return moment(this.item.start_date).format("MM/DD/YYYY")
        }
    },
    methods: {
        toggleBody() {
            this.showBody ? this.showBody = false : this.showBody = true;
        },
        unarchiveItem(item) {
            var url = '/api/archive/' + this.entityType + '/' + item.id + '/unarchive'
            this.$http.put(url, item)
                .then((response) => {
                    console.log(response)
                    this.$emit("unarchived", item.id)
                    this.showArchivedButtons = false
                    this.showUnarchivedButtons = true
                    this.showRetryButtons = false
                    this.isUnarchived = true
                }, (response) => {
                    //error callback
                    console.log("Error unarchiving record");
                    this.showArchivedButtons = false
                    this.showRetryButtons = true
                }).bind(this);
        },
        editItem(item){
            switch(this.entityType){
                case 'announcements':
                    return "/admin/announcement/" + item.id + "/edit"
                default:
                    return
            }
        },
        deleteItemConfirm(){
            this.confirmDelete = true
        },
        deleteItem(item) {
            var url = '/api/archive/' + this.entityType + '/' + item.id + '/delete'
            this.$http.delete(url)
                .then((response) => {
                    console.log(response)
                    this.$emit("deleted", item.id)
                    this.showArchivedButtons = false
                    this.showUnarchivedButtons = false
                    this.isDeleted = true
                }, (response) => {
                    //error callback
                    console.log("Error deleting record");
                    this.showArchivedButtons = true
                }).bind(this);
        },
    },
    watch: {

    },
    directives: {},

    filters: {

    },
    events: {

    }
};
</script>
