import React, { Component } from 'react'
import axios from 'axios'
import StatusBar from './StatusBar'
import {  NavLink } from 'react-router-dom';

import Accordion from "@material-ui/core/Accordion";
import AccordionSummary from "@material-ui/core/AccordionSummary";
import AccordionDetails from "@material-ui/core/AccordionDetails";
import Typography from "@material-ui/core/Typography";
import ExpandMoreIcon from "@material-ui/icons/ExpandMore";
import { getToken } from '../../api/api';

class New extends Component {

    constructor(props) {
        super(props)
        this.state = {
            claimed: [],


        }
    }
    componentDidMount() {
        axios.get(`http://127.0.0.1:8000/api/users/${getToken()}/tasks?filter=new`)
            .then(res => {
                this.setState({
                    claimed: res.data.data
                })
                console.log(this.state.claimed)
            })
    }



    render() {
        let claim = this.state.claimed.map((t, idx) =>
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

                                <NavLink to={'/cabinet/tasks/' + t.id} className="claim"><i className="flaticon-add"></i>Claim</NavLink>
                                <button className="decline"><i className="flaticon-cancel"></i> Decline</button>
                            </div>
                        </div>
                    </AccordionSummary>
                    <AccordionDetails>
                        <Typography> {t.desc}</Typography>
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

export default New
