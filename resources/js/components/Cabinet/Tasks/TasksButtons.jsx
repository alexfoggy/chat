import React, { Component } from 'react'
import { connect } from 'react-redux';
import { SetButtonsTC, Echo } from '../../../redux/cabinet-reducer'
import { buttonStatus } from '../../../api/api'
import { NavLink } from 'react-router-dom';
import './Tabs.css'
import '../../../../../public/ui/components/tabs.css';

class TasksButtons extends Component {
    constructor(props) {
        super(props)
        this.state = {
            buttonStatus: [],
            activeItem: null,
        }
        this._isMounted = true;
    }
    componentDidMount() {
        this.props.SetButtonsTC()
        this.props.Echo()
    //     if (this._isMounted) {
    //         buttonStatus().then(res => {
    //             this.setState({
    //                 buttonStatus: res.data.data
    //             })
    //         })
    //         window.Echo.channel(`tasks.count`)
    //             .listen('TaskCounterEvent', (data) => {
    //                 this.setState({
    //                     buttonStatus: data.count
    //                 })

    //             });
    //     }
    }
    componentWillUnmount() {
        this._isMounted = false;
    }

    render() {
        const onSelectItem = idx => {
            this.setState({
                activeItem: idx
            })
        }
        // const statusChange = async (status) => {
        //     /*console.log("loading...")
        //     console.log("loaded")*/
        // }
        const changeStatus = (id, filter) => {
            onSelectItem(id)
            // statusChange(filter)

        }
        let button = this.props.buttons.map((l, id) =>
            <NavLink to={`/cabinet/tasks/${l.filter}`} className={this.state.activeItem === id ? 'active' : ''}
                key={id} onClick={() => changeStatus(id, l.filter)}><span>{l.count}</span>{l.name}</NavLink>
        )
        return (
            <>
                <div>
                    <h2 style={{
                        fontWeight: 'bold',
                        color: '#d11267',
                        padding: '30px',
                        margin: 0
                    }}>Tasks</h2>
                </div>
                <div className="row mb-2">
                    <div className="col">
                        <nav className="tabs">
                            {button}
                        </nav>
                    </div>

                </div>
            </>
        )
    }
}
const mapStateToProps = (state) => {
    return {
        buttons: state.cabinet.buttons
    }
}

export default connect(mapStateToProps, { SetButtonsTC, Echo })(TasksButtons)
