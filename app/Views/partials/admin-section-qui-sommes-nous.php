<section>
    <h2>AJOUT D'UN PROFIL</h2>
    <form method="POST" action="" enctype="multipart/form-data">

        <div class=form-group>   
            <label for="img_profil">CHEMIN PHOTO</label>
            <input type="file" name="img_profil" id="img_profil" class="form-control"><br>
        </div>
        <div class=form-group>   
            <label for="nom_profil">NOM</label>
            <input type="text" name="nom_profil" id="nom_profil" class="form-control"><br>
        </div>
        <div class=form-group>    
            <label for="prenom_profil">PRENOM</label>
            <input type="text" name="prenom_profil" id="prenom_profil" class="form-control"><br>
        </div>
        <div class=form-group>
            <label for="citation_profil">CITATION PREFEREE</label>  
            <input type="text" name="citation_profil" id="citation_profil" class="form-control"><br>
        </div>
        <div class=form-group>
            <label for="competence_profil">COMPETENCES</label>
            <input type="text" name="competence_profil" id="competence_profil" class="form-control"><br>
        </div>
        <div class=form-group>
            <label for="interets_profil">CENTRES D'INTERET</label>
            <input type="text" name="interets_profil" id="interets_profil" class="form-control"><br>
        </div>
        <div class=form-group>
            <label for="domaines_inter">DOMAINES D'INTERVENTION</label>
            <input type="text" name="domaines_inter" id="domaines_profil" class="form-control"><br>
        </div>
        <div class=form-group>
            <label for="motivation_profil">MOTIVATION</label>
            <input type="text" name="motivation_profil" id="motivation_profil" class="form-control"><br>
        </div>
        <div class=form-group>
            <label for="vision_profil">VISION</label>
            <input type="text" name="vision_profil" id="vision_profil" class="form-control"><br>
        </div>
        <div class=form-group>
            <label for="entreprise_profil">ENTREPRISE</label>
            <input type="text" name="entreprise_profil" id="entreprise_profil" class="form-control"><br>
        </div>
        <div class=form-group>
            <label for="linkedin">LINKEDIN</label>
            <input type="text" name="linkedin" id="linkedin" class="form-control"><br>
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
    <h2>LISTE DES PROFILS ENREGISTRES</h2>
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
        switch ($nomColonne)
        {
            case "img_profil":
            case "nom_profil":
            case "prenom_profil":
                echo "<th>$nomColonne</th>";
                break;
        }
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
        switch ($nomColonne)
        {
            case "img_profil":
            case "nom_profil":
            case "prenom_profil":
                echo "<th>$valeurColonne</th>";
                break;
        }
    }
    
    // JE RECUPERE L'ID DE LA LIGNE COURANTE
    $id = $tabLigne["id"];
    
    $hrefModifier  = $this->url("admin_friteam-equipe-update", [ "id" => $id ]);
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
