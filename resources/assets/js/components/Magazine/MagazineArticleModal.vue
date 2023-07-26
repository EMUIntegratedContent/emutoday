<template>
	<!-- Modal -->
	<div id="articleQueueModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">{{ modalPosition == 0 ? 'Choose Main Article' : 'Choose Article ' + modalPosition }}</h4>
				</div>
				<div class="modal-body">
					<!-- Date filter -->
					<form class="form-inline">
            <div class="form-group">
              <label>Showing articles with a Start Date <span v-if="isEndDate">between</span><span v-else>on or after</span>
                <flatpickr
                    v-if="startDate"
                    v-model="startDate"
                    id="start-date"
                    :config="flatpickrConfig"
                    class="form-control"
                    name="startingDate"
                >
                </flatpickr>
              </label>
            </div>
            <div v-if="isEndDate" class="form-group">
              <label> and
                <flatpickr
                    v-if="endDate"
                    v-model="endDate"
                    id="endDatePicker"
                    :config="flatpickrConfig"
                    class="form-control"
                    name="endingDate"
                >
                </flatpickr>
              </label>
            </div>
						<p>
							<button type="button" class="btn btn-sm btn-info" @click="fetchQueueArticles">Filter</button>
							<button type="button" id="rangetoggle" @click="toggleRange"><span v-if="isEndDate"> - Remove </span><span v-else> + Add </span>Range</button>
						</p>
					</form>
					<hr>
					Filter Story Titles: <input v-model="searchString" /><button v-if="searchString != ''" @click="searchString = ''">X</button>
					<hr>
					<h3>Main Articles</h3>
					<p>Flagged as featured articles and have the "front" image type. Can also be used as sub articles.</p>
					<p class="text-red" v-if="mainArticlesPaginated.length == 0">-- No matching articles found --</p>
					<magazine-article-pod
							v-for="(mainArticle, index) in mainArticlesPaginated"
							type="main"
							:article="mainArticle"
							:key="'main-article-' + index"
							@use-article="handleSetArticle"
							@remove-article="handleSetArticle(null)"
					></magazine-article-pod>
					<ul class="pagination">
						<li v-bind:class="{disabled: (currentPageMain <= 1)}" class="page-item">
							<a href="#" @click.prevent="setPageMain(currentPageMain-1)" class="page-link" tabindex="-1">Previous</a>
						</li>
						<li v-for="pageNumber in totalPagesMain" :class="{active: (pageNumber) == currentPageMain}" class="page-item">
							<a class="page-link" href="#" @click.prevent="setPageMain(pageNumber)">{{ pageNumber }} <span v-if="(pageNumber) == currentPageMain" class="sr-only">(current)</span></a>
						</li>
						<li v-bind:class="{disabled: (currentPageMain == totalPagesMain)}" class="page-item">
							<a class="page-link" @click.prevent="setPageMain(currentPageMain+1)" href="#">Next</a>
						</li>
					</ul>
					<template v-if="modalPosition != 0">
						<hr>
						<h3>Sub Articles</h3>
						<p>These articles can not be used as the main article.</p>
						<magazine-article-pod
								v-for="(subArticle, index) in subArticlesPaginated"
								type="sub"
								:article="subArticle"
								:key="'sub-article-' + index"
								@use-article="handleSetArticle"
								@remove-article="handleSetArticle(null)"
						></magazine-article-pod>
						<ul class="pagination">
							<li v-bind:class="{disabled: (currentPageSub <= 1)}" class="page-item">
								<a href="#" @click.prevent="setPageSub(currentPageSub-1)" class="page-link" tabindex="-1">Previous</a>
							</li>
							<li v-for="pageNumber in totalPagesSub" :class="{active: (pageNumber) == currentPageSub}" class="page-item">
								<a class="page-link" href="#" @click.prevent="setPageSub(pageNumber)">{{ pageNumber }} <span v-if="(pageNumber) == currentPageSub" class="sr-only">(current)</span></a>
							</li>
							<li v-bind:class="{disabled: (currentPageSub == totalPagesSub)}" class="page-item">
								<a class="page-link" @click.prevent="setPageSub(currentPageSub+1)" href="#">Next</a>
							</li>
						</ul>
					</template>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { builderMixin } from "./builder_mixin"
  import flatpickr from 'vue-flatpickr-component'
  import 'flatpickr/dist/flatpickr.css'
	import MagazineArticlePod from "./MagazineArticlePod"

	export default {
		mixins: [ builderMixin ],
		components: { flatpickr, MagazineArticlePod },
		props: {

		},
		created: function () {
		},
		data: function () {
			return {
				formErrors: {},
				currentPageMain: 1,
				itemsPerPageMain: 10,
				resultCountMain: 0,
				currentPageSub: 1,
				itemsPerPageSub: 10,
				resultCountSub: 0,
				searchString: '',
        flatpickrConfig: {
          altFormat: "m/d/Y", // format the user sees
          altInput: true,
          dateFormat: "Y-m-d", // format sumbitted to the API
          enableTime: true
        },
			}
		},
		computed: {
			mainArticlesPaginated() {
				if(!this.magazineBuilderArticlesMain) return []
				let articles = this.magazineBuilderArticlesMain
				// Take title search into account
				if(this.searchString != '') {
					articles = this.magazineBuilderArticlesMain.filter(ma => {
						return ma.title.toLowerCase().includes(this.searchString.toLowerCase())
					})
				}
				this.resultCountMain = articles.length
				if (this.currentPageMain > this.totalPagesMain) {
					this.currentPageMain = 1
				}
				let index = (this.currentPageMain-1) * this.itemsPerPageMain
				return articles.slice(index, index + this.itemsPerPageMain)
			},
			subArticlesPaginated() {
				if(!this.magazineBuilderArticlesSub) return []
				let articles = this.magazineBuilderArticlesSub
				// Take title search into account
				if(this.searchString != '') {
					articles = this.magazineBuilderArticlesSub.filter(sa => {
						return sa.title.toLowerCase().includes(this.searchString.toLowerCase())
					})
				}
				this.resultCountSub = articles.length
				if (this.currentPageSub > this.totalPagesSub) {
					this.currentPageSub = 1
				}
				let index = (this.currentPageSub-1) * this.itemsPerPageSub
				return articles.slice(index, index + this.itemsPerPageSub)
			},
			totalPagesMain: function() {
				if(!this.magazineBuilderArticlesMain) return 0
				return Math.ceil(this.magazineBuilderArticlesMain.length / this.itemsPerPageMain)
			},
			totalPagesSub: function() {
				if(!this.magazineBuilderArticlesSub) return 0
				return Math.ceil(this.magazineBuilderArticlesSub.length / this.itemsPerPageSub)
			},
		},
		methods: {
			close() {
				this.$emit('close');
				this.modalPosition = '' // reset modal position in the builderMixin
			},
			articleImage(article) {
				return article.images.find(img => {
					return img.image_type == 'front'
				})
			},
			setPageMain: function(pageNumber) {
				if(pageNumber > 0 && pageNumber <= this.totalPagesMain){
					this.currentPageMain = pageNumber
				}
			},
			setPageSub: function(pageNumber) {
				if(pageNumber > 0 && pageNumber <= this.totalPagesSub){
					this.currentPageSub = pageNumber
				}
			},
			toggleRange: function(){
				if(this.isEndDate){
					this.isEndDate = false
				} else {
					this.isEndDate = true
				}
			},
			handleSetArticle(article) {
				this.setIssueArticleAtIndex({index: this.modalPosition, article: article})
			}
		},
		watch: {

		},
		filters: {
		}
	};
</script>
<style scoped>
	.modal-body {
		max-height: 800px;
		overflow-y: scroll;
	}
	#rangetoggle{
		color: #FF851B;
		margin-left: 5px;
		border-bottom: 2px #FF851B dotted;
	}
</style>

