<template>
	<div>
		<magazine-article-modal></magazine-article-modal>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
				<h3>Main and Sub Articles</h3>
				<p>These articles will show on the magazine homepage in the order shown below.</p>
				<div class="builder-container">
					<div class="mainstory-box">
						<div class="magazine-tool-container">
							<button v-if="issueArticles[0]" type="button" class="btn btn-sm btn-success magazine-tool-btn" style="margin-right: 20px;" @click="moveArticleRight(0, issueArticles[0])"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-sm btn-info magazine-tool-btn" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition(0)"><i class="fa fa-exchange" aria-hidden="true"></i></button>
							<button v-if="issueArticles[0]" type="button" class="btn btn-sm btn-danger magazine-tool-btn" data-toggle="modal" @click="setIssueArticleAtIndex({index: 0, article: null})"><i class="fa fa-close" aria-hidden="true"></i></button>
						</div>
						<template v-if="issueArticles[0]">
							<img width="100%" :src="mainArticleImage(issueArticles[0]).image_path + mainArticleImage(issueArticles[0]).filename" :alt="mainArticleImage(issueArticles[0]).moretext">
							<p class="builder-article-title">
								<a :href="'/admin/queuearticle/magazine/article/' + issueArticles[0].id + '/edit'" target="_blank">{{ issueArticles[0].title }}</a>
							</p>
						</template>
						<template v-else>
							<p class="builder-article-title"><strong>Main Article Not Set</strong></p>
						</template>
					</div>
					<template v-for="(article, index) in issueArticles">
						<div v-if="index >= 1 && index <= 5" class="substory-box">
							<div class="magazine-tool-container">
								<button v-if="article && (index > 1 || mainArticleImage(article))" type="button" class="btn btn-xs btn-success" style="margin-right: 20px;" @click="moveArticleLeft(index, article)"><i :class="index == 1 ? 'fa fa-arrow-up' : 'fa fa-arrow-left'" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition(index)"><i class="fa fa-exchange" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" @click="setIssueArticleAtIndex({index: index, article: null})"><i class="fa fa-close" aria-hidden="true"></i></button>
								<button v-if="article && (index < 5 || issueArticles.length > 6)" type="button" class="btn btn-xs btn-success" style="margin-left: 20px;" @click="moveArticleRight(index, article)"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
							</div>
							<template v-if="article">
								<img width="100%" :src="subArticleImage(article).image_path + subArticleImage(article).filename" :alt="subArticleImage(article).moretext">
								<p class="builder-article-title">
									<a :href="'/admin/queuearticle/magazine/article/' + article.id + '/edit'" target="_blank">{{ article.title }}</a>
								</p>
							</template>
							<template v-else>
								<p class="builder-article-title"><strong>Not Set</strong></p>
							</template>
						</div>
					</template>
					<div style="clear: both"></div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 other-stories-container">
				<h3>Other Stories</h3>
				<p>These articles will only show in the list on the /magazine/issue page. They will NOT be visible on the magazine homepage.</p>
				<template v-for="(article, index) in issueArticles">
					<div v-if="index > 5 && article" class="other-substory-box">
						<div class="magazine-tool-container" style="margin-bottom: 2px">
							<button v-if="index > 1 || mainArticleImage(article)" type="button" class="btn btn-xs btn-success" style="margin-right: 20px;" @click="moveArticleLeft(index, article)"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition(index)"><i class="fa fa-exchange" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" @click="removeOtherArticleAtIndex(index)"><i class="fa fa-close" aria-hidden="true"></i></button>
							<button v-if="index < issueArticles.length - 1 && issueArticles[index+1]" type="button" class="btn btn-xs btn-success" style="margin-left: 20px;" @click="moveArticleRight(index, article)"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
						</div>
						<img width="100" :src="subArticleImage(article).image_path + subArticleImage(article).filename" :alt="subArticleImage(article).moretext">
						<a :href="'/admin/queuearticle/magazine/article/' + article.id + '/edit'" target="_blank">{{ article.title }}</a>
					</div>
					<div v-else-if="index > 5 && !article" class="other-substory-box" style="min-height: 73px">
						<button type="button" class="btn btn-xs btn-info builder-exchange" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition(index)"><i class="fa fa-exchange" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-xs btn-danger builder-remove-other" data-toggle="modal" @click="removeOtherArticleAtIndex(index)"><i class="fa fa-close" aria-hidden="true"></i></button>
					</div>
				</template>
				<button v-if="issueArticles.length > 5 && issueArticles[issueArticles.length-1]" class="btn btn-primary btn-block" @click="handleAddOtherArticle">Add Article</button>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 mt-3" style="margin-top:15px">
				<button class="btn btn-primary btn-block" @click="saveArticles">Update Magazine Builder</button>
				<p v-if="saving" class="text-info">Saving...</p>
				<p v-if="saved" class="text-success">Articles saved</p>
				<p v-if="saveError" class="text-danger">Error saving articles</p>
			</div>
		</div>
	</div>
