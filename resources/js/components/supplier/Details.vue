<template>
    <breadcrumb :steps="breadcrumb" />

    <div class="supplier-details">
        <div class="supplier-details-body">
            <div class="grid mb-2">
                <div class="col-4">{{ $t('name') }}</div>
                <div class="col-8"><input type="text" v-model="supplier.name" class="input w-100" /></div>
            </div>
            <div class="grid mb-2">
                <div class="col-4">{{ $t('pages.suppliers_details.is_manufacturer') }}</div>
                <div class="col-8"><input type="checkbox" v-model="supplier.is_manufacturer" class="checkbox" /></div>
            </div>
            <div class="grid mb-2">
                <div class="col-4">{{ $t('pages.suppliers_details.is_provider') }}</div>
                <div class="col-8"><input type="checkbox" v-model="supplier.is_provider" class="checkbox" /></div>
            </div>

            <button class="btn btn-outline-primary mt-2" @click="editSupplier()">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.5833 13V20.5833H5.41667V13H3.25V20.5833C3.25 21.775 4.225 22.75 5.41667 22.75H20.5833C21.775 22.75 22.75 21.775 22.75 20.5833V13H20.5833ZM14.0833 13.7258L16.8892 10.9308L18.4167 12.4583L13 17.875L7.58333 12.4583L9.11083 10.9308L11.9167 13.7258V3.25H14.0833V13.7258Z" fill="black"/>
                </svg>

                <span>{{ $t('save') }}</span>
            </button>

            <button class="btn btn-outline-danger ml-2" @click="deleteSupplier()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                </svg>

                <span>{{ $t('delete') }}</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            supplier: {},

            breadcrumb: [],
        }
    },
    computed: {
        supplier_id: function () { return this.$route.params.supplier }
    },
    created: function () {
        this.getSupplier()
    },
    methods: {
        deleteSupplier: function () {
            EventBus.emit('global_confirm_dialog', {
                message: 'Are you sure you want to proceed ?',
                header: 'Confirmation',
                icon_type: 'material-icons-outlined',
                icon: 'notification_important',
                acceptLabel: 'Yes',
                rejectLabel: 'No',
                accept: () => {
                    axios.post('/supplier/'+this.supplier_id+'/destroy')
                        .then(() => {
                            this.$toast.success(this.$t('pages.supplier_details.supplier_destroy_success'))

                            this.$router.push('/supplier')
                        })
                        .catch((e) => {
                            this.$toast.error(this.$t('pages.supplier_details.supplier_destroy_error'))

                            this.checkAjaxException(e)
                        })
                },
                reject: () => {}
            })
        },
        getSupplier: function () {
            axios.post('/supplier/'+this.supplier_id+'/details')
                .then((res) => {
                    this.supplier = res.data.data

                    this.breadcrumb = [
                        { label: this.$t('pages.suppliers_details.suppliers'), to: '/supplier' },
                        { label: this.supplier.name },
                    ]
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        editSupplier: function () {
            axios.post('/supplier/'+this.supplier_id+'/edit', this.supplier)
                .then(() => {})
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../sass/vuejs/supplier/details.sass'
</style>
