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
							<button type="button" class="btn btn-sm btn-info builder-exchange" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition('main')"><i class="fa fa-exchange" aria-hidden="true"></i></button>
							<template v-if="usedMainArticle">
								<button type="button" class="btn btn-sm btn-danger builder-remove" data-toggle="modal" @click="setMainArticle(null)"><i class="fa fa-close" aria-hidden="true"></i></button>
								<img width="100%" :src="mainArticleImage(usedMainArticle).image_path + mainArticleImage(usedMainArticle).filename" :alt="mainArticleImage(usedMainArticle).moretext">
								<p class="builder-article-title">
									<a :href="'/admin/queuearticle/magazine/article/' + usedMainArticle.id + '/edit'" target="_blank">{{ usedMainArticle.title }}</a>
								</p>
							</template>
							<template v-else>
								<p class="builder-article-title"><strong>Main Article Not Set</strong></p>
							</template>
						</div>
					</div>
					<div class="substory-box">
						<button type="button" class="btn btn-sm btn-info builder-exchange" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition('sub-1')"><i class="fa fa-exchange" aria-hidden="true"></i></button>
						<template v-if="usedSubArticle1">
							<button type="button" class="btn btn-sm btn-danger builder-remove" data-toggle="modal" @click="setSubArticle1(null)"><i class="fa fa-close" aria-hidden="true"></i></button>
							<img width="100%" :src="subArticleImage(usedSubArticle1).image_path + subArticleImage(usedSubArticle1).filename" :alt="subArticleImage(usedSubArticle1).moretext">
							<p class="builder-article-title">
								<a :href="'/admin/queuearticle/magazine/article/' + usedSubArticle1.id + '/edit'" target="_blank">{{ usedSubArticle1.title }}</a>
							</p>
						</template>
						<template v-else>
							<p class="builder-article-title"><strong>Not Set</strong></p>
						</template>
					</div>
					<div class="substory-box">
						<button type="button" class="btn btn-sm btn-info builder-exchange" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition('sub-2')"><i class="fa fa-exchange" aria-hidden="true"></i></button>
						<template v-if="usedSubArticle2">
							<button type="button" class="btn btn-sm btn-danger builder-remove" data-toggle="modal" @click="setSubArticle2(null)"><i class="fa fa-close" aria-hidden="true"></i></button>
							<img width="100%" :src="subArticleImage(usedSubArticle2).image_path + subArticleImage(usedSubArticle2).filename" :alt="subArticleImage(usedSubArticle2).moretext">
							<p class="builder-article-title">
								<a :href="'/admin/queuearticle/magazine/article/' + usedSubArticle2.id + '/edit'" target="_blank">{{ usedSubArticle2.title }}</a>
							</p>
						</template>
						<template v-else>
							<p class="builder-article-title"><strong>Not Set</strong></p>
						</template>
					</div>
					<div class="substory-box">
						<button type="button" class="btn btn-sm btn-info builder-exchange" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition('sub-3')"><i class="fa fa-exchange" aria-hidden="true"></i></button>
						<template v-if="usedSubArticle3">
							<button type="button" class="btn btn-sm btn-danger builder-remove" data-toggle="modal" @click="setSubArticle3(null)"><i class="fa fa-close" aria-hidden="true"></i></button>
							<img width="100%" :src="subArticleImage(usedSubArticle3).image_path + subArticleImage(usedSubArticle3).filename" :alt="subArticleImage(usedSubArticle3).moretext">
							<p class="builder-article-title">
								<a :href="'/admin/queuearticle/magazine/article/' + usedSubArticle3.id + '/edit'" target="_blank">{{ usedSubArticle3.title }}</a>
							</p>
						</template>
						<template v-else>
							<p class="builder-article-title"><strong>Not Set</strong></p>
						</template>
					</div>
					<div class="substory-box">
						<button type="button" class="btn btn-sm btn-info builder-exchange" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition('sub-4')"><i class="fa fa-exchange" aria-hidden="true"></i></button>
						<template v-if="usedSubArticle4">
							<button type="button" class="btn btn-sm btn-danger builder-remove" data-toggle="modal" @click="setSubArticle4(null)"><i class="fa fa-close" aria-hidden="true"></i></button>
							<img width="100%" :src="subArticleImage(usedSubArticle4).image_path + subArticleImage(usedSubArticle4).filename" :alt="subArticleImage(usedSubArticle4).moretext">
							<p class="builder-article-title">
								<a :href="'/admin/queuearticle/magazine/article/' + usedSubArticle4.id + '/edit'" target="_blank">{{ usedSubArticle4.title }}</a>
							</p>
						</template>
						<template v-else>
							<p class="builder-article-title"><strong>Not Set</strong></p>
						</template>
					</div>
					<div class="substory-box">
						<button type="button" class="btn btn-sm btn-info builder-exchange" data-toggle="modal" data-target="#articleQueueModal" @click="setModalPosition('sub-5')"><i class="fa fa-exchange" aria-hidden="true"></i></button>
						<template v-if="usedSubArticle5">
							<button type="button" class="btn btn-sm btn-danger builder-remove" data-toggle="modal" @click="setSubArticle5(null)"><i class="fa fa-close" aria-hidden="true"></i></button>
							<img width="100%" :src="subArticleImage(usedSubArticle5).image_path + subArticleImage(usedSubArticle5).filename" :alt="subArticleImage(usedSubArticle5).moretext">
							<p class="builder-article-title">
								<a :href="'/admin/queuearticle/magazine/article/' + usedSubArticle5.id + '/edit'" target="_blank">{{ usedSubArticle5.title }}</a>
							</p>
						</template>
						<template v-else>
							<p class="builder-article-title"><strong>Not Set</strong></p>
						</template>
					</div>
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
