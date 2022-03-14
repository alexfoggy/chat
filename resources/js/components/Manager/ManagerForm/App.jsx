import React from 'react'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Step1 from './Steps/Step1'
import Step2 from './Steps/Step2'
import Step3 from './Steps/Step3'
import StepUsers from './Steps/StepUsers'
import Result from './Steps/Result'
import Users from '../Users'


import  StepContainer3 from './Steps/StepsContainer3'
import ResultHook from './Steps/ResultHook'


export default function App(props) {
    return (<></>
        // <div className="box">
        //     <BrowserRouter>
        //         {/* <Switch> */}
        //             <Route  path="/manager/step1" render={() => <Step1 projects={props.projects} country={props.country}  user={props.user} users={props.users} languages={props.languages} />} />
        //             <Route path="/manager/step2" render={() =><Step2 projects={props.projects} />} />
        //             {/* <Route path="/manager/step3" render={() =><StepContainer3/>} /> */}
        //             <Route path="/manager/step3" render={() =><Step3/>} />
        //             {/* <Route path="/manager/result" render={() => <Result user={props.user} />} /> */}
        //             <Route path="/manager/result" render={() => <ResultHook  projects={props.projects}  user={props.user} />} />
        //         {/* </Switch> */}
        //     </BrowserRouter>
        // </div>


    )
}
