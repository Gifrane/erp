<template>
    <div class="month-days">
        <div class="md-header">
            <svg @click="previous()" class="mdh-previous" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.8308 10.4975L19.8333 8.5L11.3333 17L19.8333 25.5L21.8308 23.5025L15.3425 17L21.8308 10.4975Z" fill="black"/>
            </svg>

            <div class="mdh-date">
                <div class="mdhd-month" @click="listMonths()">{{ $t('calendar.months.number.'+$parent.display_month) }}</div>
                <div class="mdhd-year" @click="listYears()">{{ $parent.display_year }}</div>
            </div>

            <svg @click="next()" class="mdh-next" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.195 8.5L12.1975 10.4975L18.6858 17L12.1975 23.5025L14.195 25.5L22.695 17L14.195 8.5Z" fill="black"/>
            </svg>
        </div>

        <div class="md-table">
            <table>
                <thead>
                    <tr>
                        <th>{{ $t('calendar.days.abbr.mo') }}</th>
                        <th>{{ $t('calendar.days.abbr.tu') }}</th>
                        <th>{{ $t('calendar.days.abbr.we') }}</th>
                        <th>{{ $t('calendar.days.abbr.th') }}</th>
                        <th>{{ $t('calendar.days.abbr.fr') }}</th>
                        <th>{{ $t('calendar.days.abbr.sa') }}</th>
                        <th>{{ $t('calendar.days.abbr.su') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(w, d) in table" :key="d">
                        <td v-for="day in w" :key="day.day+'_'+day.month" @click="select(day)"
                            :class="{ 'outside-month': day.external, 'current-day': isCurrentDay(day), selected: isSelectedDay(day) }">
                            {{ day.day }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { add, eachWeekOfInterval, lastDayOfMonth, sub } from 'date-fns'

export default {
    props: [ 'format' ],
    data: function () {
        return {
            table: {}
        }
    },
    created: function () {
        this.generateCalendar()
    },
    methods: {
        isCurrentDay: function (date) {
            return date.day_string === this.$parent.current_day &&
                date.month_string === this.$parent.current_month &&
                date.year == this.$parent.current_year
        },
        isSelectedDay: function (date) {
            return date.day_string === this.$parent.input_day &&
                date.month_string === this.$parent.input_month &&
                date.year == this.$parent.input_year
        },
        getCompatDateMonth: function (month) {
            if (typeof month === 'string') {
                let format_month = (month[0] === '0') ? month[1] : month

                return format_month - 1
            }

            return month - 1
        },
        listMonths: function () {
            this.$parent.displayListMonths()
        },
        listYears: function () {
            this.$parent.displayListYears()
        },
        previous: function () {
            let date = new Date(
                this.$parent.display_year,
                this.getCompatDateMonth(this.$parent.display_month),
                this.$parent.display_day
            )

            let previousMonth = sub(date, { months: 1 })

            this.$parent.display_year = previousMonth.getFullYear()
            this.$parent.display_month = this.$parent.formatElementOneCharacter(previousMonth.getMonth() + 1)
            this.$parent.display_day = previousMonth.getDate()

            this.generateCalendar()
        },
        next: function () {
            let date = new Date(
                this.$parent.display_year,
                this.getCompatDateMonth(this.$parent.display_month),
                this.$parent.display_day
            )

            let nextMonth = add(date, { months: 1 })

            this.$parent.display_year = nextMonth.getFullYear()
            this.$parent.display_month = this.$parent.formatElementOneCharacter(nextMonth.getMonth() + 1)
            this.$parent.display_day = nextMonth.getDate()

            this.generateCalendar()
        },
        select: function (date) {
            if (!date.external) {
                let day = (date.day < 10) ? '0'+date.day : date.day

                let format = this.getFormatDate(date.year, date.month_string, day)

                this.$parent.$emit('update:modelValue', format)
            }
        },
        getFormatDate: function (year, month, day) {
            if (this.format === 'Y-m-d') {
                return year+'-'+month+'-'+day
            }
        },
        generateCalendar: function () {
            let display_year = this.$parent.display_year
            let display_month = this.getCompatDateMonth(this.$parent.display_month)
            let display_day = this.$parent.display_day

            let date = new Date(display_year, display_month, display_day)

            let lastDayMonth = lastDayOfMonth(date).getDate()

            let weeks = eachWeekOfInterval({
                start: new Date(display_year, display_month, 1),
                end: new Date(display_year, display_month, lastDayMonth)
            }, { weekStartsOn: 1 })

            this.table = {}

            for (let w of weeks) {
                let firstDayWeek = w.getDate()
                let firstDayMonth = w.getMonth()

                let dateFirstDayWeek = new Date(w.getFullYear(), firstDayMonth, firstDayWeek)

                var week = []

                for (let i = 0; i < 7; i++) {
                    let dayWeek = add(dateFirstDayWeek, { days: i })
                    let monthDayWeek = dayWeek.getMonth()

                    let day = dayWeek.getDate()

                    week.push({
                        day: day, month: monthDayWeek, year: dayWeek.getFullYear(),
                        day_string: this.$parent.formatElementOneCharacter(day),
                        month_string: this.$parent.formatElementOneCharacter(monthDayWeek + 1),
                        external: monthDayWeek !== display_month
                    })
                }

                this.table[ firstDayWeek+'-'+firstDayMonth ] = week
            }
        }
    }
}
</script>

<style lang="sass" scoped>
.month-days
    .md-header
        align-items: center
        background-color: #efefef
        border-bottom: 1px solid #efefef
        display: flex
        padding-bottom: 6px
        padding-left: 8px
        padding-right: 8px
        padding-top: 6px
        width: 100%

        .mdh-date
            align-items: center
            display: flex
            justify-content: center
            width: calc(100% - 64px)

            .mdhd-month, .mdhd-year
                cursor: pointer
                font-weight: bold

            .mdhd-month
                margin-right: 16px

        .mdh-previous, .mdh-next
            align-items: center
            display: flex
            cursor: pointer

    .md-table
        margin-bottom: 8px
        margin-left: 14px
        margin-right: 14px
        margin-top: 8px

        table
            border-collapse: collapse
            table-layout: fixed
            width: 100%

            thead
                tr
                    th
                        padding: 0.5rem
                        text-align: center
                        user-select: none

            tbody
                tr
                    td
                        padding: 0.5rem
                        text-align: center
                        user-select: none

                        &:not(.outside-month):not(.selected):not(.current-day)
                            cursor: pointer

                            &:hover
                                background-color: #efefef
                                border-radius: 8px

                        &.current-day
                            background-color: #efefef
                            border-radius: 8px

                        &.outside-month
                            opacity: 0.65

                        &.selected
                            background-color: #2196F3
                            border-radius: 8px
                            color: white

                            &:not(.outside-month)
                                cursor: pointer
</style>