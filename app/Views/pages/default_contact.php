<?php

  $this -> insert("partials/header", ["titrePage" => $titrePage]);
  $this -> insert("partials/section-contact", ["message" => $message]);
  $this -> insert("partials/footer");

?>
