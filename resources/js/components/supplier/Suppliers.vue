<template>
    <div class="suppliers">
        <div class="suppliers-list">
            <div class="list-actions btn-align">
                <button class="btn btn-outline-primary mr-2" @click="visibleAdd = true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3C12 2.73478 11.8946 2.48043 11.7071 2.29289C11.5196 2.10536 11.2652 2 11 2C10.7348 2 10.4804 2.10536 10.2929 2.29289C10.1054 2.48043 10 2.73478 10 3V10H3C2.73478 10 2.48043 10.1054 2.29289 10.2929C2.10536 10.4804 2 10.7348 2 11C2 11.2652 2.10536 11.5196 2.29289 11.7071C2.48043 11.8946 2.73478 12 3 12H10V19C10 19.2652 10.1054 19.5196 10.2929 19.7071C10.4804 19.8946 10.7348 20 11 20C11.2652 20 11.5196 19.8946 11.7071 19.7071C11.8946 19.5196 12 19.2652 12 19V12H19C19.2652 12 19.5196 11.8946 19.7071 11.7071C19.8946 11.5196 20 11.2652 20 11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10H12V3Z" fill="#1791BA"/>
                    </svg>

                    <span>{{ $t('pages.suppliers.add_supplier') }}</span>
                </button>

                <input type="search" class="input input-search" v-model="search" :placeholder="$t('pages.suppliers.search_supplier')" /> 
            </div>

            <div class="list-multiple">
                <button class="btn btn-outline-danger">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                    </svg>

                    <span>{{ $t('delete_selection') }}</span>
                </button>
            </div>

            <div class="list-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="th-checkbox"><input type="checkbox" class="checkbox" /></th>
                            <th class="th-with-icon">{{ $t('name') }} <order-icon @click="onSort('name')" /></th>
                            <th style="width: 85px"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="s in suppliers" :key="s.id">
                            <td class="td-checkbox"><input type="checkbox" :value="s.id" class="checkbox" /></td>
                            <td class="td-content">{{ s.name }}</td>

                            <td class="td-actions">
                                <router-link :to="'/supplier/'+s.id">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.42 20.579C4.28126 20.5788 4.14409 20.5497 4.01721 20.4935C3.89033 20.4374 3.77651 20.3555 3.683 20.253C3.5878 20.1514 3.51515 20.0308 3.46983 19.8991C3.4245 19.7674 3.40752 19.6277 3.42 19.489L3.665 16.795L14.983 5.481L18.52 9.017L7.205 20.33L4.511 20.575C4.48075 20.5778 4.45038 20.5791 4.42 20.579V20.579ZM19.226 8.31L15.69 4.774L17.811 2.653C17.9039 2.56002 18.0142 2.48626 18.1356 2.43594C18.257 2.38562 18.3871 2.35971 18.5185 2.35971C18.6499 2.35971 18.78 2.38562 18.9014 2.43594C19.0228 2.48626 19.1331 2.56002 19.226 2.653L21.347 4.774C21.44 4.86687 21.5137 4.97716 21.5641 5.09856C21.6144 5.21996 21.6403 5.35008 21.6403 5.4815C21.6403 5.61292 21.6144 5.74304 21.5641 5.86444C21.5137 5.98584 21.44 6.09613 21.347 6.189L19.227 8.309L19.226 8.31V8.31Z" fill="black"/>
                                    </svg>
                                </router-link>

                                <svg @click="deleteSupplier(s.id)" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                                </svg>

                                <svg v-if="bookmarks.includes(s.id)" @click="removeBookmark('supplier', s.id)" v-tippy="$t('bookmark.remove')" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" fill="black"/>
                                </svg>
                                <svg v-else v-tippy="$t('bookmark.add')" @click="addBookmark('supplier', s.id)" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 9.24L14.81 8.62L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27L18.18 21L16.55 13.97L22 9.24ZM12 15.4L8.24 17.67L9.24 13.39L5.92 10.51L10.3 10.13L12 6.1L13.71 10.14L18.09 10.52L14.77 13.4L15.77 17.68L12 15.4Z" fill="black"/>
                                </svg>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <pagination :page="pagination.page" :size="pagination.per_page" :total="total" :options="[10,20,30]" />
            </div>
        </div>
    </div>

    <sidebar-add-supplier />
</template>

<script>
import bookmark from '../../mixins/bookmark'
import search_list from '../../mixins/search_list'

import SidebarAddSupplier from './suppliers/SidebarAddSupplier.vue'

export default {
    components: { SidebarAddSupplier },
    mixins: [ bookmark, search_list ],
    data: function () {
        return {
            order: { column: 'name', order: 'asc' },
            pagination: { page: 1, per_page: 10 },
            method_search: 'getSuppliers',
            total: 0,
            multipleSelectionData: { var: 'suppliers', key: 'id' },

            timer_search: null,
            search: null,

            bookmarks: [],
            suppliers: [],

            visibleAdd: false,
        }
    },
    created: function () {
        this.getSuppliers()
    },
    methods: {
        deleteSupplier: function (supplier) {
            axios.post('/supplier/'+supplier+'/destroy')
                .then(() => {
                    this.getSuppliers()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getSuppliers: function () {
            axios.post('/supplier/search', {
                order_column: this.order.column, order_order: this.order.order, search: this.search,
                page: this.pagination.page, per_page: this.pagination.per_page, filters: []
            }).then((res) => {
                let data = res.data.data

                this.suppliers = data.data
                this.total = data.total
            }).catch((e) => {
                this.checkAjaxException(e)
            })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../sass/vuejs/supplier/suppliers.sass'
</style>
