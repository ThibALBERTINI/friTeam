<?php
// ON VA ALLER CHERCHER LES INFOS DE LA FORMATION DANS LA TABLE MYSQL formation
// APPROCHE PAR DELEGATION
$objetVideoModel = new \Model\VideoModel;
$tabResult = $objetVideoModel->find($id);

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
                <h3>FORMULAIRE DE MISE A JOUR DU BANDEAU VIDEO/FRITEAM C'EST QUOI ?</h3>

                <a href="<?php echo $this->url("admin_home"); ?>">Retour</a>
                <form method="POST" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="contenu_friteam">Contenu "POURQUOI FRI TEAM"</label><br>
                        <textarea type="text" name="contenu_friteam" id="contenu_friteam" class="form-control ckeditor" required cols="60" rows="5"><?php echo $contenu_friteam ?></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="url_video">Url de la vidéo</label><br>
                        <input type="text" name="url_video" id="url_video" class="form-control" required value="<?php echo $url_video ?>"><br>
                    </div>

                    <button type="submit">Modifier le Bandeau</button>
                    
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
    <h3>TU AS UN PROBLEME</h3>
</section>

<?php endif; ?>