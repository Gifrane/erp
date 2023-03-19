export default {
    data: function () {
        return {
            bookmarks: []
        }
    },
    methods: {
        addBookmark: function (entity_type, entity_id) {
            axios.post('/bookmark/add', { entity_type: entity_type, entity_id: entity_id })
                .then(() => {
                    this.bookmarks.push(entity_id)
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        removeBookmark: function (entity_type, entity_id) {
            axios.post('/bookmark/remove', { entity_type: entity_type, entity_id: entity_id })
                .then(() => {
                    this.bookmarks = this.bookmarks.filter((b) => b != entity_id)
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
