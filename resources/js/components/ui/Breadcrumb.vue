<template>
    <div class="breadcrumb">
        <template v-for="(s, k) in steps" :key="s.label">
            <div class="breadcrumb-arrow-right material-icons" v-if="k > 0">chevron_right</div>

            <div class="breadcrumb-step">
                <template v-if="'to' in s">
                    <router-link :to="s.to">{{ s.label }}</router-link>
                </template>
                <template v-else>{{ s.label }}</template>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    props: [ 'steps' ]
}
</script>

<style lang="sass" scoped>
.breadcrumb
    background-color: #4285F4
    line-height: 40px
    min-height: 40px
    padding-left: 12px
    padding-bottom: 4px
    padding-right: 8px
    padding-top: 4px
    width: 100%

    .breadcrumb-arrow-right
        display: inline-block
        margin-left: 4px
        margin-right: 4px
        vertical-align: middle

        &:first-child
            display: none

    .breadcrumb-step
        color: white
        display: inline-block
        font-size: 1.1em
        vertical-align: middle

        a
            color: white

body.dark-theme
    .breadcrumb
        background-color: #212529

    .breadcrumb-step, .breadcrumb-step a, .breadcrumb-arrow-right
        color: #dee2e6
</style>