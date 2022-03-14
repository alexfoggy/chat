import {
    getUser,
    getLanguages,
    getUsers,
    getProjects,
    getTasksCompleted
} from "../api/api";

const SET_USER = 'SET_USER ',
    SET_USERS = 'SET_USERS',
    SET_LANGUAGES = 'SET_LANGUAGES',
    SET_PROJECTS = 'SET_PROJECTS',
    SET_TASKS_COMPLETED = 'SET_TASKS_COMPLETED'

const initialState = {
    user: {},
    users: [],
    languages: [],
    projects: [],
    tasksCompleted: []
}

export const ManagerReducer = (state = initialState, action) => {

    switch (action.type) {

        case SET_USER:
            return { ...state, user: action.user }

        case SET_USERS:
            return { ...state, users: action.users }

        case SET_LANGUAGES:
            return { ...state, languages: action.languages }

        case SET_PROJECTS:
            return { ...state, projects: action.projects }

        case SET_TASKS_COMPLETED:
            return { ...state, tasksCompleted: action.tasksCompleted }
        default:
            return state
    }
}


const SetUser = (user) => ({ type: SET_USER, user })
const SetUsers = (users) => ({ type: SET_USERS, users })
const SetLanguages = (languages) => ({ type: SET_LANGUAGES, languages })
const SetProjects = (projects) => ({ type: SET_PROJECTS, projects })
const SetTasksCompleted = (tasksCompleted) => ({ type: SET_TASKS_COMPLETED, tasksCompleted })

export const SetUserTC = () => {
    return (dispatch) => {
        getUser().then(res => {
            dispatch(SetUser(res.data.data))
        })
    }

}

export const SetUsersTC = () => {
    return (dispatch) => {
        getUsers().then(res => {
            dispatch(SetUsers(res.data.data))
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


export const SetProjectsTC = () => {
    return (dispatch) => {
        getProjects().then(res => {
            dispatch(SetProjects(res.data))
        })
    }

}
export const SetTasksCompletedTC = () => {
    return (dispatch) => {
        getTasksCompleted().then((res) => {
            dispatch(SetTasksCompleted(res.data.data))
        })
    }

}