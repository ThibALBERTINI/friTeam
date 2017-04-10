<?php

namespace Controller;

use \W\Controller\Controller;

class MonController 
        extends Controller
{
    // ON SURCHARGE LA METHODE show
    // POUR MODIFIER LE FRAMEWORK W
    
	/**
	 * Affiche un template
	 * @param string $file Chemin vers le template, relatif à app/Views/
	 * @param array  $data Données à rendre disponibles à la vue
	 */
	public function show($file, array $data = array())
	{
	    // DEFINIR DES VARIABLES GLOBALES COMMUNES A TOUT LE SITE
	    // ...
	    
	    // DEBUG
	    // die("J'AI PRIS LE CONTROLE DE show");
	    
		//incluant le chemin vers nos vues
		$engine = new \League\Plates\Engine(self::PATH_VIEWS);

		//charge nos extensions (nos fonctions personnalisées)
		$engine->loadExtension(new \W\View\Plates\PlatesExtensions());

		// le flash message
		$flash_message = (isset($_SESSION['flash']) && !empty($_SESSION['flash'])) ? (object) $_SESSION['flash'] : null;

		// 
		$app = getApp();		

		// Rend certaines données disponibles à tous les vues
		// accessible avec $w_user & $w_current_route dans les fichiers de vue
		$engine->addData(
			[
				'w_user' 		  => $this->getUser(),
				'w_current_route' => $app->getCurrentRoute(),
				'w_site_name'	  => $app->getConfig('site_name'),
				'w_flash_message' => $flash_message,
				// DEVIENT UNE VARIABLE "LOCALE" POUR LA PARTIE Views
				"maVar"           => "COCORICO",
			]
		);

        // ON PEUT AJOUTER DES FONCTIONS POUR LA PARTIE VIEW
        // http://platesphp.com/engine/functions/
        // DANS LA PARTIE Views
        // JE POURRAI UTILISER 
        // echo $this->majuscule("texte en minuscules");
        $engine->registerFunction('majuscule', function ($string) {
            return strtoupper($string);
        });

        $engine->registerFunction('afficherVarGlob', function ($nomVarGlob) {
            // http://php.net/manual/fr/reserved.variables.globals.php
            if (isset($GLOBALS["$nomVarGlob"])) echo $GLOBALS["$nomVarGlob"];
        });

		// Retire l'éventuelle extension .php
		$file = str_replace('.php', '', $file);

		// Affiche le template
		echo $engine->render($file, $data);
		die();
	}
    
}