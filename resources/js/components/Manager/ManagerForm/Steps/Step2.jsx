import React, { useState } from "react";
import { useForm } from "react-hook-form";
import { useHistory } from "react-router-dom";
import { useData } from "../DataContainer";
import "../../../../../../public/css/components/form.css";
import "./styles.css";
import SideBarSteps from "./SideBarSteps";
import Axios from "axios";
import Confirmation from "./Confirmation";


const styles = {
  label: {
    fontWeight: 'bold',
    color: 'black',
    margin: 0,
    fontSize: '18px'
  },
  nav: {
    display: 'flex',
    justifyContent: 'center',
    padding: '20px',
  }
}
const Step2 = (props) => {
  const [Prompt, setDirty, setPristine] = Confirmation()
  const { setValues, data } = useData();

  const { push } = useHistory();

  const onSubmit = data => {
    Axios.put(`/manager/projects/${props.projects.length + 1}`, { data })
    setValues(data);
    push("/manager/result");
  };
  const total = data.tasks_per_speaker * data.speakers


  const { handleSubmit, register, errors } = useForm({
    defaultValues: {
      budget: data.budget,
      tasks_per_speaker: data.tasks_per_speaker,
      environment: data.environment,
      minutes_per_tasks: data.minutes_per_tasks,
      tasks_count: total,
      speakers: data.speakers,
      projectId: data.projectId

    }
  });


  const [speakers, setSpeakers] = useState( data.speakers,);
  const [tasks, setTasks] = useState(data.tasks_per_speaker);

  const handleChange = ({ target: { value } }) => {
    setSpeakers(value);
  };
  const handleChange2 = ({ target: { value } }) => {
    setTasks(value);
  };

  return (
    <>

      <SideBarSteps />
      <div className="block">
        <div className="block-header">
          <h2> Number of tasks</h2>
        </div>
        <div className="block-content">
          <form className='project-form' onSubmit={handleSubmit(onSubmit)}>
            <div className="row" >
              <div className="col-6" >
                <div className="form-group">
                  <label style={styles.label}>Total number of tasks </label>
                  <input value={speakers * tasks} readOnly type="number" name="tasks_count" ref={register} />
                </div>
                <div className="form-group">
                  <label style={styles.label} >Budget per task</label>
                  <input  onChange={() => setDirty()}  step="0.001" type="number" defaultValue="USD" name="budget" ref={register} />
                </div>
                <div className="form-group">
                  <label style={styles.label}>Minutes per task</label>
                  <input step="0.001" type="number" name="minutes_per_tasks" ref={register} />
                </div>
                <div className="form-group">
                  <label style={styles.label}>Speakers </label>
                  <input  onChange={() => setDirty()}  type="number" onChange={handleChange} name="speakers" ref={register} />
                </div>
              </div>
              <div className="col-6">
                <div className="form-group">
                  <label style={styles.label}>Environment </label>
                  <textarea
                    type="text"
                    style={{ border: "1px solid rgba(100, 100, 100, 0.15)" }}
                    cols={60} rows={5}
                    name="environment"
                    ref={register}
                  />
                </div>
                <div className="form-group">
                  <label style={styles.label}> Tasks per Speaker</label>
                  <input type="number" onChange={handleChange2} name="tasks_per_speaker" ref={register} />
                </div>
              </div>
            </div>
            <button onClick={() => setPristine()}  type="submit">Next Step {'>'}</button>
          </form>
        </div>
      </div>
      {Prompt}
    </>
  );
};

export default Step2;
