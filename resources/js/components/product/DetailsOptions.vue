<template>
    <breadcrumb :steps="breadcrumb" />

    <div class="grid mt-4 ml-2 mr-2">
        <div class="col-12">
            <tabs :tabs="tabs" />

            <div class="tab-content p-4">
                <button class="mr-2 btn btn-outline-primary mb-2" @click="visibleAdd = true">
                    <span class="material-icons">add</span>
                    <span>{{ $t('pages.products_details_options.add_option') }}</span>
                </button>

                <table class="table table-bordered mt-2">
                    <thead class="thead-th-azure">
                        <tr>
                            <th>{{ $t('name') }} <order-icon col="name" :order="order" @click="onSort('name')" /></th>
                            <th>{{ $t('pages.products_details_options.price') }} <order-icon col="price" :order="order" @click="onSort('price')" /></th>
                            <th style="width: 80px"></th>
                        </tr>
                    </thead>

                    <tbody class="tbody-td-white">
                        <tr v-for="o in options" :key="o.id">
                            <td class="td-cols-content">{{ o.name }}</td>
                            <td class="td-cols-content">{{ o.price }}</td>
                            <td class="td-actions">
                                <span class="material-icons pointer" style="font-size: 1.6rem;" @click="editOption(o)">edit</span>
                                <span class="material-icons ml-1 pointer" style="font-size: 1.6rem;" @click="deleteOption(o.id)">delete</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <sidebar-add-option :product="productId" />
    <sidebar-edit-option :product="productId" />
</template>

<script>
import SidebarAddOption from './options/SidebarAddOption.vue'
import SidebarEditOption from './options/SidebarEditOption.vue'

export default {
    components: { SidebarAddOption, SidebarEditOption },
    data: function () {
        return {
            order: { column: 'name', order: 'asc' },
            pagination: { current: 1, per_page: 10 },

            visibleAdd: false,
            visibleEdit: false,

            options: [],

            breadcrumb: [],
            tabs: []
        }
    },
    computed: {
        productId: function () { return this.$route.params.product }
    },
    created: function () {
        this.breadcrumb = [
            { label: this.$t('pages.products_details_options.products'), to: '/product' }
        ]

        this.tabs = [
            { label: this.$t('details'), to: '/product/'+this.productId },
            { label: this.$t('pages.products_details_options.options'), to: '/product/'+this.productId+'/options', active: true },
            { label: this.$t('pages.products_details_options.spare_parts'), to: '/product/'+this.productId+'/spare_parts' },
            { label: this.$t('pages.products_details_options.sales_history'), to: '/product/'+this.productId+'/sales_history' },
            { label: this.$t('pages.products_details_options.variations'), to: '/product/'+this.productId+'/variations' }
        ]

        this.getProduct()
    },
    methods: {
        deleteOption: function (option) {
            axios.post('/product/'+this.productId+'/delete/option', { id: option })
                .then(() => {
                    this.getProduct()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        editOption: function (option) {
            if (option.price !== null) {
                option.price = parseFloat(option.price)
            }

            EventBus.emit('open_sidebar_edit_option', option)

            this.visibleEdit = true
        },
        getProduct: function () {
            axios.post('/product/'+this.productId+'/details', { relations: [ 'options' ] })
                .then((res) => {
                    let product = res.data.data

                    this.options = product.options

                    this.breadcrumb = [
                        { label: this.$t('pages.products_details_options.products'), to: '/product' },
                        { label: product.name, to: '/product/'+this.productId },
                        { label: this.$t('pages.products_details_options.options'), to: '/product/'+this.productId+'/options', active: true }
                    ]
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>
