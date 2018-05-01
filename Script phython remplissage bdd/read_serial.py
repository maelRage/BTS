#!/usr/bin/env python
import time
import serial
import MySQLdb
import sys

ser = serial.Serial(
 port='/dev/ttyUSB0',
 baudrate = 9600,
 parity=serial.PARITY_NONE,
 stopbits=serial.STOPBITS_ONE,
 bytesize=serial.EIGHTBITS,
 timeout=0.001
)
counter=0
ttp=0
minuterie = 0
radio = ''
temp1 = 0.0
temp2 = 0.0
table = ''
emission = ''
db = MySQLdb.connect(host="localhost",user="root",passwd="password",db="raspberry" )
cursor = db.cursor()

while 1:
 ttp = ttp + 1
 if (ttp > 10):
     ttp = 0
     cursor.execute('SELECT id, pompe FROM pompeEnvoi WHERE id=''1''')
     emipompe = cursor.fetchone()
     cursor.execute('SELECT id, touche FROM pompeEnvoi WHERE id=''1''')
     emitouche = cursor.fetchone()
     if (emitouche[1] != '') :
       print 'pompe ' ,emipompe[1]
       print 'touche ' ,emitouche[1]
       if (int(emitouche[1]) == 5) :
         emission = 'Touche%d?\x0d' %(int(emipompe[1]))
       else :  
         emission = 'Touche%d%d\x0d' % (int(emipompe[1]), int(emitouche[1]))
       print emission
       #ser.write(emission)
       table = 'UPDATE pompeEnvoi SET touche="" where id =''1'''
       cursor.execute(table)
     db.commit()  
 radio = radio + ser.readline()
 if radio != '' :
     print 'buf:' +radio
 if (0 > radio.find('#')) and (0 > radio.find('&')):
     radio =''
 if ( 0 <= radio.find('@')):
     if ( 0 <=radio.find('&')):
        temp1 = float(radio[radio.find('I:')+2:radio.find('E:')])
        temp2 = float(radio[radio.find('E:')+2:radio.find('@')])
        tempp1 = int(temp1 * 100)
        tempp2 =  int(temp2 *100) 
        capteur = 1 + int(radio[radio.find('I:')-2])
        print 'Capteur ',capteur,' interieur:',temp1,' exterieur:',temp2
       # ser.write('#2 mesure comprise|')
        radio = radio[radio.find('@')+1:100]
        table = 'INSERT INTO therm%d(valeur1, valeur2) VALUES (%d,%d)' %(capteur,tempp1,tempp2)
        cursor.execute(table) #,(tempp1, tempp2))
        # Envoyer dans la base de donnees
        db.commit()
 if ( 0 <=radio.find('#')):
     if (  radio.find('#') < radio.find('|')):
          
         capteur = 1 + int(radio[radio.find('#')+1])
         if (radio.find('|') > radio.find('arret')) and 0 <= radio.find('arret'):
                 print 'arret'
                 #table = 'INSERT INTO pompe3(etat, minuterie) VALUES ("Arret",0)' #%(capteur)
                 table = 'UPDATE pompe%d SET etat="Arret", minuterie=0 where id =''1''' %(capteur)
                 cursor.execute(table) #,(tempp1, tempp2))
                 # Envoyer dans la base de donnees
                 db.commit()
         if (radio.find('|') > radio.find('en marche')) and 0 <= radio.find('en marche'):
                 print 'marche'
                 table = 'UPDATE pompe%d SET etat="Marche", minuterie=0 where id =''1''' %(capteur)
                 cursor.execute(table) #,(tempp1, tempp2))
                 # Envoyer dans la base de donnees
                 db.commit()
         if (radio.find('|') >  radio.find('temp =>')) and 0 <= radio.find('temp =>'):
                 minuterie  = (int(radio[radio.find(':')-2:radio.find(':')]) *60) +int(radio[radio.find(':')+1:radio.find('|')])
                 print 'minuterie : ',minuterie, ' minutes'
                 table = 'UPDATE pompe%d SET etat="Minuterie", minuterie=%d where id =''1''' %(capteur,minuterie)
                 cursor.execute(table) #,(tempp1, tempp2))
                 # Envoyer dans la base de donnees
                 db.commit()
         radio = radio[radio.find('|')+1:100]
 

