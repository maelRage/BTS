#script detectant les différentes liaison séries et attribuant les bons ports puis parsant les trames et envoyant les ordres radio.
import time
import serial
import MySQLdb
import sys
import datetime


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
chambre =''
tramcham =''
tramedf = '';
trampisc ='';
ttp=0
ttpi = 0
ttch = 0
minuterie = 0
tramradio = ''
temp1 = 0.0
temp2 = 0.0
table = ''
emission = ''
#Tableau arrondi d'une courbe de potentiomètre analogique
tableniv = [0,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,3,3,3,3,3,3,3,3,3,4,4,4,4,4,4,4,4,6,6,6,6,6,6,6,7,7,7,7,7,7,7,7,8,8,8,8,8,8,8,10,10,10,10,10,10,10,11,11,11,11,11,11,13,13,13,13,13,13,13,14,14,14,14,14,14,14,15,15,15,15,15,17,17,17,17,18,18,18,18,18,20,20,20,20,21,21,21,21,22,22,22,22,24,24,24,24,24,25,25,25,25,25,27,27,27,27,28,28,28,28,28,29,29,29,31,31,31,32,32,34,35,35,35,36,36,36,38,38,38,38,39,39,39,39,41,41,41,42,42,43,43,43,45,45,45,45,46,46,46,46,48,48,48,49,49,49,50,50,50,52,52,53,53,55,55,56,56,57,57,59,60,62,63,64,66,67,67,69,69,70,70,70,71,71,73,73,73,74,76,76,77,77,78,78,80,80,81,83,83,84,87,90,91,93,94,94,95,95,95,95,97,98,98,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100]
somme = 0
niv=[0,0,0,0,0,0,0,0,0,0]
#extension du fichier ou se trouve les liaison séries sous raspbery avec un numero a la fin 0,1,2,3
recherche = '/dev/ttyUSB'
liaison = ['','','','']
liaisonmax = 4
#mot unique aux trames
testliaison = ['50126035','Nettoyage','Chambre','bonjour']
nomliaison = ['EDF','Piscine','Chambre','pompe']
#vitesse des différentes liaison
vitesse = [1200,9600,9600,9600]
#taille en bit d'une trame 
taille = [7,8,8,8]
eau = 0.0
delestage = 0
filtrage = 0
forcage  = 0
forcage_temp  = 0
nettoyage = 0
pompe_etat = 0
courantmin = 0
courantmax = 0
phase = 0
niveau = 0
etatpiscine = 0
continuer = 1


