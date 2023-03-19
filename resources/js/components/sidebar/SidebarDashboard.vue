<template>
    <div class="sidebar-dashboard-wrapper">
        <div class="sidebar-dashboard">
            <div class="dashboard-add-block">
                <button class="btn btn-outline-primary btn-add-block" @click="openPaneAddBlock()">
                    <icon-add :height="22" :width="22" :middle="true" />
                    <span>Ajouter un bloc</span>
                </button>
            </div>

            <div class="dashboard-list-blocks">
                <block code="crm" name="CRM" />
                <block code="api_requests" name="API Requests" />
                <block code="agenda" name="Agenda" />
                <block code="custom_1" name="Custom 1" :custom="true" />
                <block code="custom_2" name="Custom 2" :custom="true" />
                <block code="custom_3" name="Custom 3" :custom="true" />
                <block code="custom_4" name="Custom 4" :custom="true" />
            </div>
        </div>

        <pane-add-block ref="pane_add_block" />
        <pane-edit-block ref="pane_edit_block" />
    </div>
</template>

<script>
import IconAdd from '../icons/IconAdd.vue'

import Block from './sidebar_dashboard/Block.vue'
import PaneAddBlock from './sidebar_dashboard/PaneAddBlock.vue'
import PaneEditBlock from './sidebar_dashboard/PaneEditBlock.vue'

export default {
    components: { Block, IconAdd, PaneAddBlock, PaneEditBlock },
    methods: {
        openPaneAddBlock: function () {
            this.$refs.pane_add_block.visible_pane = true
        }
    }
}
</script>