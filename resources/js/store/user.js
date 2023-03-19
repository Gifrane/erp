// State
var modules = []
var user = {}

// Getters
function get_modules (state) {
    return state.modules
}

function get_user (state) {
    return state.user
}

// Mutations
function load_modules (state, modules) {
    state.modules = modules
}

function load_user (state, user) {
    state.user = user
}

function set_lang (state, lang) {
    state.user.lang = lang
}

// Export
export const stateUser = { modules, user }
export const gettersUser = { get_modules, get_user }
export const mutationsUser = { load_modules, load_user, set_lang }
