<?php
$background = $this->assetUrl("img/contact.jpg");
$this -> insert("partials/header", ["titrePage" => $titrePage, "background" => $background]);
$this -> insert("partials/section_evenement");
$this -> insert("partials/footer");

?>
