#lecture capteur one wire
import time
import MySQLdb
import sys

counter=0
ttp=0
minuterie = 0
radio = ''
temp1 = 0.0
temp2 = 0.0
table = ''
emission = ''
#nom des fichiers ou se trouvent les trames, nom de fichier unique par adresse mac, lecture gérer directement par l'os 
nomfich = ['/sys/bus/w1/devices/28-0416a4a1b1ff/w1_slave','/sys/bus/w1/devices/28-0516a4a340ff/w1_slave','/sys/bus/w1/devices/28-0000038b6c60/w1_slave','/sys/bus/w1/devices/28-0000066f5aea/w1_slave','/sys/bus/w1/devices/28-000005b47ba4/w1_slave','/sys/bus/w1/devices/28-000005b44178/w1_slave','/sys/bus/w1/devices/28-000005b44cf9/w1_slave','/sys/bus/w1/devices/28-0000038b360b/w1_slave','/sys/bus/w1/devices/28-0000038b7094/w1_slave','/sys/bus/w1/devices/28-0000038b26c8/w1_slave','/sys/bus/w1/devices/28-000005b4a4ad/w1_slave','/sys/bus/w1/devices/28-0000038b401f/w1_slave','/sys/bus/w1/devices/28-0000038b43fb/w1_slave','/sys/bus/w1/devices/28-0000038b34e3/w1_slave','/sys/bus/w1/devices/28-0000038b28cf/w1_slave','/sys/bus/w1/devices/28-0000038b3852/w1_slave']
#nom du lieu ou sont placé les capteurs
nomcapt = ['exterieur','veranda','bureau','eauSanitaire','sortieChaudiere','departChaudiere','cuve1','cuve2','cuve3','cuve4','cuve5','cuve6','retourChaudiere','entreeChaudiere','retourRadiateur','alleeRadiateur']
#ouverture bdd
db = MySQLdb.connect(host="localhost",user="root",passwd="password",db="raspberry" )
cursor = db.cursor()

i = 0  
#boucle de lecture de tous les capteurs
while i < 16 :
    try:
      temper = 0  
      fichier = open(nomfich[i],"r")
      texte = fichier.readline()
      texte = fichier.readline()
      temper = int (texte[texte.find('t=')+2:texte.find('t=')+8])
      fichier.close()
    except:
      print 'pas de fichier'
      #insertion dans la bdd
    table = 'UPDATE chauffage SET %s=%d where id =''1''' %(nomcapt[i],temper)
    print table
    cursor.execute(table) 
    db.commit()
    i = i +1
      

