<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>FRITEAM Admin header</title>

        <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/main.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/bootstrap.min.css') ?>">
     
    </head>
    <body>
        <header>
            <h1><?php if (isset($title)) echo $title ?></h1>
            <nav>
                    <li><a href="<?php echo $this->url('admin_home') ?>">Accueil</a></li>
                    <li><a href="<?php echo $this->url('admin_friteam-equipe') ?>">Qui sommes-nous ?</a></li>
                    <li><a href="<?php echo $this->url('admin_formation') ?>">Nos Formations</a></li>
                    <li><a href="<?php echo $this->url('admin_accompagnement') ?>">Accompagnement</a></li>
                    <li><a href="<?php echo $this->url('admin_contact') ?>">Contact</a></li>
                    <li><a href="<?php echo $this->url('admin_logout') ?>">Se Déconnecter</a></li>
                </ul>
            </nav>
        </header>
        <main>
