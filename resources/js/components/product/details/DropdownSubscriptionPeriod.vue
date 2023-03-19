<template>
    <div :id="dropdownId" class="dropdown w-100">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected === null">{{ $t('pages.products_details.subscription_periods_list') }}</div>
            <div class="header-title" v-else>{{ selected }}</div>

            <div class="header-arrow" :class="{ opened: displayDropdown }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 9L12 15L6 9" stroke="#ACACAC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <div class="menu-list">
                <div class="menu-list-item" v-for="p in periods" :key="p.code" @click="select(p)">{{ p.label }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    data: function () {
        return {
            dropdownId: 'dropdown-update-product-subscription-period',

            periods: [],

            selected: null,
            search: null
        }
    },
    computed: {
        period: function () { return this.$parent.product.subscription_period }
    },
    created: function () {
        this.periods = [
            { code: 'hour', label: this.$t('pages.products_details.periods.hourly') },
            { code: 'day', label: this.$t('pages.products_details.periods.daily') },
            { code: 'week', label: this.$t('pages.products_details.periods.weekly') },
            { code: 'month', label: this.$t('pages.products_details.periods.monthly') },
            { code: 'year', label: this.$t('pages.products_details.periods.yearly') }
        ]
    },
    methods: {
        refreshPeriod: function () {
            for (let p of this.periods) {
                if (p.code === this.$parent.product.subscription_period) {
                    this.selected = p.label

                    break
                }
            }
        },
        select: function (p) {
            this.selected = p.label

            this.$parent.product.subscription_period = p.code

            this.displayDropdown = false
        }
    }
}
</script>
