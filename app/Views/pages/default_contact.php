<?php
$background = $this->assetUrl("img/contact.jpg");
$this -> insert("partials/header", ["titrePage" => $titrePage, "background" => $background]);
$this -> insert("partials/section-contact", ["message" => $message, "message2" => $message2]);
$this -> insert("partials/footer");

?>
