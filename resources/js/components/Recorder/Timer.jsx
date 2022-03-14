import React, { useState } from 'react'
import RecordBETA from './RecordBETA'


const Timer = (props) => {


  const [counter, setCounter] = React.useState(20);
  React.useEffect(() => {
    counter > 0 && setTimeout(() => setCounter(counter - 1), 1000)


  });





  return (
    <div>

      <div className="App">
        <div>Countdown: {counter === 0 ? "Time over" : counter}</div>
        {/* <RecordBETA time={props.start} /> */}
      </div>

    </div>
  );
}

export default Timer;