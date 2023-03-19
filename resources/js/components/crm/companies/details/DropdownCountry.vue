<template>
    <div :id="dropdownId" class="dropdown w-100">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected === null">{{ $t('countries_list') }}</div>
            <div class="header-title" v-else>{{ selected }}</div>

            <div class="header-arrow" :class="{ opened: displayDropdown }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 9L12 15L6 9" stroke="#ACACAC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <div class="menu-search">
                <input type="search" v-model="search" class="input w-100" :placeholder="$t('search')" />
            </div>

            <div class="menu-list">
                <template v-for="c in countries">
                    <div class="menu-list-item" :key="c.id" v-if="!search || regexSearch(c.name)" @click="select(c)">{{ c.name }}</div>
                </template>
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
            dropdownId: 'dropdown-update-company-country',

            countries: [],

            selected: null,
            search: null
        }
    },
    created: function () {
        this.countries = this.$store.getters['i18n/get_countries']
    },
    methods: {
        refreshCountry: function (country) {
            for (let c of this.countries) {
                if (c.id === country) {
                    this.selected = c.name

                    break
                }
            }
        },
        select: function (c) {
            this.selected = c.name

            this.$parent.company.i18n_country_id = c.id

            this.displayDropdown = false
        }
    }
}
</script>
