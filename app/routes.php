<?php
	
	$w_routes = array(
	   // GET OU POST	URL NAVIGATEUR			CLASSE#METHODE					ID UNIQUE DE LA ROUTE
		['GET|POST',    '/', 					'Default#home',     			'default_home'],     // UNE ROUTE
		['GET|POST', 	'/friteam-equipe',		'Default#friteamEquipe', 		'default_friteam-equipe'], // UNE ROUTE
		['GET|POST', 	'/formation', 			'Default#formation',			'default_formation'],  // UNE ROUTE
		['GET|POST', 	'/formation/[:url]', 	'Default#formationDetail', 		'default_formation-detail'],  // UNE ROUTE
		['GET|POST', 	'/accompagnement', 		'Default#accompagnement', 		'default_accompagnement'],  // UNE ROUTE
		['GET|POST', 	'/accompagnement/[:url]','Default#accompagnementDetail','default_accompagnement-detail'],  // UNE ROUTE
		['GET|POST', 	'/blog',				'Default#blog',					'default_blog'],  // UNE ROUTE
		['GET|POST', 	'/blog/[:url]',			'Default#blogDetail',			'default_blog-detail'],  // UNE ROUTE
		['GET|POST', 	'/contact', 			'Default#contact',  			'default_contact'],  // UNE ROUTE
		// ROUTE AVEC PARAMETRE DYNAMIQUE
		// EN GET CLASSIQUE
		// AVEC W

		// ROUTE POUR LA PAGE ADMIN
		

		['GET|POST',    '/admin/', 						'Admin#home',     				'admin_home'],     // UNE ROUTE
		['GET|POST', 	'/admin/friteam-equipe',		'Admin#friteamEquipe', 			'admin_friteam-equipe'], // UNE ROUTE
		['GET|POST', 	'/admin/friteam-equipe-update/[:id]',	'Admin#friteamEquipeUpdate', 	'admin_friteam-equipe-update'], // UNE ROUTE

		['GET|POST', 	'/admin/formation', 			'Admin#formation',				'admin_formation'],  // UNE ROUTE
		['GET|POST', 	'/admin/formation/[:url]', 		'Admin#formationDetail', 		'admin_formation_detail'],  // UNE ROUTE pour la création et l'affichage des formations déjà enregistrés dans la base de donnée
		['GET|POST', 	'/admin/formation/update/[:id]','Admin#formationUpdate',  		'admin_formation_update'], // UNE ROUTE pour la mise à jour des formation (récupérée par l'id)

		['GET|POST', 	'/admin/accompagnement/update/[:id]', 	'Admin#accompagnement', 		'admin_accompagnement'],  // UNE ROUTE pour la mise à jour des accompagnements
		['GET|POST', 	'/admin/accompagnement/[:url]','Admin#accompagnementDetail','admin_accompagnement-detail'],  // UNE ROUTE UNE ROUTE pour la création et l'affichage des accompagnements déjà enregistrés dans la base de donnée
		
		['GET|POST', 	'/admin/blog/[:id]',				'Admin#blog',					'admin_blog'],  // UNE ROUTE pour la mise à jour des articles
		['GET|POST', 	'/admin/blog',		'Admin#blogDetail',			'admin_blog-detail'],  // UNE ROUTE pour la création et l'affichage des articles déjà enregistrés dans la base de donnée
		['GET|POST', 	'/admin/contact', 			'Admin#contact',  				'admin_contact'],  // UNE ROUTE
		['GET|POST', 	'/admin/creerAdmin', 		'Admin#creerAdmin',  			'admin_creer-admin'],  // UNE ROUTE
		['GET|POST', 	'/admin/modifPass', 		'Admin#modifPass',  			'admin_modif_pass'],  // UNE ROUTE

		//ATTENTION IL FAUT CHANGER LE NOM DE LA ROUTE POUR LE LOGIN
		['GET|POST', 	'/users/login',	'Users#login',  'users_login'], // UNE ROUTE
		['GET|POST', 	'/admin/postLogin',	'Admin#postLogin',  'admin_postLogin'], // UNE ROUTE

		['GET|POST', 	'/users/loosePass',	'Users#loosePass',  'users_loosePass'], // UNE ROUTE
		['GET|POST', 	'/users/newPass',	'Users#newPass',  'users_newPass'], // UNE ROUTE
		['GET|POST', 	'/admin/logout', 'Admin#logout', 'admin_logout'],

		//AJAX
		['GET|POST', 	'/ajax', 'Default#ajax', 'default_ajax'],
	);
	