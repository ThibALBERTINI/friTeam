<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Friteam Accueil</title>

        <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/main.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/bootstrap.min.css') ?>">
    </head>
    <body>
        <header>
            <h1><?php if (isset($title)) echo $title ?></h1>
            <nav>
                <ul>
                    <li><a href="<?php echo $this->url('default_home') ?>">Accueil</a></li>
                    <li><a href="<?php echo $this->url('default_friteam-equipe') ?>">Qui sommes-nous ?</a></li>
                    <li><a href="<?php echo $this->url('default_formation') ?>">Nos Formations</a></li>
                    <li><a href="<?php echo $this->url('default_accompagnement') ?>">Accompagnement</a></li>
                    <li><a href="<?php echo $this->url('default_blog') ?>">Blog</a></li>
                    <li><a href="<?php echo $this->url('default_contact') ?>">Contact</a></li>
                    <li><a href="<?php echo $this->url('users_login') ?>">Se Connecter</a></li>
                </ul>
            </nav>
        </header>
        <main>