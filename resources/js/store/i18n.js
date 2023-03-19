// State
var countries = []
var langs = []
var timezones = []

var currentTimezone = null

// Getters
function get_countries (state) {
    return state.countries
}

function get_current_timezone (state) {
    return state.currentTimezone
}

function get_langs (state) {
    return state.langs
}

function get_timezones (state) {
    return state.timezones
}

// Mutations
function load_countries (state, countries) {
    state.countries = countries
}

function load_current_timezone (state, currentTimezone) {
    state.currentTimezone = currentTimezone
}

function load_langs (state, langs) {
    state.langs = langs
}

function load_timezones (state, timezones) {
    state.timezones = timezones
}

// Export
export const stateI18n = { countries, currentTimezone, langs, timezones }
export const gettersI18n = { get_countries, get_current_timezone, get_langs, get_timezones }
export const mutationsI18n = { load_countries, load_current_timezone, load_langs, load_timezones }
