import { mapActions, mapState, mapMutations, mapGetters } from "vuex"
import moment from 'moment'

export const builderMixin = {
	created() {
		let sixMonthsEarlier = moment().subtract(6, 'M')
		this.startDate = sixMonthsEarlier.format("YYYY-MM-DD")
		this.endDate = moment().format("YYYY-MM-DD")
	},
	data(){
		return {
			startDate: null,
			endDate: null,
			isEndDate: false
		}
	},
	computed: {
		...mapState([
			'magazineBuilderArticlesMain',
			'magazineBuilderArticlesSub',
			'usedMainArticle',
			'usedSubArticle1',
			'usedSubArticle2',
			'usedSubArticle3',
			'usedSubArticle4',
			'usedSubArticle5',
			'modalPosition'
		]),
	},
	methods: {
		...mapMutations([
			'setMagazineArticlesMain',
			'setMagazineArticlesSub',
			'setMainArticle',
			'setSubArticle1',
			'setSubArticle2',
			'setSubArticle3',
			'setSubArticle4',
			'setSubArticle5',
			'setModalPosition',
		]),
		fetchQueueArticles: function () {
			let routeUrl = '/api/magazine/articles';

			// if a start date is set, get stories whose start_date is on or after this date
			if (this.startDate) {
				routeUrl = routeUrl + '/' + this.startDate
			}
			else {
				routeUrl = routeUrl + '/' + moment().subtract(6, 'm').format("YYYY-MM-DD")
			}

			// if a date range is set, get stories between the start date and end date
			if (this.isEndDate) {
				routeUrl = routeUrl + '/' + this.endDate
			}

			this.$http.get(routeUrl)
			.then((response) => {
				// Clear the old stories
				this.setMagazineArticlesMain([])
				this.setMagazineArticlesSub([])

				let stories = response.data.stories
				let mainStories = []
				let subStories = []
				stories.forEach(story => {
					const hasFrontImg = story.images.find(img => {
						return img.image_type == 'front'
					})
					if (story.is_featured && hasFrontImg) {
						mainStories.push(story)
					}
					else {
						subStories.push(story)
					}
				})

				// Load the stories into the Vuex store to be used across components
				this.setMagazineArticlesMain(mainStories)
				this.setMagazineArticlesSub(subStories)
			})
			.catch(e => {
				console.log(e)
			})
		},
		fetchIssueArticles: function (issueID) {
			let routeUrl = `/api/magazine/issuearticles/${issueID}`;
			this.$http.get(routeUrl)
			.then((response) => {
				this.setIssueArticles(response.body.stories)
			})
			.catch(e => {
				console.log(e)
			})
		},
		// Do this after fetching the issue articles
		setIssueArticles(articles) {
			articles.forEach(article => {
				const position = article.pivot.story_position
				switch (position) {
					case 0:
						this.setMainArticle(article)
						break
					case 1:
						this.setSubArticle1(article)
						break
					case 2:
						this.setSubArticle2(article)
						break
					case 3:
						this.setSubArticle3(article)
						break
					case 4:
						this.setSubArticle4(article)
						break
					case 5:
						this.setSubArticle5(article)
						break
					// Any position > 6 goes in the other story list
					default:
						break
				}
			})
		}
	}
};
