import React from 'react'
import { NavLink } from 'react-router-dom'
import '../../../../../../public/ui/components/task.css';
import Button from '@material-ui/core/Button';

import { makeStyles } from "@material-ui/core/styles";
import Accordion from "@material-ui/core/Accordion";
import AccordionSummary from "@material-ui/core/AccordionSummary";
import AccordionDetails from "@material-ui/core/AccordionDetails";
import Typography from "@material-ui/core/Typography";
import ExpandMoreIcon from "@material-ui/icons/ExpandMore";
import ReactHtmlParser, { processNodes, convertNodeToElement, htmlparser2 } from 'react-html-parser';


const styles = {
    heading: {
        width: '100%',
        display: 'flex',
        alignItems: 'baseline',
        justifyContent: 'space-between'
    }
}

export default function New(props) {
    const userId = props.user.id
    return (
        <>



            {props.tasks.map((n) =>
                <div key={n.id} className="task" style={{ width: '100%' }}>
                    <Accordion style={{ width: '100%' }}>
                        <AccordionSummary

                            expandIcon={<ExpandMoreIcon />}
                        // aria-controls="panel1a-content"
                        // id="panel1a-header"
                        >
                            {/* <Typography className={classes.heading} > */}
                            <div style={styles.heading}>
                                <small className="price">${n.budget}</small>
                                <small className="type"><i className="flaticon-microphone-1"></i> {n.project.type}</small>
                                <small className="language">{n.language.name}</small>
                                <small className="length"> {n.project.minutes_per_tasks}min</small>
                                <small className="deadline">{n.complete_deadline} </small>
                                <div className="buttons">
                                <Button
                                    
                                    style={{ marginBottom: 10, marginRight: 10  }}
                                    onClick={() => props.Decline(n.uuid, userId)}> Decline</Button>

                                <NavLink
                                    style={{ padding: '10px 20px' ,background: '#E22A7F', color: 'white', fontSize: 16 }}
                                    onClick={() => props.changeStatus(n.id)} to={`/cabinet/tasks/in_progress`}> Accept</NavLink>
                            </div>
                            </div>

                            {/* </Typography> */}
                        </AccordionSummary>
                        <AccordionDetails style={styles.heading} >
                            <div>
                                {ReactHtmlParser(n.project.rules)}
                            </div>

                        </AccordionDetails>
                    </Accordion>

                    {/* <NavLink
                            style={{ display: 'flex', alignItems: 'center', background: '#E22A7F', color: 'white', fontSize: '16px' }}
                            onClick={() => props.changeStatus(n.id)} to={`/cabinet/tasks/new${n.id}`}>Decline</NavLink> */}

                </div>
            )}
        </>
    )
}

