<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\AdminModel;
use \Model\FormationModel;
use \Model\ProfilModel;



class AdminController
        extends Controller
{
    //PROPRIETE
    public $message = "";
    public $titrePage = "";

    public function creerAdmin ()  // supprimer et modifier compris
    {
        $message = "";

        if (isset($_REQUEST["operation"]) && ($_REQUEST["operation"] == "supprimer"))
        {
            $id = intval(trim($_REQUEST["id"]));  // intval transforme un texte en nombre
            if ($id > 0)
            {
                // ESSAYER D'EFFACER LA LIGNE DANS LA TABLE MYSQL article
                // NE PAS OUBLIER DE FAIRE use
                $objetAdminModel = new AdminModel;
                $objetAdminModel->delete($id);
            }// fin intval
        }// fin if operation = supprimer

        if (isset($_POST["operation"]) && ($_POST["operation"] == "creer"))  //vient du input hidden mais si le questionnaire est vide il sera stoppé par les verif is_string... (et les required de form)
        {

            $login              = $_POST["login"];
            $email              = $_POST["email"];
            $password           = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $role              =  $_POST["role"];// recuperer la values
           
            //array_map('strip_tags', $POST);  //note est-ce nécessaire de nettoyer la partie admin?
             // RECUPERER LES INFOS DU FORMULAIRE
           
            $objetUsersModel = new \W\Model\UsersModel;
            $exist= $objetUsersModel->getUserByUsernameOrEmail($login);
            $exist2= $objetUsersModel->getUserByUsernameOrEmail($email);
            
            if($exist == 0 && $exist2 ==0)
            {          
           
            
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

                    $message = "Vous avez créé l'administrateur " . $login;
                }// fin ifstring
                
                else 
                {
                   $message= "ERREUR : INFO INCORRECTE Attention aux tailles mini"; 
                }

            }
            else
            {
                $message= "Login ou adresse mail déjà utilisé(e)";
                
                // UNE ERREUR transmettre à la partie view (en dessous $this->show)
            }
  
        }// fin if ISSET CREER

         //$this->allowTo([ "super-admin" ]);


        $this->show("pages/admin_creer-admin", ["message" => $message ]);
    } // fin function creer admin

    
    public function home()
    {
        $this->allowTo([ "admin", "super-admin" ]);
    }// fin function home


    public function friteamEquipe()
    {
        $titrePage = "qui-sommes nous ?";
        $this->show("pages/admin_creer-admin", ["message" => $message, "titrePage" => $titrePage ]);
        $this->allowTo([ "admin", "super-admin" ]);
    }// fin function friteam-equipe


    public function formation()
    {
         $this->allowTo([ "admin", "super-admin" ]);
    }// fin function formation


    // LA METHODE ASSOCIEE A LA ROUTE /admin/formation/[:id]
    public function formationDetail()
    {
        // INITIALISE LA VALEUR DE LA VARIABLE 
        $message = "";
        $id = "";

        if (isset($_REQUEST["operation"]) && ($_REQUEST["operation"] == "supprimer"))
        {
            // ON VEUT SUPPRIMER UNE LIGNE
            // ON RECUPERE L'ID DU FORMULAIRE
            // http://php.net/manual/fr/function.intval.php
            $id = intval(trim($_REQUEST["id"]));

            if ($id > 0)
            {
                // ESSAYER D'EFFACER LA LIGNE DANS LA TABLE MYSQL formation
                // NE PAS OUBLIER DE FAIRE use
                $objetFormationModel = new FormationModel;
                $objetFormationModel->delete($id);
            }
        }
        

        if (isset($_POST["operation"]) && ($_POST["operation"] == "creer"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $titre             = trim($_POST["titre_formation"]);
            $presentation      = trim($_POST["presentation_formation"]);
            $chapo             = trim($_POST["chapo_formation"]);
            $objectif          = trim($_POST["objectif_formation"]);
            $public            = trim($_POST["public_formation"]);
            $condition         = trim($_POST["conditions_formation"]);
            $duree             = trim($_POST["duree_formation"]);
            $date              = trim($_POST["date_formation"]);
            $lieu              = trim($_POST["lieu_formation"]);
            $intervenant       = trim($_POST["intervenant_formation"]);
            $programme         = trim($_POST["programme_formation"]);
            $lien              = trim($_POST["lien_catalogue"]);
            $url               = trim($_POST["url"]);
            
            // $id_categorie       = trim($_POST["id_categorie"]);

            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($titre)        && ( mb_strlen($titre) > 0 ) 
                    && is_string($presentation) && ( mb_strlen($presentation) > 0 ) 
                    && is_string($chapo)        && ( mb_strlen($chapo) > 0 ) 
                    && is_string($objectif)     && ( mb_strlen($objectif) > 0 ) 
                    && is_string($public)       && ( mb_strlen($public) > 0 ) 
                    && is_string($condition)    && ( mb_strlen($condition) > 0 ) 
                    && is_string($duree)        && ( mb_strlen($duree) > 0 )
                    && is_string($date)         && ( mb_strlen($date) > 0 ) //attention date
                    && is_string($lieu)         && ( mb_strlen($lieu) > 0 ) // a voir : dans html, le type="date" de la balise <input> doit renvoyer un champs text sur certains navigateur
                    && is_string($intervenant)  && ( mb_strlen($intervenant) > 0 ) 
                    && is_string($programme)    && ( mb_strlen($programme) > 0 ) 
                    && is_string($lien)         && ( mb_strlen($lien) > 0 ) 
                    && is_string($url)          && ( mb_strlen($url) > 0 ) 
                    // && is_numeric($id_categorie) 
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL
                $img = $this->upload();
                
                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $objetFormationModel = new FormationModel;
                // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                $objetFormationModel->insert([
                        "img_formation"         => $img,
                        "titre_formation"       => $titre,
                        "presentation_formation"=> $presentation,
                        "chapo_formation"       => $chapo,
                        "objectif_formation"    => $objectif,
                        "public_formation"      => $public,
                        "conditions_formation"  => $condition,
                        "duree_formation"       => $duree,
                        "date_formation"        => $date,
                        "lieu_formation"        => $lieu,
                        "intervenant_formation" => $intervenant,
                        "programme_formation"   => $programme,
                        "lien_catalogue"        => $lien,
                        "url"                   => $url,
                    ]);
                
                // OK
                $message = "La Fiche Formation à bien été créée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $message = "ERREUR lors de la création";
            }
        }
        
        // AFFICHER LA PAGE
        // JE TRANSMETS LE MESSAGE A LA PARTIE VIEW
        $titrePage = "formation";
        $this->show("pages/admin_formation_detail", [ "message" => $message, "id" => $id, "titrePage" => $titrePage ]);
        $this->allowTo([ "admin", "super-admin" ]);
    }// fin function formation-detail

    public function upload()
    {
        $repertoire = "assets/img/"; //repertoire où le fichier va être stocké
        $fichier = $repertoire . basename($_FILES["img_formation"]["name"]); //chemin du fichier uploadé
        $uploadOk = 1;
        $imageFileType = pathinfo($fichier,PATHINFO_EXTENSION); //récupère l'extension du fichier
        // Verifier que l'image existe dans l'upload
        if(isset($_POST["submit"])) 
        {
            $check = getimagesize($_FILES["img_formation"]["tmp_name"]);
            if($check !== false) 
            {
                $message = "Le fichier uploadé est une image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else 
            {
                $message = "Le fichier uploadé n'est pas une image.";
                $uploadOk = 0;
            }
        }
        // // Verifier si le fichier existe déjà
        // if (file_exists($fichier)) 
        // {
        //     echo "Désolé, le fichier existe déjà.";
        //     $uploadOk = 0;
        // }
        // Verifier la taille de l'image uploadé
        if ($_FILES["img_formation"]["size"] > 500000) 
        {
            $message = "Votre image est trop lourde. Taille maximale autorisée : 500 ko.";
            $uploadOk = 0;
        }
        // Formats acceptés
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
        {
            $message = "Le fichier doit être au format .jpg ou .png ou .jpeg ou .gif";
            $uploadOk = 0;
        }
        // Vérifier si $uploadOk est à 0 à cause d'une erreur
        if ($uploadOk == 0) 
        {
            $message = "Désolé, votre fichier n'a pas pu être chargé.";
            // if everything is ok, try to upload file
        } else 
        {
            if (move_uploaded_file($_FILES["img_formation"]["tmp_name"], $fichier)) 
            {
                $message = "Votre fichier : ". basename( $_FILES["img_formation"]["name"]). " à été enregistré.";
            } else 
            {
                $message = "Désolé, votre fichier : ". basename( $_FILES["img_formation"]["name"]). " n'a pas pu être téléchargé.";
            }
        }

        $this->message = $message;
        return $fichier;
    }

    public function formationUpdate($id)
    {
        $message = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)
        
        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $titre             = trim($_POST["titre_formation"]);
            $presentation      = trim($_POST["presentation_formation"]);
            $chapo             = trim($_POST["chapo_formation"]);
            $objectif          = trim($_POST["objectif_formation"]);
            $public            = trim($_POST["public_formation"]);
            $condition         = trim($_POST["conditions_formation"]);
            $duree             = trim($_POST["duree_formation"]);
            $date              = trim($_POST["date_formation"]);
            $lieu              = trim($_POST["lieu_formation"]);
            $intervenant       = trim($_POST["intervenant_formation"]);
            $programme         = trim($_POST["programme_formation"]);
            $lien              = trim($_POST["lien_catalogue"]);
            $url               = trim($_POST["url"]);
            
            //$id_categorie       = trim($_POST["id_categorie"]);

            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($titre)        && ( mb_strlen($titre) > 0 ) 
                    && is_string($presentation) && ( mb_strlen($presentation) > 0 ) 
                    && is_string($chapo)        && ( mb_strlen($chapo) > 0 ) 
                    && is_string($objectif)     && ( mb_strlen($objectif) > 0 ) 
                    && is_string($public)       && ( mb_strlen($public) > 0 ) 
                    && is_string($condition)    && ( mb_strlen($condition) > 0 ) 
                    && is_string($duree)        && ( mb_strlen($duree) > 0 )
                    && is_string($date)         && ( mb_strlen($date) > 0 ) //attention date
                    && is_string($lieu)         && ( mb_strlen($lieu) > 0 ) // a voir : dans html, le type="date" de la balise <input> doit renvoyer un champs text sur certains navigateur
                    && is_string($intervenant)  && ( mb_strlen($intervenant) > 0 ) 
                    && is_string($programme)    && ( mb_strlen($programme) > 0 ) 
                    && is_string($lien)         && ( mb_strlen($lien) > 0 ) 
                    && is_string($url)          && ( mb_strlen($url) > 0 ) 
                    //&& is_numeric($id_categorie) 
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL
                
                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $img = $this->upload();
                $objetFormationModel = new formationModel;
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetFormationModel->update([
                "img_formation"         => $img,
                "titre_formation"       => $titre,
                "presentation_formation"=> $presentation,
                "chapo_formation"       => $chapo,
                "objectif_formation"    => $objectif,
                "public_formation"      => $public,
                "conditions_formation"  => $condition,
                "duree_formation"       => $duree,
                "date_formation"        => $date,
                "lieu_formation"        => $lieu,
                "intervenant_formation" => $intervenant,
                "programme_formation"   => $programme,
                "lien_catalogue"        => $lien,
                "url"                   => $url,
                ],
                $id);
                
                // OK
                $message = "La fiche à été correctement modifiée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $message = "ERREUR lors de la mise à jour";
            }
        }
        
        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification formation (fiches)";
        $this->show("pages/admin_formation_update", [ "id" => $id, "message" => $message, "message_upload" => $this->message, "titrePage" => $titrePage ]);
        $this->allowTo([ "admin", "super-admin" ]);
    }

    public function accompagnement()
    {
         $this->allowTo([ "admin", "super-admin" ]);
    } // fin function accompagnement


    public function accompagnement_detail()
    {
         $this->allowTo([ "admin", "super-admin" ]);
    }// fin function accompagnement-detail


    public function blog()
    {
         $this->allowTo([ "admin", "super-admin" ]);
    }// fin function blog


    public function blog_detail()
    {
         $this->allowTo([ "admin", "super-admin" ]);
    }// fin function blog-detail

    public function contact()
    {
         $this->allowTo([ "admin", "super-admin" ]);
    } // fin function contact


    public function users()
    {
         $this->allowTo([ "admin", "super-admin" ]);
    } // fin function users


    public function logout()
    {
        $objetAuthentificationModel = new \W\Security\AuthentificationModel;

        $objetAuthentificationModel->logUserOut();
        
        // REDIRIGER VERS LA PAGE DE LOGIN
        $this->redirectToRoute("users_login");
    }// fin function logout

    // methode pour la route
    // /admin/formation/update/[:id]
    // le framework W extrait la partie [:id] de l'url
    // et nous fournit sa valeur dans le paramètre $id

}