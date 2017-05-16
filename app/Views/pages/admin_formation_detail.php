<?php 
$background = $this->assetUrl("img/formation.jpeg");
$this->insert("partials/admin-header", ["titrePage" => $titrePage, "background" => $background]);
$this->insert("partials/admin-section-formation", ["messageOK" => $messageOK, "messageKO" => $messageKO, "id" => $id ]);
$this->insert("partials/admin-footer");

 ?>