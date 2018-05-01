<?php
/**
 *
 */
?>
<div class="row">    
    
    </BR> </BR></BR></BR>   
 <div class="container">            
            
                <div class="row vertical-align">
                   
                    <div class="col-md-8">
                        <ul class="nav nav-pills " role="tablist">
                            <li>
                                <form method="post" 
                                action="index.php?uc=gererPompe&action=pompeLavage" 
                                role="form">
                                <fieldset>                
                                    <button class="btn btn-danger <?php if ($pompeX==0) { ?>active<?php } ?> " type="submit">Pompe Lavage</button>               
                                </fieldset>
                            </form>
                            </li>
                            
                            <li>
                                <form method="post"
                                action="index.php?uc=gererPompe&action=pompeGramond
                                "role="form">             
                                <fieldset>                
                                    <button class="btn btn-danger <?php if ($pompeX==1) { ?>active<?php } ?>" type="submit">Pompe Gramond</button>               
                                </fieldset>
                                </form>
                            </li>
                            <li> 
                                <form method="post" 
                                     action="index.php?uc=gererPompe&action=pompeBonjean" 
                                     accept-charset=""role="form">
                                    <fieldset>                
                                         <button class="btn btn-danger pull-right <?php if ($pompeX==2) { ?>active<?php } ?>" type="submit">Pompe Bonjean</button>               
                                    </fieldset>
                                </form>
                            </li>
                            <li> 
                                <form method="post" 
                                 action="index.php?uc=gererPompe&action=pompeCabane" 
                                role="form">
                                <fieldset>                
                                  <button class="btn btn-danger <?php if ($pompeX==3) { ?>active<?php } ?>" type="submit">Pompe Cabane</button>               
                                 </fieldset>
                                </form>
                            </li>
                            <li> 
                                <form method="post" 
                                 action="index.php?uc=gererPompe&action=pompeClerc" 
                                 role="form">
                                <fieldset>                
                                    <button class="btn btn-danger <?php if ($pompeX==4) { ?>active<?php } ?>" type="submit">Pompe Clerc</button>               
                                </fieldset>
                                </form>
                            </li>
                            
                        </ul>
                    </div>
                
            </div>    
    
    
     </BR></BR>
     
</div> 
    <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span>
                    <?php echo $nomPompeActuelle; ?>
                </h3>
            </div> 
            <div class="panel-body">
                
                <h3> <?php echo $etatPompe; ?> </h3>
                
                
                </div>
            </div>
        </div>
    </div>
</div>
</BR></BR></BR>




   <div class="row">    
    
  
 <div class="container">                       
                <div class="row vertical-align">                   
                    <div class="col-md-8">
                        <ul class="nav nav-pills pull-center" role="tablist">
           <li>
        <form method="post" 
              action="index.php?uc=gererPompe&action=pompeArret" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">Arret</button>               
            </fieldset>
        </form>
          </li>
           <li>                      
        <form method="post" 
              action="index.php?uc=gererPompe&action=pompeTimerMoins" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">Moins</button>               
            </fieldset>
        </form>
        </li>
        <li>
        <form method="post" 
              action="index.php?uc=gererPompe&action=pompeTimerPlus" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">Plus</button>               
            </fieldset>           
        </form>
        </li>
        <li>
        <form method="post" 
              action="index.php?uc=gererPompe&action=pompeMarche" 
              role="form">
            <fieldset>                
                <button class="btn btn-success" type="submit">Marches</button>               
            </fieldset>  
        </form>
        </li>
    </div>
    
    
    <p>
       <?php
       
       ?>
	
    </p>
        
        
        
</div>
