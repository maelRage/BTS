#!/usr/bin/env python
import time
import serial
import MySQLdb
import sys

puissance = 0
phase1 =0
phase2 =0
phase3 = 0
indexcreu = 0
indexejp = 0
ejp = 0
counter=0
tramedf = ''
table = ''
i=0
tele = ''
piscine = ''
radio = ''
tramedf = '';
trampisc ='';
ttp=0
ttpi = 0
minuterie = 0
tramradio = ''
temp1 = 0.0
temp2 = 0.0
table = ''
emission = ''
tableniv = [0,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,3,3,3,3,3,3,3,3,3,4,4,4,4,4,4,4,4,6,6,6,6,6,6,6,7,7,7,7,7,7,7,7,8,8,8,8,8,8,8,10,10,10,10,10,10,10,11,11,11,11,11,11,13,13,13,13,13,13,13,14,14,14,14,14,14,14,15,15,15,15,15,17,17,17,17,18,18,18,18,18,20,20,20,20,21,21,21,21,22,22,22,22,24,24,24,24,24,25,25,25,25,25,27,27,27,27,28,28,28,28,28,29,29,29,31,31,31,32,32,34,35,35,35,36,36,36,38,38,38,38,39,39,39,39,41,41,41,42,42,43,43,43,45,45,45,45,46,46,46,46,48,48,48,49,49,49,50,50,50,52,52,53,53,55,55,56,56,57,57,59,60,62,63,64,66,67,67,69,69,70,70,70,71,71,73,73,73,74,76,76,77,77,78,78,80,80,81,83,83,84,87,90,91,93,94,94,95,95,95,95,97,98,98,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100]
somme = 0
niv=[0,0,0,0,0,0,0,0,0,0]

