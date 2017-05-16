<?php 
$background = $this->assetUrl("img/acc.jpg");
$this->insert("partials/admin-header", ["titrePage" => $titrePage, "background" => $background]);
$this->insert("partials/admin-section-accompagnement", ["messageOK" => $messageOK, "messageKO" => $messageKO, "id" => $id ]);
$this->insert("partials/admin-footer");

