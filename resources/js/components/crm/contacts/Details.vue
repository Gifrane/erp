<template>
    <div class="contact-details">
        <div class="tabs">
            <router-link :to="'/crm/contacts/'+contactId" class="active">{{ $t('details') }}</router-link>
            <router-link :to="'/crm/contacts/'+contactId+'/datas'">{{ $t('pages.crm_contacts_details.datas') }}</router-link>
            <router-link :to="'/crm/contacts/'+contactId+'/reviews'">{{ $t('pages.crm_contacts_details.reviews') }}</router-link>
            <router-link :to="'/crm/contacts/'+contactId+'/mailer'">{{ $t('pages.crm_contacts_details.mailer') }}</router-link>
            <router-link :to="'/crm/contacts/'+contactId+'/tickets'">{{ $t('pages.crm_contacts_details.tickets') }}</router-link>
            <router-link :to="'/crm/contacts/'+contactId+'/notes'">{{ $t('pages.crm_contacts_details.notes') }}</router-link>
            <router-link :to="'/crm/contacts/'+contactId+'/booking'">{{ $t('pages.crm_contacts_details.booking') }}</router-link>
            <router-link :to="'/crm/contacts/'+contactId+'/orders'">{{ $t('pages.crm_contacts_details.orders') }}</router-link>
            <router-link :to="'/crm/contacts/'+contactId+'/contacts'">{{ $t('pages.crm_contacts_details.contacts') }}</router-link>
        </div>

        <div class="details-body">
            <actions />

            <div class="details-body-details">
                <div class="grid">
                    <div class="col-5">
                        <div class="grid">
                            <div class="col-4">{{ $t('firstname') }}</div>
                            <div class="col-8"><input type="text" v-model="contact.firstname" class="input w-100" /></div>
                        </div>
                        <div class="grid mt-2">
                            <div class="col-4">{{ $t('lastname') }}</div>
                            <div class="col-8"><input type="text" v-model="contact.lastname" class="input w-100" /></div>
                        </div>
                        <div class="grid mt-2">
                            <div class="col-4">{{ $t('email') }}</div>
                            <div class="col-8"><input type="email" v-model="contact.email" class="input w-100" /></div>
                        </div>
                        <div class="grid mt-2">
                            <div class="col-4">{{ $t('phone') }}</div>
                            <div class="col-8"><input type="tel" v-model="contact.phone" class="input w-100" /></div>
                        </div>
                        <div class="grid mt-2">
                            <div class="col-4">{{ $t('pages.crm_contacts_details.groups') }}</div>
                            <div class="col-8"><multi-select-groups ref="multiselect_groups" :groups="groups" /></div>
                        </div>
                        <div class="grid mt-2">
                            <div class="col-4">{{ $t('country') }}</div>
                            <div class="col-8"><dropdown-country ref="dropdown_country" /></div>
                        </div>
                        <div class="grid mt-2">
                            <div class="col-4">{{ $t('tags.tags') }}</div>
                            <div class="col-8"><multi-select-tags ref="multiselect_tags" :tags="tags" /></div>
                        </div>

                        <button class="btn btn-outline-primary mt-2" @click="edit()">
                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.5833 13V20.5833H5.41667V13H3.25V20.5833C3.25 21.775 4.225 22.75 5.41667 22.75H20.5833C21.775 22.75 22.75 21.775 22.75 20.5833V13H20.5833ZM14.0833 13.7258L16.8892 10.9308L18.4167 12.4583L13 17.875L7.58333 12.4583L9.11083 10.9308L11.9167 13.7258V3.25H14.0833V13.7258Z" fill="black"/>
                            </svg>

                            <span>{{ $t('save') }}</span>
                        </button>
                    </div>

                    <div class="col-7">
                        <h4>{{ $t('pages.crm_contacts_details.companies') }}</h4>

                        <button class="btn btn-outline-primary mt-2 mb-4" @click="addCompany()">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 3C12 2.73478 11.8946 2.48043 11.7071 2.29289C11.5196 2.10536 11.2652 2 11 2C10.7348 2 10.4804 2.10536 10.2929 2.29289C10.1054 2.48043 10 2.73478 10 3V10H3C2.73478 10 2.48043 10.1054 2.29289 10.2929C2.10536 10.4804 2 10.7348 2 11C2 11.2652 2.10536 11.5196 2.29289 11.7071C2.48043 11.8946 2.73478 12 3 12H10V19C10 19.2652 10.1054 19.5196 10.2929 19.7071C10.4804 19.8946 10.7348 20 11 20C11.2652 20 11.5196 19.8946 11.7071 19.7071C11.8946 19.5196 12 19.2652 12 19V12H19C19.2652 12 19.5196 11.8946 19.7071 11.7071C19.8946 11.5196 20 11.2652 20 11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10H12V3Z" fill="#1791BA"/>
                            </svg>

                            <span>{{ $t('add') }}</span>
                        </button>

                        <div class="company-block grid mb-3" v-for="(c, k) in contact.companies" :key="c.id">
                            <div class="col-6">
                                <div class="grid">
                                    <div class="col-7">
                                        <dropdown-company :k="k" :companies="companies" />
                                    </div>

                                    <div class="col-5">
                                        <button class="btn btn-outline-danger" @click="deleteCompany(k)">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                                            </svg>

                                            <span>{{ $t('delete') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <input type="email" :placeholder="$t('email')" v-model="contact.companies[k].pivot.email" class="input w-100" />
                                <input type="text" :placeholder="$t('pages.crm_contacts_details.function')" v-model="contact.companies[k].pivot.function" class="input w-100" />
                                <input type="tel" :placeholder="$t('pages.crm_contacts_details.pro_phone')" v-model="contact.companies[k].pivot.phone" class="input w-100" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <modale-add-tag :contact_id="contact.id" />
</template>

<script>
import Actions from './details/Actions.vue'
import DropdownCompany from './details/DropdownCompany.vue'
import DropdownCountry from './details/DropdownCountry.vue'
import ModaleAddTag from './details/ModaleAddTag.vue'
import MultiSelectGroups from './details/MultiSelectGroups.vue'
import MultiSelectTags from './details/MultiSelectTags.vue'

export default {
    components: { Actions, DropdownCompany, DropdownCountry, ModaleAddTag, MultiSelectGroups, MultiSelectTags },
    data: function () {
        return {
            contact: { companies: [], groups: [], tags: [] },
            companies: [],
            groups: [],
            tags: [],
            countries: []
        }
    },
    computed: {
        contactId: function () { return this.$route.params.contact }
    },
    created: function () {
        EventBus.on('add_new_tag', (tag) => {
            if (!this.tags.some((t) => t.id === tag.id)) {
                this.tags.push(tag)
            }

            if (!this.contact.tags.includes(tag.id)) {
                this.contact.tags.push(tag.id)
            }
        })

        this.countries = this.$store.getters['i18n/get_countries']

        this.getData()
    },
    methods: {
        deleteContact: function () {
            EventBus.emit('global_confirm_dialog', {
                message: 'Are you sure you want to proceed ?',
                header: 'Confirmation',
                icon_type: 'material-icons-outlined',
                icon: 'notification_important',
                acceptLabel: 'Yes',
                rejectLabel: 'No',
                accept: () => {
                    axios.post('/crm/contacts/'+this.contactId+'/destroy')
                        .then(() => {
                            this.$toast.success(this.$t('pages.crm_contacts_details.contact_destroy_success'))

                            this.$router.push('/crm/contacts')
                        })
                        .catch((e) => {
                            this.$toast.error(this.$t('pages.crm_contacts_details.contact_destroy_error'))

                            this.checkAjaxException(e)
                        })
                },
                reject: () => {}
            })
        },
        edit: function () {
            axios.post('/crm/contacts/'+this.contactId+'/edit', {
                firstname: this.contact.firstname, lastname: this.contact.lastname, email: this.contact.email,
                phone: this.contact.phone, companies: this.contact.companies, groups: this.contact.groups,
                country: this.contact.i18n_country_id, tags: this.contact.tags
            }).then(() => {
            }).catch((e) => {
                this.checkAjaxException(e)
            })
        },
        getData: function () {
            axios.post('/crm/contacts/add_content')
                .then((res) => {
                    let data = res.data.data

                    this.companies = data.companies
                    this.groups = data.groups
                    this.tags = data.tags

                    this.getDetails()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getDetails: function () {
            this.displayLoading(true)

            axios.post('/crm/contacts/'+this.contactId+'/details')
                .then((res) => {
                    this.contact = res.data.data

                    this.$refs.dropdown_country.refreshCountry()
                    this.$refs.multiselect_groups.refreshGroups()
                    this.$refs.multiselect_tags.refreshTags()
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        addCompany: function () {
            this.contact.companies.push({ id: null, name: null, pivot: { email: null, function: null, phone: null } })
        },
        deleteCompany: function (k) {
            this.contact.companies = this.contact.companies.filter((c, i) => i != k)
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../../sass/vuejs/crm/contacts/details.sass'
</style>
