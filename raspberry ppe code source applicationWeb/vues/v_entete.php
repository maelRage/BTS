<?php
/**
 * Vue Entête
*
 */
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">
        <title>Raspberry</title> 
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./styles/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="./styles/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <?php
            $uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
            if ($estConnecte) {
                ?>
            <div class="header">
                <div class="row vertical-align">
                    <div class="col-md-4">
                        <h1>
                            <img src="./images/framboise.png" class="img-responsive" 
                                 alt="Raspberry" 
                                 title="Raspberry">
                        </h1>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-pills pull-right" role="tablist">
                            <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
                                <a href="index.php">
                                    <span class="glyphicon glyphicon-home"></span>
                                    Accueil
                                </a>
                            </li>
                            <li <?php if ($uc == 'gererPompe') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=gererPompe">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Pompe
                                </a>
                            </li>
                            <li <?php if ($uc == 'gererTemperatureMaison') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=gererTemperatureMaison">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    temperatureMaison
                                </a>
                            </li>
                            <li <?php if ($uc == 'gererEdf') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=gererEdf">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Edf
                                </a>
                            </li>
                            <li <?php if ($uc == 'gererPiscine') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=gererPiscine">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Piscine
                                </a>
                            </li>
                            <li <?php if ($uc == 'gererChambre') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=gererChambre">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Chambre
                                </a>
                            </li>
                            <li 
                            <?php if ($uc == 'deconnexion') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=deconnexion&action=demandeDeconnexion">
                                    <span class="glyphicon glyphicon-log-out"></span>
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            } else {
                ?>   
                <h1>
                    <img src="./images/framboise.png"
                         class="img-responsive center-block"
                         alt="Rasp"
                         title="Rasp">
                </h1>
                <?php
            }
