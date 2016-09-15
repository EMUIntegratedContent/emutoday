<template>
    <div class="search-form-wrapper">
        <template v-if="searchFormIsOpen">
            <form action="/search" method="get" class="search-form">
                <slot name="csrf"></slot>
            <label>Search:</label><input type="text" name="searchterm" placeholder="Search" v-model="searchterm"><button type="submit"><i class="fa fa-search"></i></button><button @click.prevent="closeSearchForm"><i class="fa fa-x"></i></button>
        </form>
        </template>
        <template v-else>
            <span class="search-area"><a @click.prevent="openSearchForm">Search <i class="fa fa-search"></i></a></span>
        </template>
    </div>
</template>
<style scoped>
    .search-form-wrapper {
        /*display: inline;
        float:right;*/
    }
    form.search-form  {
        /*width: 100%;*/
        display: inline;
        float:right;
    }
    label{
        display: inline;
        padding-right: 5px;
    }
    button{
        display: inline;
        padding-left: 5px;
    }
    input[type=text] {
            display: inline;
            width: 150px;
            height: 1rem;
            font-size: 0.8rem;
            margin-bottom: 0;
    }

</style>


<script>

module.exports = {
    directives: {},
    components: {},
    props: {},
    data: function() {
        return {
            searchFormIsOpen: false,
            searchterm:''

        }
    },
    created: function() {

    },
    ready() {
    },
    computed: {


    },
    methods: {
        openSearchForm:function(evt){
            this.searchFormIsOpen = true;
        },
        closeSearchForm:function(evt){
            this.searchFormIsOpen = false;
        },
        submitSearch: function (e) {
            this.$http.get('/search', this.searchterm);
        }

        },
    watch: {},
    filters: {},
    events: {}
};

</script>
