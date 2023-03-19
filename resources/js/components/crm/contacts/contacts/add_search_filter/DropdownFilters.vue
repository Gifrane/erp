<template>
    <div :id="dropdownId" class="dropdown w-100">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected === null">{{ $t('pages.crm_contacts.search_filters_list') }}</div>
            <div class="header-title" v-else>{{ selected }}</div>

            <div class="header-arrow" :class="{ opened: displayDropdown }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 9L12 15L6 9" stroke="#ACACAC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <div class="menu-list">
                <div v-for="f in filters" class="menu-list-item" :key="f.code" @click="select(f)">{{ f.label }}</div>
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
            dropdownId: 'dropdown-add-filter-list',

            filters: [],

            selected: null
        }
    },
    created: function () {
        this.filters = [ 'country' ].map((c) => {
            return { code: c, label: this.$t('pages.crm_contacts.search_filters.'+c) }
        })
    },
    methods: {
        select: function (f) {
            this.selected = f.label

            this.$parent.selectNewFilter(f.code)

            this.displayDropdown = false
        }
    }
}
</script>
