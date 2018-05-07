<template>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-9 col-md-6">
        <h3><span class="badge">{{ pagination.total_records }}</span> Archived {{ compEntityType }}</h3>
        <p>Click the item's title to expand and view associated content. When you unarchive an item, it will be shown in green. If you reload the page or move to the next page, that item will no longer be shown in this queue.</p>

        <div v-show="entityType == 'stories'" class="btn-toolbar" role="toolbar">
            <div class="btn-group btn-group-xs" role="group">
                <label>Filter: </label>
            </div>
            <div class="btn-group btn-group-xs" role="group" aria-label="typeFiltersLabel" data-toggle="buttons" v-iconradio="filter_storytype" @click="fetchAllRecords(1, this.resultsPerPage)">
                <template v-for="item in storyTypeIcons">
                     <label class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{item.name}}"><input type="radio" autocomplete="off" value="{{item.shortname}}" /><span class="item-type-icon-shrt" :class="typeIcon(item.shortname)"></span></label>
                </template>
            </div>
        </div>

        <div id="archived-items-container">
            <archive-queue-item v-for="item in allitems" :item="item" :index="$index" :entity-type="entityType">
            </archive-queue-item>
        </div>

        <!-- Pagination: custom @numpageschanged and @pagechanged events "emitted" in Pagination.vue (arguments passed with the events automatically) -->
        <pagination :paginateditems="pagination" :resultsperpage="resultsPerPage" @numpageschanged="numPagesChange" @pagechanged="fetchAllRecords">
        </pagination>
    </div>
</div>
<!-- ./row -->
</template>
<style scoped>
    .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
        background-color: #605ca8;
        color: #ffffff;

    }
    .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
        color: #ffffff;

    }

    span.item-type-icon:active, span.item-type-icon.active{
        background-color: #605ca8;
        color: #ffffff;
    }
</style>
<script>
import ArchiveQueueItem from './ArchiveQueueItem.vue'
import Pagination from './Pagination.vue'
import iconradio from '../directives/iconradio.js'
import moment from 'moment';
export default {
    directives: {iconradio},
    components: {
        ArchiveQueueItem,
        Pagination
    },
    props: {
        entityType: {
            required: true
        },
        storyTypes: {
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
            filter_storytype: '',
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
        story_types: function() {
            try {
                return JSON.parse(this.storyTypes);
            } catch (e) {
                return this.storyTypes;
            }
        },
        storyTypeIcons: function() {
            if (this.isString(this.story_types)) {
                return [{
                    name: 'all',
                    shortname: ''
                }, {
                    name: 'none',
                    shortname: 'x'
                }]

            } else {
                this.story_types.push({
                    name: 'all',
                    shortname: ''
                })
                return this.story_types;
            }
        },
    },
    methods: {
        fetchAllRecords: function(pageNumber, numPerPage) {
            var url = '/api/archive/queueload/'

            if(this.filter_storytype != ''){
                url += this.filter_storytype
            } else {
                url += this.entityType
            }

            numPerPage ? url += '/' + numPerPage : ''
            pageNumber ? url += '?page=' + pageNumber : ''

            this.$http.get(url)
                .then((response) => {
                    this.$set('allitems', response.data.data)
                    this.makePagination(response.data.meta.pagination)
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

        isString: function(val){
            return toString.call(val) === "[object String]";
        },

        numPagesChange(direction) {
            if (direction == 'plus') {
                this.resultsPerPage += 1
            } else if (direction == 'minus') {
                this.resultsPerPage > 1 ? this.resultsPerPage -= 1 : ''
            }

            this.fetchAllRecords(1, parseInt(this.resultsPerPage))
        },

        filterByStoryType: function (value) {
            let story_type = value.story_type

            if (this.filter_storytype === '') {
                return story_type !== '';
            } else {
                return story_type === this.filter_storytype;
            }
        },

        typeIcon: function(storyname) {
            switch (storyname) {
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
    },
}
</script>
