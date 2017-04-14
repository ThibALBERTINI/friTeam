<?php 

$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-blog-update", [ "id" => $id, "message" => $message ]);
$this->insert("partials/footer");

//MàJ des articles

?>