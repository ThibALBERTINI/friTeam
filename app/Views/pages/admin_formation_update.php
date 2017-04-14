<?php 

$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-formation-update", [ "id" => $id, "message" => $message ]);
$this->insert("partials/footer");