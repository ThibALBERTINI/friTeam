<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{

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

}