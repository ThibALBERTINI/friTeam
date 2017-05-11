<?php
// ON VA ALLER CHERCHER LES INFOS DE LA FORMATION DANS LA TABLE MYSQL formation
// APPROCHE PAR DELEGATION
$objetCguModel = new \Model\CguModel;
$tabResult = $objetCguModel->find($id);

if (!empty($tabResult)) :
    // ON CREE DES VARIABLES LOCALES AVEC LE MEME NOM 
    // QUE LA CLE DANS LE TABLEAU ASSOCIATIF
    extract($tabResult);
    //print_r($tabResult);
    
?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <h3>FORMULAIRE DE MISE A JOUR DES CONDITIONS GENERALES D'UTILISATION</h3>

                <div class="message classe-ok">
                    <?php if (isset($messageOK)) echo $messageOK; ?><br> 
                </div>
                <div class="message classe-ko">
                     <?php if (isset($messageKO)) echo $messageKO; ?><br>
                </div>                

                <a href="<?php echo $this->url("admin_home"); ?>">Retour</a>
                <form method="POST" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="contenu_cgu">Contenu "Conditions générales d'utilisation"</label><br>
                        <textarea type="text" name="contenu_cgu" id="contenu_cgu" class="form-control ckeditor" required cols="60" rows="5"><?php echo $contenu_cgu ?></textarea><br>
                    </div>

                    <button type="submit">Modifier les Conditions générales d'utilisation</button>
                    
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
    <h3>Erreur Lors de l'affichage de la page, contacter le webMaster du dit site</h3>
</section>

<?php endif; ?>