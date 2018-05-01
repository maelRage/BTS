<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<h1>Température Eau : <?php echo $temperatureEauPiscine; ?>°C </h1>
<h1>Etat Moteur Pompe : <?php echo $etatPompePiscine; ?> </h1>
<h1>Etat Robot : <?php echo $etatRobot ?>  </h1>

<h1>Filtration  : <?php echo $etatFiltration ?> </h1>
<h1>Temps Filtration Journalier : <?php echo $tempsFiltrationJournalier ?> </h1>
<h1>Dérogation: <?php echo $tempsDelestage ?> </h1>
<p>
<div class="col-md-4">
        <form method="post" 
              action="index.php?uc=gererPiscine&action=etatFiltration" 
              role="form">
            <fieldset>
                
                <button class="btn btn-success" type="submit">Marche/Arret</button>  
                
            </fieldset>
        </form>
        
        <form method="post" 
              action="index.php?uc=gererPiscine&action=filtrageMoins" 
              role="form">
            <fieldset>        
                
                <button class="btn btn-success" type="submit">-30</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererPiscine&action=filtragePlus" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">+30</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererPiscine&action=automatiqueManuel" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">Auto/Manuel</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererPiscine&action=derrogation" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">Derrogation</button>  
                <p></p>
            </fieldset>
        </form>
    </div>
</p>
<p>
<div>
<h2>Phase 1</h2>
<h2>courrant Min : <?php echo $courrantMinPiscine ?> </h2>
<form method="post" 
              action="index.php?uc=gererPiscine&action=courrantMinMoins" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">-</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererPiscine&action=courrantMinPlus" 
              role="form">
    
            <fieldset>                
                <button class="btn btn-success" type="submit">+</button>               
            </fieldset>
        </form>
</div>
</p>
<p>
<div>
<form method="post" 
              action="index.php?uc=gererPiscine&action=courrantMaxMoins" 
              role="form">
    <h2>courrant Max :<?php echo $courrantMaxPiscine; ?></h2>
            <fieldset>                
                <button class="btn btn-success" type="submit">-</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererPiscine&action=courrantMaxPlus" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">+</button>               
            </fieldset>
        </form>
</div>
</p>
<p>
<div>
<form method="post" 
              action="index.php?uc=gererPiscine&action=etatRobot" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">Marche/Arret Robot</button>               
            </fieldset>
        </form>
</div>
</p>