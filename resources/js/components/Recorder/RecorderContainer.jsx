import React from 'react'
import RecordBETA from './RecordBETA'
import { getUser, getTask } from '../../api/api'

import InDrawer from './Drawer'


class RecorderContainer extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            user: {},
            task: {}
        }
        this._isMounted = false;
    }
    componentDidMount() {
        this._isMounted = true;
        getUser().then(data => {
            this.setState({
                user: data.data.data
            })

        })
        // getTask().then(response => {
        //     this.setState({
        //         task: response.data.data
        //     })
        // })

    }
    componentWillUnmount() {
        this._isMounted = false;
      }


    render() {
        return (
            <div>
                {/* <InDrawer /> */}

                <RecordBETA
                    desc={this.props.desc}
                    title={this.props.title}
                    price={this.props.price}
                    complete_deadline={this.props.complete_deadline}
                    task={this.props.task}
                    taskId={this.props.taskId}
                    user={this.state.user} />
            </div>
        );
    }
}

export default RecorderContainer;
