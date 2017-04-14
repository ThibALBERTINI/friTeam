<?php 

$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-accompagnement", ["message" => $message, "id" => $id ]);
$this->insert("partials/footer");

