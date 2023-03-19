import { createApp } from 'vue'

import ProcessEnableAccount from './components/user/ProcessEnableAccount.vue'

import i18n from './i18n/app'

import loadingMixin from './mixins/loading'
import translationMixin from './mixins/translation'

var app = createApp({})

app.config.devtools = false

app.use(i18n)

app.mixin(loadingMixin)
app.mixin(translationMixin)

app.component('process-enable-account', ProcessEnableAccount)

app.mount('#app')

window.Vue = app
