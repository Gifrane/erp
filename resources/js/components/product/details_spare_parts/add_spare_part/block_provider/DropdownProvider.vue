<template>
    <div :id="dropdownId" class="dropdown w-100">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title" v-if="selected !== null">{{ selected }}</div>

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
                <template v-for="p in providers">
                    <div class="menu-list-item" :key="p.id" v-if="!search || regexSearch(p.name)" @click="select(p)">{{ p.name }}</div>
                </template>
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
    props: [ 'providers' ],
    data: function () {
        return {
            dropdownId: 'dropdown-add-spare-part-provider',

            selected: null,
            search: null,
        }
    },
    methods: {
        select: function (p) {
            this.selected = p.name

            this.$parent.$parent.add.provider.id = p.id

            this.displayDropdown = false
        }
    }
}
</script>
