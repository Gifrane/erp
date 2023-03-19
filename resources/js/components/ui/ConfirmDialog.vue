<template>
    <div class="confirm-wrapper" v-if="visible">
        <div class="confirm">
            <div class="confirm-header">
                <div class="ch-text">{{ headerText }}</div>
                <div class="ch-close"><span class="material-icons" @click="outside()">close</span></div>
            </div>

            <div class="confirm-content" v-if="contentIcon || contentMessage">
                <div class="cc-icon" v-if="contentIcon">
                    <span :class="contentIconType">{{ contentIcon }}</span>
                </div>

                <div class="cc-message" v-if="contentMessage">{{ contentMessage }}</div>
            </div>

            <div class="confirm-footer">
                <button class="btn-without-icon btn-secondary mr-2" @click="reject()">{{ footerRejectLabel }}</button>
                <button class="btn-without-icon btn-primary" @click="accept()">{{ footerAcceptLabel }}</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            headerText: null,

            contentIcon: null,
            contentIconType: null,
            contentMessage: null,

            footerAcceptLabel: null,
            footerRejectLabel: null,

            callbackAccept: null,
            callbackReject: null,

            visible: false,
        }
    },
    created: function () {
        EventBus.on('global_confirm_dialog', (params) => {
            this.headerText = params.header ?? null

            this.contentIcon = params.icon ?? null
            this.contentIconType = params.icon_type ?? 'material-icons'
            this.contentMessage = params.message ?? null

            this.footerAcceptLabel = params.acceptLabel ?? 'Yes'
            this.footerRejectLabel = params.rejectLabel ?? 'No'

            this.callbackAccept = params.accept
            this.callbackReject = params.reject

            this.visible = true
        })
    },
    methods: {
        outside: function () {
            this.visible = false

            this.headerText = null

            this.contentIcon = null
            this.contentIconType = null
            this.contentMessage = null

            this.footerAcceptLabel = null
            this.footerRejectLabel = null

            this.callbackAccept = null
            this.callbackReject = null
        },
        accept: function () {
            this.callbackAccept()
            this.outside()
        },
        reject: function () {
            this.callbackReject()
            this.outside()
        }
    }
}
</script>