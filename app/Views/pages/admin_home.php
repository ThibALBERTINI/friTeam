<?php
$background = $this->assetUrl("img/home.jpg");
// ON UTILISE UN HEADER ET UN FOOTER DIFFERENT POUR LE BACKOFFICE
$this->insert("partials/admin-header", [ "titrePage" => $titrePage, "background" => $background]);
$this->insert("partials/admin-section-home", [ "id" => $id, "messageOK" => $messageOK, "messageKO" => $messageKO ]);
$this->insert("partials/admin-footer");

?>