<?php
	$background = $this->assetUrl("img/acc.jpg");
	$this -> insert("partials/header", ["titrePage" => $titrePage, "background" => $background]);
	$this -> insert("partials/section-accompagnement-detail", ["url" => $url]);
	$this -> insert("partials/footer");

?>
