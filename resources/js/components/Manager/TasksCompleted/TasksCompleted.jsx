import React, { useState } from 'react'
import * as axios from 'axios'
import '../../../../../public/ui/components/task.css'
import '../../../../../public/css/components/block.css'
import { Button } from '@material-ui/core';

import ReactAudioPlayer from 'react-audio-player';


const styles = {
    h2: {
        fontWeight: 'bold',
        color: '#d11267',
        padding: '30px',
        margin: 0
    },
    task: {
        display: 'flex',
        justifyContent: "space-between"
    }
}


export default function TasksCompleted(props) {

    const [disabledButtons, setDisabledButtons] = useState([])

    const SendTasks = ( id, complete_status, index) => {
        axios.put(`/api/tasks/${id}`, { complete_status }).then(res => { })
        const newDisabledButtons = [...disabledButtons];
        newDisabledButtons[index] = true;
        setDisabledButtons(newDisabledButtons)

    }
    return (
        <div>
            <h2 style={styles.h2}>TasksCompleted</h2>
            <div className="block">
                <div className="block-content">
                    {props.tasksCompleted.map((t, index) =>
                        <div className="task" style={styles.task} key={t.id}>
                            <div>
                                {/* <h5>Title </h5> */}
                                <small className="price">{t.title}</small>

                            </div>
                            <div>
                                {/* <h5>Price </h5> */}
                                <small className="price"> ${t.id}</small>
                            </div>
                            <ReactAudioPlayer
                                controls
                                src={t.records !== null ? t.records.path : '/'}
                            />
                            {/* <Button variant="contained" disabled={disabledButtons[index]}
                                            onClick={() => ProjectID(p.id, index)}
                                            color="secondary" type="submit">Generate</Button> */}
                            <Button
                                disabled={disabledButtons[index]}
                                color="secondary"
                                variant="contained"
                                onClick={() => SendTasks(t.id, 'ready_to_invoice', index)}>Approved</Button>
                        </div>
                    )}
                </div>
            </div>

        </div>
    )

}
