<?php
$background = $this->assetUrl("img/profil.jpg");
$this->insert("partials/header", ["titrePage" => $titrePage, "background" => $background]);
$this->insert("partials/section-qui-sommes-nous");
$this->insert("partials/footer");
?>
