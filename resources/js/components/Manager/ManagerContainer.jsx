import React, { Component } from 'react'
import { Route } from "react-router-dom"
import {
    SetUserTC, SetUsersTC, SetLanguagesTC,
    SetProjectsTC, SetTasksCompletedTC
} from '../../redux/manager-reducer'

//COMPONENTS
import SideBar from '../Manager/SideBar'
import ProjectList from './Projects/ProjectsList'
import Project from './Projects/Project'
import TasksCompleted from './TasksCompleted/TasksCompleted'
import { connect } from 'react-redux'
import '../../../../public/css/components/block.css'
import Axios from 'axios'
import Step1 from './ManagerForm/Steps/Step1'
import Step2 from './ManagerForm/Steps/Step2'
import ResultHook from './ManagerForm/Steps/ResultHook'
import { DataProvider } from './ManagerForm/DataContainer'

//COMPONENTS



class ManagerContainer extends Component {

    constructor(props) {
        super(props)
        this.state = {
            country: []
        }
    }


    componentDidMount() {
        Axios.get('/api/countries').then(res => {
            this.setState({ country: res.data })
            // console.log(this.state.country)

        })
        this.props.SetUserTC(),
            this.props.SetUsersTC(),
            this.props.SetLanguagesTC(),
            this.props.SetProjectsTC()
        this.props.SetTasksCompletedTC()
    }


    render() {
            return (
                <div className="row">
                    <SideBar user={this.props.user}/>
                    <div className='col'>
                        <Route path='/manager/project' render={() => <ProjectList spareParts={this.props.projects}/>}/>
                        <Route path='/manager/project_completed'
                               render={() => <TasksCompleted tasksCompleted={this.props.tasksCompleted}/>}/>
                        <Route path="/manager/user" render={() => <Users/>}/>
                        <DataProvider>
                            <Route path="/manager/step1"
                                   render={() => <Step1 projects={this.props.projects} country={this.state.country}
                                                        user={this.props.user} users={this.props.users}
                                                        languages={this.props.languages}/>}/>
                            <Route path="/manager/step2" render={() => <Step2 projects={this.props.projects}/>}/>
                            <Route path="/manager/result"
                                   render={() => <ResultHook projects={this.props.projects} user={this.props.user}/>}/>
                        </DataProvider>

                        {/*{ this.props.projects.map((p, idx) =>*/}
                        {/*    <Route key={idx} path={`/manager/projects/${p.id}`} render={() =>*/}
                        {/*        <Project*/}
                        {/*            {...p}*/}
                        {/*        />}/>*/}
                        {/*)}*/}

                    </div>
                </div>
            )
        }
}



const mapStateToProps = (state) => {
    return {
        user: state.manager.user,
        users: state.manager.users,
        languages: state.manager.languages,
        projects: state.manager.projects,
        tasksCompleted: state.manager.tasksCompleted
    }
}


export default connect(mapStateToProps,
    {
        SetUserTC,
        SetUsersTC,
        SetLanguagesTC,
        SetProjectsTC,
        SetTasksCompletedTC
    })(ManagerContainer)


