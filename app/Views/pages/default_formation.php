<?php
  $background = $this->assetUrl("img/formation.jpeg");
  $this -> insert("partials/header", ["titrePage" => $titrePage, "background" => $background]);
  $this -> insert("partials/section-formation", ["categs" => $categs, "tabResult"=> $tabResult, "tabFormations" =>$tabFormations]); 
  $this -> insert("partials/footer");

?>
