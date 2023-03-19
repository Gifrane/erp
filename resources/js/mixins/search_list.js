export default {
    data: function () {
        return {
            timer_search: null,
            search: null,
        }
    },
    watch: {
        search: function () {
            clearTimeout(this.timer_search)

            this.timer_search = setTimeout(() => this[ this.method_search ](), 400)
        }
    }
}