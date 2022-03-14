// console.log(123)
//
// let div = document.createElement('div');
// div.id = 'messages';
// let start = document.createElement('button');
// const record = document.querySelector('.record');
// const stop = document.querySelector('.stop');
// // const stopa = document.querySelector('.stopa');
// const soundClips = document.querySelector('.sound-clips');
// const canvas = document.querySelector('.visualizer');
// const mainSection = document.querySelector('.main-controls');
//
// navigator.mediaDevices.getUserMedia({ audio: true})
//     .then(stream => {
//         const mediaRecorder = new MediaRecorder(stream);
//
//         document.querySelector('#start').addEventListener('click', function(){
//             mediaRecorder.start();
//         });
//         let audioChunks = [];
//         mediaRecorder.addEventListener("dataavailable",function(event) {
//             audioChunks.push(event.data);
//         });
//
//         document.querySelector('#stop').addEventListener('click', function(){
//             mediaRecorder.stop();
//         });
//
//         mediaRecorder.addEventListener("stop", function() {
//             const audioBlob = new Blob(audioChunks, {
//                 type: 'audio/wav'
//             });
//
//             let fd = new FormData();
//             fd.append('voice', audioBlob);
//             sendVoice(fd);
//             audioChunks = [];
//         });
//     });
//
// async function sendVoice(form) {
//     let promise = await fetch(URL, {
//         method: 'POST',
//         body: form});
//     if (promise.ok) {
//         let response =  await promise.json();
//         console.log(response.data);
//         let audio = document.createElement('audio');
//         audio.src = response.data;
//         audio.controls = true;
//         audio.autoplay = true;
//         document.querySelector('#messages').appendChild(audio);
//     }
// }
