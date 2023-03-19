export default {
    methods: {
        getCountryName: function (countryId) {
            let countries = this.$store.getters['i18n/get_countries']

            for (let c of countries) {
                if (c.id === countryId) {
                    return c.name
                }
            }

            return ''
        },
        loadTranslations: function (translations) {
            if ('en' in translations) {
                this.$i18n.messages.en = translations.en
            }

            if ('fr' in translations) {
                this.$i18n.messages.fr = translations.fr
            }
        }
    }
}
