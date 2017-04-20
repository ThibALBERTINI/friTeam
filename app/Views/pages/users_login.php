<?php
$background = $this->assetUrl("img/contact.jpg");
$this->insert("partials/header", [ "titrePage"=> $titrePage, "background" => $background]);
$this->insert("partials/users-section-login", [ "message" => $message ]);
$this->insert("partials/footer");


?>