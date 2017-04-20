<?php
$background = $this->assetUrl("img/contact.jpg");
$this->insert("partials/header", ["titrePage" => $titrePage, "background" => $background]);
$this->insert("partials/users-section-newPass", [ "message" => $message, "login" => $login ]);
$this->insert("partials/footer");

?>