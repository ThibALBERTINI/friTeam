<?php

namespace Controller;

use \W\Controller\Controller;

class UsersController 
        extends Controller
{


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
                $idUser = $objetAuthentificationModel->isValidLoginInfo($login, $password);
                if ($idUser > 0)
                {
                    // OK
                    $message = "BIENVENUE $idUser";
                    
                    $objetUsersModel = new \W\Model\UsersModel;
                    // ON RECUPERE TOUTE LA LIGNE SUR L'UTILISATEUR
                    $tabUser = $objetUsersModel->find($idUser);
                    // JE VAIS MEMORISER CES INFOS DANS UNE SESSION
                    $objetAuthentificationModel->logUserIn($tabUser);
                    
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


   } // fin class UserController