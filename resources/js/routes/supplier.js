export default [
    { path: '/supplier', component: () => import('@/components/supplier/Suppliers.vue') },
    { path: '/supplier/:supplier', component: () => import('@/components/supplier/Details.vue') },
]
