<template>
    <div class="pane-send-tchat" v-if="visible_pane" v-click-outside="outside">
        <div class="pane-send-tchat-header">
            <div class="header-label">Conversations</div>

            <div class="header-close" @click="close()">
                <icon-close :height="32" :width="32" :pointer="true" />
            </div>
        </div>

        <div class="pane-send-tchat-list">
            <div class="tchat-list-item" @click="selectConversation('conversation_1')" :class="{ active: selected === 'conversation_1' }">
                <div class="item-checked" v-if="selected === 'conversation_1'">
                    <icon-block-tchat-selected :height="26" :width="26" />
                </div>

                <img src="/images/default_picture.jpg" />

                <div class="item-datas">
                    <div class="datas-label">Conversation 1</div>
                    <div class="datas-last-message">Dernier message : Il y a un mois</div>
                </div>
            </div>
            <div class="tchat-list-item" @click="selectConversation('conversation_2')" :class="{ active: selected === 'conversation_2' }">
                <div class="item-checked" v-if="selected === 'conversation_2'">
                    <icon-block-tchat-selected :height="26" :width="26" />
                </div>

                <img src="/images/default_picture.jpg" />

                <div class="item-datas">
                    <div class="datas-label">Conversation 2</div>
                    <div class="datas-last-message">Dernier message : Il y a un mois</div>
                </div>
            </div>
            <div class="tchat-list-item" @click="selectConversation('conversation_3')" :class="{ active: selected === 'conversation_3' }">
                <div class="item-checked" v-if="selected === 'conversation_3'">
                    <icon-block-tchat-selected :height="26" :width="26" />
                </div>

                <img src="/images/default_picture.jpg" />

                <div class="item-datas">
                    <div class="datas-label">Conversation 3</div>
                    <div class="datas-last-message">Dernier message : Il y a un mois</div>
                </div>
            </div>
        </div>

        <button class="btn btn-success" @click="send()">
            <icon-send :height="22" :width="22" :middle="true" />
            Envoyer
        </button>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import IconBlockTchatSelected from '../../../icons/IconBlockTchatSelected.vue'
import IconClose from '../../../icons/IconClose.vue'
import IconSend from '../../../icons/IconSend.vue'

export default {
    components: { IconBlockTchatSelected, IconClose, IconSend },
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            visible_pane: false,

            config: null,

            // A transformer en array pour sélection multiple
            selected: null,
        }
    },
    created: function () {
        EventBus.on('display_pane_block_send_tchat', (data) => {
            this.config = data.config
            this.visible_pane = true
        })
    },
    methods: {
        send: function () {
            EventBus.emit('global_confirm_dialog', {
                message: 'Are you sure you want to proceed ?',
                header: 'Confirmation',
                icon_type: 'material-icons-outlined',
                icon: 'notification_important',
                acceptLabel: 'Yes',
                rejectLabel: 'No',
                accept: () => {
                    this.$toast.success('La configuration a été exportée.')

                    this.visible_pane = false
                },
                reject: () => {}
            })
        },
        selectConversation: function (conversation) {
            this.selected = conversation
        },
        outside: function (e) {
            this.visible_pane = this.parentHasClassName(e, 'pane-send-tchat', true)

            if (!this.visible_pane) {
                this.config = null
            }
        },
        close: function () {
            this.config = null
            this.visible_pane = false
        }
    }
}
</script>