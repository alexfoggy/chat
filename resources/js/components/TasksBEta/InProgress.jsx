import React, { Component } from 'react'
import axios from 'axios'
import StatusBar from './StatusBar'
import { NavLink } from 'react-router-dom';
import { updateStatus, getToken } from '../../api/api'
import Accordion from "@material-ui/core/Accordion";
import AccordionSummary from "@material-ui/core/AccordionSummary";
import AccordionDetails from "@material-ui/core/AccordionDetails";
import Typography from "@material-ui/core/Typography";
import ExpandMoreIcon from "@material-ui/icons/ExpandMore";
import Player from '../RecordBETA/AudioPlayer'

class InProgress extends Component {

    constructor(props) {
        super(props)
        this.state = {
            inProgress: [],



        }
    }
    componentDidMount() {
        axios.get(`http://127.0.0.1:8000/api/users/${getToken()}/tasks?filter=in_progress`)
            .then(res => {
                console.log(res.data.data)
                this.setState({
                    inProgress: res.data.data
                })
            })
    }



    render() {
        let claim = this.state.inProgress.map((p, idx) =>
            <div key={idx} className="col-12 mt-2">
                <Accordion>
                    <AccordionSummary
                        expandIcon={<ExpandMoreIcon />}
                        aria-controls="panel1a-content"
                        id="panel1a-header"
                    >
                        <div className="task" style={{ width: '100%' }}>
                            <div>
                                <small className="price">${p.price}</small>
                            </div>
                            <span>
                                <small className="d-block"><i>Deadline</i></small>
                                <small className="deadline">{p.complete_deadline} </small></span>
                            <div className="buttons"></div>
                            <audio controls='controls' src={p.records !== null ? p.records.path : '/'} />
                            {/* {console.log(p.records !== null ? p.records.path : '/')} */}
                            <button onClick={() => Send()}  >Send</button>

                        </div>
                    </AccordionSummary>
                    <AccordionDetails>
                        <Typography> {p.desc}</Typography>
                    </AccordionDetails>
                </Accordion>
            </div>
        )
        return (
            <div>
                <h1>Task</h1>

                <StatusBar all={this.props.all} />

                {claim}
            </div>
        )
    }
}

export default InProgress
