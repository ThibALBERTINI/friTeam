<form method="post">
	<div class="form-group">
		<label for="login">Login (mini 5 lettres ou chiffres ) : </label>
		<input type="text" name="login" id="login" 
					 class="form-control" required />
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" id="email" 
					 class="form-control" required />
	</div>

	<div class="form-group">
		<label for="password">Mot de Passe (mini 5 lettres ou chiffres)</label>
		<input type="password" name="password" id="password" 
					 class="form-control"  required/>
	</div>
	
	<div class="form-group">
		<label for="role">Role</label>
		<select name="role" id="role" class="form-control" required>
			<option value="admin">Administrateur</option>
			<option value="super-admin">Super Administrateur</option>
		</select>
		<p>Note : Le super-administrateur peut créer, modifier et supprimer les administrateurs</p>
	</div>
	
		
	<div class="form-group text-center">
		<input type="submit" name="btnSub" value="Ajouter"
					 class="btn btn-success" />
	</div>
<!--INFORMATION TECHNIQUE la valeur operation=creer part au submit (vers UsersController)-->
    	 <input type="hidden" name="operation" value="creer"> 

		<div class="message">
            <?php if (isset($message)) echo $message ?>
        </div>
        <!--on crée une div qui affichera le message de UsersController qui a transité par admin-article-->

        
    </form>
</section>


<section>
	<h2>Liste des administrateurs</h2>
	<table>
		<tbody>
			<thead>
				
			</thead>
			<tbody>


<?php
// SI JE VEUX ACCEDER A LA TABLE admin
// IL FAUT UTILISER LA CLASSE \Model\AdminModel qui est juste une extension de Model
$objetAdminModel = new \Model\AdminModel;

// création des titres <th> 

$tabResult = $objetAdminModel->findAll("id", "DESC", 1);  //je sélectionne une seule ligne à qui je vais emprunter les titres
// BOUCLE POUR PARCOURIR CHAQUE LIGNE TROUVEE
foreach($tabResult as $tabLigne)
{
    echo "<tr>";
    // BOUCLE POUR PARCOURIR CHAQUE COLONNE
    foreach($tabLigne as $nomColonne => $valeurColonne)
    {
        // AFFICHER LA COLONNE
        echo "<th>$nomColonne</th>";
    }
     // AJOUTER LES COLONNES MODIFIER ET SUPPRIMER
    echo "<th>MODIFIER</th>";
    echo "<th>SUPPRIMER</th>";
    
    echo "</tr>";
}

?>            

<?php
//accès à la table articles il faut utilsier la classe ArticleModel
$objetAdminModel= new\Model\AdminModel;
$tabResult = $objetAdminModel->findAll("id", "DESC");

//boucle pour parcourir chaque ligne
foreach ($tabResult as $tabLigne)
{
	echo "<tr>";
	//boucle pour parcourir chaque colonne
	foreach($tabLigne as $nomColonne => $valeurColonne)
	{
		//Afficher la colonne
		echo "<td>$valeurColonne</td>";
	}
// AJOUTER LES COLONNES MODIFIER ET SUPPRIMER
   $id = $tabLigne["id"];
    $hrefModifier  = $this->url("admin_creer-admin", [ "id" => $id ]); // on envoie vers la page admin-section-articles-update.php
   $hrefSupprimer = "?id=$id&operation=supprimer";  // on reste sur la même page

    echo
<<<CODEHTML
    <td><a href="$hrefModifier">MODIFIER</a></td>
    <td><a href="$hrefSupprimer" class="supp">SUPPRIMER</a></td>
    </tr>
CODEHTML;



}

?>
				
			</tbody>
		
	</table>

</section>