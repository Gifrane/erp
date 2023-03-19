// State
var collective_agreements = []
var contract_types = []

// Getters
function get_collective_agreements (state) {
    return state.collective_agreements
}

function get_contract_types (state) {
    return state.contract_types
}

// Mutations
function load_collective_agreements (state, collective_agreements) {
    state.collective_agreements = collective_agreements
}

function load_contract_types (state, contract_types) {
    state.contract_types = contract_types
}

// Export
export const stateEmployee = {
    collective_agreements, contract_types
}

export const gettersEmployee = {
    get_collective_agreements, get_contract_types
}

export const mutationsEmployee = {
    load_collective_agreements, load_contract_types
}