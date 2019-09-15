from __future__ import print_function, division
import numpy as np
import cv2
import pyaudio
import wave
import threading
import time
import subprocess
import os
import pyaudio
import wave
from array import array
import speech_recognition as sr
from nltk.corpus import wordnet
from nltk.tokenize import word_tokenize
import pythoncom
import win32com.client as client
r=sr.Recognizer()
from sys import byteorder
from struct import pack
from tkinter import *


THRESHOLD = 300
CHUNK_SIZE = 700
FORMAT = pyaudio.paInt16
RATE = 44100
CHANNELS=1

def is_silent(snd_data):
    "Returns 'True' if below the 'silent' threshold"
    return max(snd_data) < THRESHOLD

def normalize(snd_data):
    "Average the volume out"
    MAXIMUM = 16384
    times = float(MAXIMUM)/max(abs(i) for i in snd_data)

    ar = array('h')
    for i in snd_data:
        ar.append(int(i*times))
    return ar

def trim(snd_data):
    "Trim the blank spots at the start and end"
    def _trim(snd_data):
        snd_started = False
        ar = array('h')

        for i in snd_data:
            if not snd_started and abs(i)>THRESHOLD:
                snd_started = True
                ar.append(i)

            elif snd_started:
                ar.append(i)
        return ar

    # Trim to the left
    snd_data = _trim(snd_data)

    # Trim to the right
    snd_data.reverse()
    snd_data = _trim(snd_data)
    snd_data.reverse()
    return snd_data

def add_silence(snd_data, seconds):
    "Add silence to the start and end of 'snd_data' of length 'seconds' (float)"
    ar = array('h', [0 for i in range(int(seconds*RATE))])
    ar.extend(snd_data)
    ar.extend([0 for i in range(int(seconds*RATE))])
    return ar

def record():
   
    p = pyaudio.PyAudio()
    stream = p.open(format=FORMAT, channels=CHANNELS, rate=RATE, input=True, output=True, frames_per_buffer=CHUNK_SIZE, input_device_index=2)
    

    num_silent = 0
    snd_started = False

    ar = array('h')
    numberOfChunksRead=0

    while 1:
        # little endian, signed short
        snd_data = array('h', stream.read(CHUNK_SIZE))
        

        if byteorder == 'big':
            snd_data.byteswap()
        ar.extend(snd_data)

        silent = is_silent(snd_data)

        if silent and snd_started:
            num_silent += 1
        elif not silent and not snd_started:
            snd_started = True
            #numberOfChunksRead+=1

        if snd_started and num_silent > 1:
            break

    sample_width = p.get_sample_size(FORMAT)
    stream.stop_stream()
    stream.close()
    p.terminate()

    ar = normalize(ar)
    ar = trim(ar)
    ar = add_silence(ar, 0.5)
    return sample_width, ar

def record_to_file(path):
    "Records from the microphone and outputs the resulting data to 'path'"
    sample_width, data = record()
    data = pack('<' + ('h'*len(data)), *data)

    wf = wave.open(path, 'wb')
    wf.setnchannels(1)
    wf.setsampwidth(sample_width)
    wf.setframerate(RATE)
    wf.writeframes(data)
    wf.close()

window = Tk()
window.title("Trying tester")
label = Label(window, text="So here we go!")
label.pack()
def main():
    arg=True
    #s="My"
    print("Let the conversation begin")
    record_to_file('demo.wav')
    hellow=sr.AudioFile('demo.wav')
    with hellow as source:
        audio = r.record(source)
        window.update()


        try:
            s = r.recognize_google(audio)
            print("Text: "+s)
            
            
            label = Label(window, text=s)
            label.master.lift()
            label.pack()
            window.update()

        except Exception as e:
            print("Exception: "+str(e))
            
            
        

    print("done - result written to demo.wav")
    
    


arg2=True
if __name__ == '__main__':
    while 1:
        main()

        
    
    #return arg2
