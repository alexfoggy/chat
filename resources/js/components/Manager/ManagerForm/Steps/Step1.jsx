import React, { useState } from "react";
import { useForm, Controller } from "react-hook-form";
import { useHistory } from "react-router-dom";
import "./styles.css";

import "./Radio.css"
import "./radioButton.css"
import { useData } from "../DataContainer";
import SelectLanguages from "./Select/SelectLanguages";
import SideBarSteps from "./SideBarSteps";
import { Select } from 'antd';
import 'antd/dist/antd.css';
import Axios from "axios";
import Confirmation from "./Confirmation";

//EDITOR
import { Editor, EditorState } from 'draft-js'
import ReactEditor from "./ReactEditor";
//EDITOR


const styles = {
  label: {
    fontWeight: 'bold',
    color: 'black',
    marginBottom: '10px',
    fontSize: '18px'
  },
  nav: {
    display: 'flex',
    justifyContent: 'center',
    padding: '20px'
  },
  form_group: {
    display: 'block'
  }
}



const Step1 = (props) => {

  const [editorState, setEditorState] = React.useState(
    () => EditorState.createEmpty(),
  );
  const [text, setText] = useState("")
  const [Prompt, setDirty, setPristine] = Confirmation()
  const [id, setId] = useState()
  const { setValues, data } = useData([]);
  const { push } = useHistory();
  const { handleSubmit, errors, register, control } = useForm({
    defaultValues: {
      title: data.title,
      language: data.language,
      country: data.country,
      apply_deadline: data.apply_deadline,
      complete_deadline: data.complete_deadline,
      subject: data.subject,
      type: data.type,
      speakers: data.speakers,
      script: data.script,
      rules: data.rules,
      user_id: data.user_id,
      // users: data.users,
      projectId: data.projectId

    }
  });
  const onSubmit = data => {
    speakers === undefined ? Axios.post('/manager/projects', { data }).then(res => {
      setId(res.data)
    })
      : Axios.put(`/manager/projects/${props.projects.length + 1}`, { data })
    // Axios.post('/manager/projects', { data }).then(res=>{
    //   setId(res.data)
    // })

    setValues(data);
    console.log(data)
    push("/manager/step2")

  };

  const speakers = data.speakers

  return (
    <>

      <SideBarSteps />
      <div className="block">
        <div className="block-header">
          <input className={'project-name'} type="text" name="title" ref={register} defaultValue="New Project" />
          <input style={{ display: 'none' }} type="text" name="user_id" ref={register} defaultValue={props.user.id} />
        </div>
        <div className="block-content" >
          <form onSubmit={handleSubmit(onSubmit)} className='project-form'>
            <div className="row">
              <div className="col-6">
                <div style={styles.form_group} className="form-group">
                  <label style={styles.label}>Language</label>
                  <SelectLanguages languages={props.languages} control={control} name={'language'} placeholder='language' />
                </div>
              </div>
              <div className="col-6">
                <div style={styles.form_group} className="form-group">
                  <label style={styles.label}> Country </label>
                  <SelectLanguages languages={props.country} control={control} name={'country'} placeholder='country' />

                </div>
              </div>
              <div className="col-6">
                <div style={styles.form_group} className="form-group">
                  <label style={styles.label}> Apply Deadline</label>
                  <input onChange={() => setDirty()} style={styles.input} name="apply_deadline" type="date" id="apply_deadline"
                    placeholder="date placeholder"
                    ref={register} />
                </div>
              </div>
              <div className="col-6">
                <div className="form-group">
                  <label style={styles.label}> Complete Deadline </label>
                  <input style={styles.input} name="complete_deadline" type="date" id="complete_deadline" placeholder="date placeholder" ref={register} />
                </div>
              </div>
              <div className="col-6">
                <div style={styles.form_group} className="form-group">
                  <label style={styles.label} >Subject</label>
                  <input
                    type="text"
                    name="subject"
                    placeholder="Please enter a subject"
                    ref={register}
                  />
                </div>
              </div>
              <div className="col-6">
                <div className="form-group">
                  <label style={styles.label}>Type of Project </label>
                  <div style={styles.form_group} className="form-group">
                    <Controller
                      control={control}
                      name="type"
                      as={
                        <Select
                          showSearch
                          style={{ width: '100%' }}
                          placeholder="Select..."
  >
                          <Select.Option value="Conversation">Conversation</Select.Option>
                          <Select.Option value="Monolog">Monolog</Select.Option>
                          <Select.Option value="Phone call">Phone call</Select.Option>
                          <Select.Option value="Free speech">Free speech</Select.Option>

                        </Select>
                      }
                    />
                  </div>
                </div>
              </div>
              <div className="col-12">
                <div style={styles.form_group} className="form-group">
                  <label style={styles.label}> Script</label>
                  <Controller
                    as={<ReactEditor />}
                    name="script"
                    control={control}
                  />
                </div>
              </div>
              <div className="col-12">
                <div style={styles.form_group} className="form-group">
                  <label style={styles.label}>Projects Rules</label>
                  <Controller
                    as={<ReactEditor />}
                    name="rules"
                    control={control}
                  />
                  {/* <textarea
                    type="text"
                    style={{ border: "1px solid rgba(100, 100, 100, 0.15)" }}
                    cols={40} rows={5}
                    name="rules"
                    ref={register}
                  /> */}
                </div>
              </div>

            </div>

            {/* <div className="row">
              <div className="col-6" >
                <div style={styles.form_group} className="form-group">
                  <label style={styles.label} >Subject</label>
                  <input
                    type="text"
                    name="subject"
                    placeholder="Please enter a subject"
                    ref={register}
                  />
                </div>
                <div className="form-group">
                  <label style={styles.label}>Type of Project </label>
                  <div style={styles.form_group} className="form-group">
                    <Controller
                      control={control}
                      name="type"
                      as={
                        <Select
                          showSearch
                          style={{ width: '100%' }}
                          value='Monolog'
                        >
                          <Select.Option value="Conversation">Conversation</Select.Option>
                          <Select.Option value="Monolog">Monolog</Select.Option>
                          <Select.Option value="Phone call">Phone call</Select.Option>
                          <Select.Option value="Free speech">Free speech</Select.Option>

                        </Select>
                      }
                    />
                  </div>
                </div>
              </div>
            </div> */}
            <button onClick={() => setPristine()} type="submit">Next Step {'>'}</button>
          </form>
        </div>
      </div>

      { Prompt}
    </>
  );
};
export default Step1
