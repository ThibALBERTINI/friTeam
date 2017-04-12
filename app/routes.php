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
		
		['GET|POST', 	'/admin/formation/update/[:id]',	'Admin#formationUpdate',  'admin_formation_update'], // UNE ROUTE

		['GET|POST',    '/admin/', 					'Admin#home',     				'admin_home'],     // UNE ROUTE
		['GET|POST', 	'/admin/friteam-equipe',	'Admin#friteamEquipe', 		'admin_friteam-equipe'], // UNE ROUTE
		//['GET|POST', 	'/admin/formation', 		'Admin#formation',				'admin_formation'],  // UNE ROUTE
		['GET|POST', 	'/admin/formation/[:url]', 	'Admin#formation', 		'admin_formation_detail'],  // UNE ROUTE
		['GET|POST', 	'/admin/accompagnement', 	'Admin#accompagnement', 		'admin_accompagnement'],  // UNE ROUTE
		['GET|POST', 	'/admin/accompagnement/[:url]','Admin#accompagnementDetail','admin_accompagnement-detail'],  // UNE ROUTE
		['GET|POST', 	'/admin/blog',				'Admin#blog',					'admin_blog'],  // UNE ROUTE
		['GET|POST', 	'/admin/blog/[:url]',		'Admin#blogDetail',			'admin_blog-detail'],  // UNE ROUTE
		['GET|POST', 	'/admin/contact', 			'Admin#contact',  				'admin_contact'],  // UNE ROUTE
		['GET|POST', 	'/admin/users', 			'Admin#users',  				'admin_users'],  // UNE ROUTE

		//ATTENTION IL FAUT CHANGER LE NOM DE LA ROUTE POUR LE LOGIN
		['GET|POST', 	'/users/login',	'Users#login',  'users_login'], // UNE ROUTE
		['GET|POST', 	'/admin/logout', 'Admin#logout', 'admin_logout'],

		//AJAX
		['GET|POST', 	'/ajax', 'Default#ajax', 'default_ajax'],
	);
	