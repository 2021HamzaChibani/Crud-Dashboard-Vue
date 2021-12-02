import moment from 'moment'

export default function (start){
    let fetcha = moment(start)

    return fetcha.format('YYYY-MM-DD HH:mm:ss')
}
