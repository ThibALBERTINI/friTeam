<?php
namespace Controller;

use \W\Controller\Controller;
use \Model\AdminModel;

class AdminController extends Controller
{
	public function home ()
	{
		 $this->allowTo([ "admin", "super-admin" ]);

	}// fin function home

	public function friteamEquipe ()
	{
 		$this->allowTo([ "admin", "super-admin" ]);
	}// fin function friteam-equipe

	public function formation ()
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function formation

	public function formationDetail ()
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function formation-detail

	public function accompagnement ()
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	} // fin function accompagnement

	public function accompagnementDetail ()
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function accompagnement-detail


	public function blog ()
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function blog

	public function blogDetail ()
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function blog-detail


	public function contact ()
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	} // fin function contact

	public function creerAdmin ()
	{

		if (isset($_POST["operation"]) && ($_POST["operation"] == "creer"))  //vient du input hidden mais si le questionnaire est vide il sera stoppé par les verif is_string... (et les required de form)
		{
			//array_map('strip_tags', $POST);  //note est-ce nécessaire de nettoyer la partie admin?
			 // RECUPERER LES INFOS DU FORMULAIRE
          
           
            $login              = $_POST["login"];
            $email              = $_POST["email"];
            $password            = $_POST["password"];
            $role              = $_POST["role"]; // recuperer la values
           
            
            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($login)           && ( mb_strlen($login) > 4 )
                    && is_string($email)    && ( mb_strlen($email) > 4 ) 
                    
                    && is_string($password)  && ( mb_strlen($password) > 4 ) 
                   
                )//fin ifstring
            {
               // OK ON A LES BONNES INFOS
                
                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL admin
                // JE CREE UN OBJET DE LA CLASSE ArticleModel
                // NE PAS OUBLIER DE FAIRE use
                $objetAdminModel = new AdminModel;
                // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                $objetAdminModel->insert([
                    "login"         => $login, 
                    "email"         => $email, 
                    "password"       => $password, 
                    "role"     => $role, 
                    
                    ]);

                $message = "Vous avez créé l'administrateur" . $login;
            }// fin ifstring
            else
            {
            	$message= "ERREUR : INFO INCORRECTE";
                // UNE ERREUR transmettre à la partie view (en dessous $this->show)
            }
  
        }// fin if ISSET CREER

		 //$this->allowTo([ "super-admin" ]);


		$this->show("pages/admin_creer-admin");
	} // fin function creer adamin

	public function logout ()
	{
		$objetAuthentificationModel = new \W\Security\AuthentificationModel;
        $objetAuthentificationModel->logUserOut();
        
        // REDIRIGER VERS LA PAGE DE LOGIN
        $this->redirectToRoute("users_login");
	}// fin function logout


} // fin class AdminController
