<?php
$objetEquipeModel = new \Model\EquipeModel;
//$tabEquipe = $objetEquipeModel->find($id);
?>
<section>
    <h2>QUI SOMMES-NOUS ?</h2>
<?php
// AVEC LE FRAMEWORK W
// ON FAIT DE LA PROGRAMMATION ORIENTE OBJET
// IL Y A LA CLASSE \W\Model\Model
// PAR TABLE DANS MYSQL
// ON VA CREER UNE CLASSE DANS LE NAMESPACE Model
// ET NOTRE CLASSE VA HERITER DE LA CLASSE \W\Model\Model
// PAR EXEMPLE:
// SI ON A UNE TABLE profil
// IL FAUT CREER UNE CLASSE ProfilModel
//                              extends \W\Model\Model

$objetEquipeModel = new \Model\EquipeModel;

// LA METHODE findAll EST DEFINIE DANS LA CLASSE \W\Model\Model
// LA METHODE findAll RENVOIE UN TABLEAU DE TABLEAU
// ON PEUT TRIER PAR UNE COLONNE DE LA TABLE
$tabResult = $objetEquipeModel->findAll("id", "ASC");

// JE PEUX PARCOURIR LA TABLE POUR RECUPERER CHAQUE LIGNE
foreach($tabResult as $index => $tabInfo)
{
    // POUR CHAQUE LIGNE
    // JE PEUX RECUPERER CHAQUE COLONNE DANS UNE VARIABLE PHP
    $titre = $tabInfo["titre"];
    $chapo = $tabInfo["chapo"];
    $nom_profil = $tabInfo["nom_profil"];
    $prenom_profil = $tabInfo["prenom_profil"];
    $img_profil = $tabInfo["img_profil"];
    $citation_profil = $tabInfo["citation_profil"];
    $competence_profil = $tabInfo["competence_profil"];
    $interets_profil = $tabInfo["interets_profil"];
    $domaines_inter = $tabInfo["domaines_inter"];
    $motivation_profil = $tabInfo["motivation_profil"];
    $vision_profil = $tabInfo["vision_profil"];
    $entreprise_profil = $tabInfo["entreprise_profil"];
    $linkedin = $tabInfo["linkedin"];
    // JE CONSTRUIS LE HREF POUR LE LIEN 
    // EN PASSANT LA VALEUR A REMPLIR DANS LA PARTIE DYNAMIQUE DE LA ROUTE
    $href  = $this->url("default_friteam-equipe", [ "url" => $url ]);
    
    // AFFICHER LE CODE HTML
    // http://php.net/manual/fr/language.types.string.php#language.types.string.syntax.heredoc
    // HEREDOC
    echo
<<<CODEHTML
    <article>
        <h3><a href="$href">$titre</a></h3>
        <div>$chapo</div>
    </article>
CODEHTML;

}

// DEBUG
//echo "<pre>";
//print_r($tabResult);
//echo "</pre>";

?>    
</section>
