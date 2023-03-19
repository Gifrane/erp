<template>
    <div class="dashboard">
        <div class="dashboard-title">Dashboard</div>

        <div class="grid">
            <div class="col-4">
                <div class="dashboard-col-wrapper">
                    <crm-block />
                </div>
            </div>

            <div class="col-4">
                <div class="dashboard-col-wrapper">
                    <api-requests-block />
                </div>
            </div>

            <div class="col-4">
                <div class="dashboard-col-wrapper"></div>
            </div>
        </div>

        <sidebar-handle-blocks ref="sidebar_handle_blocks" />
    </div>

    <Teleport to=".layout-sidebar > .sidebar-body">
        <sidebar-dashboard />
    </Teleport>
</template>

<script>
import SidebarDashboard from '../sidebar/SidebarDashboard.vue'

import ApiRequestsBlock from './dashboard/ApiRequestsBlock.vue'
import CrmBlock from './dashboard/CrmBlock.vue'
import SidebarHandleBlocks from './dashboard/SidebarHandleBlocks.vue'

export default {
    components: {
        ApiRequestsBlock, CrmBlock, SidebarDashboard, SidebarHandleBlocks
    },
    methods: {
        openSidebarHandleBlocks: function () {
            this.$refs.sidebar_handle_blocks.visible_add = true
        }
    }
}
</script>

<style lang="sass" scoped>
@import '@sass/vuejs/dashboard/dashboard.sass'
</style>