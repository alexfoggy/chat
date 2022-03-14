import React from 'react'
import { getTasks, buttonStatus } from "../../api/api";
import { connect } from "react-redux"
import { setTasks } from "../../redux/tasks-reducer";
import Tasks from './Tasks';



class TasksContainer extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            buttonStatus: [],
            activeItem: 0,
            progress: true,
            claim: 'Claimed',
            inProgress: 'In Progress',
        }
    }
    componentDidMount() {
        this.setState({ progress: true })
        buttonStatus().then(response => {
            this.setState({
                progress: false,
                buttonStatus: response.data.data,
                navStatus: response.data.data
            })
        })
        getTasks().then(response => {
            this.props.setTasks(response.data.data)
        })
    }

    onSelectItem = idx => {
        this.setState({
            activeItem: idx
        })
    }
    render() {
        return (
            <div>
                <Tasks
                    claim={this.state.claim}
                    inProgress={this.state.inProgress}
                    activeItem={this.state.activeItem}
                    onSelectItem={this.onSelectItem}
                    buttonStatus={this.state.buttonStatus}
                    setTasks={this.props.setTasks}
                    statusChange={this.props.statusChange}
                    tasks={this.props.tasks} />
            </div>
        )
    }
}

let mapStateToProps = (state) => {
    return {
        tasks: state.tasksPage.tasks,
    }
}
export default connect(mapStateToProps, { setTasks })(TasksContainer)