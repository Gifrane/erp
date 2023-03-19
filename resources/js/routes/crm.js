export default [
    { path: '/crm', component: () => import('@/components/crm/contacts/Contacts.vue') },

    { path: '/crm/companies', component: () => import('@/components/crm/companies/Companies.vue') },
    { path: '/crm/companies/:company', component: () => import('@/components/crm/companies/Details.vue') },
    { path: '/crm/companies/:company/contacts', component: () => import('@/components/crm/companies/Contacts.vue') },

    { path: '/crm/contacts/:contact', component: () => import('@/components/crm/contacts/Details.vue') },
    { path: '/crm/contacts/:contact/datas', component: () => import('@/components/crm/contacts/DetailsDatas.vue') },

    { path: '/crm/groups', component: () => import('@/components/crm/groups/Groups.vue') },
    { path: '/crm/groups/:group', component: () => import('@/components/crm/groups/Details.vue') },
    { path: '/crm/groups/:group/contacts', component: () => import('@/components/crm/groups/Contacts.vue') },
]
