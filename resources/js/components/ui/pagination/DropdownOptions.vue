<template>
    <div :id="dropdownId" class="dropdown w-100">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title">{{ selected }}</div>

            <div class="header-arrow" :class="{ opened: displayDropdown }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 9L12 15L6 9" stroke="#ACACAC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <div class="menu-list">
                <div class="menu-list-item" v-for="o in options" :key="o" @click="select(o)">{{ o }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownMixin from '../../../mixins/dropdown'

export default {
    directives: { clickOutside: vClickOutside.directive },
    mixins: [ DropdownMixin ],
    props: [ 'options' ],
    data: function () {
        return {
            dropdownId: 'dropdown-pagination-options',

            selected: null
        }
    },
    created: function () {
        this.selected = this.options[0]
    },
    methods: {
        select: function (o) {
            this.selected = o

            this.$parent.$parent.changePageSize(o)

            this.displayDropdown = false
        }
    }
}
</script>
