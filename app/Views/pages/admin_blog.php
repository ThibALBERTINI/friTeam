<?php 

$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-blog-update", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO ]);
$this->insert("partials/footer");

//MàJ des articles

?>