while 1 :
    k = 0
    #Boucle de recherche des liaison
    while k < liaisonmax :
     print 'liaison %d' %k
     j = 0
     while j < liaisonmax :
      #com prend le numéro de la liaison sur la quelle on fait la recherche
      comm = recherche + '%d' %j
      print comm
      l = 0
      #si la liaison n'a toujours pas de port associé 
      if (liaison[k]== ''):
        while l < liaisonmax :          
          if (liaison[l] == comm):
            #si on trouve on sort de la boucle 
            l = 19
          l = l + 1
        }
      if l < 20 :
        #initialisation des paramètre la liaison série si elle est trouvé au premier tour
        ser = serial.Serial(
             port=comm,
             baudrate = vitesse[k],
             parity=serial.PARITY_NONE,
             stopbits=serial.STOPBITS_ONE,
             bytesize=taille[k],
             timeout=0.1
             )
        tramedf = '';
        if k == 3
          #test pour la liaison 3 radio d'envoi d'un message
           ser.write('{bonjour\x0d')
           
        i=0;
        while i<30 : 
              tramedf = tramedf + ser.readline()
              i = i+ 1
              #Si l'on trouve le mot propre a la trame 
              if (0 < tramedf.find(testliaison[k])):
                  liaison[k] = comm;
                  i=200;
                  print 'com:%s' %liaison[k]
                  j = 200
        print tramedf
        ser.close();
        time.sleep(0.1)
      j = j + 1
     k = k + 1
    print 'resultat'
    k = 0
    #initialisation des paramètres des liaison si elles ont été trouvées 
    while k < liaisonmax :
      print '%s : %s' %(nomliaison[k],liaison[k])
      k = k +1
    
    i=0;
    
    if (liaison[0] !=''):
        seredf = serial.Serial(
                 port=liaison[0],
                 baudrate = vitesse[0],
                 parity=serial.PARITY_NONE,
                 stopbits=serial.STOPBITS_ONE,
                 bytesize=serial.SEVENBITS,
                 timeout=0.005
                 )   
    if (liaison[1] !=''):
        serpiscine = serial.Serial(
                 port=liaison[1],
                 baudrate = vitesse[1],
                 parity=serial.PARITY_NONE,
                 stopbits=serial.STOPBITS_ONE,
                 bytesize=serial.EIGHTBITS,
                 timeout=0.01
                 )   
    if (liaison[2] !=''):
        serchambre = serial.Serial(
                 port=liaison[2],
                 baudrate = vitesse[2],
                 parity=serial.PARITY_NONE,
                 stopbits=serial.STOPBITS_ONE,
                 bytesize=serial.EIGHTBITS,
                 timeout=0.01
                 )   
    if (liaison[3]  !=''):
        seradio = serial.Serial(
                 port=liaison[3],
                 baudrate = vitesse[3],
                 parity=serial.PARITY_NONE,
                 stopbits=serial.STOPBITS_ONE,
                 bytesize=serial.EIGHTBITS,
                 timeout=0.01
                 )
    if (liaison[3]  ==''):

         continuer = 0;
    db = MySQLdb.connect(host="localhost",user="root",passwd="password",db="raspberry" )
    cursor = db.cursor()
    # vide les buffer qui vont récupérer les trames
    tramedf = '';
    trampisc ='';
    tramcham ='';
    tramradio = '';
    #Si les liaison on été trouvés on continue
    while continuer:
        #si la liaison 0 donc la télinformation a été trouvé  
        if (liaison[0] !=''):
          try:
            #on rempli le buffer
             tramedf = tramedf + seredf.readline()
             #Si la trame est incomplète on la vide
             if (0 < tramedf.find('ADCO')):
                 tramedf =''
              # si la trame est complète on la parse
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
                     #affichage en temps réel sur la console
                 print 'p' , puissance ,'Phase1:',phase1,'Phase2:',phase2,'Phase3:',phase3, ' ',indexcreu, ' ', indexejp,' ' , ejp;
                      #remplissage de la bdd
                 table = 'UPDATE edf SET puissanceInstant=%d, courantPhase1=%d, courantPhase2=%d, courantPhase3=%d, indexHeureCreuse=%d, indexHeureEjp=%d, jourEjp=%d  WHERE id =1' %(puissance,phase1,phase2,phase3,indexcreu,indexejp,ejp)
                 cursor.execute(table);
                 db.commit();
                 tramedf = tramedf[tramedf.find('PPOT')+4:100];
          except:
              print 'erreur'
              #Gestion de la radio dans le cas de la liaison 3

              
        if (liaison[3] !=''):
            try:
                  #boucle de temporisation pour libérer le processeur
                 ttp = ttp + 1
                 if (ttp > 80): #80
                     ttp = 0
                     #Selection des ordres présents dans la bdd
                     cursor.execute('SELECT id, pompe FROM pompeEnvoi WHERE id=''1''')
                     emipompe = cursor.fetchone()
                     cursor.execute('SELECT id, touche FROM pompeEnvoi WHERE id=''1''')
                     emitouche = cursor.fetchone()
                     if (emitouche[1] != '') :
                       print 'pompe ' ,emipompe[1]
                       print 'touche ' ,emitouche[1]
                       #si le numéro de pompe est 1 ou deux on rajoute une accolade qui permet la répétition de la trame 
                       if (int(emipompe[1]) == 1) or (int(emipompe[1]) == 2) :
                         repeteur = '{'
                       else :
                         repeteur = ''
                       if (int(emitouche[1]) == 5) :
                         emission = '%sTouche%d?\x0d' %(repeteur, int(emipompe[1]))
                       else :  
                         emission = '%sTouche%d%d\x0d' % (repeteur,int(emipompe[1]), int(emitouche[1]))
                       if (int(emitouche[1]) == 6) :
                         emission = '{Therm?%d\x0d' % (int(emipompe[1])) 
                       print emission
                       #emission de l'ordre
                       seradio.write(emission)
                       #on vide l'ordre pour ne pas le répéter infiniment
                       table = 'UPDATE pompeEnvoi SET touche="" where id =''1'''
                       cursor.execute(table)
                       db.commit()  

                      #gestion lecture radio  
                  #remplissage du buffer      
                 tramradio = tramradio + seradio.readline()
                    # si l'on ne trouve pas de preuve que la trame est complète on vide le buffer
                 if (0 > tramradio.find('#')) and (0 > tramradio.find('&')):
                     tramradio =''
                     # si l'on est dans le cas ou la trame d'un capteur de température est complete on la parse
                 if ( 0 <= tramradio.find('@')):
                     if ( 0 <=tramradio.find('&')):
                        temp1 = float(tramradio[tramradio.find('I:')+2:tramradio.find('E:')])
                        temp2 = float(tramradio[tramradio.find('E:')+2:tramradio.find('@')])
                        tempp1 = int(temp1 * 100)
                        tempp2 =  int(temp2 *100) 
                        capteur = 1 + int(tramradio[tramradio.find('I:')-2])
                        #Affichage en temps réel sur la console
                        print 'Capteur ',capteur,' interieur:',temp1,' exterieur:',temp2
                        tramradio = tramradio[tramradio.find('@')+1:100]                     
                         
                        #remplissage de la bdd
                        table = 'UPDATE therm%d SET valeur1=%d, valeur2=%d, where id =1' %(capteur,tempp1,tempp2)
                        cursor.execute(table) 
                        db.commit()
                    # Si l'on est dans le cas d'un ordre radio selon l'ordre on rempli la bdd
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
            except:
              print 'erreur'
              tramradio = ''
              #Si l'on est dans le cas d'une trame de type piscine
        if (liaison[1]!=''):
          try: 
            #boucle temporisation
             ttpi = ttpi + 1
             if (ttpi > 80):
                     ttpi = 0
                     #selection de l'ordre pour la piscine
                     cursor.execute('SELECT id, Ordre FROM piscineEnvoi WHERE id=''1''')
                     emipiscine = cursor.fetchone()
                     if (emipiscine[1] != '') :
                       #envoi de l'ordre
                       serpiscine.write(emipiscine[1])
                       # remise a 0 de l'ordre
                       table = 'UPDATE piscineEnvoi SET Ordre="" where id =''1'''
                       cursor.execute(table)
                       db.commit() 
              # remplissage du buffer trame piscine 
             trampisc = trampisc + serpiscine.readline()
             #Si l'on est dans le cas d'une trame complète de piscine on la parse
             if ( 0 <= trampisc.find('Eau:')) and (0 < trampisc.find('}')):
                 
                 eau = float(1000.0 * float( trampisc[trampisc.find('Eau:')+4:trampisc.find('Deles')-1]));
                 delestage = int( trampisc[trampisc.find('Delestage')+9:trampisc.find('T filtr')-1]);
                 filtrage = int( trampisc[trampisc.find('filtrage')+9:trampisc.find('increment')-1]);           
                 forcage  = int( trampisc[trampisc.find('force')+6:trampisc.find('torce')-1]);
                 forcage_temp  = int( trampisc[trampisc.find('torce')+6:trampisc.find('Nettoyage')-1]);
                 nettoyage = int( trampisc[trampisc.find('Nettoyage:')+10:trampisc.find('Pompe')-1]);
                 pompe_etat = int( trampisc[trampisc.find('Pompe')+6:trampisc.find('Phase:')-1]);
                 courantmin = int( trampisc[trampisc.find('courant min:')+12:trampisc.find('courant max')-1]);
                 courantmax = int( trampisc[trampisc.find('courant max:')+12:trampisc.find('niveau')-1]);            
                 phase = int( trampisc[trampisc.find('Phase:')+6:trampisc.find('courant min')-1]);
                 niveau = int( trampisc[trampisc.find('niveau:')+7:trampisc.find('Etat:')-1]);
                 etatpiscine = int( trampisc[trampisc.find('Etat:')+5:trampisc.find('}')-1]);
                 # petite gestion d'erreur du niveau potentiomètre variant de 727 a 1000
                 if (niveau > 1000) :
                     niveau = 1000;
                 if (niveau > 727) :
                   niveaux = tableniv[niveau-727];
                 else :
                   niveaux = 0 ;

                # remplissage de bdd
                 table = 'UPDATE piscine SET temperatureEau=%f, tempsFiltration=%d, etatPompe=%d, etatRobot=%d, forcage=%d, tempsForcage=%d, courantmin=%d, courantmax=%d, phase=%d, delestage=%d, etatPiscine=%d  WHERE id =1' %(eau,filtrage,pompe_etat,nettoyage,forcage,forcage_temp,courantmin,courantmax,phase,delestage,etatpiscine)
                 cursor.execute(table);
                 db.commit();
                 somme = 0
                 print 'niveau:',niveaux, ' Eau:',eau/1000.0;
                 #remplissage de la bdd                   
                     if (niv[0] > 0 ) :
                       table = 'UPDATE eau SET niveau=%d WHERE id =1 ' %(niveaux)
                       cursor.execute(table);
                       db.commit();
                  #vide le buffer après utilisation     
                 trampisc = ''; 
             if (0 < trampisc.find('}')):
                 trampisc ='';
          except:
              print 'erreur'
              trampisc ='';

