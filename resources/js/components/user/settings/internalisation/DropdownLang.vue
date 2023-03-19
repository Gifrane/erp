<template>
    <div :id="dropdownId" class="dropdown">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected === null">{{ $t('langs') }}</div>
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
                <template v-for="l in langs">
                    <div class="menu-list-item" :key="l.code" v-if="!search || regexSearch(l.name)" @click="select(l)">
                        {{ l.name }}
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
            dropdownId: 'dropdown-update-user-settings-lang',

            langs: [],

            selected: null,
            search: null
        }
    },
    created: function () {
        this.langs = this.$store.getters['i18n/get_langs'].map((l) => {
            l.name = this.$t('langs_list.'+l.code)

            return l
        })
    },
    methods: {
        refreshLang: function () {
            for (let l of this.langs) {
                if (l.code === this.$parent.lang) {
                    this.selected = l.name

                    break
                }
            }
        },
        select: function (l) {
            this.selected = l.name

            this.$parent.lang = l.code

            this.displayDropdown = false
        }
    }
}
</script>
