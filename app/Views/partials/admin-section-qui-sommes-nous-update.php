<?php
// ON VA ALLER CHERCHER LES INFOS DE L'Profil DANS LA TABLE MYSQL Profil
// APPROCHE PAR DELEGATION
$objetProfilModel = new \Model\ProfilModel;
$tabProfil = $objetProfilModel->find($id);

if (!empty($tabProfil)) :
    
    // RECUPERER CHAQUE COLONNE
/*
    $img            = $tabProfil["img_profil"];
    $nom            = $tabProfil["nom_profil"];
    $prenom         = $tabProfil["prenom_profil"];
    $citation       = $tabProfil["citation_profil"];
    $competence     = $tabProfil["competence_profil"];
    $interets       = $tabProfil[interets_profil"];
    $INTERVENTION   = $tabProfil["domaines_inter"];
    $motivation     = $tabProfil["motivation_profil"];
    $vision         = $tabProfil["vision_profil"];
    $entreprise     = $tabProfil["entreprise_profil"];
    $linkedin       = $tabProfil["linkedin"];
*/
    // http://php.net/manual/fr/function.extract.php
    // ON CREE DES VARIABLES LOCALES AVEC LE MEME NOM 
    // QUE LA CLE DANS LE TABLEAU ASSOCIATIF
    extract($tabProfil);
    
?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <h3>FORMULAIRE DE MISE A JOUR DE L'EQUIPE</h3>
                <form method="POST" action="" enctype="multipart/form-data">
                    
                    <div class="form-group">   
                        <label for="img">PHOTO</label><br>
                        <input type="file" name="img" class="form-control" value="<?php echo $img ?>"><br>
                    </div>
                    <div class="form-group">   
                        <label for="nom_profil">NOM</label><br>
                        <input type="text" name="nom_profil" class="form-control" value="<?php echo $nom_profil ?>"><br>
                    </div>
                    <div class="form-group">    
                        <label for="nom_profil">PRENOM</label><br>
                        <input type="text" name="prenom_profil" class="form-control" value="<?php echo $prenom_profil ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="citation_profil">CITATION PREFEREE</label><br>  
                        <input type="text" name="citation_profil" class="form-control" value="<?php echo $citation_profil ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="competence_profil">COMPETENCES</label><br>
                        <input type="text" name="competence_profil" class="form-control" value="<?php echo $competence_profil?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="interets_profil">CENTRES D'INTERET</label><br>
                        <input type="text" name="interets_profil" class="form-control" value="<?php echo $interets_profil ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="domaines_inter">DOMAINES D'INTERVENTION</label><br>
                        <input type="text" name="domaines_inter" class="form-control" value="<?php echo $domaines_inter ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="motivation_profil">MOTIVATION</label><br>
                        <input type="text" name="motivation_profil" class="form-control" value="<?php echo $motivation_profil ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="vision_profil">VISION</label><br>
                        <input type="text" name="vision_profil" class="form-control" value="<?php echo $vision_profil ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="entreprise_profil">ENTREPRISE</label><br>
                        <input type="text" name="entreprise_profil" class="form-control" value="<?php echo $entreprise_profil ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">LINKEDIN</label><br>
                        <input type="text" name="linkedin" class="form-control" value="<?php echo $linkedin ?>"><br>
                    </div>
                    <div class="form-group">
                        <button type="submit">MODIFIER LE PROFIL</button>
                    </div>        
                    
                    <!-- INFO TECHNIQUE POUR PRECISER L'ACTION QUE LE VISITEUR VEUT REALISER -->
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="operation" value="modifier">
                    
                    <div class="message">
                        <?php if (isset($message)) echo $message ?><br>
                        <?php if (isset($message_upload)) echo $message_upload ?><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php else: ?>

<section>
    <h3>AUCUN PROFIL TROUVE</h3>
</section>

<?php endif; ?>