</template>
<script>
	import MagazineArticleModal from "./MagazineArticleModal";
	import { builderMixin } from "./builder_mixin";

	export default {
		mixins: [ builderMixin ],
		components: { MagazineArticleModal },
		props: {
			issueId: {
				type: String,
				required: true
			}
		},
		created: function () {
			this.fetchQueueArticles()
			this.fetchIssueArticles(this.issueId)
		},
		data: function () {
			return {
				saving: false,
				saved: false,
				saveError: false
			}
		},
		computed: {
			isAdmin: function () {
				if (this.userRoles.indexOf('admin') != -1) {
					return true;
				}
				else {
					if (this.userRoles.indexOf('admin_super') != -1) {
						return true;
					}
					else {
						return false;
					}
				}
			},
		},
		methods: {
			handleAddOtherArticle() {
				this.addOtherArticle()
			},
			mainArticleImage(article) {
				if(!article) return null
				return article.images.find(img => {
					return img.image_type == 'front'
				})
			},
			moveArticleLeft(index, article) {
				const prevArticle = this.issueArticles[index - 1]
				if(prevArticle) {
					this.setIssueArticleAtIndex({index: index, article: prevArticle})
				} else {
					this.setIssueArticleAtIndex({index: index, article: null})
				}
				this.setIssueArticleAtIndex({index: index - 1, article: article})
			},
			moveArticleRight(index, article) {
				const nextArticle = this.issueArticles[index + 1]
				if(nextArticle) {
					// The next article should not be moved left (up) to the main story if it doesn't have the appropriate image
					if(index == 0) {
						if(this.mainArticleImage(nextArticle)) {
							this.setIssueArticleAtIndex({index: index, article: nextArticle})
						} else {
							this.setIssueArticleAtIndex({index: index, article: null})
						}
					} else {
						this.setIssueArticleAtIndex({index: index, article: nextArticle})
					}
				} else {
					this.setIssueArticleAtIndex({index: index, article: null})
				}
				this.setIssueArticleAtIndex({index: index + 1, article: article})
			},
			subArticleImage(article) {
				return article.images.find(img => {
					return img.image_type == 'small'
				})
			},
			saveArticles() {
				this.saveError = false
				this.saved = false
				this.saving = true

				// Just send the issue article IDs, not entire objects
				let issueArticleIDs = []
				this.issueArticles.forEach(ia => {
					const articleID = ia ? ia.id : null
					issueArticleIDs.push(articleID)
				})

				let routeUrl = `/api/magazine/savearticles`;
				this.$http.put(routeUrl, {
					issueId: this.issueId,
					articles: issueArticleIDs
				})
				.then((response) => {
					this.saving = false
					this.saveError = false
					this.saved = true
					// Make sure the articles on the server match what's on the front end
					response.body.newdata.stories.forEach(article => {
						const position = article.pivot.story_position
						this.setIssueArticleAtIndex({index: position, article: article})
					})
					setTimeout(() => {
						this.saved = false
					}, 3000)
				})
				.catch(e => {
					console.log(e)
					this.saving = false
					this.saved = false
					this.saveError = true
				})
			}
		},
		watch: {

		},
		filters: {
		}
	};
</script>
<style scoped>
	.redBtn {
		background: hsl(0, 90%, 70%);
	}

	.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
		color: #3c8dbc;
	}

	.nav-tabs a.disabled {
		color: #d2d6de;
	}
	.mainstory-box {
		width: 100%;
		min-height: 50px;
		border-bottom: 1px solid black;
		position: relative;
		overflow: hidden;
		max-width: 950px;
	}
	.substory-box {
		float: left;
		width: 20%;
		min-height: 50px;
		position: relative;
		border: 1px solid white;
	}

	.other-substory-box {
		position: relative;
		border: 1px solid black;
		padding: 5px;
		margin-bottom: 3px;
	}

	.builder-exchange {
		position: absolute;
		left:5px;
		top: 5px;
		z-index:50
	}

	.builder-remove-other {
		position: absolute;
		left:5px;
		bottom: 5px;
		z-index:50
	}

	.builder-container {
		border: 1px solid black;
	}
	.builder-container .btn, .other-stories-container .btn {
		opacity: 0.7;
	}
	.builder-container .btn:hover{
		opacity: 1;
	}
	.builder-article-title {
		text-align: center;
		font-weight: bold;
		padding-top: 3px;
	}
	.magazine-tool-container {
		text-align: center;
		padding: 3px;
		background: #444444;
	}
	.magazine-tool-btn {
		margin-right: 5px;
	}
</style>
