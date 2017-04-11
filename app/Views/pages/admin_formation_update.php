<?php 

$this->insert("partials/header");
$this->insert("partials/admin-section-formation-update", [ "id" => $id, "message" => $message ]);
$this->insert("partials/footer");