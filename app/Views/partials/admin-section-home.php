<section> <!-- Affichage des infos pour le bandeau video -->
	<div class="container-fluid table-admin">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2 ">
				<h2>Infos pour le bandeau FriTeam/Video sur la page d'accueil</h2>
				<div class="scroll-table">	
					<table class="table table-striped table-responsive">
						<thead>
				<?php
					//création d'un nouvel objet
					$objetVideoModel = new \Model\VideoModel;
					//fincAll renvoie un tableau associatif de l'objet créé
					$tabResult = $objetVideoModel->findAll("id", "DESC", 1);
					//exploitation du tableau associatif avec boucle pour chaque ligne trouvée
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//BOucle pour parcourir les colonnes
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "contenu_friteam":
				    			case "url_video":
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
					$tabResult = $objetVideoModel->findAll("id", "DESC");
					//Boucle pour parcourir chaque ligne
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//boucle pour parcourir chaque colonne
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "contenu_friteam":
				    			case "url_video":
				        			echo "<td>$valeurColonne</td>";
				        			break;
							}
							//echo "<td>$valeurColonne</td>";
						}

						//je recupere l'id de la ligne courante
						$id = $tabLigne["id"];

						$hrefModifier = $this->url("admin_home-video", [ "id" => $id ]);

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

<!-- Affichage des infos pour le bandeau points forts -->
<section>
	<div class="container-fluid table-admin">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2 ">
				<h2>Infos pour le bandeau Point Fort</h2>
				<div class="scroll-table">	
					<table class="table table-striped table-responsive">
						<thead>
				<?php
					//création d'un nouvel objet
					$objetPointModel = new \Model\PointModel;
					//fincAll renvoie un tableau associatif de l'objet créé
					$tabResult = $objetPointModel->findAll("id", "DESC", 1);
					//exploitation du tableau associatif avec boucle pour chaque ligne trouvée
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//BOucle pour parcourir les colonnes
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "titre_point":
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
					$tabResult = $objetPointModel->findAll("id", "DESC");
					//Boucle pour parcourir chaque ligne
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//boucle pour parcourir chaque colonne
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "titre_point":
				        			echo "<td>$valeurColonne</td>";
				        			break;
							}
							//echo "<td>$valeurColonne</td>";
						}

						//je recupere l'id de la ligne courante
						$id = $tabLigne["id"];

						$hrefModifier = $this->url("admin_home-point", [ "id" => $id ]);

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

<!-- Affichage des infos pour le bandeau temoignages -->
<section>
	<div class="container-fluid table-admin">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2 ">
				<h2>Infos pour le bandeau Temoignage</h2>
				<div class="scroll-table">	
					<table class="table table-striped table-responsive">
						<thead>
				<?php
					//création d'un nouvel objet
					$objetTemoignageModel = new \Model\TemoignageModel;
					//fincAll renvoie un tableau associatif de l'objet créé
					$tabResult = $objetTemoignageModel->findAll("id", "DESC", 1);
					//exploitation du tableau associatif avec boucle pour chaque ligne trouvée
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//BOucle pour parcourir les colonnes
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "entreprise_temoignage":
				    			case "nom_temoignage":
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
					$tabResult = $objetTemoignageModel->findAll("id", "DESC");
					//Boucle pour parcourir chaque ligne
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//boucle pour parcourir chaque colonne
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "entreprise_temoignage":
				    			case "nom_temoignage":
				        			echo "<td>$valeurColonne</td>";
				        			break;
							}
							//echo "<td>$valeurColonne</td>";
						}

						//je recupere l'id de la ligne courante
						$id = $tabLigne["id"];

						$hrefModifier = $this->url("admin_home-temoignage", [ "id" => $id ]);

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

<!-- <?php 
// ON VA ALLER CHERCHER LES INFOS DE LA FORMATION DANS LA TABLE MYSQL formation
// APPROCHE PAR DELEGATION
$objetFormationModel = new \Model\FormationModel;
$tabFormation = $objetFormationModel->find($id);

//if (!empty($tabFormation)) :
    // ON CREE DES VARIABLES LOCALES AVEC LE MEME NOM 
    // QUE LA CLE DANS LE TABLEAU ASSOCIATIF
    extract($tabFormation);
?> -->

<!-- Affichage des infos pour le bandeau partenaires -->
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<h2>AJOUT D'UN Partenaire</h2>
				<form action="" method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<label for="img">Logo</label><br>
						<input type="file" name="img" id="img" class="form-control"><br>
					</div>

					<div class="form-group">
                        <label for="alt">Texte alternatif de l'image (référencement de l'image)</label><br>
                        <input type="text" name="alt" id="alt" placeholder="Champs limité à 100 caractères" class="form-control"><br>
                    </div>

					<div class="form-group">
						<label for="lien">Lien vers le site web du partenaire</label><br>
						<input type="text" name="lien" id="lien" class="form-control" required><br>
					</div>

					<button type="submit">Créer un nouveau Partenaire</button>

					<!-- Info technique pour préciser l'action que le visiteur veut réaliser -->
					<input type="hidden" name="operation" value="creer">

					<div class="message">
						<?php if (isset($message)) echo $message ?>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>
<!-- <?php
//endif;
?> -->

<section>
	<div class="container-fluid table-admin">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2 ">
				<h2>Liste des Partenaires déjà enregistrées dans la Base de Donnée</h2>
				<div class="scroll-table">	
					<table class="table table-striped table-responsive">
						<thead>
				<?php
					//création d'un nouvel objet
					$objetPartenaireModel = new \Model\PartenaireModel;
					//fincAll renvoie un tableau associatif de l'objet créé
					$tabResult = $objetPartenaireModel->findAll("id", "DESC", 1);
					//exploitation du tableau associatif avec boucle pour chaque ligne trouvée
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//BOucle pour parcourir les colonnes
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "img":
				    			case "lien":
				        			echo "<th>$nomColonne</th>";
				        			break;
							}
							//affichage de la colonne
							//echo "<th>$nomColonne</th>";
						}
						//Ajouter les colonnes MODIFIER SUPPRIMER
						echo "<th>MODIFIER</th>";
						echo "<th>SUPPRIMER</th>";

						echo "</tr>";
					}

				 ?>
						</thead>
						<tbody>
				<?php 
					//acces a la table
					$tabResult = $objetPartenaireModel->findAll("id", "DESC");
					//Boucle pour parcourir chaque ligne
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//boucle pour parcourir chaque colonne
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "img":
				    			case "lien":
				        			echo "<td>$valeurColonne</td>";
				        			break;
							}
							//echo "<td>$valeurColonne</td>";
						}

						//je recupere l'id de la ligne courante
						$id = $tabLigne["id"];

						$hrefModifier = $this->url("admin_home-partenaire", [ "id" => $id ]);
						$hrefSupprimer = "?id=$id&operation=supprimer";

						//Ajouter les colonnes MODIFIER et SUPPRIMER
						echo 
<<<CODEHTML
	<td><a href="$hrefModifier">MODIFIER</td>
 	<td><a href="$hrefSupprimer">SUPPRIMER</td>
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