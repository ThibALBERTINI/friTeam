<?php

namespace Model;

use \W\Model\Model;

class MonModel
        extends Model
{
	/**
	 * Récupère une ligne de la table en fonction d'un identifiant
	 * @param  integer Identifiant
	 * @return mixed Les données sous forme de tableau associatif
	 */
	public function findBy($nomColonne, $valeurColonne)
	{

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $nomColonne .'  = :nomColonne LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':nomColonne', $valeurColonne);
		$sth->execute();

		return $sth->fetch();
	}    
}