<template>
    <div :id="dropdownId" class="dropdown">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected_length === 0">{{ $t('pages.crm_contacts.companies_list') }}</div>
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
            <template v-if="companies.length > 0">
                <div class="menu-search" v-if="companies.length > 4">
                    <input type="search" v-model="search" class="input w-100" :placeholder="$t('search')" />
                </div>

                <div class="menu-list">
                    <template v-for="c in companies">
                        <div class="menu-list-selectable-item" :key="c.id" v-if="!search || regexSearch(c.name)">
                            <div class="selectable-item-checkbox">
                                <input type="checkbox" v-model="$parent.add.companies" :value="c.id"
                                    @change="updateSelection(c.id, c.name)" :id="'add-company-'+c.id" />
                            </div>

                            <label class="selectable-item-label" :for="'add-company-'+c.id">{{ c.name }}</label>
                        </div>
                    </template>
                </div>
            </template>

            <div class="menu-empty" v-else>{{ $t('pages.crm_contacts.no_company_found') }}</div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    props: [ 'companies' ],
    data: function () {
        return {
            dropdownId: 'dropdown-add-contact-companies',

            selected: {},
            search: null
        }
    },
    computed: {
        selected_length: function () { return Object.keys(this.selected).length }
    },
    methods: {
        deleteSelection: function (id) {
            delete this.selected[ id ]

            this.$parent.add.companies = this.$parent.add.companies.filter((c) => c !== id)
        },
        updateSelection: function (id, name) {
            if (id in this.selected) {
                delete this.selected[ id ]
            } else {
                this.selected[ id ] = name
            }
        }
    }
}
</script>
