export default [
    { path: '/product', component: () => import('@/components/product/Products.vue') },
    { path: '/product/:product', component: () => import('@/components/product/Details.vue') },
    { path: '/product/:product/options', component: () => import('@/components/product/DetailsOptions.vue') },
    { path: '/product/:product/sales_history', component: () => import('@/components/product/DetailsSalesHistory.vue') },
    { path: '/product/:product/spare_parts', component: () => import('@/components/product/DetailsSpareParts.vue') }
]
