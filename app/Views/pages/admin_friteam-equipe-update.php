<?php

// ON UTILISE UN HEADER ET UN FOOTER DIFFERENT POUR LE BACKOFFICE
$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-qui-sommes-nous-update", [ "messageOK" => $messageOK, "messageKO" => $messageKO, "id"=>$id  ]);
$this->insert("partials/admin-footer");