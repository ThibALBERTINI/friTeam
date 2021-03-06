<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\AdminModel;
use \Model\FormationModel;
use \Model\ProfilModel;
use \Model\ActualiteModel;
use \Model\AccompagnementModel;
use \Model\HomeModel;
use \Model\VideoModel;
use \Model\PointModel;
use \Model\TemoignageModel;
use \Model\PartenaireModel;
use \Model\MentionModel;
use \Model\CguModel;
use \Model\PhilosophieModel;


class AdminController
        extends Controller
{
    //PROPRIETE
    public $message = "";
    public $messageOK = "";
    public $messageKO = "";
    public $titrePage = "";

    public function creerAdmin ()  // supprimer et modifier compris
    {
        //$this->allowTo([ "super-admin" ]);  // si pas autorisé le fichier config renvoie vers le login
        $message = "";
        $titrePage = "";

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
                    // JE CREE UN OBJET DE LA CLASSE ActualiteModel
                    // NE PAS OUBLIER DE FAIRE use
                    $objetAdminModel = new AdminModel;
                    // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                    $objetAdminModel->insert([
                        "login"         => $login,
                        "email"         => $email,
                        "password"       => $password,
                        "role"     => $role,

                        ]);

                    $message = '<p class="succes"> Vous avez créé l\'administrateur ' . $login . '</p>';
                }// fin ifstring

                else
                {
                   $message= '<p class="erreur"> ERREUR : INFO INCORRECTE Attention aux tailles mini';
                }

            }
            else
            {
                $message= '<p class="erreur"> Login ou adresse mail déjà utilisé(e)';

                // UNE ERREUR transmettre à la partie view (en dessous $this->show)
            }

        }// fin if ISSET CREER

        
        $titrePage = "Créer / Supprimer un Administrateur";
        $this->show("pages/admin_creer-admin", ["message" => $message, "titrePage" => $titrePage ]);
    } // fin function creer admin

    public function modifPass ()
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $message = "";
        $titrePage="";

        if(isset($_POST['btnSub']))
        {
            // RECUPERER LES INFOS
            $connectedAdmin = $this->getUser();
            $login      = trim($connectedAdmin ["login"]);
            $idAdmin      = trim($connectedAdmin ["id"]);
            $passwordOld   = trim($_REQUEST["passwordOld"]);
            $passwordNew   = trim($_REQUEST["passwordNew"]);
            $confirmPasswordNew   = trim($_REQUEST["confirmPasswordNew"]);

            // UN PEU DE SECURITE
                if (is_string($login)            && ( mb_strlen($login) > 4 )
                    && is_string($passwordNew)  && ( mb_strlen($passwordNew) > 4 )
                   )
                {
                    // ON VA VERIFIER SI LES INFOS CORRESPONDENT A UNE LIGNE DANS LA TABLE MYSQL
                    // ON VA UTILISER LA CLASSE \W\Security\AuthentificationModel
                    $objetAuthentificationModel = new \W\Security\AuthentificationModel;
                    // $idUser => 0 SI AUCUNE LIGNE NE CORRESPOND
                    // $idUser => id DE LA LIGNE TROUVEE
                    $idAdmin = $objetAuthentificationModel->isValidLoginInfo($login, $passwordOld);
                    if ($idAdmin > 0)
                    {
                        if($passwordNew==$confirmPasswordNew)
                        {
                            $objetAdminModel=new \Model\AdminModel;
                            $passwordN=password_hash($passwordNew, PASSWORD_DEFAULT);
                            $passChanged=$objetAdminModel->update(array("password"=>$passwordN), $idAdmin);

                            if(!$passChanged)
                            {
                                $message = '<p class="erreur"> Désolé le mot de passe n\'a pas été changé, merci de recommencer la procédure';
                            }
                            else
                            {
                                $message = '<p class="succes"> Votre mot de passe a été mis à jour';
                            }
                        }// fin pasword = confirmpassword
                        else
                        {
                            $message = '<p class="erreur"> Erreur de saisie les mots de passe sont différents';
                        }
                    }// fin if mdp ok
                    else
                    {
                        $message= '<p class="erreur"> Votre mot de passe est incorrect, si vous l\'avez oublié utilisez la procédure "Mot de passe perdu?" (cliquer sur se déconnecter en haut à droite).';
                    }
                } // fin if string login et password
                else
                    {
                     $message= '<p class="erreur"> Les données ne sont pas exploitables merci de les saisir à nouveau';
                    }

        } // fin if isset btnsub
        $titrePage="Modifier son mot de passe";
        $this->show("pages/admin_modif_pass", ["message" => $message, "titrePage"=> $titrePage]);
    } // fin function modifPass

    public function postLogin()  // page affichée aprés s'être loggé
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $this->show("pages/admin_postLogin");
    }// fin function postlogin


    public function home()
    {
        $this->allowTo([ "admin", "super-admin" ]);
        // INITIALISE LA VALEUR DE LA VARIABLE
        $message = "";
        $messageOK = "";
        $messageKO = "";
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
                $objetPartenaireModel = new PartenaireModel;
                $objetPartenaireModel->delete($id);
            }
        }


        if (isset($_POST["operation"]) && ($_POST["operation"] == "creer"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            $lien             = trim($_POST["lien"]);
            $alt           = trim($_POST["alt"]);
            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($lien)        && ( mb_strlen($lien) > 0 )
                 && is_string($alt)        && ( mb_strlen($alt) > 0 )
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;      DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL
                $img = $this->upload();

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $objetPartenaireModel = new PartenaireModel;
                // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                $objetPartenaireModel->insert([
                        "img"        => str_replace("assets/", "", $img),
                        "lien"       => $lien,
                        "alt"       => $alt,

                    ], false);
                // OK
                $messageOK = "Le partenaire à bien été créé";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la création";
            }
        }

        // AFFICHER LA PAGE
        // JE TRANSMETS LE MESSAGE A LA PARTIE VIEW
        $titrePage = "accueil";
        $this->show("pages/admin_home", [ "messageOK" => $messageOK, "messageKO" => $messageKO, "id" => $id, "titrePage" => $titrePage ]);
    }// fin function home

    public function homeVideo($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
                $message = "";
                $messageOK = "";
                $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $titre_friteam        = trim($_POST["titre_friteam"]);
            $contenu_friteam        = trim($_POST["contenu_friteam"]);
            $url_video              = trim($_POST["url_video"]);


            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($contenu_friteam)        && ( mb_strlen($contenu_friteam) > 0 )
                    && is_string($titre_friteam) && ( mb_strlen($titre_friteam) > 0 )
                    && is_string($url_video) && ( mb_strlen($url_video) > 0 )
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $objetVideoModel = new videoModel;
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetVideoModel->update([
                "titre_friteam"       => $titre_friteam,
                "contenu_friteam"       => $contenu_friteam,
                "url_video"             => $url_video,
                ], $id, false);

                // OK
                $messageOK = "Le bandeau FriTeam/Vidéo à été correctement modifiée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification bandeau FriTeam/Vidéo";
        $this->show("pages/admin_home-video", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "titrePage" => $titrePage ]);
        
    }

    public function homeMention($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
                $message = "";
                $messageOK = "";
                $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $contenu_mention        = trim($_POST["contenu_mention"]);


            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($contenu_mention)        && ( mb_strlen($contenu_mention) > 0 )
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $objetMentionModel = new MentionModel;
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetMentionModel->update([
                "contenu_mention"       => $contenu_mention,
                ], $id, false);

                // OK
                $messageOK = "Les mentions légales ont été correctement modifiée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification des mentions légales";
        $this->show("pages/admin_home-mention", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "titrePage" => $titrePage ]);
        
    }

    public function homeCgu($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
                $message = "";
                $messageOK = "";
                $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $contenu_cgu        = trim($_POST["contenu_cgu"]);


            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($contenu_cgu)        && ( mb_strlen($contenu_cgu) > 0 )
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $objetCguModel = new CguModel;
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetCguModel->update([
                "contenu_cgu"       => $contenu_cgu,
                ], $id, false);

                // OK
                $messageOK = "Les CGU ont été correctement modifiée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification des mentions légales";
        $this->show("pages/admin_home-cgu", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "titrePage" => $titrePage ]);
        
    }

    public function philosophie($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
                $message = "";
                $messageOK = "";
                $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $contenu_philosophie        = trim($_POST["contenu_philosophie"]);


            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($contenu_philosophie)        && ( mb_strlen($contenu_philosophie) > 0 )
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $objetPhilosophieModel = new PhilosophieModel;
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetPhilosophieModel->update([
                "contenu_philosophie"       => $contenu_philosophie,
                ], $id, false);

                // OK
                $messageOK = "Le Contenu a été correctement modifiée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = 'modification du contenu de la partie "Notre Philosophie"';
        $this->show("pages/admin_qui-sommes-nous-philosophie", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "titrePage" => $titrePage ]);
        
    }

    public function homePoint($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
                $message = "";
                $messageOK = "";
                $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $titre_point        = trim($_POST["titre_point"]);
            $contenu_point              = trim($_POST["contenu_point"]);

            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($titre_point)        && ( mb_strlen($titre_point) > 0 )
                    && is_string($contenu_point) && ( mb_strlen($contenu_point) > 0 )
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $objetPointModel = new pointModel;
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetPointModel->update([
                "titre_point"       => $titre_point,
                "contenu_point"             => $contenu_point,
                ], $id, false);

                // OK
                $messageOK = "Le bandeau Points Fort à été correctement modifié";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification bandeau Points Fort";
        $this->show("pages/admin_home-point", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "titrePage" => $titrePage ]);
        
    }

    public function homeTemoignage($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
                $message = "";
                $messageOK = "";
                $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $temoignage_temoignage      = trim($_POST["temoignage_temoignage"]);
            $entreprise_temoignage      = trim($_POST["entreprise_temoignage"]);
            $nom_temoignage             = trim($_POST["nom_temoignage"]);
            $alt                        = trim($_POST["alt"]);
            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($temoignage_temoignage)        && ( mb_strlen($temoignage_temoignage) > 0 )
                    && is_string($entreprise_temoignage) && ( mb_strlen($entreprise_temoignage) > 0 )
                    && is_string($nom_temoignage)        && ( mb_strlen($nom_temoignage) > 0 )
                    && is_string($alt)                   && ( mb_strlen($alt) > 0 )
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $img = $this->uploadUpdate();
                $objetTemoignageModel = new temoignageModel;
                $tabUpdate = [
                //"img"                       => str_replace("assets/", "", $img),
                "temoignage_temoignage"     => $temoignage_temoignage,
                "entreprise_temoignage"     => $entreprise_temoignage,
                "nom_temoignage"            => $nom_temoignage,
                "alt"                       => $alt,
                ];
                if ( $img != "" )
                {
                    $tabUpdate["img"] = str_replace("assets/", "", $img);
                }
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetTemoignageModel->update($tabUpdate, $id);

                // OK
                $messageOK = "Le bandeau témoignage à été correctement modifié";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification bandeau témoignage";
        $this->show("pages/admin_home-temoignage", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "titrePage" => $titrePage ]);
    }

    public function homePartenaire($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $message = "";
        $messageOK = "";
        $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $lien      = trim($_POST["lien"]);
            $alt       = trim($_POST["alt"]);
            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($lien)        && ( mb_strlen($lien) > 0 )
                && is_string($alt)        && ( mb_strlen($alt) > 0 )
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $img = $this->uploadUpdate();
                $objetPartenaireModel = new partenaireModel;
                $tabUpdate = [
                //"img"                       => str_replace("assets/", "", $img),
                "lien"     => $lien,
                "alt"     => $alt,
                ];
                if ( $img != "" )
                {
                    $tabUpdate["img"] = str_replace("assets/", "", $img);
                }
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetPartenaireModel->update($tabUpdate, $id);

                // OK
                $messageOK = "Le bandeau Partenaire à été correctement modifié";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification bandeau partenaire";
        $this->show("pages/admin_home-partenaire", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "titrePage" => $titrePage ]);
        
    }

    public function friteamEquipe()
    {
        $this->allowTo([ "admin", "super-admin" ]);
         // INITIALISE LA VALEUR DE LA VARIABLE
        $message = "";
        $messageOK = "";
        $messageKO = "";
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
                $objetProfilModel = new ProfilModel;
                $objetProfilModel->delete($id);
            }
        }


        if (isset($_POST["operation"]) && ($_POST["operation"] == "creer"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img"]);
            $nom                = trim($_POST["nom_profil"]);
            $prenom             = trim($_POST["prenom_profil"]);
            $ordre             = trim($_POST["ordre_apparition"]);
            $citation           = trim($_POST["citation_profil"]);
            $competence         = trim($_POST["competence_profil"]);
            $interets           = trim($_POST["interets_profil"]);
            $intervention       = trim($_POST["domaines_inter"]);
            $motivation         = trim($_POST["motivation_profil"]);
            $vision             = trim($_POST["vision_profil"]);
            $entreprise         = trim($_POST["entreprise_profil"]);
            $linkedin           = trim($_POST["linkedin"]);
            $twitter           = trim($_POST["twitter"]);
            $instagram           = trim($_POST["instagram"]);
            $alt                = trim($_POST["alt"]);


            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($nom)        && ( mb_strlen($nom) > 0 )
                    && is_string($prenom) && ( mb_strlen($prenom) > 0 )
                    && is_string($citation)        && ( mb_strlen($citation) > 0 )
                    && is_string($competence)     && ( mb_strlen($competence) > 0 )
                    && is_string($interets)       && ( mb_strlen($interets) > 0 )
                    && is_string($intervention)    && ( mb_strlen($intervention) > 0 )
                    && is_string($motivation)        && ( mb_strlen($motivation) > 0 )
                    && is_string($vision)         && ( mb_strlen($vision) > 0 )
                    && is_string($entreprise)         && ( mb_strlen($entreprise) > 0 )
                    && is_string($linkedin)  && ( mb_strlen($linkedin) > 0 )
                    && is_string($twitter)  && ( mb_strlen($twitter) > 0 )
                    && is_string($instagram)  && ( mb_strlen($instagram) > 0 )
                    && is_string($alt)  && ( mb_strlen($alt) > 0 )
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
                $objetProfilModel = new ProfilModel;
                // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                $objetProfilModel->insert([
                        "img"                   => str_replace("assets/", "", $img),
                        "nom_profil"            => $nom,
                        "prenom_profil"         => $prenom,
                        "ordre_apparition"      => $ordre,
                        "citation_profil"       => $citation,
                        "competence_profil"     => $competence,
                        "interets_profil"       => $interets,
                        "domaines_inter"        => $intervention,
                        "motivation_profil"     => $motivation,
                        "vision_profil"         => $vision,
                        "entreprise_profil"     => $entreprise,
                        "linkedin"              => $linkedin,
                        "twitter"              => $twitter,
                        "instagram"              => $instagram,
                        "alt"                   => $alt,
                    ]);

                // OK
                $messageOK = "La Fiche Profil à bien été créée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la création";
            }
        }

        // AFFICHER LA PAGE
        // JE TRANSMETS LE MESSAGE A LA PARTIE VIEW
        $titrePage = "qui-sommes nous ?";
        $this->show("pages/admin_friteam-equipe", [ "messageOK" => $messageOK, "messageKO" => $messageKO, "id" => $id, "titrePage" => $titrePage ]);
        
    }// fin function friteam-equipe

    // LA METHODE ASSOCIEE A LA ROUTE /admin/formation/[:id]
    public function formationDetail()
    {
        $this->allowTo([ "admin", "super-admin" ]);
        // INITIALISE LA VALEUR DE LA VARIABLE
        $message = "";
        $messageOK = "";
        $messageKO = "";
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
            $categorie         = trim($_POST["categorie_formation"]);
            $chapo             = trim($_POST["chapo_formation"]);
            $objectif          = trim($_POST["objectif_formation"]);
            $public            = trim($_POST["public_formation"]);
            $condition         = trim($_POST["conditions_formation"]);
            $duree             = trim($_POST["duree_formation"]);
            $date              = trim($_POST["date_formation"]);
            $lieu              = trim($_POST["lieu_formation"]);
            $intervenant       = trim($_POST["intervenant_formation"]);
            $programme         = trim($_POST["programme_formation"]);
            // $lien              = trim($_POST["lien_catalogue"]);
            $url               = trim($_POST["url"]);
            $alt               = trim($_POST["alt"]);
            $prix               = trim($_POST["prix"]);

            $url = $this->suppr_accents($url);
            $url = str_replace( " ", "-", $url);
            $url = preg_replace( "/[^a-zA-Z0-9]/", "-", $url);

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
                    //&& is_string($lien_catalogue)         && ( mb_strlen($lien_catalogue) > 0 )
                    && is_string($url)          && ( mb_strlen($url) > 0 )
                    && is_string($alt)          && ( mb_strlen($alt) > 0 )
                    && is_string($prix)          && ( mb_strlen($prix) > 0 )
                    // && is_numeric($id_categorie)
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL
                $img = $this->upload();
                $lien_catalogue = $this->uploadPdf();

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $objetFormationModel = new FormationModel;
                // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                $objetFormationModel->insert([
                        "img"                   => str_replace("assets/", "", $img),
                        "titre_formation"       => $titre,
                        "presentation_formation"=> $presentation,
                        "categorie_formation"   => $categorie,
                        "chapo_formation"       => $chapo,
                        "objectif_formation"    => $objectif,
                        "public_formation"      => $public,
                        "conditions_formation"  => $condition,
                        "duree_formation"       => $duree,
                        "date_formation"        => $date,
                        "lieu_formation"        => $lieu,
                        "intervenant_formation" => $intervenant,
                        "programme_formation"   => $programme,
                        "lien_catalogue"        => str_replace("assets/", "", $lien_catalogue),
                        "url"                   => $url,
                        "alt"                   => $alt,
                        "prix"                   => $prix,
                    ], false);
                // OK
                $messageOK = "La Fiche Formation à bien été créée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la création";
            }
        }

        // AFFICHER LA PAGE
        // JE TRANSMETS LE MESSAGE A LA PARTIE VIEW
        $titrePage = "formation";
        $this->show("pages/admin_formation_detail", [ "messageOK" => $messageOK, "messageKO" => $messageKO, "id" => $id, "titrePage" => $titrePage ]);
        
    }// fin function formationDetail

    public function uploadUpdate()
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $repertoire = "assets/img/"; //repertoire où le fichier va être stocké
        $fichier = "";
        $uploadOk = 1;
        // Verifier que l'image existe dans l'upload
        if(isset($_POST["submit"]))
        {
            if(isset($_FILES["img"]) && $_FILES["img"]["size"] > 0)
            {
                $check = getimagesize($_FILES["img"]["tmp_name"]);
                if($check !== false)
                {
                    $fichier = $repertoire . basename($_FILES["img"]["name"]); //chemin du fichier uploadé
                    $message = "Le fichier uploadé est une image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else
                {
                    $message = "Le fichier uploadé n'est pas une image.";
                    $uploadOk = 0;
                }
                // // Verifier si le fichier existe déjà
                // if (file_exists($fichier))
                // {
                //     echo "Désolé, le fichier existe déjà.";
                //     $uploadOk = 0;
                // }
                // Verifier la taille de l'image uploadé
                if ($_FILES["img"]["size"] > 500000000)
                {
                    $message = "Votre image est trop lourde. Taille maximale autorisée : 500 ko.";
                    $uploadOk = 0;
                }
                $imageFileType = pathinfo($fichier,PATHINFO_EXTENSION); //récupère l'extension du fichier
                // Formats acceptés
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
                {
                    $message = "Le fichier doit être au format .jpg ou .png ou .jpeg ou .gif";
                    $uploadOk = 0;
                }
            }
        }
        // Vérifier si $uploadOk est à 0 à cause d'une erreur
        if ($uploadOk == 0)
        {
            $message = "Désolé, votre fichier n'a pas pu être chargé.";
            // if everything is ok, try to upload file
        } else
        {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $fichier))
            {
                $message = "Votre fichier : ". basename( $_FILES["img"]["name"]). " à été enregistré.";
            } else
            {
                $message = "Désolé, votre fichier : ". basename( $_FILES["img"]["name"]). " n'a pas pu être téléchargé.";
            }
        }

        $this->message = $message;
        //echo $fichier;
        return $fichier;
    }

    public function upload()
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $repertoire = "assets/img/"; //repertoire où le fichier va être stocké
        $fichier = $repertoire . basename($_FILES["img"]["name"]); //chemin du fichier uploadé
        $uploadOk = 1;
        $imageFileType = pathinfo($fichier,PATHINFO_EXTENSION); //récupère l'extension du fichier
        // Verifier que l'image existe dans l'upload
        if(isset($_POST["submit"]))
        {
            $check = getimagesize($_FILES["img"]["tmp_name"]);
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
        if ($_FILES["img"]["size"] > 500000000)
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
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $fichier))
            {
                $message = "Votre fichier : ". basename( $_FILES["img"]["name"]). " à été enregistré.";
            } else
            {
                $message = "Désolé, votre fichier : ". basename( $_FILES["img"]["name"]). " n'a pas pu être téléchargé.";
            }
        }

        $this->message = $message;
        return $fichier;
    }
