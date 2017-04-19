<?php
// ON VA ALLER CHERCHER LES INFOS DE LA FORMATION DANS LA TABLE MYSQL formation
// APPROCHE PAR DELEGATION
$objetPartenaireModel = new \Model\PartenaireModel;
$tabResult = $objetPartenaireModel->find($id);

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
                <h3>FORMULAIRE DE MISE A JOUR DU BANDEAU "LES PARTENAIRES"</h3>

                <form method="POST" action="" enctype="multipart/form-data">

                	<div class="form-group">
                        <label for="img">Photo</label><br>
                        <input type="file" name="img" id="img" class="form-control" value="Choissisez une autre image"><br>
                    </div>

                    <div class="form-group">
                        <label for="alt">Texte alternatif de l'image (référencement de l'image)</label><br>
                        <input type="text" name="alt" id="alt" placeholder="Champs limité à 100 caractères" class="form-control"><br>
                    </div>

                    <div class="form-group">
                        <label for="lien">Lien vers le site du partenaire</label><br>
                        <input type="text" name="lien" id="lien" class="form-control" required value="<?php echo $lien ?>"><br>
                    </div>

                    <button type="submit">Modifier le Bandeau "Les Partenaire"</button>
                    
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