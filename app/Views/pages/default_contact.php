<?php

  $this -> insert("partials/header", ["titrePage" => $titrePage]);
  $this -> insert("partials/section-contact", ["message" => $message, "message2" => $message2]);
  $this -> insert("partials/footer");

?>
