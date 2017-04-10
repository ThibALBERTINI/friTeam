<?php
namespace Controller;

use \W\Controller\Controller;
use \Model\ArticlesModel;

class AdminController extends Controller
{
	public function home
	{
		 $this->allowTo([ "admin", "super-admin" ]);

	}// fin function home

	public function friteam-equipe
	{
 		$this->allowTo([ "admin", "super-admin" ]);
	}// fin function friteam-equipe

	public function formation
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function formation

	public function formation-detail
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function formation-detail

	public function accompagnement
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	} // fin function accompagnement

	public function accompagnement-detail
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function accompagnement-detail


	public function blog
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function blog

	public function blog-detail
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	}// fin function blog-detail


	public function contact
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	} // fin function contact

	public function users
	{
		 $this->allowTo([ "admin", "super-admin" ]);
	} // fin function users

	public function logout
	{
		$objetAuthentificationModel = new \W\Security\AuthentificationModel;
        $objetAuthentificationModel->logUserOut();
        
        // REDIRIGER VERS LA PAGE DE LOGIN
        $this->redirectToRoute("users_login");
	}// fin function logout


} // fin class AdminController
