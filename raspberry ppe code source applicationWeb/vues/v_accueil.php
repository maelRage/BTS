<?php
/**
 * Vue Accueil
 *
 */
?>
<div id="accueil">
    <h2>
       <small>  Visiteur : 
            <?php 
            echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']
            ?></small>
    </h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span>
                     Informations Générales
                </h3>
            </div>
            <div class="panel-body">
                <p>Température éxtérieur : <?php echo $temperatureExterieur;  ?>°C</p>  
                
                <p>Chaudière :<?php echo $temperatureCuve;  ?>°C</p>
                
                <p>Réserve Eau : <?php echo $reserveEau;  ?>%</p>
                
                <p>Jour Ejp : <img src="<?php echo $lienPictoEjp;?>"</p>
            </div>
        </div>
    </div>
</div>