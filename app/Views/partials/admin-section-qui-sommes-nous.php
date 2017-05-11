<section> <!-- Affichage des infos pour le bandeau video -->
    <div class="container-fluid table-admin">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2 ">
                <h2>Contenu du texte de présentation "Notre Philosophie"</h2>
                <div class="scroll-table">  
                    <table class="table table-striped table-responsive">
                        <thead>
                <?php
                    //création d'un nouvel objet
                    $objetPhilosophieModel = new \Model\PhilosophieModel;
                    //fincAll renvoie un tableau associatif de l'objet créé
                    $tabResult = $objetPhilosophieModel->findAll("id", "DESC", 1);
                    //exploitation du tableau associatif avec boucle pour chaque ligne trouvée
                    foreach($tabResult as $tabLigne)
                    {
                        echo "<tr>";
                        //BOucle pour parcourir les colonnes
                        foreach($tabLigne as $nomColonne => $valeurColonne)
                        {
                            switch ($nomColonne)
                            {
                                case "contenu_philosophie":
                                    echo "<th>$nomColonne</th>";
                                    break;
                            }
                            //affichage de la colonne
                            //echo "<th>$nomColonne</th>";
                        }
                        //Ajouter les colonnes MODIFIER SUPPRIMER
                        echo "<th>MODIFIER</th>";

                        echo "</tr>";
                    }

                 ?>
                        </thead>
                        <tbody>
                <?php 
                    //acces a la table
                    $tabResult = $objetPhilosophieModel->findAll("id", "DESC");
                    //Boucle pour parcourir chaque ligne
                    foreach($tabResult as $tabLigne)
                    {
                        echo "<tr>";
                        //boucle pour parcourir chaque colonne
                        foreach($tabLigne as $nomColonne => $valeurColonne)
                        {
                            switch ($nomColonne)
                            {
                                case "contenu_philosophie":
                                    echo "<td>$valeurColonne</td>";
                                    break;
                            }
                            //echo "<td>$valeurColonne</td>";
                        }

                        //je recupere l'id de la ligne courante
                        $id = $tabLigne["id"];

                        $hrefModifier = $this->url("admin_qui-sommes-nous-philosophie", [ "id" => $id ]);

                        //Ajouter les colonnes MODIFIER et SUPPRIMER
                        echo 
<<<CODEHTML
    <td><a href="$hrefModifier">MODIFIER</td>
    </tr>
CODEHTML;
                }
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <h2>AJOUT D'UN PROFIL</h2>

                <div class="message classe-ok">
                    <?php if (isset($messageOK)) echo $messageOK; ?><br> 
                </div>
                <div class="message classe-ko">
                     <?php if (isset($messageKO)) echo $messageKO; ?><br>
                </div>

                <form method="POST" action="" enctype="multipart/form-data">

                    <div class=form-group>   
                        <label for="img">CHEMIN PHOTO</label>
                        <input type="file" name="img" id="img" class="form-control"><br>
                    </div>

                    <div class="form-group">
                        <label for="alt">Texte alternatif de l'image (référencement de l'image)</label><br>
                        <input type="text" name="alt" id="alt" placeholder="Champs limité à 100 caractères" class="form-control"><br>
                    </div>

                    <div class=form-group>   
                        <label for="nom_profil">NOM</label>
                        <input type="text" name="nom_profil" id="nom_profil" class="form-control"><br>
                    </div>

                    <div class=form-group>    
                        <label for="prenom_profil">PRENOM</label>
                        <input type="text" name="prenom_profil" id="prenom_profil" class="form-control"><br>
                    </div>

                    <div class=form-group>   
                        <label for="ordre_apparition">ORDRE D'APPARITION DANS L'AFFICHAGE</label>
                        <input type="number" name="ordre_apparition" id="ordre_apparition" class="form-control"><br>
                    </div>

                    <div class=form-group>
                        <label for="citation_profil">CITATION PREFEREE</label>  
                        <input type="text" name="citation_profil" id="citation_profil" class="form-control"><br>
                    </div>

                    <div class=form-group>
                        <label for="competence_profil">COMPETENCES</label>
                        <input type="text" name="competence_profil" id="competence_profil" class="form-control"><br>
                    </div>

                    <div class=form-group>
                        <label for="interets_profil">CENTRES D'INTERET</label>
                        <input type="text" name="interets_profil" id="interets_profil" class="form-control"><br>
                    </div>

                    <div class=form-group>
                        <label for="domaines_inter">DOMAINES D'INTERVENTION</label>
                        <input type="text" name="domaines_inter" id="domaines_profil" class="form-control"><br>
                    </div>

                    <div class=form-group>
                        <label for="motivation_profil">MOTIVATION</label>
                        <input type="text" name="motivation_profil" id="motivation_profil" class="form-control"><br>
                    </div>

                    <div class=form-group>
                        <label for="vision_profil">VISION</label>
                        <input type="text" name="vision_profil" id="vision_profil" class="form-control"><br>
                    </div>

                    <div class=form-group>
                        <label for="entreprise_profil">ENTREPRISE</label>
                        <input type="text" name="entreprise_profil" id="entreprise_profil" class="form-control"><br>
                    </div>

                    <div class=form-group>
                        <label for="linkedin">LINKEDIN</label>
                        <input type="text" name="linkedin" id="linkedin" class="form-control"><br>
                    </div>

                    <div class=form-group>
                        <button type="submit">CREER LE PROFIL</button>
                    </div>
                    
                    <!-- INFO TECHNIQUE POUR PRECISER L'ACTION QUE LE VISITEUR VEUT REALISER -->
                    <input type="hidden" name="operation" value="creer">
                    
                </form>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container-fluid table-admin">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2 ">
                <h2>LISTE DES PROFILS ENREGISTRES</h2>
                <div class="scroll-table">
                    <table class="table table-striped table-responsive">
                        <thead>
                <?php
                    // SI JE VEUX ACCEDER A LA TABLE profil
                    // IL FAUT UTILISER LA CLASSE \Model\ProfilModel
                    $objetProfilModel = new \Model\ProfilModel;
                    $tabResult = $objetProfilModel->findAll("id", "DESC", 1); // ON NE VEUT QU'UNE LIGNE
                    // BOUCLE POUR PARCOURIR CHAQUE LIGNE TROUVEE
                    foreach($tabResult as $tabLigne)
                    {
                        echo "<tr>";
                        // BOUCLE POUR PARCOURIR CHAQUE COLONNE
                        foreach($tabLigne as $nomColonne => $valeurColonne)
                        {
                            switch ($nomColonne)
                            {
                                case "img":
                                case "nom_profil":
                                case "prenom_profil":
                                    echo "<th>$nomColonne</th>";
                                    break;
                            }
                        }
                        // AJOUTER LES COLONNES MODIFIER ET SUPPRIMER
                        echo "<th>MODIFIER</th>";
                        echo "<th>SUPPRIMER</th>";
    
                        echo "</tr>";
                    }

                ?>            
                        </thead>
                        <tbody>
                <?php
                    // SI JE VEUX ACCEDER A LA TABLE profil
                    // IL FAUT UTILISER LA CLASSE \Model\ProfilModel
                    $tabResult = $objetProfilModel->findAll("id", "DESC");
                    // BOUCLE POUR PARCOURIR CHAQUE LIGNE TROUVEE
                    foreach($tabResult as $tabLigne)
                    {
                        echo "<tr>";
                        // BOUCLE POUR PARCOURIR CHAQUE COLONNE
                        foreach($tabLigne as $nomColonne => $valeurColonne)
                        {
                            switch ($nomColonne)
                            {
                                case "img":
                                case "nom_profil":
                                case "prenom_profil":
                                    echo "<th>$valeurColonne</th>";
                                    break;
                            }
                        }
    
                        // JE RECUPERE L'ID DE LA LIGNE COURANTE
                        $id = $tabLigne["id"];
    
                        $hrefModifier  = $this->url("admin_friteam-equipe-update", [ "id" => $id ]);
                        $hrefSupprimer = "?id=$id&operation=supprimer";
    
                        // AJOUTER LES COLONNES MODIFIER ET SUPPRIMER
                        echo
<<<CODEHTML
    <td><a href="$hrefModifier">MODIFIER</a></td>
    <td><a href="$hrefSupprimer" class="suppPf">SUPPRIMER</a></td>
    </tr>
CODEHTML;

                    }

                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
