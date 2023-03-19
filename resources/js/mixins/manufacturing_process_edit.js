export default {
    methods: {
        redefineTimesDurationAddOne: function () {
            let last_time = this.last_time

            let from = this.$parent.steps[ this.k ].from
            let duration = this.$parent.steps[ this.k ].duration

            if (from[0] === '+') {
                let from_period = parseInt(from.replace('+', ''))
                let to_period = from_period + duration
                let last_time_period = parseInt(last_time.period.replace('+', ''))

                if (to_period > last_time_period) {
                    this.times.push(last_time)
                    this.last_time = { period: '+'+to_period, label: this.$t('day')+' +'+to_period }
                }
            }
        },
        redefineTimesStartAddOne: function () {
            let last_time = this.last_time

            let from = this.$parent.steps[ this.k ].from
            let duration = this.$parent.steps[ this.k ].duration

            if (from[0] === '+') {
                let from_period = parseInt(from.replace('+', ''))
                let to_period = from_period + duration
                let last_time_period = parseInt(last_time.period.replace('+', ''))

                if (to_period > last_time_period) {
                    this.times.push(last_time)
                    this.last_time = { period: '+'+to_period, label: this.$t('day')+' +'+to_period }
                }
            }
        },
        redefineTimesStartSubOne: function () {
            let times = this.times
            let from = this.$parent.steps[ this.k ].from

            if (from[0] === '-') {
                let first_time = times[0].period
                let from_period = parseInt(from.replace('-', ''))

                if (first_time === '+0') {
                    this.times = [
                        { period: '-1', label: this.$t('day')+' -1' },
                        ...times
                    ]

                    return
                }

                if (first_time[0] === '-') {
                    let first_time_period = parseInt(first_time.replace('-', ''))

                    if (first_time_period < from_period) {
                        var new_times = []

                        for (let i = from_period; i > first_time_period; i--) {
                            new_times.push({ period: '-'+i, label: this.$t('day')+' -'+i })
                        }

                        this.times = new_times.concat(times)
                    }
                }
            }
        }
    }
}