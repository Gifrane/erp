export default {
    methods: {
        changePage: function (page) {
            this.pagination.page = page

            this[ this.method_search ]()
        },
        changePageSize: function (size) {
            this.pagination.page = 1
            this.pagination.per_page = size

            this[ this.method_search ]()
        },
        onPage(event) {
            this.pagination.page = event.page + 1
            this.pagination.per_page = event.rows

            this[ this.method_search ]()
        },
        onSort(column) {
            if (this.order.column === column) {
                this.order.order = (this.order.order === 'asc') ? 'desc' : 'asc'
            } else {
                this.order.column = column
                this.order.order = 'asc'
            }

            this[ this.method_search ]()
        }
    }
}