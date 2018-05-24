<?php
/**
 * Index du projet raspberry
 *
 */

require_once 'includes/fct.inc.php';
require_once 'includes/class.pdo.inc.php';
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
require 'vues/v_entete.php';
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
if ($uc && !$estConnecte) {
    $uc = 'connexion';
} elseif (empty($uc)) {
    $uc = 'accueil';
}
switch ($uc) {
case 'connexion':
    include 'controleurs/c_connexion.php';
    break;
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'gererPompe':
    include 'controleurs/c_gererPompe.php';
    break;
case 'gererPiscine':
    include 'controleurs/c_gererPiscine.php';
    break;
case 'gererChambre':
    include 'controleurs/c_gererChambre.php';
    break;
case 'gererEdf';
    include 'controleurs/c_gererEdf.php';
    break;
case 'gererTemperatureMaison';
    include 'controleurs/c_gererTemperatureMaison.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
}
require 'vues/v_pied.php';
