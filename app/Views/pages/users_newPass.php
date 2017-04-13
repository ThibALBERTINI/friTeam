<?php

$this->insert("partials/header");
$this->insert("partials/users-section-newPass", [ "message" => $message, "login" => $login ]);
$this->insert("partials/footer");


?>