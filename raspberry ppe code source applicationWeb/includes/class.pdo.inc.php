<?php


/**
 * Classe d'accès aux données.
 *
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsb qui contiendra l'unique instance de la classe
 *

 */

class PdoR
{
    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=raspberry';
    private static $user = 'root';
    private static $mdp = '';
    private static $monPdo;
    private static $monPdoR = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        PdoR::$monPdo = new PDO(
            PdoR::$serveur . ';' . PdoR::$bdd,
            PdoR::$user,
            PdoR::$mdp
        );
        PdoR::$monPdo->query('SET CHARACTER SET utf8');
    }

    /**
     * Méthode destructeur appelée dès qu'il n'y a plus de référence sur un
     * objet donné, ou dans n'importe quel ordre pendant la séquence d'arrêt.
     */
    public function __destruct()
    {
        PdoR::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
     *
     * @return l'unique objet de la classe PdoGsb
     */
    public static function getPdoR()
    {
        if (PdoR::$monPdoR == null) {
            PdoR::$monPdoR = new PdoR();
        }
        return PdoR::$monPdoR;
    }

    /**
     * Retourne les informations d'un visiteur
     *
     * @param String $login Login du visiteur
     * @param String $mdp   Mot de passe du visiteur
     *
     * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
     */
    public function getInfosVisiteur($login, $mdp)
    {
        $requetePrepare = PdoR::$monPdo->prepare(
            'SELECT visiteur.id AS id, visiteur.nom AS nom, '
            . 'visiteur.prenom AS prenom '
            . 'FROM visiteur '
            . 'WHERE visiteur.login = :unLogin AND visiteur.mdp = :unMdp'
        );
        $requetePrepare->bindParam(':unLogin', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMdp', $mdp, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }

    
    
    public function majPompeEnvoi($pompe)
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE pompeenvoi '
                . 'SET pompeenvoi.pompe = :pompe, '
                . 'pompeenvoi.touche = 5 '
                . 'WHERE id = 1 '           
                );
        $requetePrepare->bindParam (':pompe', $pompe, PDO::PARAM_INT);
        $requetePrepare->execute();
    }
    
    public function majPompeEnvoiTouche($touche)
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE pompeenvoi '
                . 'SET touche = :touche '
                . 'WHERE id = 1 '           
                );
        $requetePrepare->bindParam (':touche', $touche, PDO::PARAM_INT);
        $requetePrepare->execute();
    }
    
     public function getNumeroPompe()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
            'SELECT pompeenvoi.pompe as numeroPompe '
            . 'FROM pompeenvoi '
            . 'WHERE id = 1'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    
    public function getInfosPompe1(){
        $requetePrepare = PdoR::$monPdo->prepare(
            
            'SELECT pompe1.etat as etatPompe, '
            .'pompe1.minuterie as minuteriePompe '
            . 'FROM pompe1 '
            . 'WHERE id = 1'
        );
        
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    
    public function getInfosPompe2(){
        $requetePrepare = PdoR::$monPdo->prepare(
            
            'SELECT pompe2.etat as etatPompe, '
            .'pompe2.minuterie as minuteriePompe '
            . 'FROM pompe2 '
            . 'WHERE id = 1'
        );
        
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    
    public function getInfosPompe3(){
        $requetePrepare = PdoR::$monPdo->prepare(
            
            'SELECT pompe3.etat as etatPompe, '
            .'pompe3.minuterie as minuteriePompe '
            . 'FROM pompe3 '
            . 'WHERE id = 1'
        );
        
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    
    public function getInfosPompe4(){
        $requetePrepare = PdoR::$monPdo->prepare(
            
            'SELECT pompe4.etat as etatPompe, '
            .'pompe4.minuterie as minuteriePompe '
            . 'FROM pompe4 '
            . 'WHERE id = 1'
        );
        
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    
    public function getInfosPompe5(){
        $requetePrepare = PdoR::$monPdo->prepare(
            
            'SELECT pompe5.etat as etatPompe, '
            .'pompe5.minuterie as minuteriePompe '
            . 'FROM pompe5 '
            . 'WHERE id = 1'
        );
        
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
     public function getInfosChauffage(){
        $requetePrepare = PdoR::$monPdo->prepare(
            
            'SELECT * FROM chauffage '
            . 'WHERE id = 1'
        );
        
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    public function getInfosEau(){
        $requetePrepare = PdoR::$monPdo->prepare(
            
            'SELECT * FROM eau '
            . 'WHERE id = 1'
        );
        
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    public function getInfosEjp(){
        $requetePrepare = PdoR::$monPdo->prepare(
            
            'SELECT * FROM edf '
            . 'WHERE id = 1'
        );
        
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
///////////////////                 ///////////////////
    //////////     Fonctions Piscine    //////////                          
        /////                          /////

    public function majEtatFiltration()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Arret#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }
    
    public function majFiltragePlus()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Filtrage+#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }
    
    public function majFiltrageMoins()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Filtrage-#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }
    
    public function majAutomatiqueManuel()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Filtrage auto#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }
    
    
    public function majDerrogation()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Forcage#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }
    public function majCourrantMinMoins()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Courant Min -#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();  
        
    }public function majCourrantMinPlus()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Courant Min +#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();  
        
    }public function majCourrantMaxMoins()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Courant Max -#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();    
        
    }
    
    public function majCourrantMaxPlus()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Courant Max +#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }
    
    public function majEtatRobot()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE piscineenvoi '
                . 'SET Ordre = "|Robot#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }
    
    
    public function getInfosPiscine()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'SELECT * FROM piscine '                
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

   ///////////////////                 ///////////////////
    //////////     Fonctions Chambre    //////////                          
        /////                          /////

    public function majChambrePlus()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE chambreenvoi '
                . 'SET Ordre = "|Temperature+#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }

    public function majChambreMoins()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE chambreenvoi '
                . 'SET Ordre = "|Temperature-#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }

    public function majChambreArret()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE chambreenvoi '
                . 'SET Ordre = "|Arret_chauffage#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }

    public function majChambreAuto()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE chambreenvoi '
                . 'SET Ordre = "|Auto_chauffage#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }

    public function majChambreMarche()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE chambreenvoi '
                . 'SET Ordre = "|Marche_chauffage#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }

    public function majVentilationArret()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE chambreenvoi '
                . 'SET Ordre = "|Arret_ventilation#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }

    public function majVentilationMarche()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE chambreenvoi '
                . 'SET Ordre = "|Marche_ventilation#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }

    public function majVentilationAuto()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'UPDATE chambreenvoi '
                . 'SET Ordre = "|Auto_ventilation#" '
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();       
    }

    public function getInfosChambre()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'SELECT * FROM chambre '                
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

///////////////////                 ///////////////////
    //////////     Fonctions EDF    //////////                          
        /////                          /////

    public function getInfosEdf()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'SELECT * FROM edf '                
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    
    

///////////////////                 ///////////////////
    //////////     Fonctions EDF    //////////                          
        /////                          /////
    
    public function getInfosTemperatures()
    {
        $requetePrepare = PdoR::$monPdo->prepare(
                'SELECT * FROM chauffage '                
                . 'WHERE id = 1'
                );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
}