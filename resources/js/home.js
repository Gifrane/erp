import { createApp } from 'vue'

import Home from './components/home/Home.vue'

import i18n from './i18n/home'

import translationMixin from './mixins/translation'

var app = createApp({})

app.config.devtools = false

app.use(i18n)

app.component('home', Home)

app.mixin(translationMixin)

app.mount('#app')

window.Vue = app
