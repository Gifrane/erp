<template>
    <div :id="dropdownId" class="dropdown">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected_length === 0">{{ $t('pages.crm_contacts_details.groups_list') }}</div>
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
            <template v-if="groups.length > 0">
                <div class="menu-search" v-if="groups.length > 5">
                    <input type="search" v-model="search" class="input w-100" :placeholder="$t('search')" />
                </div>

                <div class="menu-list">
                    <template v-for="g in groups">
                        <div class="menu-list-selectable-item" :key="g.id" v-if="!search || regexSearch(g.name)">
                            <div class="selectable-item-checkbox">
                                <input type="checkbox" v-model="$parent.contact.groups" :value="g.id"
                                    @change="updateSelection(g.id, g.name)" :id="'update-group-'+g.id" />
                            </div>

                            <label class="selectable-item-label" :for="'update-group-'+g.id">{{ g.name }}</label>
                        </div>
                    </template>
                </div>
            </template>

            <div class="menu-empty" v-else>{{ $t('pages.crm_contacts_details.no_group_found') }}</div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    props: [ 'groups' ],
    data: function () {
        return {
            dropdownId: 'dropdown-update-contact-groups',

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

            this.$parent.contact.groups = this.$parent.contact.groups.filter((g) => g !== id)
        },
        updateSelection: function (id, name) {
            if (id in this.selected) {
                delete this.selected[ id ]
            } else {
                this.selected[ id ] = name
            }
        },
        refreshGroups: function () {
            this.selected = {}

            for (let g of this.$parent.contact.groups) {
                for (let gr of this.groups) {
                    if (gr.id === g) {
                        this.selected[ gr.id ] = gr.name

                        break
                    }
                }
            }
        }
    }
}
</script>
