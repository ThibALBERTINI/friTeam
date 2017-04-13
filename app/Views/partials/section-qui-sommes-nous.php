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

$objetProfilModel = new \Model\ProfilModel;
$tabResult = $objetProfilModel->findAll("id", "ASC");

// LA METHODE findAll EST DEFINIE DANS LA CLASSE \W\Model\Model
// LA METHODE findAll RENVOIE UN TABLEAU DE TABLEAU
// ON PEUT TRIER PAR UNE COLONNE DE LA TABLE

if (!empty($tabResult))
{
    // JE PEUX PARCOURIR LA TABLE POUR RECUPERER CHAQUE LIGNE
    foreach($tabResult as $index => $tabInfo)
    {
        // POUR CHAQUE LIGNE
        // JE PEUX RECUPERER CHAQUE COLONNE DANS UNE VARIABLE PHP

        $nom = $tabInfo["nom_profil"];
        $prenoml = $tabInfo["prenom_profil"];
        $img = $tabInfo["img_profil"];
        $citation_ = $tabInfo["citation_profil"];
        $competence = $tabInfo["competence_profil"];
        $interets = $tabInfo["interets_profil"];
        $domaines = $tabInfo["domaines_inter"];
        $motivation = $tabInfo["motivation_profil"];
        $vision = $tabInfo["vision_profil"];
        $entreprise = $tabInfo["entreprise_profil"];
        $linkedin = $tabInfo["linkedin"];
        // JE CONSTRUIS LE HREF POUR LE LIEN 
        // EN PASSANT LA VALEUR A REMPLIR DANS LA PARTIE DYNAMIQUE DE LA ROUTE
        
        // AFFICHER LE CODE HTML
        // http://php.net/manual/fr/language.types.string.php#language.types.string.syntax.heredoc
        // HEREDOC
    echo
<<<CODEHTML
    <article>
        <h3> $nom</h3>
    </article>
CODEHTML;
    }
}

// DEBUG
//echo "<pre>";
//print_r($tabResult);
//echo "</pre>";

?>    
</section>
