<?php 

$this->insert("partials/admin-header");
$this->insert("partials/admin-section-creerAdmin", ["message" => $message], ["titrePage"=> $titrePage ]);
$this->insert("partials/admin-footer");

 ?>