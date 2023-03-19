export default [
    { path: '/shop', component: () => import('@/components/shop/Dashboard.vue') },

    { path: '/shop/admin', component: () => import('@/components/shop/Admin.vue') },

    { path: '/shop/gestion', component: () => import('@/components/shop/Gestion.vue') },

    { path: '/shop/gestion/categories', component: () => import('@/components/shop/GestionCategories.vue') },
    { path: '/shop/gestion/categories/:category', component: () => import('@/components/shop/gestion/category/Details.vue') },

    { path: '/shop/gestion/products', component: () => import('@/components/shop/gestion/product/Products.vue') },
    { path: '/shop/gestion/products/:product', component: () => import('@/components/shop/gestion/product/Details.vue') }
]
