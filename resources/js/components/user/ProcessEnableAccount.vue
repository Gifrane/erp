<template>
    <div class="layout">
        <div class="layout-wrapper">
            <loading :active="loading">
                <div class="grid mt-4 ml-2 mr-2">
                    <div class="col-12">
                        <div class="tab-content p-4">
                            <h4>{{ $t('user_process_enable_account.activation_account') }}</h4>

                            <div class="grid mt-2">
                                <div class="col-4">{{ $t('firstname') }}</div>
                                <div class="col-8"><input type="text" name="firstname" class="input w-100" v-model="firstname" /></div>
                            </div>
                            <div class="grid mt-2">
                                <div class="col-4">{{ $t('lastname') }}</div>
                                <div class="col-8"><input type="text" name="lastname" class="input w-100" v-model="lastname" /></div>
                            </div>
                            <div class="grid mt-2">
                                <div class="col-4">{{ $t('email') }}</div>
                                <div class="col-8"><input type="email" name="email" class="input w-100" v-model="email" /></div>
                            </div>

                            <div class="divider">
                                <div class="divider-content">
                                    <span class="tag">{{ $t('user_process_enable_account.password') }}</span>
                                </div>
                            </div>

                            <div class="grid mt-2">
                                <div class="col-4">{{ $t('user_process_enable_account.password') }}</div>
                                <div class="col-8"><input type="password" name="password" class="input w-100" v-model="password" /></div>
                            </div>

                            <div class="mt-2">
                                <button class="btn-without-icon btn-outline-primary mt-2" role="submit">
                                    <span>{{ $t('user_process_enable_account.activate_account') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </loading>
        </div>
    </div>
</template>

<script>
import Loading from '../Loading.vue'

export default {
    components: { Loading },
    props: [ 'account', 'translations', 'user' ],
    data: function () {
        return {
            loading: false,

            firstname: null,
            lastname: null,
            email: null,
            password: null
        }
    },
    created: function () {
        this.$i18n.messages[ this.user.lang ] = this.translations
        this.$i18n.locale = this.user.lang

        this.firstname = this.user.firstname
        this.lastname = this.user.lastname
        this.email = this.user.email
    }
}
</script>

<style lang="sass" scoped>
.layout
    height: calc(100% - 64px)
    position: relative

    &-wrapper
        background-color: #f8f9fa
        height: 100%
        overflow-y: auto
        width: 100%
</style>
