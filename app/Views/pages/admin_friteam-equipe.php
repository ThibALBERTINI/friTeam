<?php

// ON UTILISE UN HEADER ET UN FOOTER DIFFERENT POUR LE BACKOFFICE
$this->insert("partials/admin-header", ["titrePage" => $titrePage]);
$this->insert("partials/admin-section-qui-sommes-nous", [ "messageOK" => $messageOK, "messageKO" => $messageKO ]);
$this->insert("partials/admin-footer");