<?php
// ON VA ALLER CHERCHER LES INFOS DE LA FORMATION DANS LA TABLE MYSQL formation
// APPROCHE PAR DELEGATION
$objetTemoignageModel = new \Model\TemoignageModel;
$tabResult = $objetTemoignageModel->find($id);

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
                <h3>FORMULAIRE DE MISE A JOUR DU BANDEAU "TEMOIGNAGE"</h3>

                <div class="message classe-ok">
                    <?php if (isset($messageOK)) echo $messageOK; ?><br> 
                </div>
                <div class="message classe-ko">
                     <?php if (isset($messageKO)) echo $messageKO; ?><br>
                </div>

                <a href="<?php echo $this->url("admin_home"); ?>">Retour</a>
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
                        <label for="temoignage_temoignage">Contenu de "FriTeam c'est quoi ?"</label><br>
                        <textarea type="text" name="temoignage_temoignage" id="temoignage_temoignage" class="form-control" required cols="60" rows="5" placeholder="<?php echo $temoignage_temoignage ?>"></textarea><br>
                    </div>

                    <div class="form-group">
                        <label for="entreprise_temoignage">Entreprise</label><br>
                        <input type="text" name="entreprise_temoignage" id="entreprise_temoignage" class="form-control" required value="<?php echo $entreprise_temoignage ?>"><br>
                    </div>

                    <div class="form-group">
                        <label for="nom_temoignage">Nom/Prenom du témoin</label><br>
                        <input type="text" name="nom_temoignage" id="nom_temoignage" class="form-control" required value="<?php echo $nom_temoignage ?>"><br>
                    </div>


                    <button type="submit" name="submit">Modifier le Bandeau "Les témoignages"</button>
                    
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
    <h3> PROBLEME NOUVEAU TU AS UN</h3>
</section>

<?php endif; ?>