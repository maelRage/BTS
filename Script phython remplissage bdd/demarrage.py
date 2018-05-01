#!/usr/bin/env python
import time
import serial
import MySQLdb
import sys

tramradio = ''

while 1 :
    seradio = serial.Serial(
                 port='/dev/ttyUSB4',
                 baudrate = 9600,
                 parity=serial.PARITY_NONE,
                 stopbits=serial.STOPBITS_ONE,
                 bytesize=serial.EIGHTBITS,
                 timeout=0.01
                 )   
    tramedf = '';
    while 1:
       tramradio = tramradio + seradio.readline()
       if (0 < tramradio.find('@')):
         print tramradio
         tramradio =''
seradio.close();    