// ********************************************************************************************************************

    public function uploadUpdatePdf()
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $repertoire = "assets/pdf/"; //repertoire où le fichier va être stocké
        $fichier = "";
        $uploadOk = 1;
        // Verifier que l'image existe dans l'upload
        if(isset($_POST["submit"]))
        {
            if(isset($_FILES["lien_catalogue"]) && $_FILES["lien_catalogue"]["size"] > 0)
            {
                $check = filesize($_FILES["lien_catalogue"]["tmp_name"]);
                if($check !== false)
                {
                    $fichier = $repertoire . basename($_FILES["lien_catalogue"]["name"]); //chemin du fichier uploadé
                    $message = "Le fichier uploadé est un pdf - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else
                {
                    $message = "Le fichier uploadé n'est pas un pdf.";
                    $uploadOk = 0;
                }
                // // Verifier si le fichier existe déjà
                // if (file_exists($fichier))
                // {
                //     echo "Désolé, le fichier existe déjà.";
                //     $uploadOk = 0;
                // }
                // Verifier la taille de l'image uploadé
                if ($_FILES["lien_catalogue"]["size"] > 5000000)
                {
                    $message = "Votre pdf est trop lourd. Taille maximale autorisée : 5 Mo.";
                    $uploadOk = 0;
                }
                $fileType = pathinfo($fichier,PATHINFO_EXTENSION); //récupère l'extension du fichier
                // Formats acceptés
                if($fileType != "pdf" )
                {
                    $message = "Le fichier doit être au format .pdf";
                    $uploadOk = 0;
                }
            }
        }
        // Vérifier si $uploadOk est à 0 à cause d'une erreur
        if ($uploadOk == 0)
        {
            $message = "Désolé, votre fichier n'a pas pu être chargé.";
            // if everything is ok, try to upload file
        } else
        {
            if (move_uploaded_file($_FILES["lien_catalogue"]["tmp_name"], $fichier))
            {
                $message = "Votre fichier : ". basename( $_FILES["lien_catalogue"]["name"]). " à été enregistré.";
            } else
            {
                $message = "Désolé, votre fichier : ". basename( $_FILES["lien_catalogue"]["name"]). " n'a pas pu être téléchargé.";
            }
        }

        $this->message = $message;
        //echo $fichier;
        return $fichier;
    }

    public function uploadPdf()
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $repertoire = "assets/pdf/"; //repertoire où le fichier va être stocké
        $fichier = $repertoire . basename($_FILES["lien_catalogue"]["name"]); //chemin du fichier uploadé
        $uploadOk = 1;
        $fileType = pathinfo($fichier,PATHINFO_EXTENSION); //récupère l'extension du fichier
        // Verifier que l'image existe dans l'upload
        if(isset($_POST["submit"]))
        {
            $check = filesize($_FILES["lien_catalogue"]["tmp_name"]);
            if($check !== false)
            {
                $message = "Le fichier uploadé est un pdf - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else
            {
                $message = "Le fichier uploadé n'est pas un pdf.";
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
        if ($_FILES["lien_catalogue"]["size"] > 5000000)
        {
            $message = "Votre fichier est trop lourd. Taille maximale autorisée : 5 Mo.";
            $uploadOk = 0;
        }
        // Formats acceptés
        if($fileType != "pdf")
        {
            $message = "Le fichier doit être au format .pdf";
            $uploadOk = 0;
        }
        // Vérifier si $uploadOk est à 0 à cause d'une erreur
        if ($uploadOk == 0)
        {
            $message = "Désolé, votre fichier n'a pas pu être chargé.";
            // if everything is ok, try to upload file
        } else
        {
            if (move_uploaded_file($_FILES["lien_catalogue"]["tmp_name"], $fichier))
            {
                $message = "Votre fichier : ". basename( $_FILES["lien_catalogue"]["name"]). " à été enregistré.";
            } else
            {
                $message = "Désolé, votre fichier : ". basename( $_FILES["lien_catalogue"]["name"]). " n'a pas pu être téléchargé.";
            }
        }

        $this->message = $message;
        return $fichier;
    }

// ********************************************************************************************************************
    public function suppr_accents($str, $encoding='utf-8')
    {
        // transformer les caractères accentués en entités HTML
        $str = htmlentities($str, ENT_NOQUOTES, $encoding);
     
        // remplacer les entités HTML pour avoir juste le premier caractères non accentués
        // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "Ã " => "a" ...
        $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
     
        // Remplacer les ligatures tel que : Œ, Æ ...
        // Exemple "Å“" => "oe"
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        // Supprimer tout le reste
        $str = preg_replace('#&[^;]+;#', '', $str);
     
        return $str;
    }

    public function formationUpdate($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $messageOK = "";
        $messageKO = "";
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
            $categorie         = trim($_POST["categorie_formation"]);
            $chapo             = trim($_POST["chapo_formation"]);
            $objectif          = trim($_POST["objectif_formation"]);
            $public            = trim($_POST["public_formation"]);
            $condition         = trim($_POST["conditions_formation"]);
            $duree             = trim($_POST["duree_formation"]);
            $date              = trim($_POST["date_formation"]);
            $lieu              = trim($_POST["lieu_formation"]);
            $intervenant       = trim($_POST["intervenant_formation"]);
            $programme         = trim($_POST["programme_formation"]);
            //$lien              = trim($_POST["lien_catalogue"]);
            $url               = trim($_POST["url"]);
            $alt               = trim($_POST["alt"]);
            $prix               = trim($_POST["prix"]);

            $url = $this->suppr_accents($url);
            $url = str_replace( " ", "-", $url);
            $url = preg_replace( "/[^a-zA-Z0-9]/", "-", $url);
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
                    //&& is_string($lien)         && ( mb_strlen($lien) > 0 )
                    && is_string($url)          && ( mb_strlen($url) > 0 )
                    && is_string($alt)          && ( mb_strlen($alt) > 0 )
                    && is_string($prix)          && ( mb_strlen($prix) > 0 )
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
                $img = $this->uploadUpdate();
                $lien_catalogue = $this->uploadUpdatePdf();
                $objetFormationModel = new formationModel;
                $tabUpdate = [
                "titre_formation"       => $titre,
                "categorie_formation"   => $categorie,
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
                //"lien_catalogue"        => $lien_catalogue,
                "url"                   => $url,
                "alt"                   => $alt,
                "prix"                  => $prix,
                ];

                if ($img != "")
                {
                    $tabUpdate["img"] = str_replace("assets/", "", $img);
                }

                if ($lien_catalogue != "")
                {
                    $tabUpdate["lien_catalogue"] = str_replace("assets/", "", $lien_catalogue);
                }
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetFormationModel->update($tabUpdate, $id, false);

                // OK
                $messageOK = "La fiche à été correctement modifiée";

            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification formation (fiches)";
        $this->show("pages/admin_formation_update", [ "id" => $id, "messageKO" => $messageKO, "messageOK" => $messageOK, "titrePage" => $titrePage ]);
       
    } // fin function formationUpdate($id)


    public function friteamEquipeUpdate($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $message = "";
        $messageOK = "";
        $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img"]);
            $nom                = trim($_POST["nom_profil"]);
            $prenom             = trim($_POST["prenom_profil"]);
            $ordre             = trim($_POST["ordre_apparition"]);
            $citation           = trim($_POST["citation_profil"]);
            $competence         = trim($_POST["competence_profil"]);
            $interets           = trim($_POST["interets_profil"]);
            $intervention       = trim($_POST["domaines_inter"]);
            $motivation         = trim($_POST["motivation_profil"]);
            $vision             = trim($_POST["vision_profil"]);
            $entreprise         = trim($_POST["entreprise_profil"]);
            $linkedin           = trim($_POST["linkedin"]);
            $twitter           = trim($_POST["twitter"]);
            $instagram           = trim($_POST["instagram"]);
            $alt                = trim($_POST["alt"]);


            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($nom)        && ( mb_strlen($nom) > 0 )
                    && is_string($prenom)       && ( mb_strlen($prenom) > 0 )
                    && is_string($citation)     && ( mb_strlen($citation) > 0 )
                    && is_string($competence)   && ( mb_strlen($competence) > 0 )
                    && is_string($interets)     && ( mb_strlen($interets) > 0 )
                    && is_string($intervention) && ( mb_strlen($intervention) > 0 )
                    && is_string($motivation)   && ( mb_strlen($motivation) > 0 )
                    && is_string($vision)       && ( mb_strlen($vision) > 0 )
                    && is_string($entreprise)   && ( mb_strlen($entreprise) > 0 )
                    && is_string($linkedin)     && ( mb_strlen($linkedin) > 0 )
                    && is_string($twitter)     && ( mb_strlen($twitter) > 0 )
                    && is_string($instagram)     && ( mb_strlen($instagram) > 0 )
                    && is_string($alt)     && ( mb_strlen($alt) > 0 )
                    //&& is_numeric($id_categorie)
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE ProfilModel
                // NE PAS OUBLIER DE FAIRE use
                $img = $this->uploadUpdate();
                $objetProfilModel = new profilModel;
                $tabUpdate = [
                        "nom_profil"            => $nom,
                        "prenom_profil"         => $prenom,
                        "ordre_apparition"      => $ordre,
                        "citation_profil"       => $citation,
                        "competence_profil"     => $competence,
                        "interets_profil"       => $interets,
                        "domaines_inter"        => $intervention,
                        "motivation_profil"     => $motivation,
                        "vision_profil"         => $vision,
                        "entreprise_profil"     => $entreprise,
                        "linkedin"              => $linkedin,
                        "twitter"              => $twitter,
                        "instagram"              => $instagram,
                        "alt"                   => $alt,
                ];

                if ( $img != "" )
                {
                    $tabUpdate["img"] = $img; //
                }
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetProfilModel->update($tabUpdate, $id);

                // OK
                $messageOK = "La fiche à été correctement modifiée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour, tous les champs doivent être renseignés";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification profil (fiches)";
        $this->show("pages/admin_friteam-equipe-update", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "message_upload" => $this->message, "titrePage" => $titrePage ]);
       
    } // fin function friteamEquipeUpdate($id)


    public function accompagnement($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $message = "";
        $messageOK = "";
        $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $titre         = trim($_POST["titre_acc"]);
            $citation      = trim($_POST["citation_acc"]);
            $resume        = trim($_POST["resume_acc"]);
            $presentation  = trim($_POST["presentation_acc"]);
            $formateur     = trim($_POST["formateur_acc"]);
            $utilite       = trim($_POST["utilite_acc"]);
            $url           = trim($_POST["url"]);
            $alt           = trim($_POST["alt"]);

            $url = $this->suppr_accents($url);
            $url = str_replace( " ", "-", $url);
            $url = preg_replace( "/[^a-zA-Z0-9]/", "-", $url);            

            //$id_categorie       = trim($_POST["id_categorie"]);

            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
          if    (is_string($titre)        && ( mb_strlen($titre) > 0 )
                    && is_string($citation) && ( mb_strlen($citation) > 0 )
                    && is_string($resume)        && ( mb_strlen($resume) > 0 )
                    && is_string($presentation)     && ( mb_strlen($presentation) > 0 )
                    && is_string($formateur)       && ( mb_strlen($formateur) > 0 )
                    && is_string($utilite)    && ( mb_strlen($utilite) > 0 )
                    && is_string($url)          && ( mb_strlen($url) > 0 )
                    && is_string($alt)          && ( mb_strlen($alt) > 0 )
                    // && is_numeric($id_categorie)
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                // $id_auteur      = 1;     // DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $img = $this->uploadUpdate();
                $objetAccompagnementModel = new AccompagnementModel;
                $tabUpdate = [
                        //"img"               => str_replace("assets/", "", $img),
                        "titre_acc"         => $titre,
                        "alt"               => $alt,
                        "citation_acc"      => $citation,
                        "resume_acc"        => $resume,
                        "presentation_acc"  => $presentation,
                        "formateur_acc"     => $formateur,
                        "utilite_acc"       => $utilite,
                        "url"               => $url,
                ];
                if ($img != "")
                {
                    $tabUpdate["img"] = str_replace("assets/", "", $img);
                }
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetAccompagnementModel->update($tabUpdate, $id, false);

                // OK
                $messageOK = "La fiche accompagnement à été correctement modifiée";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification accompagnement (fiches)";
        $this->show("pages/admin_accompagnement", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "titrePage" => $titrePage ]);
        
    } // fin function accompagnement


    public function accompagnementDetail()
    {
        $this->allowTo([ "admin", "super-admin" ]);
                // INITIALISE LA VALEUR DE LA VARIABLE
        $message = "";
        $messageOK = "";
        $messageKO = "";
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
                $objetAccompagnementModel = new AccompagnementModel;
                $objetAccompagnementModel->delete($id);
            }
        }


        if (isset($_POST["operation"]) && ($_POST["operation"] == "creer"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            $titre         = trim($_POST["titre_acc"]);
            $citation      = trim($_POST["citation_acc"]);
            $resume        = trim($_POST["resume_acc"]);
            $presentation  = trim($_POST["presentation_acc"]);
            $formateur     = trim($_POST["formateur_acc"]);
            $utilite       = trim($_POST["utilite_acc"]);
            $url           = trim($_POST["url"]);
            $alt           = trim($_POST["alt"]);

            $url = $this->suppr_accents($url);
            $url = str_replace( " ", "-", $url);
            $url = preg_replace( "/[^a-zA-Z0-9]/", "-", $url);            

            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
          if    (is_string($titre)        && ( mb_strlen($titre) > 0 )
                    && is_string($citation) && ( mb_strlen($citation) > 0 )
                    && is_string($resume)        && ( mb_strlen($resume) > 0 )
                    && is_string($presentation)     && ( mb_strlen($presentation) > 0 )
                    && is_string($formateur)       && ( mb_strlen($formateur) > 0 )
                    && is_string($utilite)    && ( mb_strlen($utilite) > 0 )
                    && is_string($url)          && ( mb_strlen($url) > 0 )
                    && is_string($alt)          && ( mb_strlen($alt) > 0 )
                    // && is_numeric($id_categorie)
                )
            {
                // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES

                //$id_auteur      = 1;      DEBUG
                //$dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL
                $img = $this->upload();

                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL formation
                // JE CREE UN OBJET DE LA CLASSE FormationModel
                // NE PAS OUBLIER DE FAIRE use
                $objetAccompagnementModel = new AccompagnementModel;
                // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                $objetAccompagnementModel->insert([
                        "img"               => str_replace("assets/", "", $img),
                        "titre_acc"         => $titre,
                        "citation_acc"      => $citation,
                        "resume_acc"        => $resume,
                        "presentation_acc"  => $presentation,
                        "formateur_acc"     => $formateur,
                        "utilite_acc"       => $utilite,
                        "url"               => $url,
                        "alt"               => $alt,
                    ], false);

                // OK
                $messageOK = "La Fiche Accompagnement à bien été créée";
           }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la création";
            }
        }

        // AFFICHER LA PAGE
        // JE TRANSMETS LE MESSAGE A LA PARTIE VIEW
        $titrePage = "accompagnement";
        $this->show("pages/admin_accompagnement-detail", [ "messageOK" => $messageOK, "messageKO" => $messageKO, "id" => $id, "titrePage" => $titrePage ]);
      
    }// fin function accompagnement-detail


    public function blog($id)
    {
        $this->allowTo([ "admin", "super-admin" ]);
        $message = "";
        $messageOK = "";
        $messageKO = "";
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE

                // JE PEUX TRAITER LE FORMULAIRE
        // (SI IL Y A UN FORMULAIRE A TRAITER)

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            // http://php.net/manual/en/function.trim.php
            //$img               = trim($_POST["img_formation"]);
            $titre              = trim($_POST["titre_actualite"]);
            $chapo              = trim($_POST["chapo_actualite"]);
            $contenu            = trim($_POST["contenu_actualite"]);
            $auteur             = trim($_POST["auteur_actualite"]);
            $url                = trim($_POST["url"]);
            $alt                = trim($_POST["alt"]);

            $url = $this->suppr_accents($url);
            $url = str_replace( " ", "-", $url);
            $url = preg_replace( "/[^a-zA-Z0-9]/", "-", $url);

            //$id_categorie       = trim($_POST["id_categorie"]);

            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($titre)           && ( mb_strlen($titre) > 0 )
                    && is_string($chapo)    && ( mb_strlen($chapo) > 0 )
                    && is_string($contenu)  && ( mb_strlen($contenu) > 0 )
                    && is_string($auteur)   && ( mb_strlen($auteur) > 0 )
                    && is_string($url)      && ( mb_strlen($url) > 0 )
                    && is_string($alt)      && ( mb_strlen($alt) > 0 )
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
                $objetActualiteModel = new ActualiteModel;
                // JE PEUX UTILISER LA METHODE update DE LA CLASSE \W\Model\Model
                $objetActualiteModel->update([
                    "img"                   => $img,
                    "titre_actualite"       => $titre,
                    "chapo_actualite"       => $chapo,
                    "contenu_actualite"     => $contenu,
                    "auteur_actualite"      => $auteur,
                    "url"                   => $url,
                    "alt"                   => $alt,
                ],
                $id);

                // OK
                $messageOK = "L'article' à été correctement modifié";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la mise à jour";
            }
        }

        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UNE FORMATION
        $titrePage = "modification d'un article";
        $this->show("pages/admin_blog", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO, "titrePage" => $titrePage ]);
      
    }// fin function blog


    public function blogDetail()
    {
        $this->allowTo([ "admin", "super-admin" ]);
                // INITIALISE LA VALEUR DE LA VARIABLE
        $message = "";
        $id = "";
        $messageOK = "";
        $messageKO = "";

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
                $objetActualiteModel = new ActualiteModel;
                $objetActualiteModel->delete($id);
            }
        }


        if (isset($_POST["operation"]) && ($_POST["operation"] == "creer"))
        {
            // RECUPERER LES INFOS DU FORMULAIRE
            $titre              = trim($_POST["titre_actualite"]);
            $chapo              = trim($_POST["chapo_actualite"]);
            $contenu            = trim($_POST["contenu_actualite"]);
            $auteur             = trim($_POST["auteur_actualite"]);
            $url                = trim($_POST["url"]);
            $alt                = trim($_POST["alt"]);

            $url = $this->suppr_accents($url);
            $url = str_replace( " ", "-", $url);
            $url = preg_replace( "/[^a-zA-Z0-9]/", "-", $url);            

            // $id_categorie       = trim($_POST["id_categorie"]);

            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($titre)        && ( mb_strlen($titre) > 0 )
                    && is_string($chapo) && ( mb_strlen($chapo) > 0 )
                    && is_string($contenu)        && ( mb_strlen($contenu) > 0 )
                    && is_string($auteur)     && ( mb_strlen($auteur) > 0 )
                    && is_string($url)       && ( mb_strlen($url) > 0 )
                    && is_string($alt)       && ( mb_strlen($alt) > 0 )
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
                $objetActualiteModel = new ActualiteModel;
                // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                $objetActualiteModel->insert([
                        "img"                   => $img,
                        "titre_actualite"       => $titre,
                        "chapo_actualite"       => $chapo,
                        "contenu_actualite"     => $contenu,
                        "auteur_actualite"      => $auteur,
                        "url"                   => $url,
                        "alt"                   => $alt,
                    ]);

                // OK
                $messageOK = "L'article à bien été créé";
            }
            else
            {
                // KO
                // UNE ERREUR
                $messageKO = "ERREUR lors de la création";
            }
        }

        // AFFICHER LA PAGE
        // JE TRANSMETS LE MESSAGE A LA PARTIE VIEW
        $titrePage = "Actualité";
        $this->show("pages/admin_blog-detail", [ "messageOK" => $messageOK, "messageKO" => $messageKO, "id" => $id, "titrePage" => $titrePage ]);
      
    }// fin function blogDetail

    
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
