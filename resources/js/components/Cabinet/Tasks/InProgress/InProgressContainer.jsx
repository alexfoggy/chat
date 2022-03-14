import React, { Component } from 'react'
import InProgress from './InProgress'
import TasksButtons from '../TasksButtons';
import '../../../../../../public/css/components/block.css'
import { connect } from 'react-redux';
import { SetInProgressTasksTC } from '../../../../redux/cabinet-reducer'

class InProgressContainer extends Component {
    componentDidMount() {
        this.props.SetInProgressTasksTC()
    }
    render() {
        const changeStatus = (id) => {
            updateStatus(`${id}`, 'in_progress')
        }
        const SendTasks = (id, complete_status) => {
            axios.put(`/api/tasks/${id}`, { complete_status })
        }
        return (
            <>
                <TasksButtons />
                <div className="block" >
                    <div className="block-content" >
                        <InProgress  changeStatus={changeStatus} SendTasks={SendTasks} tasks={this.props.inProgress} />

                    </div>
                </div>
           
            </>
            
        )
    }
}


const mapStateToProps = (state) => {
    return {
        // inProgress: state.cabinet.inProgress,
    }

}

export default connect(mapStateToProps, { SetInProgressTasksTC })(InProgressContainer) 