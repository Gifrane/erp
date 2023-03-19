<template>
    <div class="tab">
        <div class="tab-part-two-fa">
            <div class="two-fa-title">{{ $t('pages.user_settings.2fa_configuration') }}</div>

            <div class="two-fa-select-wrapper">
                <dropdown-double-auth />
            </div>
        </div>

        <div class="tab-part-password">
            <div class="password-title">{{ $t('pages.user_settings.password') }}</div>

            <div class="password-actions">
                <button class="btn btn-outline-secondary" @click="sendEmailResetPassword()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 18H4V8L12 13L20 8V18ZM12 11L4 6H20L12 11Z" fill="black"/>
                    </svg>

                    <span>{{ $t('pages.user_settings.email_reset_password') }}</span>
                </button>
            </div>
        </div>

        <div class="tab-part-sessions">
            <div class="sessions-title">{{ $t('pages.user_settings.sessions') }}</div>

            <div class="sessions-delete-all">
                <button class="btn btn-outline-danger">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="#E84A67"/>
                    </svg>

                    <span>{{ $t('pages.user_settings.delete_all_sessions') }}</span>
                </button>
            </div>

            <div class="sessions-management">
                <div class="management-item current">
                    <div class="item-description">Your session</div>
                    <div class="item-delete">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                        </svg>
                    </div>
                </div>
                <div class="management-item">
                    <div class="item-description">
                        <div class="item-description-wrapper">
                            <div class="description-id">ID : 123456789</div>
                            <div class="description-last-activity">Dernière connexion : Il y a deux jours</div>
                        </div>
                    </div>
                    <div class="item-delete">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DropdownDoubleAuth from './security/DropdownDoubleAuth.vue'

export default {
    components: { DropdownDoubleAuth },
    methods: {
        sendEmailResetPassword: function () {
            axios.post('/user/settings/send_email_reset_password')
                .then(() => {})
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>

<style lang="sass" scoped>
.tab-part-password
    margin-bottom: 28px

    .password-actions
        align-items: center
        display: flex

    .password-title
        font-size: 28px
        font-weight: 500
        margin-bottom: 20px

.tab-part-sessions
    .sessions-delete-all
        margin-bottom: 20px

    .sessions-management
        .management-item
            background-color: rgba(128, 143, 242, 0.6)
            display: flex
            height: 70px
            width: 450px

            &.current
                background-color: #697CFF

                .item-delete
                    &:hover
                        background-color: #697CFF

                        svg
                            path
                                fill: white

                .item-description
                    color: white

            .item-delete
                align-items: center
                background-color: #E5E5E5
                cursor: pointer
                display: flex
                justify-content: center
                width: 70px

                &:hover
                    background-color: rgba(128, 143, 242, 0.6)

            .item-description
                align-items: center
                display: flex
                padding-left: 16px
                width: 380px

    .sessions-title
        font-size: 28px
        font-weight: 500
        margin-bottom: 20px

.tab-part-two-fa
    margin-bottom: 28px

    .two-fa-select-wrapper
        align-items: center
        display: flex

        .dropdown
            width: 60%

    .two-fa-title
        font-size: 28px
        font-weight: 500
        margin-bottom: 20px
</style>