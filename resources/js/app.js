import { createApp } from 'vue'

import 'tippy.js/dist/tippy.css'

import Tippy from 'vue-tippy'
import Toaster from '@meforma/vue-toaster'

import Breadcrumb from './components/ui/Breadcrumb.vue'
import Pagination from './components/ui/Pagination.vue'
import Tabs from './components/ui/Tabs.vue'

import Fail from './components/ui/state/Fail.vue'
import InProgress from './components/ui/state/InProgress.vue'
import Success from './components/ui/state/Success.vue'

import IconAdd from './components/icons/IconAdd.vue'
import IconBookmarkEmpty from './components/icons/IconBookmarkEmpty.vue'
import IconBookmarkFull from './components/icons/IconBookmarkFull.vue'
import IconClose from './components/icons/IconClose.vue'
import IconDelete from './components/icons/IconDelete.vue'
import IconEdit from './components/icons/IconEdit.vue'
import IconSave from './components/icons/IconSave.vue'

import Layout from './components/Layout.vue'
import OrderColumnIcon from './components/OrderColumnIcon.vue'

import i18n from './i18n/app'
import routes from './routes/app'
import store from './store/app'

import ajaxExceptionMixin from './mixins/ajax_exception'
import composedPathMixin from './mixins/composed_path'
import paginationMixin from './mixins/pagination'
import translationMixin from './mixins/translation'

import { EventEmitter } from 'events'
import axios from 'axios'

EventEmitter.defaultMaxListeners = 1000

window.EventBus = new EventEmitter()

window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content

var app = createApp({})

app.config.devtools = false

app.use(i18n)
app.use(routes)
app.use(store)

app.use(Tippy, { directive: 'tippy', component: 'tippy', defaultProps: { placement: 'auto-end', allowHTML: false } })
app.use(Toaster, { position: 'top-right', duration: 3000 })

app.mixin(ajaxExceptionMixin)
app.mixin(composedPathMixin)
app.mixin(paginationMixin)
app.mixin(translationMixin)

app.component('breadcrumb', Breadcrumb)
app.component('layout', Layout)
app.component('order-icon', OrderColumnIcon)
app.component('pagination', Pagination)
app.component('tabs', Tabs)

app.component('icon-fail', Fail)
app.component('icon-in-progress', InProgress)
app.component('icon-success', Success)

app.component('icon-add', IconAdd)
app.component('icon-bookmark-empty', IconBookmarkEmpty)
app.component('icon-bookmark-full', IconBookmarkFull)
app.component('icon-close', IconClose)
app.component('icon-delete', IconDelete)
app.component('icon-edit', IconEdit)
app.component('icon-save', IconSave)

app.mount('#app')

window.Vue = app
