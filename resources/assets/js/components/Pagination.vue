<template>
    <div v-show="paginateditems.total_pages > 0" class="row">
        <div class="col-xs-12 col-sm-12 col-md-8">
            <ul class="pagination">
                <li :class="paginateditems.current_page == 1 ? 'disabled' : ''">
                    <a href="#" @click.prevent="paginateChange(1, resultsperpage)"><span>&laquo;</span></a>
                </li>
                <li v-for="n in paginateditems.total_pages" :class="(n + 1) == paginateditems.current_page ? 'active': ''">
                    <a href="#" @click.prevent="paginateChange(n + 1, resultsperpage)">{{ n + 1 }}</a>
                </li>
                <li :class="paginateditems.current_page == paginateditems.total_pages ? 'disabled' : ''">
                    <a href="#" @click.prevent="paginateChange(paginateditems.total_pages, resultsperpage)"><span>&raquo;</span></a>
                </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <label for="resultsPerPage">Per Page</label>
                <div class="input-group">
                    <div @click="perPageChange('minus')" class="input-group-addon cursor btn btn-sm">-</div>
                    <input type="number" class="form-control" id="resultsPerPage" min="1" step="1" :max="paginateditems.total_records" :value="resultsperpage" disabled>
                    <div @click="perPageChange('plus')" class="input-group-addon cursor btn-sm" >+</div>
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
module.exports = {
    props: ['paginateditems', 'resultsperpage'],
    data: function() {
        return {
        }
    },
    created: function() {

    },
    ready: function() {

    },
    computed: {

    },
    methods: {
        perPageChange(direction){
            this.$emit('numpageschanged', direction)
        },
        paginateChange(pageNumber, numResults){
            this.$emit('pagechanged', pageNumber, numResults)
        }
    },
};
</script>
