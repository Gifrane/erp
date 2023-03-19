<template>
    <div :id="dropdownId" class="dropdown w-100">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected === null">
                {{ $t('pages.crm_companies_details.interval_employee_list') }}
            </div>
            <div class="header-title" v-else>{{ selected }}</div>

            <div class="header-arrow" :class="{ opened: displayDropdown }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 9L12 15L6 9" stroke="#ACACAC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <div class="menu-list">
                <div v-for="i in intervals" class="menu-list-item" :key="i.code" @click="select(i)">{{ i.label }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    data: function () {
        return {
            dropdownId: 'dropdown-update-company-interval-employee',

            intervals: [],

            selected: null
        }
    },
    created: function () {
        this.intervals = [ '1-100', '101-500', '501-2000', '2001-10000', '10001-50000', '50001-' ].map((i) => {
            return { code: i, label: this.$t('pages.crm_companies_details.intervals.'+i) }
        })
    },
    methods: {
        refreshInterval: function (interval) {
            for (let i of this.intervals) {
                if (i.code === interval) {
                    this.selected = i.label

                    break
                }
            }
        },
        select: function (i) {
            this.selected = i.label

            this.$parent.company.interval_employee = i.code

            this.displayDropdown = false
        }
    }
}
</script>
