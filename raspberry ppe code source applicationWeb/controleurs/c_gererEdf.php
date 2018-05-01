<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$nomColonneBaseEdf = array("courantPhase1","courantPhase2","courantPhase3","indexHeureCreuse","indexHeureEjp","date");
$nombreColobneBaseEdf = count($nomColonneBaseEdf);

$i=0;

$infosEdf=$pdo->getInfosEdf();




require 'vues/v_edf.php';
