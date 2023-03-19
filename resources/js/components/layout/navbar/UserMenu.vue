<template>
    <div class="user-menu-wrapper" v-click-outside="outside">
        <img :src="avatar" @click="actionDisplayMenu()" />

        <div class="user-menu" v-if="display_menu">
            <div class="user-menu-link">
                <router-link to="/" @click="actionDisplayMenu()">My dashboard</router-link>
            </div>
            <div class="user-menu-link">
                <router-link to="/" @click="actionDisplayMenu()">View my profile</router-link>
            </div>
            <div class="user-menu-link">
                <router-link to="/user/settings" @click="actionDisplayMenu()">Edit my settings</router-link>
            </div>
            <div class="user-menu-link">
                <a href="/logout">{{ $t('layout.sidebar.logout') }}</a>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

export default {
    directives: { clickOutside: vClickOutside.directive },
    props: [ 'avatar' ],
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