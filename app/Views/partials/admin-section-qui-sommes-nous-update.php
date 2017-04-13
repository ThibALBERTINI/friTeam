<?php
// ON VA ALLER CHERCHER LES INFOS DE L'Profil DANS LA TABLE MYSQL Profil
// APPROCHE PAR DELEGATION
$objetProfilModel = new \Model\ProfilModel;
$tabProfil = $objetProfilModel->find($id);

if (!empty($tabProfil)) :
    
    // RECUPERER CHAQUE COLONNE
/*
    $titre              = $tabProfil["titre"];
    $chapo              = $tabProfil["chapo"];
    $contenu            = $tabProfil["contenu"];
    $img_profil         = $tabProfil["img_profil"];
    $nom_profil         = $tabProfil["nom_profil"];
    $prenom_profil      = $tabProfil["prenom_profil"];
    $citation_profil    = $tabProfil["citation_profil"];
    $competence_profil  = $tabProfil["competence_profil"];
    $interets_profil    = $tabProfil[interets_profil"];
    $domaines_inter     = $tabProfil["domaines_inter"];
    $motivation_profil  = $tabProfil["motivation_profil"];
    $vision_profil      = $tabProfil["vision_profil"];
    $entreprise_profil  = $tabProfil["entreprise_profil"];
    $linkedin           = $tabProfil["linkedin"];
*/
    // http://php.net/manual/fr/function.extract.php
    // ON CREE DES VARIABLES LOCALES AVEC LE MEME NOM 
    // QUE LA CLE DANS LE TABLEAU ASSOCIATIF
    extract($tabProfil);
    
?>
<section>
    <h3>FORMULAIRE DE MISE A JOUR DE L'EQUIPE</h3>
    <form method="POST" action="" enctype="multipart/form-data>
        
        <div class=form-group>
            <label for="titre">TITRE</label>
            <input type="text" name="titre" value="<?php echo $titre ?>"><br>
        </div>
        <div class=form-group>
            <label for="chapo">CHAPO</label>
            <textarea name="chapo" cols="60" rows="4"><?php echo $chapo ?></textarea><br>
        </div>
        <div class=form-group>
            <label for="contenu">CONTENU</label>
            <textarea name="contenu" cols="60" rows="5"><?php echo $contenu ?></textarea><br>
        </div>
        <div class=form-group>   
            <label for="img_profil">CHEMIN PHOTO</label>
            <input type="text" name="img_profil" value="<?php echo $img_profil ?>"><br>
        </div>
        <div class=form-group>   
            <label for="nom_profil">NOM</label>
            <input type="text" name="nom_profil" value="<?php echo $nom_profil ?>"><br>
        </div>
        <div class=form-group>    
            <label for="nom_profil">PRENOM</label>
            <input type="text" name="prenom_profil" value="<?php echo $prenom_profil ?>"><br>
        </div>
        <div class=form-group>
            <label for="citation_profil">CITATION PREFEREE</label>  
            <input type="text" name="citation_profil" value="<?php echo $citation_profil ?>"><br>
        </div>
        <div class=form-group>
            <label for="competence_profil">COMPETENCES</label>
            <input type="text" name="competence_profil" value="<?php echo $competence_profil ?>"><br>
        </div>
        <div class=form-group>
            <label for="interets_profil">CENTRES D'INTERET</label>
            <input type="text" name="interet_profil" value="<?php echo $interets_profil ?>"><br>
        </div>
        <div class=form-group>
            <label for="domaines_inter">DOMAINES D'INTERVENTION</label>
            <input type="text" name="domaines_inter" value="<?php echo $domaines_inter ?>"><br>
        </div>
        <div class=form-group>
            <label for="motivation_profil">MOTIVATION</label>
            <input type="text" name="motivation_profil" value="<?php echo $motivation_profil ?>"><br>
        </div>
        <div class=form-group>
            <label for="vision_profil">VISION</label>
            <input type="text" name="vision_profil" value="<?php echo $vision_profil ?>"><br>
        </div>
        <div class=form-group>
            <label for="entreprise_profil">ENTREPRISE</label>
            <input type="text" name="entreprise_profil" value="<?php echo $entreprise_profil ?>"><br>
        </div>
        <div class=form-group>
            <label for="linkedin">LINKEDIN</label>
            <input type="text" name="linkedin" value="<?php echo $linkedin ?>"><br>
        </div>
        <div class=form-group>
            <button type="submit">CREER</button>
        </div>        
        
        <!-- INFO TECHNIQUE POUR PRECISER L'ACTION QUE LE VISITEUR VEUT REALISER -->
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="operation" value="modifier">
        
        <div class="message">
            <?php if (isset($message)) echo $message ?>
        </div>
    </form>
    
</section>

<?php else: ?>

<section>
    <h3>AUCUN PROFIL TROUVE</h3>
</section>

<?php endif; ?>