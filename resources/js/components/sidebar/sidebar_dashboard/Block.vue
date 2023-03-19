<template>
    <div class="blocks-block">
        <div class="block-drag-icon">
            <icon-drag :height="32" :width="32" :pointer="true" />
        </div>

        <div class="block-datas">
            <div class="datas-label">{{ name }}</div>
            <div class="datas-actions">
                <div class="switch-wrapper" v-tippy="'Activer ce bloc'">
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>

                <icon-edit-block v-if="custom" class="datas-actions-edit" @click="displayPaneEdit()" :height="22" :width="22" :middle="true" :pointer="true" />
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import IconBlockExport from '../../icons/IconBlockExport.vue'
import IconDelete from '../../icons/IconDelete.vue'
import IconDrag from '../../icons/IconDrag.vue'
import IconEditBlock from '../../icons/IconEditBlock.vue'

export default {
    components: { IconBlockExport, IconDelete, IconDrag, IconEditBlock },
    directives: { clickOutside: vClickOutside.directive },
    props: [ 'code', 'custom', 'name' ],
    data: function () {
        return {
            configuration: {}
        }
    },
    created: function () {
        if (this.code === 'custom_1') {
            this.configuration = {
                code: this.code,
                name: this.name,
                type: 'calculed_datas'
            }
        } else if (this.code === 'custom_2') {
            this.configuration = {
                code: this.code,
                name: this.name,
                type: 'bars'
            }
        } else if (this.code === 'custom_3') {
            this.configuration = {
                code: this.code,
                name: this.name,
                type: 'doughnut'
            }
        } else if (this.code === 'custom_4') {
            this.configuration = {
                code: this.code,
                name: this.name,
                type: 'lines'
            }
        }
    },
    methods: {
        displayPaneEdit: function () {
            EventBus.emit('display_pane_edit_block', { config: this.configuration })
        },
        outside: function () {
            this.display_menu = false
        }
    }
}
</script>