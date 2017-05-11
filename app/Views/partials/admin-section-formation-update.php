<?php
// ON VA ALLER CHERCHER LES INFOS DE LA FORMATION DANS LA TABLE MYSQL formation
// APPROCHE PAR DELEGATION
$objetFormationModel = new \Model\FormationModel;
$tabFormation = $objetFormationModel->find($id);

if (!empty($tabFormation)) :
    // ON CREE DES VARIABLES LOCALES AVEC LE MEME NOM 
    // QUE LA CLE DANS LE TABLEAU ASSOCIATIF
    extract($tabFormation);
    //print_r($tabFormation);
    
?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <h3>FORMULAIRE DE MISE A JOUR DES FICHES FORMATION</h3>

                    <div class="message classe-ok">
                        <?php if (isset($messageOK)) echo $messageOK; ?><br> 
                    </div>
                    <div class="message classe-ko">
                         <?php if (isset($messageKO)) echo $messageKO; ?><br>
                    </div>
                    <a href="<?php echo $this->url("admin_formation_detail"); ?>">Retour</a>

                <form method="POST" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="img">Illustration</label><br>
                        <input type="file" name="img" id="img" class="form-control" value="Choissisez une autre image"><br>
                    </div>

                    <div class="form-group">
                        <label for="alt">Texte alternatif de l'image (référencement de l'image)</label><br>
                        <input type="text" name="alt" id="alt" placeholder="Champs limité à 100 caractères" class="form-control" value="<?php echo $alt ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="title_formation">Titre de la formation</label><br>
                        <input type="text" name="titre_formation" id="titre_formation" class="form-control"  value="<?php echo $titre_formation ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="categorie_formation">Catégorie</label>
                        <select name="categorie_formation" id="categorie_formation" class="form-control" required value="<?php echo $categorie_formation ?>">>
                            <option value="Friteam">Friteam</option>
                            <option value="Complementaire">Complémentaire</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="presentation_formation">Présentation</label><br>
                        <textarea type="text" name="presentation_formation" id="presentation_formation" class="form-control" required cols="60" rows="5"><?php echo $presentation_formation ?></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="chapo_formation">Chapô</label><br>
                        <textarea type="text" name="chapo_formation" id="chapo_formation" class="form-control" required cols="60" rows="5"><?php echo $chapo_formation ?></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="objectif_formation">Objectifs</label><br>
                        <textarea type="text" name="objectif_formation" id="objectif_formation" cols="60" rows="5" class="form-control" required><?php echo $objectif_formation ?></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="public_formation">Public concerné</label><br>
                        <input type="text" name="public_formation" id="public_formation" class="form-control" required value="<?php echo $public_formation ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="conditions_formation">Conditions</label><br>
                        <input type="text" name="conditions_formation" id="conditions_formation" class="form-control" required value="<?php echo $conditions_formation ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="duree_formation">Durée</label><br>
                        <input type="text" name="duree_formation" id="duree_formation" class="form-control" required value="<?php echo $duree_formation ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="prix">Prix</label><br>
                        <textarea type="text" name="prix" id="prix" class="form-control ckeditor" required cols="60" rows="5"><?php echo $prix ?></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="date_formation">Date de formation</label><br>
                        <input type="date" name="date_formation" id="date_formation" class="form-control" required value="<?php echo $date_formation ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="lieu_formation">Lieu</label><br>
                        <input type="text" name="lieu_formation" id="lieu_formation" class="form-control" required value="<?php echo $lieu_formation ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="intervenant_formation">Intervenant(s)</label><br>
                        <input type="text" name="intervenant_formation" id="intervenant_formation" class="form-control" required value="<?php echo $intervenant_formation ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="programme_formation">Programme</label><br>
                        <textarea type="text" name="programme_formation" id="programme_formation" class="form-control ckeditor" required cols="60" rows="5"><?php echo $programme_formation ?></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="lien_catalogue">Lien vers Catalogue en ligne</label><br>
                        <input type="file" name="lien_catalogue" id="lien_catalogue" class="form-control" required value="<?php echo $lien_catalogue ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="url">URl</label><br>
                        <input type="text" name="url" id="url" class="form-control" required value="<?php echo $url ?>"><br>
                    </div>

                    <button type="submit" name="submit">Modifier la Fiche Formation</button>
                    
                    <!-- INFO TECHNIQUE POUR PRECISER L'ACTION QUE LE VISITEUR VEUT REALISER -->
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="operation" value="modifier">                    
                </form>
            </div>
        </div>
    </div>
</section>

<?php else: ?>

<section>
    <h3>AUCUNE FORMATION TROUVEE</h3>
</section>

<?php endif; ?>