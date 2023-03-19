<template>
    <div :id="dropdownId" class="dropdown">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected === null">{{ $t('pages.crm_contacts_details.companies_list') }}</div>
            <div class="header-title" v-else>{{ selected }}</div>

            <div class="header-arrow" :class="{ opened: displayDropdown }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 9L12 15L6 9" stroke="#ACACAC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <template v-if="companies.length > 0">
                <div class="menu-search" v-if="companies.length > 5">
                    <input type="search" v-model="search" class="input w-100" :placeholder="$t('search')" />
                </div>

                <div class="menu-list">
                    <template v-for="c in companies">
                        <div class="menu-list-item" :key="c.id" @click="select(c)" v-if="!search || regexSearch(c.name)">{{ c.name }}</div>
                    </template>
                </div>
            </template>

            <div class="menu-empty" v-else>{{ $t('pages.crm_contacts_details.no_company_found') }}</div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    props: [ 'companies', 'k' ],
    data: function () {
        return {
            dropdownId: 'dropdown-update-contact-company',

            selected: null,
            search: null
        }
    },
    created: function () {
        for (let c of this.companies) {
            if (c.id == this.$parent.contact.companies[ this.k ].id) {
                this.selected = c.name

                break
            }
        }
    },
    methods: {
        select: function (c) {
            this.selected = c.name

            this.$parent.contact.companies[ this.k ].id = c.id

            this.displayDropdown = false
        }
    }
}
</script>
