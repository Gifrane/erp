<template>
    <div class="export-tab">
        <textarea class="input w-100" rows="7">{{ json_config }}</textarea>

        <div class="tab-actions">
            <button class="btn btn-primary">
                <icon-block-export :height="22" :width="22" />
                <span>Copier</span>
            </button>

            <button class="btn btn-secondary" @click="sendToTchat()">
                <span>Envoyer sur le tchat</span>
            </button>
        </div>
    </div>
</template>

<script>
import IconBlockExport from '../../../icons/IconBlockExport.vue'

export default {
    components: { IconBlockExport },
    props: [ 'config' ],
    computed: {
        json_config: function () {
            delete this.config.code

            return JSON.stringify(this.config)
        },
    },
    methods: {
        sendToTchat: function () {
            EventBus.emit('display_pane_block_send_tchat', { config: this.json_config })
        }
    }
}
</script>