<template>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-md-8">
        <h3>Archived {{ compEntityType }}</h3>
        <div id="items-unapproved">
            <archive-queue-item v-for="item in allitems | orderBy 'start_date' 1" :item="item" :index="$index" :entity-type="entityType">
            </archive-queue-item>
        </div>
    </div>
</div>
<div v-show="this.pagination.total_pages > 0" class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-md-8">
        <ul class="pagination">
            <li :class="this.pagination.current_page == 1 ? 'disabled' : ''">
                <a href="#" @click.prevent="fetchAllRecords(1)"><span>&laquo;</span></a>
            </li>
            <li v-for="n in totalPages" :class="(n + 1) == this.pagination.current_page ? 'active': ''">
                <a href="#" @click.prevent="fetchAllRecords(n + 1)">{{ n + 1 }}</a>
            </li>
            <li :class="this.pagination.current_page == this.pagination.total_pages ? 'disabled' : ''">
                <a href="#" @click.prevent="fetchAllRecords(this.pagination.total_pages)"><span>&raquo;</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- ./row -->
</template>
<style scoped>

</style>
<script>
import ArchiveQueueItem from './ArchiveQueueItem.vue'
export default {
    components: {ArchiveQueueItem},
    props: {
        entityType: {required: true},
    },
    data: function() {
        return {
            resource: {},
            allitems: [],
            otheritems: [],
            appitems: [],
            unappitems: [],
            items: [],
            xitems: [],
            objs: {},
            pagination: {},
        }
    },
    ready() {
        this.fetchAllRecords();
    },
    computed: {
        compEntityType: function(){
            // Capitalize the entityType property
            return this.entityType.charAt(0).toUpperCase() + this.entityType.slice(1);
        },
        totalPages: function(){
            return this.pagination.total_pages
        },
    },
    methods: {
        fetchAllRecords: function(pageNumber) {
            var url = '/api/archive/queueload/' + this.entityType
            pageNumber ? url += '?page=' + pageNumber : ''

            this.$http.get(url)
                .then((response) => {
                    console.log(response.data)
                    this.$set('allitems', response.data.data)
                    this.makePagination(response.data.meta.pagination)
                }, (response) => {
                    //error callback
                    console.log("Error fetching archive records");
                }).bind(this);
        },

        makePagination: function(data){
            let pagination = {
                current_page: data.current_page,
                last_page: data.last_page,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url,
                total_pages: data.total_pages,
            }

            this.$set('pagination', pagination)


        },

        updateRecord: function(item) {
            var currentRecordId = item.id;

            var currentRecord = item;
            this.$http.patch('/api/event/updateItem/' + item.id, item, {
                    method: 'PATCH'
                })
                .then((response) => {
                    console.log('good_eventQueue' + response)
                }, (response) => {
                    console.log('bad?' + response)
                });
        },

    },

    // the `events` option simply calls `$on` for you
    // when the instance is created
    events: {

    }
}
</script>
