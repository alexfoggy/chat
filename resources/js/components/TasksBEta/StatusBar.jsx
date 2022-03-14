import React, { Component } from 'react'
import { NavLink } from 'react-router-dom'
import './Tabs.css'


class StatusBar extends Component {
    render() {
            return (
                <nav className="tabs ">
                    {this.props.all.map((s, idx)=>
                    <NavLink key={idx} to={`/cabinet/tasks/${s.filter}`}><span>{s.count}</span>{s.name}</NavLink>
                    )}
                    {/* <NavLink to='/cabinet/tasks/new'><span>2</span>New</NavLink> 
                    <NavLink to='/cabinet/tasks/claimed'><span>2</span>Claimed</NavLink> 
                     <NavLink to='/cabinet/tasks/in_progress'><span>2</span>In progress</NavLink> */}
                </nav>

        )
    }
}

export default StatusBar