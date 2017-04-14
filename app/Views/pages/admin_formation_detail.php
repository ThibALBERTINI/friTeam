<?php 

$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-formation", ["message" => $message, "id" => $id ]);
$this->insert("partials/footer");

 ?>