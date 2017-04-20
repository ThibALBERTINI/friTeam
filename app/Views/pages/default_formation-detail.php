<?php
  $background = $this->assetUrl("img/formation.jpeg");
  $this -> insert("partials/header", ["titrePage" => $titrePage, "background" => $background]);
  $this -> insert("partials/section-formation-detail", ["url" => $url]);
  $this -> insert("partials/footer");

?>
