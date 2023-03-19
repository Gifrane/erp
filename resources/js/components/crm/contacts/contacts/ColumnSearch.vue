<template>
    <div class="col-3 contacts-search">
        <div class="search-header mb-2">
            <div class="search-header-title">{{ $t('pages.crm_contacts.contacts_research') }}</div>
        </div>

        <button class="btn-without-icon btn-outline-success w-100" @click="openModaleAddFilter()">
            <span class="text-center w-100">{{ $t('pages.crm_contacts.search_add_filter') }}</span>
        </button>

        <div v-for="f in filters" :key="f.iteration">
            {{ f }}
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        filters: function () { return this.$store.getters['crm/contacts/search/get_filters'] }
    },
    methods: {
        openModaleAddFilter: function () {
            EventBus.emit('open_modale_search_add_filter')
        }
    }
}
</script>

<style lang="sass" scoped>
.contacts-search
    border: 1px solid #dee2e6
    min-height: 100px

    .search-header
        align-items: center
        display: flex
        position: relative

        .search-header-title
            font-size: 1.4em
</style>
