<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>FRI TEAM - Fédérer / Réussir / Innover en Equipe</title>

    <!-- Style CSS Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/bootstrap.min.css') ?>">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/animate.css') ?>">
    <!-- Style CSS Personnel -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/fullcalendar.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('font-awesome/css/font-awesome.css') ?>">
    <!-- Roboto Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
  </head>

  <body>
    <header>
      <!-- Navbar -->
      <nav id="mainNav" class="navbar navbar-default navbar-fixed-top" data-spy="affix" data-offset-top="205">
        <div class="container-fluid">
          <!-- Menu Hamburger -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed nav-ham" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->url('default_home') ?>">FRI TEAM</a>
          </div>

          <!-- Menu default écran ordi -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li><a class="menu1" href="<?php echo $this->url('default_home') ?>">Accueil</a></li>
              <li><a class="menu2" href="<?php echo $this->url('default_friteam-equipe') ?>">Qui sommes-nous ?</a></li>
              <li><a class="menu3" href="<?php echo $this->url('default_formation') ?>">Nos Formations</a></li>
              <li><a class="menu4" href="<?php echo $this->url('default_accompagnement') ?>">Notre accompagnement</a></li>
              <li><a class="menu5" href="<?php echo $this->url('default_evenement') ?>">Nos Évènements</a></li> <!-- Liens à former -->
              <li><a class="menu6" href="<?php echo $this->url('default_blog') ?>">Blog</a></li>
              <li><a class="menu7" href="<?php echo $this->url('default_contact') ?>">Contact</a></li>
            </ul>
          </div> <!-- Fin Navbar-collapse -->
        </div> <!-- Fin container-fluid -->
      </nav>

      <!-- Header -->
      <div class="container-fluid header text-center">
        <h1 class="animated fadeIn">FRI TEAM</h1>
        <p class="animated bounceIn">Fédérer - Réussir - Innover En Equipe</p>
        <a class="btn btn-default page-scroll" href="#qui-sommes-nous" role="button">Nous Connaître</a>

        <div class="arrow bounce">
          <i class="fa fa-arrow-down fa-2x"></i>
        </div>
      </div>
    </header>

    <main>
