<template>
    <div class="pagination">
        <div class="pagination-total">{{ total }} résultats</div>

        <div class="pagination-pages">
            <template v-for="p in pages" :key="p">
                <button type="button" class="pp-page" :class="{ current: p === page }" @click="changePage(p)">{{ p }}</button>
            </template>
        </div>

        <div class="pagination-options">
            <dropdown-options :options="options" ref="dropdown_options" />
        </div>
    </div>
</template>

<script>
import DropdownOptions from './pagination/DropdownOptions.vue'

export default {
    components: { DropdownOptions },
    props: [ 'options', 'page', 'total', 'size' ],
    data: function () {
        return {
            pages: [],
        }
    },
    watch: {
        page: function () {
            this.generatePages()
        },
        size: function () {
            this.generatePages()
        },
        total: function () {
            this.generatePages()
        },
    },
    methods: {
        changePage: function (page) {
            this.$parent.changePage(page)
        },
        generatePages: function () {
            let page = this.page
            let max_pages = Math.ceil(this.total / this.size)

            var range_min_page = page - 3
            var range_max_page = page + 3

            if (range_min_page < 1) {
                range_min_page = 1
            }

            if (range_max_page > max_pages) {
                range_max_page = max_pages
            }

            var pages = []

            for (let i = range_min_page; i <= range_max_page; i++) {
                pages.push(i)
            }

            this.pages = pages
        }
    }
}
</script>
