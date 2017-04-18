<div class="container carte-container">
    <h2>QUI SOMMES-NOUS ?</h2>
    <h3>NOTRE EQUIPE </h3>


<?php

$objetFicheModel = new \Model\ProfilModel;
$tabResult = $objetFicheModel->findAll("ordre_apparition", "ASC");

if(!empty($tabResult))
{
  foreach ($tabResult as $index => $tabInfo)
  {
    $id = $tabInfo["id"];
    $ordre = $tabInfo["ordre_apparition"];
    $img = $tabInfo["img"];
    $nom = $tabInfo["nom_profil"];
    $prenom = $tabInfo["prenom_profil"];
    $citation = $tabInfo["citation_profil"];
    $motivation = $tabInfo["motivation_profil"];
    $interets = $tabInfo["interets_profil"];
    $vision = $tabInfo["vision_profil"];
    $competence = $tabInfo["competence_profil"];
    $domaines = $tabInfo["domaines_inter"];
    $entreprise = $tabInfo["entreprise_profil"];
    $linkedin = $tabInfo["linkedin"];
    

    
echo
<<<CODEHTML
   <div class="row contient">
        <div id="imgprof" class="col-xs-12 col-sm-2">
            <img class="img-circle" src="$img">
        </div>
       
        <div id="contenuprof" class="col-xs-12 col-sm-offset-2 col-sm-7">
            <h4>$prenom $nom</h4>
            <p class="citation"> Sa citation : $citation </p>   
            <p class="competence"> Ses compétences : $competence </p> 
            <p class="interets"> Ses centres d'intérêt : $interets </p>  
            <p class="intervention"> Ses domaines d'intervention : $domaines </p>
            <p class="motivation"> Sa motivation : $motivation </p>
            <p class="vision"> Sa vision : $vision </p>
            <p class="entreprise"> Entreprise(s) : $entreprise </p>
           
            <p class="linkedin"><a href="$linkedin"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i>  </a></p>
            
        </div>
    </div>
        
CODEHTML;
  }
}
?>

<script>
$(document).ready(function(){
    $('div#imgprof:even').addClass("col-sm-push-9");
    $('div#contenuprof:even').addClass("col-sm-pull-2");
});

</script>