<template>
    <div :id="dropdownId" class="dropdown">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected_length === 0">{{ $t('countries_list') }}</div>

            <div class="header-badges" v-else>
                <div class="badge" v-for="(name, id) in selected" :key="id">
                    <div class="badge-wrapper">
                        <div class="badge-label">{{ name }}</div>
                        <div class="badge-delete">
                            <span class="material-icons" @click.stop="deleteSelection(id)">close</span>
                        </div>
                    </div>
                </div>
            </div>

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
                    <div class="menu-list-selectable-item" :key="c.id" v-if="!search || regexSearch(c.name)">
                        <div class="selectable-item-checkbox">
                            <input type="checkbox" v-model="$parent.value" :value="c.id"
                                @change="updateSelection(c.id, c.name)" :id="'add-filter-country-'+c.id" />
                        </div>

                        <label class="selectable-item-label" :for="'add-filter-country-'+c.id">{{ c.name }}</label>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    data: function () {
        return {
            dropdownId: 'dropdown-add-filter-country',

            countries: [],

            selected: {},
            search: null
        }
    },
    computed: {
        selected_length: function () { return Object.keys(this.selected).length }
    },
    created: function () {
        this.countries = this.$store.getters['i18n/get_countries']
    },
    methods: {
        deleteSelection: function (id) {
            delete this.selected[ id ]
            delete this.$parent.valueLabel[ id ]

            this.$parent.value = this.$parent.value.filter((c) => c !== id)
        },
        updateSelection: function (id, name) {
            if (id in this.selected) {
                delete this.selected[ id ]
                delete this.$parent.valueLabel[ id ]
            } else {
                this.selected[ id ] = name
                this.$parent.valueLabel[ id ] = name
            }
        }
    }
}
</script>
