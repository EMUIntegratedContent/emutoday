import Vuex from 'vuex'

const emptyIdea = () => {
	return {
		id: 0,
		title: '',
		teaser: '',
		content: '',
		contributor_netid: '',
		contributor_first: '',
		contributor_last: '',
		use_other_source: 0,
		other_source: '',
		archived: 0,
		is_submitted: 0,
		admin_status: 'New',
		created_at: null,
		updated_at: null,
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
		admin_status: 'Pending',
		seq: 0,
		submittedBy: null,
		created_at: null,
		updated_at: null,
		images: []
	}
}

const state = {
	idea: emptyIdea(),
	ideaImgsForUpload: [],
	ideas: [],
	post: emptyPost(),
	postImageTypes: [],
	postImgsForUpload: [],
	posts: [],
}
const mutations = {
	addPostImageRecord(state, imgRecord) {
		state.post.images.push(imgRecord)
	},
	setIdea (state, idea) {
		state.idea = idea
	},
	setIdeaImagsForUpload (state, imgs) {
		state.ideaImgsForUpload = imgs
	},
	setIdeaProp (state, { prop, value }) {
		state.idea[prop] = value
	},
	setIdeas (state, ideas) {
		state.ideas = ideas
	},
	setPost (state, post) {
		state.post = post
	},
	setPostImageTypes (state, types) {
		state.postImageTypes = types
	},
	setPostProp (state, { prop, value }) {
		state.post[prop] = value
	},
	setPostImgsForUpload (state, imgs) {
		state.postImgsForUpload = imgs
	},
	setPosts (state, posts) {
		state.posts = posts
	},
	removePostImgById (state, imagetype_id) {
		const index = state.post.images.findIndex(img => img.imagetype_id === imagetype_id)
		state.post.images.splice(index, 1)
	},
	updatePostImageRecord(state, { index, imgRecord }) {
		console.log(index)
		console.log(imgRecord)
		state.post.images[index] = imgRecord
	}
}
const actions = {
	// Add a blank image record to the post (e.g. small, story, email). Corresponds to insideemu_posts_images table.
	createPostImageRecord({commit}, imgType) {
		const matchingImgType = state.postImageTypes.find(type => type.type === imgType)
		if(!matchingImgType) {
			return {
				success: false,
				message: 'Image type not found: ' + imgType
			}
		}

		// See if the image type already exists in the post
		const existingRecord = state.post.images.find(img => img.imagetype_id === matchingImgType.id)
		if(existingRecord) {
			return {
				success: false,
				message: `Image type ${imgType} already exists in post. Not adding...`
			}
		}

		commit('addPostImageRecord', {
			id: null,
			insideemu_post_id: state.post.postId,
			is_active: 0,
			image_name: '',
			image_path: '',
			title: '',
			caption: '',
			teaser: '',
			moretext: '',
			alt_text: '',
			link: '',
			link_text: '',
			image_extension: '',
			imagetype_id: matchingImgType.id
		})

		return {
			success: true,
			message: `Image type ${imgType} added to post.`
		}
	},
	updatePostImageRecord ({commit, state}, { imagetype_id, props }) {
		// Find the image's index in the post's images array based on the imagetype_id
		const imgIndex = state.post.images.findIndex(img => img.imagetype_id === imagetype_id)
		// Use the existing record's fields and the new props to update the record.
		const updatedImgRecord = {
			...state.post.images[imgIndex],
			...props
		}
		commit('updatePostImageRecord', { index: imgIndex, imgRecord: updatedImgRecord })
	}
}

const getters = {
	insideemuSmallImgID: state => {
		const matchingImgType = state.postImageTypes.find(type => type.type === 'small')
		if(!matchingImgType) {
			return null
		}
		return matchingImgType.id
	},
	insideemuStoryImgID: state => {
		const matchingImgType = state.postImageTypes.find(type => type.type === 'story')
		if(!matchingImgType) {
			return null
		}
		return matchingImgType.id
	},
	insideemuEmailImgID: state => {
		const matchingImgType = state.postImageTypes.find(type => type.type === 'email')
		if(!matchingImgType) {
			return null
		}
		return matchingImgType.id
	},
	// Return true if the post has all required images, false otherwise.
	postHasRequiredImages: (state, getters) => {
		if(!getters.postRequiredImageIDs.length) return true
		return getters.postRequiredImageIDs.every(id => state.post.images.some(img => img.imagetype_id === id))
	},
	// Based on the postImageTypes, return an array of the imagetype_ids that are required for this post to go live.
	postRequiredImageIDs: state => {
		return state.postImageTypes.filter(type => type.is_required === 1).map(type => type.id)
	}
}

export default new Vuex.Store({
	state,
	mutations,
	actions,
	getters
})
