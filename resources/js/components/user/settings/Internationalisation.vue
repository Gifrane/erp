<template>
    <div class="tab">
        <div class="tab-part-country">
            <div class="country-title">{{ $t('country') }}</div>

            <div class="country-select-wrapper">
                <dropdown-country ref="dropdown_country" />
            </div>
        </div>

        <div class="tab-part-lang">
            <div class="lang-title">{{ $t('lang') }}</div>

            <div class="lang-select-wrapper">
                <dropdown-lang ref="dropdown_lang" />
            </div>
        </div>

        <div class="tab-part-timezone">
            <div class="timezone-title">{{ $t('timezone') }}</div>

            <div class="timezone-select-wrapper">
                <dropdown-timezone ref="dropdown_timezone" />
            </div>
        </div>

        <button class="btn btn-outline-primary mt-2" @click="save()">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.5833 13V20.5833H5.41667V13H3.25V20.5833C3.25 21.775 4.225 22.75 5.41667 22.75H20.5833C21.775 22.75 22.75 21.775 22.75 20.5833V13H20.5833ZM14.0833 13.7258L16.8892 10.9308L18.4167 12.4583L13 17.875L7.58333 12.4583L9.11083 10.9308L11.9167 13.7258V3.25H14.0833V13.7258Z" fill="black"/>
            </svg>

            <span>{{ $t('save') }}</span>
        </button>
    </div>
</template>

<script>
import DropdownCountry from './internalisation/DropdownCountry.vue'
import DropdownLang from './internalisation/DropdownLang.vue'
import DropdownTimezone from './internalisation/DropdownTimezone.vue'

export default {
    components: { DropdownCountry, DropdownLang, DropdownTimezone },
    props: [ 'country_origin', 'lang_origin', 'timezone_origin' ],
    data: function () {
        return {
            country: null,
            timezone: null,
            lang: null
        }
    },
    created: function () {
        this.country = this.country_origin
        this.timezone = this.timezone_origin
        this.lang = this.lang_origin
    },
    mounted: function () {
        this.$refs.dropdown_country.refreshCountry()
        this.$refs.dropdown_lang.refreshLang()
        this.$refs.dropdown_timezone.refreshTimezone()
    },
    methods: {
        save: function () {
            axios.post('/user/settings/update/i18n', {
                country: this.country, timezone: this.timezone, lang: this.lang
            }).then((res) => {
                let data = res.data.data

                this.$i18n.messages[ this.lang ] = data.translations
                this.$i18n.locale = this.lang
            }).catch((e) => {
                this.checkAjaxException(e)
            })
        }
    }
}
</script>
