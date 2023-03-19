<template>
    <div class="pane-add-block-wrapper" v-if="visible_pane">
        <div class="pane-add-block" v-click-outside="outside">
            <div class="pane-add-header">
                <div class="header-label">Ajouter un bloc</div>

                <div class="header-close" @click="close()">
                    <icon-close :height="32" :width="32" :pointer="true" />
                </div>
            </div>

            <div class="pane-add-tabs">
                <div class="pane-add-tabs-tab" @click="displayTab('configure')" :class="{ active: visible_tab === 'configure' }">
                    Configurer
                </div>
                <div class="pane-add-tabs-tab" @click="displayTab('import')" :class="{ active: visible_tab === 'import' }">
                    Importer
                </div>
            </div>

            <configure v-if="visible_tab === 'configure'" :config="config" />
            <!--<import v-else-if="visible_tab === 'import'" :config="config" />-->
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import IconClose from '../../icons/IconClose.vue'

import Configure from './add_block/Configure.vue'
import Export from './edit_block/Export.vue'

export default {
    components: { Configure, Export, IconClose },
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            visible_pane: false,

            visible_tab: 'configure',

            config: { name: null, type: 'calculated_datas' },
        }
    },
    methods: {
        displayTab: function (tab) {
            this.visible_tab = tab
        },
        close: function () {
            this.config = { name: null, type: 'calculated_datas' }
            this.visible_pane = false
        },
        outside: function (e) {
            this.visible_pane = this.parentHasClassName(e, 'datas-actions-edit', true)

            if (!this.visible_pane) {
                this.config = { name: null, type: 'calculated_datas' }
            }
        },
    }
}
</script>