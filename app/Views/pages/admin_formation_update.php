<?php 
$background = $this->assetUrl("img/formation.jpeg");
$this->insert("partials/admin-header", ["titrePage" => $titrePage, "background" => $background]);
$this->insert("partials/admin-section-formation-update", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO ]);
$this->insert("partials/admin-footer");