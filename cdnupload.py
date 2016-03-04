#	Document 		: CDN/cdnupload.py
#	Description		: An upload trigger for Linux systems.
#	Date 			: 2016-03-04
#	Copyright (c) Prashant M. Shrestha (www.prashant.me)

import requests
import sys
import time
import hashlib
import sys
import os.path
from subprocess import call

url 			= 'https://cdn.prashant.me/upload'
screenshotType	= sys.argv[2];
currentTime 	= str(time.time())
imageFilename	= hashlib.md5(currentTime.encode()).hexdigest() + '.png'

def gnomeScreenshot(sshotType, fName):
	if("-a" in sshotType):
		call(["gnome-screenshot", "-a", "-f", fName])
	elif("-d" in sshotType):
		call(["gnome-screenshot", "-f", fName])
	elif("-w" in sshotType):
		call(["gnome-screenshot", "-w", "-f", fName])

def sendRequest(files, datas):
	r = requests.post(url, files=files, data=datas)
	print(r.text)

gnomeScreenshot(screenshotType, imageFilename)

files 	= { 'file' : open(imageFilename, 'rb') }
auth	= { "securityKey" : "prashantmshrestha" }

sendRequest(files, auth)

call(["rm", "-rf", imageFilename])