<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $contenuMeta ?>">
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta http-equiv="Content-Language" content="Fr-Ca">
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
    <style>
      <?php if (isset($background)) : ?>
        .header-principal {
          background-image: url("<?php echo $background; ?>");
          width: 100%;
        }
        body {
          margin: 0 auto;
        }
    <?php endif; ?>
    </style>
  </head>

  <body>
    <header>
      <!-- Navbar -->
      <nav class="navbar navbar-default navbar-fixed-top navigation">
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
              <li><a class="menu3" href="<?php echo $this->url('default_formation') ?>">Nos Offres</a></li>
              <li><a class="menu4" href="<?php echo $this->url('default_blog') ?>">Blog</a></li>
              <li><a class="menu5" href="<?php echo $this->url('default_contact') ?>">Contact</a></li>
            </ul>
          </div> <!-- Fin Navbar-collapse -->
        </div> <!-- Fin container-fluid -->
      </nav>

      <!-- Header image + titre -->
      <div class="container-fluid header-principal">
        <h1 class="titre-page"><?php echo $titrePage ?></h1>
      </div>
    </header>

    <main>
