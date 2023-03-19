<template>
    <div class="tab">
        <div class="tab-part-agenda">
            <div class="agenda-title">{{ $t('agenda') }}</div>

            <div class="agenda-inline" style="margin-bottom: 20px">
                <div class="agenda-inline-label">{{ $t('pages.user_settings.time_send_day_recap') }} :</div>
                
                <div class="agenda-inline-selector">
                    <!-- A remplacer par un Time Selector -->
                    <input type="text" placeholder="00:00 PM" />
                </div>
            </div>

            <div class="agenda-inline">
                <div class="agenda-inline-label">{{ $t('pages.user_settings.day_send_week_recap') }} :</div>

                <dropdown-day-send-recap />
            </div>
        </div>

        <div class="tab-part-notifications">
            <div class="notifications-title">{{ $t('notifications') }}</div>

            <div class="notifications-inline">
                <div class="notifications-inline-label">{{ $t('pages.user_settings.enable_email_notifications') }}</div>

                <div class="notifications-inline-switch">
                    <div class="switch-wrapper">
                        <label class="switch">
                            <input type="checkbox" v-model="$parent.enable_mail_notification" @change="changeEnableMailNotification()">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DropdownDaySendRecap from './notifications/DropdownDaySendRecap.vue'

export default {
    components: { DropdownDaySendRecap },
    methods: {
        changeEnableMailNotification: function () {
            axios.post('/user/settings/update/enable_mail_notification', {
                enable_mail_notification: this.$parent.enable_mail_notification
            }).then(() => {
            }).catch((e) => {
                this.checkAjaxException(e)
            })
        },
    }
}
</script>
