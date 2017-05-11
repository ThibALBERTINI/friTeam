<?php
$background = $this->assetUrl("img/contact.jpg");
$this -> insert("partials/header", ["titrePage" => $titrePage, "background" => $background, "contenuMeta" => "META EN ATTENTE", "keywords" => "mots clef en attente"]);
$this -> insert("partials/section-contact", ["message" => $message]);
$this -> insert("partials/footer");
?>