while 1 :
  try:
    i=0;
    if ((tele== '') and (piscine != '/dev/ttyUSB0') and (radio != '/dev/ttyUSB0')):
        ser = serial.Serial(
         port='/dev/ttyUSB0',
         baudrate = 1200,
         parity=serial.PARITY_NONE,
         stopbits=serial.STOPBITS_ONE,
         bytesize=serial.SEVENBITS,
         timeout=0.1
        )
        while i<20 : 
         tramedf = tramedf + ser.readline()
         i = i+ 1 ;
         if (0 < tramedf.find('50126035')):
             tele = '/dev/ttyUSB0';
             i=200;
        ser.close();
    tramedf = '';
    i=0;
    try:
      if ((tele== '') and (piscine != '/dev/ttyUSB1') and (radio != '/dev/ttyUSB1')):
        ser = serial.Serial(
             port='/dev/ttyUSB1',
             baudrate = 1200,
             parity=serial.PARITY_NONE,
             stopbits=serial.STOPBITS_ONE,
             bytesize=serial.SEVENBITS,
             timeout=0.1
            )
        while i<20 : 
             tramedf = tramedf + ser.readline()
             i = i+ 1 ;
             if (0 < tramedf.find('50126035')):
                 tele = '/dev/ttyUSB1';
                 i=200;
        ser.close();
    except:
        print 'erreur com';
    finally :
       print 'tel';        
    tramedf = '';
    i=0;
    if ((tele== '') and (piscine != '/dev/ttyUSB2') and (radio != '/dev/ttyUSB2')):
      try:
        ser = serial.Serial(
             port='/dev/ttyUSB2',
             baudrate = 1200,
             parity=serial.PARITY_NONE,
             stopbits=serial.STOPBITS_ONE,
             bytesize=serial.SEVENBITS,
             timeout=0.1
            )
        while i<20 : 
             tramedf = tramedf + ser.readline()
             i = i+ 1 ;
             if (0 < tramedf.find('50126035')):
                 tele = '/dev/ttyUSB2';
                 i=200;
        ser.close();
      except:
        print 'erreur com';
      finally :
       print 'tel';        
    tramedf = '';
    i=0;
    if ((piscine == '') and (tele != '/dev/ttyUSB0') and (radio != '/dev/ttyUSB0')):
        ser = serial.Serial(
             port='/dev/ttyUSB0',
             baudrate = 9600,
             parity=serial.PARITY_NONE,
             stopbits=serial.STOPBITS_ONE,
             bytesize=serial.EIGHTBITS,
             timeout=0.1
            )
        while i<30 : 
             tramedf = tramedf + ser.readline()
             i = i+ 1 ;
             if (0 < tramedf.find('Nettoyage')):
                 piscine = '/dev/ttyUSB0';
                 i=200;
        ser.close();
    tramedf = '';
    i=0;
    if ((piscine == '') and (tele != '/dev/ttyUSB1')and (radio != '/dev/ttyUSB1')):
      try:
        ser = serial.Serial(
             port='/dev/ttyUSB1',
             baudrate = 9600,
             parity=serial.PARITY_NONE,
             stopbits=serial.STOPBITS_ONE,
             bytesize=serial.EIGHTBITS,
             timeout=0.1
            )
        while i<30 : 
             tramedf = tramedf + ser.readline()
             i = i+ 1 ;
             if (0 < tramedf.find('Nettoyage')):
                 piscine = '/dev/ttyUSB1';
                 i=200;
        ser.close();
      except:
        print 'erreur com';
      finally :
       print 'pisc';        
    tramedf = '';
    i=0;
    if ((piscine == '') and (tele != '/dev/ttyUSB2')and (radio != '/dev/ttyUSB2')):
      try:
        ser = serial.Serial(
             port='/dev/ttyUSB2',
             baudrate = 9600,
             parity=serial.PARITY_NONE,
             stopbits=serial.STOPBITS_ONE,
             bytesize=serial.EIGHTBITS,
             timeout=0.1
            )
        while i<30 : 
             tramedf = tramedf + ser.readline()
             i = i+ 1 ;
             if (0 < tramedf.find('Nettoyage')):
                 piscine = '/dev/ttyUSB2';
                 i=200;
        ser.close();
      except:
        print 'erreur com';
      finally :
       print 'pisc';        
    tramedf = '';
    i=0;
    if ((radio == '') and (tele != '/dev/ttyUSB0')and (piscine != '/dev/ttyUSB0')):
      try:
        ser = serial.Serial(
             port='/dev/ttyUSB0',
             baudrate = 9600,
             parity=serial.PARITY_NONE,
             stopbits=serial.STOPBITS_ONE,
             bytesize=serial.EIGHTBITS,
             timeout=0.1
            )
        ser.write('Touche0?\x0d')
        while i<30 : 
             tramedf = tramedf + ser.readline()
             i = i+ 1 ;
             if ((0 < tramedf.find('en arret')) or (0 < tramedf.find('en marche')) or (0 < tramedf.find('temp =>'))):
                 radio = '/dev/ttyUSB0';
                 i=200;
        ser.close();
      except:
        print 'erreur com';
      finally :
       print 'pisc';        
    tramedf = '';
    i=0;
    if ((radio == '') and (tele != '/dev/ttyUSB1')and (piscine != '/dev/ttyUSB1')):
      try:
        ser = serial.Serial(
             port='/dev/ttyUSB1',
             baudrate = 9600,
             parity=serial.PARITY_NONE,
             stopbits=serial.STOPBITS_ONE,
             bytesize=serial.EIGHTBITS,
             timeout=0.1
            )
        ser.write('Touche0?\x0d')
        while i<30 : 
             tramedf = tramedf + ser.readline()
             i = i+ 1 ;
             if ((0 < tramedf.find('en arret')) or (0 < tramedf.find('en marche')) or (0 < tramedf.find('temp =>'))):
                 radio = '/dev/ttyUSB1';
                 i=200;
        ser.close();
      except:
        print 'erreur com';
      finally :
       print 'pisc';        
    tramedf = '';
    i=0;
    if ((radio == '') and (tele != '/dev/ttyUSB2')and (piscine != '/dev/ttyUSB2')):
      try:
        ser = serial.Serial(
             port='/dev/ttyUSB2',
             baudrate = 9600,
             parity=serial.PARITY_NONE,
             stopbits=serial.STOPBITS_ONE,
             bytesize=serial.EIGHTBITS,
             timeout=0.1
            )
        ser.write('Touche0?\x0d')
        while i<30 : 
             tramedf = tramedf + ser.readline()
             i = i+ 1 ;
             if ((0 < tramedf.find('en arret')) or (0 < tramedf.find('en marche')) or (0 < tramedf.find('temp =>'))):
                 radio = '/dev/ttyUSB2';
                 i=200;
        ser.close();
      except:
        print 'erreur com';
      finally :
       print 'pisc';        
    tramedf = '';
    tramradio = '';
    trampisc ='';
    i=0;
    
    print 'liaison:' ,tele;
    print 'piscine', piscine;
    print 'pompe' ,radio;
    if (tele !=''):
        seredf = serial.Serial(
                 port=tele,
                 baudrate = 1200,
                 parity=serial.PARITY_NONE,
                 stopbits=serial.STOPBITS_ONE,
                 bytesize=serial.SEVENBITS,
                 timeout=0.0001
                 )   
    if (radio !=''):
        seradio = serial.Serial(
                 port=radio,
                 baudrate = 9600,
                 parity=serial.PARITY_NONE,
                 stopbits=serial.STOPBITS_ONE,
                 bytesize=serial.EIGHTBITS,
                 timeout=0.0001
                 )   
    if (piscine !=''):
        serpiscine = serial.Serial(
                 port=piscine,
                 baudrate = 9600,
                 parity=serial.PARITY_NONE,
                 stopbits=serial.STOPBITS_ONE,
                 bytesize=serial.EIGHTBITS,
                 timeout=0.0001
                 )   
    db = MySQLdb.connect(host="localhost",user="root",passwd="password",db="raspberry" )
    cursor = db.cursor()
    tramedf = '';
    while 1:
        if (tele !=''):
             tramedf = tramedf + seredf.readline()
             if (0 < tramedf.find('ADCO')):
                 tramedf =''
             if ( 0 <= tramedf.find('PPOT')) and (0 < tramedf.find('50126035')):
                 puissance = int( tramedf[tramedf.find('PAPP')+5:tramedf.find('PAPP')+10]);
                 phase1 = int( tramedf[tramedf.find('IINST1')+7:tramedf.find('IINST1')+10]);
                 phase2 = int( tramedf[tramedf.find('IINST2')+7:tramedf.find('IINST2')+10]);
                 phase3 = int( tramedf[tramedf.find('IINST3')+7:tramedf.find('IINST3')+10]);
                 indexcreu = int(tramedf[tramedf.find('EJPHN')+6:tramedf.find('EJPHN')+15]);
                 indexejp =  int(tramedf[tramedf.find('EJPHPM')+7:tramedf.find('EJPHPM')+16]);
                 if (tramedf[tramedf.find('PTEC')+5:tramedf.find('PTEC')+9] == 'HN..'):
                     ejp = 0;
                 else :
                     ejp = 1 ;
                 print 'p' , puissance ,'Phase1:',phase1,'Phase2:',phase2,'Phase3:',phase3, ' ',indexcreu, ' ', indexejp,' ' , ejp;
                 table = 'UPDATE edf SET puissanceInstant=%d, courantPhase1=%d, courantPhase2=%d, courantPhase3=%d, indexHeureCreuse=%d, indexHeureEjp=%d, jourEjp=%d  WHERE id =1' %(puissance,phase1,phase2,phase3,indexcreu,indexejp,ejp)
                 cursor.execute(table);
                 db.commit();
                 tramedf = tramedf[tramedf.find('PPOT')+4:100];
        if (radio !=''):
                 ttp = ttp + 1
                 if (ttp > 500):
                     ttp = 0
                     cursor.execute('SELECT id, pompe FROM pompeEnvoi WHERE id=''1''')
                     emipompe = cursor.fetchone()
                     cursor.execute('SELECT id, touche FROM pompeEnvoi WHERE id=''1''')
                     emitouche = cursor.fetchone()
                     if (emitouche[1] != '') :
                       print 'pompe ' ,emipompe[1]
                       print 'touche ' ,emitouche[1]
                       if (int(emipompe[1]) == 1) or (int(emipompe[1]) == 2) :
                         repeteur = '{'
                       else :
                         repeteur = ''
                       if (int(emitouche[1]) == 5) :
                         emission = '%sTouche%d?\x0d' %(repeteur, int(emipompe[1]))
                       else :  
                         emission = '%sTouche%d%d\x0d' % (repeteur,int(emipompe[1]), int(emitouche[1]))
                       print emission
                       seradio.write(emission)
                       table = 'UPDATE pompeEnvoi SET touche="" where id =''1'''
                       cursor.execute(table)
                       db.commit()  
                 tramradio = tramradio + seradio.readline()
                 if (0 > tramradio.find('#')) and (0 > tramradio.find('&')):
                     tramradio =''
                 if ( 0 <= tramradio.find('@')):
                     if ( 0 <=tramradio.find('&')):
                        temp1 = float(tramradio[tramradio.find('I:')+2:tramradio.find('E:')])
                        temp2 = float(tramradio[tramradio.find('E:')+2:tramradio.find('@')])
                        tempp1 = int(temp1 * 100)
                        tempp2 =  int(temp2 *100) 
                        capteur = 1 + int(tramradio[tramradio.find('I:')-2])
                        print 'Capteur ',capteur,' interieur:',temp1,' exterieur:',temp2
                        tramradio = tramradio[tramradio.find('@')+1:100]
                        table = 'INSERT INTO therm%d(valeur1, valeur2) VALUES (%d,%d)' %(capteur,tempp1,tempp2)
                        cursor.execute(table) 
                        db.commit()
                 if ( 0 <=tramradio.find('#')):
                     if (  tramradio.find('#') < tramradio.find('|')) :
                         capteur = 1 + int(tramradio[tramradio.find('#')+1])
                         if (tramradio.find('|') > tramradio.find('arret')) and 0 <= tramradio.find('arret'):
                                 print 'arret'
                                 table = 'UPDATE pompe%d SET etat="Arret", minuterie=0 where id =''1''' %(capteur)
                                 cursor.execute(table)
                                 db.commit()
                         if (tramradio.find('|') > tramradio.find('en marche')) and 0 <= tramradio.find('en marche'):
                                 print 'marche'
                                 table = 'UPDATE pompe%d SET etat="Marche", minuterie=0 where id =''1''' %(capteur)
                                 cursor.execute(table) 
                                 db.commit()
                         if (tramradio.find('|') >  tramradio.find('temp =>')) and 0 <= tramradio.find('temp =>'):
                                 minuterie  = (int(tramradio[tramradio.find(':')-2:tramradio.find(':')]) *60) +int(tramradio[tramradio.find(':')+1:tramradio.find(':')+3])
                                 print 'minuterie : ',minuterie, ' minutes'
                                 table = 'UPDATE pompe%d SET etat="Minuterie", minuterie=%d where id =''1''' %(capteur,minuterie)
                                 cursor.execute(table) 
                                 db.commit()
                         tramradio = tramradio[tramradio.find('|')+1:100]
        if (piscine !=''):
             ttpi = ttpi + 1
             if (ttpi > 1000):
                     ttpi = 0
                     cursor.execute('SELECT id, Ordre FROM piscineEnvoi WHERE id=''1''')
                     emipiscine = cursor.fetchone()
                     if (emipiscine[1] != '') :
                       print 'piscine : ' ,emipiscine[1]
                       serpiscine.write(emipiscine[1])
                       table = 'UPDATE piscineEnvoi SET Ordre="" where id =''1'''
                       cursor.execute(table)
                       db.commit()  
             trampisc = trampisc + serpiscine.readline()
             if ( 0 <= trampisc.find('Eau:')) and (0 < trampisc.find('}')):
                 eau = float(1000.0 * float( trampisc[trampisc.find('Eau:')+4:trampisc.find('Deles')-1]));
                 delestage = int( trampisc[trampisc.find('Delestage')+9:trampisc.find('T filtr')-1]);
                 filtrage = int( trampisc[trampisc.find('filtrage')+9:trampisc.find('increment')-1]);
                 increment = float( trampisc[trampisc.find('increment')+10:trampisc.find('force')-1]);
                 forcage  = int( trampisc[trampisc.find('force')+6:trampisc.find('torce')-1]);
                 forcage_temp  = int( trampisc[trampisc.find('torce')+6:trampisc.find('Nettoyage')-1]);
                 nettoyage = int( trampisc[trampisc.find('Nettoyage:')+10:trampisc.find('Pompe')-1]);
                 pompe_etat = int( trampisc[trampisc.find('Pompe')+6:trampisc.find('Phase:')-1]);
                 courantmin = int( trampisc[trampisc.find('courant min:')+12:trampisc.find('courant max')-1]);
                 courantmax = int( trampisc[trampisc.find('courant max:')+12:trampisc.find('niveau')-1]);            
                 phase = int( trampisc[trampisc.find('Phase:')+6:trampisc.find('courant min')-1]);
                 niveau = int( trampisc[trampisc.find('niveau:')+7:trampisc.find('Etat:')-1]);
                 etatpiscine = int( trampisc[trampisc.find('Etat:')+5:trampisc.find('}')-1]);
                 if (niveau > 1000) :
                     niveau = 1000;
                 if (niveau > 727) :
                   niveaux = tableniv[niveau-727];
                 else :
                   niveaux = 0 ;
                 table = 'UPDATE piscine SET temperatureEau=%f, tempsFiltration=%d, etatPompe=%d, etatRobot=%d, forcage=%d, tempsForcage=%d, courantmin=%d, courantmax=%d, phase=%d, delestage=%d, etatPiscine=%d  WHERE id =1' %(eau,filtrage,pompe_etat,nettoyage,forcage,forcage_temp,courantmin,courantmax,phase,delestage,etatpiscine)
                 cursor.execute(table);
                 db.commit();
                 somme = 0
                 print 'niveau ',niveaux ;
                 if (niveau > 700) :
                     for x in range(9):
                       niv[x]=niv[x+1]
                       somme += niv[x]
                 if  (niveau > 700) :
                     niv[9] = niveaux  
                     somme += niveaux
                     niveaux = (somme + 5) /10
                     if (niv[0] > 0 ) :
                       table = 'UPDATE eau SET dureeRemplissage=%d, niveau=%d WHERE id =1 ' %(niveau,niveaux)
                       cursor.execute(table);
                       db.commit();
                 print 'Eau ',eau/1000.0 ;
                 trampisc = ''; 
             if (0 < trampisc.find('}')):
                 trampisc ='';
  except:
     print 'erreur';
  finally :
     print 'redemarrrage';
  serpiscine.close();
  seradio.close();    
  seredf.close(); 


