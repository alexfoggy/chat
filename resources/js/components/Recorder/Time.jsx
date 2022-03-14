import React from 'react'

// const Block = ({time}) => {
// 	return (
//   	<div>
//       <div class="timer__time-block">{time}</div>
//     </div>
//   )
// }

const Btn = ({ name, className, onClickBtn }) => {
    return (
        <button className={className} onClick={() => { onClickBtn() }}>{name}</button>
    )
}

class Time extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            time: 2,
            nIntervId: null,
        };
    }

    numberConverter = (value) => {
        if (value < 10) {
            return `0${value}`;
        }
        return `${value}`;
    }

    addConstMin = (value) => {
        this.pauseTimer();
        let time = value * 60;
        this.setState({ time: time });
    }

    addHMS = (value) => {
        this.pauseTimer();
        let time = this.state.time;
        if (value === 'h') {
            time = time + 60 * 60;
        } else if (value === 'm') {
            time = time + 60;
        } else if (value === 's') {
            time = time + 1;
        }
        this.setState({ time: time });
    }

    timerStart = () => {
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
                    this.setState({ nIntervId: null,
                    time: 2 });
                }
            }, 1000);
        }
    }
    render() {
        const hours = this.numberConverter(Math.floor(this.state.time / 60 / 60))
        const minutes = this.numberConverter(Math.floor((this.state.time - hours * 60 * 60) / 60))
        const seconds = this.numberConverter(this.state.time - hours * 60 * 60 - minutes * 60)
        return (
            <div className="wrapper">
                <div className="timer">
                    <div className="timer__title">Timer</div>
                    <div className="timer__time">
                        {/* <div className="timer__time-block">{hours}</div>
                        <div className="timer__time-block">{minutes}</div>
                        <div className="timer__time-block">{seconds}</div> */}

                    </div>
                    <div className="timer__control-block">
                        <button onClick={this.timerStart}>start</button>
                        <button onClick={this.resetTimer}>reset</button>

                    </div>
                </div>
            </div>
        );
    }
};

export default Time