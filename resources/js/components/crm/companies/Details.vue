<template>
    <div class="company-details">
        <div class="tabs">
            <router-link :to="'/crm/companies/'+companyId" class="active">{{ $t('details') }}</router-link>
            <router-link :to="'/crm/companies/'+companyId+'/contacts'">{{ $t('pages.crm_companies_details.contacts') }}</router-link>
        </div>

        <div class="details-body">
            <actions />

            <div class="details-body-details">
                <div class="grid">
                    <div class="col-4">{{ $t('name') }}</div>
                    <div class="col-8"><input type="text" v-model="company.name" class="input w-100" /></div>
                </div>

                <div class="divider"></div>

                <div class="grid mt-2">
                    <div class="col-4">{{ $t('country') }}</div>
                    <div class="col-8"><dropdown-country ref="dropdown_country" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('city') }}</div>
                    <div class="col-8"><input type="text" v-model="company.city" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.crm_companies_details.postal_address') }}</div>
                    <div class="col-8"><input type="text" v-model="company.postal_address" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.crm_companies_details.postal_code') }}</div>
                    <div class="col-8"><input type="text" v-model="company.postal_code" class="input w-100" /></div>
                </div>

                <div class="divider"></div>

                <div class="grid mt-2">
                    <div class="col-4">{{ $t('website') }}</div>
                    <div class="col-8"><input type="text" v-model="company.website" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.crm_companies_details.employee_interval') }}</div>
                    <div class="col-8"><dropdown-interval-employee ref="dropdown_interval" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('pages.crm_companies_details.annual_revenues') }}</div>
                    <div class="col-8"><input type="number" v-model="company.annual_revenues" class="input w-100" /></div>
                </div>
                <div class="grid mt-2">
                    <div class="col-4">{{ $t('description') }}</div>
                    <div class="col-8"><textarea v-model="company.description" class="input w-100"></textarea></div>
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
        </div>
    </div>

    <modale-add-tag />
</template>

<script>
import Actions from './details/Actions.vue'
import DropdownCountry from './details/DropdownCountry.vue'
import DropdownIntervalEmployee from './details/DropdownIntervalEmployee.vue'
import ModaleAddTag from './details/ModaleAddTag.vue'
import MultiSelectTags from './details/MultiSelectTags.vue'

export default {
    components: { Actions, DropdownCountry, DropdownIntervalEmployee, ModaleAddTag, MultiSelectTags },
    data: function () {
        return {
            company: { tags: [] },
            tags: []
        }
    },
    computed: {
        companyId: function () { return this.$route.params.company }
    },
    created: function () {
        EventBus.on('add_new_tag', (tag) => {
            if (!this.tags.some((t) => t.id === tag.id)) {
                this.tags.push(tag)
            }

            if (!this.company.tags.includes(tag.id)) {
                this.company.tags.push(tag.id)
            }
        })

        this.getDetails()
    },
    methods: {
        edit: function () {
            axios.post('/crm/companies/'+this.companyId+'/edit', {
                name: this.company.name, country: this.company.i18n_country_id, interval: this.company.interval_employee,
                city: this.company.city, website: this.company.website, annual_revenues: this.company.annual_revenues,
                description: this.company.description, postal_address: this.company.postal_address,
                postal_code: this.company.postal_code
            }).then(() => {
            }).catch((e) => {
                this.checkAjaxException(e)
            })
        },
        getDetails: function () {
            axios.post('/crm/companies/'+this.companyId+'/details')
                .then((res) => {
                    this.company = res.data.data

                    this.$refs.dropdown_country.refreshCountry(this.company.i18n_country_id)
                    this.$refs.dropdown_interval.refreshInterval(this.company.interval_employee)
                })
                .catch((e) => {
                    this.checkAjaxException(e)
                })
        }
    }
}
</script>

<style lang="sass" scoped>
@import '../../../../sass/vuejs/crm/companies/details.sass'
</style>
