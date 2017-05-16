<?php 

$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-blog-update", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO ]);
$this->insert("partials/admin-footer");

//MàJ des articles

?>