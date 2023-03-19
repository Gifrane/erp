<template>
    <div :id="dropdownId" class="dropdown w-100">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected === null"></div>
            <div class="header-title" v-else>{{ selected }}</div>

            <div class="header-arrow" :class="{ opened: displayDropdown }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 9L12 15L6 9" stroke="#ACACAC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <div class="menu-list">
                <div v-for="o in operators" class="menu-list-item" :key="o.code" @click="select(o)">{{ o.label }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    data: function () {
        return {
            dropdownId: 'dropdown-add-filter-operator',

            operators: [],

            selected: null
        }
    },
    methods: {
        updateFilter: function (filter) {
            if (filter === 'country') {
                this.operators = [
                    { code: 'is_in', label: this.$t('pages.crm_contacts.search_operators.is_located_in') },
                    { code: 'is_not_in', label: this.$t('pages.crm_contacts.search_operators.is_not_located_in') }
                ]
            }
        },
        select: function (o) {
            this.selected = o.label

            this.$parent.operator = o.code

            this.displayDropdown = false
        }
    }
}
</script>
