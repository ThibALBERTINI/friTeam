<?php

  $this -> insert("partials/header", ["titrePage" => $titrePage]);
  $this -> insert("partials/section-formation", ["categs" => $categs, "tabResult"=> $tabResult, "tabFormations" =>$tabFormations]); 
  $this -> insert("partials/footer");

?>
