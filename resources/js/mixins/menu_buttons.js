export default {
    data: function () {
        return {
            visibleMenuButtons: false
        }
    },
    methods: {
        displayMenuButtons: function () {
            this.visibleMenuButtons = !this.visibleMenuButtons
        }
    }
}