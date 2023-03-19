export default [
    { path: '/user/profile/:user', component: () => import('@/components/user/Profile.vue') },
    { path: '/user/settings', component: () => import('@/components/user/Settings.vue') }
]
