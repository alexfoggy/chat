import { getNewTasks, buttonStatus, getLanguages } from "../api/api"

const SET_NEW_TASKS = "SET_NEW_TASKS ",
    SET_BUTTON_STATUS = "SET_BUTTON_STATUS ",
    SET_LANGUAGES = 'SET_LANGUAGES '




const initialState = {
    tasks: [],
    buttonStatus: [],
    languages: []


}

export const newStatusReducer = (state = initialState, action) => {

    switch (action.type) {

        case SET_NEW_TASKS: {
            return { ...state, tasks: action.tasks }
        }
   
        case SET_BUTTON_STATUS: {
            return { ...state, buttonStatus: action.buttonStatus }
        }
        case SET_LANGUAGES :{
            return {...state, languages: action.languages}
        }

        default:
            return state
    }
}


const setNewTasks = (tasks) => ({ type: 'SET_NEW_TASKS ', tasks })
const setButtonStatus = (buttonStatus) => ({ type: 'SET_BUTTON_STATUS ', buttonStatus })
const setLanguages = (languages) => ({ type: 'SET_LANGUAGES ', languages })


export const setNewTasksTC = () => {
    return (dispatch) => {
        getNewTasks().then(res => { dispatch(setNewTasks(res.data.data)) })
        window.Echo.channel(`tasks.count`)
            .listen('TaskCounterEvent', (data) => {
                dispatch(setNewTasks(data.tasks))

            });

    }
}

export const setLanguagesTC = ()=>{
    return(dispatch)=>{
        getLanguages().then(res=>{
            dispatch(setLanguages(res.data.data))
        })
    }
}

export const setButtonStatusTC = () => {
    return (dispatch) => {
        buttonStatus().then(res => { dispatch(setButtonStatus(res.data.data)) })
        window.Echo.channel(`tasks.count`)
            .listen('TaskCounterEvent', (data) => {
                dispatch(setButtonStatus(data.count))

            });

    }
}


