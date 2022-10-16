<template>
    <div v-show="paginateditems.total_pages > 0" class="row">
        <div class="col-xs-12 col-sm-12 col-md-8">
            <ul class="pagination">
                <li :class="!isLessPages ? 'disabled' : ''">
                    <a href="#" @click.prevent="paginatorViewChange('beginning')"><span>&laquo;</span></a>
                </li>
                <li v-if="isLessPages">
                    <a href="#" @click.prevent="paginatorViewChange('minus')">...</a>
                </li>
                <li v-for="n in currentVisiblePages" :class="n == paginateditems.current_page ? 'active': ''">
                    <a href="#" @click.prevent="paginateChange(n, resultsperpage)">{{ n }}</a>
                </li>
                <li v-if="isMorePages">
                    <a href="#" @click.prevent="paginatorViewChange('plus')">...</a>
                </li>
                <li :class="!isMorePages ? 'disabled' : ''">
                    <a href="#" @click.prevent="paginatorViewChange('end')"><span>&raquo;</span></a>
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
            pageRange: []
        }
    },
    created: function() {
    },
    ready: function() {
        this.setVisiblePages()
    },
    computed: {
        isMorePages: function(){
            return this.paginateditems.total_pages > this.pageRange[this.pageRange.length - 1]
        },
        isLessPages: function(){
            return this.pageRange[0] !== 1
        },
        currentVisiblePages: function(){
            let totalPages = this.paginateditems.total_pages
            let pageRange = this.pageRange

            var pages = []
            for(var i = 0; i < 5; i++){
                if(pageRange[i] <= totalPages){
                    pages.push(pageRange[i])
                }
            }
            return pages
        }
    },
    methods: {
        perPageChange(direction){
            this.$emit('numpageschanged', direction)
        },
        paginateChange(pageNumber, numResults){
            this.$emit('pagechanged', pageNumber, numResults)
        },
        paginatorViewChange(direction){
            var newPageNumbers = [];

            if(direction == 'plus'){
                let currentLastPage = this.pageRange[this.pageRange.length -1]

                for(var i = 1; i <= 5; i++){
                    var pageNumber = currentLastPage + i
                    if(pageNumber <= this.paginateditems.total_pages){
                        newPageNumbers.push(pageNumber)
                    }
                }
                this.pageRange = newPageNumbers
            }

            if(direction == 'minus'){
                let currentFirstPage = this.pageRange[0]

                for(var i = 5; i > 0; i--){
                    var pageNumber = currentFirstPage - i
                    if(pageNumber >= 1){
                        newPageNumbers.push(pageNumber)
                    }
                }
                this.pageRange = newPageNumbers
            }

            if(direction == 'beginning'){
                this.paginateChange(1, this.resultsperpage)

                for(var i = 1; i <= 5; i++){
                    if(i <= this.paginateditems.total_pages){
                        newPageNumbers.push(i)
                    }
                }
                this.pageRange = newPageNumbers
            }

            if(direction == 'end'){
                this.paginateChange(this.paginateditems.total_pages, this.resultsperpage)

                for(var i = 4; i >= 0; i--){
                    var pageNumber = this.paginateditems.total_pages - i
                    if(pageNumber >= 1){
                        newPageNumbers.push(pageNumber)
                    }
                }
                this.pageRange = newPageNumbers
            }
        },
        setVisiblePages(){
            this.pageRange = [1,2,3,4,5]
        }
    },
};
</script>
