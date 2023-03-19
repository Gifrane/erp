<template>
    <div class="contacts">
        <div class="tabs">
            <router-link :to="'/crm/groups/'+groupId">{{ $t('details') }}</router-link>
            <router-link :to="'/crm/groups/'+groupId+'/contacts'" class="active">{{ $t('pages.crm_groups_details_contacts.contacts') }}</router-link>
        </div>

        <div class="contacts-list">
            <div class="list-group-name">{{ group.name }}</div>

            <div class="list-multiple">
                <button class="btn btn-outline-warning mr-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 9V11H18V9H24ZM8 4C5.79 4 4 5.79 4 8C4 10.21 5.79 12 8 12C10.21 12 12 10.21 12 8C12 5.79 10.21 4 8 4ZM8 13C5.33 13 0 14.34 0 17V20H16V17C16 14.34 10.67 13 8 13ZM12.51 4.05C13.43 5.11 14 6.49 14 8C14 9.51 13.43 10.89 12.51 11.95C14.47 11.7 16 10.04 16 8C16 5.96 14.47 4.3 12.51 4.05V4.05ZM16.53 13.83C17.42 14.66 18 15.7 18 17V20H20V17C20 15.55 18.41 14.49 16.53 13.83Z" fill="black"/>
                    </svg>

                    <span>{{ $t('unlink_selection') }}</span>
                </button>

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
                            <th>{{ $t('phone') }}</th>
                            <th class="th-with-icon">{{ $t('pages.crm_companies_details_contacts.registered_at') }} <order-icon @click="onSort('created_at')" /></th>
                            <th>{{ $t('country') }}</th>
                            <th style="width: 105px"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="c in contacts" :key="c.id">
                            <td class="td-checkbox"><input type="checkbox" class="checkbox" /></td>
                            <td class="td-content">{{ c.firstname }}</td>
                            <td class="td-content">{{ c.lastname }}</td>
                            <td class="td-content">{{ c.email }}</td>
                            <td class="td-content">{{ c.phone }}</td>
                            <td class="td-content">{{ c.created_at }}</td>
                            <td class="td-content">{{ getCountryName(c.i18n_country_id) }}</td>
                            <td class="td-actions">
                                <router-link :to="'/crm/contacts/'+c.id">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.42 20.579C4.28126 20.5788 4.14409 20.5497 4.01721 20.4935C3.89033 20.4374 3.77651 20.3555 3.683 20.253C3.5878 20.1514 3.51515 20.0308 3.46983 19.8991C3.4245 19.7674 3.40752 19.6277 3.42 19.489L3.665 16.795L14.983 5.481L18.52 9.017L7.205 20.33L4.511 20.575C4.48075 20.5778 4.45038 20.5791 4.42 20.579V20.579ZM19.226 8.31L15.69 4.774L17.811 2.653C17.9039 2.56002 18.0142 2.48626 18.1356 2.43594C18.257 2.38562 18.3871 2.35971 18.5185 2.35971C18.6499 2.35971 18.78 2.38562 18.9014 2.43594C19.0228 2.48626 19.1331 2.56002 19.226 2.653L21.347 4.774C21.44 4.86687 21.5137 4.97716 21.5641 5.09856C21.6144 5.21996 21.6403 5.35008 21.6403 5.4815C21.6403 5.61292 21.6144 5.74304 21.5641 5.86444C21.5137 5.98584 21.44 6.09613 21.347 6.189L19.227 8.309L19.226 8.31V8.31Z" fill="black"/>
                                    </svg>
                                </router-link>

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 9V11H18V9H24ZM8 4C5.79 4 4 5.79 4 8C4 10.21 5.79 12 8 12C10.21 12 12 10.21 12 8C12 5.79 10.21 4 8 4ZM8 13C5.33 13 0 14.34 0 17V20H16V17C16 14.34 10.67 13 8 13ZM12.51 4.05C13.43 5.11 14 6.49 14 8C14 9.51 13.43 10.89 12.51 11.95C14.47 11.7 16 10.04 16 8C16 5.96 14.47 4.3 12.51 4.05V4.05ZM16.53 13.83C17.42 14.66 18 15.7 18 17V20H20V17C20 15.55 18.41 14.49 16.53 13.83Z" fill="black"/>
                                </svg>

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                                </svg>

                                <svg v-tippy="$t('bookmark.remove')" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" fill="black"/>
                                </svg>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <pagination :page="pagination.page" :size="pagination.per_page" :total="total" :options="[10,20,30]" />
            </div>
        </div>
    </div>
</template>

<script>
import bookmark from '../../../mixins/bookmark'

export default {
    mixins: [ bookmark ],
    data: function () {
        return {
            order: { column: 'name', order: 'asc' },
            pagination: { page: 1, per_page: 10 },
            method_search: 'getContacts',
            total: 0,

            group: {},
            contacts: []
        }
    },
    computed: {
        groupId: function () { return this.$route.params.group }
    },
    created: function () {
        this.getGroup()
    },
    methods: {
        getGroup: function () {
            axios.post('/crm/groups/'+this.groupId+'/details')
                .then((res) => {
                    this.group = res.data.data

                    this.getContacts()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getContacts: function () {
            let filters = [
                { filter: 'group', operator: 'is_in', value: [ this.groupId ] }
            ]

            axios.post('/crm/contacts/search', {
                order_column: this.order.column, order_order: this.order.order,
                page: this.pagination.page, per_page: this.pagination.per_page, filters: filters
            }).then((res) => {
                let data = res.data.data

                this.bookmarks = data.bookmarks
                this.contacts = data.data
                this.total = data.total
            }).catch((e) => {
                this.checkAjaxException(e)
            })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../../sass/vuejs/crm/groups/contacts.sass'
</style>s