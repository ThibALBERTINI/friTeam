<?php
// ON VA ALLER CHERCHER LES INFOS DE LA FORMATION DANS LA TABLE MYSQL formation
// APPROCHE PAR DELEGATION
$objetActualiteModel = new \Model\ActualiteModel;
$tabActualite = $objetActualiteModel->find($id);

if (!empty($tabActualite)) :
    // ON CREE DES VARIABLES LOCALES AVEC LE MEME NOM 
    // QUE LA CLE DANS LE TABLEAU ASSOCIATIF
    extract($tabActualite);
    //print_r($tabFormation);
?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <h3>FORMULAIRE DE MISE A JOUR D'UN ARTICLE</h3>

                <div class="message classe-ok">
                    <?php if (isset($messageOK)) echo $messageOK; ?><br> 
                </div>
                <div class="message classe-ko">
                     <?php if (isset($messageKO)) echo $messageKO; ?><br>
                </div>

                <form method="POST" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="img">Illustration</label><br>
                        <input type="file" name="img" id="img" class="form-control" value="Choissisez une autre image"><br>
                    </div>

                    <div class="form-group">
                        <label for="alt">Texte alternatif de l'image (référencement de l'image)</label><br>
                        <input type="text" name="alt" id="alt" placeholder="Champs limité à 100 caractères" class="form-control"><br>
                    </div>

                    <div class="form-group">
                        <label for="titre_actualite">Titre de l'article'</label><br>
                        <input type="text" name="titre_actualite" id="titre_actualite" class="form-control" required value="<?php echo $titre_actualite ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="chapo_actualite">Chapô</label><br>
                        <textarea type="text" name="chapo_actualite" id="chapo_actualite" class="form-control" required cols="60" rows="5"><?php echo $chapo_actualite ?></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="contenu_actualite">Corps de l'article</label><br>
                        <textarea type="text" name="contenu_actualite" id="contenu_actualite" class="form-control" required cols="60" rows="5" value="<?php echo $contenu_actualite ?>"></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="auteur_actualite">Auteur(s)</label><br>
                        <input type="text" name="auteur_actualite" id="auteur_actualite" class="form-control" required value="<?php echo $auteur_actualite ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="url">URl</label><br>
                        <input type="text" name="url" id="url" class="form-control" required value="<?php echo $url ?>"><br>
                    </div>

                    <button type="submit">Modifier la Fiche Formation</button>
                    
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
    <h3>Page en construction...</h3>
</section>

<?php endif; ?>