import React from "react";
import { NavLink } from "react-router-dom";
import User from "../Cabinet/User/User";
import logo from '../../../../public/assets/img/logo_main.svg'
import './sidebar.scss'
const SideBar = (props) => {
    return (
        <aside className="main-navigation">
            <nav>
                <div className='d-flex align-items-center justify-content-between'>
                    <NavLink to="/manager/information" className="logo"> <img src={logo} alt="" /></NavLink>
                    <a href="#" title='Notifications' className='notification'>
                        <i className='flaticon-bell'></i>
                        <span className='status'></span>
                    </a>
                </div>
                <div>Admin</div>
                <div className="navigation-section">
                    <ul>
                        <li>
                            <NavLink to="/admin">
                                <i className="flaticon-speedometer" />Create Project</NavLink>
                        </li>
                    </ul>
                </div>
                <div className="navigation-section">
                    <a href="#" className="user-avatar">
                        <img src="" alt="" />
                    </a>
                </div>
            </nav>
            {/* <User user={props.user} /> */}
        </aside>
    )
}

export default SideBar
