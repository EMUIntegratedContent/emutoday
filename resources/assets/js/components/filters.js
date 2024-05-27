import moment from 'moment'

export const slashdatetime = (datetime) => {
	return moment(datetime).format('YYYY/MM/DD HH:mm A')
}
