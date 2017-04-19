<?php

namespace Model;

use \W\Model\Model;

class FormationModel
		extends MonModel
{
	//toutes les fonctionnalités sont héritées de la classe model

	public function rechercheFormation () 
	{
			$sql = "SELECT * FROM formation WHERE titre_formation LIKE :recherche OR lieu_formation LIKE :recherche OR conditions_formation LIKE :recherche OR public_formation LIKE :recherche OR intervenant_formation LIKE :recherche OR objectif_formation LIKE :recherche";    
    		
    		$sth = $this->dbh->prepare($sql);
    
		    // On execute la requête préparée en lui passant la valeur qui remplacera le tag :recherche
		    // WHERE ville LIKE '%mars%'
		    $sth->execute([
		        ":recherche" => '%'.$_GET['recherche'].'%'    
		    				]);
		    
		    $formations = $sth->fetchAll();
            return $formations;
	}
		
	public function selectFormations () 
		{
		    $sql = "SELECT * FROM formation";
		    // On va chercher toutes les formations
		    $sth = $this->dbh->prepare($sql);
		    $sth->execute();
		    $formations = $sth->fetchAll();
            return $formations;
		}

		// On créé un tableau $formations qui contient tous les résultats de la requête
		

	
}// fin formationModel

	