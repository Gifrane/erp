<template>
    <div class="calendar">
        <div class="input-group">
            <input type="text" class="input w-100" :value="inputDate" @input="$emit('update:modelValue', $event.target.value)"
                placeholder="Y-m-d" />

            <button class="btn-without-text btn-primary" @click.stop="display()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 4H18V2H16V4H8V2H6V4H5C3.89 4 3.01 4.9 3.01 6L3 20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C20.1 22 21 21.1 21 20V6C21 4.9 20.1 4 19 4ZM19 20H5V10H19V20ZM9 14H7V12H9V14ZM13 14H11V12H13V14ZM17 14H15V12H17V14ZM9 18H7V16H9V18ZM13 18H11V16H13V18ZM17 18H15V16H17V18Z" fill="black"/>
                </svg>
            </button>
        </div>

        <div class="calendar-window" v-click-outside="outside" :class="{ show: visible, top: calendarPosition === 'top', bottom: calendarPosition === 'bottom' }">
            <month-days v-if="view === 'month-days'" ref="month_days" :format="dateFormat" />
            <list-months v-else-if="view === 'list-months'" ref="list_months" />
            <list-years v-else-if="view === 'list-years'" ref="list_years" />
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import { getDate, getMonth, getYear, startOfToday } from 'date-fns'

import ListMonths from './calendar/ListMonths.vue'
import ListYears from './calendar/ListYears.vue'
import MonthDays from './calendar/MonthDays.vue'

export default {
    components: { ListMonths, ListYears, MonthDays },
    directives: { clickOutside: vClickOutside.directive },
    props: [ 'modelValue', 'position', 'format' ],
    data: function () {
        return {
            visible: false,

            inputDate: null,

            calendarPosition: null,
            dateFormat: null,

            current_year: null,
            current_month: null,
            current_day: null,

            display_year: null,
            display_month: null,
            display_day: null,

            input_year: null,
            input_month: null,
            input_day: null,

            view: 'month-days',
        }
    },
    created: function () {
        this.calendarPosition = this.position ?? 'bottom'
        this.dateFormat = this.format ?? 'Y-m-d'

        this.processModelValue(this.modelValue)
    },
    watch: {
        modelValue: function (newVal) {
            this.processModelValue(newVal)
        }
    },
    methods: {
        processModelValue: function (value) {
            this.current_year = getYear(startOfToday())
            this.current_month = this.formatElementOneCharacter(getMonth(startOfToday()) + 1)
            this.current_day = this.formatElementOneCharacter(getDate(startOfToday()))

            if (value !== null && value.length > 0) {
                let date = value.split('-')

                this.input_year = date[0]
                this.input_month = date[1]
                this.input_day = date[2]

                this.display_year = date[0]
                this.display_month = date[1]
                this.display_day = date[2]
            } else {
                this.display_year = this.current_year
                this.display_month = this.current_month
                this.display_day = this.current_day
            }

            this.inputDate = value
        },
        formatElementOneCharacter: function (element) {
            if (element > 9) {
                return element
            }

            return '0'+element
        },
        displayMonthDays: function () {
            this.view = 'month-days'
        },
        displayListMonths: function () {
            this.view = 'list-months'
        },
        displayListYears: function () {
            this.view = 'list-years'
        },
        outside: function () {
            this.visible = false

            this.view = 'month-days'
        },
        display: function () {
            if (!this.visible) {
                this.visible = true
            } else {
                this.visible = false
            }
        }
    }
}
</script>
