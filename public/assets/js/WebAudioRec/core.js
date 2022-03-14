//audio drawing

function colorPids(vol) {
    const allPids = [...document.querySelectorAll('.pid')];
    const numberOfPidsToColor = Math.round(vol / 10);
    const pidsToColor = allPids.slice(0, numberOfPidsToColor);
    for (const pid of allPids) {
        pid.style.backgroundColor = "#e6e7e8";
    }
    for (const pid of pidsToColor) {
        // console.log(pid[i]);
        pid.style.backgroundColor = "#69ce2b";
    }
}

(function () {
    let $recTime, $audioInLevel, $audioInSelect, $bufferSize, $cancel, $dateTime, $echoCancellation, $encoding,
        $encodingOption, $encodingProcess, $modalError, $modalLoading, $modalProgress, $record, $recording,
        $recordingList, $reportInterval, $testToneLevel, $timeDisplay, $timeLimit, BUFFER_SIZE, ENCODING_OPTION,
        MP3_BIT_RATE, OGG_KBPS, OGG_QUALITY, URL, audioContext, audioIn, audioInLevel, audioRecorder, defaultBufSz,
        disableControlsOnRecord, encodingProcess, iDefBufSz, minSecStr, mixer, onChangeAudioIn, onError, onGotAudioIn,
        onGotDevices, optionValue, plural, progressComplete, saveRecording, setProgress, startRecording, stopRecording,
        testTone, testToneLevel, updateBufferSizeText, updateDateTime, firstAudio;
    let autoUpload, autoSave;
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

    URL = window.URL || window.webkitURL;

    audioContext = new AudioContext;

    if (audioContext.createScriptProcessor == null) {
        audioContext.createScriptProcessor = audioContext.createJavaScriptNode;
    }

    //$testToneLevel = $('#test-tone-level');

    $audioInSelect = $('#audio-in-select');

    //$audioInLevel = $('#audio-in-level');

    //$echoCancellation = $('#echo-cancellation');

    $timeLimit = $('#infoBlock');

    //$encoding = $('input[name="encoding"]');

    $encodingOption = $('#encoding-option');

    //$encodingProcess = $('input[name="encoding-process"]');

    // $reportInterval = $('#report-interval');

    //$bufferSize = $('#buffer-size');

    $recording = $('#recording');

    $timeDisplay = $('#time-display');

    $record = $('#record');

    $cancel = $('#cancel');

    // $dateTime = $('#date-time');

    //$recordingList = $('#recording-list');

    $modalLoading = $('#modal-loading');

    $modalProgress = $('#modal-progress');

    $modalError = $('#modal-error');

    //$audioInLevel.attr('disabled', false);

    //$audioInLevel[0].valueAsNumber = 0;

    //$testToneLevel.attr('disabled', false);

    //$testToneLevel[0].valueAsNumber = 0;

    /*    $timeLimit.attr('disabled', false);

        $timeLimit[0].valueAsNumber = 3*/
    ;

    // $encoding.attr('disabled', false);
    //
    // $encoding[0].checked = true;

    //$encodingProcess.attr('disabled', false);

    //$encodingProcess[0].checked = true;

    /*$reportInterval.attr('disabled', false);

    $reportInterval[0].valueAsNumber = 1;*/

    //$bufferSize.attr('disabled', false);


    /*   testTone = (function() {
           var lfo, osc, oscMod, output;
           osc = audioContext.createOscillator();
           lfo = audioContext.createOscillator();
           lfo.type = 'square';
           lfo.frequency.value = 2;
           oscMod = audioContext.createGain();
           osc.connect(oscMod);
           lfo.connect(oscMod.gain);
           output = audioContext.createGain();
           output.gain.value = 0.5;
           oscMod.connect(output);
           osc.start();
           lfo.start();
           return output;
       })();

       testToneLevel = audioContext.createGain();

       testToneLevel.gain.value = 1;

       testTone.connect(testToneLevel);
   */
    audioInLevel = audioContext.createGain();

    audioInLevel.gain.value = 1;

    //console.log(audioInLevel);

    mixer = audioContext.createGain();

    //testToneLevel.connect(mixer);

    audioIn = void 0;

    audioInLevel.connect(mixer);

    let $enc = $('#infoBlock').attr('data-audio-format');

    // Shit repeats audio from micro
    //mixer.connect(audioContext.destination);
    //console.log(mixer);

    audioRecorder = new WebAudioRecorder(mixer, {
        workerDir: '/assets/js/WebAudioRec/',
        encoding: $enc,
        onEncoderLoading: function (recorder, encoding) {
            $modalLoading.find('.modal-title').html("Loading " + (encoding.toUpperCase()) + " encoder ...");
            $modalLoading.modal('show');
        },
    });

    audioRecorder.onEncoderLoaded = function () {
        $modalLoading.modal('hide');
    };

    /*    $testToneLevel.on('input', function() {
            var level;
            level = $testToneLevel[0].valueAsNumber / 100;
            testToneLevel.gain.value = level * level;
        });*/

    /* $audioInLevel.on('input', function() {
         var level;
         level = $audioInLevel[0].valueAsNumber / 100;
         audioInLevel.gain.value = level * level;
     });*/
    if ($audioInSelect) {
        onGotDevices = function (devInfos) {
            var index, info, name, options, _i, _len, g = 0;
            options = '';
            index = 0;
            for (_i = 0, _len = devInfos.length; _i < _len; _i++) {
                info = devInfos[_i];
                if (info.kind !== 'audioinput') {
                    if (g = 0) {
                        firstAudio = info.deviceId;
                        g++;
                    }
                    continue;
                }
                name = info.label || ("Audio in " + (++index));
                options += "<option value=" + info.deviceId + ">" + name + "</option>";
            }
            if (options == '') {
                options = '<option value="">You have no connected micro</option>';
            }
            $audioInSelect.html(options);
        };
    }

    onError = function (msg) {
        $modalError.find('.alert').html(msg);
        $modalError.modal('show');
    };

    if ((navigator.mediaDevices != null) && (navigator.mediaDevices.enumerateDevices != null)) {
        navigator.mediaDevices.enumerateDevices().then(onGotDevices)["catch"](function (err) {
            return onError("Could not enumerate audio devices: " + err);
        });
    } else {
        $audioInSelect.html('<option value="no-input" selected>(No input)</option><option value="default-audio-input">Default audio input</option>');
    }

    onGotAudioIn = function (stream) {
        if (audioIn != null) {
            audioIn.disconnect();
        }
        audioIn = audioContext.createMediaStreamSource(stream);
        audioIn.connect(audioInLevel);
        //return $audioInLevel.removeClass('hidden');
    };
    if ($audioInSelect[0]) {
        setTimeout(
            onChangeAudioIn = function (devId = null) {
                var constraint, deviceId;
                if (devId != null) {
                    deviceId = devId;
                } else {
                    deviceId = $audioInSelect[0].value;
                }
                //console.log(deviceId);
                if (deviceId === 'no-input') {
                    if (audioIn != null) {
                        audioIn.disconnect();
                    }
                    audioIn = void 0;
                    // $audioInLevel.addClass('hidden');
                } else {
                    if (deviceId === 'default-audio-input') {
                        deviceId = void 0;
                    }
                    constraint = {
                        audio: {
                            deviceId: deviceId != null ? {
                                exact: deviceId
                            } : void 0,
                        }
                    };
                    if ((navigator.mediaDevices != null) && (navigator.mediaDevices.getUserMedia != null)) {
                        navigator.mediaDevices.getUserMedia(constraint).then(onGotAudioIn)["catch"](function (err) {
                            return onError("Could not get audio media device: " + err);
                        });
                    } else {
                        navigator.getUserMedia(constraint, onGotAudioIn, function () {
                            return onError("Could not get audio media device: " + err);
                        });
                    }
                }
            }, 2000);
    }
    //$audioInSelect.on('change', onChangeAudioIn());

    // $(document).ready(onChangeAudioIn(firstAudio))


    //$echoCancellation.on('change', onChangeAudioIn);

    plural = function (n) {
        if (n > 1) {
            return 's';
        } else {
            return '';
        }
    };

    /* $timeLimit.on('input', function() {
         var min;
         min = $timeLimit[0].valueAsNumber;
         $('#time-limit-text').html("" + min + " minute" + (plural(min)));
     });*/

    OGG_QUALITY = [-0.1, 0.0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0];

    OGG_KBPS = [45, 64, 80, 96, 112, 128, 160, 192, 224, 256, 320, 500];

    MP3_BIT_RATE = [64, 80, 96, 112, 128, 160, 192, 224, 256, 320];

    ENCODING_OPTION = {
        wav: {
            label: '',
            hidden: true,
            max: 1,
            text: function (val) {
                return '';
            }
        },
        ogg: {
            label: 'Quality',
            hidden: false,
            max: OGG_QUALITY.length - 1,
            text: function (val) {
                return "" + (OGG_QUALITY[6].toFixed(1)) + " (~" + OGG_KBPS[5] + "kbps)";
            }
        },
        mp3: {
            label: 'Bit rate',
            hidden: false,
            max: MP3_BIT_RATE.length - 1,
            text: function (val) {
                return "" + MP3_BIT_RATE[4] + "kbps";
            }
        }
    };

    optionValue = {
        wav: null,
        ogg: 6,
        mp3: 5
    };

    //audioRecorder.encoding = $('#infoBlock').attr('data-audio-format');

    //console.log(audioRecorder,audioRecorder.encoding);

    // $encoding.on('click', function(event) {
    //     var encoding, option;
    //     encoding = $(event.target).attr('encoding');
    //     audioRecorder.setEncoding(encoding);
    //     option = ENCODING_OPTION[encoding];
    //     $('#encoding-option-label').html(option.label);
    //     $('#encoding-option-text').html(option.text(optionValue[encoding]));
    //     $encodingOption.toggleClass('hidden', option.hidden).attr('max', option.max);
    //     $encodingOption[0].valueAsNumber = optionValue[encoding];
    // });

    /*    $encodingOption.on('input', function() {
            var encoding, option;
            encoding = audioRecorder.encoding;
            option = ENCODING_OPTION[encoding];
            optionValue[encoding] = $encodingOption[0].valueAsNumber;
            $('#encoding-option-text').html(option.text(optionValue[encoding]));
        });*/

    encodingProcess = 'background';

    /* $encodingProcess.on('click', function(event) {
         var hidden;
         encodingProcess = $(event.target).attr('mode');
         hidden = encodingProcess === 'background';
         $('#report-interval-label').toggleClass('hidden', hidden);
         $reportInterval.toggleClass('hidden', hidden);
         $('#report-interval-text').toggleClass('hidden', hidden);
     });*/

    /*  $reportInterval.on('input', function() {
          var sec;
          sec = $reportInterval[0].valueAsNumber;
          $('#report-interval-text').html("" + sec + " second" + (plural(sec)));
      });*/

    defaultBufSz = (function () {
        var processor;
        processor = audioContext.createScriptProcessor(void 0, 2, 2);
        return processor.bufferSize;
    })();

    BUFFER_SIZE = [256, 512, 1024, 2048, 4096, 8192, 16384];

    iDefBufSz = BUFFER_SIZE.indexOf(defaultBufSz);

    /* updateBufferSizeText = function() {
         var iBufSz, text;
         iBufSz = $bufferSize[0].valueAsNumber;
         text = "" + BUFFER_SIZE[iBufSz];
         if (iBufSz === iDefBufSz) {
             text += ' (browser default)';
         }
         $('#buffer-size-text').html(text);
     };*/

    //$bufferSize.on('input', updateBufferSizeText);

    // $bufferSize[0].valueAsNumber = iDefBufSz;

    //updateBufferSizeText();

    saveRecording = function (blob, enc) {
        var html, time, url;
        time = new Date();
        url = URL.createObjectURL(blob);
        html = ("<p recording='" + url + "'>") + ("<audio controls src='" + url + "'></audio> ") + ("(" + enc + ") " + (time.toString()) + " ") + ("<a class='btn btn-default' href='" + url + "' download='recording." + enc + "'>") + "Save..." + "</a> " + ("<button class='btn btn-danger' recording='" + url + "'>Delete</button>");
        "</p>";
        //$recordingList.prepend($(html));
    };

    /*$recordingList.on('click', 'button', function(event) {
        var url;
        url = $(event.target).attr('recording');
        $("p[recording='" + url + "']").remove();
        URL.revokeObjectURL(url);
    });*/

    minSecStr = function (n) {
        return (n < 10 ? "0" : "") + n;
    };

    updateDateTime = function () {
        var sec;
        //$dateTime.html((new Date).toString());
        sec = parseInt($('#infoBlock').attr('data-time-recordered')) + +audioRecorder.recordingTime() | 0;
        $timeDisplay.html("" + (minSecStr(sec / 60 | 0)) + ":" + (minSecStr(sec % 60)));
    };

    window.setInterval(updateDateTime, 50);

    progressComplete = false;

    setProgress = function (progress) {
        var percent;
        percent = "" + ((progress * 100).toFixed(1)) + "%";
        $modalProgress.find('.progress-bar').attr('style', "width: " + percent + ";");
        $modalProgress.find('.text-center').html(percent);
        progressComplete = progress === 1;
    };

    $modalProgress.on('hide.bs.modal', function () {
        if (!progressComplete) {
            audioRecorder.cancelEncoding();
        }
    });

    disableControlsOnRecord = function (disabled) {
        $audioInSelect.attr('disabled', disabled);
    };

    startRecording = function () {

        navigator.mediaDevices.getUserMedia({audio: true}).then(stream => {
            $recording.removeClass('hidden');
            $record.addClass('animation-alert');
            $record.html('<i class="fa fa-microphone"></i> <span class="ml-1">Stop|Pause</span>');
            $cancel.removeClass('hidden');
            disableControlsOnRecord(true);
            audioRecorder.setOptions({
                timeLimit: $timeLimit.attr('data-time-limit'),
                encodeAfterRecord: encodingProcess === 'separate',
                //progressInterval: $reportInterval[0].valueAsNumber * 1000,
                ogg: {
                    quality: OGG_QUALITY[optionValue.ogg]
                },
                mp3: {
                    bitRate: MP3_BIT_RATE[optionValue.mp3]
                }
            });
            audioRecorder.startRecording();
            setProgress(0);
        }).catch(err => {
            alert(err);
        });

    };
    stopRecording = function (finish) {
        $('.time-display').addClass('opacity-0');
        $recording.addClass('hidden');
        $record.removeClass('animation-alert');
        $record.html('<i class="fa fa-microphone"></i> <span class="ml-1">Continue recording</span>');
        $cancel.addClass('hidden');

        $recTime = audioRecorder.recordingTime();

        disableControlsOnRecord(false);
        if (finish) {
            audioRecorder.finishRecording();
            if (audioRecorder.options.encodeAfterRecord) {
                $modalProgress.find('.modal-title').html("Encoding " + (audioRecorder.encoding.toUpperCase()));
                $modalProgress.modal('show');
            }
        } else {
            audioRecorder.cancelRecording();
        }
    };

    // Interval to check time

    setInterval(function () {
        if (audioRecorder.recordingTime() >= '30') {
            $recTime = audioRecorder.recordingTime();
            audioRecorder.finishRecording();
            if ($('#infoBlock').attr('data-time-limit') > '30') {
                startRecording();
            }
        else
            {
                $('.loading').fadeIn();
                $record.removeClass('animation-alert');
                $record.html('<i class="fa fa-microphone"></i> <span class="ml-1">Finished</span>');
            }
        }
    }, 100);

    // Verify time limit

    setInterval(function () {
        let time = $('#infoBlock').attr('data-time-limit');
        let currTime = audioRecorder.recordingTime();
        if (currTime) {
            if (time <= currTime) {
                stopRecording(true);
                audioRecorder.finishRecording();
            }
        }


    }, 300);


// analiz micro

    navigator.mediaDevices.getUserMedia({
        audio: true,
    })
        .then(function (stream) {
            const audioContext = new AudioContext();
            const analyser = audioContext.createAnalyser();
            const microphone = audioContext.createMediaStreamSource(stream);
            const scriptProcessor = audioContext.createScriptProcessor(2048, 1, 1);

            analyser.smoothingTimeConstant = 0.8;
            analyser.fftSize = 1024;

            microphone.connect(analyser);
            analyser.connect(scriptProcessor);
            scriptProcessor.connect(audioContext.destination);
            scriptProcessor.onaudioprocess = function () {
                const array = new Uint8Array(analyser.frequencyBinCount);
                analyser.getByteFrequencyData(array);
                const arraySum = array.reduce((a, value) => a + value, 0);
                const average = arraySum / array.length;
                //console.log(average,array.length,arraySum);
                colorPids(average);
            };
        })
        .catch(function (err) {
            /* handle the error */
            console.error(err);
        });


    $record.on('click', function () {
        if (audioRecorder.isRecording()) {
            stopRecording(true);
        } else {
            if ($('#infoBlock').attr('data-time-limit') > 0) {
                startRecording();
            }
            else {

            }
        }
    });

    $cancel.on('click', function () {
        stopRecording(false);
    });

    audioRecorder.onTimeout = function (recorder) {
        stopRecording(true);
    };

    audioRecorder.onEncodingProgress = function (recorder, progress) {
        setProgress(progress);
    };

    audioRecorder.onComplete = function (recorder, blob) {
        if (recorder.options.encodeAfterRecord) {
            $modalProgress.modal('hide');
        }
        saveRecording(blob, recorder.encoding);
        let route = $('#infoBlock').attr('data-send-route');
        let metaType = $('#infoBlock').attr('data-audio-format');
        var formData = new FormData();
        formData.append("mediaBlob", blob, "blob");
        formData.append("fileName", 'mediaBlob.webm');
        formData.append("metaType", metaType);
        formData.append("duration", $recTime);

        var request = new XMLHttpRequest();
        request.open('POST', route, true);

        request.onload = function (evt) {
            //$('.loading').fadeOut();
            var jsonObj = JSON.parse(request.response);
            //$('.timeLeft').text(jsonObj.timeLeft);
            $('.timeDone').text(jsonObj.timeHead);
            $('#infoBlock').attr('data-time-limit', jsonObj.time);
            $('#infoBlock').attr('data-time-recordered', jsonObj.timeDone);
            $('.time-display').addClass('opacity-100');
            // send for concatination and verification
            if(jsonObj.time < 1) {
                $('.message-loading').text('Uploading your task, please wait');
                $('.loading').fadeIn();
                $.ajax({
                    url: "/api/checkAudio?taskId=" + jsonObj.task_id,
                    type: "GET",
                    success: function (response) {
                        //createNewRowRecord('/storage/' + response.url, response.audio_id, 'audio-preview');
                        $('.loading').fadeOut();
                        $('.pids-wrapper').addClass('active');
                        setTimeout(location.reload(),3000);
                    },
                    error: function (error) {
                        alertAppend(error.responseJSON.message, 'danger', 'oh nooo!');
                        $('.loading').fadeOut();
                    }
                });
            }

        };
        request.onerror = function (evt) {
            console.log(Error("Error fetching data."));
        };
        request.send(formData);
    };
    audioRecorder.onError = function (recorder, message) {
        onError(message);
    };
}).call(this);


