import React from 'react'
import '../../../../../../public/ui/components/task.css';
import { NavLink } from 'react-router-dom'
import ReactAudioPlayer from 'react-audio-player';
const styles = {
    a: {
        display: 'flex',
        alignItems: 'center',
        background: '#E22A7F',
        color: 'white',
        fontSize: '16px'
    },
    navLink: {
        display: 'flex',
        alignItems: 'center',
        background: '#303094',
        color: 'white',
        fontSize: '16px'
    },
    task: {
        width: '100%'
    }
}


export default function Delivered(props) {
    return (
        <>
            {props.delivered.map((n) =>
                <div key={n.id} className="task" style={{ width: '100%' }}>
                    <small className="price">${n.budget}</small>
                    <small className="type"><i className="flaticon-microphone-1"></i> {n.project.type}</small>
                    <small className="language">{n.language.name}</small>
                    <small className="length"> {n.project.minutes_per_tasks}min</small>
                    <small className="deadline">{n.complete_deadline} </small>
                    <div className="buttons">
                        {n.records !== null ?
                            <div className="d-flex align-items-center">
                                <ReactAudioPlayer style={{marginRight: '10px'}} controls src={n.records !== null ? n.records.path : '/'} />
                                <NavLink
                                    style={{ display: 'flex', alignItems: 'center', background: '#E22A7F', color: 'white', fontSize: '16px' }}
                                    onClick={() => props.SendTasks(n.id, "checked")} to={`/cabinet/tasks/new`}>Send</NavLink>
                            </div> : <NavLink style={styles.a} to={`/cabinet/tasks/in_progress${n.id}`} className="delivered"><i
                                className="flaticon-add"></i> Start</NavLink>}
                        {/* <NavLink
                            style={{ display: 'flex', alignItems: 'center', background: '#E22A7F', color: 'white', fontSize: '16px' }}
                            onClick={() => props.SendTasks(n.id, "ready_to_invoice")} to={`/cabinet/tasks/ready_to_invoice`}>Send</NavLink> */}
                    </div>
                </div>
            )}
        </>
    )
}
