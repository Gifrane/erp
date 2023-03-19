import { createStore } from 'vuex'

import { stateCrmContactsSearch, gettersCrmContactsSearch, mutationsCrmContactsSearch } from './crm/contacts/search'

import { stateI18n, gettersI18n, mutationsI18n } from './i18n'

import { stateUser, gettersUser, mutationsUser } from './user'

export default createStore({
    modules: {
        crm: {
            namespaced: true,
            modules: {
                contacts: {
                    namespaced: true,
                    modules: {
                        search: {
                            namespaced: true,
                            state: stateCrmContactsSearch,
                            getters: gettersCrmContactsSearch,
                            mutations: mutationsCrmContactsSearch,
                        },
                    },
                },
            },
        },
        i18n: {
            namespaced: true,
            state: stateI18n,
            getters: gettersI18n,
            mutations: mutationsI18n,
        },
        user: {
            namespaced: true,
            state: stateUser,
            getters: gettersUser,
            mutations: mutationsUser,
        },
    }
})
