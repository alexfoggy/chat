import React, {useEffect} from 'react';
import '../../../../public/ui/components/task.css';
import { NavLink } from 'react-router-dom';
import './Tabs.css'
import Accordion from "@material-ui/core/Accordion";
import AccordionSummary from "@material-ui/core/AccordionSummary";
import AccordionDetails from "@material-ui/core/AccordionDetails";
import Typography from "@material-ui/core/Typography";
import ExpandMoreIcon from "@material-ui/icons/ExpandMore";
import { getToken } from '../../api/api';
import Player from '../RecordBETA/AudioPlayer'
import '../RecordBETA/RecorderInvoice.css'
import ReactAudioPlayer from 'react-audio-player';
// import ReactAudioPlayer from 'react-audio-player';



const Tasks = (props) => {


    const SendTasks = (id) => {
        axios.put(`http://127.0.0.1:8000/api/tasks/${id}`).then(res => {
            setProjects(res.data)
        })

    }


    let tasks = props.tasks.map((t, idx) =>
        <div key={idx} className="col-12 mt-2">
            <Accordion>
                <AccordionSummary
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                >
                    <div className="task" style={{ width: '100%' }}>
                        <div>
                            <small className="price">${t.price}</small>
                        </div>
                        <small className="type"><i className="flaticon-microphone-1"></i> Conversation</small>
                        <small className="language">English</small>
                        <small className="length"> 40min</small>
                        <span>
                            <small className="d-block"><i>Deadline</i></small>
                            <small className="deadline">{t.complete_deadline} </small></span>
                        <div className="buttons">
                            {props.inProgress == t.complete_status ? <h1>AUDIO</h1> : <NavLink to={'/cabinet/tasks/' + t.id} className="claim"><i className="flaticon-add"></i>{props.claim == t.complete_status ? 'Claimed' : 'Start'}</NavLink>}
                            {console.log(t.complete_status)}
                            {console.log(props.inProgress)}
                        </div>
                    </div>
                </AccordionSummary>
                <AccordionDetails>
                    <Typography> {t.desc}</Typography>
                </AccordionDetails>
            </Accordion>
        </div>
    )

    let button = props.buttonStatus.map((l, id) =>
        <button className={props.activeItem === id ? 'active' : ''}
            key={id} onClick={() => changeStatus(id, l.filter)}><span>{l.count}</span>{l.name}</button>
    )
    const statusChange = async (status) => {
        console.log("loading...")
        let token = getToken();
        await axios.get(`http://127.0.0.1:8000/api/users/${token}/tasks?filter=${status}`).then(response => {
            props.setTasks(response.data.data)
        })
        console.log("loaded")
    }
    const changeStatus = (id, filter) => {
        props.onSelectItem(id)
        statusChange(filter)
    }
    return (
        <>
            <h1>Tasks </h1>
            <div className="row">
                <div className="col">
                    <nav className="tabs">
                        {button}
                    </nav>
                    {tasks}
                </div>
                <div>
                </div>
            </div>

        </>
    )
}
export default Tasks

