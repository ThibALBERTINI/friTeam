<?php 

$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-accompagnement", ["messageOK" => $messageOK, "messageKO" => $messageKO, "id" => $id ]);
$this->insert("partials/footer");

