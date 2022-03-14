import React, { Component } from 'react'
import { updateStatus } from '../../../../api/api'

import { SetNewTasksTC } from '../../../../redux/cabinet-reducer'
import '../../../../../../public/css/components/block.css'
import MarkunreadMailboxTwoToneIcon from '@material-ui/icons/MarkunreadMailboxTwoTone';

import New from './New'
import TasksButtons from '../TasksButtons';
import { connect } from 'react-redux';
import Axios from 'axios';


const styles = {
    empty: {
        fontSize: 40
    }
}


class NewContainer extends Component {


    componentDidMount() {

        this.props.SetNewTasksTC()
        // this.props.Echo()
    }
    render() {

        const Decline = (uuid , id)=>{
            Axios.post(`/cabinet/tasks/decline`, {uuid , id})
        }

        const changeStatus = (id) => {
            updateStatus(`${id}`, 'in_progress')
        }
        return (
            <>
                <TasksButtons />
                <div className="block">
                    {this.props.status.length === 0 ? <div style={styles.empty}><MarkunreadMailboxTwoToneIcon style={styles.empty} color='secondary' />Empty</div> : ''}
                    <div className="block-content">
                        <New Decline={Decline} user={this.props.user} changeStatus={changeStatus} tasks={this.props.newTasks} />
                    </div>
                </div>
            </>

        )
    }
}
const mapStateToProps = (state) => {
    return {
        newTasks: state.cabinet.newTasks
    }
}

export default connect(mapStateToProps, { SetNewTasksTC })(NewContainer)