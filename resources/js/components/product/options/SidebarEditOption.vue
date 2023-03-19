<template>
    <div class="sidebar-wrapper" v-if="$parent.visibleEdit">
        <div class="sidebar" role="complementary" v-click-outside="outside">
            <div class="sidebar-header">
                <div class="sh-title">{{ $t('pages.products_details_options.edit_option') }}</div>
                <div class="sh-close"><span class="material-icons">close</span></div>
            </div>

            <div class="sidebar-body">
                <div class="grid mt-3">
                    <div class="col-4">{{ $t('name') }}</div>
                    <div class="col-8"><input type="text" v-model="edit.name" class="input w-100" /></div>
                </div>

                <div class="grid mt-3">
                    <div class="col-4">{{ $t('pages.products_details_options.price') }}</div>
                    <div class="col-8"><input type="number" v-model="edit.price" class="input w-100" /></div>
                </div>

                <button class="btn btn-success" @click="editOption()">
                    <span class="material-icons">save_alt</span>
                    <span>{{ $t('save') }}</span>
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
            edit: { id: null, name: null, price: null }
        }
    },
    created: function () {
        EventBus.on('open_sidebar_edit_option', (option) => this.edit = option)
    },
    methods: {
        editOption: function () {
            axios.post('/product/'+this.product+'/edit/option', this.edit)
                .then(() => {
                    this.outside()

                    this.$parent.getProduct()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        outside: function () {
            this.edit.id = null
            this.edit.name = null
            this.edit.price = null

            this.$parent.visibleEdit = false
        }
    }
}
</script>