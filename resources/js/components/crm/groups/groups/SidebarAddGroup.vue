<template>
    <div class="sidebar-wrapper" v-if="$parent.visibleAdd">
        <div class="sidebar" role="complementary" v-click-outside="outside">
            <div class="sidebar-header">
                <div class="sh-title">{{ $t('pages.crm_groups.add_group') }}</div>

                <div class="sh-close" @click="outside">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 9.4L22.6 8L16 14.6L9.4 8L8 9.4L14.6 16L8 22.6L9.4 24L16 17.4L22.6 24L24 22.6L17.4 16L24 9.4Z" fill="black"/>
                    </svg>
                </div>
            </div>

            <div class="sidebar-body">
                <div class="grid mt-3">
                    <div class="col-4">{{ $t('pages.crm_groups.group_name') }}</div>
                    <div class="col-8"><input type="text" v-model="add.name" class="input w-100" /></div>
                </div>

                <button class="btn btn-success" @click="addGroup()">
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
    data: function () {
        return {
            add: { name: null }
        }
    },
    methods: {
        addGroup: function () {
            axios.post('/crm/groups/add', this.add)
                .then((res) => {
                    this.$router.push('/crm/groups/'+res.data.data)
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
