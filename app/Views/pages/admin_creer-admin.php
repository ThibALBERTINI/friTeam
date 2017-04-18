<?php 

$this->insert("partials/admin-header", ["titrePage"=> $titrePage ]);
$this->insert("partials/admin-section-creerAdmin", ["message" => $message]);
$this->insert("partials/admin-footer");

 ?>