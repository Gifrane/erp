<template>
    <div class="notifications-wrapper" v-click-outside="outside">
        <div class="notifications-icon" @click="actionDisplayMenu()">
            <icon-bell :height="32" :width="32" :middle="true" :pointer="true" />
        </div>

        <div class="notifications-menu" v-if="display_menu">
            <div class="notifications-menu-wrapper">
                <div class="menu-header">{{ $t('layout.navbar.notifications.notifications') }} (3)</div>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import IconBell from '../../icons/IconBell.vue'

export default {
    components: { IconBell },
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            display_menu: false,
        }
    },
    methods: {
        outside: function () {
            this.display_menu = false
        },
        actionDisplayMenu: function () {
            this.display_menu = !this.display_menu
        }
    }
}
</script>
