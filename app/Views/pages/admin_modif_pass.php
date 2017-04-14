<?php

// ON UTILISE UN HEADER ET UN FOOTER DIFFERENT POUR LE BACKOFFICE
$this->insert("partials/admin-header");
$this->insert("partials/admin-section-modifPass", ["message" => $message]);
$this->insert("partials/admin-footer");

?>