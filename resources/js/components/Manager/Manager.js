import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter} from "react-router-dom";
import { Provider } from 'react-redux'
import { store } from "../../redux/redux-store";
import ManagerContainer from "./ManagerContainer";



class Manager extends React.Component {
    render() {
        return (
            <>
                <ManagerContainer/>
            </>
        );
    }
}
export default Manager;
if (document.getElementById('app')) {
    ReactDOM.render(
        <BrowserRouter>
            <Provider store={store}>
                <Manager />
            </Provider>
        </BrowserRouter>, document.getElementById('app'));
}
