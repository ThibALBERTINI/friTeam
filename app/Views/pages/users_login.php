<?php

$this->insert("partials/header", [ "titrePage"=>$titrePage]);
$this->insert("partials/users-section-login", [ "message" => $message ]);
$this->insert("partials/footer");


?>