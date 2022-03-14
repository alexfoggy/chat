# import sys

# input = sys.argv

# input1 = input[1]

# from scipy.io import wavfile
# samplerate, data = wavfile.read(input1)
# maxVolume = 0.5
# isLoud = False
# print(samplerate)
# for i in data:
#     if i > maxVolume:
#         isLoud = True
#         break
# if isLoud:
#    print("Loud")

import base64, os, uuid
import librosa as lr
import sys
import json

input = sys.argv

input1 = input[1]

from pydub import AudioSegment, silence

myaudio = AudioSegment.from_wav(input1)

silence = silence.detect_silence(myaudio, min_silence_len=1000, silence_thresh=-16)

silence = [((start/1000),(stop/1000)) for start,stop in silence] #convert to sec

#print(silence,myaudio.duration_seconds)

print(json.dumps({'duration': myaudio.duration_seconds}))















# def get_percentage_of_non_silence_from_wav_file(file):
#     audio, frames_per_second = lr.load(file)
#     intervals = lr.effects.split(audio,
#                                  top_db=30,
#                                  frame_length=frames_per_second * 4,
#                                  hop_length=int(frames_per_second * 0.67))
#     trimmed_length = 0
#     for interval in intervals:
#         start, end = interval
#         trimmed_length += end - start
#     print(trimmed_length)
#     print(len(audio))
#     return trimmed_length / len(audio) * 100

# rate = get_percentage_of_non_silence_from_wav_file(input[1])

# print(rate)

