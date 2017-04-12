<?php

?>
<section>
    <h2>QUI SOMMES NOUS ?</h2>
    <form method="POST" action="">

        <div class=form-group>
            <label for="titre">TITRE</label>
            <input type="text" name="titre"><br>
        </div>
        <div class=form-group>
            <label for="chapo">CHAPO</label>
            <textarea name="chapo" cols="60" rows="4"></textarea><br>
        </div>
        <div class=form-group>
            <label for="contenu">CONTENU</label>
            <textarea name="contenu" cols="60" rows="5"></textarea><br>
        </div>
        <div class=form-group>   
            <label for="img_profil">CHEMIN PHOTO</label>
            <input type="text" name="img_profil"><br>
        </div>
        <div class=form-group>   
            <label for="nom_profil">NOM</label>
            <input type="text" name="nom_profil"><br>
        </div>
        <div class=form-group>    
            <label for="nom_profil">PRENOM</label>
            <input type="text" name="prenom_profil"><br>
        </div>
        <div class=form-group>
            <label for="citation_profil">CITATION PREFEREE</label>  
            <input type="text" name="citation_profil"><br>
        </div>
        <div class=form-group>
            <label for="competence_profil">COMPETENCES</label>
            <input type="text" name="competence_profil"><br>
        </div>
        <div class=form-group>
            <label for="interets_profil">CENTRES D'INTERET</label>
            <input type="text" name="interet_profil"><br>
        </div>
        <div class=form-group>
            <label for="domaines_inter">DOMAINES D'INTERVENTION</label>
            <input type="text" name="domaines_inter"><br>
        </div>
        <div class=form-group>
            <label for="motivation_profil">MOTIVATION</label>
            <input type="text" name="motivation_profil"><br>
        </div>
        <div class=form-group>
            <label for="vision_profil">VISION</label>
            <input type="text" name="vision_profil" ><br>
        </div>
        <div class=form-group>
            <label for="entreprise_profil">ENTREPRISE</label>
            <input type="text" name="entreprise_profil"><br>
        </div>
        <div class=form-group>
            <label for="linkedin">LINKEDIN</label>
            <input type="text" name="linkedin"><br>
        </div>
        <div class=form-group>
            <button type="submit">CREER</button>
        </div>
        
        <!-- INFO TECHNIQUE POUR PRECISER L'ACTION QUE LE VISITEUR VEUT REALISER -->
        <input type="hidden" name="operation" value="creer">
        
        <div class="message">
            <?php if (isset($message)) echo $message ?>
        </div>
    </form>
</section>


<section>
    <h2>LISTE DES PROFILS</h2>
    <table>
        <thead>
<?php
// SI JE VEUX ACCEDER A LA TABLE profil
// IL FAUT UTILISER LA CLASSE \Model\ProfilModel
$objetProfilModel = new \Model\ProfilModel;

$tabResult = $objetProfilModel->findAll("id", "DESC", 1); // ON NE VEUT QU'UNE LIGNE
// BOUCLE POUR PARCOURIR CHAQUE LIGNE TROUVEE
foreach($tabResult as $tabLigne)
{
    echo "<tr>";
    // BOUCLE POUR PARCOURIR CHAQUE COLONNE
    foreach($tabLigne as $nomColonne => $valeurColonne)
    {
        // AFFICHER LA COLONNE
        echo "<th>$nomColonne</th>";
    }
    // AJOUTER LES COLONNES MODIFIER ET SUPPRIMER
    echo "<th>MODIFIER</th>";
    echo "<th>SUPPRIMER</th>";
    
    echo "</tr>";
}

?>            
        </thead>
        <tbody>
<?php
// SI JE VEUX ACCEDER A LA TABLE profil
// IL FAUT UTILISER LA CLASSE \Model\ProfilModel
$tabResult = $objetProfilModel->findAll("id", "DESC");
// BOUCLE POUR PARCOURIR CHAQUE LIGNE TROUVEE
foreach($tabResult as $tabLigne)
{
    echo "<tr>";
    // BOUCLE POUR PARCOURIR CHAQUE COLONNE
    foreach($tabLigne as $nomColonne => $valeurColonne)
    {
        // AFFICHER LA COLONNE
        echo "<td>$valeurColonne</td>";
    }
    
    // JE RECUPERE L'ID DE LA LIGNE COURANTE
    $id = $tabLigne["id"];
    
    $hrefModifier  = $this->url("admin_profil_update", [ "id" => $id ]);
    $hrefSupprimer = "?id=$id&operation=supprimer";
    
    // AJOUTER LES COLONNES MODIFIER ET SUPPRIMER
    echo
<<<CODEHTML
    <td><a href="$hrefModifier">MODIFIER</a></td>
    <td><a href="$hrefSupprimer">SUPPRIMER</a></td>
    </tr>
CODEHTML;

}

?>
        </tbody>
    </table>

</section>
