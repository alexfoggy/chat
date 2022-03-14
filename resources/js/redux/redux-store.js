import {createStore, combineReducers, applyMiddleware} from "redux";
import  thunkMiddleware from 'redux-thunk'
import { newStatusReducer } from "./new-reducer";
import { cabinetReduser } from "./cabinet-reducer";
import { inProgressReducer } from "./inProgress-reducer";
import { readyReducer } from "./ready-to-invoice";
import {ManagerReducer} from './manager-reducer'


let reducers = combineReducers({
    newStatusPage: newStatusReducer,
    inProgressStatusPage: inProgressReducer,
    invoice: readyReducer,
    cabinet: cabinetReduser,
    manager: ManagerReducer

})


 export let store = createStore(reducers, applyMiddleware(thunkMiddleware))
        