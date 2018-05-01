<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$infosPiscine= $pdo->getInfosPiscine();

$temperatureEauPiscine = $infosPiscine[0]['temperatureEau']/1000;
$numEtatRobot= $infosPiscine[0]['etatRobot'];
$numEtatMoteurPompePiscine = $infosPiscine[0]['etatPompe'];
$numEtatDelestage = $infosPiscine[0]['delestage'];
$courrantMinPiscine = $infosPiscine[0]['courantmin'];
$courrantMaxPiscine =   $infosPiscine[0]['courantmax'];
$tempsDerogation = $infosPiscine[0]['tempsForcage'];
$tempsFiltration = $infosPiscine[0]['tempsFiltration'];

if ($numEtatMoteurPompePiscine==1)
{
    $etatPompePiscine="En Marche";
}
else
{
    $etatPompePiscine="Arretée";
}

if ($numEtatRobot>1)
{
    $etatRobot= "En Marche Pour" . $numEtatRobot . "Minutes";
}
else
{
    $etatRobot= "Arretée";
}

if ($numEtatDelestage==1)
{
    $etatDelestage = "Delestage en cours";
}
else
{
    $etatDelestage = "Pas de délestage acctuelement";
}

if ($numEtatMoteurPompePiscine==1)
{
    $etatFiltration  = " Arretée";
}
else
{
    $etatFiltration  = "En Marche";
}

$heuresFiltration= $tempsFiltration/60;
$tempsFiltrationJournalier = (int) $heuresFiltration . "H" . $tempsFiltration%60 . "Min";

$heuresDerogation= $tempsDerogation/60;
$tempsDelestage = (int) $heuresDerogation . "H" . $tempsDerogation%60 . "Min";

switch ($action) {
    
case 'etatFiltration';
        $pdo->majEtatFiltration();
      break;
case 'filtrageMoins';
        $pdo->majFiltrageMoins();
    
    break;
case'filtragePlus';
        $pdo->majFiltragePlus();
    break;

case 'automatiqueManuel';
        $pdo->majAutomatiqueManuel();
    break;

case 'derrogation';
        $pdo->majDerrogation();
    break;

case 'courrantMinMoins';
        $pdo->majCourrantMinMoins();
    break;

case 'courrantMinPlus';
        $pdo->majCourrantMinPlus();
    break;

case 'courrantMaxPlus';
         $pdo->majCourrantMaxPlus();
    break;
case 'courrantMaxMoins';
        $pdo->majCourrantMaxMoins();
    break;
case 'etatRobot';
        $pdo->majEtatRobot();
    break;

}



require 'vues/v_piscine.php';