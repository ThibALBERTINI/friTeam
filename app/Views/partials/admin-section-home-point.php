<?php
// ON VA ALLER CHERCHER LES INFOS DE LA FORMATION DANS LA TABLE MYSQL formation
// APPROCHE PAR DELEGATION
$objetPointModel = new \Model\PointModel;
$tabResult = $objetPointModel->find($id);

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
                <h3>FORMULAIRE DE MISE A JOUR DU BANDEAU "LES POINTS FORTS"</h3>
                <form method="POST" action="" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="titre_point">Titre du point fort</label><br>
                        <input type="text" name="titre_point" id="titre_point" class="form-control" required value="<?php echo $titre_point ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="contenu_point">Contenu du point fort</label><br>
                        <textarea type="text" name="contenu_point" id="contenu_point" class="form-control" required cols="60" rows="5" placeholder="<?php echo $contenu_point ?>"></textarea><br>
                    </div>

                    <button type="submit">Modifier le Bandeau "Les Points Forts"</button>
                    
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
    <h3> PROBLEME NOUVEAU TU AS UN</h3>
</section>

<?php endif; ?>