import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter} from "react-router-dom";
import {Provider} from 'react-redux'
import {store} from "../../redux/redux-store";
import SideBar from '../Admin/SideBar';

class Admin extends React.Component {
    render() {
        return (
            <div>
                <SideBar/>
            </div>
        );
    }
}
export default Admin;
if (document.getElementById('app')) {
    ReactDOM.render(
        <BrowserRouter>
            <Provider store={store}>
                <Admin/>
            </Provider>
        </BrowserRouter>, document.getElementById('app'));
}
