<template>
    <div class="layout-navbar-wrapper">
        <div class="layout-navbar">
            <div class="navbar-left"></div>

            <div class="navbar-right">
                <applications />
                <notifications />
                <user-menu :avatar="avatar" />
            </div>
        </div>
    </div>
</template>

<script>
import Applications from './navbar/Applications.vue'
import Notifications from './navbar/Notifications.vue'
import UserMenu from './navbar/UserMenu.vue'

export default {
    components: { Applications, Notifications, UserMenu },
    props: [ 'avatar' ],
}
</script>
