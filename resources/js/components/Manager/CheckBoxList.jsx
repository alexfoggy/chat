import React, { useState } from 'react';
import CheckBox from './CheckBox';
import { useHistory } from "react-router-dom";
import { useForm, useFieldArray, Controller } from "react-hook-form";
import Axios from "axios";
import Confirmation from "./ManagerForm/Steps/Confirmation";

import { useData } from "../Manager/ManagerForm/DataContainer";
// import "../../../../../../../public/css/components/form.css"
import '../../../../public/css/components/form.css'
import '../../../../public/ui/components/task.css'


const styles = {

    div: {
        width: 140,
        fontWeight: 700,
        marginBottom: 5,
        fontSize: 16
    },
    p: {
        fontWeight: 'bold',
        color: '#E22A7F'
    }

}




export default function CheckBoxList({ users, isCheckedAll, onCheck, control, name, projectsId }) {

    const { setValues, data, } = useData([]);
    const { handleSubmit, errors, register } = useForm({
        defaultValues: {
            users: []
        }
    });

    const { fields } = useFieldArray(
        {
            control,
            name: name
        }
    );

    const [Prompt, setDirty, setPristine] = Confirmation()

    const checkBoxOptions = users.map((t, index) =>
        <div key={index} >
            {t.checked == true
                ? <div className="task" style={{ width: '100%', background: '#E4E4E4', marginTop: '25px' }}>
                    <input
                        style={{ display: 'none' }}
                        style={{ display: 'none' }}
                        name={`users[${t.id}].id`}
                        defaultValue={t.id}
                        ref={register()}
                    />
                    <CheckBox
                        style={{ width: 50 }}
                        key={index}
                        name={t.course}
                        // value={t.id}
                        tick={t.checked}
                        onCheck={(e) => onCheck(t.id, e.target.checked)} />
                    <div style={styles.div}>
                        <div>Full Name</div>
                        <p style={styles.p} className="price">{t.first_name + ' ' + t.last_name}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Language</div>
                        <p style={styles.p} className="price">{t.main_language}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Country</div>
                        <p style={styles.p} className="price">{t.country}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Level</div>
                        <p style={styles.p} className="price">{t.level}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Vocie</div>
                        <p style={styles.p} className="price">{t.voice}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Gender</div>
                        <p style={styles.p} className="price">{t.gender}</p>
                    </div>
                </div>
                : <div className="task" style={{ width: '100%', marginTop: '25px' }}>
                    <CheckBox
                        key={index}
                        name={t.course}
                        // value={t.id}
                        tick={t.checked}
                        onCheck={(e) => onCheck(t.id, e.target.checked)} />
                    <div style={styles.div}>
                        <div>Full Name</div>
                        <p style={styles.p} className="price">{t.first_name + ' ' + t.last_name}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Language</div>
                        <p style={styles.p} className="price">{t.main_language}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Country</div>
                        <p style={styles.p} className="price">{t.country}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Level</div>
                        <p style={styles.p} className="price">{t.level}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Voice</div>
                        <p style={styles.p} className="price">{t.voice}</p>
                    </div>
                    <div style={styles.div}>
                        <div>Gender</div>
                        <p style={styles.p} className="price">{t.gender}</p>
                    </div>

                </div>}
        </div>
    )


    const { push } = useHistory();
    const onSubmit = data => {
        Axios.put(`/manager/projects/${projectsId.length + 1}`, { data })
        setValues(data);
        push("/manager/result");
    };
    return (
        <>
            <form className='project-form' onSubmit={handleSubmit(onSubmit)}>
                <CheckBox
                    name="select-all"
                    value="ALL"
                    tick={isCheckedAll}
                    onCheck={(e) => onCheck('all', e.target.checked)}
                />

                {checkBoxOptions}
                <button onClick={() => setPristine()} type="submit">Save Project</button>
            </form>
            {Prompt}

        </>
    );
}