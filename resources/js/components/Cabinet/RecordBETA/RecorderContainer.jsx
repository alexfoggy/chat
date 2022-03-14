import React from 'react'
import Recorder from './Recorder'


class RecorderContainer extends React.Component {
    render() {
        return (
            <div>
                <Recorder
                    desc={this.props.desc}
                    title={this.props.title}
                    price={this.props.price}
                    complete_deadline={this.props.complete_deadline}
                    task={this.props.task}
                    taskId={this.props.taskId}
                    user={this.props.user} />
            </div>
        );
    }
}

export default RecorderContainer;
