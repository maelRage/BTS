<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<body>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span>
                    Informations edf
                </h3>
            </div>
            <div class="panel-body">
                <?php
                    for ($i=0; $i<$nombreColobneBaseEdf; $i++){   
                       echo $nomColonneBaseEdf[$i]." : ";  
                       echo$infosEdf[0][$nomColonneBaseEdf[$i]];
                       echo "<BR>";
                    }               
                ?>
                
                
                </div>
            </div>
        </div>
    </div>
</div>
</body>