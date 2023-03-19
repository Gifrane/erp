<template>
    <div class="contact-details-datas">
        <div class="tabs">
            <router-link :to="'/crm/contacts/'+contact_id">{{ $t('details') }}</router-link>
            <router-link :to="'/crm/contacts/'+contact_id+'/datas'" class="active">{{ $t('pages.crm_contacts_details_datas.datas') }}</router-link>
            <router-link :to="'/crm/contacts/'+contact_id+'/reviews'">{{ $t('pages.crm_contacts_details_datas.reviews') }}</router-link>
            <router-link :to="'/crm/contacts/'+contact_id+'/mailer'">{{ $t('pages.crm_contacts_details_datas.mailer') }}</router-link>
            <router-link :to="'/crm/contacts/'+contact_id+'/tickets'">{{ $t('pages.crm_contacts_details_datas.tickets') }}</router-link>
            <router-link :to="'/crm/contacts/'+contact_id+'/notes'">{{ $t('pages.crm_contacts_details_datas.notes') }}</router-link>
            <router-link :to="'/crm/contacts/'+contact_id+'/booking'">{{ $t('pages.crm_contacts_details_datas.booking') }}</router-link>
            <router-link :to="'/crm/contacts/'+contact_id+'/orders'">{{ $t('pages.crm_contacts_details_datas.orders') }}</router-link>
            <router-link :to="'/crm/contacts/'+contact_id+'/contacts'">{{ $t('pages.crm_contacts_details_datas.contacts') }}</router-link>
        </div>

        <div class="details-datas-body">
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        contact_id: function () { return this.$route.params.contact }
    },
}
</script>

<style lang="sass" scoped>
@import '../../../../sass/vuejs/crm/contacts/details_datas.sass'
</style>
