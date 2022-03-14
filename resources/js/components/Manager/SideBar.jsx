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
                <div>Manager</div>
                <div className="navigation-section">
                    <ul>
                        <li>
                            <NavLink to="/manager/step1">
                                <i className="flaticon-document" />Create Project</NavLink>
                        </li>
                        <li>
                            <NavLink to="/manager/project">
                                <i className="flaticon-folder" /> Projects</NavLink>
                        </li>
                        <li>
                            <NavLink to="/manager/project_completed">
                                <i className="flaticon-confirmation" /> Tasks Completed</NavLink>
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
