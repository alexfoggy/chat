import React, { Component } from 'react'
import { connect } from 'react-redux'
import {
    SetUserTC,
    SetNewTasksTC,
    SetInProgressTasksTC,
    SetReadyToInvoiceTasksTC,
    SetInvoicesTC,
    SetButtonStatusTC,
    SetLanguagesTC,
    SetCountriesTC,
    Echo
} from '../../redux/cabinet-reducer'
import { Route } from "react-router-dom";

//COMPONENTS
import SideBar from "./SideBar/SideBar";
import Invoices from "./Invoices/Invoices";
import InProgressContainer from './Tasks/InProgress/InProgressContainer'
import ReadyContainer from './Tasks/ReadyToInvoice/ReadyContainer'
import NewContainer from "./Tasks/New/NewContainer";
import ReactHookForm from './Profile/ReactHookForm/ReactHookForm'
import RecorderContainer from './RecordBETA/RecorderContainer'
import DeliveredContainer from './Tasks/Delivered/DeliveredContainer';
//COMPONENTS

class CabinetContainer extends Component {

    componentWillMount() {
        this.props.SetUserTC()
        this.props.SetReadyToInvoiceTasksTC()
        this.props.SetInvoicesTC()
        this.props.SetButtonStatusTC()
        this.props.SetLanguagesTC()
        this.props.SetCountriesTC()
        this.props.Echo()
    }

    render() {
        return (
            <>
                <SideBar user={this.props.user} status={this.props.status} />
                <div className='col'>
                    <Route path='/cabinet/information' render={() => <ReactHookForm user={this.props.user} languages={this.props.languages} countries={this.props.countries} />} />
                    <Route path='/cabinet/invoices' render={() => <Invoices invoices={this.props.invoices} />} />
                    <Route path={`/cabinet/tasks/new`} render={() => <NewContainer user={this.props.user} status={this.props.status} />} />
                    <Route path='/cabinet/tasks/in_progress' render={() => <InProgressContainer inProgress={this.props.inProgress} />} />
                    <Route path='/cabinet/tasks/delivered' render={() => <DeliveredContainer />} />
                    <Route path='/cabinet/tasks/ready_to_invoice' render={() => <ReadyContainer readyToInvoice={this.props.readyToInvoice} />} />
                    <div>
                        {this.props.inProgress.map((t, idx) =>
                            <Route key={idx} exact path={`/cabinet/tasks/in_progress${t.id}`} render={() =>
                                <RecorderContainer
                                    user={this.props.user}
                                    desc={t.desc}
                                    title={t.title}
                                    price={t.price}
                                    complete_deadline={t.complete_deadline}
                                    taskId={t.id} />} />
                        )}
                    </div>
                </div>
            </>
        )
    }
}


const mapStateToProps = (state) => {
    return {
        user: state.cabinet.user,
        newTasks: state.cabinet.newTasks,
        inProgress: state.cabinet.inProgress,
        readyToInvoice: state.cabinet.readyToInvoice,
        invoices: state.cabinet.invoices,
        status: state.cabinet.status,
        languages: state.cabinet.languages,
        countries: state.cabinet.countries,

    }
}

export default connect(mapStateToProps,
    {
        SetUserTC,
        SetNewTasksTC,
        SetInProgressTasksTC,
        SetReadyToInvoiceTasksTC,
        SetInvoicesTC,
        SetButtonStatusTC,
        SetLanguagesTC,
        SetCountriesTC,
        Echo
    })(CabinetContainer)