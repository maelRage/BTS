import time
import serial
import MySQLdb
import sys
import datetime

table = ''
niveau = 0
niveau2 =0
heu = 0
diff = datetime.datetime(2014,10,9,11,22,33)

db = MySQLdb.connect(host="localhost",user="root",passwd="password",db="raspberry" )
cursor = db.cursor();
maintenant = datetime.datetime.now()
for i in range (1,5) :
  table = 'SELECT id, date FROM therm%d WHERE id=1' %i
  cursor.execute(table)
  heure = cursor.fetchone();
  diff = heure[1]
  print 'thermo : ',i
  if (int(maintenant.strftime('%s')) - int(diff.strftime('%s')) < 600) :
     table = 'SELECT id, valeur1 FROM therm%d WHERE id=1' %i
     cursor.execute(table)
     tempp1 = cursor.fetchone();
     table = 'SELECT id, valeur2 FROM therm%d WHERE id=1' %i
     cursor.execute(table)
     tempp2 = cursor.fetchone();
     table = 'SELECT id, heu FROM therm%d WHERE id=1' %i
     cursor.execute(table)
     heu = cursor.fetchone();
     print tempp2[1]
     table ='INSERT INTO therm%d (valeur1, valeur2, heu) VALUES (%d,%d,%d)' %(i,tempp1[1],tempp2[1],heu[1])
     print 'mesure : ', i
     cursor.execute(table);
     db.commit();
