import { getInProgressTasks } from "../api/api"

const SET_IN_PROGRESS = 'SET_IN_PROGRESS'

const initialState = {
    inProgress: []
}


export const inProgressReducer = (state = initialState, action) => {

    switch (action.type) {
        case SET_IN_PROGRESS: {
            return { ...state, inProgress: action.inProgress }
        }
        default:
            return state
    }

}
const setInProgressTasks = (inProgress) => ({ type: 'SET_IN_PROGRESS', inProgress })

export const setInProgressTasksTC = () => {
    return (dispatch) => {
        getInProgressTasks().then(res => {
             dispatch(setInProgressTasks(res.data.data)) })

    }
}