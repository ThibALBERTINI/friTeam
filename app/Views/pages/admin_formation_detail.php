<?php 

$this->insert("partials/header");
$this->insert("partials/admin-section-formation", ["message" => $message, "id" => $id ]);
$this->insert("partials/footer");

 ?>