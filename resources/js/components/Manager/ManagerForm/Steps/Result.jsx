import React, { useState, useEffect } from "react";
import { useData } from "../DataContainer";
import "./styles.css";
import { useForm } from 'react-hook-form'

import { Button } from "@material-ui/core";
import { useHistory } from "react-router-dom";
import { makeStyles } from "@material-ui/core/styles";
import AppBar from "@material-ui/core/AppBar";
import Tabs from "@material-ui/core/Tabs";
import Tab from "@material-ui/core/Tab";
import Typography from "@material-ui/core/Typography";
import Box from "@material-ui/core/Box";
import { projectUpdate } from '../../../../api/api'
import Axios from "axios";
import SideBarSteps from "./SideBarSteps";

import ReactHtmlParser, { processNodes, convertNodeToElement, htmlparser2 } from 'react-html-parser';



const styles = {
  label: {
    color: '#646464d4',
    margin: 0,
    marginRight: '20px'
  },
  nav: {
    display: 'flex',
    justifyContent: 'center',
    padding: '20px',
  },
  p: {
    fontWeight: 'bold',
    border: '1px solid rgb(205 205 205)',
    textAlign: 'center',
    borderRadius: '10px',
    padding: '10px',
    boxShadow: '0 26px 30px #F2F2F2'
  }
}

function TabPanel(props) {
  const { children, value, index, ...other } = props;
  return (
    <div
      role="tabpanel"
      hidden={value !== index}
      id={`simple-tabpanel-${index}`}
      aria-labelledby={`simple-tab-${index}`}
      {...other}
    >
      {value === index && (
        <Box p={3}>
          <Typography>{children}</Typography>
        </Box>
      )}
    </div>
  );
}
function a11yProps(index) {
  return {
    id: `simple-tab-${index}`,
    "aria-controls": `simple-tabpanel-${index}`
  };
}


const useStyles = makeStyles((theme) => ({
  root: {
    // flexGrow: 1,
    backgroundColor: 'white'
  },
  tabs: {
    backgroundColor: "white",
    color: "black",
    boxShadow: '0 0 black'
  }
}));

const Result = (props) => {

  const { data } = useData();
  const { push } = useHistory();
  const classes = useStyles();
  const [value, setValue] = useState(0);
  const handleChange = (event, newValue) => {
    setValue(newValue);
  };

  const onChangeStep1 = data => {
    push("/manager/step1");
  };

  const onChangeStep2 = data => {
    push("/manager/step2");
  };



  const form_data = {
    title: data.title,
    language: data.language,
    country: data.country,
    apply_deadline: data.apply_deadline,
    complete_deadline: data.complete_deadline,
    subject: data.subject,
    type: data.type,

    script: data.script,
    rules: data.rules,

    budget: data.budget,
    tasks_per_speaker: data.tasks_per_speaker,
    environment: data.environment,
    minutes_per_tasks: data.minutes_per_tasks,
    tasks_count: data.tasks_count,

    gender: data.gender,
    voice: data.voice,
    speakers: data.speakers,
    level: data.level,
    user_id: props.user.id,
    users: data.users
    // uploadScript: formDataScript
    // uploadRules: data.uploadRules,
  }

  const [editorState, setEditorState] = useState();



  return (
    <>
      <SideBarSteps />
      <div className="block">
        <div className="block-header">
          <h2> Result </h2>
        </div>
        <div className="block-content" >
          <h2>Project summary</h2>
          <div className="row" >
            <div className="col-6" >
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Language</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.language}</p>
                  </div>
                </div>
              </div>
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Country</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.country}</p>
                  </div>
                </div>
              </div>
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Subject</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.subject}</p>
                  </div>
                </div>
              </div>
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Type</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.type}</p>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-6" >
              <div className="form-group">
                <label style={styles.label}>Script</label>
                <div className={classes.root}>
                  <AppBar className={classes.tabs} position="static">
                    <Tabs
                      value={value}
                      onChange={handleChange}
                      aria-label="simple tabs example"
                    >
                      <Tab label="Script" {...a11yProps(0)} />
                      <Tab label="Rules" {...a11yProps(1)} />
                    </Tabs>
                  </AppBar>
                  <TabPanel value={value} index={0}>{ReactHtmlParser(data.script)}</TabPanel>
                  <TabPanel value={value} index={1}>{ReactHtmlParser(data.rules)} </TabPanel>


                </div>
              </div>
            </div>
          </div>
          <div className="col-12">
            <div className="line in-row"></div>
          </div>
          <h2> Project options </h2>
          <div className="row" >
            <div className="col-6" >
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Total number  of tasks</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.speakers * data.tasks_per_speaker}</p>
                  </div>
                </div>
              </div>
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>speakers</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.speakers}</p>
                  </div>
                </div>
              </div>
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>tasks_per_speaker</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.tasks_per_speaker}</p>
                  </div>
                </div>
              </div>
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Minutes per task</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.minutes_per_tasks}</p>
                  </div>
                </div>
              </div>
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Budget per task</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>${data.budget}</p>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-6" >
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Summary tasks time</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.minutes_per_tasks * data.tasks_count} minutes</p>
                  </div>
                </div>
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Apply Deadline</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.apply_deadline}</p>
                  </div>
                </div>
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Complete Deadline</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.complete_deadline}</p>
                  </div>
                </div>
              </div>
              <div className="form-group">
                <div className="row" >
                  <div className="col-6" >
                    <label style={styles.label}>Summary budget</label>
                  </div>
                  <div className="col" >
                    <p style={styles.p}>{data.tasks_count * data.budget}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style={{
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center'
      }}>
        <div >
          <Button style={{ margin: '10px' }} variant="contained" color="secondary" onClick={onChangeStep1} > Edit Step 1</Button>
          <Button variant="contained" color="secondary" onClick={onChangeStep2} > Edit Step 2</Button>
        </div>
      </div>
    </>
  );
};

export default Result;

