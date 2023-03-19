<template>
    <div class="sidebar-wrapper" v-if="$parent.visibleEdit">
        <div class="sidebar" role="complementary" v-click-outside="outside">
            <div class="sidebar-header">
                <div class="sh-title">{{ $t('pages.admin_api_keys.edit_keys') }}</div>

                <div class="sh-close" @click="outside">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 9.4L22.6 8L16 14.6L9.4 8L8 9.4L14.6 16L8 22.6L9.4 24L16 17.4L22.6 24L24 22.6L17.4 16L24 9.4Z" fill="black"/>
                    </svg>
                </div>
            </div>

            <div class="sidebar-body">
                <div class="grid mt-3">
                    <div class="col-4">{{ $t('name') }}</div>
                    <div class="col-8"><input type="text" v-model="edit.name" class="input w-100" /></div>
                </div>

                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.admin_api_keys.modules') }}</div>
                    <div class="col-8"><multi-select-modules ref="multiselect_modules" /></div>
                </div>

                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.admin_api_keys.expiration_date') }}</div>
                    <div class="col-8"><Calendar class="w-100" v-model="edit.expired_at" /></div>
                </div>

                <button class="btn btn-success" @click="editKey()">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.5833 13V20.5833H5.41667V13H3.25V20.5833C3.25 21.775 4.225 22.75 5.41667 22.75H20.5833C21.775 22.75 22.75 21.775 22.75 20.5833V13H20.5833ZM14.0833 13.7258L16.8892 10.9308L18.4167 12.4583L13 17.875L7.58333 12.4583L9.11083 10.9308L11.9167 13.7258V3.25H14.0833V13.7258Z" fill="black"/>
                    </svg>

                    <span>{{ $t('save') }}</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import Calendar from '../../ui/Calendar.vue'

import MultiSelectModules from './edit_keys/MultiSelectModules.vue'

export default {
    components: { Calendar, MultiSelectModules },
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            edit: {
                id: null, name: null, modules: [], expired_at: null
            }
        }
    },
    methods: {
        loadEdit: function (keys) {
            this.edit = keys
        },
        editKey: function () {
            axios.post('/admin/api_keys/'+this.edit.id+'/edit', this.edit)
                .then(() => {
                    this.edit = { name: null, modules: [], expired_at: null }

                    this.$parent.visibleEdit = false
                    this.$parent.getKeys()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        outside: function () {
            this.$parent.visibleEdit = false
        }
    }
}
</script>
