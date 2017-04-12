<?php

namespace Controller;

use \W\Controller\Controller;

class UsersController 
        extends Controller
{
                    //  !!!  le logout se trouve dans adminController

public function login ()
    {
        // TRAITEMENT DU FORMULAIRE DE LOGIN
        $message = "";
        
        // TRAITER LE FORMULAIRE DE LOGIN
        if (isset($_REQUEST["operation"]) && ($_REQUEST["operation"] == "login"))
        {
            // RECUPERER LES INFOS
            $login      = trim($_REQUEST["login"]);
            $password   = trim($_REQUEST["password"]);
            // UN PEU DE SECURITE
            if (is_string($login)            && ( mb_strlen($login) > 4 )
                    && is_string($password)  && ( mb_strlen($password) > 4 ) 
               )
            {
                // ON VA VERIFIER SI LES INFOS CORRESPONDENT A UNE LIGNE DANS LA TABLE MYSQL
                // ON VA UTILISER LA CLASSE \W\Security\AuthentificationModel
                $objetAuthentificationModel = new \W\Security\AuthentificationModel;
                // $idUser => 0 SI AUCUNE LIGNE NE CORRESPOND
                // $idUser => id DE LA LIGNE TROUVEE 
                $idAdmin = $objetAuthentificationModel->isValidLoginInfo($login, $password);
                if ($idAdmin > 0)
                {
                    // OK
                    $message = "BIENVENUE $idUser";
                    
                    $objetAdminModel = new \W\Model\AdminModel;
                    // ON RECUPERE TOUTE LA LIGNE SUR L'UTILISATEUR
                    $tabAdmin = $objetAdminModel->find($idAdmin);
                    // JE VAIS MEMORISER CES INFOS DANS UNE SESSION
                    $objetAuthentificationModel->logUserIn($tabAdmin);
                    
                    // ON PEUT FAIRE UNE REDIRECTION VERS UNE PAGE PROTEGEE
                    // ...
                }
                else
                {
                    // KO
                    $message = "IDENTIFIANTS INCORRECTS";
                }
            }
            else
            {
                $message = "INFO INCORRECTE";
            }
        }
        
        // VIEW
        $this->show("pages/users_login", [ "message" => $message ]);
    } // fin function login

  
  public function loosePass ()
  {
    $message = "";
    
  if(isset($_POST['btnSub']))
    {
    if(isset($_POST['usernameOrEmail'])) 
        {
        //sécurisation de la valeur
        $usernameOrEmail = trim(strip_tags($_POST['usernameOrEmail']));
       

        getUserByUsernameOrEmail($usernameOrEmail); //cf adminModel

        //var_dump($idClient);
        if($id !== false)
        {
            //génération du token
            $token = md5($email); //génération d'une chaine cryptée en MD5()
            //echo $token;
            //envoi du mail
                include "public/assets/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer(); //création d'un objet de type mail
            $mail->isSMTP(); //connexion directe au serveur SMTP
            $mail->isHTML(true); //utilisation du format HTML pour le message
            $mail->Host = "smtp.gmail.com"; //le serveur SMTP pour envoyer
            $mail->Port = 465; //le port obligatoire de google
            $mail->SMTPAuth = true; //on va fournir un login/password au serveur
            $mail->SMTPSecure = 'ssl'; //certificat SSL
            $mail->Username = 'wf3marseille@gmail.com';
            $mail->Password = 'Azerty1234';
            $mail->setFrom('wf3marseille@gmail.com'); //l'expéditeur
            $mail->addAddress($email); //l'adresse mail de celui qui a perdu son mdp
            $mail->Subject = "Friteam - mot de passe perdu"; //objet du mail
            $link = '<a href="http://localhost/friTeam/public/users/newPass?token='.$token.'">Reinitialiser mon mot de passe</a>'; //le lien à cliquer dans le mail
            $mail->Body = '<html>
                                         <head>
                                         <style> h1{color: green;} </style>
                                         </head>
                                         <body>
                                         <h1>Mot de passe perdu</h1>
                                         <p>Vous avez signalé votre mot de passe comme perdu...</p>
                                         '.$link.'
                                         </body>
                                         </html>';
            if(!$mail->send()) //si problème pendant l'envoi
            {
                $message = 'erreur envoi '.$mail->ErrorInfo;
            }
            else
            {   
                //mise à jour table clients pour l'étape de réinitialisation
                $rqToken = "UPDATE clients
                                        SET token = ?
                                        WHERE id = ?";
                $stmtToken = $bdd->prepare($rqToken);
                $paramToken = array($token, $id);
                $stmtToken->execute($paramToken);
                echo 'Vérifiez votre boite mail...';    
            }
        } // fin si id =ok
        else
        {
          $message = "Identifiant non reconnu";
        }
        
        }//fin ifisset mail ou login
        else
        {
        $message = "Vous devez renseigner au moins un identifiant";
        }
    } // fin if(isset submit
    
    $this->show("pages/users_loosePass", [ "message" => $message ]);
    
  } // fin loosePass



public function newPass()
{
    $message = "";
    $token = strip_tags($_GET['token']);


//recherche de l'idClient correspondant au token
    $rqClient = "SELECT id
                FROM admin
                WHERE token = ?";
$stmtClient = $dbh->prepare($rqClient);
$params = array($token);
$stmtClient->execute($params);
$idAdmin = $stmtClient->fetchColumn();
//si le client n'est pas absent de la table
if($idAdmin !== false)
{
  //requete de mise à jour
    $rqMaj = "UPDATE clients
                        SET password = :password, token = NULL
                        WHERE idClient = :idClient";
    $stmtMaj = $bdd->prepare($rqMaj);
    $params = array(':idClient' => $safe['idClient'],
                                    ':password' => password_hash($safe['password'], PASSWORD_DEFAULT));
    $resultat = $stmtMaj->execute($params);
    //joli message pour dire que c'est OK
    if($resultat !== false)
    {
        $message = '<p>Votre mot de passe a été mis à jour</p>';
    }
    else 
    {
            $message = "erreur technique... Merci de recommencer l'étape de modification du mot de passe";
    }

} // fin if$idAdmin
else
{
    $message = "vous n'avez pas été identifié, merci de recommencer l'étape de modification du mot de passe";
}
$this->show("pages/users_newPass", [ "message" => $message ]);
}//fin function newPass



/*  FONCTIONS A MODIFIER POUR ADMIN
public function articlesUpdate ($id)
    {
        // CONTROLLER
        // ICI IL FAUDRA TRAITER LE FORMULAIRE DE UPDATE
        $this->allowTo([ "admin", "super-admin" ]); // on ne permet d'accéder à cette function qu'à l'administrateur et au super-adminastrateur
        $message = "";

        if (isset($_POST["operation"]) && ($_POST["operation"] == "modifier"))  //vient du input hidden mais si le questionnaire est vide il sera stoppé par les verif is_string... (et les required de form)
        {
            
            $titre              = $_POST["titre"];
            $chapo              = $_POST["chapo"];
            $contenu            = $_POST["contenu"];
            $photo              = $_POST["photo"];
            $id_categorie       = $_POST["id_categorie"];
            $tag                = $_POST["tag"];
            $url                = $_POST["url"];
            
            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($titre)           && ( mb_strlen($titre) > 0 )
                    && is_string($chapo)    && ( mb_strlen($chapo) > 0 ) 
                    && is_string($contenu)  && ( mb_strlen($contenu) > 0 ) 
                    && is_string($photo)    && ( mb_strlen($photo) > 0 ) 
                    && is_numeric($id_categorie) 
                    && is_string($tag)      && ( mb_strlen($tag) > 0 ) 
                    && is_string($url)      && ( mb_strlen($url) > 0 ) 
                )//fin ifstring
            {
               // OK ON A LES BONNES INFOS
                //infos nom transmises pas le questionnaire
                $id_auteur      = 1;     // DEBUG
                $dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL
                
                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL article
                // JE CREE UN OBJET DE LA CLASSE ArticleModel
                // NE PAS OUBLIER DE FAIRE use
                $objetArticlesModel = new ArticlesModel;
                // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                $objetArticlesModel->update([
                    "titre"         => $titre, 
                    "chapo"         => $chapo, 
                    "contenu"       => $contenu, 
                    "id_auteur"     => $id_auteur, 
                    "dateCreation"  => $dateCreation, 
                    "photo"         => $photo, 
                    "id_categorie"  => $id_categorie, 
                    "tag"           => $tag, 
                    "url"           => $url, 
                    ] , $id); // $id est le paramètre demandé par la function

                $message = "Bravo tu as modifié un article";
            }// fin ifstring
            else
            {
                $message= "ERREUR : INFO INCORRECTE";
                // UNE ERREUR transmettre à la partie view (en dessous $this->show)
            }

        }
        // VIEW
        // AFFICHER LA PAGE QUI PERMET DE MODIFIER UN ARTICLE
        $this->show("page/admin-articles-update", [ "id" => $id, "message" => $message ]);
    }
    


    //la méthode associée à la route /admin/article
    public function article()     // rappel dans routes.php en troisième paramètre Admin#article 
    {
        //initialisation de la variable message
        $message= "";

        //JE PEUX TRAITER LE FORMULAIRE S'IL EXISTE
        //if(!empty($_POST)) ancienne version
        if (isset($_REQUEST["operation"]) && ($_REQUEST["operation"] == "supprimer"))
        {
            $id = intval(trim($_REQUEST["id"]));  // intval transforme un texte en nombre
            if ($id > 0)
            {
                // ESSAYER D'EFFACER LA LIGNE DANS LA TABLE MYSQL article
                // NE PAS OUBLIER DE FAIRE use
                $objetArticlesModel = new ArticlesModel;
                $objetArticlesModel->delete($id);
            }// fin intval
        }// fin if operation = supprimer

        if (isset($_POST["operation"]) && ($_POST["operation"] == "creer"))  //vient du input hidden mais si le questionnaire est vide il sera stoppé par les verif is_string... (et les required de form)
        {
            //array_map('strip_tags', $POST);  //note est-ce nécessaire de nettoyer la partie admin?
             // RECUPERER LES INFOS DU FORMULAIRE
            
            $titre              = $_POST["titre"];
            $chapo              = $_POST["chapo"];
            $contenu            = $_POST["contenu"];
            $photo              = $_POST["photo"];
            $id_categorie       = $_POST["id_categorie"];
            $tag                = $_POST["tag"];
            $url                = $_POST["url"];
            
            // SECURITE
            // VERIFIER QUE CHAQUE INFO EST CONFORME
            // http://php.net/manual/en/function.mb-strlen.php
            if (is_string($titre)           && ( mb_strlen($titre) > 0 )
                    && is_string($chapo)    && ( mb_strlen($chapo) > 0 ) 
                    && is_string($contenu)  && ( mb_strlen($contenu) > 0 ) 
                    && is_string($photo)    && ( mb_strlen($photo) > 0 ) 
                    && is_numeric($id_categorie) 
                    && is_string($tag)      && ( mb_strlen($tag) > 0 ) 
                    && is_string($url)      && ( mb_strlen($url) > 0 ) 
                )//fin ifstring
            {
               // OK ON A LES BONNES INFOS
                // COMPLETER LES INFOS MANQUANTES
                $id_auteur      = 1;     // DEBUG  //l'id_auteur sera définie par les login (l'auteur qui crée son article sera affiché en bas)
                $dateCreation   = date("Y-m-d H:i:s");    // FORMAT DATETIME SQL
                
                // ENREGISTRER LA LIGNE DANS LA TABLE MYSQL article
                // JE CREE UN OBJET DE LA CLASSE ArticleModel
                // NE PAS OUBLIER DE FAIRE use
                $objetArticlesModel = new ArticlesModel;
                // JE PEUX UTILISER LA METHODE insert DE LA CLASSE \W\Model\Model
                $objetArticlesModel->insert([
                    "titre"         => $titre, 
                    "chapo"         => $chapo, 
                    "contenu"       => $contenu, 
                    "id_auteur"     => $id_auteur, 
                    "dateCreation"  => $dateCreation, 
                    "photo"         => $photo, 
                    "id_categorie"  => $id_categorie, 
                    "tag"           => $tag, 
                    "url"           => $url, 
                    ]);

                $message = "Bravo tu as créé un article";
            }// fin ifstring
            else
            {
                $message= "ERREUR : INFO INCORRECTE";
                // UNE ERREUR transmettre à la partie view (en dessous $this->show)
            }
  
        }// fin if ISSET CREER
        
        //afficher la page 
        $this->show("page/admin-article", ["message" =>$message  ]);  // il faut créer cetter page admin-article.php
    }// fin class article





*/



   } // fin class UserController