<?php

/* 
*
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);



$infosChambre=$pdo->getInfosChambre();

// Récupération Températures
$tempChambre=$infosChambre[0]['Chambre']/1000.0;
$tempExterieur=$infosChambre[0]['Exterieur']/1000.0;
$tempCourge=$infosChambre[0]['Courge']/1000.0;
$ordreChauffage=$infosChambre[0]['tChauffage'];

// Récupération état
$numEtatChauffage=$infosChambre[0]['etatChauffage'];
$numRelaisChaufage=$infosChambre[0]['relaisChauffage'];
$numEtatVentilation=$infosChambre[0]['etatVentillation'];
$numRelaisVentilation=$infosChambre[0]['relaisVentillation'];

 // Transformation de l'état recus en chaine de caractère affichable
$etatChauffage=intToStringEtatFonctionnement($numEtatChauffage);
$etatVentilation=intToStringEtatFonctionnement($numEtatVentilation);
$etatRelaisChauffage=intToStringEtatRelais($numRelaisChaufage);
$etatRelaisVentilation=intToStringEtatRelais($numRelaisVentilation);




switch ($action) {
    
case 'chauffageChambrePlus';
        $pdo->majChambrePlus();
      break;
case 'chauffageChambreMoins';
        $pdo->majChambreMoins();
    
    break;
case'chauffageChambreArret';
        $pdo->majChambreArret();
    break;

case 'chauffageChambreAuto';
        $pdo->majChambreAuto();
    break;

case 'chauffageChambreMarche';
        $pdo->majChambreMarche();
    break;

case 'ventilationArret';
        $pdo->majVentilationArret();
    break;

case 'ventilationAuto';
        $pdo->majVentilationAuto();
    break;

case 'ventilationMarche';
         $pdo->majVentilationMarche();
    break;


}





require 'vues/v_chambre.php';