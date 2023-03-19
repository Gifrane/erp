<template>
    <div class="sidebar-wrapper" v-if="$parent.visibleAdd">
        <div class="sidebar" role="complementary" v-click-outside="outside">
            <div class="sidebar-header">
                <div class="sh-title">{{ $t('pages.products_details_options.add_option') }}</div>
                <div class="sh-close"><span class="material-icons">close</span></div>
            </div>

            <div class="sidebar-body">
                <div class="grid mt-3">
                    <div class="col-4">{{ $t('name') }}</div>
                    <div class="col-8"><input type="text" v-model="add.name" class="input w-100" /></div>
                </div>

                <div class="grid mt-3">
                    <div class="col-4">{{ $t('pages.products_details_options.price') }}</div>
                    <div class="col-8"><input type="number" v-model="add.price" class="input w-100" /></div>
                </div>

                <button class="btn btn-success" @click="addOption()">
                    <span class="material-icons">add</span>
                    <span>{{ $t('add') }}</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

export default {
    directives: { clickOutside: vClickOutside.directive },
    props: [ 'product' ],
    data: function () {
        return {
            add: { name: null, price: null }
        }
    },
    methods: {
        addOption: function () {
            axios.post('/product/'+this.product+'/add/option', this.add)
                .then(() => {
                    this.outside()

                    this.$parent.getProduct()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        outside: function () {
            this.add.name = null
            this.add.price = null

            this.$parent.visibleAdd = false
        }
    }
}
</script>