export default [
    { path: '/admin/api_keys', component: () => import('@/components/admin/ApiKeys.vue') },

    { path: '/admin/users', component: () => import('@/components/admin/users/Users.vue') },

    { path: '/admin/users/companies', component: () => import('@/components/admin/users/companies/Companies.vue') },

    { path: '/admin/users/groups', component: () => import('@/components/admin/users/groups/Groups.vue') },

    { path: '/admin/users/:user', component: () => import('@/components/admin/users/Details.vue') },
    { path: '/admin/users/:user/modules', component: () => import('@/components/admin/users/DetailsModules.vue') }
]
