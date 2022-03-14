import { Send } from '@material-ui/icons';
import React from 'react'
// import MicRecorder from 'mic-recorder-to-mp3'
import MicRecorder from '../../recorder/index'
import AudioAnalyser from './AnalyserBETA/AudioAnalyser';
import { updateStatus } from '../../api/api'
// import "./Recorder.css"
import Player from './AudioPlayer'
import { UncontrolledCollapse, Button, CardBody, Card } from 'reactstrap';
import RecordButton from '@material-ui/core/Button';
import InDrawer from './Drawer'
import { Alert } from 'reactstrap';
import './Recorder.css'
import ReactAudioPlayer from 'react-audio-player';



const Mp3Recorder = new MicRecorder({ bitRate: 128 });


class RecorderBETA extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            //RECORDER
            isRecording: false,
            blobURL: '',
            isBlocked: false,
            resume: false,
            //Timer
            date: new Date(),
            time: 321,
            nIntervId: null,
            //CANVAS
            audio: null,
            blob: '',
            silence: false,
            //ALERTS
            succes: false
        }
        this.toggleMicrophone = this.toggleMicrophone.bind(this)
    }
    //CANVAS
    async getMicrophone() {
        const audio = await navigator.mediaDevices.getUserMedia({
            audio: true,
            video: false
        });
        this.setState({ audio });
    }
    stopMicrophone() {
        this.state.audio.getTracks().forEach(track => track.stop());
        this.setState({ audio: null });
    }
    toggleMicrophone() {
        if (this.state.audio) {
            this.stopMicrophone();
        } else {
            this.getMicrophone();
        }
    }

    //CANVAS

    componentDidMount() {
        updateStatus(`${this.props.taskId}`, 'Claimed')
        function detectSilence(stream, onSoundEnd = _ => { }, silence_delay = 2000, min_decibels = -80) {
            const ctx = new AudioContext();
            const analyser = ctx.createAnalyser();
            const streamNode = ctx.createMediaStreamSource(stream);
            streamNode.connect(analyser);
            analyser.minDecibels = min_decibels;

            const data = new Uint8Array(analyser.frequencyBinCount); // will hold our data
            let silence_start = performance.now();
            let triggered = false; // trigger only once per silence event

            const loop = (time) => {
                requestAnimationFrame(loop); // we'll loop every 60th of a second to check
                analyser.getByteFrequencyData(data); // get current data
                if (data.some(v => v)) { // if there is data above the given db limit
                    if (triggered) {
                        triggered = false;
                    }
                    silence_start = time; // set it to now
                }
                if (!triggered && time - silence_start > silence_delay) {
                    onSoundEnd();
                    triggered = true;
                } if (!triggered && time - silence_start > silence_delay) {
                    onSoundEnd();
                    triggered = true;
                }
            }
            loop();
        }
        const pauseTimer = () => {
            let { nIntervId } = this.state;
            if (nIntervId) {
                clearInterval(nIntervId);
                this.setState({ nIntervId: null });
            }
        }
        const pauseRecord = () => {
            Mp3Recorder.pause()
            this.setState({
                silence: true
            })
            console.log('Silence');
            pauseTimer()
        }
        navigator.mediaDevices.getUserMedia({
            audio: true
        }).then(stream => {
            detectSilence(stream, pauseRecord, 20000, -70);
        }).catch(e => console.log(e));
    }
    componentWillUnmount() {
        clearInterval(this.timerID);
    }
    numberConverter = (value) => {
        if (value < 10) {
            return `0${value}`;
        }
        return `${value}`;
    }
    render() {
        const timerStart = () => {
            let { nIntervId } = this.state;
            let { time } = this.state;
            if (!nIntervId && time > 0) {
                nIntervId = setInterval(() => {
                    if (time > 0) {
                        time = time - 1;
                        this.setState({ time: time });
                        this.setState({ nIntervId: nIntervId });
                    } else {
                        clearInterval(nIntervId);
                        this.setState({
                            nIntervId: null,
                            time: 5
                        });
                        stopRecord()
                        this.stopMicrophone()
                    }
                }, 1000);
            }
        }
        const startRecord = () => {
            this.setState({
                silence: false
            })
            if (this.state.isBlocked) {
            } else {
                Mp3Recorder
                    .start()
                    .then(() => {
                        this.setState({ isRecording: true });
                    }).catch((e) => console.error(e));
            }
            timerStart()
            this.getMicrophone()
        };
        const resumeRecord = () => {
            this.setState({
                silence: false
            })
            timerStart()
            Mp3Recorder
                .resume()
        }
        const stopRecord = () => {
            Mp3Recorder
                .stop()
                .Wav()
                .then(([buffer, blob]) => {
                    const blobURL = URL.createObjectURL(blob)
                    // var xhr = new XMLHttpRequest()
                    this.setState({ blobURL, blob, isRecording: false, succes: true });
                }).catch((e) => console.log(e));
        }
        const Send = () => {
            updateStatus(`${this.props.taskId}`, 'in_progress')
            const blobd = this.state.blob
            const csrf = document.getElementById('csrf_token').getAttribute('content')
            var xhr = new XMLHttpRequest();
            xhr.onload = (e) => {
                if (this.readyState === 4) {
                    alert("Server returned: ", e.target.responseText);
                }
            };
            var fd = new FormData();
            fd.append("audio_data", blobd, "filename",);
            fd.append("token", this.props.user.token);
            fd.append("id", this.props.taskId);
            xhr.open("POST", "/cabinet/records", true);
            xhr.setRequestHeader('X-CSRF-TOKEN', csrf)
            xhr.send(fd);
        }
        const hours = this.numberConverter(Math.floor(this.state.time / 60 / 60))
        const minutes = this.numberConverter(Math.floor((this.state.time - hours * 60 * 60) / 60))
        const seconds = this.numberConverter(this.state.time - hours * 60 * 60 - minutes * 60)
    

        return (
            <div>
                <h3 style={{ fontSize: '30px' }}>{this.props.desc}</h3>
                <h4 style={{ fontSize: '20px' }} >{this.props.title}</h4>
                <small className="price">$ {this.props.price} </small>
                <p>Deadline </p>
                <p>{this.props.complete_deadline}</p>
                <ReactAudioPlayer
                src={this.state.blobURL}
                 controls />
                <Button
                    className='button'
                    color="primary"
                    id="toggler" style={{ marginBottom: '1rem' }}>
                    Start</Button>
                <UncontrolledCollapse toggler="#toggler">
                    <Card>
                        <CardBody>
                            <div>
                                {this.state.isRecording ? <RecordButton onClick={resumeRecord} >Resume</RecordButton>
                                    : <RecordButton style={{ background: "#E22A7F" }} disabled={this.state.isRecording} onClick={startRecord} variant="contained" color="secondary"> Record</RecordButton>
                                }

                                <Player src={this.state.blobURL} />
                                <div className="timer__time-block">
                                    {hours}:{minutes}:{seconds}
                                </div>
                                <div className="timer__time-block"></div>
                                <div className="App">
                                    <div className="controls">
                                    </div>
                                    {this.state.silence ?
                                        <Alert color="danger"> Silence </Alert> : ''}
                                    {this.state.audio ? <AudioAnalyser audio={this.state.audio} /> : ''}
                                    { !this.state.isRecording ? <Button color="secondary" variant="contained" onClick={() => Send()}  >SENND</Button>
                                    :  <Button color="secondary" variant="contained"  onClick={() => Send()} >NESEND</Button>
                                }
                                    {/* <button onClick={() => Send()}  >Send</button> */}
                                    {this.state.succes ? <Alert color="success">Succes</Alert> : ''}

                                </div>
                            </div>

                        </CardBody>
                    </Card>
                </UncontrolledCollapse>
            </div>
        );
    }
}

export default RecorderBETA;
