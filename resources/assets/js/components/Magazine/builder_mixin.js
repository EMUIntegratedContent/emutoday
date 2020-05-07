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
			'issueArticles',
			'modalPosition'
		]),
	},
	methods: {
		...mapMutations([
			'setMagazineArticlesMain',
			'setMagazineArticlesSub',
			'setIssueArticleAtIndex',
			'setIssueArticles',
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
				response.body.stories.forEach(article => {
					const position = article.pivot.story_position
					this.setIssueArticleAtIndex({index: position, article: article})
				})
			})
			.catch(e => {
				console.log(e)
			})
		},
	}
};
