import moment from 'moment'

export const slashdatetime = (datetime) => {
	const mmt = moment(datetime).format('MM/DD/YYYY h:mm A')
	if(mmt === 'Invalid date') {
		return '---'
	}
	return mmt
}

export const slashdate = (datetime) => {
	return moment(datetime).format('MM/DD/YYYY')
}
