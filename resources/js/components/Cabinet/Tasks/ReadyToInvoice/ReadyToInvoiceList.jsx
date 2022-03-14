import React from 'react';
import CheckBox from './CheckBox';
import * as axios from 'axios'
import { Button } from '@material-ui/core';
import { NavLink } from 'react-router-dom';

export default function CheckBoxList({ tasks, isCheckedAll, onCheck }) {
    const SendTasks = () => {
        axios.post(`/cabinet/generate-invoice/`, { tasks }).then(res => {
            // setProjects(res.data)
        })
    }
    // const checkBoxOptions = (
    //     <div className="checkbox-list">
    //       {checkList.map((option, index) => {
    //         return (
    //           <CheckBox
    //             key={index}
    //             // name={option.name}
    //             value={option.value}
    //             tick={option.checked}
    //             onCheck={e => onCheck(option.value, e.target.checked)}
    //           />
    //         );
    //       })}
    //     </div>
    //   );


    const checkBoxOptions = tasks.map((n, index) =>
        <div key={index} >
            {n.checked == true
                ? <div className="task" style={{ width: '100%', background: 'gainsboro', marginTop: '25px' }}>
                    <div>
                    <small className="price">${n.budget}</small>
                    </div>
                    <small className="type"><i className="flaticon-microphone-1"></i> {n.project.type}</small>
                    <small className="language">{n.language.name}</small>
                    <small className="length"> {n.project.minutes_per_tasks}min</small>
                    <span>
                        <small className="deadline">{n.complete_deadline} </small>
                    </span>
                </div>
                : <div className="task" style={{ width: '100%', marginTop: '25px' }}>
                   <div>
                    <small className="price">${n.budget}</small>
                    </div>
                    <small className="type"><i className="flaticon-microphone-1"></i> {n.project.type}</small>
                    <small className="language">{n.language.name}</small>
                    <small className="length"> {n.project.minutes_per_tasks}min</small>
                    <span>
                        <small className="deadline">{n.complete_deadline} </small>
                    </span>
                </div>}
        </div>
    )

    const checked = isCheckedAll === true ? <a href="/cabinet/invoices" style={{ borderRadius: 15, padding: '10px 20px', alignItems: 'center', background: '#E22A7F', color: 'white' }} variant="contained" color="secondary" onClick={() => SendTasks()}>Send</a>
        : <NavLink  to="/cabinet/tasks/invoices" disabled style={{ borderRadius: 15, padding: '10px 20px', alignItems: 'center', background: 'gray', color: 'white' }} variant="contained" color="secondary" onClick={() => SendTasks()}>Send</NavLink>


    return (
        <div className="checkbox-list">

            <div>
                <CheckBox
                    name="select-all"
                    value="Check all"
                    tick={isCheckedAll}
                    onCheck={(e) => onCheck('all', e.target.checked)}
                />
                {/* <NavLink to="/cabinet/tasks/invoiced" style={{ borderRadius: 15, padding: '10px 20px', alignItems: 'center', background: '#E22A7F', color: 'white' }} variant="contained" color="secondary" onClick={() => SendTasks()}>Send</NavLink> */}
            </div>
            {checked}
            {checkBoxOptions}
        </div>
    );
}
//  <CheckBox
//                     key={index}
//                     name={t.name}
//                     value={t.value}
//                     tick={t.checked}
//                     onCheck={(e) => onCheck(t.value, e.target.checked)}
//                 /> 