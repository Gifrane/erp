<template>
    <breadcrumb :steps="breadcrumb" />

    <div class="products-details-spare-parts">
        <div class="tabs">
            <router-link :to="'/product/'+product_id">{{ $t('details') }}</router-link>
            <router-link :to="'/product/'+product_id+'/options'">{{ $t('pages.products_details_spare_parts.options') }}</router-link>
            <router-link :to="'/product/'+product_id+'/spare_parts'" class="active">{{ $t('pages.products_details_spare_parts.spare_parts') }}</router-link>
            <router-link :to="'/product/'+product_id+'/sales_history'">{{ $t('pages.products_details_spare_parts.sales_history') }}</router-link>
            <router-link :to="'/product/'+product_id+'/variations'">{{ $t('pages.products_details_spare_parts.variations') }}</router-link>
        </div>

        <div class="products-details-spare-parts-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ $t('name') }}</th>
                        <th>{{ $t('pages.products_details_spare_parts.provider') }}</th>
                        <th>{{ $t('pages.products_details_spare_parts.manufacturer') }}</th>
                        <th>{{ $t('pages.products_details_spare_parts.amount') }}</th>
                        <th>{{ $t('pages.products_details_spare_parts.unit_cost') }}</th>
                        <th style="width: 50px"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(sp, k) in spare_parts" :key="sp.id">
                        <td class="td-content">{{ sp.name }}</td>

                        <template v-if="sp.supplier_manufacturer_id === sp.supplier_provider_id">
                            <td colspan="2" class="td-content">{{ sp.manufacturer?.name }}</td>
                        </template>
                        <template v-else>
                            <td class="td-content">{{ sp.provider?.name }}</td>
                            <td class="td-content">{{ sp.manufacturer?.name }}</td>
                        </template>

                        <td class="td-content">{{ sp.amount }}</td>
                        <td class="td-content">{{ sp.price }}</td>

                        <td class="td-actions">
                            <span class="material-icons pointer" style="font-size: 1.6rem;" @click="deleteSparePart(sp.id)">delete</span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-outline-secondary mt-2 mr-2" @click="addSparePart()">
                <span class="material-icons">add</span>
                <span>{{ $t('pages.products_details_spare_parts.add_spare_part') }}</span>
            </button>

            <button class="btn btn-outline-primary mt-2" @click="editSpareParts()">
                <span class="material-icons">save_alt</span>
                <span>{{ $t('save') }}</span>
            </button>
        </div>

        <sidebar-add-spare-part :product_id="product_id" />
    </div>
</template>

<script>
import SidebarAddSparePart from './details_spare_parts/SidebarAddSparePart.vue'

export default {
    components: { SidebarAddSparePart },
    data: function () {
        return {
            spare_parts: [],

            breadcrumb: [],

            providers: [],
            manufacturers: [],

            visible_add: false,
        }
    },
    computed: {
        product_id: function () { return this.$route.params.product }
    },
    created: function () {
        this.getData()
        this.getProduct()
    },
    methods: {
        addSparePart: function () {
            this.visible_add = true
        },
        deleteSparePart: function (id) {
            this.spare_parts = this.spare_parts.filter((part) => part.id !== id)
        },
        getData: function () {
            axios.post('/data/product_spare_part_details')
                .then((res) => {
                    let data = res.data.data

                    this.manufacturers = data.manufacturers
                    this.providers = data.providers
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getProduct: function () {
            axios.post('/product/'+this.product_id+'/spare_parts/details')
                .then((res) => {
                    let product = res.data.data

                    this.spare_parts = product.spare_parts

                    this.breadcrumb = [
                        { label: this.$t('pages.products_details_spare_parts.products'), to: '/product' },
                        { label: product.name, to: '/product/'+this.product_id },
                        { label: this.$t('pages.products_details_spare_parts.spare_parts'), to: '/product/'+this.product_id+'/spare_parts', active: true }
                    ]
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../sass/vuejs/products/details_spare_parts.sass'
</style>

