import {
    getUser,
    getNewTasks,
    getInProgressTasks,
    getDeliveredTasks,
    getReadytoInvoiceTasks,
    getInvoiceTasks,
    buttonStatus,
    getLanguages,
    getCountries
} from '../api/api'

const SET_USER = 'SET_USER',
    SET_NEW_TASKS = 'SET_NEW_TASKS',
    SET_LANGUAGES = 'SET_LANGUAGES',
    SET_COUNTRIES = 'SET_COUNTRIES',
SET_IN_PROGRESS = 'SET_IN_PROGRESS',
    SET_DELIVERED = 'SET_DELIVERED',
    SET_READY_TO_INVOICE = 'SET_READY_TO_INVOICE',
    SET_BUTTONS = 'SET_BUTTONS',
    SET_BUTTON_STATUS = 'SET_BUTTON_STATUS',
    SET_INVOICES = 'SET_INVOICES'

const initialState = {
    user: {},
    newTasks: [],
    inProgress: [],
    delivered: [],
    readyToInvoice: [],
    invoices: [],
    buttons: [],
    status: '',
    languages: [],
    countries: [],
}


export const cabinetReduser = (state = initialState, action) => {

    switch (action.type) {

        case SET_USER:
            return { ...state, user: action.user }

        case SET_NEW_TASKS:
            return { ...state, newTasks: action.newTasks }

        case SET_IN_PROGRESS:
            return { ...state, inProgress: action.inProgress }

        case SET_DELIVERED:
            return { ...state, delivered: action.delivered }

        case SET_READY_TO_INVOICE:
            return { ...state, readyToInvoice: action.readyToInvoice }

        case SET_INVOICES:
            return { ...state, invoices: action.invoices }

        case SET_BUTTONS:
            return { ...state, buttons: action.buttons }

        case SET_BUTTON_STATUS:
            return { ...state, status: action.status }

        case SET_LANGUAGES:
            return { ...state, languages: action.languages }

            case SET_COUNTRIES:
                return{...state, countries: action.countries}

        default:
            return state
    }

}

const SetUser = (user) => ({ type: SET_USER, user })
const SetNewTasks = (newTasks) => ({ type: SET_NEW_TASKS, newTasks })
const SetInProgressTasks = (inProgress) => ({ type: SET_IN_PROGRESS, inProgress })
const SetDeliveredTasks = (delivered) => ({ type: SET_DELIVERED, delivered })
const SetReadyToInvoiceTasks = (readyToInvoice) => ({ type: SET_READY_TO_INVOICE, readyToInvoice })
const SetInvoices = (invoices) => ({ type: SET_INVOICES, invoices })
const SetButtons = (buttons) => ({ type: SET_BUTTONS, buttons })
const SetButtonStatus = (status) => ({ type: SET_BUTTON_STATUS, status })
const SetLanguages = (languages) => ({ type: SET_LANGUAGES, languages })
const SetCountries = (countries) => ({ type: SET_COUNTRIES, countries })




export const SetUserTC = () => {
    return (dispatch) => {
        getUser().then(res => {
            dispatch(SetUser(res.data.data))
        })
    }
}

export const SetNewTasksTC = () => {
    return (dispatch) => {
        getNewTasks().then(res => {
            dispatch(SetNewTasks(res.data.data))
        })
    }
}
export const SetInProgressTasksTC = () => {
    return (dispatch) => {
        getInProgressTasks().then(res => {
            dispatch(SetInProgressTasks(res.data.data))
        })
    }
}



export const SetDeliveredTasksTC = () => {
    return (dispatch) => {
        getDeliveredTasks().then(res => {
            dispatch(SetDeliveredTasks(res.data.data))
        })
    }
}

export const SetReadyToInvoiceTasksTC = () => {
    return (dispatch) => {
        getReadytoInvoiceTasks().then(res => {
            dispatch(SetReadyToInvoiceTasks(res.data.data))
        })
    }
}

export const SetInvoicesTC = () => {
    return (dispatch) => {
        getInvoiceTasks().then(res => {
            dispatch(SetInvoices(res.data.data))
        })
    }
}

export const SetButtonsTC = () => {
    return (dispatch) => {
        buttonStatus().then(res => {
            dispatch(SetButtons(res.data.data))
        })
    }
}

export const SetButtonStatusTC = () => {
    return (dispatch) => {
        buttonStatus().then(res => {
            dispatch(SetButtonStatus(res.data.data[0].filter))
        })
    }
}

export const SetLanguagesTC = () => {
    return (dispatch) => {
        getLanguages().then(res => {
            dispatch(SetLanguages(res.data.data))
        })
    }
}
export const SetCountriesTC = () => {
    return (dispatch) => {
        getCountries().then(res => {
            dispatch(SetCountries(res.data))
        })
    }
}
export const Echo = () => {
    return (dispatch) => {
        window.Echo.channel(`tasks.count`)
            .listen('TaskCounterEvent', (data) => {
                dispatch(SetNewTasks(data.tasks))
                dispatch(SetButtons(data.count))
                dispatch(SetButtonStatus(data.count[0].filter))
            });
    }
}