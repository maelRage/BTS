<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h1> Courges :<?php echo $tempCourge ;?> °C</h1>
<h1> Exterieur :<?php echo $tempExterieur ;?> °C</h1>
<h1> Chambre Froide :<?php echo $tempChambre;?>°C</h1>



<h1>Consigne Chauffage : <?php echo $ordreChauffage; ?>°C </h1>


<div>
         <form method="post" 
              action="index.php?uc=gererChambre&action=chauffageChambrePlus" 
              role="form">
         
        
            <fieldset>                
                <button class="btn btn-success" type="submit">+ 1 °C</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererChambre&action=chauffageChambreMoins" 
              role="form">
    
            <fieldset>                
                <button class="btn btn-success" type="submit">- 1°C</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererChambre&action=chauffageChambreMarche" 
              role="form">
    
            <fieldset>                
                <button class="btn btn-success" type="submit">Chauffage Marche</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererChambre&action=chauffageChambreArret" 
              role="form">
        
        
            <fieldset>                
                <button class="btn btn-success" type="submit">Chauffage Arret</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererChambre&action=chauffageChambreAuto" 
              role="form">
    
            <fieldset>                
                <button class="btn btn-success" type="submit">Chauffage Auto</button>               
            </fieldset>
        </form>
        
    <p>Chaufage Etat :<?php echo $etatChauffage; ?> </p>
    <p>Relais Chaufage Etat :<?php echo $etatRelaisChauffage; ?> </p>
    <p>
        <form method="post" 
              action="index.php?uc=gererChambre&action=ventilationMarche" 
              role="form">
    
            <fieldset>                
                <button class="btn btn-success" type="submit">Ventilation Marche</button>               
            </fieldset>
        </form>
        
        <form method="post" 
              action="index.php?uc=gererChambre&action=ventilationArret" 
              role="form">
        
 
            <fieldset>                
                <button class="btn btn-success" type="submit"> Ventilation Arret</button>               
            </fieldset>
        </form>
        <form method="post" 
              action="index.php?uc=gererChambre&action=ventilationAuto" 
              role="form">
    
            <fieldset>                
                <button class="btn btn-success" type="submit">Ventilation Auto</button>               
            </fieldset>
        </form>
        
        
    </p>
      <p>Ventilation Etat :<?php echo $etatVentilation; ?> </p>
    <p>Relais Ventilation Etat :<?php echo $etatRelaisVentilation; ?> </p>  
</div>