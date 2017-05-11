<?php
$background = $this->assetUrl("img/profil.jpg");
$this->insert("partials/header", ["titrePage" => $titrePage, "background" => $background, "contenuMeta" => "META EN ATTENTE", "keywords" => "mots clef en attente"]);
$this->insert("partials/section-qui-sommes-nous");
$this->insert("partials/footer");
?>
