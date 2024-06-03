import moment from 'moment'

export const slashdatetime = (datetime) => {
	return moment(datetime).format('MM/DD/YYYY h:mm A')
}

export const slashdate = (datetime) => {
	return moment(datetime).format('MM/DD/YYYY')
}
