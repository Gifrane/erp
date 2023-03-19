<template>
    <div class="contacts">
        <div class="tabs">
            <router-link to="/crm">Pipeline</router-link>
            <router-link to="/crm/contacts" class="active">{{ $t('pages.crm_contacts.contacts') }}</router-link>
            <router-link to="/crm/groups">{{ $t('pages.crm_contacts.groups') }}</router-link>
            <router-link to="/crm/companies">{{ $t('pages.crm_contacts.companies') }}</router-link>
            <router-link to="/crm/reviews">{{ $t('pages.crm_contacts.reviews') }}</router-link>
        </div>

        <div class="contacts-list">
            <div class="grid">
                <column-search v-if="visibleSearch" />

                <div class="contacts-list-wrapper" :class="[ visibleSearch ? 'col-9' : 'col-12' ]">
                    <div class="list-actions btn-align">
                        <button class="btn btn-outline-primary mr-2" @click="visibleAdd = true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 3C12 2.73478 11.8946 2.48043 11.7071 2.29289C11.5196 2.10536 11.2652 2 11 2C10.7348 2 10.4804 2.10536 10.2929 2.29289C10.1054 2.48043 10 2.73478 10 3V10H3C2.73478 10 2.48043 10.1054 2.29289 10.2929C2.10536 10.4804 2 10.7348 2 11C2 11.2652 2.10536 11.5196 2.29289 11.7071C2.48043 11.8946 2.73478 12 3 12H10V19C10 19.2652 10.1054 19.5196 10.2929 19.7071C10.4804 19.8946 10.7348 20 11 20C11.2652 20 11.5196 19.8946 11.7071 19.7071C11.8946 19.5196 12 19.2652 12 19V12H19C19.2652 12 19.5196 11.8946 19.7071 11.7071C19.8946 11.5196 20 11.2652 20 11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10H12V3Z" fill="#1791BA"/>
                            </svg>

                            <span>{{ $t('pages.crm_contacts.add_contact') }}</span>
                        </button>

                        <button class="btn btn-outline-secondary" @click="visibleSearch = !visibleSearch">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.325 14.899L21.705 20.279C21.8941 20.4682 22.0003 20.7248 22.0002 20.9924C22.0001 21.2599 21.8937 21.5164 21.7045 21.7055C21.5153 21.8946 21.2587 22.0008 20.9912 22.0007C20.7236 22.0006 20.4671 21.8942 20.278 21.705L14.898 16.325C13.2897 17.5707 11.2673 18.1569 9.24214 17.9644C7.21699 17.7718 5.34124 16.815 3.99649 15.2886C2.65174 13.7622 1.939 11.7808 2.00326 9.74755C2.06753 7.71428 2.90396 5.78186 4.34242 4.34341C5.78087 2.90495 7.71329 2.06851 9.74656 2.00425C11.7798 1.93999 13.7612 2.65273 15.2876 3.99748C16.814 5.34223 17.7708 7.21798 17.9634 9.24313C18.1559 11.2683 17.5697 13.2907 16.324 14.899H16.325ZM10 16C11.5913 16 13.1174 15.3679 14.2427 14.2426C15.3679 13.1174 16 11.5913 16 10C16 8.4087 15.3679 6.88258 14.2427 5.75736C13.1174 4.63214 11.5913 4 10 4C8.40871 4 6.88259 4.63214 5.75737 5.75736C4.63215 6.88258 4.00001 8.4087 4.00001 10C4.00001 11.5913 4.63215 13.1174 5.75737 14.2426C6.88259 15.3679 8.40871 16 10 16V16Z" fill="black"/>
                            </svg>

                            <span v-if="!visibleSearch">{{ $t('search') }}</span>
                            <span v-else>{{ $t('pages.crm_contacts.close_search') }}</span>
                        </button>
                    </div>

                    <div class="list-multiple" v-if="selected_multiple.length > 0">
                        <div class="list-multiple-header">
                            <span class="header-label">{{ $tc(
                                'pages.crm_contacts.nb_selected_contacts',
                                selected_multiple.length,
                                { count: selected_multiple.length }
                            ) }}</span>
                            <span class="header-cancel">{{ $t('cancel') }}</span>
                        </div>

                        <div class="list-multiple-actions">
                            <button class="btn btn-outline-danger">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                                </svg>

                                <span>{{ $t('delete_selection') }}</span>
                            </button>

                            <button class="btn-without-icon btn-outline-secondary">
                                <span>{{ $t('pages.crm_contacts.link_to_groups') }}</span>
                            </button>
                        </div>
                    </div>

                    <div class="list-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="th-checkbox"><input type="checkbox" class="checkbox" v-model="select_all" @change="selectAll()" /></th>
                                    <th class="th-with-icon">{{ $t('firstname') }} <order-icon @click="onSort('firstname')" /></th>
                                    <th class="th-with-icon">{{ $t('lastname') }} <order-icon @click="onSort('lastname')" /></th>
                                    <th class="th-with-icon">{{ $t('email') }} <order-icon @click="onSort('email')" /></th>
                                    <th>{{ $t('phone') }}</th>
                                    <th class="th-with-icon">{{ $t('pages.crm_contacts.registered_at') }} <order-icon @click="onSort('created_at')" /></th>
                                    <th>{{ $t('country') }}</th>
                                    <th style="width: 85px"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="c in contacts" :key="c.id">
                                    <td class="td-checkbox">
                                        <input type="checkbox" class="checkbox" :value="c.id" v-model="selected_multiple" @change="selectEntity(c.id)" />
                                    </td>
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

                                        <svg @click="deleteContact(c.id)" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
        </div>

        <modale-add-search-filter />
        <sidebar-add-contact ref="add_contact" />
    </div>
</template>

<script>
import bookmark from '../../../mixins/bookmark'

import ColumnSearch from './contacts/ColumnSearch.vue'
import ModaleAddSearchFilter from './contacts/ModaleAddSearchFilter.vue'
import SidebarAddContact from './contacts/SidebarAddContact.vue'

export default {
    components: { ColumnSearch, ModaleAddSearchFilter, SidebarAddContact },
    mixins: [ bookmark ],
    data: function () {
        return {
            order: { column: 'id', order: 'ASC' },
            pagination: { page: 1, per_page: 10 },
            method_search: 'getContacts',
            total: 0,

            visibleAdd: false,
            visibleSearch: false,

            contacts: [],

            select_all: false,
            selected_multiple: [],
        }
    },
    created: function () {
        this.getContacts()
    },
    methods: {
        selectAll: function () {
            let contacts = this.contacts.map((c) => c.id)

            if (this.select_all) {
                this.selected_multiple = [ ...new Set(this.selected_multiple.concat(contacts)) ]
            } else {
                this.selected_multiple = this.selected_multiple.filter((c) => !contacts.includes(c))
            }
        },
        selectEntity: function (contact_id) {
            if (this.selected_multiple.includes(contact_id)) {
                let contacts = this.contacts.map((c) => c.id).filter((c) => this.selected_multiple.includes(c))

                this.select_all = (contacts.length === this.contacts.length)
            } else {
                this.select_all = false
            }
        },
        deleteContact: function (contact) {
            axios.post('/crm/contacts/'+contact+'/destroy')
                .then(() => {
                    this.getContacts()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getContacts: function () {
            axios.post('/crm/contacts/search', {
                order_column: this.order.column, order_order: this.order.order,
                page: this.pagination.page, per_page: this.pagination.per_page
            }).then((res) => {
                let data = res.data.data

                this.select_all = false

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
@import '../../../../sass/vuejs/crm/contacts/contacts.sass'
</style>