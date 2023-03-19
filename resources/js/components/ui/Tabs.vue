<template>
    <div class="tab-menu">
        <template v-for="t in tabs" :key="t.label">
            <div class="tm-tab" :class="[ ('active' in t && t.active) ? 'tm-tab-active' : 'tm-tab-inactive' ]">
                <template v-if="'to' in t">
                    <router-link :to="t.to">{{ t.label }}</router-link>
                </template>
                <template v-else>
                    {{ t.label }}
                </template>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    props: [ 'tabs' ]
}
</script>

<style lang="sass" scoped>
.tab-menu
    display: flex
    padding-left: 24px

    .tm-tab
        align-items: center
        cursor: pointer
        display: flex
        font-size: 22px
        height: 44px
        padding-left: 16px
        padding-right: 16px

        &:first-child
            border-top-left-radius: 8px

        &:last-child
            border-top-right-radius: 8px

        &.tm-tab-active
            background-color: white
            border-left: 1px solid #dee2e6
            border-right: 1px solid #dee2e6
            border-top: 1px solid #dee2e6
            color: black

            a
                color: black

        &.tm-tab-inactive
            background-color: #2196F3
            color: white

            a
                color: white
</style>