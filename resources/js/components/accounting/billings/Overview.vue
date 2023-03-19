<template>
    <breadcrumb :steps="breadcrumb" />

    <div class="grid mt-4 ml-2 mr-2">
        <div class="col-12">
            <div class="overview-header">
                <div class="overview-header-card incomes">
                    <div class="header-card-title">Last 30-days incomes</div>

                    <div class="header-card-content">
                        <div class="card-content-percentage">
                            <div class="percentage-direction">
                                <svg width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.5 0L12.1292 9.75H0.870835L6.5 0Z" fill="#19C332"/>
                                </svg>
                            </div>
                            <div class="percentage-number percentage-up">1%</div>
                        </div>

                        <div class="card-content-total percentage-up">101</div>
                    </div>
                </div>

                <div class="overview-header-card expenses">
                    <div class="header-card-title">Last 30-days expenses</div>

                    <div class="header-card-content">
                        <div class="card-content-percentage">
                            <div class="percentage-direction">
                                <svg width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.5 10L0.870835 0.249999L12.1292 0.25L6.5 10Z" fill="#19C332"/>
                                    <!--<path d="M6.5 10L0.870835 0.249999L12.1292 0.25L6.5 10Z" fill="#FF4588"/>-->
                                </svg>
                            </div>
                            <div class="percentage-number percentage-down">1%</div>
                        </div>

                        <div class="card-content-total percentage-down">99</div>
                    </div>
                </div>
            </div>

            <div class="tab-content p-4">
                <button class="btn btn-outline-primary" @click="visibleAdd = true">
                    <span class="material-icons">add</span>
                    <span>{{ $t('pages.accounting_billings.add_billing') }}</span>
                </button>

                <div class="mt-2">
                    <button class="btn btn-outline-danger">
                        <span class="material-icons">delete</span>
                        <span>{{ $t('delete_selection') }}</span>
                    </button>
                </div>

                <table class="table table-bordered mt-2">
                    <thead class="thead-th-azure">
                        <tr>
                            <th class="th-checkbox"><input type="checkbox" class="checkbox" /></th>
                            <th>{{ $t('title') }} <order-icon col="title" :order="order" @click="onSort('title')" /></th>
                            <th style="width: 110px"></th>
                        </tr>
                    </thead>

                    <tbody class="tbody-td-white">
                        <tr v-for="b in billings" :key="b.id">
                            <td class="td-checkbox"><input type="checkbox" :value="b.id" class="checkbox" /></td>
                            <td class="td-cols-content">{{ b.title }}</td>

                            <td class="td-actions">
                                <router-link :to="'/accounting/billings/'+b.id">
                                    <span class="material-icons fs-1-5 black-link">edit</span>
                                </router-link>

                                <span class="material-icons fs-1-5 ml-1 pointer" @click="deleteBilling(b.id)">delete</span>

                                <template v-if="bookmarks.includes(b.id)">
                                    <span :ref="'full_bookmark_'+b.id" class="material-icons pointer fs-1-5 ml-1" @click="removeBookmark('accounting_billing', b.id)"
                                        v-tippy="$t('bookmark.remove')" @mouseover="iconBookmark(b.id, 'full', 'empty')" @mouseleave="iconBookmark(b.id, 'full', 'full')">
                                        star
                                    </span>
                                </template>
                                <template v-else>
                                    <span :ref="'empty_bookmark_'+b.id" class="material-icons pointer fs-1-5 ml-1" @click="addBookmark('accounting_billing', b.id)"
                                        v-tippy="$t('bookmark.add')" @mouseover="iconBookmark(b.id, 'empty', 'full')" @mouseleave="iconBookmark(b.id, 'empty', 'empty')">
                                        star_border
                                    </span>
                                </template>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <pagination :page="pagination.current" :size="pagination.per_page" :total="total" :options="[10,20,50,100]" />
            </div>
        </div>
    </div>

    <sidebar-add-billing />
</template>

<script>
import bookmark from '../../../mixins/bookmark'

import SidebarAddBilling from './overview/SidebarAddBilling.vue'

export default {
    components: { SidebarAddBilling },
    mixins: [ bookmark ],
    data: function () {
        return {
            order: { column: 'title', order: 'asc' },
            pagination: { page: 1, per_page: 10 },
            method_search: 'getBillings',
            total: 0,

            visibleAdd: false,

            billings: [],

            breadcrumb: [],
            tabs: []
        }
    },
    created: function () {
        this.breadcrumb = [
            { label: this.$t('accounting') },
            { label: this.$t('billings_management'), to: '/accounting/billings', active: true }
        ]

        this.getBillings()
    },
    methods: {
        deleteBilling: function (billing) {
            axios.post('/accounting/billings/'+billing+'/destroy')
                .then(() => {
                    this.getBillings()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getBillings: function () {
            axios.post('/accounting/billings/search', {
                order_column: this.order.column, order_order: this.order.order,
                page: this.pagination.page, per_page: this.pagination.per_page
            }).then((res) => {
                let data = res.data.data

                this.bookmarks = data.bookmarks
                this.billings = data.data
                this.total = data.total
            }).catch((e) => {
                this.checkAjaxException(e)
            })
        }
    }
}
</script>

<style lang="sass" scoped>
.overview-header
    display: flex
    margin-bottom: 1rem

    .overview-header-card
        background-color: #EBF5FF
        border: 1px solid #1791ba
        border-radius: 1rem
        margin-right: 1.5rem
        padding: 1rem

        &.expenses
            .percentage-down
                color: #19C332

            .percentage-up
                color: #FF4588

        &.incomes
            .percentage-down
                color: #FF4588

            .percentage-up
                color: #19C332

        .header-card-content
            align-items: baseline
            display: flex
            justify-content: space-between
            margin-top: 0.25rem

            .card-content-percentage
                display: flex
                margin-right: 0.5rem

                .percentage-number
                    padding-top: 1px

            .card-content-total
                font-size: 20px

        .header-card-title
            color: #1791ba
            font-weight: 500
</style>