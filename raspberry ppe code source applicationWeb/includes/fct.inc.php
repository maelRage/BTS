<?php


function estConnecte()
{
    return isset($_SESSION['idVisiteur']);
}

function connecter($idVisiteur, $nom, $prenom)
{
    $_SESSION['idVisiteur'] = $idVisiteur;
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
}


function deconnecter()
{
    session_destroy();
}


function getMois($date)
{
    @list($jour, $mois, $annee) = explode('/', $date);
    unset($jour);
    if (strlen($mois) == 1) {
        $mois = '0' . $mois;
    }
    return $annee . $mois;
}


function intToStringEtatFonctionnement($numeroEtat){
	if($numeroEtat==0){
		return "En Arret";
	}
	else
	{
		if($numeroEtat==2)
		{
			return "Automatique";
		}
		else
		{
			return "En Marche";
		}
	}

}

 function intToStringEtatRelais($numeroEtatRelais){
	if($numeroEtatRelais==0){
		return "En Arret";
	}
	else
	{		
		return "En Marche";
	}

}


