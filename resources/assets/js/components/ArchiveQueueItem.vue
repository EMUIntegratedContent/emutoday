<template>
<div>
    <div :class="unarchivedStatus" class="box box-solid">
        <div class="box-header with-border">
            <div class="row">
                <a v-on:click.prevent="toggleBody" href="#">
                    <div class="col-sm-12">
                        <h6 class="box-title"><span class="arrowBuffer"><i :class="expandArrow"></i></span><span class="badge">{{ item.story_type }}</span> {{item.title}}</h6>
                    </div>
                    <!-- /.col-md-12 -->
                </a>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-header -->

        <div v-if="showBody" class="box-body">
            <!--Announcements Body-->
            <div v-if="entityType == 'announcements'">
                {{ item.announcement }}
            </div>

            <!--Events Body-->
            <div v-if="entityType == 'events'">
                {{ item.title }}
            </div>

            <!--Story Ideas Body-->
            <div v-if="entityType == 'storyideas'">
                <i class="fa fa-lightbulb-o" aria-hidden="true"></i> {{ item.idea }}
            </div>

            <!--Story Body-->
            <div v-if="entityType == 'stories'">
                <div class="table-responsive">
                    <table class="table table-responsive">
                        <tr>
                            <th>
                                Author
                            </th>
                            <td>
                                {{ item.author_object.first_name }} {{ item.author_object.last_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Start Date
                            </th>
                            <td>
                                {{ this.formatDate(item.start_date) }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                End Date
                            </th>
                            <td>
                                {{ this.formatDate(item.end_date) }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Content
                            </th>
                            <td>
                                {{ item.content }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div :class="addSeperator" class="box-footer list-footer">
            <div class="row">
                <div class="col-sm-12 col-md-9">
                    <p v-show="entityType == 'announcements'">Submitted on {{ formatDate(item.start_date) }} by {{ item.submitter }}</p>
                    <p v-show="entityType == 'stories'">Story started on {{ formatDate(item.start_date) }}</p>
                    <p v-show="entityType == 'storyideas'"><strong>Medium:</strong> {{ item.medium.medium }} | <strong>Due date:</strong> {{ formatDate(item.deadline.date) }}</p>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div v-show="showArchivedButtons">
                        <span v-show="isFailedDeleted" class="fail"><i class="fa fa-exclamation-triangle"></i> Error deleting item</span>
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
.announcement  {
    color: #1B1B1B;
    background-color: #ffcc33;
    border: 1px solid #999999;
}

.arrowBuffer {
    width: 25px;
    display: inline-block;
    padding-left: 5px;
}

.article{
    color: #1B1B1B;
    background-color: #29AB87;
    border: 1px solid #29AB87;
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
    /*background-color: #D8D8D8;*/
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

.external{
    color: #1B1B1B;
    background-color: #C9A0DC;
    border: 1px solid #C9A0DC;
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

.story{
    background-color: #76D7EA;
    border: 1px solid #76D7EA;
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

.news  {
    color: #1B1B1B;
    background-color: #cccccc;
    border: 1px solid #cccccc;
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

.success{
    color: #00a65a;
}

.unarchived {
    background-color: #00a65a !important;
    border: 2px solid #00a65a !important;
}
.deleted{
    background-color: #ff6666 !important;
    border: 2px solid #ff6666 !important;
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
            isFailedDeleted: false,
            isFailedUnarchived: false,
            confirmDelete: false,
        }
    },
    created: function() {

    },
    ready: function() {

    },
    computed: {
        unarchivedStatus: function() {
            if (this.item.story_type && !this.isUnarchived && !this.isDeleted && !this.isFailedDeleted && !this.isFailedUnarchived){
                // For archives of type 'story' (and any subtypes thereof)
                return this.item.story_type
            } else {
                if( (this.entityType == 'announcements' || this.entityType == 'storyideas') && !this.isUnarchived && !this.isDeleted && !this.isFailedDeleted && !this.isFailedUnarchived){
                    return 'announcement'
                }
                if (this.isUnarchived) {
                    return 'unarchived'
                }

                if (this.isDeleted) {
                    return 'deleted'
                }

                if (this.isFailedDeleted || this.isFailedUnarchived) {
                    return 'unarchive-fail'
                }
            }
        },
        expandArrow: function() {
            return this.showBody ? 'fa fa-angle-down' : 'fa fa-angle-right'
        },
    },
    methods: {
        toggleBody() {
            this.showBody ? this.showBody = false : this.showBody = true;
        },
        unarchiveItem(item) {
            var url = '/api/archive/' + this.entityType + '/' + item.id + '/unarchive'
            this.$http.put(url, item)
                .then((response) => {
                    this.$emit("unarchived", item.id)
                    this.showArchivedButtons = false
                    this.showUnarchivedButtons = true
                    this.showRetryButtons = false
                    this.isUnarchived = true
                    this.isFailedUnarchived = false
                }, (response) => {
                    //error callback
                    this.showArchivedButtons = false
                    this.showRetryButtons = true
                    this.isFailedUnarchived = true
                }).bind(this);
        },
        editItem(item){
            switch(this.entityType){
                case 'announcements':
                    return "/admin/announcement/" + item.id + "/edit"
                case 'storyideas':
                    return "/admin/storyideas/story/" + item.id + "/edit"
                case 'stories':
                    return "/admin/queueall/story/" + item.story_type + "/" + item.id + "/edit"
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
                    this.$emit("deleted", item.id)
                    this.showArchivedButtons = false
                    this.showUnarchivedButtons = false
                    this.isDeleted = true
                    this.isFailedDeleted = false
                }, (response) => {
                    //error callback
                    this.showArchivedButtons = true
                    this.isFailedDeleted = true
                    this.confirmDelete = false
                }).bind(this);
        },
        formatDate: function(date) {
            return moment(date).format("MM/DD/YYYY")
        }
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
