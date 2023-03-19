<template>
    <div class="dcsl-first-links">
        <div class="link"><span>Introduction</span></div>
        <div class="link"><span>Authentification</span></div>
        <div class="link"><span>Errors</span></div>
        <div class="link"><span>Versioning</span></div>
    </div>
</template>

<style lang="sass" scoped>
.dcsl-first-links
    .link
        font-size: 0.9rem
        font-weight: 500
        padding-left: 15px

        span:hover
            cursor: pointer
            font-weight: bold

        &:not(:last-child)
            padding-bottom: 5px
</style>