<template>
    <div class="user-details">
        <div class="tabs">
            <router-link :to="'/admin/users/'+user_id" class="active">{{ $t('details') }}</router-link>
            <router-link :to="'/admin/users/'+user_id+'/permissions'">{{ $t('pages.admin_users_details.permissions') }}</router-link>
            <router-link :to="'/admin/users/'+user_id+'/modules'">{{ $t('pages.admin_users_details.modules') }}</router-link>
        </div>

        <div class="details-body">
            <actions />

            <div class="details-body-details">
                <h3>{{ user.firstname }} {{ user.lastname }}</h3>

                <div class="grid mt-3">
                    <div class="col-4">{{ $t('email') }}</div>
                    <div class="col-8"><input type="text" v-model="user.email" class="input w-100" /></div>
                </div>

                <div class="grid">
                    <div class="col-4">{{ $t('firstname') }}</div>
                    <div class="col-8"><input type="text" v-model="user.firstname" class="input w-100" /></div>
                </div>

                <div class="grid">
                    <div class="col-4">{{ $t('lastname') }}</div>
                    <div class="col-8"><input type="text" v-model="user.lastname" class="input w-100" /></div>
                </div>

                <div class="grid">
                    <div class="col-4">{{ $t('pages.admin_users_details.role') }}</div>
                    <div class="col-8"><input type="text" v-model="user.role" class="input w-100" /></div>
                </div>

                <div class="divider">
                    <div class="divider-content">
                        <span class="tag">{{ $t('pages.admin_users_details.password') }}</span>
                    </div>
                </div>

                <div class="block-password">
                    <button class="btn-without-icon btn-outline-primary mr-2">
                        {{ $t('pages.admin_users_details.send_password_reset_email') }}
                    </button>

                    <button class="btn-without-icon btn-outline-secondary">
                        {{ $t('pages.admin_users_details.generate_new_password') }}
                    </button>
                </div>

                <div class="divider">
                    <div class="divider-content">
                        <span class="tag">{{ $t('pages.admin_users_details.account_management') }}</span>
                    </div>
                </div>

                <div class="block-account-management">
                    <button class="btn-without-icon btn-outline-primary mr-2" @click="resendAccountEnableMail()">
                        {{ $t('pages.admin_users_details.resend_account_enable_email') }}
                    </button>

                    <button class="btn-without-icon btn-outline-secondary">
                        {{ $t('pages.admin_users_details.block_account') }}
                    </button>
                </div>

                <div class="divider">
                    <div class="divider-content">
                        <span class="tag">{{ $t('pages.admin_users_details.human_resources') }}</span>
                    </div>
                </div>

                <div class="block-human-resources">
                    <button class="btn-without-icon btn-outline-primary">
                        {{ $t('pages.admin_users_details.link_to_employee') }}
                    </button>
                </div>

                <div class="divider"></div>

                <button class="btn btn-outline-primary" @click="save()">
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
import Actions from './details/Actions.vue'

export default {
    components: { Actions },
    data: function () {
        return {
            user: {}
        }
    },
    computed: {
        user_id: function () { return this.$route.params.user }
    },
    created: function () {
        this.getUser()
    },
    methods: {
        resendAccountEnableMail: function () {
            axios.post('/admin/users/'+this.user_id+'/resend_enable_mail')
                .then(() => {})
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        save: function () {
            axios.post('/admin/users/'+this.user_id+'/edit', this.user)
                .then(() => {})
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getUser: function () {
            axios.post('/admin/users/'+this.user_id+'/details')
                .then((res) => {
                    this.user = res.data.data
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../../sass/vuejs/admin/users/details.sass'
</style>