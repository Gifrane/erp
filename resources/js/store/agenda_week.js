// State
var current_year = null
var current_month = null
var current_day = null

var loaded_year = null
var loaded_month = null
var loaded_day = null

var cols_days_array = []
var cols_days = {}

var periods = []

var agendas = []

var events = {}

var add_sidebar_date = null

var enable_mouse_down_event = false

var mouseDownEvent = null

var bottomSelectBase = null

// Getters
function get_events (state) {
    return (day) => {
        return (day in state.events) ? state.events[ day ] : []
    }
}

function get_bottom_select_base (state) {
    return state.bottomSelectBase
}

function get_mouse_down_event (state) {
    return state.mouseDownEvent
}

function get_add_sidebar_date (state) {
    return state.add_sidebar_date
}

function get_current_year (state) {
    return state.current_year
}

function get_current_month (state) {
    return state.current_month
}

function get_current_day (state) {
    return state.current_day
}

function get_agendas (state) {
    return state.agendas
}

function get_loaded_year (state) {
    return state.loaded_year
}

function get_loaded_month (state) {
    return state.loaded_month
}

function get_loaded_day (state) {
    return state.loaded_day
}

function get_cols_days (state) {
    return state.cols_days
}

function get_cols_days_array (state) {
    return state.cols_days_array
}

function get_periods (state) {
    return state.periods
}

function get_enable_mouse_down_event (state) {
    return state.enable_mouse_down_event
}

function get_event (state) {
    return (params) => {
        return state.events[ params.day ].find((e) => e.id = params.event_id)
    }
}

// Mutations
function load_events (state, events) {
    state.events = events
}

function set_bottom_select_base (state, position) {
    state.bottomSelectBase = position
}

function set_mouse_down_event (state, event) {
    state.mouseDownEvent = event
}

function set_add_sidebar_date (state, params) {
    state.add_sidebar_date = params
}

function set_current_year (state, year) {
    state.current_year = year
}

function set_current_month (state, month) {
    state.current_month = month
}

function set_current_day (state, day) {
    state.current_day = day
}

function set_agendas (state, agendas) {
    state.agendas = agendas
}

function set_loaded_year (state, year) {
    state.loaded_year = year
}

function set_loaded_month (state, month) {
    state.loaded_month = month
}

function set_loaded_day (state, day) {
    state.loaded_day = day
}

function set_cols_days (state, cols_days) {
    state.cols_days = cols_days
}

function set_cols_days_array (state, cols_days_array) {
    for (let c in cols_days_array) {
        state.cols_days_array[c] = cols_days_array[c]
    }
}

function set_periods (state, periods) {
    state.periods = periods
}

function set_enable_mouse_down_event (state, enable) {
    state.enable_mouse_down_event = enable
}

function add_event_on_day (state, params) {
    if (!(params.day in state.events)) {
        state.events[ params.day ] = []
    }

    state.events[ params.day ].push(params.event)
}

function update_agenda_event (state, params) {
    if (params.day in state.events) {
        for (let e of state.events[ params.day ]) {
            if (e.id === params.event) {
                e.agenda_id = params.agenda

                break
            }
        }
    }
}

// Export
export const stateAgendaWeek = {
    events, add_sidebar_date, mouseDownEvent, bottomSelectBase, current_year, current_month, current_day, agendas,
    loaded_year, loaded_month, loaded_day, cols_days, cols_days_array, periods, enable_mouse_down_event
}

export const gettersAgendaWeek = {
    get_events, get_add_sidebar_date, get_mouse_down_event, get_bottom_select_base, get_current_year, get_current_month,
    get_current_day, get_agendas, get_loaded_year, get_loaded_month, get_loaded_day, get_cols_days, get_cols_days_array,
    get_periods, get_enable_mouse_down_event, get_event
}

export const mutationsAgendaWeek = {
    load_events, set_add_sidebar_date, set_mouse_down_event, set_bottom_select_base, set_current_year, set_current_month,
    set_current_day, set_agendas, set_loaded_year, set_loaded_month, set_loaded_day, set_cols_days, set_cols_days_array,
    set_periods, set_enable_mouse_down_event, add_event_on_day, update_agenda_event
}
