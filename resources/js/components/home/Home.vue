<template>
    <div class="login-wrapper">
        <div class="login">
            <div class="login-header">{{ $t('login') }}</div>

            <div class="login-form">
                <div class="alert alert-danger" role="alert">Les identifiants sont incorrects.</div>

                <form method="POST">
                    <input type="hidden" name="_token" :value="csrfToken">

                    <div class="grid mb-2">
                        <div class="col-4">{{ $t('email') }}</div>
                        <div class="col-8"><input type="email" name="email" required class="input w-100" /></div>
                    </div>

                    <div class="grid mb-2">
                        <div class="col-4">{{ $t('password') }}</div>
                        <div class="col-8"><input type="password" name="password" required class="input w-100" /></div>
                    </div>

                    <input type="submit" class="btn-without-icon btn-primary" :value="$t('signin')">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'errors' ],
    data: function () {
        return {
            csrfToken: null
        }
    },
    created: function () {
        this.csrfToken = document.head.querySelector('meta[name="csrf-token"]').content
    }
}
</script>

<style lang="sass" scoped>
.login-wrapper
    background-color: #F8F9FA
    height: 100%
    position: relative
    width: 100%

    .login
        background-color: white
        border: 1px solid #dee2e6
        border-radius: 8px
        position: absolute
        left: 50%
        top: 64px
        transform: translate(-50%)
        width: 700px

        .login-form
            margin-bottom: 24px
            margin-left: 24px
            margin-right: 24px
            position: relative

        .login-header
            font-size: 30px
            margin-bottom: 24px
            margin-top: 24px
            text-align: center
</style>