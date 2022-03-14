import React, { Component } from 'react'
import { SetDeliveredTasksTC } from '../../../../redux/cabinet-reducer'
import '../../../../../../public/css/components/block.css'


import Delivered from './Delivered'
import TasksButtons from '../TasksButtons';
import { connect } from 'react-redux';

class DeliveredContainer extends Component {

    componentDidMount() {
        this.props.SetDeliveredTasksTC()
    }

    render() {
        const SendTasks = (id, complete_status) => {
            axios.put(`/api/tasks/${id}`, { complete_status }).then(res => {
            })
        }
        return (
            <>
                <TasksButtons />
                <div className="block" >
                    <div className="block-content" >
                        <Delivered SendTasks={SendTasks} delivered={this.props.delivered} />

                    </div>
                </div>
            </>
        )
    }
}

const mapStateToProps = (state) => {
    return {
        delivered: state.cabinet.delivered
    }
}

export default connect(mapStateToProps, { SetDeliveredTasksTC })(DeliveredContainer)
