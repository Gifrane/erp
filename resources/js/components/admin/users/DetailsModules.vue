<template>
    <div class="user-details-modules">
        <div class="tabs">
            <router-link :to="'/admin/users/'+user_id">{{ $t('details') }}</router-link>
            <router-link :to="'/admin/users/'+user_id+'/permissions'">{{ $t('pages.admin_users_details_modules.permissions') }}</router-link>
            <router-link :to="'/admin/users/'+user_id+'/modules'" class="active">{{ $t('pages.admin_users_details_modules.modules') }}</router-link>
        </div>

        <div class="details-modules-body">
            <h3>{{ user.firstname }} {{ user.lastname }}</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th class="th-checkbox"><input type="checkbox" class="checkbox" v-model="all_selected" @click="selectAll()" /></th>
                        <th>{{ $t('pages.admin_users_details_modules.module') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="m in modules" :key="m.id">
                        <td class="td-checkbox"><input type="checkbox" class="checkbox" v-model="user_modules" :value="m.id" @change="updateSelectAll()" /></td>
                        <td class="td-content">{{ m.name }}</td>
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-outline-primary" @click="save()">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.5833 13V20.5833H5.41667V13H3.25V20.5833C3.25 21.775 4.225 22.75 5.41667 22.75H20.5833C21.775 22.75 22.75 21.775 22.75 20.5833V13H20.5833ZM14.0833 13.7258L16.8892 10.9308L18.4167 12.4583L13 17.875L7.58333 12.4583L9.11083 10.9308L11.9167 13.7258V3.25H14.0833V13.7258Z" fill="black"/>
                </svg>

                <span>{{ $t('save') }}</span>
            </button>
        </div>
    </div>
</template>

<script>
import { markRaw } from 'vue'

export default {
    data: function () {
        return {
            user: { firstname: null, lastname: null },
            user_modules: [],

            account_modules: [],

            modules: [],

            all_selected: false,
        }
    },
    computed: {
        user_id: function () { return this.$route.params.user }
    },
    created: function () {
        this.getData()
    },
    methods: {
        updateSelectAll: function () {
            this.all_selected = (this.user_modules.length === this.account_modules.length)
        },
        selectAll: function () {
            if (this.user_modules.length === this.account_modules.length) {
                this.user_modules = []
                this.all_selected = false
            } else {
                this.user_modules = this.account_modules
                this.all_selected = true
            }
        },
        save: function () {
            axios.post('/admin/users/'+this.user_id+'/edit/modules', { modules: this.user_modules })
                .then(() => {})
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getData: function () {
            axios.post('/admin/users/'+this.user_id+'/details/modules')
                .then((res) => {
                    let data = res.data.data

                    this.user = data.user
                    this.user_modules = data.user_modules
                    this.account_modules = markRaw(data.account_modules)
                    this.modules = markRaw(data.list_modules)

                    this.updateSelectAll()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../../sass/vuejs/admin/users/details_modules.sass'
</style>