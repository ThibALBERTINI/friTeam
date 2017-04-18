<?php

$this->insert("partials/header", ["titrePage" => $titrePage]);
$this->insert("partials/users-section-newPass", [ "message" => $message, "login" => $login ]);
$this->insert("partials/footer");


?>