<template>
    <div class="group-details">
        <div class="tabs">
            <router-link :to="'/crm/groups/'+groupId" class="active">{{ $t('details') }}</router-link>
            <router-link :to="'/crm/groups/'+groupId+'/contacts'">{{ $t('pages.crm_groups_details.contacts') }}</router-link>
        </div>

        <div class="details-body">
            <actions />

            <div class="details-body-details">
                <div class="grid">
                    <div class="col-4">{{ $t('name') }}</div>
                    <div class="col-8"><input type="text" v-model="group.name" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('description') }}</div>
                    <div class="col-8"><input type="text" v-model="group.description" class="input w-100" /></div>
                </div>

                <button class="btn btn-outline-primary mt-2" @click="edit()">
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
            group: {}
        }
    },
    computed: {
        groupId: function () { return this.$route.params.group }
    },
    created: function () {
        this.getDetails()
    },
    methods: {
        deleteGroup: function () {
            EventBus.emit('global_confirm_dialog', {
                message: 'Are you sure you want to proceed ?',
                header: 'Confirmation',
                icon_type: 'material-icons-outlined',
                icon: 'notification_important',
                acceptLabel: 'Yes',
                rejectLabel: 'No',
                accept: () => {
                    axios.post('/crm/groups/'+this.groupId+'/destroy')
                        .then(() => {
                            this.$toast.success(this.$t('pages.crm_groups_details.group_destroy_success'))

                            this.$router.push('/crm/groups')
                        })
                        .catch((e) => {
                            this.$toast.error(this.$t('pages.crm_groups_details.group_destroy_error'))

                            this.checkAjaxException(e)
                        })
                },
                reject: () => {}
            })
        },
        edit: function () {
            axios.post('/crm/groups/'+this.groupId+'/edit', this.group)
                .then(() => {
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getDetails: function () {
            axios.post('/crm/groups/'+this.groupId+'/details')
                .then((res) => {
                    this.group = res.data.data
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../../sass/vuejs/crm/groups/details.sass'
</style>