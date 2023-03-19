<template>
    <div class="sidebar-wrapper" v-if="$parent.visibleAdd">
        <div class="sidebar" role="complementary" v-click-outside="outside">
            <div class="sidebar-header">
                <div class="sh-title">{{ $t('pages.crm_contacts.add_contact') }}</div>

                <div class="sh-close" @click="outside">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 9.4L22.6 8L16 14.6L9.4 8L8 9.4L14.6 16L8 22.6L9.4 24L16 17.4L22.6 24L24 22.6L17.4 16L24 9.4Z" fill="black"/>
                    </svg>
                </div>
            </div>

            <div class="sidebar-body">
                <div class="grid mt-3">
                    <div class="col-4">{{ $t('firstname') }}</div>
                    <div class="col-8"><input type="text" v-model="add.firstname" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('lastname') }}</div>
                    <div class="col-8"><input type="text" v-model="add.lastname" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('email') }}</div>
                    <div class="col-8"><input type="email" v-model="add.email" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('phone') }}</div>
                    <div class="col-8"><input type="tel" v-model="add.phone" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('country') }}</div>
                    <div class="col-8"><dropdown-country /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.crm_contacts.companies') }}</div>
                    <div class="col-8"><multi-select-companies :companies="companies" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.crm_contacts.groups') }}</div>
                    <div class="col-8"><multi-select-groups :groups="groups" /></div>
                </div>

                <button class="btn btn-success" @click="addContact()">
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

import DropdownCountry from './add_contact/DropdownCountry.vue'
import MultiSelectCompanies from './add_contact/MultiSelectCompanies.vue'
import MultiSelectGroups from './add_contact/MultiSelectGroups.vue'

export default {
    components: { DropdownCountry, MultiSelectCompanies, MultiSelectGroups },
    directives: { clickOutside: vClickOutside.directive },
    data: function () {
        return {
            companies: [],
            groups: [],

            add: {
                firstname: null, lastname: null, email: null, companies: [], groups: [], country: null, phone: null
            }
        }
    },
    created: function () {
        this.getCompaniesGroups()
    },
    methods: {
        addContact: function () {
            axios.post('/crm/contacts/add', this.add)
                .then((res) => {
                    this.$router.push('/crm/contacts/'+res.data.data)
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        getCompaniesGroups: function () {
            axios.post('/crm/contacts/add_content')
                .then((res) => {
                    let data = res.data.data

                    this.companies = data.companies
                    this.groups = data.groups
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        },
        outside: function () {
            this.$parent.visibleAdd = false
        }
    }
}
</script>
