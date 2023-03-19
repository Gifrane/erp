<template>
    <div class="layout">
        <confirm-dialog />

        <div class="layout-wrapper">
            <sidebar-menu />

            <div class="layout-body">
                <navbar :avatar="avatar" />

                <div class="layout-body-page">
                    <router-view />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from './layout/Navbar.vue'
import SidebarMenu from './layout/SidebarMenu.vue'

import ConfirmDialog from './ui/ConfirmDialog.vue'

export default {
    components: { ConfirmDialog, Navbar, SidebarMenu },
    props: [
        'agendas', 'avatar', 'countries', 'langs', 'timezones', 'translations', 'user',
        'hr_collective_agreements', 'hr_contract_types', 'user_modules',
    ],
    created: function () {
        let lang = this.user.lang

        this.$i18n.messages[ lang ] = this.translations
        this.$i18n.locale = lang

        this.$store.commit('user/load_modules', this.user_modules)
        this.$store.commit('user/load_user', this.user)

        this.$store.commit('i18n/load_current_timezone', this.user.timezone)

        this.$store.commit('i18n/load_countries', this.countries)
        this.$store.commit('i18n/load_langs', this.langs)
        this.$store.commit('i18n/load_timezones', this.timezones)

        // Employee
        this.$store.commit('employee/load_collective_agreements', this.hr_collective_agreements)
        this.$store.commit('employee/load_contract_types', this.hr_contract_types)

        // Agendas
        this.$store.commit('agenda_week/set_agendas', this.agendas)
        this.$store.commit('agenda_week/set_periods', this.setAgendaPeriods())
    },
    methods: {
        setAgendaPeriods: function () {
            var periods = []

            for (let i = 0; i < 24; i++) {
                periods.push({ hour_col: i, hour: (i < 10) ? '0'+i : i, slot_id: i + 1 })
            }

            return periods
        }
    }
}
</script>
