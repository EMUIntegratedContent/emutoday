<template>
	<div>
		<magazine-article-modal></magazine-article-modal>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
				<h3>Main and Sub Articles</h3>
				<p>These articles will show on the magazine homepage in the order shown below.</p>
				<div class="builder-container">
					<div class="mainstory-box">
						<div style="margin: 0 auto; max-width: 950px; position: relative">
							<button type="button" class="btn btn-sm btn-info builder-exchange" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition(0)"><i class="fa fa-exchange" aria-hidden="true"></i></button>
							<template v-if="issueArticles[0]">
								<button type="button" class="btn btn-sm btn-danger builder-remove" data-toggle="modal" @click="setIssueArticleAtIndex({index: 0, article: null})"><i class="fa fa-close" aria-hidden="true"></i></button>
								<img width="100%" :src="mainArticleImage(issueArticles[0]).image_path + mainArticleImage(issueArticles[0]).filename" :alt="mainArticleImage(issueArticles[0]).moretext">
								<p class="builder-article-title">
									<a :href="'/admin/queuearticle/magazine/article/' + issueArticles[0].id + '/edit'" target="_blank">{{ issueArticles[0].title }}</a>
								</p>
							</template>
							<template v-else>
								<p class="builder-article-title"><strong>Main Article Not Set</strong></p>
							</template>
						</div>
					</div>
					<template v-for="(article, index) in issueArticles">
						<div v-if="index >= 1 && index <= 5" class="substory-box">
							<button type="button" class="btn btn-xs btn-info builder-exchange" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition(index)"><i class="fa fa-exchange" aria-hidden="true"></i></button>
							<template v-if="article">
								<button type="button" class="btn btn-xs btn-danger builder-remove" data-toggle="modal" @click="setIssueArticleAtIndex({index: index, article: null})"><i class="fa fa-close" aria-hidden="true"></i></button>
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
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
				<h3>Other Stories</h3>
				<p>These articles will only show in the list on the /magazine/issue page. They will NOT be visible on the magazine homepage.</p>
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
				type: Number,
				default: 5
			}
		},
		created: function () {
			this.fetchQueueArticles()
			this.fetchIssueArticles(this.issueId)
		},
		data: function () {
			return {

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
			mainArticleImage(article) {
				return article.images.find(img => {
					return img.image_type == 'front'
				})
			},
			subArticleImage(article) {
				return article.images.find(img => {
					return img.image_type == 'small'
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
		overflow: hidden
	}
	.substory-box {
		float: left;
		width: 20%;
		min-height: 50px;
		position: relative;
		border: 1px solid white;
	}

	.builder-exchange {
		position: absolute;
		left:5px;
		top: 5px;
		z-index:50
	}

	.builder-remove {
		position: absolute;
		right:5px;
		top: 5px;
		z-index:50
	}

	.builder-container {
		border: 1px solid black;
	}
	.builder-container .btn {
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
</style>
