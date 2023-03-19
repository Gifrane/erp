<template>
    <div class="pane-edit-block-wrapper" v-if="visible_pane">
        <div class="pane-edit-block" v-click-outside="outside">
            <div class="pane-edit-header">
                <div class="header-label">{{ config.name }}</div>

                <div class="header-close" @click="close()">
                    <icon-close :height="32" :width="32" :pointer="true" />
                </div>
            </div>

            <div class="pane-edit-tabs">
                <div class="pane-edit-tabs-tab" @click="displayTab('configure')" :class="{ active: visible_tab === 'configure' }">
                    Configurer
                </div>
                <div class="pane-edit-tabs-tab" @click="displayTab('export')" :class="{ active: visible_tab === 'export' }">
                    Exporter
                </div>
            </div>

            <configure v-if="visible_tab === 'configure'" :config="config" />
            <export v-else-if="visible_tab === 'export'" :config="config" />
        </div>

        <pane-send-tchat ref="pane_send_tchat" />
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import IconClose from '../../icons/IconClose.vue'

import Configure from './edit_block/Configure.vue'
import Export from './edit_block/Export.vue'
import PaneSendTchat from './edit_block/PaneSendTchat.vue'

export default {
    components: { Configure, Export, IconClose, PaneSendTchat },
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            visible_pane: false,

            visible_tab: 'configure',

            config: { name: null },
        }
    },
    created: function () {
        EventBus.on('display_pane_edit_block', (data) => {
            this.config = data.config

            this.visible_pane = true
        })
    },
    methods: {
        displayTab: function (tab) {
            this.visible_tab = tab
        },
        close: function () {
            this.config = { name: null }
            this.visible_pane = false
        },
        outside: function (e) {
            var visible = this.parentHasClassName(e, 'datas-actions-edit', true)

            if (!visible) {
                this.visible_pane = this.parentHasClassName(e, 'pane-send-tchat', true)
            }

            if (!this.visible_pane) {
                this.config = { name: null }
            }
        },
    }
}
</script>