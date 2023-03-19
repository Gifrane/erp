<template>
    <div class="list-years">
        <div class="ly-header">
            <div class="lyh-previous" @click="previous()">
                <span class="material-icons">navigate_before</span>
            </div>

            <div class="lyh-date">
                <div class="lmhd-year">{{ $parent.display_year }}</div>
            </div>

            <div class="lyh-next" @click="next()">
                <span class="material-icons">navigate_next</span>
            </div>
        </div>

        <div class="ly-table">
            <table>
                <tbody>
                    <tr v-for="(years, l) in list" :key="l">
                        <td v-for="y in years" :key="y" @click="accessMonths(y)" :class="{ selected: y === $parent.input_year }">
                            {{ y }}
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
    data: function () {
        return {
            list: []
        }
    },
    created: function () {
        this.generateList()
    },
    methods: {
        accessMonths: function (year) {
            this.$parent.display_year = year

            this.$parent.displayListMonths()
        },
        next: function () {
            this.$parent.display_year = (parseInt(this.$parent.display_year) + 10).toString()

            this.generateList()
        },
        previous: function () {
            this.$parent.display_year = (parseInt(this.$parent.display_year) - 10).toString()

            this.generateList()
        },
        generateList: function () {
            let year = this.$parent.display_year.toString()
            let lastDigit = parseInt(year.charAt(year.length - 1))
            let min = this.$parent.display_year - lastDigit

            var years = []

            for (let i = 0; i < 10; i++) {
                years.push((min + i).toString())
            }

            this.list = chunk(years, 2)
        }
    }
}
</script>

<style lang="sass" scoped>
.list-years
    .ly-header
        align-items: center
        background-color: #efefef
        border-bottom: 1px solid #efefef
        display: flex
        padding-bottom: 6px
        padding-left: 8px
        padding-right: 8px
        padding-top: 6px
        width: 100%

        .lyh-date
            align-items: center
            display: flex
            justify-content: center
            width: calc(100% - 64px)

            .lyhd-year
                cursor: pointer
                font-weight: bold

        .lyh-previous, .lyh-next
            align-items: center
            display: flex
            width: 32px

            .material-icons
                cursor: pointer
                font-size: 30px

    .ly-table
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