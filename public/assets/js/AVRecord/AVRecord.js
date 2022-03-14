/**
 * @file
 * Provides JavaScript additions to the media recorder element.
 *
 * This file loads the correct media recorder javascript based on detected
 * features, such as the MediaRecorder API and Web Audio API.
 *
 */

(function ($) {
    'use strict';

    $.fn.AvRecorder = function (id, conf) {
        // Normalize features.
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia;
        window.AudioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext;
        window.URL = window.URL || window.webkitURL;

        // Feature detection.
        var getUserMediaCheck = typeof (navigator.getUserMedia || navigator.mediaDevices.getUserMedia) === 'function';
        var mediaRecorderCheck = typeof (window.MediaRecorder) === 'function';
        var webAudioCheck = typeof (window.AudioContext) === 'function';

        // Set recorder type.
        var recorderType = false;
        if (getUserMediaCheck && webAudioCheck && mediaRecorderCheck) {
            //Use browser based MediaRecorder API
            recorderType = 'AvRecorder';
        }
        else if (getUserMediaCheck && webAudioCheck && !mediaRecorderCheck) {
            //Fallback to use RecorderJS
            recorderType = 'AvRecorderHTML5';
        }

        console.log("Recording type = " + recorderType);

        var $avRecorder = $('#' + id);
        var $avRecorderFallback =  $('#' + id + '-fallback-ajax-wrapper');

        //Template for recorder HTML
        var recorderHtml = "<div class='av-recorder panel panel-primary rounded-5'>\
				<div class='panel-heading'>\
					<h3 class='av-recorder-status panel-title lead tx-18 mt-2'>Click 'Turn on micro' to enable your mic.</h3>\
				</div>\
				<div class='av-recorder-preview panel-body' style='display: none;'>\
					<div class='loader' style='display: none;'></div>\
					<video class='av-recorder-video' style='display: none;'></video>\
					<audio class='av-recorder-audio' controls='' style='display: none;'></audio>\
				</div>\
				<div class='av-recorder-progress progress mb-2 rounded-5' style='display: none;'>\
					<div class='progress-bar' role='progressbar'></div>\
				</div>\
				<div class='panel-footer'>\
					<div class='av-recorder-controls'>\
						<button\
							class='btn btn-primary rounded-5 btn-lg btn-inline mt-3 av-recorder-enable'\
							title='Click to enable your mic.'>Turn on micro</button>\
						<button\
							class='btn btn-danger rounded-5 btn-lg btn-inline av-recorder-record'\
							title='Click to start recording.' style='display: none;'>\
							<span class='glyphicon glyphicon-record'></span> <i class=\"fa fa-microphone\"></i> \
						</button>\
						<button\
							class='btn btn-success btn-lg btn-inline av-recorder-play'\
							title='Click to play recording.' style='display: none;'>\
							<span class='glyphicon glyphicon-play'></span> Play\
						</button>\
						<button\
							class='btn btn-danger rounded-5 animation-alert btn-lg btn-inline av-recorder-stop position-relative'\
							title='Click to stop recording.' style='display: none;'>\
							<span class='glyphicon glyphicon-stop'></span> <i class=\"fa fa-microphone\"></i>\
							<canvas class='av-recorder-meter' style='display: none;'></canvas>\
						</button>\
						<button\
							class='btn btn-info btn-lg btn-inline av-recorder-pause'\
							title='Click to stop recording.' style='display: none;'>\
							<span class='glyphicon glyphicon-stop'></span> Pause\
						</button>\
						<button\
							class='btn btn-primary btn-lg btn-inline av-recorder-settings'\
							title='Click to access settings.'>\
							<span class='glyphicon glyphicon-cog'></span> Settings\
						</button>\
						<button\
							class='btn btn-primary btn-lg btn-inline av-recorder-enable-audio'\
							title='Click to enable your mic.' style='display: none;'>\
							<span class='glyphicon glyphicon-headphones'></span> Audio\
						</button>\
						<button\
							class='btn btn-success btn-lg btn-inline av-recorder-enable-video'\
							title='Click to enable your camera.' style='display: none;'>\
							<span class='glyphicon glyphicon-facetime-video'></span> Video\
						</button>\
					</div>\
				</div>\
			</div>";

        //Insert the recorder's inner html to the root element.
        $avRecorder.append(recorderHtml);

        switch (recorderType) {
            case 'AvRecorder':
                $avRecorder.show();
                $avRecorderFallback.hide();
                new $('#' + id).AvRecorderMoz(id, conf);
                break;
            case 'AvRecorderHTML5':
                $avRecorder.show();
                $avRecorderFallback.hide();
                new $('#' + id).AvRecorderHTML5(id, conf);
                break;
            default:
                $avRecorder.hide();
        }
    }
})(jQuery);

