<template>
    <div class="list-months">
        <div class="lm-header">
            <div class="lmh-previous" @click="previous()">
                <span class="material-icons">navigate_before</span>
            </div>

            <div class="lmh-date">
                <div class="lmhd-year" @click="accessYears()">{{ $parent.display_year }}</div>
            </div>

            <div class="lmh-next" @click="next()">
                <span class="material-icons">navigate_next</span>
            </div>
        </div>

        <div class="lm-table">
            <table>
                <tbody>
                    <tr v-for="(days, l) in list" :key="l">
                        <td v-for="d in days" :key="d" @click="accessMonth(d)" :class="{ selected: isSelectedMonth(d) }">
                            {{ $t('calendar.months.number.'+d) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import chunk from 'underscore/modules/chunk'

export default {
    props: [ 'year' ],
    data: function () {
        return {
            list: [],

            months: [ '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' ]
        }
    },
    created: function () {
        this.generateList()
    },
    methods: {
        isSelectedMonth: function (month) {
            return month === this.$parent.input_month && this.$parent.display_year == this.$parent.input_year
        },
        accessMonth: function (month) {
            this.$parent.display_month = month

            this.$parent.displayMonthDays()
        },
        accessYears: function () {
            this.$parent.displayListYears()
        },
        next: function () {
            this.$parent.display_year = (parseInt(this.$parent.display_year) + 1).toString()
        },
        previous: function () {
            this.$parent.display_year = (parseInt(this.$parent.display_year) - 1).toString()
        },
        generateList: function () {
            this.list = chunk(this.months, 2)
        }
    }
}
</script>

<style lang="sass" scoped>
.list-months
    .lm-header
        align-items: center
        background-color: #efefef
        border-bottom: 1px solid #efefef
        display: flex
        padding-bottom: 6px
        padding-left: 8px
        padding-right: 8px
        padding-top: 6px
        width: 100%

        .lmh-date
            align-items: center
            display: flex
            justify-content: center
            width: calc(100% - 64px)

            .lmhd-year
                cursor: pointer
                font-weight: bold

        .lmh-previous, .lmh-next
            align-items: center
            display: flex
            width: 32px

            .material-icons
                cursor: pointer
                font-size: 30px

    .lm-table
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
                        cursor: pointer
                        padding: 0.5rem
                        text-align: center
                        user-select: none

                        &:hover
                            background-color: #efefef
                            border-radius: 8px

                        &.selected
                            background-color: #2196F3
                            border-radius: 8px
                            color: white
</style>