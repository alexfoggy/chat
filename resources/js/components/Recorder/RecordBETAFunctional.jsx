
import React, {useState} from 'react'
import MicRecorder from 'mic-recorder-to-mp3'
const Mp3Recorder = new MicRecorder({ bitRate: 128 });

const RecordBETAFunctional=()=> {
    const [recorder, setRecorder] = useState({
        isRecording: false,
        blobURL: '',
        isBlocked: false,
        a: 0
    });
    const [timer, setTimer] = useState({
        time: 2,
        nIntervId: null,
    })
//     const [counter, setCounter] = React.useState(20);
//   React.useEffect(() => {
//     counter > 0 && setTimeout(() => setCounter(counter - 1), 1000);
//   }, [counter]);


  const   numberConverter = (value) => {
        if (value < 10) {
            return `0${value}`;
        }
        return `${value}`;
    }

  const   timerStart = () => {
        let nIntervId= timer.nIntervId 
        let time = timer.nIntervId 
        if (!timer.nIntervId && time > 0) {
            nIntervId = setInterval(() => {
                if (time > 0) {
                    time = time - 1;
                   setTimer({ time: time });
                   setTimer({ nIntervId: nIntervId });
                } else {
                    clearInterval(nIntervId);
                  setTimer({
                        time: this.props.time,
                        nIntervId: null });
                }
            }, 1000);
        }
    }


    const [counter, setCounter] = React.useState(20);
  React.useEffect(() => {
    counter > 0 && setTimeout(() => setCounter(counter - 1), 1000);
  }, );


    const hours = numberConverter(Math.floor(timer.time / 60 / 60))
    const minutes = numberConverter(Math.floor((timer.time - hours * 60 * 60) / 60))
    const seconds = numberConverter(timer.time - hours * 60 * 60 - minutes * 60)
        const startRecord = () => {
            if (recorder.isBlocked) {
                console.log('Permission Denied');
            } else {
                Mp3Recorder
                    .start()
                    .then(() => {
                        setRecorder({ isRecording: true, a:1 });
                    }).catch((e) => console.error(e));
                    // .then(() => {
                    //     this.setState({ isRecording: true });
                    // }).catch((e) => console.error(e));
            }
            timerStart()
        };
console.log(recorder.a)
        const pauseRecord = () => {
            Mp3Recorder.pause()
        }
        const resumeRecord = () => {
            Mp3Recorder
                .resume()
        }
        const stopRecord = () => {
            Mp3Recorder
                .stop()
                .Wav()
                .then(([buffer, blob]) => {
                    const blobURL = URL.createObjectURL(blob)
                    setRecorder({ blobURL, isRecording: false , a:3});
                }).catch((e) => console.log(e));
        }

        function detectSilence(stream, onSoundEnd = _ => { }, silence_delay = 2 * 10, min_decibels = -80) {
            const ctx = new AudioContext();
            const analyser = ctx.createAnalyser();
            const streamNode = ctx.createMediaStreamSource(stream);
            streamNode.connect(analyser);
            analyser.minDecibels = min_decibels;

            const data = new Uint8Array(analyser.frequencyBinCount); // will hold our data
            let silence_start = performance.now();
            let triggered = false; // trigger only once per silence event

            const loop = (time, pauseRecording) => {
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


        const onSilence = () => {
            pauseRecord()
            console.log('Silence');

        }

        navigator.mediaDevices.getUserMedia({
            audio: true
        }).then(stream => {
            detectSilence(stream, onSilence, 2000, -70);
            // do something else with the stream
        }).catch(e => console.log(e));
        //RECORDER 
        return (
            <div>
                <button onClick={startRecord} > Record</button>
                <button onClick={resumeRecord} >Resume</button>
                <button onClick={stopRecord} >Stop</button>
                <div className="timer__time-block">{hours}</div>
                        <div className="timer__time-block">{minutes}</div>
                        <div className="timer__time-block">{seconds}</div>


                        <div className="App">
      {/* <div>Countdown: {counter === 0 ? "Time over" : counter}</div> */}
    </div>
 
                <audio  controls="controls" />
                {/* {console.log(<audio src={this.state.blobURL} controls="controls" />)} */}
            </div>
        );
    }

export default RecordBETAFunctional;