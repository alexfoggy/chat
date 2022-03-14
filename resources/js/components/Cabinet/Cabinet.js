import React from "react";
import ReactDOM from 'react-dom';
import { BrowserRouter } from "react-router-dom";
import { Provider } from 'react-redux'
import { store } from "../../redux/redux-store";
import CabinetContainer from "./CabinetContainer";

export default function Cabinet() {
    return (
        <div className='row'>
            <CabinetContainer />
        </div>
    )
}




if (document.getElementById('app')) {
    ReactDOM.render(
        <BrowserRouter>
            <Provider store={store}>
                <Cabinet />
            </Provider>
        </BrowserRouter>, document.getElementById('app'));
}
