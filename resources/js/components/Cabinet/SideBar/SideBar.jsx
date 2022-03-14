import React from "react";
import { NavLink } from "react-router-dom";
import User from "../User/User";
import logo from '../../../../../public/assets/img/logo_main.svg'
import './sidebar.scss'
const SideBar = (props) => {
    return (
        <aside className="main-navigation">
            <nav>
                <div className='d-flex align-items-center justify-content-between'>
                    <NavLink to="/cabinet/information" className="logo"> <img src={logo} alt="" /></NavLink>
                    <a href="#" title='Notifications' className='notification'>
                        <i className='flaticon-bell'></i>
                        <span className='status'></span>
                    </a>
                </div>
                <div className="navigation-section">
                    <ul>
                        <li>
                            <NavLink to="/cabinet/information">
                                <i className="flaticon-file" />Profile</NavLink>
                        </li>
                        <li>
                            <NavLink to="/cabinet/invoices">
                                <i className="flaticon-dollar-1" />Invoices</NavLink>
                        </li>
                        <li>
                            <NavLink to={`/cabinet/tasks/${props.status === '' ? 'new' : props.status}`} >
                                <i className="flaticon-audio-file" />Tasks</NavLink>
                        </li>

                    </ul>
                </div>
                <div className="navigation-section">
                    <a href="#" className="user-avatar">
                        <img src="" alt="" />
                    </a>
                </div>
            </nav>
            <User user={props.user} />
        </aside>
    )
}

export default SideBar
