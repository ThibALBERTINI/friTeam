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

	public function upload($file)
	{
		$repertoire = "public/assets/img"; //repertoire où le fichier va être stocké
		$fichier = $repertoire . basename($_FILES["file"]["name"]); //chemin du fichier uploadé
		$uploadOk = 1;
		$imageFileType = pathinfo($fichier,PATHINFO_EXTENSION); //récupère l'extension du fichier
		// Verifier que l'image existe dans l'upload
		if(isset($_POST["submit"])) 
		{
    		$check = getimagesize($_FILES["file"]["tmp_name"]);
    		if($check !== false) 
    		{
        		echo "Le fichier uploadé est une image - " . $check["mime"] . ".";
        		$uploadOk = 1;
    		} else 
    		{
        		echo "Le fichier uploadé n'est pas une image.";
       	 		$uploadOk = 0;
    		}
		}
		// Verifier si le fichier existe déjà
		if (file_exists($fichier)) 
		{
    		echo "Désolé, le fichier existe déjà.";
    		$uploadOk = 0;
		}
		// Verifier la taille de l'image uploadé
		if ($_FILES["file"]["size"] > 500000) 
		{
		    echo "Votre image est trop lourde. Taille maximale autorisée : 500 ko.";
 	   		$uploadOk = 0;
		}
		// Formats acceptés
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
		{
    		echo "Le fichier doit être au format .jpg ou .png ou .jpeg ou .gif";
    		$uploadOk = 0;
		}
		// Vérifier si $uploadOk est à 0 à cause d'une erreur
		if ($uploadOk == 0) 
		{
    		echo "Désolé, votre fichier n'a pas pu être chargé.";
			// if everything is ok, try to upload file
		} else 
		{
    		if (move_uploaded_file($_FILES["file"]["tmp_name"], $fichier)) 
    		{
        		echo "Votre fichier : ". basename( $_FILES["file"]["name"]). " à été enregistré.";
    		} else 
    		{
        		echo "Désolé, votre fichier : ". basename( $_FILES["file"["name"]). " n'a pas pu être téléchargé.";
    		}
		}
	}
}