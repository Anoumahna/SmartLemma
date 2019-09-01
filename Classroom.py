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
from sys import byteorder
from struct import pack
from flask import Flask
from textblob import TextBlob
import sys
import numpy as np
import pandas as pd
import io
import base64
from gtts import gTTS
import win32com.client as wincl
from win32com.client import constants, Dispatch
import re
from nltk.tokenize import sent_tokenize
from config import Config
import csv
import matplotlib
import tkinter
matplotlib.use('TkAgg')
import matplotlib.pyplot as plt
from flask import request, render_template
from flask import Flask, render_template,flash, redirect, url_for, request
from wtforms import Form, TextField, TextAreaField, validators, StringField, SubmitField
import nltk


 
r=sr.Recognizer() 

THRESHOLD =100
CHUNK_SIZE = 10490
FORMAT = pyaudio.paInt16
RATE = 44100
CHANNELS=1


def sumarisation(dataset):
    result=[]
    #this to find the kine no and the sentence
    for number, sentence in enumerate(sent_tokenize(dataset)):
        number_tokens=len(word_tokenize(sentence))
        tagged=nltk.pos_tag(word_tokenize(sentence))
        number_nouns= len([word for word, pos in tagged if pos in ["NN", "NNP"]])
        ners=nltk.ne_chunk(nltk.pos_tag(word_tokenize(sentence)), binary=False)
        number_ners=len([chunk for chunk in ners if hasattr(chunk,'label')])
        score=(number_ners + number_nouns) / float(number_tokens)
        result.append((number, score, sentence))
    return result




def is_silent(snd_data):
    "Returns 'True' if below the 'silent' threshold"
    return max(snd_data) < THRESHOLD

def normalize(snd_data):
    "Average the volume out"
    MAXIMUM = 16384
    times = float(MAXIMUM)/max(abs(i) for i in snd_data)

    r = array('h')
    for i in snd_data:
        r.append(int(i*times))
    return r

def trim(snd_data):
    "Trim the blank spots at the start and end"
    def _trim(snd_data):
        snd_started = False
        r = array('h')

        for i in snd_data:
            if not snd_started and abs(i)>THRESHOLD:
                snd_started = True
                r.append(i)

            elif snd_started:
                r.append(i)
        return r

    # Trim to the left
    snd_data = _trim(snd_data)

    # Trim to the right
    snd_data.reverse()
    snd_data = _trim(snd_data)
    snd_data.reverse()
    return snd_data

def add_silence(snd_data, seconds):
    "Add silence to the start and end of 'snd_data' of length 'seconds' (float)"
    r = array('h', [0 for i in range(int(seconds*RATE))])
    r.extend(snd_data)
    r.extend([0 for i in range(int(seconds*RATE))])
    return r

def record():
   
    p = pyaudio.PyAudio()
    stream = p.open(format=FORMAT, channels=CHANNELS, rate=RATE, input=True, output=True, frames_per_buffer=CHUNK_SIZE, input_device_index=2)
    

    num_silent = 0
    snd_started = False

    r = array('h')

    while 1:
        # little endian, signed short
        snd_data = array('h', stream.read(CHUNK_SIZE))
        if byteorder == 'big':
            snd_data.byteswap()
        r.extend(snd_data)

        silent = is_silent(snd_data)

        if silent and snd_started:
            num_silent += 1
        elif not silent and not snd_started:
            snd_started = True

        if snd_started and num_silent > 1:
            break

    sample_width = p.get_sample_size(FORMAT)
    stream.stop_stream()
    stream.close()
    p.terminate()

    r = normalize(r)
    r = trim(r)
    r = add_silence(r, 0.5)
    return sample_width, r

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

DEBUG = True
app = Flask(__name__)
app.config.from_object(__name__)
app.config['SECRET_KEY'] = '7d441f27d441f27567d441f2b6176a'
mytext=" "


from wtforms import Form

class ReusableForm(Form):
        name = TextField('Name:', validators=[validators.required()])

@app.route("/", methods=['GET', 'POST'])  
def main():
    
    pythoncom.CoInitialize()
    form = ReusableForm(request.form)
    print (form.errors)
    if request.method == 'POST':
        name=request.form['name']
        '''speaker = Dispatch("SAPI.SpVoice")
        speaker.Speak(name)
        #print (name)
        '''
        name=int(name)
        CHUNK_SIZE=name
        if form.validate():
            # Save the comment here.
            
            #flash('Hello ' + name)
            arg=True
    #s="My"
            print("please speak a word into the microphone")
            record_to_file('demo1.wav')
            hellow=sr.AudioFile('demo1.wav')
            with hellow as source:
                audio = r.record(source)
                try:
                    s = r.recognize_google(audio)
                    print("Text: "+s)
                    s=sumarisation(s)
                    rumm=s
                    ds=sorted(rumm,key=lambda x:x[1],reverse=True)
                    val=ds[0]
                    val2=val[1]
                    val2=0.3*val2
                    temp=''
                    print('Summarized Text')
                    for i in s:
                        if i[1]>=val2:
                            temp+=(i[2])
                    flash(temp)
                except Exception as e:
                    print("Exception: "+str(e))
                

            print("done - result written to demo1.wav")
            
    return render_template('UI.html', form=form)
    


arg2=True
if __name__ == '__main__':

    with app.test_request_context():
        from flask import request, render_template
        from flask import Flask, render_template,flash, redirect, url_for, request
        
        main()
    arg=True

app.run(port=8000)