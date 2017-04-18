<?php

$this->insert("partials/header", ["titrePage" => $titrePage]);
$this->insert("partials/users-section-loosePass", [ "message" => $message ]);
$this->insert("partials/footer");


?>