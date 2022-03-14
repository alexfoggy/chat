import React, { useState } from 'react'


import "./styles.css";


import SwipeableViews from 'react-swipeable-views';
import { makeStyles, useTheme } from '@material-ui/core/styles';
import AppBar from '@material-ui/core/AppBar';
import Tabs from '@material-ui/core/Tabs';
import Tab from '@material-ui/core/Tab';
import Typography from '@material-ui/core/Typography';
import Box from '@material-ui/core/Box';
import ReactAudioPlayer from 'react-audio-player';
import { Button } from '@material-ui/core';



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

function TabPanel(props) {
    const { children, value, index, ...other } = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`full-width-tabpanel-${index}`}
            aria-labelledby={`full-width-tab-${index}`}
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
        id: `full-width-tab-${index}`,
        'aria-controls': `full-width-tabpanel-${index}`,
    };
}






const Project = (props) => {
    console.log(props)

    const language = props.language
    console.log(language[0].name)


    const classes = useStyles();
    const theme = useTheme();
    const [value, setValue] = React.useState(0);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    const handleChangeIndex = (index) => {
        setValue(index);
    };


    const [disabledButtons, setDisabledButtons] = useState([])

    const SendTasks = (id, complete_status, index) => {
        axios.put(`/api/tasks/${id}`, { complete_status }).then(res => { })
        const newDisabledButtons = [...disabledButtons];
        newDisabledButtons[index] = true;
        setDisabledButtons(newDisabledButtons)

    }


    return (
        <>
            <div className={classes.root}>
                <AppBar position="static" color="default">
                    <Tabs
                        value={value}
                        onChange={handleChange}
                        indicatorColor="primary"
                        textColor="primary"
                        variant="fullWidth"
                        aria-label="full width tabs example"
                    >
                        <Tab label="Result" {...a11yProps(0)} />
                        <Tab label="Tasks" {...a11yProps(1)} />
                    </Tabs>
                </AppBar>
                <SwipeableViews
                    axis={theme.direction === 'rtl' ? 'x-reverse' : 'x'}
                    index={value}
                    onChangeIndex={handleChangeIndex}
                >

                    <div value={value} index={0} dir={theme.direction} className="block">
                        <div className="block-header">
                            <h2> Result </h2>
                        </div>
                        <div className="block-content" >
                            <h2>{props.title}</h2>
                            <div className="row" >
                                <div className="col-6" >
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>Language</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{language[0].name == undefined ? 'HUI' : language[0].name}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>Country</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{props.country}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>Subject</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{props.subject} </p>

                                            </div>
                                        </div>
                                    </div>
                                    {/* <div className="form-group">
                            <div className="row" >
                                <div className="col-6" >
                                    <label style={styles.label}>Type</label>
                                </div>
                                <div className="col" >
                                    <p style={styles.p}>data.type</p>
                                </div>
                            </div>
                        </div> */}
                                </div>
                                <div className="col-6" >
                                    <div className="form-group">
                                        <label style={styles.label}>Script</label>
                                        <div className={classes.root}>
                                            {/* <AppBar className={classes.tabs} position="static">
                                    <Tabs
                                        value={value}
                                        onChange={handleChange}
                                        aria-label="simple tabs example"
                                    >
                                        <Tab label="Script" {...a11yProps(0)} />
                                        <Tab label="Rules" {...a11yProps(1)} />
                                    </Tabs>
                                </AppBar>
                                <TabPanel value={value} index={0}>Script</TabPanel>
                                <TabPanel value={value} index={1}>Rules </TabPanel> */}
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
                                                <label style={styles.label}> Total number of tasks</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{props.tasks_count}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>speakers</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{props.speakers}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>tasks_per_speaker</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{props.tasks_per_speaker}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>Minutes per task</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{props.minutes_per_tasks}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>Budget per task</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>${props.budget}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>Type</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{props.type}</p>
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
                                                <p style={styles.p}>{props.minutes_per_tasks * props.tasks_count}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>Summary budget</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>${props.tasks_count * props.budget}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-6" >
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>Apply deadline</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{props.apply_deadline}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div className="row" >
                                            <div className="col-6" >
                                                <label style={styles.label}>Complete deadline</label>
                                            </div>
                                            <div className="col" >
                                                <p style={styles.p}>{props.complete_deadline}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {/* <TabPanel > */}
                    <div value={value} index={1} dir={theme.direction} >
                        {props.tasks.map((p, index) =>
                            <div key={p.id} className="task" style={{ width: '100%' }}>
                                <div >

                                    {/* <div>ID</div> */}
                                    <small style={{ margin: 0 }} className="price">{p.id}</small>
                                </div>
                                <div >
                                    {/* <div>Status</div> */}
                                    <small style={{ padding: 0 }}>{p.complete_status}</small>
                                </div>
                                <div >
                                    {/* <div>User</div> */}
                                    {p.user.map(u =>
                                        <div key={u.id}>
                                            <small className="length">{u.first_name === undefined ? 'NaN' : u.first_name} </small>
                                            <small className="length">{u.last_name === undefined ? 'NaN' : u.last_name}</small>
                                        </div>
                                    )}

                                </div>

                                <div >
                                    {p.records.map(r =>
                                        <div key={r.id}>
                                            {p.complete_status === 'new' ? console.log('true') : console.log('false')}
                                            {/* <ReactAudioPlayer controls src={r.path  !== undefined ? r.records.path : '/'} /> */}
                                            <ReactAudioPlayer controls src={`/storage/${r.path}`} />
                                        </div>
                                    )}


                                </div>

                                {p.complete_status === 'new' ||
                                    p.complete_status == 'in_progress' ||
                                    p.complete_status === 'invoiced' ||
                                    p.complete_status === 'ready_to_invoice' ? '' : <Button

                                        disabled={disabledButtons[index]}

                                        color="secondary"
                                        variant="contained"
                                        onClick={() => SendTasks(p.id, 'ready_to_invoice', index)}>Approved</Button>}
                            </div>
                        )
                        }
                    </div>
                </SwipeableViews>
            </div>

        </>
    )
}
export default Project
