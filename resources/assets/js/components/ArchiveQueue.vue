<template>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-9 col-md-6">
        <h3><span class="badge">{{ pagination.total_records }}</span> Archived {{ compEntityType }}</h3>
        <p>Click the item's title to expand and view associated content. When you unarchive an item, it will be shown in green. If you reload the page or move to the next page, that item will no longer be shown in this queue.</p>
        <div id="archived-items-container">
            <!-- custom @unarchived event "emitted" in ArchiveQueueItem after ajax request -->
            <archive-queue-item v-for="item in allitems | orderBy 'start_date' 1" :item="item" :index="$index" :entity-type="entityType">
            </archive-queue-item>
        </div>
    </div>
</div>
<div v-show="this.pagination.total_pages > 0" class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-md-4">
        <ul class="pagination">
            <li :class="this.pagination.current_page == 1 ? 'disabled' : ''">
                <a href="#" @click.prevent="fetchAllRecords(1, this.resultsPerPage)"><span>&laquo;</span></a>
            </li>
            <li v-for="n in totalPages" :class="(n + 1) == this.pagination.current_page ? 'active': ''">
                <a href="#" @click.prevent="fetchAllRecords(n + 1, this.resultsPerPage)">{{ n + 1 }}</a>
            </li>
            <li :class="this.pagination.current_page == this.pagination.total_pages ? 'disabled' : ''">
                <a href="#" @click.prevent="fetchAllRecords(this.pagination.total_pages, this.resultsPerPage)"><span>&raquo;</span></a>
            </li>
        </ul>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-6 col-md-2">
        <div class="form-group">
            <label for="resultsPerPage">Per Page</label>
            <div class="input-group">
                <div @click="paginateChange('minus')" class="input-group-addon cursor btn btn-sm">-</div>
                <input type="number" class="form-control" id="resultsPerPage" min="1" step="1" :value="resultsPerPage" disabled>
                <div @click="paginateChange('plus')" class="input-group-addon cursor btn-sm">+</div>
            </div>
        </div>
    </div>
</div>
<!-- ./row -->
</template>
<style scoped>
.cursor{
    cursor: pointer;
}
</style>
<script>
import ArchiveQueueItem from './ArchiveQueueItem.vue'
import moment from 'moment';
export default {
    components: {
        ArchiveQueueItem
    },
    props: {
        entityType: {
            required: true
        },
    },
    data: function() {
        return {
            resource: {},
            allitems: [],
            items: [],
            pagination: {},
            resultsPerPage: 10,
        }
    },
    ready() {
        this.fetchAllRecords();
    },
    computed: {
        compEntityType: function() {
            // Capitalize the entityType property
            return this.entityType.charAt(0).toUpperCase() + this.entityType.slice(1);
        },
        totalPages: function() {
            return this.pagination.total_pages
        },
    },
    methods: {
        fetchAllRecords: function(pageNumber, numPerPage) {
            var url = '/api/archive/queueload/' + this.entityType
            numPerPage ? url += '/' + numPerPage : ''
            pageNumber ? url += '?page=' + pageNumber : ''

            this.$http.get(url)
                .then((response) => {
                    console.log(response.data)
                    this.$set('allitems', response.data.data)

                    if (response.data.data.length > 0) {
                        this.makePagination(response.data.meta.pagination)
                    }
                }, (response) => {
                    //error callback
                    console.log("Error fetching archive records");
                }).bind(this);
        },

        makePagination: function(data) {
            let pagination = {
                current_page: data.current_page,
                last_page: data.last_page,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url,
                total_pages: data.total_pages,
                total_records: data.total,
            }

            this.$set('pagination', pagination)
        },

        paginateChange(direction){
            if(direction == 'plus'){
                this.resultsPerPage += 1
            } else if(direction == 'minus') {
                this.resultsPerPage > 1 ? this.resultsPerPage -= 1 : ''
            }

            this.fetchAllRecords(1, parseInt(this.resultsPerPage))
        }

    },

    // the `events` option simply calls `$on` for you
    // when the instance is created
    events: {

    }
}
</script>
