import { createRouter, createWebHistory } from 'vue-router'

import accounting from './accounting'
import admin from './admin'
import api_docs from './api_docs'
import crm from './crm'
import dashboard from './dashboard'
import explorer from './explorer'
import product from './product'
import supplier from './supplier'
import user from './user'

export default createRouter({
    history: createWebHistory(),
    routes: [
        ...accounting,
        ...admin,
        ...api_docs,
        ...crm,
        ...dashboard,
        ...explorer,
        ...product,
        ...supplier,
        ...user,
    ]
})
