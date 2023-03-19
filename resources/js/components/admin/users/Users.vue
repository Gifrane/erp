<template>
    <div class="users">
        <div class="tabs">
            <router-link to="/admin/users" class="active">{{ $t('pages.admin_users.users') }}</router-link>
            <router-link to="/admin/users/groups">{{ $t('pages.admin_users.groups') }}</router-link>
            <router-link to="/admin/users/companies">{{ $t('pages.admin_users.companies') }}</router-link>
        </div>

        <div class="users-list">
            <div class="list-actions">
                <button class="btn btn-outline-primary mr-2" @click="visibleAdd = true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3C12 2.73478 11.8946 2.48043 11.7071 2.29289C11.5196 2.10536 11.2652 2 11 2C10.7348 2 10.4804 2.10536 10.2929 2.29289C10.1054 2.48043 10 2.73478 10 3V10H3C2.73478 10 2.48043 10.1054 2.29289 10.2929C2.10536 10.4804 2 10.7348 2 11C2 11.2652 2.10536 11.5196 2.29289 11.7071C2.48043 11.8946 2.73478 12 3 12H10V19C10 19.2652 10.1054 19.5196 10.2929 19.7071C10.4804 19.8946 10.7348 20 11 20C11.2652 20 11.5196 19.8946 11.7071 19.7071C11.8946 19.5196 12 19.2652 12 19V12H19C19.2652 12 19.5196 11.8946 19.7071 11.7071C19.8946 11.5196 20 11.2652 20 11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10H12V3Z" fill="#1791BA"/>
                    </svg>

                    <span>{{ $t('pages.admin_users.add_user') }}</span>
                </button>
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
                            <th class="th-with-icon">{{ $t('firstname') }} <order-icon @click="onSort('firstname')" /></th>
                            <th class="th-with-icon">{{ $t('lastname') }} <order-icon @click="onSort('lastname')" /></th>
                            <th class="th-with-icon">{{ $t('email') }} <order-icon @click="onSort('email')" /></th>
                            <th class="th-with-icon">{{ $t('pages.admin_users.role') }} <order-icon @click="onSort('role')" /></th>
                            <th class="th-with-icon">{{ $t('pages.admin_users.created_at') }} <order-icon @click="onSort('created_at')" /></th>
                            <th style="width: 250px">{{ $t('pages.admin_users.validated_account') }}</th>
                            <th style="width: 100px"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="u in users" :key="u.id">
                            <td class="td-checkbox"><input type="checkbox" class="checkbox" /></td>
                            <td class="td-content">{{ u.firstname }}</td>
                            <td class="td-content">{{ u.lastname }}</td>
                            <td class="td-content">{{ u.email }}</td>
                            <td class="td-content">{{ u.role }}</td>
                            <td class="td-content">{{ u.created_at }}</td>

                            <td class="td-actions">
                                <svg v-if="u.active" class="svg-validated" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.59 7.58L10 14.17L6.41 10.59L5 12L10 17L18 9L16.59 7.58ZM12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.58 20 4 16.42 4 12C4 7.58 7.58 4 12 4C16.42 4 20 7.58 20 12C20 16.42 16.42 20 12 20Z" fill="black"/>
                                </svg>
                                <svg v-else class="svg-block" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM4 12C4 7.58 7.58 4 12 4C13.85 4 15.55 4.63 16.9 5.69L5.69 16.9C4.59177 15.5031 3.99639 13.7769 4 12V12ZM12 20C10.15 20 8.45 19.37 7.1 18.31L18.31 7.1C19.4082 8.49686 20.0036 10.2231 20 12C20 16.42 16.42 20 12 20Z" fill="black"/>
                                </svg>
                            </td>

                            <td class="td-actions">
                                <router-link :to="'/admin/users/'+u.id">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.42 20.579C4.28126 20.5788 4.14409 20.5497 4.01721 20.4935C3.89033 20.4374 3.77651 20.3555 3.683 20.253C3.5878 20.1514 3.51515 20.0308 3.46983 19.8991C3.4245 19.7674 3.40752 19.6277 3.42 19.489L3.665 16.795L14.983 5.481L18.52 9.017L7.205 20.33L4.511 20.575C4.48075 20.5778 4.45038 20.5791 4.42 20.579V20.579ZM19.226 8.31L15.69 4.774L17.811 2.653C17.9039 2.56002 18.0142 2.48626 18.1356 2.43594C18.257 2.38562 18.3871 2.35971 18.5185 2.35971C18.6499 2.35971 18.78 2.38562 18.9014 2.43594C19.0228 2.48626 19.1331 2.56002 19.226 2.653L21.347 4.774C21.44 4.86687 21.5137 4.97716 21.5641 5.09856C21.6144 5.21996 21.6403 5.35008 21.6403 5.4815C21.6403 5.61292 21.6144 5.74304 21.5641 5.86444C21.5137 5.98584 21.44 6.09613 21.347 6.189L19.227 8.309L19.226 8.31V8.31Z" fill="black"/>
                                    </svg>
                                </router-link>

                                <svg v-if="u.deleted_at === null" v-tippy="$t('pages.admin_users.lock_account')" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.5 10.875H17.9062V5.625C17.9062 3.96797 16.5633 2.625 14.9062 2.625H9.09375C7.43672 2.625 6.09375 3.96797 6.09375 5.625V10.875H4.5C4.08516 10.875 3.75 11.2102 3.75 11.625V20.625C3.75 21.0398 4.08516 21.375 4.5 21.375H19.5C19.9148 21.375 20.25 21.0398 20.25 20.625V11.625C20.25 11.2102 19.9148 10.875 19.5 10.875ZM12.6562 16.4297V17.6719C12.6562 17.775 12.5719 17.8594 12.4688 17.8594H11.5312C11.4281 17.8594 11.3438 17.775 11.3438 17.6719V16.4297C11.1503 16.2908 11.0059 16.0941 10.9313 15.8679C10.8568 15.6417 10.8559 15.3977 10.9289 15.1709C11.0018 14.9442 11.1448 14.7465 11.3373 14.6062C11.5298 14.466 11.7618 14.3904 12 14.3904C12.2382 14.3904 12.4702 14.466 12.6627 14.6062C12.8552 14.7465 12.9982 14.9442 13.0711 15.1709C13.1441 15.3977 13.1432 15.6417 13.0687 15.8679C12.9941 16.0941 12.8497 16.2908 12.6562 16.4297V16.4297ZM16.2188 10.875H7.78125V5.625C7.78125 4.90078 8.36953 4.3125 9.09375 4.3125H14.9062C15.6305 4.3125 16.2188 4.90078 16.2188 5.625V10.875Z" fill="black"/>
                                </svg>
                                <svg v-else v-tippy="$t('pages.admin_users.unlock_account')" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 17C13.1 17 14 16.1 14 15C14 13.9 13.1 13 12 13C10.9 13 10 13.9 10 15C10 16.1 10.9 17 12 17ZM18 8H17V6C17 3.24 14.76 1 12 1C9.24 1 7 3.24 7 6H8.9C8.9 4.29 10.29 2.9 12 2.9C13.71 2.9 15.1 4.29 15.1 6V8H6C4.9 8 4 8.9 4 10V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V10C20 8.9 19.1 8 18 8ZM18 20H6V10H18V20Z" fill="black"/>
                                </svg>

                                <svg @click="deleteAccount(u.id)" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                                </svg>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <pagination :page="pagination.page" :size="pagination.per_page" :total="total" :options="[10,20,30]" />
            </div>
        </div>
    </div>

    <sidebar-add-user />
</template>

<script>
import SidebarAddUser from './users/SidebarAddUser.vue'

export default {
    components: { SidebarAddUser },
    data: function () {
        return {
            order: { column: 'firstname', order: 'asc' },
            pagination: { page: 1, per_page: 10 },
            method_search: 'getUsers',
            total: 0,

            visibleAdd: false,

            users: []
        }
    },
    created: function () {
        this.getUsers()
    },
    methods: {
        deleteAccount: function (user) {
            axios.post('/admin/users/'+user+'/destroy')
                .then(() => {
                    this.getUsers()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getUsers: function () {
            axios.post('/admin/users/search', {
                order_column: this.order.column, order_order: this.order.order,
                page: this.pagination.page, per_page: this.pagination.per_page
            }).then((res) => {
                let data = res.data.data

                this.users = data.data
                this.total = data.total
            }).catch((e) => {
                this.checkAjaxException(e)
            })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../../sass/vuejs/admin/users/users.sass'
</style>
