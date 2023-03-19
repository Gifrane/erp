<template>
    <div class="sidebar-wrapper" v-if="$parent.visibleAdd">
        <div class="sidebar" role="complementary" v-click-outside="outside">
            <div class="sidebar-header">
                <div class="sh-title">
                    {{ $t('pages.admin_users.add_user') }}

                    <svg class="ml-2" v-tippy="$t('pages.admin_users.add_user_info_icon')" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 1.625C6.71836 1.625 1.625 6.71836 1.625 13C1.625 19.2816 6.71836 24.375 13 24.375C19.2816 24.375 24.375 19.2816 24.375 13C24.375 6.71836 19.2816 1.625 13 1.625ZM13.8125 18.4844C13.8125 18.5961 13.7211 18.6875 13.6094 18.6875H12.3906C12.2789 18.6875 12.1875 18.5961 12.1875 18.4844V11.5781C12.1875 11.4664 12.2789 11.375 12.3906 11.375H13.6094C13.7211 11.375 13.8125 11.4664 13.8125 11.5781V18.4844ZM13 9.75C12.6811 9.74349 12.3774 9.61223 12.1542 9.38437C11.9309 9.15652 11.8059 8.85024 11.8059 8.53125C11.8059 8.21226 11.9309 7.90598 12.1542 7.67813C12.3774 7.45027 12.6811 7.31901 13 7.3125C13.3189 7.31901 13.6226 7.45027 13.8458 7.67813C14.0691 7.90598 14.1941 8.21226 14.1941 8.53125C14.1941 8.85024 14.0691 9.15652 13.8458 9.38437C13.6226 9.61223 13.3189 9.74349 13 9.75Z" fill="black"/>
                    </svg>
                </div>

                <div class="sh-close" @click="outside">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 9.4L22.6 8L16 14.6L9.4 8L8 9.4L14.6 16L8 22.6L9.4 24L16 17.4L22.6 24L24 22.6L17.4 16L24 9.4Z" fill="black"/>
                    </svg>
                </div>
            </div>

            <div class="sidebar-body">
                <div class="grid mt-3">
                    <div class="col-4">{{ $t('firstname') }}</div>
                    <div class="col-8"><input type="text" v-model="add.firstname" class="input w-100" /></div>
                </div>

                <div class="grid mt-2">
                    <div class="col-4">{{ $t('lastname') }}</div>
                    <div class="col-8"><input type="text" v-model="add.lastname" class="input w-100" /></div>
                </div>

                <div class="grid mt-2">
                    <div class="col-4">{{ $t('email') }}</div>
                    <div class="col-8"><input type="text" v-model="add.email" class="input w-100" /></div>
                </div>

                <button class="btn btn-success" @click="addUser()">
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

export default {
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            add: { firstname: null, lastname: null, email: null }
        }
    },
    methods: {
        addUser: function () {
            axios.post('/admin/users/add', this.add)
                .then((res) => {
                    this.$router.push('/admin/users/'+res.data.data)
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
