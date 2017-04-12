<?php
$objetEquipeModel = new \Model\EquipeModel;
$tabEquipe = $objetEquipeModel->find($id);
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
            <label for="img_Equipe">CHEMIN PHOTO</label>
            <input type="text" name="img_Equipe"><br>
        </div>
        <div class=form-group>   
            <label for="nom_Equipe">NOM</label>
            <input type="text" name="nom_Equipe"><br>
        </div>
        <div class=form-group>    
            <label for="nom_Equipe">PRENOM</label>
            <input type="text" name="prenom_Equipe"><br>
        </div>
        <div class=form-group>
            <label for="citation_Equipe">CITATION PREFEREE</label>  
            <input type="text" name="citation_Equipe"><br>
        </div>
        <div class=form-group>
            <label for="competence_Equipe">COMPETENCES</label>
            <input type="text" name="competence_Equipe"><br>
        </div>
        <div class=form-group>
            <label for="interets_Equipe">CENTRES D'INTERET</label>
            <input type="text" name="interet_Equipe"><br>
        </div>
        <div class=form-group>
            <label for="domaines_inter">DOMAINES D'INTERVENTION</label>
            <input type="text" name="domaines_inter"><br>
        </div>
        <div class=form-group>
            <label for="motivation_Equipe">MOTIVATION</label>
            <input type="text" name="motivation_Equipe"><br>
        </div>
        <div class=form-group>
            <label for="vision_Equipe">VISION</label>
            <input type="text" name="vision_Equipe" ><br>
        </div>
        <div class=form-group>
            <label for="entreprise_Equipe">ENTREPRISE</label>
            <input type="text" name="entreprise_Equipe"><br>
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
// SI JE VEUX ACCEDER A LA TABLE Equipe
// IL FAUT UTILISER LA CLASSE \Model\EquipeModel
$objetEquipeModel = new \Model\EquipeModel;

$tabResult = $objetEquipeModel->findAll("id", "DESC", 1); // ON NE VEUT QU'UNE LIGNE
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
// SI JE VEUX ACCEDER A LA TABLE Equipe
// IL FAUT UTILISER LA CLASSE \Model\EquipeModel
$tabResult = $objetEquipeModel->findAll("id", "DESC");
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
    
    $hrefModifier  = $this->url("admin_Equipe_update", [ "id" => $id ]);
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
