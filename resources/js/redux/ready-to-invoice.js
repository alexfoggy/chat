const SET_TASKS = 'SET_TASKS'
import { getReadytoInvoiceTasks } from '../api/api'


const initialState = {
    ready: []
}

export const readyReducer = (state = initialState, action) => {

    switch (action.type) {
        case SET_TASKS:
            return { ...state, ready: action.ready }
        default:
            return state
    }

}

const readyTasksAC = (ready) =>({type: SET_TASKS, ready})

export const readyTasksTC = ()=>{
    return(dispatch)=>{
       getReadytoInvoiceTasks().then(res =>{
            dispatch(readyTasksAC(res.data.data))
        })
    }
}