<?php
// ON VA ALLER CHERCHER LES INFOS DE LA FICHE ACCOMPAGNEMENT DANS LA TABLE MYSQL accompagnement
// APPROCHE PAR DELEGATION
$objetAccompagnementModel = new \Model\AccompagnementModel;
$tabAccompagnement = $objetAccompagnementModel->find($id);

if (!empty($tabAccompagnement)) :
    // ON CREE DES VARIABLES LOCALES AVEC LE MEME NOM 
    // QUE LA CLE DANS LE TABLEAU ASSOCIATIF
    extract($tabAccompagnement);
    //print_r($tabAccompagnement);
    
?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <h3>FORMULAIRE DE MISE A JOUR DES FICHES ACCOMPAGNEMENT</h3>

                <a href="<?php echo $this->url("admin_accompagnement-detail"); ?>">Retour</a>
                <form method="POST" action="" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="img">Illustration</label><br>
                        <input type="file" name="img" id="img" class="form-control" value="<?php echo $img; ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="alt">Texte alternatif de l'image (référencement de l'image)</label><br>
                        <input type="text" name="alt" id="alt" placeholder="Champs limité à 100 caractères" class="form-control"><br>
                    </div>

                    <div class="form-group">
                        <label for="titre_acc">Entête de la Section Accompagnement</label><br>
                        <input type="text" name="titre_acc" id="titre_acc" class="form-control" required value="<?php echo $titre_acc ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="citation_acc">Citation</label><br>
                        <textarea type="text" name="citation_acc" id="citation_acc" class="form-control" required cols="60" rows="5"><?php echo $citation_acc ?></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="resume_acc">C'est Quoi ?</label><br>
                        <textarea type="text" name="resume_acc" id="resume_acc" class="form-control ckeditor" required cols="60" rows="5"><?php echo $resume_acc ?></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="presentation_acc">Comment ça marche ?</label><br>
                        <textarea type="text" name="presentation_acc" id="presentation_acc" class="form-control ckeditor" required cols="60" rows="5" value="<?php echo $presentation_acc ?>"></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="formateur_acc">Par qui ?</label><br>
                        <input type="text" name="formateur_acc" id="formateur_acc" class="form-control" required value="<?php echo $formateur_acc ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="utilite_acc">A quoi ça sert ?</label><br>
                        <input type="text" name="utilite_acc" id="utilite_acc" class="form-control" required value="<?php echo $utilite_acc ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="url">URl</label><br>
                        <input type="text" name="url" id="url" class="form-control" required value="<?php echo $url ?>"><br>
                    </div>

                    <button type="submit">Modifier la Fiche Accompagnement</button>
                    
                    <!-- INFO TECHNIQUE POUR PRECISER L'ACTION QUE LE VISITEUR VEUT REALISER -->
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="operation" value="modifier">
                    
                    <div class="message">
                        <?php if (isset($message)) echo $message ?><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php else: ?>

<section>
    <h3>AUCUNE FICHE ACCOMPAGNEMENT TROUVEE</h3>
</section>

<?php endif; ?>