<template>
    <div class="modal-wrapper modale-search-add-filter" v-if="visible">
        <div class="modal" style="width: 800px;" v-click-outside="outside">
            <div class="modal-header">
                <div class="modal-header-title">
                    <div class="header-title-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M30 6H26V2H24V6H20V8H24V12H26V8H30V6ZM24 28.586L18.025 22.611C19.4651 20.8095 20.1607 18.5249 19.9688 16.2265C19.777 13.9281 18.7123 11.7905 16.9934 10.2526C15.2746 8.71479 13.0321 7.89353 10.7266 7.95754C8.42115 8.02156 6.2277 8.96599 4.59685 10.5968C2.966 12.2277 2.02157 14.4211 1.95755 16.7266C1.89353 19.0321 2.7148 21.2746 4.25264 22.9934C5.79048 24.7123 7.92814 25.7769 10.2265 25.9688C12.5249 26.1606 14.8095 25.4651 16.611 24.025L22.586 30L24 28.586ZM4.00001 17C4.00001 15.6155 4.41055 14.2622 5.17972 13.111C5.94889 11.9599 7.04214 11.0627 8.32122 10.5328C9.6003 10.003 11.0078 9.86441 12.3656 10.1345C13.7235 10.4046 14.9708 11.0713 15.9498 12.0503C16.9287 13.0292 17.5954 14.2765 17.8655 15.6344C18.1356 16.9922 17.997 18.3997 17.4672 19.6788C16.9374 20.9579 16.0401 22.0511 14.889 22.8203C13.7379 23.5895 12.3845 24 11 24C9.14414 23.9979 7.36489 23.2597 6.0526 21.9474C4.7403 20.6351 4.00212 18.8559 4.00001 17V17Z" fill="black"/>
                        </svg>
                    </div>

                    <span>{{ $t('pages.crm_contacts.search_add_filter') }}</span>
                </div>

                <div class="modal-header-close" @click="outside">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 9.4L22.6 8L16 14.6L9.4 8L8 9.4L14.6 16L8 22.6L9.4 24L16 17.4L22.6 24L24 22.6L17.4 16L24 9.4Z" fill="black"/>
                    </svg>
                </div>
            </div>

            <div class="modal-body">
                <div class="grid">
                    <div class="col-4"><dropdown-filters /></div>
                    <div class="col-3"><dropdown-operator ref="dropdown_operator" /></div>

                    <div class="col-5">
                        <filter-country v-if="filter === 'country'" />
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-round btn-secondary mr-2" @click="outside()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 7.05L16.95 6L12 10.95L7.05 6L6 7.05L10.95 12L6 16.95L7.05 18L12 13.05L16.95 18L18 16.95L13.05 12L18 7.05Z" fill="black"/>
                    </svg>

                    <span>{{ $t('cancel') }}</span>
                </button>

                <button class="btn btn-round btn-primary" @click="addFilter()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3C12 2.73478 11.8946 2.48043 11.7071 2.29289C11.5196 2.10536 11.2652 2 11 2C10.7348 2 10.4804 2.10536 10.2929 2.29289C10.1054 2.48043 10 2.73478 10 3V10H3C2.73478 10 2.48043 10.1054 2.29289 10.2929C2.10536 10.4804 2 10.7348 2 11C2 11.2652 2.10536 11.5196 2.29289 11.7071C2.48043 11.8946 2.73478 12 3 12H10V19C10 19.2652 10.1054 19.5196 10.2929 19.7071C10.4804 19.8946 10.7348 20 11 20C11.2652 20 11.5196 19.8946 11.7071 19.7071C11.8946 19.5196 12 19.2652 12 19V12H19C19.2652 12 19.5196 11.8946 19.7071 11.7071C19.8946 11.5196 20 11.2652 20 11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10H12V3Z" fill="#1791BA"/>
                    </svg>

                    <span>{{ $t('add') }}</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

import DropdownFilters from './add_search_filter/DropdownFilters.vue'
import DropdownOperator from './add_search_filter/DropdownOperator.vue'
import FilterCountry from './add_search_filter/filters/FilterCountry.vue'

export default {
    components: { DropdownFilters, DropdownOperator, FilterCountry },
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            visible: false,

            filter: null,
            operator: null,
            value: null,
            valueLabel: null
        }
    },
    computed: {
        filterIteration: function () { return this.$store.getters['crm/contacts/search/get_iteration'] }
    },
    created: function () {
        EventBus.on('open_modale_search_add_filter', () => this.visible = true)
    },
    methods: {
        addFilter: function () {
            if (this.filter === 'country' && this.operator !== null && this.value.length > 0) {
                this.$store.commit('crm/contacts/search/add_filter', {
                    filter: this.filter, operator: this.operator, value: this.value,
                    iteration: this.filterIteration, labels: this.valueLabel
                })

                this.$store.commit('crm/contacts/search/increment_iteration')
            }

            this.outside()
        },
        selectNewFilter: function (filter) {
            if (this.filter !== filter) {
                this.filter = filter
                this.operator = null

                if (this.filter === 'country') {
                    this.value = []
                    this.valueLabel = {}
                } else {
                    this.value = null
                    this.valueLabel = null
                }

                this.$refs.dropdown_operator.updateFilter(filter)
            }
        },
        outside: function () {
            this.visible = false

            this.filter = null
            this.operator = null
            this.value = null
            this.valueLabel = null
        }
    }
}
</script>