# dans le cas d'une trame de chambre froide
        if (liaison[2]!=''):
          try:  
            #boucle tempo
             ttch = ttch + 1
             if (ttch > 80):
                     ttch = 0
                     #selection de l'ordre
                     cursor.execute('SELECT id, Ordre FROM chambreEnvoi WHERE id=''1''')
                     emichambre = cursor.fetchone()
                     #envoie de l'ordre si il éxiste
                     if (emichambre[1] != '') :
                       print 'chambre : ' ,emichambre[1]
                       serchambre.write(emichambre[1])
                       table = 'UPDATE chambreEnvoi SET Ordre="" where id =''1'''
                       cursor.execute(table)
                       db.commit()  
                       #remplissage buffer 
             tramcham = tramcham + serchambre.readline()
             #si le buffer est complet parsage
             if ( 0 <= tramcham.find('{Cham')) and (0 < tramcham.find('}')):
                 tchambre = float(1000.0 * float( tramcham[tramcham.find('Chambre:')+8:tramcham.find('Exterieur:')-1]));
                 texterieur = float(1000.0 * float( tramcham[tramcham.find('Exterieur:')+10:tramcham.find('courge:')-1]));
                 tcourge = float(1000.0 * float( tramcham[tramcham.find('courge:')+7:tramcham.find('ventilation:')-1]));
                 ventilation = int( tramcham[tramcham.find('ventilation:')+12:tramcham.find('chauffage:')-1]);
                 chauffage = int( tramcham[tramcham.find('chauffage:')+10:tramcham.find('temperature:')-1]);
                 temperature = int( tramcham[tramcham.find('temperature:')+12:tramcham.find('delestage:')-1]);
                 delestage = int( tramcham[tramcham.find('delestage:')+10:tramcham.find('relaivent:')-1]);
                 relaivent = int( tramcham[tramcham.find('relaivent:')+10:tramcham.find('relaichau:')-1]);
                 relaichau = int( tramcham[tramcham.find('relaichau:')+10:tramcham.find('}')-1]);
                 #remplissage bdd
                 table = 'UPDATE chambre SET Chambre=%f, Exterieur=%d, Courge=%d, tChauffage=%d, etatChauffage=%d, relaisChauffage=%d, etatVentillation=%d, relaisVentillation=%d  WHERE id =1' %(tchambre,texterieur,tcourge,temperature,chauffage,relaichau,ventilation,relaivent)
                 cursor.execute(table);
                 db.commit();
                 #affichage en temps réel 
                 print ' Chambre: ',tchambre, ' Exterieur: ',texterieur, ' courge: ',tcourge
                 tramcham = ''; 
             if (0 < tramcham.find('}')):
                 tramcham ='';   
          except:
            print 'erreur';
            tramcham ='';
    #fermeture des liaison séries
    serpiscine.close();
    seradio.close();    
    seredf.close();
    serchambre.close();
    

