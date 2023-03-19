export default [
    {
        path: '/tchat',
        component: () => import('@/components/tchat/Tchat.vue'),
        children: [
            { path: '', component: () => import('@/components/tchat/Home.vue') },
            { path: 'room/:id', name: 'tchat.room', component: () => import('@/components/tchat/Room.vue') }
        ]
    }
]
