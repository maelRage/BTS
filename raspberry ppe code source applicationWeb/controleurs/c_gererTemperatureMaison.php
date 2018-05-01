<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$infosTemperatures = $pdo->getInfosTemperatures();
$nomColonneBaseChauffage = array("exterieur","veranda","bureau","eauSanitaire","sortieChaudiere","departChaudiere","cuve1","cuve2","cuve3","cuve4","cuve5","cuve6","retourChaudiere","entreeChaudiere","retourRadiateur","alleeRadiateur");
$nombreColonneBaseChauffage = count($nomColonneBaseChauffage);

$i=0;


require 'vues/v_temperatureMaison.php';

