<template>
    <div class="sidebar-wrapper" v-if="$parent.visibleAdd">
        <div class="sidebar" role="complementary" v-click-outside="outside">
            <div class="sidebar-header">
                <div class="sh-title">{{ $t('pages.products_details_sales_history.add_sale') }}</div>

                <div class="sh-close" @click="outside">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 9.4L22.6 8L16 14.6L9.4 8L8 9.4L14.6 16L8 22.6L9.4 24L16 17.4L22.6 24L24 22.6L17.4 16L24 9.4Z" fill="black"/>
                    </svg>
                </div>
            </div>

            <div class="sidebar-body">
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('title') }}</div>
                    <div class="col-8"><input type="text" v-model="add.title" class="input w-100" /></div>
                </div>

                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.products_details_sales_history.solded_at') }}</div>
                    <div class="col-8">
                        <Calendar ref="solded_at" v-model="add.solded_at" :monthNavigator="true" :yearNavigator="true" yearRange="2000:2030" class="w-100" />
                    </div>
                </div>

                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.products_details_sales_history.unit_price') }}</div>
                    <div class="col-8"><input type="number" v-model="add.price" class="input w-100" /></div>
                </div>

                <div class="grid mt-2">
                    <div class="col-4">{{ $t('amount') }}</div>
                    <div class="col-8"><input type="number" v-model.number="add.amount" class="input w-100" /></div>
                </div>

                <div class="divider">
                    <div class="divider-content" style="background-color: white">
                        <span class="tag">{{ $t('pages.products_details_sales_history.options') }}</span>
                    </div>
                </div>

                <div class="divider"></div>

                <button class="btn btn-success mt-2" @click="addSale()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3C12 2.73478 11.8946 2.48043 11.7071 2.29289C11.5196 2.10536 11.2652 2 11 2C10.7348 2 10.4804 2.10536 10.2929 2.29289C10.1054 2.48043 10 2.73478 10 3V10H3C2.73478 10 2.48043 10.1054 2.29289 10.2929C2.10536 10.4804 2 10.7348 2 11C2 11.2652 2.10536 11.5196 2.29289 11.7071C2.48043 11.8946 2.73478 12 3 12H10V19C10 19.2652 10.1054 19.5196 10.2929 19.7071C10.4804 19.8946 10.7348 20 11 20C11.2652 20 11.5196 19.8946 11.7071 19.7071C11.8946 19.5196 12 19.2652 12 19V12H19C19.2652 12 19.5196 11.8946 19.7071 11.7071C19.8946 11.5196 20 11.2652 20 11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10H12V3Z" fill="#1791BA"/>
                    </svg>

                    <span>{{ $t('add') }}</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import Calendar from '../../ui/Calendar.vue'

export default {
    components: { Calendar },
    directives: { clickOutside: vClickOutside.directive },
    props: [ 'product' ],
    data: function () {
        return {
            add: { title: null, solded_at: null, price: 0, amount: 0, options: [] }
        }
    },
    methods: {
        addSale: function () {
            this.add.solded_at = this.$refs.solded_at.inputFieldValue

            axios.post('/product/'+this.product+'/add/sale', this.add)
                .then(() => {
                    this.$parent.visibleAdd = false

                    this.add = { title: null, solded_at: null, price: 0, amount: 0, options: [] }

                    this.$parent.getProduct()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        outside: function () {
            this.$parent.visibleAdd = false
        }
    }
}
</script>