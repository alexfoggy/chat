import React from 'react'
import ReactAudioPlayer from 'react-audio-player';
import { NavLink } from 'react-router-dom'

import '../../../../../../public/ui/components/task.css';

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

export default function InProgress(props) {
    return (
        <div>
            {props.tasks.map((n) =>
                <div key={n.id} className="task" style={styles.task}>
                    <div>
                    <small className="price">${n.budget}</small>
                    </div>
                    <small className="type"><i className="flaticon-microphone-1"></i> {n.project.type}</small>
                    <small className="language">{n.language.name}</small>
                    <small className="length"> {n.project.minutes_per_tasks}min</small>
                    <span>
                        <small className="deadline">{n.complete_deadline} </small>
                    </span>
                    <div className="buttons">
                    <NavLink style={styles.a} to={`/cabinet/tasks/in_progress${n.id}`} className="delivered"><i
                                className="flaticon-add"></i> Start</NavLink>
                        {/* <NavLink
                            style={{ display: 'flex', alignItems: 'center', background: '#E22A7F', color: 'white', fontSize: '16px' }}
                            onClick={() => props.changeStatus(n.id)} to={`/cabinet/tasks/in_progress${n.id}`}> <i className="flaticon-add"></i> Start</NavLink> */}
                        {/* {n.records !== null ?
                            <div className="d-flex align-items-center">
                                <ReactAudioPlayer controls src={n.records !== null ? n.records.path : '/'} />
                                <NavLink
                                    style={styles.navLink}
                                    onClick={() => props.SendTasks(n.id, "Delivered")} to={`/cabinet/tasks/delivered`}>Save</NavLink>
                            </div> : <NavLink style={styles.a} to={`/cabinet/tasks/in_progress${n.id}`} className="delivered"><i
                                className="flaticon-add"></i> Start</NavLink>} */}
                    </div>
                </div>
            )}
        </div>
    )
}
