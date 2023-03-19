<template>
    <div class="crm-block">
        <div class="crm-block-header">
            <router-link to="/crm">{{ $t('pages.dashboard.crm.crm') }}</router-link>
        </div>

        <div class="crm-block-general-stats">
            <div class="stats-contacts">{{ contacts }} {{ $t('pages.dashboard.crm.contacts') }}</div>
            <div class="stats-groups">{{ groups }} {{ $t('pages.dashboard.crm.groups') }}</div>
            <div class="stats-companies">{{ companies }} {{ $t('pages.dashboard.crm.companies') }}</div>
        </div>

        <div class="crm-block-sales-stats">
            <div class="stats-sales">
                <div class="stats-sales-desc">{{ $t('pages.dashboard.crm.this_month') }} :</div>
                42 {{ $t('pages.dashboard.crm.signed_contracts') }}<br>
                {{ $t('pages.dashboard.crm.total_sales') }} 42 424 242 €
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            contacts: 0,
            groups: 0,
            companies: 0
        }
    },
    created: function () {
        this.getContent()
    },
    methods: {
        getContent: function () {
            axios.post('/dashboard/content/crm')
                .then((res) => {
                    let data = res.data.data

                    this.contacts = data.contacts
                    this.groups = data.groups
                    this.companies = data.companies
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>
