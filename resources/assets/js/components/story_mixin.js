import { mapActions, mapState, mapMutations, mapGetters } from "vuex"
import moment from 'moment'

export const storyMixin = {
	created() {

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
			'recordId',
			'recordIsDirty',
			'recordState'
		]),
	},
	methods: {
		...mapActions([
			'updateRecordId',
			'updateRecordIsDirty',
			'updateRecordState'
		])
	}
};
