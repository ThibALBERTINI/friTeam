<?php

namespace Controller;

use \W\Controller\Controller;

class UsersController 
        extends Controller
{
    public $titrePage="";
                    //  !!!  le logout se trouve dans adminController (à la fin)

    public function login ()
        {
            // TRAITEMENT DU FORMULAIRE DE LOGIN
            $message = "";
            $titrePage= "";
            
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
                        $message = "BIENVENUE  ". $login;
                        
                        $objetAdminModel = new \Model\AdminModel;
                        // ON RECUPERE TOUTE LA LIGNE SUR L'UTILISATEUR
                        $tabAdmin = $objetAdminModel->find($idAdmin);
                        // JE VAIS MEMORISER CES INFOS DANS UNE SESSION
                        $objetAuthentificationModel->logUserIn($tabAdmin);
                        

                        // ON PEUT FAIRE UNE REDIRECTION VERS UNE PAGE PROTEGEE
                        $this->redirectToRoute('admin_postLogin');
                    }
                    else
                    {
                        // KO
                        $message = '<p class="erreur"> IDENTIFIANTS INCORRECTS</p>';
                    }
                }
                else
                {
                    $message = '<p class="erreur">INFO INCORRECTE </p>';
                }
            }
            
            // VIEW
            $titrePage= "Se Connecter en tant qu'administrateur";
            $this->show("pages/users_login", [ "message" => $message, "titrePage" => $titrePage]);
        } // fin function login

      
    public function loosePass ()
    {
    $message = "";
    $titrePage="";

        if(isset($_POST['btnSub']))
        {
            if(isset($_POST['usernameOrEmail'])) 
            {
                //sécurisation de la valeur
                $usernameOrEmail = trim(strip_tags($_POST['usernameOrEmail']));
           
                $objetUsersModel = new \W\Model\UsersModel;
                $exist= $objetUsersModel->getUserByUsernameOrEmail($usernameOrEmail);  //$exist est le tableau fetch comprenant toute la ligne d'un admin
                
            
                if(isset($exist["email"]))
                {
                    $email=$exist["email"];
                    $id=$exist["id"];

                            //génération du token
                    $token = md5($email); //génération d'une chaine cryptée en MD5()
                    //echo $token;
                    //envoi du mail

                    $objetAdminModel= new \Model\AdminModel;
                    $rqToken= $objetAdminModel->update(array("token"=>$token), $id);
                        
                    $mail = new \PHPMailer(); //création d'un objet de type mail
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
                        $message = '<p class="erreur"> erreur envoi '.$mail->ErrorInfo. '</p>';
                    }
                    else
                    {   
                        $message ='<p class="succes">Vérifiez votre boite mail...</p>';    
                    }
                
            
            
                }//fin ifisset mail 
                else
                {
                    $message = '<p class="erreur"> Vous devez renseigner au moins un identifiant</p>';
                }
            } // fin if(isset submit

             
        }//fin isset btnsub
        $titrePage="Mot de passe perdu";
        $this->show("pages/users_loosePass", [ "message" => $message, "titrePage" => $titrePage]);
    } // fin loosePass

    public function newPass() //suite envoi mail et reception token
    {
        $message = "";
        $login= "";
        if(isset($_POST['btnSub']))
        {
            
            $token = strip_tags($_GET['token']);
            if(isset($token))
            {
                $objetAdminModel = new \Model\AdminModel;
                $tabToken=$objetAdminModel->findBy("token", $token);
                $login=$tabToken['login'];
                $passwordN=$tabToken['password'];
                $id=$tabToken['id'];

                if($_POST["passwordNew"] == $_POST["confirmPasswordNew"])
                {
                    $passwordN=password_hash($_POST["passwordNew"], PASSWORD_DEFAULT);
                    $passChanged=$objetAdminModel->update(array("password"=>$passwordN), $id);

                    if(!$passChanged)
                    {
                        $message = '<p class="erreur">Désolé le mot de passe n\'a pas été changé, merci de recommencer </p>';
                    }
                    else
                    {
                        $message = '<p class="succes">Votre mot de passe a été mis à jour </p>';
                    }
                }// fin pasword = confirmpassword
                else
                {
                    $message = '<p class="erreur">erreur de saisie les mots de passe sont différents </p>';
                }
                      
            }// fin if isset token
            else
                {
                    $message = '<p class="erreur"> vous n\'avez pas été identifié, merci de recommencer l\'étape de modification du mot de passe </p>';
                }
        }// fin ifisset btnsub
        $titrePage = "Changer son mot de passe";
        $this->show("pages/users_newPass", [ "message" => $message, "login" => $login, "titrePage"=> $titrePage ]);
    }//fin function newPass








} // fin class UserController