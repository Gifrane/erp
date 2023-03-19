<template>
    <div class="doc-container">
        <div class="dc-sidebar">
            <div class="dcs-title">Gifrane API</div>

            <div class="dcs-links">
                <first-links />
                <admin-links />
                <crm-links />
                <product-links />
                <accounting-links />
                <file-links />
                <webhook-links />
            </div>
        </div>

        <div class="dc-content">
        </div>
    </div>
</template>

<script>
import AccountingLinks from './docs/AccountingLinks.vue'
import AdminLinks from './docs/AdminLinks.vue'
import CrmLinks from './docs/CrmLinks.vue'
import FileLinks from './docs/FileLinks.vue'
import FirstLinks from './docs/FirstLinks.vue'
import ProductLinks from './docs/ProductLinks.vue'
import WebhookLinks from './docs/WebhookLinks.vue'

export default {
    components: {
        AccountingLinks, AdminLinks, CrmLinks, FileLinks, FirstLinks, ProductLinks, WebhookLinks
    },
    computed: {
        chapter: function () { return this.$route.params.chapter }
    }
}
</script>

<style lang="sass" scoped>
.doc-container
    display: flex
    flex-direction: row
    height: calc(100vh - 60px)
    width: 100%

    .dc-sidebar
        border-right: 1px solid gray
        height: 100%
        overflow-y: auto
        width: 270px

        .dcs-title
            font-size: 0.9rem
            padding-left: 10px
            padding-top: 10px

        .dcs-links
            margin-top: 10px

    .dc-content
        width: calc(100% - 270px)
</style>