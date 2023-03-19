<template>
    <breadcrumb :steps="breadcrumb" />

    <div class="products-details">
        <div class="tabs">
            <router-link :to="'/product/'+product_id" class="active">{{ $t('details') }}</router-link>
            <router-link :to="'/product/'+product_id+'/options'">{{ $t('pages.products_details.options') }}</router-link>
            <router-link :to="'/product/'+product_id+'/spare_parts'">{{ $t('pages.products_details.spare_parts') }}</router-link>
            <router-link :to="'/product/'+product_id+'/sales_history'">{{ $t('pages.products_details.sales_history') }}</router-link>
            <router-link :to="'/product/'+product_id+'/variations'">{{ $t('pages.products_details.variations') }}</router-link>
        </div>

        <div class="products-details-body">
            <div class="grid">
                <div class="col-4">{{ $t('name') }}</div>
                <div class="col-8"><input type="text" v-model="product.name" class="input w-100" /></div>
            </div>
            <div class="grid mt-2">
                <div class="col-4">{{ $t('pages.products_details.product_family') }}</div>
                <div class="col-8"><input type="text" v-model="product.family" class="input w-100" /></div>
            </div>
            <div class="grid mt-2">
                <div class="col-4">{{ $t('pages.products_details.price_before_tax') }}</div>
                <div class="col-8"><input type="number" v-model.number="product.price_before_tax" class="input w-100" /></div>
            </div>
            <div class="grid mt-2">
                <div class="col-4">{{ $t('pages.products_details.price_with_tax') }}</div>
                <div class="col-8"><input type="number" v-model.number="product.price_with_tax" class="input w-100" /></div>
            </div>
            <div class="grid mb-2">
                <div class="col-4">TVA</div>
                <div class="col-8">
                    <div class="input-group">
                        <input type="number" v-model="product.tva" class="input w-100" />
                        <div class="input-annotation-right">%</div>
                    </div>
                </div>
            </div>
            <div class="grid mb-2">
                <div class="col-4">{{ $t('pages.products_details.subscription_period') }}</div>
                <div class="col-8"><dropdown-subscription-period ref="dropdown_subscription_period" /></div>
            </div>
            <div class="grid mb-2">
                <div class="col-4">{{ $t('pages.products_details.start_date_sale') }}</div>
                <div class="col-8">
                    <Calendar class="w-100" v-model="product.started_at" position="top" />
                </div>
            </div>
            <div class="grid mb-2">
                <div class="col-4">{{ $t('pages.products_details.stop_sale_date') }}</div>
                <div class="col-8">
                    <Calendar class="w-100" v-model="product.stopped_at" position="top" />
                </div>
            </div>

            <button class="btn btn-outline-primary mr-2" @click="editProduct()">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.5833 13V20.5833H5.41667V13H3.25V20.5833C3.25 21.775 4.225 22.75 5.41667 22.75H20.5833C21.775 22.75 22.75 21.775 22.75 20.5833V13H20.5833ZM14.0833 13.7258L16.8892 10.9308L18.4167 12.4583L13 17.875L7.58333 12.4583L9.11083 10.9308L11.9167 13.7258V3.25H14.0833V13.7258Z" fill="black"/>
                </svg>

                <span>{{ $t('save') }}</span>
            </button>

            <button class="btn btn-outline-danger" @click="deleteProduct()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                </svg>

                <span>{{ $t('delete') }}</span>
            </button>
        </div>
    </div>
</template>

<script>
import Calendar from '../ui/Calendar.vue'

import DropdownSubscriptionPeriod from './details/DropdownSubscriptionPeriod.vue'

export default {
    components: { Calendar, DropdownSubscriptionPeriod },
    data: function () {
        return {
            product: { started_at: null, stopped_at: null },

            breadcrumb: [],
        }
    },
    computed: {
        product_id: function () { return this.$route.params.product }
    },
    created: function () {
        this.getProduct()
    },
    methods: {
        deleteProduct: function () {
            EventBus.emit('global_confirm_dialog', {
                message: 'Are you sure you want to proceed ?',
                header: 'Confirmation',
                icon_type: 'material-icons-outlined',
                icon: 'notification_important',
                acceptLabel: 'Yes',
                rejectLabel: 'No',
                accept: () => {
                    axios.post('/product/'+this.product_id+'/delete')
                        .then(() => {
                            this.$toast.success(this.$t('pages.products_details.product_destroy_success'))

                            this.$router.push('/product')
                        })
                        .catch((e) => {
                            this.$toast.error(this.$t('pages.products_details.product_destroy_error'))

                            this.checkAjaxException(e)
                        })
                },
                reject: () => {}
            })
        },
        editProduct: function () {
            axios.post('/product/'+this.product_id+'/edit', this.product)
                .then(() => {
                    this.$toast.success('Product edition succeeded')
                })
                .catch((e) => {
                    this.$toast.error('Error during product edition')

                    this.checkAjaxException(e)
                })
        },
        getProduct: function () {
            axios.post('/product/'+this.product_id+'/details')
                .then((res) => {
                    this.product = res.data.data

                    this.breadcrumb = [
                        { label: this.$t('pages.products_details.products'), to: '/product' },
                        { label: this.product.name }
                    ]

                    this.product.price_before_tax = parseFloat(this.product.price_before_tax)
                    this.product.price_with_tax = parseFloat(this.product.price_with_tax)
                    this.product.tva = parseFloat(this.product.tva)

                    this.$refs.dropdown_subscription_period.refreshPeriod()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../sass/vuejs/products/details.sass'
</style>
