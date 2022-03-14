import React from 'react'
import '../../../../../public/css/components/block.css'
import '../../../../../public/ui/components/task.css';

const styles = {
    h2: {
        fontWeight: 'bold',
        color: '#d11267',
        padding: '30px',
        margin: 0
    }
}


export default function Invoices(props) {
    return (
        <>
            <h2 style={styles.h2}>Invoices</h2>
            <div className="block">
                <div className="block-content">
                    {props.invoices.map((n) =>
                        <div key={n.id} className="task" style={{ width: '100%' }}>
                            <div>
                                <small className="price">${n.budget}</small>
                            </div>
                            <small className="type"><i className="flaticon-microphone-1"></i> {n.project.type}</small>
                            <small className="language">{n.language.name}</small>
                            <small className="length"> {n.project.minutes_per_tasks}min</small>
                            <span>
                                <small className="deadline">{n.complete_deadline} </small>
                            </span>
                        </div>
                    )}
                </div>
            </div>
        </>
    )
}
