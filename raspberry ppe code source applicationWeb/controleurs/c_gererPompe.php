<?php
/**
* 
 */


// Numero Pompes

$pompeLavage=0;
$pompeGramond=1;
$pompeBonjean=2;
$pompeCabane=3;
$pompeClerc=4;

// Touches Actions
$pompeTimerPlus=2;
$pompeTimerMoins=3;
$pompeMarche=1;
$pompeArret=4;

$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date('d/m/Y'));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {  
case 'pompeLavage':
        $pdo->majPompeEnvoi($pompeLavage);
      break;
case 'pompeGramond':
    $pdo->majPompeEnvoi($pompeGramond);
    break;
case 'pompeBonjean':
    $pdo->majPompeEnvoi($pompeBonjean);
    break;
case 'pompeCabane':
    $pdo->majPompeEnvoi($pompeCabane);
    break;
case 'pompeClerc':
    $pdo->majPompeEnvoi($pompeClerc);
    break;
          
case 'pompeTimerMoins':
    $pdo->majPompeEnvoiTouche($pompeTimerMoins);
    sleep(1);
    break;
case 'pompeTimerPlus':
    $pdo->majPompeEnvoiTouche($pompeTimerPlus);
    sleep(1);
    break;
case 'pompeArret':
    $pdo->majPompeEnvoiTouche($pompeArret);
    sleep(1);
    break;
case 'pompeMarche':
    $pdo->majPompeEnvoiTouche($pompeMarche);
    sleep(1);
}


$pompe=$pdo->getNumeroPompe();
$pompeX=$pompe[0]['numeroPompe'];
$numeroPompeBase=$pompeX+1;




switch ($numeroPompeBase) {
case '1';
    $infosPompe = $pdo->getInfosPompe1();    
    break;
case '2':
    $infosPompe = $pdo->getInfosPompe2();
    break;
case '3':
    $infosPompe = $pdo->getInfosPompe3();
    break;
case '4':
    $infosPompe = $pdo->getInfosPompe4();
    break;
case '5':
    $infosPompe = $pdo->getInfosPompe5();
    break;

}

if(strncmp($infosPompe[0]['etatPompe'], "Minuterie", 4) == 0)
{
    $heures=$infosPompe[0]['minuteriePompe']/60;
   
    $etatPompe = "Minuterie : " . (int) $heures . "H" . $infosPompe[0]['minuteriePompe'] % 60 . "Min";
}else
{	
$etatPompe=$infosPompe[0]['etatPompe'];
}



switch ($pompeX) {
case '0';
   $nomPompeActuelle = "Pompe Lavage";         
    break;
case '1':
    $nomPompeActuelle = "Pompe Gramond"; 
    break;
case '2':
    $nomPompeActuelle = "Pompe Bonjean"; 
    break;
case '3':
    $nomPompeActuelle = "Pompe Cabane";
    break;
case '4':
    $nomPompeActuelle ="Pompe Clerc";
    break;
}

//require 'vues/v_listeFraisForfait.php';
require 'vues/v_pompe.php';

