<?php 

$this->insert("partials/header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-formation-update", [ "id" => $id, "message" => $message, "message_upload" => $message_upload ]);
$this->insert("partials/footer");