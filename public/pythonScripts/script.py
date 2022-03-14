#!C:\Users\Igor Polilingua\AppData\Local\Programs\Python\Python38\python.exe

# import os
# import urllib.parse

# sent_query = os.environ['QUERY_STRING']
# query_list = sent_query.split('=')
# query_list = urllib.parse.parse_qs(os.environ['QUERY_STRING'])

import os
import pydub

from pydub import AudioSegment
import sys

input = sys.argv

input1 = input[1]
input2 = input[2]


sound1 = AudioSegment.from_wav(input1)
sound2 = AudioSegment.from_wav(input2)

combined_sounds = sound1 + sound2
combined_sounds.export(input1, format="wav")

os.remove(input2) 

# combined_sounds = sound1 + sound2
# combined_sounds.export("/audioTe22sadst.wav", format="wav")

print('work')
#os.remove("demofile.txt") 

 