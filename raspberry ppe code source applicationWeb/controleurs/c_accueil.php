<?php
/**
*
 */

if ($estConnecte) {
    
    
$chauffage=$pdo->getInfosChauffage();


$temperatureExterieur = $chauffage[0]['exterieur']/1000;

$tabCuve=array($chauffage[0]['cuve1'],$chauffage[0]['cuve2'],
               $chauffage[0]['cuve3'],$chauffage[0]['cuve4'],
               $chauffage[0]['cuve5'],$chauffage[0]['cuve6']) ;

           
           $temperatureCuve=0;
           $i=0;

 for($i=0;$i<6;$i++)
 {
     if ($tabCuve[$i]/1000>35){
         $temperatureCuve = $temperatureCuve+(($tabCuve[$i]-35000)/1000);
     }
   
 }
$infosEau=$pdo->getInfosEau();

$reserveEau= $infosEau[0]['niveau'];

$ejp=$pdo->getInfosEjp();
$jourEjp = $ejp[0]['jourEjp'];
if($jourEjp==0){
    $lienPictoEjp="./images/ejpVert.png";
}
else
{
    $lienPictoEjp="./images/ejpRouge.png";
}

include 'vues/v_accueil.php';
} else {
    include 'vues/v_connexion.php';
}


