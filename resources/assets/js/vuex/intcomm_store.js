import Vuex from 'vuex'

const emptyPost = () => {
	return {
		id: 0,
		title: '',
		teaser: '',
		content: '',
		start_date: null,
		end_date: null,
		status: 'Draft',
		submittedBy: null,
		created_at: null,
		updated_at: null,
		images: []
	}
}

const state = {
	post: emptyPost(),
	posts: [],
}
const mutations = {
	setPost (state, post) {
		state.post = post
	},
	setPosts (state, posts) {
		state.posts = posts
	}
}
const actions = {

}

const getters = {

}

export default new Vuex.Store({
	state,
	mutations,
	actions,
	getters
})
