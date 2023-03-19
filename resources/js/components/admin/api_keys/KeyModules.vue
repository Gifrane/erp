<template>
    <td class="td-modules">
        <div class="badge" v-for="m in display_modules" :key="m">{{ m }}</div>

        <template v-if="other_modules.length > 0">
            <div class="modules-more">+{{ other_modules.length }}</div>
        </template>
    </td>
</template>

<script>
export default {
    props: [ 'modules' ],
    data: function () {
        return {
            display_modules: [],
            other_modules: [],
        }
    },
    created: function () {
        if (this.modules.length > 0) {
            for (let m of this.modules) {
                if (this.display_modules.length < 3) {
                    this.display_modules.push(this.$t('pages.admin_api_keys.modules_list.'+m))
                } else {
                    this.other_modules.push(this.$t('pages.admin_api_keys.modules_list.'+m))
                }
            }
        }
    }
}
</script>