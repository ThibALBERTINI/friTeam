<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>FRI TEAM - Gestion du site</title>

    <!-- Style CSS Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/bootstrap.min.css') ?>">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/animate.css') ?>">
    <!-- Style CSS Personnel -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/main.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('font-awesome/css/font-awesome.css') ?>">
    <!-- Roboto Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
  </head>

  <body>
    <header>
      <!-- Navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <!-- Menu Hamburger -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed nav-ham" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">FRI TEAM</a>
          </div>

          <!-- Menu default écran ordi -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li><a class="menu1" href="<?php echo $this->url('admin_home') ?>">Accueil</a></li>
              <li><a class="menu2" href="<?php echo $this->url('admin_friteam-equipe') ?>">Qui sommes-nous ?</a></li>
              <li><a class="menu3" href="<?php echo $this->url('admin_formation_detail') ?>">Les formation</a></li>
              <li><a class="menu4" href="<?php echo $this->url('admin_accompagnement') ?>">Notre accompagnement</a></li>
              <!-- <li><a class="menu5" href="#">Nos Évènements</a></li> ... Liens à former --> 
              <li><a class="menu6" href="<?php echo $this->url('admin_blog') ?>">Blog</a></li>
              <li><a class="menu6" href="<?php echo $this->url('admin_creer-admin') ?>">Gestion admin</a></li>
              <li><a class="menu7" href="<?php echo $this->url('admin_logout') ?>">Se déconnecter</a></li>
            </ul>
          </div> <!-- Fin Navbar-collapse -->
        </div> <!-- Fin container-fluid -->
      </nav>

      <!-- Header image + titre -->
      <div class="container-fluid header-principal text-center">
        <h1 class="titre-page">ADMINISTRATION DE LA PAGE   <?php if(isset($titrePage)) echo $titrePage ?></h1>
      </div>
    </header>

    <main>
