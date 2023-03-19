export default {
    methods: {
        checkAjaxException: function (e) {
            if ('response' in e && 'data' in e.response && 'errors' in e.response.data) {
                let errors = e.response.data.errors

                if (errors.includes('CSRF token mismatch.') || errors.includes('Unauthenticated.')) {
                    window.location = '/logout'
                }
            }
        }
    }
}
