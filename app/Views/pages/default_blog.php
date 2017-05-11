<?php
  $background = $this->assetUrl("img/blog.jpeg");
  $this -> insert("partials/header", ["titrePage" => $titrePage, "background" => $background, "contenuMeta" => "META EN ATTENTE", "keywords" => "mots clef en attente"]);
  $this -> insert("partials/section-blog"); 
  $this -> insert("partials/footer");
?>
