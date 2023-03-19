<template>
    <div class="products-details-sales">
        <div class="tabs">
            <router-link :to="'/product/'+product_id">{{ $t('details') }}</router-link>
            <router-link :to="'/product/'+product_id+'/options'">{{ $t('pages.products_details_sales_history.options') }}</router-link>
            <router-link :to="'/product/'+product_id+'/spare_parts'">{{ $t('pages.products_details_sales_history.spare_parts') }}</router-link>
            <router-link :to="'/product/'+product_id+'/sales_history'" class="active">{{ $t('pages.products_details_sales_history.sales_history') }}</router-link>
            <router-link :to="'/product/'+product_id+'/variations'">{{ $t('pages.products_details_sales_history.variations') }}</router-link>
        </div>

        <div class="products-details-sales-body">
            <button class="btn btn-outline-primary mr-2" @click="visibleAdd = true">
                <span class="material-icons">add</span>
                <span>{{ $t('pages.products_details_sales_history.add_sale') }}</span>
            </button>

            <button class="btn btn-outline-secondary">
                <span class="material-icons">playlist_add</span>
                <span>{{ $t('pages.products_details_sales_history.import_sales') }}</span>
            </button>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th class="th-checkbox"><input type="checkbox" class="checkbox" /></th>
                        <th class="th-with-icon">{{ $t('pages.products_details_sales_history.solded_at') }} <order-icon col="solded_at" :order="order" @click="onSort('solded_at')" /></th>
                        <th class="th-with-icon">{{ $t('pages.products_details_sales_history.unit_price') }} <order-icon col="price" :order="order" @click="onSort('price')" /></th>
                        <th class="th-with-icon">{{ $t('amount') }} <order-icon col="amount" :order="order" @click="onSort('amount')" /></th>
                        <th></th>
                        <th style="width: 80px"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="s in product.sales" :key="s.id">
                        <td class="td-checkbox"><input type="checkbox" class="checkbox" :value="s.id" /></td>
                        <td class="td-content">{{ s.solded_at }}</td>
                        <td class="td-content">{{ s.price }}</td>
                        <td class="td-content">{{ s.amount }}</td>
                        <td class="td-content">
                            <!-- {{ $t('linked_order') }} -->
                            <!-- {{ $t('linked_sale') }} -->
                        </td>
                        <td class="td-actions">
                            <span class="material-icons pointer" style="font-size: 1.6rem;">edit</span>
                            <span class="material-icons ml-1 pointer" style="font-size: 1.6rem;" @click="deleteSale(s.id)">delete</span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <pagination :page="pagination.current" :size="pagination.per_page" :total="total" :options="[10,20,50,100]" />
        </div>
    </div>

    <sidebar-add-sale :product="product_id" />
</template>

<script>
import SidebarAddSale from './details_sales_history/SidebarAddSale.vue'

export default {
    components: { SidebarAddSale },
    data: function () {
        return {
            order: { column: 'id', order: 'desc' },
            pagination: { page: 1, per_page: 10 },
            method_search: 'getProduct',
            total: 0,

            visibleAdd: false,

            product: {},
        }
    },
    computed: {
        product_id: function () { return this.$route.params.product }
    },
    created: function () {
        this.getProduct()
    },
    methods: {
        deleteSale: function (sale) {
            axios.post('/product/'+this.product_id+'/delete/sale', { sale: sale })
                .then(() => {
                    this.getProduct()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getProduct: function () {
            axios.post('/product/'+this.product_id+'/details', { relations: [ 'options', 'sales' ] })
                .then((res) => {
                    this.product = res.data.data
                    this.total = this.product.sales.length
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../sass/vuejs/products/products_details_sales_history.sass'
</style>