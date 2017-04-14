<?php

namespace Model;
use \W\Model\Model;

/**
 * Classe requise par l'AuthentificationModel, éventuellement à étendre par le UsersModel de l'appli
 */
class AdminModel extends Model
{

	public function findBy($nomColonne, $valeurColonne)
	{

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $nomColonne .'  = :nomColonne LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':nomColonne', $valeurColonne);
		$sth->execute();

		return $sth->fetch();
	}    
}