<template>
    <div class="applications" v-click-outside="outside">
        <icon-app :height="32" :width="32" :middle="true" :pointer="true" @click="actionDisplayMenu()" />

        <div class="applications-menu-wrapper" v-if="display_menu">
            <div class="applications-menu">
                <table>
                    <tbody>
                        <tr v-for="(row, k) in rows" :key="k">
                            <td v-for="a in row" :key="a.id">
                                <router-link :to="a.url" @click="actionDisplayMenu()">
                                    <div class="menu-td-app">
                                        <img src="/images/default_picture.jpg" style="width: 60px; height: 60px;" />

                                        <div class="app-label">{{ a.label }}</div>
                                    </div>
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'
import chunk from 'underscore/modules/chunk'

import IconApp from '../../icons/IconApp.vue'

export default {
    components: { IconApp },
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            display_menu: false,

            rows: [],
        }
    },
    computed: {
        apps_per_row: function () {
            // Must be calculated according to the screen size
            return 5
        },

        user_modules: function () { return this.$store.getters['user/get_modules'] },
    },
    created: function () {
        this.defineRows()
    },
    methods: {
        outside: function () {
            this.display_menu = false
        },
        actionDisplayMenu: function () {
            this.display_menu = !this.display_menu
        },
        defineRows: function () {
            this.rows = []

            let modules = this.user_modules.map((um) => {
                um.label = this.$t('modules.'+um.code)

                return um
            }).sort(function (a, b) {
                if (a.label < b.label) {
                    return -1
                }

                if (a.label > b.label) {
                    return 1
                }

                return 0
            })

            this.rows = chunk(modules, this.apps_per_row)
        }
    }
}
</script>