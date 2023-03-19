<template>
    <div :id="dropdownId" class="dropdown">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="Object.keys(selected).length === 0">
                {{ $t('pages.admin_api_keys.modules') }}
            </div>

            <div class="header-badges" v-else>
                <div class="badge" v-for="(name, code) in selected" :key="code">
                    <div class="badge-wrapper">
                        <div class="badge-label">{{ name }}</div>
                        <div class="badge-delete">
                            <span class="material-icons" @click.stop="deleteSelection(code)">close</span>
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
            <div class="menu-search" v-if="modules.length > 4">
                <input type="search" v-model="search" class="input w-100" :placeholder="$t('search')" />
            </div>

            <div class="menu-list">
                <template v-for="m in modules">
                    <div class="menu-list-selectable-item" :key="m.code" v-if="!search || regexSearch(m.name)">
                        <div class="selectable-item-checkbox">
                            <input type="checkbox" v-model="$parent.edit.modules" :value="m.code"
                                @change="updateSelection(m.code, m.name)" :id="'update-module-'+m.code" />
                        </div>

                        <label class="selectable-item-label" :for="'update-module-'+m.code">{{ m.name }}</label>
                    </div>
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
            dropdownId: 'dropdown-update-keys-modules',

            modules: [],

            selected: {},
            search: null
        }
    },
    created: function () {
        this.modules = []
        this.modules.push({ code: 'crm', name: 'CRM' })
        this.modules.push({ code: 'mailer', name: 'Mailer' })
        this.modules.push({ code: 'products', name: this.$t('pages.admin_api_keys.modules_list.products') })
        this.modules.push({ code: 'sales', name: this.$t('pages.admin_api_keys.modules_list.sales') })
    },
    methods: {
        deleteSelection: function (code) {
            delete this.selected[ code ]

            this.$parent.edit.modules = this.$parent.edit.modules.filter((g) => g !== code)
        },
        updateSelection: function (code, name) {
            if (code in this.selected) {
                delete this.selected[ code ]
            } else {
                this.selected[ code ] = name
            }
        },
        refreshModules: function (modules) {
            this.selected = {}

            for (let m of modules) {
                for (let mo of this.modules) {
                    if (mo.code === m) {
                        this.selected[ mo.code ] = mo.name

                        break
                    }
                }
            }
        }
    }
}
</script>
