<?php

// ON UTILISE UN HEADER ET UN FOOTER DIFFERENT POUR LE BACKOFFICE
$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-home-partenaire", [ "message" => $message, "id"=>$id  ]);
$this->insert("partials/admin-footer");