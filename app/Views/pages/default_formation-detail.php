<?php

  $this -> insert("partials/header", ["titrePage" => $titrePage]);
  $this -> insert("partials/section-formation-detail", ["url" => $url]);
  $this -> insert("partials/footer");

?>
