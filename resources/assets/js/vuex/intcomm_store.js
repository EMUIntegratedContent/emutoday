import Vuex from 'vuex'

const emptyIdea = () => {
	return {
		id: 0,
		title: '',
		teaser: '',
		content: '',
		start_date: null,
		end_date: null,
		status: 'Draft',
		submittedBy: null,
		images: []
	}
}

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
	idea: emptyIdea(),
	ideas: [],
	post: emptyPost(),
	posts: [],
}
const mutations = {
	setIdea (state, idea) {
		state.idea = idea
	},
	setIdeas (state, ideas) {
		state.ideas = ideas
	},
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
