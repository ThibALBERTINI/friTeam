<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\AccompagnementModel; //pas utilisé... a voir ou placer les fct..? on les laissent dans les pages? on les mets dans les model? dans le DefaultController?
use \Model\ContactModel;

class DefaultController extends Controller
{
	public $titrePage = "";
	public function friteamEquipe()
	{
		$titrePage = "qui-sommes nous ?";
		$this->show("pages/default_friteam-equipe", [ "titrePage" => $titrePage ]);

	}

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		// CONTROLLER
		// TRAITEMENT DU FORMULAIRE DE NEWSLETTER
		$this->newsletterTraitement();

		// $this CONTIENT L'OBJET QUI SERT A APPELER LA METHODE
		// LA METHODE show EST FOURNIE PAR LA CLASSE Controller
		// DONT CETTE CLASSE HERITE
		// show VA ACTIVER LA PARTIE VIEW POUR CREER LE HTML
		$this->show("pages/default_home");
	}

	public function newsletterTraitement ()
	{
		// VARIABLE LOCALE
		$message = "";

		if (isset($_REQUEST["operation"]) && ($_REQUEST["operation"] == "newsletter"))
		{
			// RECUPERER LES INFOS DU FORMULAIRE
			$email = trim($_REQUEST["email"]);

			// UN PEU DE SECURITE
			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{

				// ON VA STOCKER L'EMAIL DANS UNE TABLE MYSQL newsletter
				//		id		INT		PRIMARY_KEY	A_I
				//		email	VARCHAR(255)
				// PENSER A AJOUTER use \Model\NewsletterModel AU DEBUT DU FICHIER
				$objetmailing_clientModel = new \Model\mailing_clientModel;
				// ON FAIT UNE RECHERCHE PAR LA COLONNE "email"
				$tabLigne = $objetmailing_clientModel->findBy("mail_mailing_client", $email);
				if (empty($tabLigne))
				{
					// EMAIL N'EST PAS DEJA DANS LA TABLE
					// ON VA AJOUTER LA LIGNE DANS LA TABLE MYSQL newsletter
					$objetmailing_clientModel->insert([ "mail_mailing_client" => $email ]);
					// OK
					$message = "MERCI DE VOTRE INSCRIPTION ($email)";
				}
				else
				{
					// EMAIL EST DEJA PRESENT
					$message = "EMAIL DEJA INSCRIT ($email)";
				}
			}
			else
			{
				// KO
				$message = "EMAIL INCORRECT ($email)";
			}
		}
		// JE VAIS TRANSMETTRE DANS LA PROPRIETE LA VALEUR DE LA VARIABLE LOCALE
		$this->message = $message;
	}

	public function ajax ()
	{
		// ICI ON VA TRAITER LE FORMULAIRE AJAX
		// ET ON VA RENVOYER UN TEXTE AU FORMAT JSON
		// ON VA UTILISER LA FONCTION json_encode
		// (C'EST LA FRAMEWORK W QUI VA LE FAIRE...)
		// ON PREND UN TABLEAU ASSOCIATIF EN PHP
		// ET json_encode VA LE TRANSFORMER EN TEXTE OBJET JAVASCRIPT
		$tabAssociatif = [];	// VIDE AU DEPART

		// TRAITER LE FORMULAIRE DE NEWSLETTER
		// $this REPRESENTE UN OBJET DE LA CLASSE DefaultCOntroller
		// (CREE PAR LE ROUTEUR DE W...)
		$this->newsletterTraitement();

		// TRANSMETTRE LA PROPRIETE MESSAGE DANS LA REPONSE JSON
		$tabAssociatif["message"] = $this->message;

		// ON UTILISE LA METHODE showJson DU FRAMEWORK W
		$this->showJson($tabAssociatif);
	}

	// 	public function formation()
	// {
	// 	// CONTROLLER
	// 	// TRAITEMENT DU FORMULAIRE DE NEWSLETTER
	// 	//$this->newsletterTraitement();

	// 	// $this CONTIENT L'OBJET QUI SERT A APPELER LA METHODE
	// 	// LA METHODE show EST FOURNIE PAR LA CLASSE Controller
	// 	// DONT CETTE CLASSE HERITE
	// 	// show VA ACTIVER LA PARTIE VIEW POUR CREER LE HTML
	// 	$this->show("pages/admin-section-formation");
	// }

	public function contact()
	{
		//Initialise la valeur de la variable
		$message = "";
		
		//je peux traiter le formulaire (s'il y a un formulaire a traiter)
		if(isset($_POST["operation"]))
		{
			//Récuperer les infos du formulaire
		
			$civilite 		= trim($_POST["civilite_contact"]);
			$nom 			= trim($_POST["nom_contact"]);
			$prenom 		= trim($_POST["prenom_contact"]);
			$email 			= trim($_POST["email_contact"]);
			$tel 			= trim($_POST["tel_contact"]);
			$adresse		= trim($_POST["adresse_contact"]);
			$cp				= trim($_POST["cp_contact"]);
			$ville			= trim($_POST["ville_contact"]);
			$message		= trim($_POST["message_contact"]);
		
			//Sécurité
			//Vérifier que chaque information est conforme
			if (($_POST["civilite_contact"] == "madame") || ($_POST["vivilite_contact"] == "monsieur")	&& ( mb_strlen($civilite) > 0 ) //verif radio ok
				&& is_string($nom)																			&& ( mb_strlen($nom) > 0 )
				&& is_string($prenom)																		&& ( mb_strlen($prenom) > 0 )
				&& (filter_var($email, FILTER_VALIDATE_EMAIL) !== false)									&& !empty($email)
				&& (is_numeric($tel) !== false)																		&& ( mb_strlen($tel) > 0 )
				&& is_string($adresse)																		&& ( mb_strlen($adresse) > 0 )
				&& (ctype_digit($cp))																			&& ( mb_strlen($cp) > 0 ) //ctype_digit vérifie qu'une chaîne est un entier
				&& is_string($ville)																		&& ( mb_strlen($ville) > 0 )
				&& is_string($message)																		&& ( mb_strlen($message) > 0 )
				)
			{
				//Enregistrer les information receuillies par le formulaire dans la base de données
				//Création d'un objet de la classe ContatModel
				$objetContactModel = new ContactModel; //Si pb, le model Contact n'est peut etre pas créé
				$objetContactModel->insert([
					 	"civilite_contact"	=> $civilite,
						"nom_contact" 		=> $nom,
				 		"prenom_contact" 	=> $prenom,
			 			"email_contact" 	=> $email,
			 			"tel_contact" 		=> $tel,
						"adresse_contact" 	=> $adresse,
						"cp_contact" 		=> $cp,
						"ville_contact" 	=> $ville,
						"message_contact" 	=> $message,
					], true);
				$message = "Formulaire envoyé a l'administrateur";
			}
			else
			{
				$message = "Erreur lors de l'enregistrement";
			}
		}
		$titrePage = "contact";
		$this->show("pages/default_contact", [ "message" => $message, "titrePage" => $titrePage ]);
	}

	public function formation()
	{
		if(isset($_GET['recherche']) && strlen($_GET['recherche']) >= 2)
		{
			$objetFormationModel = new \Model\FormationModel;
			$tabResult= $objetFormationModel->rechercheFormation();
			
		}
		else
		{
			$objetFormationModel = new \Model\FormationModel;
			$tabResult= $objetFormationModel->selectFormations ();
		}

		if(!empty($tabResult))
			{
			  foreach ($tabResult as $index => $tabInfo)
			  {
			    $titre = $tabInfo["titre_formation"];
			    $img = $tabInfo["img"];
			    $date = $tabInfo["date_formation"];
			    $duree = $tabInfo["duree_formation"];
			    $chapo = $tabInfo["chapo_formation"];
			    $lieu = $tabInfo["lieu_formation"];
			    $categorie = $tabInfo["categorie_formation"];
			    $conditions = $tabInfo["conditions_formation"];
			    $intervenant = $tabInfo["intervenant_formation"];
			    $lien = $tabInfo["lien_catalogue"];
			    $ojectif = $tabInfo["objectif_formation"];
			    $presentation = $tabInfo["presentation_formation"];
			    $programme = $tabInfo["programme_formation"];
			    $public = $tabInfo["public_formation"];
			    $url = $tabInfo["url"];

			    //$href = $this->url("default_formation-detail", [ "url" => $url ]);

			    //$cheminAsset = $this->assetUrl("/");
			  }
			}

			$objetFormationModel = new \Model\FormationModel;
			$tabFormations= $objetFormationModel->findAll (); 

					// On créé un tableau vide qui va contenir les categories
			$categs = [];

			// Pour chaque resultats de notre recherche des catégories
			foreach($tabFormations as $resultat)  
			{
			    // On créé un tableau $specialites qui va contenir les specialites de la formation qu'on analyse
			    $categorie = $resultat['categorie_formation'];
			    // Pour chaque categ de la formation (categFriteam, categComplementaire)
			      // Si la specialité n'existe pas dans le tableau des categories
			        if(!in_array($categorie, $categs))
			        {
			            // On ajoute au tableau des marques la specialités
			            array_push($categs, $categorie);
			        }
			    
			}


		$titrePage = "formation";
		$this->show("pages/default_formation", [ "titrePage" => $titrePage, "categs"=> $categs, "tabResult" => $tabResult, "tabFormations" =>$tabFormations ]);
	} // fin function formation

	public function formationDetail($url)
	{
		$titrePage = "formation Detail";
		$this->show("pages/default_formation-detail", [ "titrePage" => $titrePage, "url" => $url ]);
	}

		public function accompagnement()
	{
		$titrePage = "accompagnement";
		$this->show("pages/default_accompagnement", [ "titrePage" => $titrePage ]);
	}

		public function accompagnementDetail($url)
	{
		$titrePage = "accompagnement detail";
		$this->show("pages/default_accompagnement-detail", [ "titrePage" => $titrePage, "url" => $url ]);
	}

}