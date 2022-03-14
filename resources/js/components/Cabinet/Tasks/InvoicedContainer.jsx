import React, { Component } from 'react'
import { getInvoiceTasks } from '../../../api/api'
import '../../../../../public/ui/components/task.css';
import { NavLink } from 'react-router-dom'
import TasksButtons from './TasksButtons';


export default class InvoicedContainer extends Component {

    constructor(props) {
        super(props)
        this.state = {
            delivered: []
        }
        this._isMounted = true;
    }

    componentDidMount() {
        if (this._isMounted) {
            getInvoiceTasks().then(res => {
                this.setState({
                    delivered: res.data.data
                })
            })
        }
    }
    componentWillUnmount() {
        this._isMounted = false;
    }
    

    render() {
        const SendTasks = (id, complete_status) => {
            axios.put(`/api/tasks/${id}`, { complete_status }).then(res => {
            })
        }
        console.log(this.state.delivered)
        return (
            <div>
                <TasksButtons />
                {this.state.delivered.map((n) =>
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
                        {/* <div className="buttons">
                        <NavLink
                            style={{ display: 'flex', alignItems: 'center', background: '#E22A7F', color: 'white', fontSize: '16px' }}
                            onClick={() => SendTasks(n.id, "ready_to_invoice")} to={`/cabinet/tasks/ready_to_invoice`}>Send</NavLink>
                    </div> */}
                    </div>
                )}
            </div>
        )
    }
}
