<template>
    <div :id="dropdownId" class="dropdown">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected === null">{{ $t('pages.user_settings.2fa_options_list') }}</div>
            <div class="header-title" v-else>{{ selected }}</div>

            <div class="header-arrow" :class="{ opened: displayDropdown }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 9L12 15L6 9" stroke="#ACACAC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: displayDropdown }">
            <div class="menu-list">
                <div class="menu-list-item" v-for="o in options" :key="o.code" @click="select(o)">{{ o.label }}</div>
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
    props: [ 'projects' ],
    data: function () {
        return {
            dropdownId: 'dropdown-update-settings-2fa',

            options: [],

            selected: null
        }
    },
    created: function () {
        this.options = [ 'disabled', 'mail', 'qrcode' ].map((o) => {
            return { code: o, label: this.$t('pages.user_settings.2fa_options.'+o) }
        })
    },
    methods: {
        select: function (o) {
            this.selected = o.label

            this.$parent.doubleAuth = o.code

            this.displayDropdown = false
        }
    }
}
</script>
