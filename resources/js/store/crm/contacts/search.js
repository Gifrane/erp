// State
var filters = []
var iteration = 0

// Getters
function get_filters (state) {
    return state.filters
}

function get_iteration (state) {
    return state.iteration
}

// Mutations
function add_filter (state, filter) {
    state.filters.push(filter)
}

function increment_iteration (state) {
    state.iteration++
}

// Export
export const stateCrmContactsSearch = { filters, iteration }
export const gettersCrmContactsSearch = { get_filters, get_iteration }
export const mutationsCrmContactsSearch = { add_filter, increment_iteration }
